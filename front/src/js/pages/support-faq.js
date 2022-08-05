(() => {
    // PAGES.HOME_PAGE
    let page = document.querySelector('.page');
    if (!page) return;


    const isSupportFaqPage = document.querySelector('.support-faq-page');
    if (!isSupportFaqPage) return;


    const faq = document.getElementById('home-faq');
    if (faq) {
        components.accordion(faq);
    }

    const selectors = {
        controlText: '.js-control-text',
        controlMore: '.js-control-more',
    };

    const states = {
        active: 'active',
        filled: 'filled',
        filtered: 'filtered',

    }
    let currentPage = 1
    let pagesize = 10
    const $controlTextBlock = document.querySelector(selectors.controlText)
    const $controlMoreBtn = document.querySelector(selectors.controlMore)
    const form = document.querySelector('.support-faq__controll__wrap')
    let formUrl = form.dataset.action
    let formMethod = form.dataset.method

    let maxLength = +form.dataset.maxLength
        form.addEventListener('submit', (e)=> {
            e.preventDefault()
            getData
        })
    setControlText(maxLength, currentPage, pagesize)
    setMoreBtn(maxLength, currentPage, pagesize)
    function setItems (data){
        const accordion = document.getElementById('home-faq')
        let html = ''
        data.items.forEach(item => {
            html += `
            <section class="home-faq-item accordion-item">
                  <header class="home-faq-item__header accordion-item-header accordion-trigger">
                    <h2 class="home-faq-item__title">${item.title}</h2>
                    <div class="home-faq-item__state"></div>
                  </header>
                  <div class="accordion-item-panel" >${item.description}
                  </div>
                </section>
            `
        })
        ++currentPage
        setMoreBtn(maxLength, currentPage, pagesize)
        setControlText(maxLength, currentPage, pagesize)
        accordion.insertAdjacentHTML('beforeend', html)
        if (faq) {
            components.accordion(faq, false);
        }
    }


    $controlMoreBtn.addEventListener('click', function () {
        let filterblock = []
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
            if (fullLength - page * pageSize > pagesize) {
                $controlMoreBtn.textContent = `Еще ${pagesize}`
            } else {
                $controlMoreBtn.textContent = `Еще ${fullLength - page * pageSize}`
            }
        } else {
            $controlMoreBtn.classList.remove(states.active)
        }
    }
})();
