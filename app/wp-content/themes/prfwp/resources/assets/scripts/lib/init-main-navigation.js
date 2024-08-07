/* global main */
const initMainNavigation = container => {
    // Add dropdown toggle that displays child menu items.
    const dropdownToggle = $('<button />', {
        class: 'sub-menu-toggle',
        'aria-expanded': false,
    })
        .append(
            $('<span />', {
                class: 'screen-reader-text',
                text: main.navScreenReaderText.expand,
            })
        )
        .append($(main.navSVGArrow));

    container.find('.menu-item-has-children > a').after(dropdownToggle);

    let flag = false;
    container.on('touchstart click', '.sub-menu-toggle', function(e) {
        if (!flag) {
            flag = true;
            setTimeout(() => {
                flag = false;
            }, 100);
            const _this = $(this),
                screenReaderSpan = _this.find('.screen-reader-text');

            e.preventDefault();
            const _thisParent = _this.parent('.menu-item-has-children');
            if (_thisParent.hasClass('sub-active')) {
                _thisParent.removeClass('sub-active');
            } else {
                _thisParent.siblings().removeClass('sub-active');
                _thisParent.addClass('sub-active');
            }

            _this.attr('aria-expanded', _this.attr('aria-expanded') === 'false' ? 'true' : 'false');

            screenReaderSpan.text(
                screenReaderSpan.text() === main.navScreenReaderText.expand
                    ? main.navScreenReaderText.collapse
                    : main.navScreenReaderText.expand
            );
        }

        return false;
    });
};

export default initMainNavigation;
