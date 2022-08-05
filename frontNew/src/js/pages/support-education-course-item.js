(() => {
    // PAGES.ABOUT_PAGE
    let page = document.querySelector('.page');
    if (!page) return;

    const isSuppoerEducationCourseItem2Page = document.querySelector('.support-course-item:not(.support-course-item-2)');
    if (!isSuppoerEducationCourseItem2Page) return;

    const vacantForm = document.getElementById('vacant-form');
    if (vacantForm) {
        let $submit = vacantForm.querySelector('[type="submit"]');
        let validator = utils.validator(
            vacantForm,
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
                        message: 'Обязательное поле'
                    }
                }
            },
            {
                parent: '.form-field',
                submit: () => {
                    vacantForm.classList.add('pending');
                    if ($submit) $submit.disabled = true;
                    utils.submitForm(vacantForm, (response) => {
                        vacantForm.classList.remove('pending');
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
