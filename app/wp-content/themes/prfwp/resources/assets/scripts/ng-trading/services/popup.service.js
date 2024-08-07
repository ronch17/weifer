export class PopupService {
    constructor() {
        this.popupShow = false;
    }

    getPopup() {
        return this.popupShow;
    }

    showPopup() {
        this.popupShow = true;
    }

    hidePopup() {
        this.popupShow = false;
    }
}
