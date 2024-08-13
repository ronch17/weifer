import initMainNavigation from '../lib/init-main-navigation';
import 'slick-carousel';
import ScrollReveal from 'scrollreveal';
import Lottie from 'lottie-web';
import forex from '../lotties-json-files/forex.json'
import wallet from '../lotties-json-files/wallet.json'
import commodities from '../lotties-json-files/commodities.json'
import equities from '../lotties-json-files/equities.json'
import indices from '../lotties-json-files/indices.json'
import heroRobot from '../lotties-json-files/hero-robot.json'

export default {
    init() {
        // JavaScript to be fired on all pages
    },
    finalize() {
        // JavaScript to be fired on all pages, after page specific JS is fired

        // Add toggle-sub-menu button to main navigation links with children
        initMainNavigation($('.topNavigation'));

        // Closing Login Popup on mobile when clicked outside
        const $loginPopup = '#loginPopup';
        $(document).click(function(e) {
            if ($(window).outerWidth() < 1199) {
                if (!$(e.target).parents($loginPopup).length > 0) {
                    $($loginPopup).collapse('hide');
                }
            }
        });

        // Toggles transparency background of top bar when scrolling has started (beyond 10px)
        const $stickies = $('.prfwp-header'),
            $window = $(window);
        let lastScrollTop = 0;
        $window
            .scroll(() => {
                if ($window.scrollTop() >= 10) {
                    $stickies.addClass('sticky');
                    // workaround to prevent sticky header from flickering on edge of the position
                    if ($window.scrollTop() >= 50) {
                        $stickies.addClass('no-padding');
                    } else if ($window.scrollTop() <= 10) {
                        $stickies.removeClass('no-padding');
                    }
                } else {
                    $stickies.removeClass('sticky');
                }

                const st = $window.scrollTop();
                if (st > lastScrollTop) {
                    if ($('.prfwp-burger').hasClass('collapsed')) {
                        $stickies.removeClass('show-nav');
                    }
                } else {
                    $stickies.addClass('show-nav');
                }
                lastScrollTop = st;
            })
            .scroll();

        // Adding target self to enable anchor linking (which was prevented by Angular)
        $('.menu-item.self a').attr('target', '_self');

        // Run animation when element is inView
        const $animations = $('.js-anim');
        if ($animations.length) {
            $animations.each((index, animationContainer) => {
                $(animationContainer).addClass('js-anim-paused');
                $(animationContainer).one('inview', (event, isInView) => {
                    if (isInView) {
                        setTimeout(() => {
                            $(animationContainer).toggleClass('js-anim-paused js-anim-run');
                        }, 100);
                    }
                });
            });
        }

        // Open Account Switcher
        const $placeholderBody = $('#open_account_placeholder'),
            $placeholderLeft = $('.acfm-login-placeholder__left'),
            $placeholderRight = $('.acfm-login-placeholder__right'),
            $placeholderBtn = $('.acfm-login-placeholder__button');

        $placeholderRight.hide();
        $placeholderBtn.click(function() {
            if (!$placeholderBody.hasClass('right')) {
                $placeholderBody.addClass('right');
                $placeholderLeft.fadeOut();
                $placeholderRight.fadeIn();
            } else {
                $placeholderBody.removeClass('right');
                $placeholderRight.fadeOut();
                $placeholderLeft.fadeIn();
            }
        });

        // Numbers animation for counters
        const $counterSection = $('.acfm-list-numbers');
        $counterSection.one('inview', function() {
            $('.acfm-list-numbers__title span').each(function() {
                $(this)
                    .prop('Counter', 0)
                    .animate(
                        {
                            Counter: $(this)
                                .text()
                                .match(/^\d*\.?\d*$/),
                        },
                        {
                            duration: 4000,
                            easing: 'swing',
                            step: function(now) {
                                $(this).text(Math.ceil(now).toLocaleString());
                            },
                        }
                    );
                $counterSection.off('inview');
            });
        });

        // Footer Accordion
        const $footerLink = $('.acfm-footer-menu__anchor'),
            $footerContent = $('.acfm-footer-menu__menu');
        if ($(window).outerWidth() < 768) {
            $footerLink.click(function() {
                const currentAttr = $(this).attr('href');
                if ($(this).is('.active')) {
                    $(this).removeClass('active');
                    $footerContent.slideUp(300);
                } else {
                    $footerLink
                        .removeClass('active')
                        .filter(this)
                        .addClass('active');
                    $footerContent
                        .slideUp(300)
                        .filter(currentAttr)
                        .slideDown(300);
                }
            });
        }

        // Material animation for buttons
        const btn = document.querySelectorAll('.acfm-ripple');
        btn.forEach(el => {
            el.style.position = 'relative';
            el.style.overflow = 'hidden';
            el.addEventListener('click', function(e) {
                const x = e.offsetX,
                    y = e.offsetY,
                    ripples = document.getElementsByClassName('ripple');

                if (ripples.length < 10) {
                    // this restricts the user from creating lots of ripples
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple');
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    this.appendChild(ripple);

                    setTimeout(function() {
                        ripple.remove();
                    }, 1000);
                }
            });
        });

        // Slick Slider initialize
        /* global main */
        $('.acfm-slider').slick({
            rtl: !!main.rtl,
            dots: true,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 6000,
            pauseOnHover: false,
            arrows: false,
            speed: 1300,
            slidesToShow: 1,
            slidesToScroll: 1,
        });


        const $accountTypes = $('.acfm-account-types');
        $accountTypes.slick({
            rtl: !!main.rtl,
            arrows: false,
            dots: true,
            customPaging: function(slider, i) {
                let $slideTitle = $(slider.$slides[i])
                    .find('li')
                    .attr('title');
                return '<button class="tab tab-title">' + $slideTitle + '</button>';
            },
            infinite: true,
            autoplay: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
            centerPadding: '',
            mobileFirst: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: 'unslick',
                },
            ],
        });


        const accSwitcher = document.querySelectorAll('.acfm-account-types__switcher');
        const firstGroup = document.querySelectorAll('.first-group');
        const secondGroup = document.querySelectorAll('.second-group');

        accSwitcher.forEach(item => {
            item.addEventListener('click', e => {
                if (!item.classList.contains('active')) {
                    accSwitcher.forEach(i => {
                        i.classList.remove('active');
                    });
                    item.classList.add('active');
                }

                if (item.classList.contains('switcher-first-group')) {
                    firstGroup.forEach(item => {
                        item.style.display = 'block';
                    });

                    secondGroup.forEach(item => {
                        item.style.display = 'none';
                    });
                }

                if (item.classList.contains('switcher-second-group')) {
                    firstGroup.forEach(item => {
                        item.style.display = 'none';
                    });

                    secondGroup.forEach(item => {
                        item.style.display = 'block';
                    });
                }
            });
            item.addEventListener('load', () => {
                if (item.classList.contains('switcher-first-group')) {
                    firstGroup.forEach(item => {
                        item.style.display = 'block';
                    });
                }
            });
        });

        const input = document.querySelector('.wpcf7-phonetext');
        console.log(input)

        function togglePlaceholder() {
            if (input.value) {
                input.setAttribute('placeholder', '');
            } else {
                input.setAttribute('placeholder', 'Enter your name');
            }
        }

        input.addEventListener('input', togglePlaceholder);
        input.addEventListener('blur', togglePlaceholder);
        input.addEventListener('focus', togglePlaceholder);

    },
};


