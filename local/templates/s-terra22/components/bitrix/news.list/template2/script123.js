(() => {
    // PAGES.HOME_PAGE
    let page = document.querySelector('.page');
    if (!page) return;


    const isSupport1Page = document.querySelector('.support-documentation-tab-1');
    if (!isSupport1Page) return;

    const setItems = (data, setMoreBtn, currentPage, pagesizeAttr, setControlText, $body) => {
        console.log(data)
        let html = ''
        data.items.forEach(item => {
            let list = ''
            item.list.forEach(li => {
                list += `<li>${li}</li>`
            })
            html += `
            <div class="support-documentation-tab-1__item js-item">
                <div class="support-documentation-tab-1__item__image"><img src="${item.image}"></div>
                <div class="support-documentation-tab-1__item__text">
                  <div class="support-documentation-tab-1__item__text__title">${item.title}</div>
                  <ul>${item.list}
                  </ul>
                  <a href="${item.link}" class="btn btn-primary-inverse">
                    <svg class="btn-icon desktop">
                      <use href="./img/icons/icon-sprite.svg#download-arrow-mobile"></use>
                    </svg>
                    <svg class="btn-icon mobile">
                      <use href="./img/icons/icon-sprite.svg#download-arrow-mobile"></use>
                    </svg><span>Скачать PDF</span>
                  </a>
                </div>
              </div>
                    `
        })
        const fullLength = data.size

        setMoreBtn(fullLength, currentPage, pagesizeAttr)
        setControlText(fullLength, currentPage, pagesizeAttr)
        if (currentPage === 1) {
            $body.innerHTML = html
        } else {
            $body.insertAdjacentHTML('beforeend', html)
        }
    }
    const formvideo = document.querySelector('.form-js');
    components.formvideo(formvideo, formvideo.getAttribute('data-page-size'), setItems);



})();

