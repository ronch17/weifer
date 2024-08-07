import updateButtonDropdownText from './bootstrap-tabs-dropdown-text';

class makeTabsNavCollapsible {
    static on({ dropdown, nav, tab, event }) {
        console.log({ dropdown, nav, tab, event });
        dropdown.show();
        nav.collapse('hide');
        updateButtonDropdownText(dropdown, tab);

        nav.on(event, () => {
            updateButtonDropdownText(dropdown, tab);
            nav.collapse('hide');
        });
    }

    static off({ dropdown, nav, event }) {
        dropdown.hide();
        nav.collapse('show').off(event);
    }
}

export default makeTabsNavCollapsible;
