var filters = document.querySelectorAll('.js-control-item .js-control-item-button');
for (i=0; i<filters.length; i++){
    filters[i].addEventListener('click', function () {

        if (this.getAttribute('data-type') == 2) {
            history.pushState(null, null, '?tab=appreciation');
            console.log(2);
        }
        else if (this.getAttribute('data-type') == 1){
            history.pushState(null, null, '?tab=awards');
            console.log(1)
        }
    })
}