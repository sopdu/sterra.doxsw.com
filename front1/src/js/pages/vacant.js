document.addEventListener('DOMContentLoaded', () => {
    (() => {
        // PAGES.ABOUT_PAGE
        let page = document.querySelector('.page');
        if (!page) return;

        const isVacanciesPage = document.querySelector('.vacancies-page');
        if (!isVacanciesPage) return;


        const vacant = document.querySelector('.vacant');
        components.vacant(vacant);

        const rightArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-right" href="#i-chevron-right"></use>
              </svg>`;

        const leftArrow = `
            <svg width="7" height="12">
                <use xlink:href="#i-chevron-left" href="#i-chevron-left"></use>
              </svg>`;

        var vacanciesReviewSlider = tns({
            container: '.vacancies-review-slider',
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

        const sliders = document.querySelectorAll('.scroll-slider');
        sliders.forEach((s) => {
            components.scrollSlider(s);
        });
    })()
})