import template from './generic-popup.component.html';

const styles = require('./generic-popup.component.scss');

class Controller {
    constructor($timeout) {
        this.styles = styles;
        this.animation = 'fadeIn';
        this.confirmation = false;
        this.main = false;
        this.timeout = $timeout;

        console.log(this.styles);
    }

    $onInit() {
        console.log(`${this.namespace}Date`, localStorage.getItem(`${this.namespace}Date`));

        this.displayPopup = !localStorage.getItem(`${this.namespace}Date`) ? true : false;

        console.log(this.displayPopup);
    }

    saveAndClose() {
        if (!localStorage.getItem(`${this.namespace}Date`)) {
            localStorage.setItem(`${this.namespace}Date`, new Date().toISOString());
        }
        this.animation = 'fadeOut';

        this.timeout(() => {
            this.displayPopup = false;
        }, 900);
    }

    withoutSave() {
        this.animation = 'fadeOut';

        this.timeout(() => {
            this.displayPopup = false;
        }, 900);
    }
}

Controller.$inject = ['$timeout'];

export const GenericPopup = {
    template,
    controller: Controller,
    bindings: {
        titleText: '@',
        bodyText: '@',
        urlLink: '@',
        urlLabel: '@',
        buttonText: '@',
        closeOnly: '@',
        cancelText: '@',
        checkbox: '<',
        padding: '<',
        cancelBtn: '<',
        closeBtn: '<',
        dialogWidth: '@',
        namespace: '@',
    },
    transclude: {
        title: '?prfwpPopupTitle',
        body: '?prfwpPopupBody',
        footer: '?prfwpPopupFooter',
    },
};
