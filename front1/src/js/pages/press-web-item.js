(() => {
    // PAGES.ABOUT_PAGE
    let page = document.querySelector('.page');
    if (!page) return;

    const isPresswebItemPage = document.querySelector('.pressweb-item-page');
    if (!isPresswebItemPage) return;

    if(document.getElementById('player')) {
        const player = new Plyr('#player')
    }

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
