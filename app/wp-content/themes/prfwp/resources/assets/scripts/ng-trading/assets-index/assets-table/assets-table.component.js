import template from './assets-table.component.html';
import config from './tableConfig';

const styles = require('./assets-table.component.scss');

class Controller {
    constructor() {}

    $onInit() {
        this.tableCols = config.tableCols;

        this.styles = styles;
    }
}

Controller.$inject = ['$element', '$timeout'];

export const AssetsTableComponent = {
    template,
    controller: Controller,
    bindings: {
        assets: '<',
    },
};
