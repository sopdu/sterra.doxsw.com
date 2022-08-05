(() => {
    // PAGES.ABOUT_PAGE
    let page = document.querySelector('.page');
    if (!page) return;

    const ispresseventPage = document.querySelector('.press-event');
    if (!ispresseventPage) return;


    const presseventBlock = document.querySelector('.pressevent-page__content');
    const selectors = {
        controlItem: '.js-control-item',
        controlItemButton: '.js-control-item-button',
        blockItem: '.js-item',
        searchInput: '.js-input-search',
        searchField: '.js-input-search-field',
        searchClear: '.js-input-search-clear',
        filterProd: '.pressevent-page__select',
        controlText: '.js-control-text',
        controlMore: '.js-control-more',
        body: '.pressevent-page__body',
    };

    const states = {
        active: 'active',
        filled: 'filled',
        filtered: 'filtered',

    }

    page.addEventListener('click', e => {
        if(presseventBlock.querySelectorAll(selectors.filterProd).length > 0 && !e.target.closest('.show')) {
            presseventBlock.querySelectorAll(selectors.filterProd)[0].classList.remove('show')
        }
    })


    function presseventFilter($element, pagesize = 6) {
        if (!$element || !$element.classList.contains('pressevent-page__content')) return;
        const $controlFilterItems = $element.querySelectorAll(selectors.controlItemButton)

        const $body = $element.querySelector(selectors.body)
        const $searchInput = $element.querySelector(selectors.searchInput)
        const $searchField = $element.querySelector(selectors.searchField)
        const $searchInputClear = $element.querySelector(selectors.searchClear)
        const $filterProd = $element.querySelectorAll(selectors.filterProd)
        let fullLength = $element.dataset.fullLength
        let formUrl = $element.dataset.action
        let formMethod = $element.dataset.method
        const $controlTextBlock = $element.querySelector(selectors.controlText)
        const $controlMoreBtn = $element.querySelector(selectors.controlMore)
        let currentPage = 1;
        let isMobailPage = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) ? 6 : 12
        let pagesizeAttr = isMobailPage

        setMoreBtn(fullLength, currentPage, pagesizeAttr)
        setControlText(fullLength, currentPage, pagesizeAttr)

        $filterProd.forEach(item => {
            item.addEventListener('click', function (e) {
                if(e.target.classList.contains('pressevent-page__select_button')) {
                    $element.querySelectorAll('.pressevent-page__active')[0].innerHTML = e.target.innerHTML
                }
                if(!e.target.closest('.close')) {
                    e.target.closest('.pressevent-page__select').classList.toggle('show')
                    e.target.closest('.pressevent-page__select').querySelectorAll('.controlls')[0].classList.add('show')
                }
            })
        })

        $controlMoreBtn.addEventListener('click', function () {
            let filterblock = getFiltersArray(false)
            getData(filterblock)
        })

        document.querySelectorAll('.close').forEach(item => {
            item.addEventListener('click', function (e) {
                $element.querySelectorAll('.controlls')[0].classList.remove('show')
                $element.querySelectorAll('.pressevent-page__active')[0].innerHTML = $element.querySelectorAll('.pressevent-page__selects [data-type="1"]')[0].innerHTML
            })
        })

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
                    <div class="col col-12 col-sm-6 col-md-3">
                        <a class="pressevent-page__item" href="${item.link}">
                            <img class="pressevent-page__item__image" src="${item.img}">
                            <div class="pressevent-page__item__date">${item.date}</div>
                            <div class="pressevent-page__item__title">${item.title}</div>
                            <div class="pressevent-page__item__locale">
                                <svg width="10" height="10">
                                    <use xlink:href="#i-${item.icon}" href="#i-pc"></use>
                                </svg>
                                <div class="pressevent-page__item__text">${item.locale}</div>
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

        function setControlText(fullLength, page, pageSize) {

            if (page * pageSize < fullLength) {
                $controlTextBlock.textContent = `Показано ${+page * +pageSize} из ${fullLength}`
            } else {
                $controlTextBlock.textContent = `Показано ${fullLength} из ${fullLength}`
            }
        }

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

    presseventFilter(presseventBlock, 8)
})()
