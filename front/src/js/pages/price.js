(() => {
    let page = document.querySelector('.page');
    if (!page) return;

    const isPricePage = document.querySelector('.price-page');
    if (!isPricePage) return;



    const rightArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
              </svg>`;

    const leftArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
              </svg>`;

    const checkboxItems = document.querySelectorAll('input[type="checkbox"]')

    checkboxItems.forEach(item => {
        item.addEventListener('change', () => {
            const container = item.closest('.price-slider__item')
            const button = container.querySelector('.btn')
            if(item.checked){
                button.classList.remove('disabled')
            } else {
                button.classList.add('disabled')

            }
        })
    })

    var priceSlider = tns({
        container: '.js-price-slider-1',
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
        controlsContainer: document.querySelector('.js-price-slider-control-1'),
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



})()