var amountScrolled = 200;

$(window).scroll(function() {
    if ($(window).scrollTop() > amountScrolled) {
        $('button.back-to-top').addClass('show');
    } else {
        $('button.back-to-top').removeClass('show');
    }
});

$('button.back-to-top').click(function() {
    $('html, body').animate(
        {
            scrollTop: 0,
        },
        800
    );
    return false;
});

// scroll reveal

function revealFunction() {
    ScrollReveal().reveal('.fade-left-col', {
        origin: 'left',
        duration: 1200,
        distance: '50px',
        easing: 'ease-in-out',
        reset: false,
    });

    ScrollReveal().reveal('.fade-right-col', {
        origin: 'right',
        duration: 1200,
        distance: '50px',
        easing: 'ease-in-out',
        reset: false,
    });


    ScrollReveal().reveal('img.hero-img', {
        origin: 'right',
        duration: 1400,
        distance: '50px',
        easing: 'ease-in-out',
        reset: false,
    });

    ScrollReveal().reveal('.fade-up', {
        origin: 'bottom',
        duration: 1200,
        distance: '50px',
        easing: 'ease-in-out',
        reset: false,
    });

    ScrollReveal().reveal('.acfm-list-default__item', {
        origin: 'bottom',
        duration: 1200,
        distance: '50px',
        easing: 'ease-in-out',
        reset: false,
    });

    ScrollReveal().reveal('.card', {
        origin: 'center',
        duration: 1200,
        scale: 1,
        easing: 'ease-in-out',
        reset: false,
    });

    ScrollReveal().reveal('.currencies .acfm-image img', {
        origin: 'center',
        duration: 1200,
        scale: 1,
        easing: 'ease-in-out',
        reset: false,
    });

    ScrollReveal().reveal('.grow', {
        origin: 'center',
        duration: 1500,
        scale: 1,
        easing: 'ease-in-out',
        reset: false,
    });


    ScrollReveal().reveal('.grow-img', {
        origin: 'bottom',
        duration: 1200,
        easing: 'ease-in-out',
        reset: false,
    });

    ScrollReveal().reveal('.gallery', {
        origin: 'bottom',
        duration: 500,
        easing: 'ease-in-out',
        reset: false,
    });
}


window.addEventListener('load', () => {
    revealFunction();
    document.getElementById('page-loader').remove();
});

