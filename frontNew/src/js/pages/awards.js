(() => {
    // PAGES.ABOUT_PAGE
    let page = document.querySelector('.page');
    if (!page) return;

    const isAwardsPage = document.querySelector('.awards-page');
    if (!isAwardsPage) return;


    const awardsBlock = document.querySelector('.awards-page__content');
    const selectors = {
        controlItem: '.js-control-item',
        controlItemButton: '.js-control-item-button',
        blockItem: '.js-item',
        controlText: '.js-control-text',
        controlMore: '.js-control-more',
        body: '.awards-page__body',
    };

    const states = {
        active: 'active',
        filled: 'filled',
        filtered: 'filtered',

    }

    function awardFilter($element, pagesize = 6) {
        if (!$element || !$element.classList.contains('awards-page__content')) return;
        const $controlFilterItems = $element.querySelectorAll(selectors.controlItemButton)

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
                <div class="js-item col col-12 col-md-6">
                    <a class="awards-page__item" href="${item.link}">
                      <div class="awards-page__item__image"><img src="${item.image}" alt="#"></div>
                      <div class="awards-page__item__text">
                        <div class="awards-page__item__title">${item.title}</div>
                        <div class="awards-page__item__description">${item.description}</div>
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

    awardFilter(awardsBlock, 8)
})()
