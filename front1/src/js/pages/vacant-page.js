    (() => {
        // PAGES.ABOUT_PAGE
        let page = document.querySelector('.page');
        if (!page) return;

        const isVacantPage = document.querySelector('.vacancy-page');
        if (!isVacantPage) return;

        var event = new Event('change');
        //datepicker
        const datepickers = document.querySelectorAll('.js-datepicker')
        datepickers.forEach(item => {
            let datepicker = new Datepicker(item, {
                language: 'ru',

            })
        })


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
                    yearold: {
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
