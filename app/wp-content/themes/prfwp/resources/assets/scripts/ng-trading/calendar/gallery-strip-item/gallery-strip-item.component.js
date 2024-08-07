const styles = require('./gallery-strip-item.component.scss');

class Controller {
    constructor() {
        this.styles = styles;
    }

    $onInit() {}
}

Controller.$inject = ['$element', '$timeout'];

import template from './gallery-strip-item.component.html';

export const GalleryStripItemComponent = {
    template,
    controller: Controller,
    bindings: {
        data: '<',
        isSelected: '<',
        onSelect: '&',
    },
};
