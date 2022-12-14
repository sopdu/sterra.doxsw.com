

var callback = function () {
    (() => {
        // PAGES.ABOUT_PAGE
        let page = document.querySelector('.page');
        if (!page) return;

        const ispressmarkPage = document.querySelector('.press-mark');
        if (!ispressmarkPage) return;


        const pressmarkBlock = document.querySelector('.pressmark-page__content');
        const selectors = {
            controlItem: '.js-control-item',
            controlItemButton: '.js-control-item-button',
            blockItem: '.js-item',
            searchInput: '.js-input-search',
            searchField: '.js-input-search-field',
            searchClear: '.js-input-search-clear',
            filterProd: '.pressmark-page__select',
            controlText: '.js-control-text',
            controlMore: '.js-control-more',
            body: '.pressmark-page__body',
        };

        const states = {
            active: 'active',
            filled: 'filled',
            filtered: 'filtered',

        }

        page.addEventListener('click', e => {
            if(pressmarkBlock.querySelectorAll(selectors.filterProd).length > 0 && !e.target.closest('.show')) {
                pressmarkBlock.querySelectorAll(selectors.filterProd)[0].classList.remove('show')
            }
        })


        function pressmarkFilter($element, pagesize = 6) {
            if (!$element || !$element.classList.contains('pressmark-page__content')) return;
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

            //setMoreBtn(fullLength, currentPage, pagesizeAttr)
            setControlText(fullLength, currentPage, pagesizeAttr)

            document.querySelectorAll('.close').forEach(item => {
                item.addEventListener('click', function (e) {
                    $element.querySelectorAll('.controlls')[0].classList.remove('show')
                    $element.querySelectorAll('.pressmark-page__active')[0].innerHTML = $element.querySelectorAll('.pressmark-page__selects [data-type="1"]')[0].innerHTML
                })
            })

            $controlFilterItems.forEach(item => {
                if (item.classList.contains('active') && item.getAttribute('data-type') == '46') $body.classList.add('corp');
                else $body.classList.remove('corp');
                item.addEventListener('click', function () {
                    if (!item.classList.contains(states.active)) {

                        $controlFilterItems.forEach(item => {
                            item.classList.remove(states.active)
                        })
                        item.classList.add(states.active)
                        tab = item.getAttribute('data-tab');
                        history.pushState(null, null, '?tab='+tab);
                        document.querySelector('.pressmark-page__content__button a').setAttribute('href', '/materials-'+tab+'.zip')
                        let filterblock = getFiltersArray();
                        if (this.getAttribute('data-type') == '46') {
                            $body.classList.add('corp');
                            getData(filterblock, 'ZIP')
                        }
                        else {
                            $body.classList.remove('corp');
                            getData(filterblock, 'PDF')
                        }


                    }
                })
            })

            /*$controlMoreBtn.addEventListener('click', function () {
                let filterblock = getFiltersArray(false)
                getData(filterblock)
            })*/

           /* function setMoreBtn(fullLength, page, pageSize) {
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
            }*/

            function getData(filterblock, file = '') {
                let formData = new FormData()

                for (const filterblockKey in filterblock) {
                    formData.append(filterblockKey, filterblock[filterblockKey])
                }
                if (formMethod.toUpperCase() === 'GET') {
                    let params = new URLSearchParams(formData).toString();
                    fetch(formUrl + '?' + params)
                        .then((res) => res.json())
                        .then((data) => {
                            setItems(data, file)
                        });
                } else {
                    fetch(formUrl, {
                        method: formMethod,
                        body: formData
                    })
                        .then((res) => res.json())
                        .then((data) => {
                            setItems(data, file)
                        });
                }
            }

            function setItems(data, file) {
                let html = ''
                data.items.forEach((item, index) => {
                    if(isMobailPage > index) {
                        html += `
                    <div class="col col-12 col-sm-12 col-md-6">
                        <div class="pressmark-page__item">
                            <div class="pressmark-page__image"> 
                                <img class="pressmark-page__item__image" src="${item.image}">
                            </div>
                            <div class="pressmark-page__content">
                                <div class="pressmark-page__item__title">${item.title}</div>
                                <div class="pressmark-page__item__date">${item.date}</div>
                                <a href="${item.link}" class="btn btn-primary-inverse btn-lg m-b">
                                    <div class="btn-icon">
                                        <svg width="22" height="18">
                                            <use xlink:href="#i-upload-item" href="#i-upload-item"></use>
                                        </svg>
                                    </div>?????????????? `+file+`
                                </a>
                            </div>
                        </div>
                    </div>
                    `
                    }
                })
                fullLength = data.size

                /*setMoreBtn(fullLength, currentPage, pagesizeAttr)*/
                setControlText(fullLength, currentPage, pagesizeAttr)
                if (currentPage === 1) {
                    $body.innerHTML = html
                } else {
                    $body.insertAdjacentHTML('beforeend', html)

                }

                if (data.items.length) document.querySelector('.pressmark-page__content__button').style.display = 'block';
                else document.querySelector('.pressmark-page__content__button').style.display = 'none';

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

                /*if (page * pageSize < fullLength) {
                    $controlTextBlock.textContent = `???????????????? ${+page * +pageSize} ???? ${fullLength}`
                } else {
                    $controlTextBlock.textContent = `???????????????? ${fullLength} ???? ${fullLength}`
                }*/
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

        pressmarkFilter(pressmarkBlock, 8)
    })()
}

if (
    document.readyState === "complete" ||
    (document.readyState !== "loading" && !document.documentElement.doScroll)
) {
    callback();
} else {
    document.addEventListener("DOMContentLoaded", callback);
}