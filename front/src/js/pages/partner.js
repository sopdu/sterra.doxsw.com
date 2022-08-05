(() => {
    // PAGES.ABOUT_PAGE
    let page = document.querySelector('.page');
    if (!page) return;

    const isPartnerPage = document.querySelector('.partner-page');
    if (!isPartnerPage) return;

    const rightArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
              </svg>`;

    const leftArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
              </svg>`;

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

    var tabs = document.querySelectorAll('.tab');

    if (tabs.length) {
        tabs.forEach(function (item) {
            components.tab(item);
        });
    }

    var catalogSertSlider = tns({
        container: '.js-partner-slider-1',
        items: 1,
        nav: false,
        touch: true,
        mouseDrag: true,
        preventScrollOnTouch: "inner",
        slideBy: 1,
        gutter: 20,
        controls: true,
        autoplay: false,
        controlsPosition: 'bottom',
        controlsContainer: document.querySelector('.js-slider-control-1'),
        controlsText: [leftArrow, rightArrow],
        responsive: {
            640: {
                items: 2,
                gutter: 30,
            },
            1020: {
                items: 3,
                gutter: 40,
            },
        }

    });


    if(window.innerWidth < 1024){

        var superiorSlider = tns({
            container: '.superior-grid',
            items: 1,
            nav: false,
            touch: true,
            mouseDrag: true,
            loop: false,
            preventScrollOnTouch: "inner",
            gutter: 13,
            slideBy: 1,
            controls: true,
            autoplay: false,
            controlsPosition: 'bottom',
            controlsText: [leftArrow, rightArrow],
            responsive: {
                640: {
                    gutter: 30,
                    items: 2,
                },
            }

        });
    }


    if(window.innerWidth < 500){
        const items = document.querySelectorAll('.our-partners-item')
        const itemsLengthFull = items.length
        items.forEach((item, index) => {
            if(index < 8){
                item.classList.add('showed')
            } else {
                item.style.display = 'none'
            }
        })
        const more = document.querySelector('.js-control-more-partner')
        const text = document.querySelector('.js-control-text-partner')
        const block = document.querySelector('.js-control-text-partner-show')
        if(itemsLengthFull - 8 == 0){
            block.style.display = 'none'
        } else {
            more.style.display = 'block'
            if(itemsLengthFull - 8 > 8){

                more.textContent = 'Еще 8'
            } else {
                more.textContent = `Еще ${itemsLengthFull - 8}`
            }
        }

        text.innerHTML = `Показано 8 из ${itemsLengthFull}`
        more.addEventListener('click', () => {

            const items = document.querySelectorAll('.our-partners-item:not(.showed)')
            const itemsLengthFull = items.length
            items.forEach((item, index) => {
                if(index < 8){
                    item.classList.add('showed')
                    item.style.display = 'flex'
                } else {
                    item.style.display = 'none'
                }
            })
            const more = document.querySelector('.js-control-more-partner')
            const text = document.querySelector('.js-control-text-partner')
            const block = document.querySelector('.js-control-text-partner-show')
            if(itemsLengthFull < 8){
                block.style.display = 'none'
            } else {
                more.style.display = 'block'
                if(itemsLengthFull - 8 >= 8){

                    more.textContent = 'Еще 8'
                } else {

                    more.textContent = `Еще ${itemsLengthFull - 8}`
                }
                if(itemsLengthFull - 8 == 0){

                    more.style.display = 'none'
                }
            }

            const itemsShowed = document.querySelectorAll('.our-partners-item.showed')
            const itemsFull = document.querySelectorAll('.our-partners-item')
            text.innerHTML = `Показано ${itemsShowed.length} из ${itemsFull.length}`
        })
    }


    const itemLength = window.innerWidth > 1020 ? 24 : 12
    const items2 = document.querySelectorAll('.our-partners__list__bottom__item')
    const itemsLengthFull2 = items2.length
    items2.forEach((item, index) => {
        if(index < itemLength){
            item.classList.add('showed')
        } else {
            item.style.display = 'none'
        }
    })
    const more2 = document.querySelector('.js-control-more-partner-2')
    const text2 = document.querySelector('.js-control-text-partner-2')
    const block2 = document.querySelector('.js-control-text-partner-2-show')
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
        const items2 = document.querySelectorAll('.our-partners__list__bottom__item:not(.showed)')
        const itemsLengthFull2 = items2.length
        items2.forEach((item, index) => {
            if(index < itemLength){
                item.classList.add('showed')
                item.style.display = 'flex'
            } else {
                item.style.display = 'none'
            }
        })
        const more2 = document.querySelector('.js-control-more-partner-2')
        const text2 = document.querySelector('.js-control-text-partner-2')
        const block2 = document.querySelector('.js-control-text-partner-2-show')
        if(itemsLengthFull2 - itemLength <= 0){
            block2.style.display = 'none'
        } else {
            more2.style.display = 'block'
            if(itemsLengthFull2 - itemLength > itemLength){
                more2.textContent = 'Еще 24'
            } else {
                more2.textContent = `Еще ${itemsLengthFull2 - itemLength}`
            }
        }

        text2.innerHTML = `Показано ${itemLength} из ${itemsLengthFull2}`
        const itemsShowed2 = document.querySelectorAll('.our-partners__list__bottom__item.showed')
        const itemsFull2 = document.querySelectorAll('.our-partners__list__bottom__item')
        text2.innerHTML = `Показано ${itemsShowed2.length} из ${itemsFull2.length}`
    })


    const modalSelect = document.querySelector('.custom-select-modal')
    const modalSelectTitle = document.querySelector('.custom-select-modal-title')
    const modalContent = document.querySelector('.custom-select-modal__content__bottom')
    const modalItem = document.querySelectorAll('.custom-select-modal__content__bottom__item')
    const modalItemsTop = document.querySelectorAll('.custom-select-modal__content__top-item:not(.disabled)')
    const modalItemsClose = document.querySelector('.custom-select-modal__content__close')
    const placeholder = modalSelectTitle.innerHTML
    modalSelectTitle.addEventListener('click', () => {
        if(modalSelect.classList.contains('open')){
            modalSelect.classList.remove('open')
        } else {
            modalSelect.classList.add('open')
        }
    })
    modalItemsClose.addEventListener('click', () => {
            modalSelect.classList.remove('open')
    })

    modalItem.forEach(item => {
        item.addEventListener('click', () => {
            const title = item.textContent
            modalSelectTitle.innerHTML = `<span>${title}</span><span class="close-icon"><svg width="15" height="15"><use xlink:href="#i-close-custom"></use></svg></span>`;
            modalSelect.classList.remove('open')
            modalSelectTitle.classList.remove('start')
            const closeIcon = modalSelectTitle.querySelector('.close-icon')
            closeIcon.addEventListener('click', (e) => {
                e.stopPropagation()
                modalSelectTitle.innerHTML = placeholder
                modalSelectTitle.classList.add('start')
            })
        })
    })

    modalItemsTop.forEach(item => {
        item.addEventListener('click', () => {

            const title = item.textContent.toLowerCase()
            if(title === modalItemsTop[0].textContent.toLowerCase()){
                modalContent.classList.remove('flex')
                modalItemsTop.forEach(item => item.classList.remove('active'))
                item.classList.add('active')
                modalItem.forEach(item => item.style.display = '')
            } else {
                modalItemsTop.forEach(item => item.classList.remove('active'))
                item.classList.add('active')
                modalContent.classList.add('flex')
                modalItem.forEach(i => {
                    if(i.textContent[0].toLowerCase() == title){
                        i.style.display = ''
                    } else {
                        i.style.display = 'none'
                    }
                })
            }
        })
    })

    document.body.addEventListener('click', (e)=> {
        if(e.target.classList.contains('custom-select-modal') || e.target.closest('.custom-select-modal')){

        } else {
            modalSelect.classList.remove('open')
        }
    })

})()
