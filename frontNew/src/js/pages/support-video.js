(() => {
    // PAGES.HOME_PAGE
    let page = document.querySelector('.page');
    if (!page) return;


    const isSupportVideoPage = document.querySelector('.support-education-page-video');
    if (!isSupportVideoPage) return;

    const setItems = (data, setMoreBtn, currentPage, pagesizeAttr, setControlText, $body) => {
        let html = ''
        data.items.forEach(item => {
            html += `
<div class="support-education-page__video js-item"><a class="support-education-page__video__item__wrap" href="#">
                <div class="support-education-page__video__item-image"><img src="${item.image}"></div>
                <div class="support-education-page__video__item__title">${item.title}</div></a></div>
                    
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
