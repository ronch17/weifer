import * as rx from '../utils/rx';
import { observeComponentLifecycles } from '../utils/observe-component-lifecycles';
import { useStreams } from '../utils/use-streams';
import template from './assets.component.html';
import { tapLog } from '../utils/tap-log';

const styles = require('./assets.component.scss');
import { filterCompChange } from '../utils/filter-comp-change';

function calcIsInTrade(asset) {}

class Controller {
    constructor(prfCfdPlatformRulesService, $sce) {
        this.$sce = $sce;
        this.styles = styles;
        this.lifecycles = observeComponentLifecycles(this);
        this.prfCfdPlatformRulesService = prfCfdPlatformRulesService;
        this.groupedRules$ = new rx.BehaviorSubject({});
        this.activeCategoryAssets$ = new rx.BehaviorSubject([]);
        this.activeCategory$ = new rx.BehaviorSubject('currency');
        this.localTableNotice$ = new rx.BehaviorSubject(this.$sce.trustAsHtml(''));
        this.opSelectTab$ = new rx.Subject();

        useStreams(
            [
                this.streamGetGroupedRules(),
                this.streamSubscribeToAssetsUpdates(),
                this.streamCalcActiveCategoryAssets(),
                this.streamCalcActiveCategory(),
                this.streamCalcLocalTableNotice(),
            ],
            this.lifecycles.onDestroy$
        );
    }

    $onInit() {}

    $onChanges() {}

    $onDestroy() {}

    streamGetGroupedRules() {
        return rx.pipe(
            () => this.lifecycles.onInit$,
            rx.switchMap(() => rx.obs.from(this.getGroupedRules())),
            rx.tap(groupedRules => this.groupedRules$.next(groupedRules))
        )(null);
    }

    streamCalcActiveCategoryAssets() {
        return rx.pipe(
            () => rx.obs.combineLatest(this.opSelectTab$, this.groupedRules$),
            rx.map(([selectedTab, groupedRules]) => {
                const rules = groupedRules[selectedTab];
                return rules ? rules : [];
            }),
            rx.map(rules => rules.map(x => ({ ...x.asset }))),
            rx.map(assets => assets.map(asset => ({ ...asset, isInTrade: calcIsInTrade(asset) }))),
            rx.tap(assets => this.activeCategoryAssets$.next(assets))
        )(null);
    }

    streamCalcActiveCategory() {
        return rx.pipe(
            () => this.opSelectTab$,
            rx.tap(selectedTab => this.activeCategory$.next(selectedTab))
        )(null);
    }

    streamSubscribeToAssetsUpdates() {
        return rx.pipe(() => this.lifecycles.onInit$)(null);
    }

    getGroupedRules() {
        return this.prfCfdPlatformRulesService.getGroupedRulesList();
    }

    streamCalcLocalTableNotice() {
        return rx.pipe(
            () => filterCompChange('tableNotice', this.lifecycles.onChanges$),
            rx.map(change => change.currentValue),
            rx.map(value => this.$sce.trustAsHtml(value)),
            rx.tap(value => this.localTableNotice$.next(value))
        )(null);
    }
}

Controller.$inject = ['prfCfdPlatformRulesService', '$sce'];

export const AssetsComponent = {
    template,
    controller: Controller,
    bindings: {
        pageTitle: '<',
        squareDefaultLength: '<',
        squareMinWidth: '<',
        rows: '<',
        containerClass: '<',
        iconSet: '<',
        tableNotice: '<',
    },
};
