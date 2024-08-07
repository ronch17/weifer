const invokeInSmallScreen = (nameSpace, params) => {
    const windowWidth = $(window).outerWidth();
    console.log({ windowWidth, nameSpace, params });
    if (windowWidth <= 768) {
        nameSpace.on(params);
    } else {
        nameSpace.off(params);
    }

    let resizeTimer;

    $(window).on('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            invokeInSmallScreen(nameSpace, params);
        }, 250);
    });
};

export default invokeInSmallScreen;
