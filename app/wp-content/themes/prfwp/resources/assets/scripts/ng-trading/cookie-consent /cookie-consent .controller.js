export class CookieConsentController {
    constructor() {
        this.showCookieConsent = localStorage.getItem('cookieConsent') ? false : true;
    }

    consentCookie() {
        this.showCookieConsent = false;

        if (!localStorage.getItem('cookieConsent')) {
            localStorage.setItem('cookieConsent', new Date().toISOString());
        }
    }

    expand() {
        this.showCookieConsent = true;
    }
}
