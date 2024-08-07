class Controller {
    constructor() {}

    $onInit() {
        this.render();
    }

    $onChanges(changesObj) {
        if (changesObj.square) {
            this.render();
        }
    }

    render() {
        this.style = {};

        this.square.color && (this.style['color'] = this.square.color);
        this.square.backgroundColor && (this.style['background-color'] = this.square.backgroundColor);
        this.square.boxShadow && (this.style['box-shadow'] = this.square.boxShadow);
        this.square.zIndex && (this.style['z-index'] = this.square.zIndex);
    }
}

import template from './assets-background-square.component.html';

export const AssetsBackgroundSquareComponent = {
    template,
    controller: Controller,
    bindings: {
        square: '<',
    },
};
