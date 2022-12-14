(() => {
    // PAGES.ABOUT_PAGE
    let page = document.querySelector('.page');
    if (!page) return;

    const ispresscorpPage = document.querySelector('.press-corp');
    if (!ispresscorpPage) return;


    const presscorpBlock = document.querySelector('.presscorp-page__content');
    const selectors = {
        controlItem: '.js-control-item',
        controlItemButton: '.js-control-item-button',
        blockItem: '.js-item',
        searchInput: '.js-input-search',
        searchField: '.js-input-search-field',
        searchClear: '.js-input-search-clear',
        filterProd: '.presscorp-page__select',
        controlText: '.js-control-text',
        controlMore: '.js-control-more',
        body: '.presscorp-page__body',
    };

    const states = {
        active: 'active',
        filled: 'filled',
        filtered: 'filtered',

    }

    page.addEventListener('click', e => {
        if(presscorpBlock.querySelectorAll(selectors.filterProd).length > 0 && !e.target.closest('.show')) {
            presscorpBlock.querySelectorAll(selectors.filterProd)[0].classList.remove('show')
        }
    })


    function presscorpFilter($element, pagesize = 6) {
        if (!$element || !$element.classList.contains('presscorp-page__content')) return;
        const $controlFilterItems = $element.querySelectorAll(selectors.controlItemButton)

        const $body = $element.querySelector(selectors.body)
        let fullLength = $element.dataset.fullLength
        let formUrl = $element.dataset.action
        let formMethod = $element.dataset.method
        let isMobailPage = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) ? 6 : 12
        let pagesizeAttr = isMobailPage
        const $controlTextBlock = $element.querySelector(selectors.controlText)
        const $controlMoreBtn = $element.querySelector(selectors.controlMore)
        let currentPage = 1;

        setMoreBtn(fullLength, currentPage, pagesizeAttr)
        setControlText(fullLength, currentPage, pagesizeAttr)

        document.querySelectorAll('.close').forEach(item => {
            item.addEventListener('click', function (e) {
                $element.querySelectorAll('.controlls')[0].classList.remove('show')
                $element.querySelectorAll('.presscorp-page__active')[0].innerHTML = $element.querySelectorAll('.presscorp-page__selects [data-type="1"]')[0].innerHTML
            })
        })

        $controlFilterItems.forEach(item => {
            item.addEventListener('click', function () {
                if (!item.classList.contains(states.active)) {
                    $controlFilterItems.forEach(item => {
                        item.classList.remove(states.active)
                    })
                    item.classList.add(states.active)
                    let filterblock = getFiltersArray()
                    getData(filterblock)
                }
            })
        })

        $controlMoreBtn.addEventListener('click', function () {
            let filterblock = getFiltersArray(false)
            getData(filterblock)
        })

        function setMoreBtn(fullLength, page, pageSize) {
            if (page * pageSize < fullLength) {
                $controlMoreBtn.classList.add(states.active)
                if (fullLength - page * pageSize > pageSize) {
                    $controlMoreBtn.textContent = `?????? ${pageSize}`
                } else {
                    $controlMoreBtn.textContent = `?????? ${fullLength - page * pageSize}`
                }
            } else {
                $controlMoreBtn.classList.remove(states.active)
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
            data.items.forEach((item, index) => {
                if(isMobailPage > index) {
                    html += `
                    <div class="col col-12 col-sm-12 col-md-6">
                        <a class="presscorp-page__item" href="${item.link}">
                            <div class="presscorp-page__image"> 
                                <img class="presscorp-page__item__image" src="${item.image}">
                            </div>
                            <div class="presscorp-page__content">
                                <div class="presscorp-page__item__title">${item.title}</div>
                                <div class="presscorp-page__item__date">${item.date}</div>
                                <button class="btn btn-primary-inverse btn-lg m-b">
                                    <div class="btn-icon">
                                        <svg width="22" height="18">
                                            <use xlink:href="#i-upload-item" href="#i-upload-item"></use>
                                        </svg>
                                    </div>?????????????? PDF
                                </button>
                            </div>
                        </a>
                    </div>
                    `
                }
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

        function getFiltersArray(first = true) {
            if (first) {
                currentPage = 1
            } else {
                ++currentPage
            }
            return {
                query: null,
                filter_type: $element.querySelector(selectors.controlItemButton + '.active').dataset.type ? $element.querySelector(selectors.controlItemButton + '.active').dataset.type : null,
                page: currentPage
            }
        }

        function setControlText(fullLength, page, pageSize) {

            if (page * pageSize < fullLength) {
                $controlTextBlock.textContent = `???????????????? ${+page * +pageSize} ???? ${fullLength}`
            } else {
                $controlTextBlock.textContent = `???????????????? ${fullLength} ???? ${fullLength}`
            }
        }

        function checkFilled($element, value) {
            if (value) {
                $element.classList.add(states.filled)
            } else {
                $element.classList.remove(states.filled)
            }
        }

        function checkFilled($element, value) {
            if (value) {
                $element.classList.add(states.filled)
            } else {
                $element.classList.remove(states.filled)
            }
        }

    }

    presscorpFilter(presscorpBlock, 8)
})()
