import { toFixedTrunc } from '../../utils/to-fixed-trunc';
import template from './assets-table-row.component.html';
import * as rx from '../../utils/rx';
import * as _ from '../../utils/lodash';
import { useStreams } from '../../utils/use-streams';
import { observeComponentLifecycles } from '../../utils/observe-component-lifecycles';
import { observeCompChange } from '../../utils/observe-comp-change';
import { observeSocketChannel } from '../../utils/observe-socket-channel';
import { createChannelNameCfdFeedPrimaryAsset } from '../../utils/create-channel-name-cfd-feed-primary-asset';

const styles = require('./assets-table-row.component.scss');

const CFD_PLATFORM_SOCKET_REGISTRY = 'CFD_PLATFORM';

function calcDirectionChange(a, b) {
    if (a === b) {
        return 0;
    }

    if (a > b) {
        return 1;
    }

    return -1;
}

function calcDirectionClass(direction) {
    if (direction === 0) {
        return '';
    }

    if (direction > 0) {
        return 'cfd-js-up';
    }

    return 'cfd-js-down';
}

function calcSpread(streamData, asset) {
    if ([streamData.bid, streamData.ask].some(x => _.isNil(x))) {
        return '';
    }

    const priceScale = Math.pow(10, asset.precision);
    const precisionJs = Math.pow(10, asset.precision);
    const minimalPossiblePriceChange = asset.minMove / priceScale;
    const spread =
        (Math.round(streamData.ask * precisionJs) - Math.round(streamData.bid * precisionJs)) /
        Math.round(minimalPossiblePriceChange * precisionJs);
    const spreadNorm = toFixedTrunc(spread, 0);

    return spreadNorm;
}

class Controller {
    constructor(socketRegistry) {
        this.socketRegistry = socketRegistry;

        this.styles = styles;

        this.lifecycles = observeComponentLifecycles(this);
        this.asset$ = new rx.BehaviorSubject(null);
        this.localAsset$ = new rx.BehaviorSubject(null);

        useStreams(
            [
                observeCompChange(this.asset$, 'asset', this.lifecycles.onChanges$),
                this.streamRegisterForCfdStreamerUpdates(),
                this.streamLocalAsset(),
            ],
            this.lifecycles.onDestroy$
        );
    }

    $onInit() {}

    $onChanges() {}

    $onDestroy() {}

    streamRegisterForCfdStreamerUpdates() {
        return rx.pipe(
            () => this.asset$,
            rx.switchMap(asset => {
                if (_.isNil(asset)) {
                    return rx.obs.from([]);
                }

                const url = 'wss://streamer.binarytradingcore.com';
                const token = `${window.main.PLATFORM_BRAND_GUST_TOKEN}`;

                return observeSocketChannel(
                    this.socketRegistry,
                    CFD_PLATFORM_SOCKET_REGISTRY,
                    url,
                    token,
                    createChannelNameCfdFeedPrimaryAsset(asset.id)
                );
            }),
            rx.withLatestFrom(this.localAsset$),
            rx.map(([socketData, localAsset]) => {
                if (_.isNil(localAsset)) {
                    return localAsset;
                }

                const data = JSON.parse(socketData);
                const assetDirection = calcDirectionChange(data.bid, localAsset.bid);
                const directionClass = calcDirectionClass(assetDirection);
                const spread = calcSpread(data, localAsset);

                return {
                    ...localAsset,
                    assetDirection,
                    directionClass,
                    spread,
                    bid: data.bid,
                    ask: data.ask,
                };
            }),
            rx.tap(newAsset => this.localAsset$.next(newAsset))
        )(null);
    }

    streamLocalAsset() {
        return rx.pipe(
            () => this.asset$,
            rx.tap(asset => this.localAsset$.next(asset))
        )(null);
    }
}

Controller.$inject = ['socketRegistry'];

export const AssetsTableRowComponent = {
    template,
    controller: Controller,
    bindings: {
        asset: '<',
        tableCols: '<',
    },
};
