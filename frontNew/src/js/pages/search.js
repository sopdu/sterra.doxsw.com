
(() => {
    // PAGES.ABOUT_PAGE
    let page = document.querySelector('.page');
    if (!page) return;

    const isSearchPage = document.querySelector('.search-page');
    if (!isSearchPage) return;

    const searchFields = document.querySelectorAll('.js-input-search-field')

    searchFields.forEach(item => {
        const input = item.querySelector('.js-input-search')
        const clear = item.querySelector('.js-input-search-clear')

        if(input.value){
            clear.style.display = 'block'
        } else {
            clear.style.display = 'none'
        }
        input.addEventListener('input', () => {
            if(input.value){
                clear.style.display = 'block'
            } else {
                clear.style.display = 'none'
            }
        })
        clear.addEventListener('click', () => {
            input.value = ''
            clear.style.display = 'none'
        })
    })



})()
