export class RiskWarningController {
    constructor() {
        this.showFullRiskWarning = localStorage.getItem('confirmRisk') ? false : true;
    }

    confirmRisk() {
        this.showFullRiskWarning = false;

        if (!localStorage.getItem('confirmRisk')) {
            localStorage.setItem('confirmRisk', new Date().toISOString());
        }
    }

    expand() {
        this.showFullRiskWarning = true;
    }
}
