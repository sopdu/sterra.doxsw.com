var callback = function () {
    var headers = document.querySelectorAll('.support-header');
    for (i=0; i < headers.length; i++){
        headers[i].addEventListener('click', function () {
            if (this.classList.contains('active')) return;
            var target = this.getAttribute('data-target');
            var hideElems = document.querySelectorAll('.support-block .active');
            var showElems = document.querySelectorAll('.support-block '+target);
            for (a=0; a<hideElems.length; a++){
                hideElems[a].classList.remove('active');
            }
            for (a=0; a<showElems.length; a++){
                showElems[a].classList.add('active');
            }
            this.classList.add('active');
        })
    }
}

if (
    document.readyState === "complete" ||
    (document.readyState !== "loading" && !document.documentElement.doScroll)
) {
    callback();
} else {
    document.addEventListener("DOMContentLoaded", callback);
}