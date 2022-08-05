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
        body: '.js-body',
        select: '.js-select',
    };

    const states = {
        active: 'active',
        filled: 'filled',
        filtered: 'filtered',

    }

    function formvideo($element, pagesize = 6, setItems) {
        if (!$element || !$element.classList.contains('form-js')) return;

        const $controlFilterItems = $element.querySelectorAll(selectors.controlItemButton)

        const $searchInput = $element.querySelector(selectors.searchInput)
        const $searchField = $element.querySelector(selectors.searchField)
        const $searchInputClear = $element.querySelector(selectors.searchClear)
        const $body = $element.querySelector(selectors.body)
        const $select = $element.querySelectorAll(selectors.select)
        const pagesizeAttr = $element.dataset.pageSize
        let fullLength = $element.dataset.fullLength
        let formUrl = $element.dataset.action
        let formMethod = $element.dataset.method
        const $controlTextBlock = $element.querySelector(selectors.controlText)
        const $controlMoreBtn = $element.querySelector(selectors.controlMore)
        let currentPage = 1;
        $select.forEach(item => {
            item.addEventListener('click', () => {
                checkFilled($searchField, item.value)
                let filterblock = getFiltersArray()
                getData(filterblock)
            })
        })

        setMoreBtn(fullLength, currentPage, pagesizeAttr)
        setControlText(fullLength, currentPage, pagesizeAttr)

        if($searchInput){

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
        }

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
                        setItems(data, setMoreBtn, currentPage, pagesizeAttr, setControlText, $body)
                    });
            } else {
                fetch(formUrl, {
                    method: formMethod,
                    body: formData
                })
                    .then((res) => res.json())
                    .then((data) => {
                        setItems(data, setMoreBtn, currentPage, pagesizeAttr, setControlText, $body)
                    });
            }
        }



        function getFiltersArray(first = true) {
            if (first) {
                currentPage = 1
            } else {
                ++currentPage
            }
            const data = {}
            if($searchInput){
                data.query = $searchInput.value ? $searchInput.value : null;
            }
            data.page= currentPage
            return data
        }

        function setControlText(fullLength, page, pageSize) {
            if (page * pageSize < fullLength) {
                $controlTextBlock.textContent = `Показано ${+page * +pageSize} из ${fullLength}`
            } else {
                $controlTextBlock.textContent = `Показано ${fullLength} из ${fullLength}`
            }
        }


        function checkFilled($element, value) {
            if($element){

                if (value) {
                    $element.classList.add(states.filled)
                } else {
                    $element.classList.remove(states.filled)
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

    window.components = window.components || {};
    window.components.formvideo = formvideo;
})();
