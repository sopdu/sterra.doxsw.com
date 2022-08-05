(() => {
    // PAGES.HOME_PAGE
    let page = document.querySelector('.page');
    if (!page) return;


    const isSupport1Page = document.querySelector('.support-documentation-tab-1');
    if (!isSupport1Page) return;

    const setItems = (data, setMoreBtn, currentPage, pagesizeAttr, setControlText, $body) => {
        console.log(data)
        let html = ''
        data.items.forEach(item => {
            let list = ''
            item.list.forEach(li => {
                list += `<li>${li}</li>`
            })
            html += `
            <div class="support-documentation-tab-1__item js-item">
                <div class="support-documentation-tab-1__item__image"><img src="${item.image}"></div>
                <div class="support-documentation-tab-1__item__text">
                  <div class="support-documentation-tab-1__item__text__title">${item.title}</div>
                  <ul>${item.list}
                  </ul>
                  <a href="${item.link}" class="btn btn-primary-inverse">
                    <svg class="btn-icon desktop">
                      <use href="./img/icons/icon-sprite.svg#download-arrow-mobile"></use>
                    </svg>
                    <svg class="btn-icon mobile">
                      <use href="./img/icons/icon-sprite.svg#download-arrow-mobile"></use>
                    </svg><span>Скачать PDF</span>
                  </a>
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
    components.formvideo(formvideo, formvideo.getAttribute('data-page-size'), setItems);



})();
