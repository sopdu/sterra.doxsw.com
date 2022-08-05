document.addEventListener('DOMContentLoaded', () => {
    (() => {
        // PAGES.ABOUT_PAGE
        let page = document.querySelector('.page');
        if (!page) return;

        const isAboutPage = document.querySelector('.about-page');
        if (!isAboutPage) return;

        const rightArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
              </svg>`;

        const leftArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
              </svg>`;

        var aboutHistorySlider = tns({
            container: '.about-history-slider',
            items: 1,
            nav: false,
            touch: true,
            mouseDrag: true,
            preventScrollOnTouch: "inner",
            slideBy: 1,
            controls: true,
            autoplay: false,
            controlsPosition: 'bottom',
            controlsText: [leftArrow, rightArrow]

        });
        var aboutTeamSlider = tns({
            container: '.about-team-slider',
            navContainer: "#about-team-slider-thumbnails",
            navAsThumbnails: true,
            items: 1,
            touch: true,
            mouseDrag: true,
            preventScrollOnTouch: "inner",
            slideBy: 1,
            controls: false,
            autoplay: false,
        });
        const tabs = document.querySelectorAll('.tab');
        if (tabs.length) {
            tabs.forEach(item => {
                components.tab(item);
            })
        }

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
                        gutter: 13,
                        items: 2,
                    },
                }

            });
        }

        if(window.innerWidth < 767){

            var teamSlider = tns({
                container: '.about-team__users',
                autoWidth: false,
                items: 2,
                nav: false,
                touch: true,
                mouseDrag: true,
                preventScrollOnTouch: "inner",
                gutter: 13,
                slideBy: 1,
                controls: true,
                autoplay: false,
                controlsPosition: 'bottom',
                controlsText: [leftArrow, rightArrow],
                responsive: {
                    640: {
                        autoWidth: true,
                    },
                }

            });
        }

    })()
})