import template from './assets-table-manager.component.html';

const styles = require('./assets-table-manager.component.scss');

class Controller {
    constructor(prfCfdPlatformRulesService) {
        this.styles = styles;
        this.prfCfdPlatformRulesService = prfCfdPlatformRulesService;
    }

    $onInit() {
        this.getSpecificRules(this.selectedRules).then(rules => (this.rules = rules));
    }

    getSpecificRules(selectedRules) {
        return this.prfCfdPlatformRulesService.getSpecificRulesList(selectedRules);
    }
}

Controller.$inject = ['prfCfdPlatformRulesService'];

export const AssetsTableManagerComponent = {
    template,
    controller: Controller,
    bindings: {
        selectedRules: '<',
    },
    transclude: {
        notice: '?prfwpTableNotice',
    },
};
