(() => {
    // PAGES.HOME_PAGE
    let page = document.querySelector('.page');
    if (!page) return;


    const isSupport4Page = document.querySelector('.support-documentation-tab-4');
    if (!isSupport4Page) return;


    const faq = document.getElementById('home-faq');
    if (faq) {
        components.accordion(faq);
    }

})();
