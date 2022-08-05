var callback = function(){
    (() => {
        // PAGES.ABOUT_PAGE
        let page = document.querySelector('.page');
        if (!page) return;

        const isPressnewsPage = document.querySelector('.press-news');
        if (!isPressnewsPage) return;


        const pressnewsBlock = document.querySelector('.pressnews-page__content');
        const selectors = {
            controlItem: '.js-control-item',
            controlItemButton: '.js-control-item-button',
            blockItem: '.js-item',
            searchInput: '.js-input-search',
            searchField: '.js-input-search-field',
            searchClear: '.js-input-search-clear',
            filterProd: '.pressnews-page__select',
            controlText: '.js-control-text',
            controlMore: '.js-control-more',
            body: '.pressnews-page__body',
        };

        const states = {
            active: 'active',
            filled: 'filled',
            filtered: 'filtered',

        }

        page.addEventListener('click', e => {
            if (pressnewsBlock.querySelectorAll(selectors.filterProd).length > 0 && !e.target.closest('.show')) {
                pressnewsBlock.querySelectorAll(selectors.filterProd)[0].classList.remove('show')
            }
        })


        function pressnewsFilter($element, pagesize = 6) {
            if (!$element || !$element.classList.contains('pressnews-page__content')) return;
            const $controlFilterItems = $element.querySelectorAll(selectors.controlItemButton)

            const $body = $element.querySelector(selectors.body)
            const $searchInput = $element.querySelector(selectors.searchInput)
            const $searchField = $element.querySelector(selectors.searchField)
            const $searchInputClear = $element.querySelector(selectors.searchClear)
            const $filterProd = $element.querySelectorAll(selectors.filterProd)
            let fullLength = $element.dataset.fullLength
            let formUrl = $element.dataset.action
            let formMethod = $element.dataset.method
            let isMobailPage = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) ? 12 : 12
            let pagesizeAttr = isMobailPage
            const $controlTextBlock = $element.querySelector(selectors.controlText)
            const $controlMoreBtn = $element.querySelector(selectors.controlMore)
            let currentPage = 1;


            setMoreBtn(fullLength, currentPage, pagesizeAttr)
            setControlText(fullLength, currentPage, pagesizeAttr)

            $filterProd.forEach(item => {
                item.addEventListener('click', function (e) {
                    if (e.target.classList.contains('pressnews-page__select_button')) {
                        $element.querySelectorAll('.pressnews-page__active')[0].innerHTML = e.target.innerHTML
                    }
                    if (!e.target.closest('.close')) {
                        e.target.closest('.pressnews-page__select').classList.toggle('show')
                        e.target.closest('.pressnews-page__select').querySelectorAll('.controlls')[0].classList.add('show');
                        e.target.closest('.pressnews-page__select').querySelectorAll('.pressnews-page__active')[0].classList.remove('default');
                    }
                })
            })

            document.querySelectorAll('.close').forEach(item => {
                item.addEventListener('click', function (e) {
                    $element.querySelectorAll('.controlls')[0].classList.remove('show');
                    $element.querySelectorAll('.pressnews-page__active')[0].classList.add('default');
                    $element.querySelectorAll('.pressnews-page__active')[0].innerHTML = $element.querySelectorAll('.pressnews-page__selects [data-type=""]')[0].innerHTML
                    $element.querySelectorAll('.js-control-item-button.active')[0].classList.remove('active');
                    $element.querySelectorAll('.pressnews-page__selects [data-type=""]')[0].classList.add('active');
                    let filterblock = getFiltersArray();
                    getData(filterblock);
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

            document.querySelector('.pressnews-page__select').addEventListener('click', function () {
                console.log(window.elemscroll);
                if (!window.elemscroll) {
                    setTimeout(function () {
                        var $controlFilterItemsNew = $element.querySelectorAll(selectors.controlItemButton)
                        $controlFilterItemsNew.forEach(item => {
                            item.addEventListener('click', function () {
                                console.log('itemClick')
                                if (!item.classList.contains(states.active)) {
                                    $controlFilterItemsNew.forEach(item => {
                                        item.classList.remove(states.active)
                                    })
                                    item.classList.add(states.active)
                                    let filterblock = getFiltersArray()
                                    getData(filterblock)
                                }
                            })
                        })
                    }, 300)
                }
            })

            $controlMoreBtn.addEventListener('click', function () {
                let filterblock = getFiltersArray(false)
                getData(filterblock)
            })

            var params = getAllUrlParams();
            if (params['query'] || params['filter_type'] || params['page']) {
                if(params['query'] && params['query'] != 'null') params['query'] = decodeURI(params['query']);
                getData(params);
            }


            function getAllUrlParams(url) {
                if (!url) url = location.href;
                // извлекаем строку из URL или объекта window
                var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

                // объект для хранения параметров
                var obj = {};

                // если есть строка запроса
                if (queryString) {

                    // данные после знака # будут опущены
                    queryString = queryString.split('#')[0];

                    // разделяем параметры
                    var arr = queryString.split('&');

                    for (var i=0; i<arr.length; i++) {
                        // разделяем параметр на ключ => значение
                        var a = arr[i].split('=');

                        // обработка данных вида: list[]=thing1&list[]=thing2
                        var paramNum = undefined;
                        var paramName = a[0].replace(/\[\d*\]/, function(v) {
                            paramNum = v.slice(1,-1);
                            return '';
                        });

                        // передача значения параметра ('true' если значение не задано)
                        var paramValue = typeof(a[1])==='undefined' ? true : a[1];

                        // преобразование регистра
                        paramName = paramName.toLowerCase();
                        paramValue = paramValue.toLowerCase();

                        // если ключ параметра уже задан
                        if (obj[paramName]) {
                            // преобразуем текущее значение в массив
                            if (typeof obj[paramName] === 'string') {
                                obj[paramName] = [obj[paramName]];
                            }
                            // если не задан индекс...
                            if (typeof paramNum === 'undefined') {
                                // помещаем значение в конец массива
                                obj[paramName].push(paramValue);
                            }
                            // если индекс задан...
                            else {
                                // размещаем элемент по заданному индексу
                                obj[paramName][paramNum] = paramValue;
                            }
                        }
                        // если параметр не задан, делаем это вручную
                        else {
                            obj[paramName] = paramValue;
                        }
                    }
                }

                return obj;
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

            function getData(filterblock) {
                let formData = new FormData()

                for (const filterblockKey in filterblock) {
                    formData.append(filterblockKey, filterblock[filterblockKey])
                }
                if (formMethod.toUpperCase() === 'GET') {
                    let params = new URLSearchParams(formData).toString();
                    history.pushState(null, null, '?'+params);
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
                    if (isMobailPage > index) {
                        html += `
                    <div class="col col-12 col-sm-6 col-md-4">
                        <a class="pressnews-page__item" href="${item.link}">`;
                        var src = '/local/templates/s-terra22/images/pressnews/no-img.svg'
                        if (item.img) src = item.img;
                        html+= `<div class="pressnews-page__item__image" style="background-image: url('${src}');"></div>`;
                        html+=`
                            <div class="pressnews-page__item__date">${item.date}</div>
                            <div class="pressnews-page__item__title">${item.title}</div>
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

                var filter_type = null;
                if ($element.querySelectorAll(selectors.controlItemButton + '.active').length){
                    filter_type = $element.querySelector(selectors.controlItemButton + '.active').dataset.type ? $element.querySelector(selectors.controlItemButton + '.active').dataset.type : null;
                }

                return {
                    query: $searchInput.value ? $searchInput.value : null,
                    filter_type: filter_type,
                    page: currentPage
                }
            }

            function setControlText(fullLength, page, pageSize) {

                if (page * pageSize < fullLength) {
                    $controlTextBlock.textContent = `Показано ${+page * +pageSize} из ${fullLength}`;
                    $controlMoreBtn.style.display = 'block';
                } else {
                    $controlTextBlock.textContent = `Показано ${fullLength} из ${fullLength}`;
                    $controlMoreBtn.style.display = 'none';
                }
            }

            function checkFilled($element, value) {
                console.log(value)
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

        pressnewsFilter(pressnewsBlock, 8)
    })()
};

if (
    document.readyState === "complete" ||
    (document.readyState !== "loading" && !document.documentElement.doScroll)
) {
    callback();
} else {
    document.addEventListener("DOMContentLoaded", callback);
}