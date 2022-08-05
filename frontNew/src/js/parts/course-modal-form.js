(() => {
    var $CourseModal = document.getElementById('course-modal');
    if (!$CourseModal) return;
    var modal = components.modal($CourseModal);
    var triggers = document.querySelectorAll('[data-course-modal]');
    triggers.forEach(function (el) {
        el.addEventListener('click', function () {
            return modal.show();
        });
    });
    var courseModalForm = document.getElementById('course-modal-form');

    if (courseModalForm) {
        var $submit = courseModalForm.querySelector('[type="submit"]');
        var validator = utils.validator(courseModalForm, {
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
            position: {
                required: {
                    message: 'Обязательное поле'
                }
            },
            license: {
                required: {
                    message: 'Обязательное поле'
                }
            },
            question: {
                required: {
                    message: 'Обязательное поле'
                }
            },
            support: {
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
        }, {
            parent: '.form-field',
            submit: function submit() {
                courseModalForm.classList.add('pending');
                if ($submit) $submit.disabled = true;
                utils.submitForm(courseModalForm, function (response) {
                    if ($submit) $submit.disabled = false;
                    courseModalForm.classList.remove('pending');

                    if (response.success) {
                        if (parts.successModal) {
                            parts.successModal.show();
                        }
                    } else {
                        console.error(response);
                    }
                });
            }
        });
    }


    window.parts = window.parts || {};
    window.parts.courseModalForm = modal;
})();
