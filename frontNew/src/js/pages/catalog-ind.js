(() => {
    // PAGES.ABOUT_PAGE
    let page = document.querySelector('.page');
    if (!page) return;

    const isCatalogComplPage = document.querySelector('.catalog-ind-page');
    if (!isCatalogComplPage) return;


    const catalogComplBlock = document.querySelector('.js-catalog');
    const selectors = {
        controlItem: '.js-control-item',
        blockItem: '.js-item',
        controlText: '.js-control-text',
        controlMore: '.js-control-more',
        body: '.catalog-block__body',
    };

    const states = {
        active: 'active',
        filled: 'filled',
        filtered: 'filtered',
    }

    function catalogCompileFilter($element, pagesize = 9) {
        if (!$element || !$element.classList.contains('js-catalog')) return;

        const $body = $element.querySelector(selectors.body)
        let pagesizeAttr = null;
        if(window.innerWidth < 768){
            pagesizeAttr = $element.dataset.pageSizeMobile
        } else {

            pagesizeAttr = $element.dataset.pageSize
        }
        let fullLength = $element.dataset.fullLength
        let formUrl = $element.dataset.action
        let formMethod = $element.dataset.method
        const $controlTextBlock = $element.querySelector(selectors.controlText)
        const $controlMoreBtn = $element.querySelector(selectors.controlMore)
        let currentPage = 1;


        setMoreBtn(fullLength, currentPage, pagesizeAttr)
        setControlText(fullLength, currentPage, pagesizeAttr)



        $controlMoreBtn.addEventListener('click', function () {
            let filterblock = getFiltersArray(false)
            getData(filterblock)
        })


        function getFiltersArray(first = true) {
            if (first) {
                currentPage = 1
            } else {
                ++currentPage
            }
            return {
                page: currentPage
            }
        }
        function getData(filterblock) {
            let formData = new FormData()

            for (const filterblockKey in filterblock) {
                formData.append(filterblockKey, filterblock[filterblockKey])
            }
            if (formMethod.toUpperCase() === 'GET') {
                let params = new URLSearchParams(formData).toString();
                fetch(formUrl + '?' + params)
                    .then((res) => res.json())
                    .then((data) => {

                        setItems(data)
                    });
            } else {
                fetch(formUrl, {
                    method: formMethod,
                    body: formData
                })
                    .then((res) => res.json())
                    .then((data) => {
                        setItems(data)
                    });
            }
        }

        function setItems(data) {
            let html = ''
            let items = data.items;
            if(data.items.length > pagesize){
                items = data.items.slice(0, pagesize);
            }
            items.forEach(item => {
                html += `
                <div class="js-item col col-12 col-md-6">
                    <a class="catalog-block__item" href="${item.link}">
                        <div class="block__item__title">${item.title}</div>
                        <div class="block__item__description">${item.description}</div>
                        <div class="catalog-block__item__icon">
                                <svg width="66" height="66">
                                  <use xlink:href="#i-${item.icon}"></use>
                                </svg>
                        </div>
                  </a>
              </div>
              `
            })
            fullLength = data.size
            setMoreBtn(fullLength, currentPage, pagesizeAttr)
            setControlText(fullLength, currentPage, pagesizeAttr)
            if (currentPage === 1) {
                $body.innerHTML = html
            } else {
                $body.insertAdjacentHTML('beforeend', html)
            }
        }



        function setControlText(fullLength, page, pageSize) {

            if(page == 1 && fullLength <= pageSize){
                $controlTextBlock.style.display = 'none'
            } else {
                if (page * pageSize < fullLength) {
                    $controlTextBlock.textContent = `Показано ${+page * +pageSize} из ${fullLength}`
                } else {
                    $controlTextBlock.textContent = `Показано ${fullLength} из ${fullLength}`
                }
            }
        }



        function setMoreBtn(fullLength, page, pageSize) {


            if (page * pageSize < fullLength) {
                $controlMoreBtn.classList.add(states.active)
                if (fullLength - page * pageSize > pagesize) {
                    $controlMoreBtn.textContent = `Еще ${pagesize}`
                } else {
                    $controlMoreBtn.textContent = `Еще ${fullLength - page * pageSize}`
                }
            } else {
                $controlMoreBtn.classList.remove(states.active)
            }
        }


    }
    if(window.innerWidth < 768){
        catalogCompileFilter(catalogComplBlock, 5)
    } else {
        catalogCompileFilter(catalogComplBlock, 9)
    }


    const rightArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
              </svg>`;

    const leftArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
              </svg>`;




    var catalogSertSlider = tns({
        container: '.js-sert-slider-1',
        items: 1,
        nav: false,
        touch: true,
        mouseDrag: true,
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
                items: 2,
                gutter: 30,
            },
            1020: {
                items: 3,
                gutter: 40,
            },
        }

    });



    var catalogSert2Slider = tns({
        container: '.js-sert-slider-2',
        items: 1,
        nav: false,
        touch: true,
        mouseDrag: true,
        preventScrollOnTouch: "inner",
        slideBy: 1,
        gutter: 20,
        controls: true,
        autoplay: false,
        controlsPosition: 'bottom',
        controlsContainer: document.querySelector('.js-slider-control-2'),
        controlsText: [leftArrow, rightArrow],
        responsive: {
            640: {
                items: 2,
                gutter: 30,
            },
            1020: {
                items: 3,
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
