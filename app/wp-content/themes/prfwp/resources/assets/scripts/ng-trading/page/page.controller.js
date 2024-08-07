export class PageController {
    constructor($anchorScroll, $document) {
        this.$anchorScroll = $anchorScroll;
        this.$document = $document;

        this.pageLang = $document[0].documentElement.lang.substring(-1, 2);
    }

    scrollToHash(hash) {
        /* global angular */
        const yOffset = angular.element('.prfwp-navbar').height();

        this.$anchorScroll.yOffset = yOffset;
        this.$anchorScroll(hash);

        //console.log('click scroll', yOffset);
    }
}

PageController.$inject = ['$anchorScroll', '$document'];
