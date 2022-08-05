(() => {
    // PART.VACANT
    const selectors = {
        controlItemButton: '.js-control-item-button',
        blockItem: '.js-item',
        searchInput: '.js-input-search',
        searchField: '.js-input-search-field',
        searchClear: '.js-input-search-clear',
        controlText: '.js-control-text',
        controlMore: '.js-control-more',
        body: '.vacancies-vacant__body',
    };

    const states = {
        active: 'active',
        filled: 'filled',
        filtered: 'filtered',

    }

    function vacant($element, pagesize = 6) {
        if (!$element || !$element.classList.contains('vacant')) return;

        const $controlFilterItems = $element.querySelectorAll(selectors.controlItemButton)

        const $searchInput = $element.querySelector(selectors.searchInput)
        const $searchField = $element.querySelector(selectors.searchField)
        const $searchInputClear = $element.querySelector(selectors.searchClear)
        const $body = $element.querySelector(selectors.body)
        const pagesizeAttr = $element.dataset.pageSize
        let fullLength = $element.dataset.fullLength
        let formUrl = $element.dataset.action
        let formMethod = $element.dataset.method
        const $controlTextBlock = $element.querySelector(selectors.controlText)
        const $controlMoreBtn = $element.querySelector(selectors.controlMore)
        let currentPage = 1;


        setMoreBtn(fullLength, currentPage, pagesizeAttr)
        setControlText(fullLength, currentPage, pagesizeAttr)


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

        $controlMoreBtn.addEventListener('click', function () {
            let filterblock = getFiltersArray(false)
            getData(filterblock)
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
                data.items.forEach(item => {
                    html += `
                    <div class="js-item col col-12 col-sm-6 col-md-4" >
                        <a class="vacancies-vacant__item" href="${item.link}">
                        <div class="vacancies-vacant__item__subtitle">${item.subtitle}</div>
                        <div class="vacancies-vacant__item__title">${item.title}</div>
                        <div class="vacancies-vacant__item__icon">
                                <svg width="58" height="44">
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
                $body.insertAdjacentHTML('beforeend',html)

            }
        }


        function getFiltersArray(first = true) {
            if (first) {
                currentPage = 1
            } else {
                ++currentPage
            }
            return {
                query: $searchInput.value ? $searchInput.value : null,
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

    window.components = window.components || {};
    window.components.vacant = vacant;
})();
