"use strict";

(function () {
  // PAGES.HOME_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isSupportFaqPage = document.querySelector('.support-faq-page');
  if (!isSupportFaqPage) return;
  var faq = document.getElementById('home-faq');

  if (faq) {
    components.accordion(faq);
  }

  var selectors = {
    controlText: '.js-control-text',
    controlMore: '.js-control-more'
  };
  var states = {
    active: 'active',
    filled: 'filled',
    filtered: 'filtered'
  };
  var currentPage = 1;
  var pagesize = 10;
  var $controlTextBlock = document.querySelector(selectors.controlText);
  var $controlMoreBtn = document.querySelector(selectors.controlMore);
  var form = document.querySelector('.support-faq__controll__wrap');
  var formUrl = form.dataset.action;
  var formMethod = form.dataset.method;
  var maxLength = +form.dataset.maxLength;
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    getData;
  });
  setControlText(maxLength, currentPage, pagesize);
  setMoreBtn(maxLength, currentPage, pagesize);

  function setItems(data) {
    var accordion = document.getElementById('home-faq');
    var html = '';
    data.items.forEach(function (item) {
      html += `<section class="home-faq-item accordion-item"><header class="home-faq-item__header accordion-item-header accordion-trigger"><h2 class="home-faq-item__title">${item.title}</h2><div class="home-faq-item__state"></div></header><div class="accordion-item-panel" >${item.description}<div class="block">${item.descriptions}</div></div></section>`
    });
    ++currentPage;
    setMoreBtn(maxLength, currentPage, pagesize);
    setControlText(maxLength, currentPage, pagesize);
    accordion.insertAdjacentHTML('beforeend', html);

    if (faq) {
      components.accordion(faq, false);
    }
  }

  $controlMoreBtn.addEventListener('click', function () {
    var filterblock = [];
    getData(filterblock);
  });

  function getData(filterblock) {
    var formData = new FormData();

    for (var filterblockKey in filterblock) {
      formData.append(filterblockKey, filterblock[filterblockKey]);
    }

    if (formMethod.toUpperCase() === 'GET') {
      var params = new URLSearchParams(formData).toString();
      fetch(formUrl + '?' + params).then(function (res) {
        return res.json();
      }).then(function (data) {
        setItems(data);
      });
    } else {
      fetch(formUrl, {
        method: formMethod,
        body: formData
      }).then(function (res) {
        return res.json();
      }).then(function (data) {
        setItems(data);
      });
    }
  }

  function setControlText(fullLength, page, pageSize) {
    if (page * pageSize < fullLength) {
      $controlTextBlock.textContent = `Показано ${+page * +pageSize} из ${fullLength}`;
    } else {
      $controlTextBlock.textContent = `Показано ${fullLength} из ${fullLength}`;
    }
  }

 function setMoreBtn(fullLength, page, pageSize) {
                if (page * pageSize < fullLength) {
                    $controlMoreBtn.classList.add(states.active)
                    if (fullLength - page * pageSize > pageSize) {
                        $controlMoreBtn.textContent = `Еще ${pageSize}`
                    } else {
                        $controlMoreBtn.textContent = `Еще ${fullLength - page * pageSize}`
                    }
                } else {
                    $controlMoreBtn.classList.remove(states.active)
                }
            }
})();