import * as rx from '../utils/rx';

import { observeComponentLifecycles } from '../utils/observe-component-lifecycles';
import { useStreams } from '../utils/use-streams';
import template from './trading-sentiments.component.html';

// import { tapLog } from '../utils/tap-log';
import { toFixedTrunc } from '../utils/to-fixed-trunc';

const styles = require('./trading-sentiments.component.scss');

class Controller {
    constructor(prfTradingSentimentsService) {
        this.lifecycles = observeComponentLifecycles(this);
        this.prfTradingSentimentsService = prfTradingSentimentsService;
        this.tradingSentiments$ = new rx.BehaviorSubject([]);

        this.styles = styles;

        useStreams([this.streamGetTradingSentiments()], this.lifecycles.onDestroy$);
    }

    $onInit() {}

    $onChanges() {}

    $onDestroy() {}

    streamGetTradingSentiments() {
        return rx.pipe(
            () => this.lifecycles.onInit$,
            rx.switchMap(() => {
                return rx.obs.from(this.prfTradingSentimentsService.getStatsAssetBuySellRatio());
            }),
            rx.map(data =>
                data.map(item => ({
                    name: item.asset.name,
                    buyRatio: toFixedTrunc(item.buySellRatio * 100, 2),
                    sellRatio: toFixedTrunc(100 - item.buySellRatio * 100, 2),
                }))
            ),
            rx.tap(data => this.tradingSentiments$.next(data))
        )(null);
    }
}

Controller.$inject = ['prfTradingSentimentsService'];

export const TradingSentimentsComponent = {
    template,
    controller: Controller,
    bindings: {},
};
