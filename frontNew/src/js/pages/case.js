document.addEventListener('DOMContentLoaded', () => {
    (() => {
        // PAGES.ABOUT_PAGE
        let page = document.querySelector('.page');
        if (!page) return;

        const isCasePage = document.querySelector('.case-page');
        if (!isCasePage) return;

        const rightArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
              </svg>`;

        const leftArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
              </svg>`;

        var aboutTeamSlider = tns({
            container: '.about-team-slider',
            navContainer: "#about-team-slider-thumbnails",
            navAsThumbnails: true,
            items: 1,
            touch: true,
            mouseDrag: true,
            preventScrollOnTouch: "inner",
            slideBy: 1,
            controls: true,
            autoplay: false,
            controlsPosition: 'bottom',
            controlsText: [leftArrow, rightArrow]
        });


        var catalogSertSlider = tns({
            container: '.js-partner-slider-1',
            items: 1,
            nav: false,
            touch: true,
            mouseDrag: true,
            loop: false,
            preventScrollOnTouch: "inner",
            slideBy: 1,
            gutter: 20,
            controls: true,
            autoplay: false,
            controlsPosition: 'bottom',
            controlsContainer: document.querySelector('.js-slider-control-1'),
            controlsText: [leftArrow, rightArrow],
            responsive: {
                640: {
                    items: 1,
                    gutter: 30,
                },
                1020: {
                    items: 1,
                    gutter: 40,
                },
            }

        });

        const contactForm = document.getElementById('home-contact-form');
        if (contactForm) {
            let $submit = contactForm.querySelector('[type="submit"]');
            let validator = utils.validator(
                contactForm,
                {
                    name: {
                        required: {
                            message: 'Обязательное поле'
                        }
                    },
                    company: {
                        required: {
                            message: 'Обязательное поле'
                        }
                    },
                    email: {
                        required: {
                            message: 'Обязательное поле'
                        },
                        email: {
                            message: 'Некорректный формат'
                        }
                    },
                    phone: {
                        required: {
                            message: 'Обязательное поле'
                        },
                        mask: {
                            re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
                            message: 'Некорректный формат'
                        }
                    },
                    agreement: {
                        required: {
                            message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
                        }
                    }
                },
                {
                    parent: '.form-field',
                    submit: () => {
                        contactForm.classList.add('pending');
                        if ($submit) $submit.disabled = true;
                        utils.submitForm(contactForm, (response) => {
                            contactForm.classList.remove('pending');
                            if ($submit) $submit.disabled = false;
                            if (response.success) {
                                if (parts.successModal) {
                                    parts.successModal.show();
                                }
                            } else {
                                console.error(response);
                            }
                        });
                    }
                }
            );
        }
    })()
})