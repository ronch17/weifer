import 'bootstrap/js/src/collapse';
import 'bootstrap/js/src/tab';
import invokeInSmallScreen from './lib/invoke-in-small-screen';
import makeTabsNavCollapsible from './bootstrap-tabs-utils/make-tabs-nav-collapsible';
import { storeNewHash, activateTabByHash } from './bootstrap-tabs-utils/bootstrap-tabs-hash-handler';

/* global angular */
angular.module('prf').config(['$locationProvider', $locationProvider => $locationProvider.html5Mode(true)]);

jQuery(document).ready(() => {
    // JavaScript to be fired on contain tabs pages, after page specific JS is fired
    // cpt-taxonomies-tabs ACF Module related
    const $tabsNavWrapper = $('.acfm-js-tabsNav');
    if ($tabsNavWrapper.length) {
        activateTabByHash($tabsNavWrapper);

        const dropdown = $('.acfm-js-tabsToggle'),
            tab = $('.acfm-js-tabsLink'),
            event = 'shown.bs.tab.dropdown';

        if (dropdown.length) {
            invokeInSmallScreen(makeTabsNavCollapsible, {
                dropdown,
                nav: $tabsNavWrapper,
                tab,
                event,
            });
        }

        $tabsNavWrapper.on('shown.bs.tab', e => {
            console.log(e.target);
            const newHash = $(e.target).attr('href');
            storeNewHash(newHash);
        });

        $(window).on('hashchange', () => {
            console.log('hashchange');
            activateTabByHash($tabsNavWrapper);
        });
    }
});
