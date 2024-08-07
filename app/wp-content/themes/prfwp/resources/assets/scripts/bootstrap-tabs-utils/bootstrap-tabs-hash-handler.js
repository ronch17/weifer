const activateTabByHash = $tabsWrapper => {
    const hash = location.hash,
        tabToActivate = $tabsWrapper.children(`[href="${hash}"]`);
    if (hash && tabToActivate) {
        tabToActivate.tab('show');
    } else {
        $tabsWrapper
            .children()
            .eq(0)
            .tab('show');
    }
};

const storeNewHash = newHash => {
    if (location.hash !== newHash) {
        const scrollBeforeHash = $('body').scrollTop() || $('html').scrollTop();
        if (history.pushState) {
            history.pushState(null, null, newHash);
        } else {
            location.hash = newHash;
        }
        $('html,body').scrollTop(scrollBeforeHash);
    }
};

export { activateTabByHash, storeNewHash };
