(() => {
    var $PartnerModal = document.getElementById('partner-modal');
    if (!$PartnerModal) return;
    //attachment field
    const dropArea = document.getElementById('drop-area')
    const inputFile =  dropArea.querySelector('input[type="file"]')
    const dropAreaUploaded = document.getElementById('drop-area-uploaded')
    const removeAttachment = dropAreaUploaded.querySelector('svg')
    removeAttachment.addEventListener('click', () => {
        dropAreaUploaded.style.display = 'none'
        dropArea.style.display = 'flex'
        inputFile.value = ''
        if(!/safari/i.test(navigator.userAgent)){
            inputFile.type = ''
            inputFile.type = 'file'
        }
    })
    inputFile.addEventListener('change', function (e) {
        let file = this.files[0]
        if(file) {
            previewFile(file)
        }
    })
    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false)
    })
    function preventDefaults (e) {
        e.preventDefault()
        e.stopPropagation()
    }
    ;['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false)
    })
    ;['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false)
    })
    function highlight(e) {
        dropArea.classList.add('highlight')
    }
    function unhighlight(e) {
        dropArea.classList.remove('highlight')
    }

    dropArea.addEventListener('drop', handleDrop, false)
    function handleDrop(e) {
        inputFile.files = e.dataTransfer.files
        inputFile.dispatchEvent(event);
    }
    function previewFile(file) {
        let fileName = file.name
        dropArea.style.display = 'none'

        const nameField = dropAreaUploaded.querySelector('span')
        nameField.textContent = fileName
        dropAreaUploaded.style.display = 'block'
    }

    var modal = components.modal($PartnerModal);
    var triggers = document.querySelectorAll('[data-partner-modal]');
    triggers.forEach(function (el) {
        el.addEventListener('click', function () {
            return modal.show();
        });
    });
    var partnerModalForm = document.getElementById('partner-modal-form');

    if (partnerModalForm) {
        var $submit = partnerModalForm.querySelector('[type="submit"]');
        var validator = utils.validator(partnerModalForm, {
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
            numberinn: {
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
            attachment: {
                file: {
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
                partnerModalForm.classList.add('pending');
                if ($submit) $submit.disabled = true;
                utils.submitForm(partnerModalForm, function (response) {
                    if ($submit) $submit.disabled = false;
                    partnerModalForm.classList.remove('pending');

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
    window.parts.partnerModalForm = modal;
})();
