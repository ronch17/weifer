import template from './assets-tabs.component.html';

const styles = require('./assets-tabs.component.scss');

class Controller {
    constructor() {
        this.categories = ['stock', 'currency', 'crypto', 'index', 'commodity'];
    }

    $onInit() {
        this.styles = styles;
    }
}

Controller.$inject = ['$element', '$timeout'];

export const AssetsTabsComponent = {
    template,
    controller: Controller,
    bindings: {
        activeCategoryAssets: '<',
        activeCategory: '<',
        onTabSelected: '&',
    },
};
