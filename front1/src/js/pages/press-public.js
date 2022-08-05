(() => {
    // PAGES.ABOUT_PAGE
    let page = document.querySelector('.page');
    if (!page) return;

    const ispresspublicPage = document.querySelector('.press-public');
    if (!ispresspublicPage) return;


    const presspublicBlock = document.querySelector('.presspublic-page__content');
    const selectors = {
        controlItem: '.js-control-item',
        controlItemButton: '.js-control-item-button',
        blockItem: '.js-item',
        searchInput: '.js-input-search',
        searchField: '.js-input-search-field',
        searchClear: '.js-input-search-clear',
        filterProd: '.presspublic-page__select',
        controlText: '.js-control-text',
        controlMore: '.js-control-more',
        body: '.presspublic-page__body',
    };

    const states = {
        active: 'active',
        filled: 'filled',
        filtered: 'filtered',

    }

    page.addEventListener('click', e => {
        if(presspublicBlock.querySelectorAll(selectors.filterProd).length > 0 && !e.target.closest('.show')) {
            presspublicBlock.querySelectorAll(selectors.filterProd)[0].classList.remove('show')
        }
    })


    function presspublicFilter($element, pagesize = 6) {
        if (!$element || !$element.classList.contains('presspublic-page__content')) return;
        const $controlFilterItems = $element.querySelectorAll(selectors.controlItemButton)

        const $body = $element.querySelector(selectors.body)
        const $searchInput = $element.querySelector(selectors.searchInput)
        const $searchField = $element.querySelector(selectors.searchField)
        const $searchInputClear = $element.querySelector(selectors.searchClear)
        const $filterProd = $element.querySelectorAll(selectors.filterProd)
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

        $filterProd.forEach(item => {
            item.addEventListener('click', function (e) {
                if(e.target.classList.contains('presspublic-page__select_button')) {
                    $element.querySelectorAll('.presspublic-page__active')[0].innerHTML = e.target.innerHTML
                }
                if(!e.target.closest('.close')) {
                    e.target.closest('.presspublic-page__select').classList.toggle('show')
                    e.target.closest('.presspublic-page__select').querySelectorAll('.controlls')[0].classList.add('show')
                }
            })
        })

        document.querySelectorAll('.close').forEach(item => {
            item.addEventListener('click', function (e) {
                $element.querySelectorAll('.controlls')[0].classList.remove('show')
                $element.querySelectorAll('.presspublic-page__active')[0].innerHTML = $element.querySelectorAll('.presspublic-page__selects [data-type="1"]')[0].innerHTML
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
                    $controlMoreBtn.textContent = `Еще ${pageSize}`
                } else {
                    $controlMoreBtn.textContent = `Еще ${fullLength - page * pageSize}`
                }
            } else {
                $controlMoreBtn.classList.remove(states.active)
            }
        }

        $searchInput.addEventListener('input', function () {
            checkFilled($searchField, this.value)
            let filterblock = getFiltersArray()
            getData(filterblock)
        })

        $searchInputClear.addEventListener('click', function () {
            $searchInput.value = ''
            checkFilled($searchField, $searchInput.value)
            let filterblock = getFiltersArray()
            getData(filterblock)
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
                    <div class="col col-12 col-sm-6 col-md-4">
                        <a class="presspublic-page__item" href="${item.link}">
                            <div class="presspublic-page__item__date">${item.date}</div>
                            <div class="presspublic-page__item__title">${item.title}</div>
                            <div class="presspublic-page__item__auth"> 
                                <svg width="15" height="15">
                                    <use xlink:href="#i-auth" href="#i-auth"></use>
                                </svg>
                                <div class="presspublic-page__item__text">${item.name}</div>
                            </div>
                            <div class="presspublic-page__item__locale">
                                <svg width="17" height="13">
                                    <use xlink:href="#i-locale" href="#i-locale"></use>
                                </svg>
                                <div class="presspublic-page__item__text">${item.locale}</div>
                            </div>
                        </a>
                    </div>
                    `
                }
            })
            fullLength = data.size

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
                $controlTextBlock.textContent = `Показано ${+page * +pageSize} из ${fullLength}`
            } else {
                $controlTextBlock.textContent = `Показано ${fullLength} из ${fullLength}`
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

    presspublicFilter(presspublicBlock, 8)
})()
