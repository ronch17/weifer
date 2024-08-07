(function() {
    const $cfdPopupModal = $('.prfw-cfd-popup');
    const $cfdPopupBtn = $('.prfw-cfd-popup__button');

    if ($cfdPopupModal.length) {
        $($cfdPopupModal).each(function() {
            const currentElement = $(this);
            if (
                !currentElement.hasClass('prfw-cfd-popup__cache') ||
                !localStorage.getItem('cfdPopup' + currentElement.index())
            ) {
                currentElement.addClass('prfw-cfd-popup-open');
                currentElement.find($cfdPopupBtn).click(function() {
                    currentElement.removeClass('prfw-cfd-popup-open');
                    if (currentElement.hasClass('prfw-cfd-popup__cache')) {
                        localStorage.setItem('cfdPopup' + currentElement.index(), new Date().toISOString());
                    }
                });
            }
        });
    }
})();
