const styles = require('./events-table.component.scss');
import template from './events-table.component.html';
import config from './tableConfig';

class Controller {
    constructor() {
        this.styles = styles;
    }

    $onInit() {
        this.tableCols = config.tableCols;
    }
}

Controller.$inject = [];

export const EventsTableComponent = {
    template,
    controller: Controller,
    bindings: {
        events: '<',
    },
};
