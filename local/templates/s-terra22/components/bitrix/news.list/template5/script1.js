(() => {
    // PAGES.HOME_PAGE
    let page = document.querySelector('.page');
    if (!page) return;


    const isSupport3Page = document.querySelector('.support-documentation-tab-3');
    if (!isSupport3Page) return;

    const setItems = (data, setMoreBtn, currentPage, pagesizeAttr, setControlText, $body) => {
        console.log(data)
        let html = ''
        data.items.forEach(item => {
            let list = ''
            item.list.forEach(li => {
                list += `<li>${li}</li>`
            })
            html += `
            <div class="support-documentation-tab-3__item js-item">
                <div class="support-documentation-tab-3__item__image"><img src="${item.image}"></div>
                <div class="support-documentation-tab-3__item__text">
                  <div class="support-documentation-tab-3__item__text__title">${item.title}</div>
                  <div class="support-documentation-tab-3__item__text__subtitle">${item.subtitle}</div>
                  <div class="support-documentation-tab-3__item__text__description">
                    <ul>
                      ${list}
                    </ul>
                  </div><a class="btn btn-primary-inverse" href="${item.link}">
                    <svg class="btn-icon desktop">
                      <use href="./img/icons/icon-sprite.svg#download-arrow"></use>
                    </svg>
                    <svg class="btn-icon mobile">
                      <use href="./img/icons/icon-sprite.svg#download-arrow-mobile"></use>
                    </svg><span>Скачать PDF</span></a>
                </div>
              </div>
                    `
        })
        const fullLength = data.size

        setMoreBtn(fullLength, currentPage, pagesizeAttr)
        setControlText(fullLength, currentPage, pagesizeAttr)
        if (currentPage === 1) {
            $body.innerHTML = html
        } else {
            $body.insertAdjacentHTML('beforeend', html)
        }
    }
    const formvideo = document.querySelector('.form-js');

    if (formvideo) components.formvideo(formvideo, formvideo.getAttribute('data-page-size'), setItems);

    const itemLength = 10
    const items2 = document.querySelectorAll('.support-documentation-tab-3__item')
    const itemsLengthFull2 = items2.length
    items2.forEach((item, index) => {
        if(index < itemLength){
            item.classList.add('showed')
        } else {
            item.style.display = 'none'
        }
    })
    const more2 = document.querySelector('.js-control-more-support-documentation-3')
    const text2 = document.querySelector('.js-control-text-support-documentation-3')
    const block2 = document.querySelector('.js-control-text-support-documentation-3-show')

    if (block2) {
        if (itemsLengthFull2 - itemLength <= 0) {
            block2.style.display = 'none'
        } else {
            more2.style.display = 'block'
            if (itemsLengthFull2 - itemLength > itemLength) {

                more2.textContent = 'Еще ' + itemLength
            } else {

                more2.textContent = `Еще ${itemsLengthFull2 - itemLength}`
            }
        }
    }

    if (text2) text2.innerHTML = `Показано ${itemLength} из ${itemsLengthFull2}`;

    if (more2) {
        more2.addEventListener('click', () => {
            const items2 = document.querySelectorAll('.support-documentation-tab-3__item:not(.showed)')
            const itemsLengthFull2 = items2.length
            items2.forEach((item, index) => {
                if (index < itemLength) {
                    item.classList.add('showed')
                    item.style.display = 'flex'
                } else {
                    item.style.display = 'none'
                }
            })
            const more2 = document.querySelector('.js-control-more-support-documentation-3')
            const text2 = document.querySelector('.js-control-text-support-documentation-3')
            const block2 = document.querySelector('.js-control-text-support-documentation-3-show')
            if (itemsLengthFull2 - itemLength <= 0) {
                block2.style.display = 'none'
            } else {
                more2.style.display = 'block'
                if (itemsLengthFull2 - itemLength > itemLength) {
                    more2.textContent = `Еще ${itemLength}`
                } else {
                    more2.textContent = `Еще ${itemsLengthFull2 - itemLength}`
                }
            }

            text2.innerHTML = `Показано ${itemLength} из ${itemsLengthFull2}`
            const itemsShowed2 = document.querySelectorAll('.support-documentation-tab-3__item.showed')
            const itemsFull2 = document.querySelectorAll('.support-documentation-tab-3__item')
            text2.innerHTML = `Показано ${itemsShowed2.length} из ${itemsFull2.length}`
        })
    }

})();
