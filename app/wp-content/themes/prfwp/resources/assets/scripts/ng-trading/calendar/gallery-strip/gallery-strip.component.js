const styles = require('./gallery-strip.componnet.scss');

class Controller {
    constructor() {
        this.styles = styles;
    }

    $onInit() {}
}

Controller.$inject = [];

import template from './gallery-strip.component.html';

export const GalleryStripComponent = {
    template,
    controller: Controller,
    bindings: {
        items: '<',
        onSelect: '&',
        selectedKey: '<',
    },
};
