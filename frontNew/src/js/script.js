// Общие скрипты для всех страниц

(() => {
  // Ширина скроллбара
  document.documentElement.style.setProperty(
    '--scrollbar-width',
    utils.getScrollbarWidth() + 'px'
  );

  window.addEventListener(
    'resize',
    () => {
      document.documentElement.style.setProperty(
        '--scrollbar-width',
        utils.getScrollbarWidth() + 'px'
      );
    },
    { passive: true }
  );


    var x, i, j, l, ll, selElmnt, a, b, c;
    /* Look for any elements with the class "custom-select": */
    x = document.getElementsByClassName("custom-select");
    l = x.length;
    for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];

        ll = selElmnt.length;
        /* For each element, create a new DIV that will act as the selected item: */
        a = document.createElement("DIV");
        let s = document.createElement("SPAN");
        a.setAttribute("class", "select-selected");
        s.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML
        a.appendChild(s);
        if(selElmnt.selectedIndex === 0){
            a.classList.add('start')

        }
        x[i].appendChild(a);
        /* For each element, create a new DIV that will contain the option list: */
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < ll; j++) {
            /* For each option in the original select element,
            create a new DIV that will act as an option item: */
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {

                /* When an item is clicked, update the original select box,
                and the selected item: */
                var y, i, k, s, h, sl, yl;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;
                for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {

                        s.selectedIndex = i;
                        s.click()

                        h.innerHTML = `<span>${this.innerHTML}</span><span class="close-icon"><svg width="10" height="10"><use xlink:href="#i-close-custom"></use></svg></span>`;

                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        yl = y.length;
                        for (k = 0; k < yl; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        const closeIcon = h.querySelector('.close-icon')
                        closeIcon.addEventListener('click', (e) => {
                            e.stopPropagation()
                            s.selectedIndex = 0;
                            h.innerHTML = `<span>${s.options[0].innerHTML}</span>`
                            a.classList.add('start')

                        })
                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            /* When the select box is clicked, close any other select boxes,
            and open/close the current select box: */
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
            this.classList.remove('start')
        });
    }

    function closeAllSelect(elmnt) {
        /* A function that will close all select boxes in the document,
        except the current select box: */
        var x, y, i, xl, yl, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        xl = x.length;
        yl = y.length;
        for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < xl; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }

    /* If the user clicks anywhere outside the select box,
    then close all select boxes: */
    document.addEventListener("click", closeAllSelect);
})()
