(() => {
    // PAGES.HOME_PAGE
    let page = document.querySelector('.page');
    if (!page) return;


    const isSupportMainPage = document.querySelector('.support-main-page');
    if (!isSupportMainPage) return;


    const faq = document.getElementById('home-faq');
    if (faq) {
        components.accordion(faq);
    }

    const rightArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
              </svg>`;

    const leftArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
              </svg>`;

    setTimeout(() => {

        var videoBlockSlider = tns({
            container: '.js-video-slider-1',
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
            controlsContainer: document.querySelector('.js-video-slider-control-1'),
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
    }, 300)
    if(window.innerWidth < 768){

        var videoBlockSlider2 = tns({
            container: '.support-main-cards-wrap',
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
            controlsContainer: document.querySelector('.js-cards-slider-control-1'),
            controlsText: [leftArrow, rightArrow],

        });
    }

    if(window.innerWidth < 1020){
        const descriptionAlertButton = document.querySelector('.description-with-title .icon-js')
        const descriptionAlertContent = document.querySelector('.description-with-title .description-with-title-abs')
        const descriptionAlertContentClose = document.querySelector('.description-with-title .description-with-title-abs__close')
        descriptionAlertButton.addEventListener('click', ()=> {
            if(descriptionAlertContent.classList.contains('open')){
                descriptionAlertContent.classList.remove('open')
            } else {
                descriptionAlertContent.classList.add('open')
            }
        })
        descriptionAlertContentClose.addEventListener('click', ()=> {
                descriptionAlertContent.classList.remove('open')
        })

        document.body.addEventListener('click', (e) => {
            if(e.target.classList.contains('description-with-title-abs') || e.target.closest('.description-with-title-abs') ||  e.target.classList.contains('icon-js') || e.target.closest('.icon-js')){

            } else {
                descriptionAlertContent.classList.remove('open')
            }
        })


    }

})();
