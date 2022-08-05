(() => {
    // PAGES.HOME_PAGE
    let page = document.querySelector('.page');
    if (!page) return;


    const isSupport2Page = document.querySelector('.support-documentation-tab-2');
    if (!isSupport2Page) return;

    const items = document.querySelectorAll('.support-documentation-tab-2__item')
    items.forEach(item => {
        const extraButton = item.querySelector('.support-documentation-tab-2__item__text__extra')
        const closeButton = item.querySelector('.support-documentation-tab-2__item__close')
        extraButton && extraButton.addEventListener('click', () => {
            items.forEach(item => item.classList.remove('open'))
            item.classList.add('open')
        })
        closeButton && closeButton.addEventListener('click', () => {
            item.classList.remove('open')
        })
    })

})();
