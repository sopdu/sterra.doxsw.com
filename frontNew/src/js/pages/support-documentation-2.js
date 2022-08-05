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

    const itemLength = 8
    const items2 = document.querySelectorAll('.support-documentation-tab-2__item')
    const itemsLengthFull2 = items2.length
    items2.forEach((item, index) => {
        if(index < itemLength){
            item.classList.add('showed')
        } else {
            item.style.display = 'none'
        }
    })
    const more2 = document.querySelector('.js-control-more-support-documentation-2')
    const text2 = document.querySelector('.js-control-text-support-documentation-2')
    const block2 = document.querySelector('.js-control-text-support-documentation-2-show')
    if(itemsLengthFull2 - itemLength <= 0){
        block2.style.display = 'none'
    } else {
        more2.style.display = 'block'
        if(itemsLengthFull2 - itemLength > itemLength){

            more2.textContent = 'Еще ' + itemLength
        } else {

            more2.textContent = `Еще ${itemsLengthFull2 - itemLength}`
        }
    }

    text2.innerHTML = `Показано ${itemLength} из ${itemsLengthFull2}`
    more2.addEventListener('click', () => {
        const items2 = document.querySelectorAll('.support-documentation-tab-2__item:not(.showed)')
        const itemsLengthFull2 = items2.length
        items2.forEach((item, index) => {
            if(index < itemLength){
                item.classList.add('showed')
                item.style.display = 'flex'
            } else {
                item.style.display = 'none'
            }
        })
        const more2 = document.querySelector('.js-control-more-support-documentation-2')
        const text2 = document.querySelector('.js-control-text-support-documentation-2')
        const block2 = document.querySelector('.js-control-text-support-documentation-2-show')
        if(itemsLengthFull2 - itemLength <= 0){
            block2.style.display = 'none'
        } else {
            more2.style.display = 'block'
            if(itemsLengthFull2 - itemLength > itemLength){
                more2.textContent = `Еще ${itemLength}`
            } else {
                more2.textContent = `Еще ${itemsLengthFull2 - itemLength}`
            }
        }

        text2.innerHTML = `Показано ${itemLength} из ${itemsLengthFull2}`
        const itemsShowed2 = document.querySelectorAll('.support-documentation-tab-2__item.showed')
        const itemsFull2 = document.querySelectorAll('.support-documentation-tab-2__item')
        text2.innerHTML = `Показано ${itemsShowed2.length} из ${itemsFull2.length}`
    })

})();