var callback = function () {
    (function () {
        console.log('test');
        // PAGES.ABOUT_PAGE
        var page = document.querySelector('.page');
        if (!page) return;
        var isSupportSertPage = document.querySelector('.support-documentation-tab-1');
        if (!isSupportSertPage) return;



        var initPhotoSwipeFromDOM = function initPhotoSwipeFromDOM(gallerySelector) {
            // parse slide data (url, title, size ...) from DOM elements
            // (children of gallerySelector)
            var parseThumbnailElements = function parseThumbnailElements(el) {
                var thumbElements = el.querySelectorAll('figure'),
                    numNodes = thumbElements.length,
                    items = [],
                    figureEl,
                    linkEl,
                    size,
                    item;

                for (var i = 0; i < numNodes; i++) {
                    figureEl = thumbElements[i]; // <figure> element
                    // include only element nodes

                    if (figureEl.nodeType !== 1) {
                        continue;
                    }

                    linkEl = figureEl.children[0]; // <a> element
                    // size = linkEl.getAttribute('data-size').split('x');
                    // create slide object

                    var imageElement = linkEl.querySelector('img');
                    item = {
                        src: linkEl.getAttribute('href'),
                        w: imageElement.naturalWidth,
                        h: imageElement.naturalHeight
                    };

                    if (figureEl.children.length > 1) {
                        // <figcaption> content
                        item.title = figureEl.children[1].innerHTML;
                    }

                    if (linkEl.children.length > 0) {
                        // <img> thumbnail element, retrieving thumbnail url
                        item.msrc = linkEl.children[0].getAttribute('src');
                    }

                    item.el = figureEl; // save link to element for getThumbBoundsFn

                    items.push(item);
                }

                return items;
            }; // find nearest parent element


            var closest = function closest(el, fn) {
                return el && (fn(el) ? el : closest(el.parentNode, fn));
            }; // triggers when user clicks on thumbnail


            var onThumbnailsClick = function onThumbnailsClick(e) {
                e = e || window.event;
                e.preventDefault ? e.preventDefault() : e.returnValue = false;
                var eTarget = e.target || e.srcElement; // find root element of slide

                var clickedListItem = closest(eTarget, function (el) {
                    return el.tagName && el.tagName.toUpperCase() === 'FIGURE';
                });

                if (!clickedListItem) {
                    return;
                } // find index of clicked item by looping through all child nodes
                // alternatively, you may define index via data- attribute


                var clickedGallery = clickedListItem.closest('.my-gallery'),
                    childNodes = clickedGallery.querySelectorAll('figure'),
                    numChildNodes = childNodes.length,
                    nodeIndex = 0,
                    index;

                for (var i = 0; i < numChildNodes; i++) {
                    if (childNodes[i].nodeType !== 1) {
                        continue;
                    }

                    if (childNodes[i] === clickedListItem) {
                        index = nodeIndex;
                        break;
                    }

                    nodeIndex++;
                }

                if (index >= 0) {
                    // open PhotoSwipe if valid index found
                    openPhotoSwipe(index, clickedGallery);
                }

                return false;
            }; // parse picture index and gallery index from URL (#&pid=1&gid=2)


            var photoswipeParseHash = function photoswipeParseHash() {
                var hash = window.location.hash.substring(1),
                    params = {};

                if (hash.length < 5) {
                    return params;
                }

                var vars = hash.split('&');

                for (var i = 0; i < vars.length; i++) {
                    if (!vars[i]) {
                        continue;
                    }

                    var pair = vars[i].split('=');

                    if (pair.length < 2) {
                        continue;
                    }

                    params[pair[0]] = pair[1];
                }

                if (params.gid) {
                    params.gid = parseInt(params.gid, 10);
                }

                return params;
            };

            var openPhotoSwipe = function openPhotoSwipe(index, galleryElement, disableAnimation, fromURL) {
                var pswpElement = document.querySelectorAll('.pswp')[0],
                    gallery,
                    options,
                    items;
                items = parseThumbnailElements(galleryElement); // define options (if needed)

                options = {
                    // define gallery index (for URL)
                    galleryUID: galleryElement.getAttribute('data-pswp-uid'),
                    getThumbBoundsFn: function getThumbBoundsFn(index) {
                        // See Options -> getThumbBoundsFn section of documentation for more info
                        var thumbnail = items[index].el.getElementsByTagName('img')[0],
                            // find thumbnail
                            pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                            rect = thumbnail.getBoundingClientRect();
                        return {
                            x: rect.left,
                            y: rect.top + pageYScroll,
                            w: rect.width
                        };
                    }
                }; // PhotoSwipe opened from URL

                if (fromURL) {
                    if (options.galleryPIDs) {
                        // parse real index when custom PIDs are used
                        // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                        for (var j = 0; j < items.length; j++) {
                            if (items[j].pid == index) {
                                options.index = j;
                                break;
                            }
                        }
                    } else {
                        // in URL indexes start from 1
                        options.index = parseInt(index, 10) - 1;
                    }
                } else {
                    options.index = parseInt(index, 10);
                } // exit if index not found


                if (isNaN(options.index)) {
                    return;
                }

                if (disableAnimation) {
                    options.showAnimationDuration = 0;
                } // Pass data to PhotoSwipe and initialize it


                gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
                gallery.init();
            }; // loop through all gallery elements and bind events


            var galleryElements = document.querySelectorAll(gallerySelector);

            for (var i = 0, l = galleryElements.length; i < l; i++) {
                galleryElements[i].setAttribute('data-pswp-uid', i + 1);
                galleryElements[i].onclick = onThumbnailsClick;
            } // Parse URL and open gallery if it contains #&pid=3&gid=1


            var hashData = photoswipeParseHash();

            if (hashData.pid && hashData.gid) {
                openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
            }
        };

        initPhotoSwipeFromDOM('.my-gallery');
    })();
}
if (
    document.readyState === "complete" ||
    (document.readyState !== "loading" && !document.documentElement.doScroll)
) {
    callback();
} else {
    document.addEventListener("DOMContentLoaded", callback);
}
