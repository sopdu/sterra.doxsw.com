(() => {
    // PAGES.ABOUT_PAGE
    let page = document.querySelector('.page');
    if (!page) return;

    const isCatalogProductPage = document.querySelector('.catalog-product-page');
    if (!isCatalogProductPage) return;

    let filter_block = {}

    function choosenTemplateItem(name, id, filterName){
        let template = `
        <div data-id="${id}" data-filter-name="${filterName}" class="catalog-block__items__choosen-item">
            <span class="catalog-block__items__choosen-item__text">${name}</span>
            <div class="catalog-block__items__choosen-item__close" data-js-ref="choosen-filter-remove">
                    <svg width="10" height="10">
                      <use xlink:href="#i-chest-filter" href="#i-chest-filter"></use>
                    </svg>
            </div>
          </div>
        `
        return template
    }

    function productTemplateItem(item){
        let itemsBlock = ''
        item.blocks.forEach(block => {
            itemsBlock += `
                  <div class="catalog-block__items__item__block">
                    <div class="catalog-block__items__item__block__title">${block.title}</div>
                    <div class="catalog-block__items__item__block__value">${block.value}</div>
                  </div>
            `
        })
        let btn = ''
        if(item.available){
            btn += `<a class="btn btn-primary-inverse" href="${item.href}">Подробнее</a>`
        } else {
            btn += `<button class="btn btn-dis disabled" disabled>Снят с производства</button>`
        }
        let template = `
            <div class="catalog-block__items__item">
              <div class="catalog-block__items__item__wrap">
                <div class="catalog-block__items__item__title">${item.title}</div>
                <div class="catalog-block__items__item__description">${item.description}</div>
                <div class="catalog-block__items__item__blocks">
                    ${itemsBlock}
                </div>
                <div class="catalog-block__items__item__footer">
                  <div class="catalog-block__items__item__footer__image"><img src="${item.icon}"></div>
                  ${btn}
                </div>
              </div>
            </div>
        `
        return template
    }


    //create filters array block
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
    const form = document.querySelector('.js-catalog')
    let fullLength = form.dataset.fullLength
    let pagesize = form.dataset.pageSize
    let formUrl = form.dataset.action
    let formMethod = form.dataset.method
    const filters = document.querySelectorAll('[data-js-ref="catalog-checkbox-filter"]')
    const searchInput = document.querySelector('[data-js-ref="catalog-filter-search"]')
    const itemsContainer = document.querySelector('[data-js-ref="items-container"]')
    const choosenBlock = document.querySelector('[data-js-ref="catalog-choosen-block"]')
    const choosenContainer = document.querySelector('[data-js-ref="catalog-choosen-container"]')
    const choosenClear = document.querySelector('[data-js-ref="catalog-choosen-clear"]')
    const $controlTextBlock = form.querySelector(selectors.controlText)
    const $controlMoreBtn = form.querySelector(selectors.controlMore)
    const $filterClearBtn = document.querySelector('.js-clear-filters')
    const $filterApplyBtn = document.querySelector('.js-apply-filters')
    const $filterOpenBtn = document.querySelector('.btn-filter')
    const $filterCheckboxes = document.querySelector('.catalog-block__filter-col__checkboxes')
    let currentPage = 1;

    getData(true)
    let pagesizeAttr = null;
    if(window.innerWidth < 768){
        pagesizeAttr = form.dataset.pageSizeMobile
    } else {
        pagesizeAttr = form.dataset.pageSize
    }
    itemsContainer.querySelectorAll('.catalog-block__items__choosen-item').forEach((item, index) => {
        if(index < pagesizeAttr){

        } else {
            item.remove()
        }
    })

    setMoreBtn(fullLength, currentPage, pagesizeAttr)
    setControlText(fullLength, currentPage, pagesizeAttr)



    $controlMoreBtn.addEventListener('click', function () {
        getData(false)
    })




    function setControlText(fullLength, page, pagesizeAttr) {
        if(page == 1 && +fullLength <= +pagesizeAttr){
            $controlTextBlock.style.display = 'none'
        } else {
            if (page * pagesizeAttr < fullLength) {
                $controlTextBlock.textContent = `Показано ${+page * +pagesizeAttr} из ${fullLength}`
            } else {
                $controlTextBlock.textContent = `Показано ${fullLength} из ${fullLength}`
            }
        }
    }



    function setMoreBtn(fullLength, page, pagesizeAttr) {


        if (page * pagesizeAttr < fullLength) {
            $controlMoreBtn.classList.add(states.active)
            if (fullLength - page * pagesizeAttr > pagesizeAttr) {
                $controlMoreBtn.textContent = `Еще ${pagesizeAttr}`
            } else {
                $controlMoreBtn.textContent = `Еще ${fullLength - page * pagesizeAttr}`
            }
        } else {
            $controlMoreBtn.classList.remove(states.active)
        }
    }

    choosenBlock.style.display = 'none'

    const filtersArray = []
    let filterChoosen = []
    filters.forEach(item => {
        filtersArray.push({
            item: item,
            filterName: item.getAttribute('name'),
            filterNameShow: item.parentNode.querySelector('.checkbox-label').textContent.trim(),
            state: item.checked
        })
    })

    choosenContainer.addEventListener('click',  (event) => {
        let target = event.target
        if(target.classList.contains('catalog-block__items__choosen-item__close') || target.closest('.catalog-block__items__choosen-item__close')){
            let container = target.closest('.catalog-block__items__choosen-item')
            const filterName = container.getAttribute('data-filter-name')
            let index = filterChoosen.findIndex(filter => filter.filterName === filterName)
            if(index != -1){
                removeChoosen(filterChoosen[index])

                getData()
            }
        }
    })

    searchInput.addEventListener('input', () => {
        getData()
    })
    if(window.innerWidth > 1100){
        filters.forEach(item => {
            item.addEventListener('change', () => {
                let itemIndex = filtersArray.findIndex(filter => filter.filterName === item.getAttribute('name'))
                if(itemIndex >= 0){
                    filtersArray[itemIndex].state = item.checked
                    if(item.checked){
                        addChoosen(filtersArray[itemIndex])
                    } else {
                        removeChoosen(filtersArray[itemIndex])
                    }
                    getData()
                }
            })
        })
    } else {
        // $filterCheckboxes
        // $filterOpenBtn
        // $filterApplyBtn
        // $filterClearBtn
        $filterOpenBtn.addEventListener('click', () => {
            if($filterOpenBtn.classList.contains('active')){
                $filterOpenBtn.classList.remove('active')
                $filterCheckboxes.classList.remove('active')
            } else {
                $filterOpenBtn.classList.add('active')
                $filterCheckboxes.classList.add('active')
            }
        })
        $filterClearBtn.addEventListener('click', () => {
            $filterOpenBtn.classList.remove('active')
            $filterCheckboxes.classList.remove('active')
            filterChoosen = []
            filtersArray.forEach(filter => {
                filter.state = false
                filter.item.checked = false
            })
            choosenBlock.style.display = 'none'
            choosenContainer.innerHTML = ''
            getData()
        })
        $filterApplyBtn.addEventListener('click', () => {
            filterChoosen = []
            choosenBlock.style.display = 'none'
            choosenContainer.innerHTML = ''
            filtersArray.forEach((filter, index) => {
                filter.state = filter.item.checked
                if(filter.item.checked){
                    addChoosen(filtersArray[index])
                } else {
                    removeChoosen(filtersArray[index])
                }
            })

            getData()
            $filterOpenBtn.classList.remove('active')
            $filterCheckboxes.classList.remove('active')

        })
    }


    choosenClear.addEventListener('click', () => {
        choosenContainer.innerHTML = ''
        filterChoosen = []
        filtersArray.forEach(filter => {
            filter.state = false
            filter.item.checked = false
        })
        choosenBlock.style.display = 'none'
        getData()
    })

    function getFiltersArray() {
        return {
            filters: filtersArray,
            query : searchInput.value ? searchInput.value : null
        }
    }

    function addChoosen(item) {

        let index = filterChoosen.findIndex(filter => filter.filterName === item.filterName)
        if(index == -1){
            choosenBlock.style.display = 'flex'
            filterChoosen.push(item)
            let template = choosenTemplateItem(item.filterNameShow, filterChoosen.length - 1, item.filterName)
            choosenContainer.insertAdjacentHTML('beforeend', template)
        }
    }
    function removeChoosen(item) {
        filterChoosen = filterChoosen.filter(filter => filter.filterName != item.filterName)
        const filterNode = choosenContainer.querySelector(`[data-filter-name=${item.filterName}]`)
        if(filterNode){
            filterNode.remove()
            item.item.checked = false
        }
        if(filterChoosen.length == 0){
            choosenBlock.style.display = 'none'
        }
    }
    function setItems(data){
        let template = ''
        let items = data.items;
        if(data.items.length > pagesizeAttr){
            items = data.items.slice(0, pagesizeAttr);
        }
        items.forEach(item => {
            template += productTemplateItem(item)
        })
        fullLength = data.size
        setMoreBtn(fullLength, currentPage, pagesizeAttr)
        setControlText(fullLength, currentPage, pagesizeAttr)
        if (currentPage === 1) {
            itemsContainer.innerHTML = template
        } else {
            itemsContainer.insertAdjacentHTML('beforeend', template)
        }
    }
    function getData(first = true) {

        if (first) {
            currentPage = 1
        } else {
            ++currentPage
        }
        let filtersData = getFiltersArray()
        let formData = new FormData()

        for (const filterKey in filtersData.filters) {

            if(filtersData.filters[filterKey].state){
                formData.append(filtersData.filters[filterKey].filterName, 'on')
            }
        }
        if(filtersData.query){
            formData.append('query', filtersData.query)
        }
        formData.append('page', currentPage)
        formData.append('limit', pagesizeAttr)
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

})()
