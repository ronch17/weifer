const styles = require('./events-table-row.component.scss');
import template from './events-table-row.component.html';

class Controller {
    constructor() {
        this.styles = styles;
        this.showInfo = false;
    }

    $onInit() {}
}

Controller.$inject = [];

export const EventsTableRowComponent = {
    template,
    controller: Controller,
    bindings: {
        data: '<',
        tableCols: '<',
    },
};
