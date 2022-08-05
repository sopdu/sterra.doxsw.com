(() => {
    // PAGES.HOME_PAGE
    let page = document.querySelector('.cases-page');
    if (!page) return;


        const items = document.querySelectorAll('.partner-history-slider__item')
        const itemsLengthFull = items.length
        items.forEach((item, index) => {
            if(index < 6){
                item.classList.add('showed')
            } else {
                item.style.display = 'none'
            }
        })
        const more = document.querySelector('.js-control-more-cases')
        const text = document.querySelector('.js-control-text-cases')
        const block = document.querySelector('.js-control-text-cases-show')
        if(itemsLengthFull < 6){
            block.style.display = 'none'
        } else {
            more.style.display = 'block'
            if(itemsLengthFull - 6 > 6){

                more.textContent = 'Еще 6'
            } else {

                more.textContent = `Еще ${itemsLengthFull - 6}`
            }
        }

        text.innerHTML = `Показано 6 из ${itemsLengthFull}`
        more.addEventListener('click', () => {

            const items = document.querySelectorAll('.partner-history-slider__item:not(.showed)')
            const itemsLengthFull = items.length
            items.forEach((item, index) => {
                if(index < 6){
                    item.classList.add('showed')
                    item.style.display = 'flex'
                } else {
                    item.style.display = 'none'
                }
            })
            const more = document.querySelector('.js-control-more-cases')
            const text = document.querySelector('.js-control-text-cases')
            const block = document.querySelector('.js-control-text-cases-show')
            if(itemsLengthFull < 6){
                block.style.display = 'none'
            } else {
                more.style.display = 'block'
                if(itemsLengthFull - 6 >= 6){

                    more.textContent = 'Еще 6'
                } else {

                    more.textContent = `Еще ${itemsLengthFull - 6}`
                }
                if(itemsLengthFull - 6 == 0){

                    more.style.display = 'none'
                }
            }

            const itemsShowed = document.querySelectorAll('.partner-history-slider__item.showed')
            const itemsFull = document.querySelectorAll('.partner-history-slider__item')
            text.innerHTML = `Показано ${itemsShowed.length} из ${itemsFull.length}`
        })


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

})();
