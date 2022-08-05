"use strict";

(function () {
  // UTILS.COLLAPSIBLE
  function collapsible(el, duration) {
    el.style.height = 0;
    el.style.overflow = 'hidden';
    var transition = "height ".concat(duration, "ms ease-in-out");
    el.style.transition = transition;
    var opened = false;

    function open() {
      setTimeout(function () {
        opened = true;
        el.style.height = el.scrollHeight + 'px';
      });
    }

    function close() {
      setTimeout(function () {
        opened = false;
        el.style.height = 0;
      });
    }

    function toggle() {
      if (opened) close();else open();
    }

    function resize() {
      el.style.transition = '';
      el.style.height = 0;
      setTimeout(function () {
        el.style.height = el.scrollHeight + 'px';
        setTimeout(function () {
          el.style.transition = transition;
        });
      });
    }

    return {
      open: open,
      close: close,
      resize: resize,
      toggle: toggle
    };
  }

  window.utils = window.utils || {};
  window.utils.collapsible = collapsible;
})();
"use strict";

(function () {
  // UTILS.CREATE_EMITTER
  function createEmitter() {
    var cbs = {};

    function addEventCb(eventName, cb) {
      if (!(eventName in cbs)) cbs[eventName] = [];
      cbs[eventName].push(cb);
    }

    function removeEventCb(eventName, cb) {
      if (!(eventName in cbs)) return;
      if (!cb) cbs[eventName] = [];else cbs[eventName] = cbs[eventName].filter(function (_cb) {
        return cb === cb;
      });
    }

    function on(eventName, cb) {
      if (Array.isArray(eventName)) {
        eventName.forEach(function (e) {
          addEventCb(e, cb);
        });
      } else {
        addEventCb(eventName, cb);
      }
    }

    function off(eventName, cb) {
      if (Array.isArray(eventName)) {
        eventName.forEach(function (e) {
          return removeEventCb(e, cb);
        });
      } else {
        removeEventCb(eventName, cb);
      }
    }

    function emit(eventName, data) {
      if (!(eventName in cbs)) return;
      var eventCbs = cbs[eventName];
      if (!Array.isArray(eventCbs) || !eventCbs.length) return;
      eventCbs.forEach(function (cb) {
        return cb(data);
      });
    }

    return {
      on: on,
      off: off,
      emit: emit
    };
  }

  window.utils = window.utils || {};
  window.utils.createEmitter = createEmitter;
  window.utils.emitter = createEmitter();
})();
"use strict";

(function () {
  // UTILS.DEBOUNCE
  function debounce(func, wait, immediate) {
    var timeout;
    return function executedFunction() {
      var context = this;
      var args = arguments;

      var later = function later() {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };

      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  }

  window.utils = window.utils || {};
  window.utils.debounce = debounce;
})();
"use strict";

(function () {
  // UTILS.MEDIA_QUERY
  function addMediaQueryListener(query, cb) {
    var mqList = window.matchMedia(query);
    cb(mqList.matches);

    function check(e) {
      cb(e.matches);
    }

    mqList.addEventListener('change', check);
  }

  window.utils = window.utils || {};
  window.utils.addMediaQueryListener = addMediaQueryListener;
})();
"use strict";

(function () {
  // UTILS.SCROLLBAR_WIDTH
  function getScrollbarWidth() {
    var documentWidth = parseInt(document.documentElement.clientWidth);
    var windowsWidth = parseInt(window.innerWidth);
    var scrollbarWidth = windowsWidth - documentWidth;
    return scrollbarWidth;
  }

  window.utils = window.utils || {};
  window.utils.getScrollbarWidth = getScrollbarWidth;
})();
"use strict";

(function () {
  // UTILS.SUBMIT_FORM
  function submitForm(form, cb) {
    var formData = new FormData(form);
    var method = form.method;

    if (method.toUpperCase() === 'GET') {
      var params = new URLSearchParams(formData).toString();
      fetch(form.action + '?' + params).then(function (res) {
        return res.json();
      }).then(function (data) {
        return cb(data);
      });
    } else {
      fetch(form.action, {
        method: method,
        body: formData
      }).then(function (res) {
        return res.json();
      }).then(function (data) {
        return cb(data);
      });
    }
  }

  window.utils = window.utils || {};
  window.utils.submitForm = submitForm;
})();
"use strict";

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

(function () {
  // UTILS.VALIDATOR
  var events = {
    touch: 'form-validator-touch',
    changeStatus: 'form-validator-change-status'
  };
  var REQUIRED = 'required';
  var EMAIL = 'email';
  var MASK = 'mask';
  var FILE = 'file';
  var EMAIL_RE = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;

  function validateInput(field) {
    var rules = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var isValid = true;
    var error = '';
    var value = field.value;
    Object.entries(rules).forEach(function (_ref) {
      var _ref2 = _slicedToArray(_ref, 2),
          ruleName = _ref2[0],
          rule = _ref2[1];

      if (!isValid) return;

      switch (ruleName) {
        case REQUIRED:
          if (!value) {
            isValid = false;
            error = rule.message;
          }

          break;

        case FILE:
          if (field.files.length == 0) {
            isValid = false;
            error = rule.message;
          }

          break;

        case EMAIL:
          if (value) {
            var isEmail = EMAIL_RE.test(value);

            if (!isEmail) {
              isValid = false;
              error = rule.message;
            }
          }

          break;

        case MASK:
          if (value) {
            var re = rule.re;
            var isCorrect = re.test(value);

            if (!isCorrect) {
              isValid = false;
              error = rule.message;
            }
          }

          break;
      }
    });
    return {
      isValid: isValid,
      error: error
    };
  }

  function validateCheckbox(field) {
    var rules = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var isValid = true;
    var error = '';
    var checked = field.checked;
    Object.entries(rules).forEach(function (_ref3) {
      var _ref4 = _slicedToArray(_ref3, 2),
          ruleName = _ref4[0],
          rule = _ref4[1];

      switch (ruleName) {
        case REQUIRED:
          if (!checked) {
            isValid = false;
            error = rule.message;
          }

          break;
      }
    });
    return {
      isValid: isValid,
      error: error
    };
  }

  function createError() {
    var el = document.createElement('div');
    el.classList.add('form-error');
    return el;
  }

  function validator(form, rules) {
    var config = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
    var emitter = utils.createEmitter();
    var submitted = false;
    var $submitButton = form.querySelector('[type="submit"]');
    $submitButton.classList.add('disabled');
    var fields = Object.entries(rules).map(function (_ref5) {
      var _ref6 = _slicedToArray(_ref5, 2),
          fieldName = _ref6[0],
          fieldRules = _ref6[1];

      var field = form.elements[fieldName];
      if (!field) return;
      var validator;

      if (field.tagName === 'TEXTAREA') {
        validator = validateInput;
      } else if (field.type === 'checkbox') {
        validator = validateCheckbox;
      } else if (field.type === 'text') {
        validator = validateInput;
      } else if (field.type === 'file') {
        validator = validateInput;
      }

      if (!validator) return;
      var parent = config && config.parent && field.closest(config.parent);
      if (!parent) parent = field.parentElement;
      var fieldData = {
        name: fieldName,
        element: field,
        parent: parent,
        type: field.type,
        rules: fieldRules,
        touched: false,
        errorText: false,
        validator: validator,
        $error: null
      };

      function setError() {
        if (!submitted || fieldData.isValid) {
          if (fieldData.$error) {
            fieldData.$error.remove();
          }

          if (fieldData.type === FILE) {
            fieldData.element.closest('#drop-area').classList.remove('invalid');
          } else {
            fieldData.element.classList.remove('invalid');
          }
        } else {
          if (!fieldData.$error) {
            fieldData.$error = createError();
          }

          fieldData.$error.textContent = fieldData.errorText;
          fieldData.parent.appendChild(fieldData.$error);

          if (fieldData.type === FILE) {
            fieldData.element.closest('#drop-area').classList.add('invalid');
          } else {
            fieldData.element.classList.add('invalid');
          }
        }
      }

      function onChange(touch) {
        if (touch && !fieldData.touched) {
          fieldData.touched = true;
          emitter.emit(events.touch);
        }

        var _fieldData$validator = fieldData.validator(field, fieldRules),
            error = _fieldData$validator.error,
            isValid = _fieldData$validator.isValid;

        fieldData.errorText = error;
        fieldData.isValid = isValid;
        setError();
        emitter.emit(events.changeStatus);
      }

      onChange();
      field.addEventListener('change', function () {
        return onChange(true);
      });
      field.addEventListener('input', function () {
        return onChange(true);
      });
      field.addEventListener('changeDate', function () {
        return onChange(true);
      });
      fieldData.setError = setError;
      return fieldData;
    }).filter(Boolean);
    emitter.on(events.changeStatus, function () {
      var hasInvalidFields = fields.some(function (f) {
        return !f.isValid;
      });

      if (hasInvalidFields) {
        if (submitted) {
          $submitButton.disabled = true;
        } else {
          $submitButton.classList.add('disabled');
        }
      } else {
        $submitButton.disabled = false;
        $submitButton.classList.remove('disabled');
      }
    });
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      if (!submitted) {
        submitted = true;
        fields.forEach(function (f) {
          return f.setError();
        });
      }

      var hasInvalidFields = fields.some(function (f) {
        return !f.isValid;
      });

      if (!hasInvalidFields) {
        config && config.submit();
      }
    });
    return {
      fields: fields
    };
  }

  window.utils = window.utils || {};
  window.utils.validator = validator;
})();
"use strict";

(function () {
  // COMPONENTS.ACCORDION
  var selectors = {
    item: '.accordion-item',
    trigger: '.accordion-trigger',
    panel: '.accordion-item-panel'
  };
  var states = {
    active: 'active'
  };

  function accordion($element) {
    var setActive = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
    var changeButtonText = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
    if (!$element) return;
    var $items = $element.querySelectorAll(selectors.item);
    if (!$items.length) return;
    var items = [];
    $items.forEach(function ($item) {
      var trigger = $item.querySelector(selectors.trigger);
      var panel = $item.querySelector(selectors.panel);
      var collapsiblePanel = utils.collapsible(panel, 700);
      items.push({
        element: $item,
        trigger: trigger,
        panel: collapsiblePanel
      });
    });
    var activeItem = null;

    if (setActive) {
      activeItem = items[0];
    }

    function closePanel(item) {
      item.element.classList.remove(states.active);
      item.panel.close();

      if (changeButtonText) {
        item.trigger.textContent = 'Развернуть';
      }
    }

    var first = true;

    function openPanel(item) {
      item.element.classList.add(states.active);

      if (changeButtonText) {
        item.trigger.textContent = 'Свернуть';
      } // setTimeout(function () {


      item.panel.open(); // }, 450)

      if (!first) {}

      first = false;
    }

    function toggleItem(item) {
      if (item === activeItem) {
        closePanel(item);
        activeItem = null;
        return;
      }

      if (activeItem) {
        closePanel(activeItem);
        var yActive = activeItem.trigger.getBoundingClientRect().top + window.scrollY;
        var yOpened = item.trigger.getBoundingClientRect().top + window.scrollY;

        if (yActive > yOpened) {
          scrollTo(item.trigger.getBoundingClientRect().top + window.scrollY - 100, 400);
        } else {
          scrollTo(yActive - 100, 250);
        }
      }

      openPanel(item);
      activeItem = item;
    }

    if (setActive) {
      setTimeout(function () {
        openPanel(activeItem);
      }, 200);
    }

    items.forEach(function (item) {
      if (item.trigger) {
        item.trigger.addEventListener('click', function () {
          return toggleItem(item);
        });
      }
    });
    window.addEventListener('resize', function () {
      if (activeItem) {
        activeItem.panel.resize();
      }
    });
  }

  window.components = window.components || {};
  window.components.accordion = accordion;

  Math.easeInOutQuad = function (t, b, c, d) {
    t /= d / 2;
    if (t < 1) return c / 2 * t * t + b;
    t--;
    return -c / 2 * (t * (t - 2) - 1) + b;
  };

  function scrollTo(to, duration) {
    var element = document.scrollingElement;
    var start = element && element.scrollTop || window.pageYOffset,
        change = to - start,
        increment = 20;
    var currentTime = 150;

    var animateScroll = function animateScroll() {
      currentTime += increment;
      var val = Math.easeInOutQuad(currentTime, start, change, duration);
      window.scrollTo(0, val);

      if (currentTime < duration) {
        console.log(val);
        window.setTimeout(animateScroll, increment);
      }
    };

    animateScroll();
  }
})();
"use strict";

(function () {
  // COMPONENTS.ACCORDION
  var selectors = {
    item: '.filter-dropdown',
    trigger: '.filter-dropdown-title svg',
    panel: '.filter-dropdown-container'
  };
  var states = {
    active: 'active'
  };

  function accordionFilter($element) {
    var setActive = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
    if (!$element) return;
    var $items = $element;
    if (!$items.length) return;
    var items = [];
    $items.forEach(function ($item) {
      var trigger = $item.querySelector(selectors.trigger);
      var panel = $item.querySelector(selectors.panel);
      var collapsiblePanel = utils.collapsible(panel, 400);
      items.push({
        element: $item,
        trigger: trigger,
        panel: collapsiblePanel
      });
    });
    var activeItem = null;

    if (setActive) {
      activeItem = items[0];
    }

    function closePanel(item) {
      item.element.classList.remove(states.active);
      item.panel.close();
    }

    function openPanel(item) {
      item.element.classList.add(states.active);
      item.panel.open();
    }

    function toggleItem(item) {
      if (item === activeItem) {
        closePanel(item);
        activeItem = null;
        return;
      }

      if (activeItem) {
        closePanel(activeItem);
      }

      openPanel(item);
      activeItem = item;
    }

    if (setActive) {
      openPanel(activeItem);
    }

    items.forEach(function (item) {
      if (item.trigger) {
        item.trigger.addEventListener('click', function () {
          return toggleItem(item);
        });
      }
    });
    window.addEventListener('resize', function () {
      if (activeItem) {
        activeItem.panel.resize();
      }
    });
  }

  window.components = window.components || {};
  window.components.accordionFilter = accordionFilter;
})();
"use strict";

(function () {
  // COMPONENTS.AUTO_HEIGHT
  function autoHeight(element) {
    var defaultHeight = 50;

    function inputHandler() {
      element.style.height = defaultHeight + 'px';
      var height = element.scrollHeight;
      element.style.height = height + 'px';
    }

    element.style.resize = 'none';
    element.style.overflowY = 'hidden';
    element.style.height = element.scrollHeight + 'px';
    element.addEventListener('input', inputHandler);
    element.addEventListener('change', inputHandler);
    setTimeout(function () {
      inputHandler();
    }, 4);
  }

  window.components = window.components || {};
  window.components.autoHeight = autoHeight;
  document.querySelectorAll('textarea').forEach(function (el) {
    return autoHeight(el);
  });
})();
"use strict";

(function () {
  // COMPONENTS.AUTOCOMPLETE
  var selectors = {
    field: '[data-field]',
    reset: '[data-reset]',
    list: '[data-list]'
  };
  var actionAttr = 'data-autocomplete';
  var MIN_LENGTH = 2;
  var id = 1;

  function autocomplete(el) {
    var $field = el.querySelector(selectors.field);
    var $reset = el.querySelector(selectors.reset);
    var $list = el.querySelector(selectors.list);
    if (!$field || !$list) return;
    var action = el.getAttribute(actionAttr);
    var method = 'GET';
    var actualId = null;

    function updateList(items) {
      if (!items.length) {
        var _el = document.createElement('li');

        _el.classList.add('search-list-empty');

        _el.textContent = 'Ничего не найдено';
        $list.innerHTML = '';
        $list.appendChild(_el);
        return;
      }

      var fragment = document.createDocumentFragment();
      items.forEach(function (item) {
        var el = document.createElement('div');
        var link = document.createElement('a');
        link.href = item.link;
        var wrapper = document.createElement('span');
        wrapper.innerHTML = item.text;
        link.append(wrapper);
        el.appendChild(link);
        fragment.appendChild(el);
      });
      $list.innerHTML = '';
      $list.appendChild(fragment);
    }

    function showList() {
      $list.removeAttribute('hidden');
    }

    function hideList() {
      $list.setAttribute('hidden', true);
    }

    function loadOptions(q) {
      var requestId = id++;
      actualId = requestId;
      return fetch(action + "?q=".concat(q), {
        method: method
      }).then(function (res) {
        if (requestId === actualId) return res.json();
        throw new Error({
          error: 'The request is irrelevant',
          requestId: requestId
        });
      }).then(function (res) {
        return res.items;
      });
    }

    function resetList() {
      hideList();
      actualId = null;
      updateList([]);
    }

    var onInput = utils.debounce(function () {
      var value = $field.value;

      if (value.length < MIN_LENGTH) {
        resetList();
        return;
      }

      loadOptions(value).then(function (items) {
        updateList(items);
        showList();
      })["catch"](function (_ref) {
        var error = _ref.error,
            requestId = _ref.requestId;
        console.log(error, requestId);
      });
    }, 500);
    $field.addEventListener('input', onInput);

    if ($reset) {
      $reset.addEventListener('click', function () {
        utils.emitter.emit('close-search');
        $field.value = '';
        resetList();
      });
    }

    document.addEventListener('click', function (e) {
      if ($field.contains(e.target)) return;
      if ($list.contains(e.target)) return;
      $field.value = '';
      resetList();
    });
  }

  window.components = window.components || {};
  window.components.autocomplete = autocomplete;
  document.querySelectorAll('[data-search]').forEach(function (el) {
    return autocomplete(el);
  });
})();
"use strict";
"use strict";

(function () {
  // COMPONENTS.FADE_SLIDER
  var selectors = {
    container: '.fade-slider-slides',
    slide: '.fade-slider-slide',
    pagination: '.fade-slider-pagination'
  };
  var classes = {
    paginationItem: 'fade-slider-pagination__item'
  };
  var events = {
    changeSlide: 'fade-slider_change_slide'
  };
  var states = {
    active: 'active',
    paginationActive: 'active'
  };
  var THRESHOLD = 100;
  var AUTO_SLIDING_INTERVAL = 8000;

  function fadeSlider(element) {
    if (!element) return;
    var $container = element.querySelector(selectors.container);
    if (!$container) return;
    var $slides = $container.querySelectorAll(selectors.slide);
    if ($slides.length < 2) return;
    var emitter = utils.createEmitter();
    var slidesCount = $slides.length;
    var activeSlide = 0;
    var initialX,
        x1,
        x2,
        offset = 0;

    function changeSlide(index) {
      activeSlide = index;
      emitter.emit(events.changeSlide, index);
    }

    function move(diff) {
      offset = diff; // element.style.transform = `translateX(${diff}px)`;
    }

    function toSlide(index) {
      $slides[activeSlide].classList.remove(states.active);
      $slides[index].classList.add(states.active);
      changeSlide(index);
    }

    function prev() {
      var index = activeSlide > 0 ? activeSlide - 1 : slidesCount - 1;
      toSlide(index);
    }

    function next() {
      var index = activeSlide + 1;
      if (index >= slidesCount) index = 0;
      toSlide(index);
    }

    function onDragStart(e) {
      e = e || window.event;
      e.preventDefault();
      element.style.userSelect = 'none';
      element.style.cursor = 'grabbing';

      if (e.type == 'touchstart') {
        x1 = e.touches[0].clientX;
      } else {
        x1 = e.clientX;
        document.onmouseup = onDragEnd;
        document.onmousemove = onDragAction;
      }

      initialX = x1;
    }

    function onDragAction(e) {
      e = e || window.event;

      if (e.type == 'touchmove') {
        x2 = x1 - e.touches[0].clientX;
        x1 = e.touches[0].clientX;
      } else {
        x2 = x1 - e.clientX;
        x1 = e.clientX;
      }

      move(offset - x2);
    }

    function onDragEnd(e) {
      if (offset < -1 * THRESHOLD) {
        next();
        emitter.emit(events.touched);
      } else if (offset > THRESHOLD) {
        prev();
        emitter.emit(events.touched);
      }

      move(0);
      element.style.userSelect = '';
      element.style.cursor = '';
      document.onmouseup = null;
      document.onmousemove = null;
    }

    $container.onmousedown = onDragStart;
    $container.addEventListener('touchstart', onDragStart);
    $container.addEventListener('touchend', onDragEnd);
    $container.addEventListener('touchmove', onDragAction);
    var $pagination = element.querySelector(selectors.pagination);

    if ($pagination) {
      var setActivePaginationItem = function setActivePaginationItem(index) {
        $paginationItems.forEach(function ($item, i) {
          $item.classList.toggle(states.paginationActive, index === i);
        });
      };

      var $paginationItems = Array(slidesCount).fill(null).map(function (el, i) {
        var $item = document.createElement('div');
        $item.classList.add(classes.paginationItem);
        $item.dataset.slide = i;
        $pagination.appendChild($item);
        $item.addEventListener('click', function () {
          emitter.emit(events.touched);
          toSlide(i);
        });
        return $item;
      });
      setActivePaginationItem(activeSlide);
      emitter.on(events.changeSlide, function (slideIndex) {
        return setActivePaginationItem(slideIndex);
      });
    }

    if (element.hasAttribute('data-auto')) {
      var tick = function tick() {
        timer = setTimeout(function () {
          next();
          tick();
        }, AUTO_SLIDING_INTERVAL);
      };

      var timer = null;
      tick();
      emitter.on(events.touched, function () {
        clearTimeout(timer);
      });
    }
  }

  window.components = window.components || {};
  window.components.fadeSlider = fadeSlider;
})();
"use strict";

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

(function () {
  // COMPONENTS.INFINITE_SLIDER
  var selectors = {
    viewport: '.scroll-slider-viewport',
    container: '.scroll-slider-slides',
    slide: '.scroll-slider-slide',
    prev: '.scroll-slider-prev',
    next: '.scroll-slider-next',
    controls: '.scroll-slider-controls'
  };
  var states = {
    shifting: 'shifting',
    loaded: 'loaded',
    active: 'active'
  };
  var events = {
    changeSlide: 'scroll-slider_change_slide',
    clickPagination: 'scroll-slider_click_pagination',
    touched: 'scroll-slider_touched'
  };

  function removeClones($container) {
    var $slides = $container.querySelectorAll(selectors.slide);
    $slides.forEach(function ($slide) {
      if ($slide.dataset.clone) $slide.remove();
    });
  }

  function getVisibleSlides($container) {
    var $visibleSlides = _toConsumableArray($container.querySelectorAll(selectors.slide));

    $visibleSlides = $visibleSlides.filter(function (el) {
      if (el.hasAttribute('hidden')) return false;
      return true;
    });
    return $visibleSlides;
  }

  function createClone($slide, index, setIndex) {
    var $clone = $slide.cloneNode(true);
    $clone.dataset.clone = true;
    $clone.dataset.index = index;
    $clone.dataset.set = setIndex;
    return $clone;
  }

  function addCloneSet($container, $slides, setIndex) {
    var fragment = document.createDocumentFragment();
    $slides.forEach(function ($slide, i) {
      var $clone = createClone($slide, i, setIndex);
      fragment.appendChild($clone);
    });
    $container.appendChild(fragment, $container.children[0]);
  }

  function getActiveConfig(pageWidth, config) {
    if (!config.breakpoints) return config;
    var activeBreakpoint = Object.keys(config.breakpoints).reverse().find(function (key) {
      if (key <= pageWidth) return true;
    });

    if (activeBreakpoint) {
      return _objectSpread(_objectSpread({}, config), config.breakpoints[activeBreakpoint]);
    }

    return config;
  }

  function infiniteSlider(element, config) {
    if (!element) return;
    var $viewport = element.querySelector(selectors.viewport);
    if (!$viewport) return;
    var $container = element.querySelector(selectors.container);
    if (!$container) return;
    var $prev = element.querySelector(selectors.prev);
    var $next = element.querySelector(selectors.next);
    var emitter = utils.createEmitter();
    var pageWidth, // ширина всей страницы
    activeSlidesCount, // кол-во активных слайдов
    slideWidth, // ширина одного слайда
    sliderShift, // сдвиг слайда влево за пределы страницы
    sideOffset; // расстояние от начала страницы до первого активного слайда

    var trackShift, // смещение трека со слайдами относительно слайдера
    tmpTrackShift, initialX, // начало перемещения
    x1, x2, y1, y2, // координаты текущего перемещения
    lastCheckX; // величина сдвига при последнем перемещение слайдов

    var shifting;

    function init() {
      pageWidth = document.body.offsetWidth;
      var activeConfig = getActiveConfig(pageWidth, config);
      activeSlidesCount = activeConfig.slides;
      var offset = activeConfig.offset || 0;
      var isCenter = activeConfig.center;
      removeClones($container);
      var $visibleSlides = getVisibleSlides($container);
      $visibleSlides.forEach(function (el, i) {
        el.dataset.index = i;
      });
      slideWidth = $visibleSlides[0].offsetWidth;
      var isFit = pageWidth > slideWidth * activeSlidesCount;
      var setWidth = slideWidth * $visibleSlides.length;

      if (!isCenter) {
        sideOffset = offset;
      } else if (!isFit) {
        sideOffset = offset;
      } else {
        sideOffset = Math.round((pageWidth - slideWidth * activeSlidesCount) / 2);
      }

      var setsCount = Math.ceil(pageWidth / setWidth) + 1;
      var cloneSetsCount = Math.max(setsCount - 1, 2);

      for (var i = 0; i < cloneSetsCount; i++) {
        addCloneSet($container, $visibleSlides, i);
      }

      if (!isFit || !isCenter) {
        sliderShift = -1 * setWidth + offset;
      } else {
        sliderShift = -1 * ((Math.floor(sideOffset / setWidth) + 1) * setWidth - sideOffset);
      }

      $container.style.marginLeft = sliderShift + 'px';
      initialX = 0;
      lastCheckX = 0;
      setTrackShift(0);
      updateActiveSlides();
    }

    function setFirstActiveSlide(index) {
      var lastActiveSlide = index + activeSlidesCount - 1;
      getVisibleSlides($container).forEach(function (slide, i) {
        if (i >= index && i <= lastActiveSlide) {
          slide.classList.add(states.active);
        } else {
          slide.classList.remove(states.active);
        }
      });
    }

    function setTrackShift(shift, withoutCheck) {
      trackShift = shift;
      tmpTrackShift = shift;
      $container.style.transform = "translateX(".concat(trackShift, "px)");
      if (!withoutCheck) checkSlidesCountOnTheSides();
    }

    function checkSlidesCountOnTheSides() {
      var checkDiff = trackShift - lastCheckX;

      if (Math.abs(checkDiff) >= slideWidth) {
        moveSlide(checkDiff);
        lastCheckX = trackShift;
      }
    }

    function moveSlide(diff) {
      var slides = getVisibleSlides($container);

      if (diff < 0) {
        $container.appendChild(slides[0]);
        setTrackShift(trackShift + slideWidth);
      } else {
        $container.insertBefore(slides[slides.length - 1], slides[0]);
        setTrackShift(trackShift - slideWidth);
      }
    }

    function getDistanceToFirstActiveSlide() {
      return Math.abs(sliderShift + trackShift) + sideOffset;
    }

    function alignSlider() {
      var distance = getDistanceToFirstActiveSlide();
      var activeSlidesCount = Math.floor(distance / slideWidth);
      var diff = distance - activeSlidesCount * slideWidth;

      if (diff > slideWidth / 2) {
        activeSlidesCount = Math.ceil(distance / slideWidth);
      } else {
        activeSlidesCount = Math.floor(distance / slideWidth);
      }

      tempTransition(function () {
        checkSlidesCountOnTheSides();
        updateActiveSlides();
      });
      setTrackShift(-1 * sliderShift + sideOffset - activeSlidesCount * slideWidth, 'withoutCheck');
    }

    function updateActiveSlides() {
      var distance = getDistanceToFirstActiveSlide();
      var activeSlideIndex = Math.floor(distance / slideWidth);
      setFirstActiveSlide(activeSlideIndex);
    }

    function tempTransition(cb) {
      $container.style.transition = "transform 400ms ease-in-out";
      $container.addEventListener('transitionend', function () {
        $container.style.transition = '';
        setTimeout(function () {
          cb();
        });
      });
    }

    function toPrevSlide() {
      tempTransition(function () {
        checkSlidesCountOnTheSides();
        updateActiveSlides();
      });
      setTrackShift(trackShift + slideWidth, 'withoutCheck');
    }

    function toNextSlide() {
      tempTransition(function () {
        checkSlidesCountOnTheSides();
        updateActiveSlides();
      });
      setTrackShift(trackShift - slideWidth, 'withoutCheck');
    }

    function onDragStart(e) {
      element.style.userSelect = 'none';
      e = e || window.event;
      initialX = trackShift;
      lastCheckX = trackShift;

      if (e.type == 'touchstart') {
        x1 = e.touches[0].clientX;
        y1 = e.touches[0].clientY;
      } else {
        e.preventDefault();
        x1 = e.clientX;
        y1 = e.clientY;
        document.onmouseup = onDragEnd;
        document.onmousemove = onDragAction;
      }
    }

    function onDragEnd() {
      element.style.cursor = '';
      document.onmouseup = null;
      document.onmousemove = null;
      alignSlider();
      updateActiveSlides();
      setTimeout(function () {
        return shifting = false;
      });
    }

    function onDragAction(e) {
      e = e || window.event;

      if (e.type == 'touchmove') {
        x2 = x1 - e.touches[0].clientX;
        x1 = e.touches[0].clientX;
        y2 = y1 - e.touches[0].clientY;
        y1 = e.touches[0].clientY;

        if (shifting) {
          if (e.cancelable) {
            e.preventDefault();
          }

          setTrackShift(trackShift - x2);
          return;
        }

        tmpTrackShift = tmpTrackShift - x2;

        if (Math.abs(tmpTrackShift) > 5 && e.cancelable) {
          e.preventDefault();
          element.style.cursor = 'grabbing';
          shifting = true;
          setTrackShift(tmpTrackShift);
        }
      } else {
        x2 = x1 - e.clientX;
        x1 = e.clientX;
        y2 = y1 - e.clientY;
        y1 = e.clientY;
        shifting = true;
        if (e.cancelable) e.preventDefault();
        setTrackShift(trackShift - x2);
      }
    }

    $container.onmousedown = onDragStart;
    $container.addEventListener('touchstart', onDragStart);
    $container.addEventListener('touchend', onDragEnd);
    $container.addEventListener('touchmove', onDragAction);
    init();
    window.addEventListener('resize', utils.debounce(function () {
      init();
    }), 500);

    if ($prev) {
      $prev.addEventListener('click', toPrevSlide);
    }

    if ($next) {
      $next.addEventListener('click', toNextSlide);
    }

    element.addEventListener('click', function (e) {
      if (shifting) e.preventDefault();
    });
    element.infiniteSlider = {
      update: function update() {
        init();
      }
    };
  }

  window.components = window.components || {};
  window.components.infiniteSlider = infiniteSlider;
})();
"use strict";

(function () {
  // COMPONENTS.MODAL
  var selectors = {
    container: '.modal-container',
    close: '.modal-close'
  };
  var classes = {
    mask: 'modal-mask'
  };
  var events = {
    show: 'modal-show',
    hide: 'modal-hide',
    countChanged: 'modals-count-changed'
  };
  var unique = 1;
  var collection = {
    modals: [],
    add: function add(modal) {
      this.modals.push(modal);

      this._onChange();
    },
    remove: function remove(modal) {
      this.modals = this.modals.filter(function (m) {
        return m !== modal;
      });

      this._onChange();
    },
    _onChange: function _onChange() {
      var count = this.modals.length;
      document.body.classList.toggle('modals-shown', count > 0);
      utils.emitter.emit(events.countChanged, count);
    }
  };
  document.addEventListener('keydown', function (e) {
    if (e.code === 'Escape') {
      if (collection.modals.length) {
        var lastModal = collection.modals[collection.modals.length - 1];
        lastModal.hide();
      }
    }
  });

  function modal(element) {
    if (!element) return;
    document.body.append(element);
    var $container = element.querySelector(selectors.container);
    var isOpen = false;
    var id = unique++;
    var emitter = utils.createEmitter();

    function show() {
      emitter.emit(events.show);
      element.removeAttribute('hidden');
    }

    function hide() {
      emitter.emit(events.hide);
      element.setAttribute('hidden', true);
    }

    var instance = {
      show: show,
      hide: hide,
      id: id
    };
    emitter.on(events.show, function () {
      utils.emitter.emit(events.show, id);
      isOpen = true;
      collection.add(instance);
    });
    emitter.on(events.hide, function () {
      utils.emitter.emit(events.hide, id);
      isOpen = false;
      collection.remove(instance);
    });
    var $mask = document.createElement('div');
    $mask.classList.add(classes.mask);
    $container.insertBefore($mask, $container.children[0]);
    $mask.addEventListener('click', function () {
      return hide();
    });
    var $triggers = element.querySelectorAll(selectors.close);
    $triggers.forEach(function ($el) {
      $el.addEventListener('click', function () {
        return hide();
      });
    });
    return instance;
  }

  window.components = window.components || {};
  window.components.modal = modal;
  window.components.modals = collection;
})();
"use strict";

(function () {
  // COMPONENTS.PHONE_MASK
  function phoneMask(input) {
    var keyCode;

    function mask(event) {
      event.keyCode && (keyCode = event.keyCode);
      var pos = this.selectionStart;
      if (pos < 3) event.preventDefault();
      var matrix = '+7 (___) ___-__-__',
          i = 0,
          def = matrix.replace(/\D/g, ''),
          val = this.value.replace(/\D/g, '');
      if (val.length === 11 && val[0] === '8') val = '7' + val.slice(1);
      var new_value = matrix.replace(/[_\d]/g, function (a) {
        return i < val.length ? val.charAt(i++) || def.charAt(i) : a;
      });
      i = new_value.indexOf('_');

      if (i != -1) {
        i < 5 && (i = 3);
        new_value = new_value.slice(0, i);
      }

      var reg = matrix.substr(0, this.value.length).replace(/_+/g, function (a) {
        return '\\d{1,' + a.length + '}';
      }).replace(/[+()]/g, '\\$&');
      reg = new RegExp('^' + reg + '$');
      if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
      if (event.type == 'blur' && this.value.length < 5) this.value = '';
    }

    input.addEventListener('input', mask, false);
    input.addEventListener('focus', mask, false);
    input.addEventListener('blur', mask, false);
    input.addEventListener('keydown', mask, false);
  }

  window.components = window.components || {};
  window.components.phoneMask = phoneMask;
  document.querySelectorAll('[data-mask="phone"]').forEach(function (el) {
    return phoneMask(el);
  });
})();
"use strict";

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

(function () {
  // COMPONENTS.SCROLL_SLIDER
  var selectors = {
    viewport: '.scroll-slider-viewport',
    container: '.scroll-slider-slides',
    slide: '.scroll-slider-slide',
    prev: '.scroll-slider-prev',
    next: '.scroll-slider-next',
    controls: '.scroll-slider-controls'
  };
  var classes = {
    offset: 'scroll-slider-offset'
  };
  var states = {
    shifting: 'shifting',
    loaded: 'loaded',
    active: 'active'
  };
  var events = {
    changeSlide: 'scroll-slider_change_slide',
    clickPagination: 'scroll-slider_click_pagination',
    touched: 'scroll-slider_touched'
  };
  var THRESHOLD = 100;

  function scrollSlider(element) {
    if (!element) return;
    var $viewport = element.querySelector(selectors.viewport);
    if (!$viewport) return;
    var $container = element.querySelector(selectors.container);
    if (!$container) return;
    var $slides = [];
    var emitter = utils.createEmitter();
    var slideWidth,
        slidesCount,
        activeSlide = 0;
    var x1 = 0,
        x2 = 0,
        initialX,
        finalX;
    var shifting = false,
        blocked = false;
    element.addEventListener('click', function (e) {
      if (shifting) e.preventDefault();
    });
    var $offset = document.createElement('div');
    $offset.classList.add(classes.offset);
    $container.insertBefore($offset, $container.children[0]);
    $container.appendChild($offset.cloneNode(true));
    var $prev = element.querySelector(selectors.prev);
    var $next = element.querySelector(selectors.next);
    var $controls = element.querySelector(selectors.controls);

    function orderSlides(index) {
      $slides.forEach(function (el, i) {
        el.classList.toggle(states.active, i === index);
        el.setAttribute('data-order', i - index + 1);
      });
    }

    function setActiveSlide(index) {
      activeSlide = index;
      emitter.emit(events.changeSlide);
      orderSlides(index);
    }

    function scrollTo(x, smooth) {
      $viewport.scrollTo({
        left: x,
        behavior: smooth && 'smooth'
      });
      setTimeout(function () {
        if ($next) $next.disabled = $viewport.scrollLeft + $viewport.offsetWidth >= $viewport.scrollWidth;
        if ($prev) $prev.disabled = x < 10;
      }, 400);
    }

    function scrollToActiveSlide(smooth) {
      var diff = slideWidth * activeSlide;
      scrollTo(diff, smooth);
    }

    function alignSlider(dir) {
      var scroll = $viewport.scrollLeft;
      var index = dir < 0 ? Math.ceil(scroll / slideWidth) : Math.floor(scroll / slideWidth);
      setActiveSlide(index);
      scrollToActiveSlide(true);
    }

    function onDragStart(e) {
      if (blocked) return;
      element.style.userSelect = 'none';
      element.style.cursor = 'grabbing';
      e = e || window.event;
      e.preventDefault();
      initialX = $viewport.scrollLeft;

      if (e.type == 'touchstart') {
        x1 = e.touches[0].clientX;
      } else {
        x1 = e.clientX;
        document.onmouseup = onDragEnd;
        document.onmousemove = onDragAction;
      }
    }

    function onDragAction(e) {
      if (blocked) return;
      e = e || window.event;

      if (e.type == 'touchmove') {
        x2 = x1 - e.touches[0].clientX;
        x1 = e.touches[0].clientX;
      } else {
        x2 = x1 - e.clientX;
        x1 = e.clientX;
      }

      scrollTo(x2 + $viewport.scrollLeft);
    }

    function onDragEnd(e) {
      finalX = $viewport.scrollLeft;

      if (finalX - initialX < -THRESHOLD) {
        shifting = true;
        alignSlider(1);
        emitter.emit(events.touched);
      } else if (finalX - initialX > THRESHOLD) {
        shifting = true;
        alignSlider(-1);
        emitter.emit(events.touched);
      } else {
        scrollTo(initialX, true);
      }

      element.style.userSelect = '';
      element.style.cursor = '';
      document.onmouseup = null;
      document.onmousemove = null;
      setTimeout(function () {
        shifting = false;
      });
    }

    window.addEventListener('resize', function () {
      slideWidth = $slides[0].offsetWidth;
      scrollToActiveSlide();
    });
    $container.onmousedown = onDragStart;
    $container.addEventListener('touchstart', onDragStart);
    $container.addEventListener('touchend', onDragEnd);
    $container.addEventListener('touchmove', onDragAction);

    if ($prev) {
      $prev.addEventListener('click', function () {
        if (activeSlide > 0) {
          setActiveSlide(activeSlide - 1);
          scrollToActiveSlide(true);
        }
      });
    }

    if ($next) {
      $next.addEventListener('click', function () {
        if ($viewport.scrollLeft + $viewport.offsetWidth < $viewport.scrollWidth) {
          setActiveSlide(activeSlide + 1);
          scrollToActiveSlide(true);
        }
      });
    }

    function init() {
      $slides = _toConsumableArray($container.querySelectorAll(selectors.slide)).filter(function (el) {
        return !el.hasAttribute('hidden');
      });
      slideWidth = $slides[0].offsetWidth;
      slidesCount = $slides.length;
      activeSlide = 0;
      if ($prev) $prev.disabled = true;
      if ($next) $next.disabled = false;
      $viewport.scrollLeft = 0;
      orderSlides(activeSlide);

      if ($viewport.scrollWidth - $viewport.offsetWidth <= 40) {
        blocked = true;
        if ($next) $next.disabled = true;
      } else {
        blocked = false;
        if ($next) $next.disabled = false;
      }
    }

    init();
    element.scrollSlider = {
      update: function update() {
        init();
      }
    };
  }

  window.components = window.components || {};
  window.components.scrollSlider = scrollSlider;
})();
"use strict";
"use strict";

(function () {
  // COMPONENTS.TAB
  var selectors = {
    itemBody: '.tab-body__item',
    itemHead: '.tab-head__item',
    trigger: '.tab-head__button'
  };
  var states = {
    active: 'active'
  };

  function tab($element) {
    if (!$element || !$element.classList.contains('tab')) return;
    var $headItems = $element.querySelectorAll(selectors.itemHead);
    if (!$headItems.length) return;
    var items = [];
    $headItems.forEach(function ($item) {
      var tabName = $item.dataset.type;
      var trigger = $item.querySelector(selectors.trigger);
      var $bodyItem = $element.querySelector(selectors.itemBody + "[data-type=\"".concat(tabName, "\"]"));
      items.push({
        headElement: $item,
        bodyElement: $bodyItem,
        trigger: trigger
      });
    });
    var activeItem = items[1];

    function closeTab(item) {
      item.bodyElement.classList.remove(states.active);
      item.trigger.classList.remove(states.active);
    }

    function openTab(item) {
      item.bodyElement.classList.add(states.active);
      item.trigger.classList.add(states.active);
    }

    function toggleItem(item) {
      if (item === activeItem) {
        return;
      }

      if (activeItem) closeTab(activeItem);
      openTab(item);
      activeItem = item;
    }

    openTab(activeItem);
    items.forEach(function (item) {
      if (item.trigger) {
        item.trigger.addEventListener('click', function () {
          return toggleItem(item);
        });
      }
    });
  }

  window.components = window.components || {};
  window.components.tab = tab;
})();
"use strict";

(function () {
  // COMPONENTS.TOP_BUTTON
  var $topButtonContainer = document.querySelector('.top-button');
  if (!$topButtonContainer) return;
  var $topButton = $topButtonContainer.querySelector('button');
  if (!$topButton) return;
  var SCROLL_LIMIT = 200;

  function hideButton() {
    $topButton.setAttribute('hidden', true);
  }

  function showButton() {
    $topButton.removeAttribute('hidden');
  }

  function toTop() {
    document.documentElement.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  }

  $topButton.addEventListener('click', function () {
    return toTop();
  });
  window.addEventListener('scroll', function () {
    var scroll = document.documentElement.scrollTop || document.body.scrollTop;

    if (scroll > SCROLL_LIMIT) {
      showButton();
    } else {
      hideButton();
    }
  }, {
    passive: true
  });
})();
"use strict";

(function () {
  // PART.VACANT
  var selectors = {
    controlItemButton: '.js-control-item-button',
    blockItem: '.js-item',
    searchInput: '.js-input-search',
    searchField: '.js-input-search-field',
    searchClear: '.js-input-search-clear',
    controlText: '.js-control-text',
    controlMore: '.js-control-more',
    body: '.vacancies-vacant__body'
  };
  var states = {
    active: 'active',
    filled: 'filled',
    filtered: 'filtered'
  };

  function vacant($element) {
    var pagesize = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 6;
    if (!$element || !$element.classList.contains('vacant')) return;
    var $controlFilterItems = $element.querySelectorAll(selectors.controlItemButton);
    var $searchInput = $element.querySelector(selectors.searchInput);
    var $searchField = $element.querySelector(selectors.searchField);
    var $searchInputClear = $element.querySelector(selectors.searchClear);
    var $body = $element.querySelector(selectors.body);
    var pagesizeAttr = $element.dataset.pageSize;
    var fullLength = $element.dataset.fullLength;
    var formUrl = $element.dataset.action;
    var formMethod = $element.dataset.method;
    var $controlTextBlock = $element.querySelector(selectors.controlText);
    var $controlMoreBtn = $element.querySelector(selectors.controlMore);
    var currentPage = 1;
    setMoreBtn(fullLength, currentPage, pagesizeAttr);
    setControlText(fullLength, currentPage, pagesizeAttr);
    $searchInput.addEventListener('input', function () {
      checkFilled($searchField, this.value);
      var filterblock = getFiltersArray();
      getData(filterblock);
    });
    $searchInputClear.addEventListener('click', function () {
      $searchInput.value = '';
      checkFilled($searchField, $searchInput.value);
      var filterblock = getFiltersArray();
      getData(filterblock);
    });
    $controlFilterItems.forEach(function (item) {
      item.addEventListener('click', function () {
        if (!item.classList.contains(states.active)) {
          $controlFilterItems.forEach(function (item) {
            item.classList.remove(states.active);
          });
          item.classList.add(states.active);
          var filterblock = getFiltersArray();
          getData(filterblock);
        }
      });
    });
    $controlMoreBtn.addEventListener('click', function () {
      var filterblock = getFiltersArray(false);
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

    function setItems(data) {
      var html = '';
      data.items.forEach(function (item) {
        html += "\n                    <div class=\"js-item col col-12 col-sm-6 col-md-4\" >\n                        <a class=\"vacancies-vacant__item\" href=\"".concat(item.link, "\">\n                        <div class=\"vacancies-vacant__item__subtitle\">").concat(item.subtitle, "</div>\n                        <div class=\"vacancies-vacant__item__title\">").concat(item.title, "</div>\n                        <div class=\"vacancies-vacant__item__icon\">\n                                <svg width=\"58\" height=\"44\">\n                                  <use xlink:href=\"#i-").concat(item.icon, "\"></use>\n                                </svg>\n                        </div>\n                        </a>\n                    </div>\n                    ");
      });
      fullLength = data.size;
      setMoreBtn(fullLength, currentPage, pagesizeAttr);
      setControlText(fullLength, currentPage, pagesizeAttr);

      if (currentPage === 1) {
        $body.innerHTML = html;
      } else {
        $body.insertAdjacentHTML('beforeend', html);
      }
    }

    function getFiltersArray() {
      var first = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

      if (first) {
        currentPage = 1;
      } else {
        ++currentPage;
      }

      return {
        query: $searchInput.value ? $searchInput.value : null,
        filter_type: $element.querySelector(selectors.controlItemButton + '.active').dataset.type ? $element.querySelector(selectors.controlItemButton + '.active').dataset.type : null,
        page: currentPage
      };
    }

    function setControlText(fullLength, page, pageSize) {
      if (page * pageSize < fullLength) {
        $controlTextBlock.textContent = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(+page * +pageSize, " \u0438\u0437 ").concat(fullLength);
      } else {
        $controlTextBlock.textContent = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(fullLength, " \u0438\u0437 ").concat(fullLength);
      }
    }

    function checkFilled($element, value) {
      if (value) {
        $element.classList.add(states.filled);
      } else {
        $element.classList.remove(states.filled);
      }
    }

    function setMoreBtn(fullLength, page, pageSize) {
      if (page * pageSize < fullLength) {
        $controlMoreBtn.classList.add(states.active);

        if (fullLength - page * pageSize > pagesize) {
          $controlMoreBtn.textContent = "\u0415\u0449\u0435 ".concat(pagesize);
        } else {
          $controlMoreBtn.textContent = "\u0415\u0449\u0435 ".concat(fullLength - page * pageSize);
        }
      } else {
        $controlMoreBtn.classList.remove(states.active);
      }
    }
  }

  window.components = window.components || {};
  window.components.vacant = vacant;
})();
"use strict";

(function () {
  var $CourseModal = document.getElementById('course-modal');
  if (!$CourseModal) return;
  var modal = components.modal($CourseModal);
  var triggers = document.querySelectorAll('[data-course-modal]');
  triggers.forEach(function (el) {
    el.addEventListener('click', function () {
      return modal.show();
    });
  });
  var courseModalForm = document.getElementById('course-modal-form');

  if (courseModalForm) {
    var $submit = courseModalForm.querySelector('[type="submit"]');
    var validator = utils.validator(courseModalForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      company: {
        required: {
          message: 'Обязательное поле'
        }
      },
      position: {
        required: {
          message: 'Обязательное поле'
        }
      },
      license: {
        required: {
          message: 'Обязательное поле'
        }
      },
      question: {
        required: {
          message: 'Обязательное поле'
        }
      },
      support: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        required: {
          message: 'Обязательное поле'
        },
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        courseModalForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(courseModalForm, function (response) {
          if ($submit) $submit.disabled = false;
          courseModalForm.classList.remove('pending');

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }

  window.parts = window.parts || {};
  window.parts.courseModalForm = modal;
})();
"use strict";

(function () {
  // PARTS.CONTACTS
  var $header = document.querySelector('.header');
  if (!$header) return;
  var $contactsBlock = $header.querySelector('.header-contacts');
  if (!$contactsBlock) return;
  var $trigger = $contactsBlock.querySelector('.header-contacts__trigger');
  var $panel = $contactsBlock.querySelector('.header-contacts__pane');
  if (!$trigger || !$panel) return;

  function showPanel() {
    $panel.removeAttribute('hidden');
  }

  function hidePanel() {
    $panel.setAttribute('hidden', true);
  }

  var open = false;
  var fixed = false;
  var emitter = utils.createEmitter();
  emitter.on('show', function () {
    showPanel();
    open = true;
    $trigger.classList.add('opened');
  });
  emitter.on('fix', function () {
    fixed = true;
  });
  emitter.on('hide', function () {
    hidePanel();
    open = false;
    fixed = false;
    $trigger.classList.remove('opened');
  });
  $trigger.addEventListener('click', function () {
    if (open) {
      if (fixed) {
        emitter.emit('hide');
      } else {
        emitter.emit('fix');
      }
    } else {
      emitter.emit('show');
      emitter.emit('fix');
    }
  });
  $trigger.addEventListener('mouseenter', function (e) {
    if (e.target !== e.currentTarget) return;
    if (open) return;
    emitter.emit('show');
  });
  $contactsBlock.addEventListener('mouseleave', function (e) {
    if (e.target !== e.currentTarget) return;
    if (!open) return;
    if (fixed) return;
    emitter.emit('hide');
  });
  document.addEventListener('click', function (e) {
    if (!open) return;
    if (e.target.closest('.header-contacts')) return;
    emitter.emit('hide');
  });
  utils.emitter.on('modal-show', function () {
    if (!open) return;
    emitter.emit('hide');
  });
})();
"use strict";

(function () {
  // PARTS.HEADER_NAVIGATION
  var $header = document.querySelector('.header');
  if (!$header) return;
  var $navigation = $header.querySelector('.header-navigation');
  if (!$navigation) return;
  var $itemsWithMenu = $navigation.querySelectorAll('[data-submenu]');
  var items = [];
  $itemsWithMenu.forEach(function ($item) {
    var $panel = $item.querySelector(".header-navigation-pane");
    if (!$panel) return;
    var $mask = document.createElement('div');
    $mask.classList.add('header-navigation-pane__mask');
    $panel.insertBefore($mask, $panel.children[0]);
    var $block = $panel.querySelector('.header-navigation-pane__block');
    items.push({
      element: $item,
      block: $block,
      panel: $panel,
      mask: $mask
    });
  });
  var activeItem = null; // открытая вкладка

  var fixedActiveItem = null; // зафиксированная (клик) вкладка

  function openItem(item) {
    item.panel.removeAttribute('hidden');
    document.body.classList.add('header-pane-opened');
  }

  function closeItem(item) {
    item.panel.setAttribute('hidden', true);
    document.body.classList.remove('header-pane-opened');
  }

  items.forEach(function (item) {
    item.element.addEventListener('click', function (e) {
      if (e.target.classList.contains('header-navigation-pane__mask')) return;

      if (fixedActiveItem === item) {
        if (item.panel.contains(e.target)) return;
        fixedActiveItem = null;
        activeItem = null;
        closeItem(item);
      } else if (activeItem === item) {
        fixedActiveItem = item;
      } else {
        openItem(item);
        activeItem = item;
        fixedActiveItem = item;
      }
    });
    item.element.addEventListener('mouseenter', function (e) {
      if (e.target === e.currentTarget) {
        if (activeItem === item) return;

        if (fixedActiveItem && fixedActiveItem !== item) {
          closeItem(fixedActiveItem);
          fixedActiveItem = null;
        }

        activeItem = item;
        openItem(item);
      }
    });
    item.mask.addEventListener('mouseenter', function (e) {
      if (e.target === e.currentTarget) {
        if (activeItem === item && fixedActiveItem !== item) {
          closeItem(item);
        }
      }
    });
    item.mask.addEventListener('click', function (e) {
      console.log('mask click', item, activeItem);

      if (activeItem === item) {
        closeItem(item);
        activeItem = null;
        fixedActiveItem = null;
      }
    });
    item.element.addEventListener('mouseleave', function (e) {
      if (e.target === e.currentTarget) {
        if (fixedActiveItem === item) return;

        if (activeItem === item) {
          closeItem(item, 'mouseleave');
          activeItem = null;
          if (fixedActiveItem === item) fixedActiveItem = null;
        }
      }
    });
  });
  document.addEventListener('click', function (e) {
    if (!activeItem) return;
    if (e.target.closest('.header-navigation-pane')) return;
    if (e.target.closest('[data-submenu]')) return;
    items.forEach(function (item) {
      closeItem(item, 'click outside');
      activeItem = null;
      fixedActiveItem = null;
    });
  });
})();
"use strict";

(function () {
  // PARTS.HEADER_PANE
  var $header = document.querySelector('.header');
  if (!$header) return;
  var $toggler = $header.querySelector('.header-toggler');
  var $pane = $header.querySelector('.header-pane');
  if (!$toggler || !$pane) return;
  var $headerView = $header.querySelector('.header-view');
  var $paneMask = $pane.querySelector('.header-pane__mask');
  var isLargeScreen = false;
  utils.addMediaQueryListener('(min-width: 1280px)', function (state) {
    isLargeScreen = state;

    if (state) {
      closePane();
    }
  });

  function openPane() {
    if (isLargeScreen) return;
    $pane.removeAttribute('hidden');
    $toggler.removeAttribute('data-closed');
    document.body.classList.add('header-pane-opened');
  }

  function closePane() {
    $pane.setAttribute('hidden', true);
    $toggler.setAttribute('data-closed', true);
    document.body.classList.remove('header-pane-opened');
  }

  function togglePane() {
    var isHidden = $pane.hasAttribute('hidden');
    if (isHidden) openPane();else closePane();
  }

  $toggler.addEventListener('click', function () {
    togglePane();
  });

  if ($paneMask) {
    $paneMask.addEventListener('click', function () {
      closePane();
    });
  }

  utils.emitter.on('modal-show', function () {
    closePane();
  });
})();
"use strict";

(function () {
  // PARTS.HEADER_SEARCH
  var $header = document.querySelector('.header');
  if (!$header) return;
  var $headerView = $header.querySelector('.header-view');
  var $searchBlock = document.querySelector('.header-search');
  var $trigger = $searchBlock.querySelector('.header-search__trigger');
  $trigger.addEventListener('click', function () {
    $headerView.classList.add('header-search-opened');
  });
  utils.emitter.on('close-search', function () {
    $headerView.classList.remove('header-search-opened');
  });
})();
"use strict";

(function () {
  // PARTS.HEADER
  var $header = document.querySelector('.header');
  if (!$header) return;
  document.addEventListener('scroll', function (e) {
    $header.classList.toggle('fixed', document.documentElement.scrollTop > 10);
  }, {
    passive: true
  });
  var $menu = document.querySelector('.header-menu');

  if ($menu) {
    var $menuSections = $menu.querySelectorAll('.header-menu-section');
    $menuSections.forEach(function ($section) {
      var $toggler = $section.querySelector('.header-menu-section__toggler');
      if (!$toggler) return;
      var $sectionList = $section.querySelector('.header-menu-section__items');
      if (!$sectionList) return;
      var list = utils.collapsible($sectionList, 400);
      $toggler.addEventListener('click', function () {
        list.toggle();
      });
    });
  }
})();
"use strict";

(function () {
  var $PartnerModal = document.getElementById('partner-modal');
  if (!$PartnerModal) return; //attachment field

  var dropArea = document.getElementById('drop-area');
  var inputFile = dropArea.querySelector('input[type="file"]');
  var dropAreaUploaded = document.getElementById('drop-area-uploaded');
  var removeAttachment = dropAreaUploaded.querySelector('svg');
  removeAttachment.addEventListener('click', function () {
    dropAreaUploaded.style.display = 'none';
    dropArea.style.display = 'flex';
    inputFile.value = '';

    if (!/safari/i.test(navigator.userAgent)) {
      inputFile.type = '';
      inputFile.type = 'file';
    }
  });
  inputFile.addEventListener('change', function (e) {
    var file = this.files[0];

    if (file) {
      previewFile(file);
    }
  });
  ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(function (eventName) {
    dropArea.addEventListener(eventName, preventDefaults, false);
  });

  function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
  }

  ;
  ['dragenter', 'dragover'].forEach(function (eventName) {
    dropArea.addEventListener(eventName, highlight, false);
  });
  ['dragleave', 'drop'].forEach(function (eventName) {
    dropArea.addEventListener(eventName, unhighlight, false);
  });

  function highlight(e) {
    dropArea.classList.add('highlight');
  }

  function unhighlight(e) {
    dropArea.classList.remove('highlight');
  }

  dropArea.addEventListener('drop', handleDrop, false);

  function handleDrop(e) {
    inputFile.files = e.dataTransfer.files;
    inputFile.dispatchEvent(event);
  }

  function previewFile(file) {
    var fileName = file.name;
    dropArea.style.display = 'none';
    var nameField = dropAreaUploaded.querySelector('span');
    nameField.textContent = fileName;
    dropAreaUploaded.style.display = 'block';
  }

  var modal = components.modal($PartnerModal);
  var triggers = document.querySelectorAll('[data-partner-modal]');
  triggers.forEach(function (el) {
    el.addEventListener('click', function () {
      return modal.show();
    });
  });
  var partnerModalForm = document.getElementById('partner-modal-form');

  if (partnerModalForm) {
    var $submit = partnerModalForm.querySelector('[type="submit"]');
    var validator = utils.validator(partnerModalForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      company: {
        required: {
          message: 'Обязательное поле'
        }
      },
      position: {
        required: {
          message: 'Обязательное поле'
        }
      },
      numberinn: {
        required: {
          message: 'Обязательное поле'
        }
      },
      license: {
        required: {
          message: 'Обязательное поле'
        }
      },
      question: {
        required: {
          message: 'Обязательное поле'
        }
      },
      attachment: {
        file: {
          message: 'Обязательное поле'
        }
      },
      support: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        required: {
          message: 'Обязательное поле'
        },
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        partnerModalForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(partnerModalForm, function (response) {
          if ($submit) $submit.disabled = false;
          partnerModalForm.classList.remove('pending');

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }

  window.parts = window.parts || {};
  window.parts.partnerModalForm = modal;
})();
"use strict";

(function () {
  // PARTS.QUESTION_FORM
  var $questionModal = document.getElementById('question');
  if (!$questionModal) return;
  var modal = components.modal($questionModal);
  var triggers = document.querySelectorAll('[data-ask-question]');
  triggers.forEach(function (el) {
    el.addEventListener('click', function () {
      return modal.show();
    });
  });
  var questionForm = document.getElementById('ask-question-form');

  if (questionForm) {
    var $submit = questionForm.querySelector('[type="submit"]');
    var validator = utils.validator(questionForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      company: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        questionForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(questionForm, function (response) {
          if ($submit) $submit.disabled = false;
          questionForm.classList.remove('pending');

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }

  window.parts = window.parts || {};
  window.parts.questionModal = modal;
})();
"use strict";

(function () {
  // PARTS.SUCCESS_MODAL
  window.parts = window.parts || {};

  window.parts.successModal = function () {
    var $successModal = document.getElementById('success-modal');

    if ($successModal) {
      return components.modal($successModal);
    }

    return null;
  }();
})();
"use strict";

// Общие скрипты для всех страниц
(function () {
  // Ширина скроллбара
  document.documentElement.style.setProperty('--scrollbar-width', utils.getScrollbarWidth() + 'px');
  window.addEventListener('resize', function () {
    document.documentElement.style.setProperty('--scrollbar-width', utils.getScrollbarWidth() + 'px');
  }, {
    passive: true
  });
  var x, i, j, l, ll, selElmnt, a, b, c;
  /* Look for any elements with the class "custom-select": */

  x = document.getElementsByClassName("custom-select");
  l = x.length;

  for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    ll = selElmnt.length;
    /* For each element, create a new DIV that will act as the selected item: */

    a = document.createElement("DIV");
    var s = document.createElement("SPAN");
    a.setAttribute("class", "select-selected");
    s.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    a.appendChild(s);

    if (selElmnt.selectedIndex === 0) {
      a.classList.add('start');
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
      c.addEventListener("click", function (e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;

        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = "<span>".concat(this.innerHTML, "</span><span class=\"close-icon\"><svg width=\"15\" height=\"15\"><use xlink:href=\"#i-close-custom\"></use></svg></span>");
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;

            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }

            this.setAttribute("class", "same-as-selected");
            var closeIcon = h.querySelector('.close-icon');
            closeIcon.addEventListener('click', function (e) {
              e.stopPropagation();
              s.selectedIndex = 0;
              h.innerHTML = "<span>".concat(s.options[0].innerHTML, "</span>");
              a.classList.add('start');
            });
            break;
          }
        }

        h.click();
      });
      b.appendChild(c);
    }

    x[i].appendChild(b);
    a.addEventListener("click", function (e) {
      /* When the select box is clicked, close any other select boxes,
      and open/close the current select box: */
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
      this.classList.remove('start');
    });
  }

  function closeAllSelect(elmnt) {
    /* A function that will close all select boxes in the document,
    except the current select box: */
    var x,
        y,
        i,
        xl,
        yl,
        arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;

    for (i = 0; i < yl; i++) {
      if (elmnt == y[i]) {
        arrNo.push(i);
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
})();
"use strict";

document.addEventListener('DOMContentLoaded', function () {
  (function () {
    // PAGES.ABOUT_PAGE
    var page = document.querySelector('.page');
    if (!page) return;
    var isAboutPage = document.querySelector('.about-page');
    if (!isAboutPage) return;
    var rightArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-right\" href=\"#i-chevron-right\"></use>\n              </svg>";
    var leftArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-left\" href=\"#i-chevron-left\"></use>\n              </svg>";
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
      controls: true,
      autoplay: false,
      controlsPosition: 'bottom',
      controlsText: [leftArrow, rightArrow]
    });
    var tabs = document.querySelectorAll('.tab');

    if (tabs.length) {
      tabs.forEach(function (item) {
        components.tab(item);
      });
    }

    if (window.innerWidth < 1024) {
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
            items: 2
          }
        }
      });
    }

    if (window.innerWidth < 767) {
      var teamSlider = tns({
        container: '.about-team__users',
        autoWidth: false,
        items: 2,
        nav: false,
        touch: true,
        mouseDrag: true,
        preventScrollOnTouch: "inner",
        gutter: 13,
        autoHeight: true,
        slideBy: 1,
        controls: true,
        autoplay: false,
        controlsPosition: 'bottom',
        controlsText: [leftArrow, rightArrow],
        responsive: {
          640: {
            autoWidth: true
          }
        }
      });
    }
  })();
});
"use strict";

(function () {
  // PAGES.ABOUT_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isAwardsItemPage = document.querySelector('.awards-item-page');
  if (!isAwardsItemPage) return;
  var rightArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-right\" href=\"#i-chevron-right\"></use>\n              </svg>";
  var leftArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-left\" href=\"#i-chevron-left\"></use>\n              </svg>";

  if (document.querySelector('#awards-item-page__images-slider__top')) {
    var aboutTeamSlider = tns({
      container: '#awards-item-page__images-slider__top',
      controlsPosition: 'top',
      controlsContainer: document.querySelector('.js-slider-control-1'),
      controlsText: [leftArrow, rightArrow],
      navAsThumbnails: true,
      items: 1,
      touch: true,
      mouseDrag: true,
      preventScrollOnTouch: "inner",
      slideBy: 1,
      loop: false,
      controls: false,
      autoplay: false
    });
  } //photoswipe gallery modified to natural width and height and  my-gallery find figure element(not child element)


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
"use strict";

(function () {
  // PAGES.ABOUT_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isAwardsPage = document.querySelector('.awards-page');
  if (!isAwardsPage) return;
  var awardsBlock = document.querySelector('.awards-page__content');
  var selectors = {
    controlItem: '.js-control-item',
    controlItemButton: '.js-control-item-button',
    blockItem: '.js-item',
    controlText: '.js-control-text',
    controlMore: '.js-control-more',
    body: '.awards-page__body'
  };
  var states = {
    active: 'active',
    filled: 'filled',
    filtered: 'filtered'
  };

  function awardFilter($element) {
    var pagesize = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 6;
    if (!$element || !$element.classList.contains('awards-page__content')) return;
    var $controlFilterItems = $element.querySelectorAll(selectors.controlItemButton);
    var $body = $element.querySelector(selectors.body);
    var pagesizeAttr = $element.dataset.pageSize;
    var fullLength = $element.dataset.fullLength;
    var formUrl = $element.dataset.action;
    var formMethod = $element.dataset.method;
    var $controlTextBlock = $element.querySelector(selectors.controlText);
    var $controlMoreBtn = $element.querySelector(selectors.controlMore);
    var currentPage = 1;
    setMoreBtn(fullLength, currentPage, pagesizeAttr);
    setControlText(fullLength, currentPage, pagesizeAttr);
    $controlFilterItems.forEach(function (item) {
      item.addEventListener('click', function () {
        if (!item.classList.contains(states.active)) {
          $controlFilterItems.forEach(function (item) {
            item.classList.remove(states.active);
          });
          item.classList.add(states.active);
          var filterblock = getFiltersArray();
          getData(filterblock);
        }
      });
    });
    $controlMoreBtn.addEventListener('click', function () {
      var filterblock = getFiltersArray(false);
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

    function setItems(data) {
      var html = '';
      data.items.forEach(function (item) {
        html += "\n                <div class=\"js-item col col-12 col-md-6\">\n                    <a class=\"awards-page__item\" href=\"".concat(item.link, "\">\n                      <div class=\"awards-page__item__image\"><img src=\"").concat(item.image, "\" alt=\"#\"></div>\n                      <div class=\"awards-page__item__text\">\n                        <div class=\"awards-page__item__title\">").concat(item.title, "</div>\n                        <div class=\"awards-page__item__description\">").concat(item.description, "</div>\n                      </div>\n                  </a>\n              </div>\n                    ");
      });
      fullLength = data.size;
      setMoreBtn(fullLength, currentPage, pagesizeAttr);
      setControlText(fullLength, currentPage, pagesizeAttr);

      if (currentPage === 1) {
        $body.innerHTML = html;
      } else {
        $body.insertAdjacentHTML('beforeend', html);
      }
    }

    function getFiltersArray() {
      var first = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

      if (first) {
        currentPage = 1;
      } else {
        ++currentPage;
      }

      return {
        query: null,
        filter_type: $element.querySelector(selectors.controlItemButton + '.active').dataset.type ? $element.querySelector(selectors.controlItemButton + '.active').dataset.type : null,
        page: currentPage
      };
    }

    function setControlText(fullLength, page, pageSize) {
      if (page * pageSize < fullLength) {
        $controlTextBlock.textContent = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(+page * +pageSize, " \u0438\u0437 ").concat(fullLength);
      } else {
        $controlTextBlock.textContent = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(fullLength, " \u0438\u0437 ").concat(fullLength);
      }
    }

    function checkFilled($element, value) {
      if (value) {
        $element.classList.add(states.filled);
      } else {
        $element.classList.remove(states.filled);
      }
    }

    function setMoreBtn(fullLength, page, pageSize) {
      if (page * pageSize < fullLength) {
        $controlMoreBtn.classList.add(states.active);

        if (fullLength - page * pageSize > pagesize) {
          $controlMoreBtn.textContent = "\u0415\u0449\u0435 ".concat(pagesize);
        } else {
          $controlMoreBtn.textContent = "\u0415\u0449\u0435 ".concat(fullLength - page * pageSize);
        }
      } else {
        $controlMoreBtn.classList.remove(states.active);
      }
    }
  }

  awardFilter(awardsBlock, 8);
})();
"use strict";

document.addEventListener('DOMContentLoaded', function () {
  (function () {
    // PAGES.ABOUT_PAGE
    var page = document.querySelector('.page');
    if (!page) return;
    var isCasePage = document.querySelector('.case-page');
    if (!isCasePage) return;
    var rightArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-right\" href=\"#i-chevron-right\"></use>\n              </svg>";
    var leftArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-left\" href=\"#i-chevron-left\"></use>\n              </svg>";
    var aboutTeamSlider = tns({
      container: '.about-team-slider',
      navContainer: "#about-team-slider-thumbnails",
      navAsThumbnails: true,
      items: 1,
      touch: true,
      mouseDrag: true,
      preventScrollOnTouch: "inner",
      slideBy: 1,
      controls: true,
      autoplay: false,
      controlsPosition: 'bottom',
      controlsText: [leftArrow, rightArrow]
    });
    var catalogSertSlider = tns({
      container: '.js-partner-slider-1',
      items: 1,
      nav: false,
      touch: true,
      mouseDrag: true,
      loop: false,
      preventScrollOnTouch: "inner",
      slideBy: 1,
      gutter: 20,
      controls: true,
      autoplay: false,
      controlsPosition: 'bottom',
      controlsContainer: document.querySelector('.js-slider-control-1'),
      controlsText: [leftArrow, rightArrow],
      responsive: {
        640: {
          items: 1,
          gutter: 30
        },
        1020: {
          items: 1,
          gutter: 40
        }
      }
    });
    var contactForm = document.getElementById('home-contact-form');

    if (contactForm) {
      var $submit = contactForm.querySelector('[type="submit"]');
      var validator = utils.validator(contactForm, {
        name: {
          required: {
            message: 'Обязательное поле'
          }
        },
        company: {
          required: {
            message: 'Обязательное поле'
          }
        },
        email: {
          required: {
            message: 'Обязательное поле'
          },
          email: {
            message: 'Некорректный формат'
          }
        },
        phone: {
          required: {
            message: 'Обязательное поле'
          },
          mask: {
            re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
            message: 'Некорректный формат'
          }
        },
        agreement: {
          required: {
            message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
          }
        }
      }, {
        parent: '.form-field',
        submit: function submit() {
          contactForm.classList.add('pending');
          if ($submit) $submit.disabled = true;
          utils.submitForm(contactForm, function (response) {
            contactForm.classList.remove('pending');
            if ($submit) $submit.disabled = false;

            if (response.success) {
              if (parts.successModal) {
                parts.successModal.show();
              }
            } else {
              console.error(response);
            }
          });
        }
      });
    }
  })();
});
"use strict";

(function () {
  // PAGES.HOME_PAGE
  var page = document.querySelector('.cases-page');
  if (!page) return;
  var items = document.querySelectorAll('.partner-history-slider__item');
  var itemsLengthFull = items.length;
  items.forEach(function (item, index) {
    if (index < 6) {
      item.classList.add('showed');
    } else {
      item.style.display = 'none';
    }
  });
  var more = document.querySelector('.js-control-more-cases');
  var text = document.querySelector('.js-control-text-cases');
  var block = document.querySelector('.js-control-text-cases-show');

  if (itemsLengthFull < 6) {
    block.style.display = 'none';
  } else {
    more.style.display = 'block';

    if (itemsLengthFull - 6 > 6) {
      more.textContent = 'Еще 6';
    } else {
      more.textContent = "\u0415\u0449\u0435 ".concat(itemsLengthFull - 6);
    }
  }

  text.innerHTML = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E 6 \u0438\u0437 ".concat(itemsLengthFull);
  more.addEventListener('click', function () {
    var items = document.querySelectorAll('.partner-history-slider__item:not(.showed)');
    var itemsLengthFull = items.length;
    items.forEach(function (item, index) {
      if (index < 6) {
        item.classList.add('showed');
        item.style.display = 'flex';
      } else {
        item.style.display = 'none';
      }
    });
    var more = document.querySelector('.js-control-more-cases');
    var text = document.querySelector('.js-control-text-cases');
    var block = document.querySelector('.js-control-text-cases-show');

    if (itemsLengthFull < 6) {
      block.style.display = 'none';
    } else {
      more.style.display = 'block';

      if (itemsLengthFull - 6 >= 6) {
        more.textContent = 'Еще 6';
      } else {
        more.textContent = "\u0415\u0449\u0435 ".concat(itemsLengthFull - 6);
      }

      if (itemsLengthFull - 6 == 0) {
        more.style.display = 'none';
      }
    }

    var itemsShowed = document.querySelectorAll('.partner-history-slider__item.showed');
    var itemsFull = document.querySelectorAll('.partner-history-slider__item');
    text.innerHTML = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(itemsShowed.length, " \u0438\u0437 ").concat(itemsFull.length);
  });
  var contactForm = document.getElementById('home-contact-form');

  if (contactForm) {
    var $submit = contactForm.querySelector('[type="submit"]');
    var validator = utils.validator(contactForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      company: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        required: {
          message: 'Обязательное поле'
        },
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        contactForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(contactForm, function (response) {
          contactForm.classList.remove('pending');
          if ($submit) $submit.disabled = false;

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }
})();
"use strict";

(function () {
  // PAGES.ABOUT_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isCatalogComplPage = document.querySelector('.catalog-compl-page');
  if (!isCatalogComplPage) return;
  var catalogComplBlock = document.querySelector('.js-catalog');
  var selectors = {
    controlItem: '.js-control-item',
    blockItem: '.js-item',
    controlText: '.js-control-text',
    controlMore: '.js-control-more',
    body: '.catalog-block__body'
  };
  var states = {
    active: 'active',
    filled: 'filled',
    filtered: 'filtered'
  };

  function catalogCompileFilter($element) {
    var pagesize = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 9;
    if (!$element || !$element.classList.contains('js-catalog')) return;
    var $body = $element.querySelector(selectors.body);
    var $items = $element.querySelectorAll(selectors.blockItem);
    var pagesizeAttr = null;

    if (window.innerWidth < 768) {
      pagesizeAttr = $element.dataset.pageSizeMobile;
    } else {
      pagesizeAttr = $element.dataset.pageSize;
    }

    $items.forEach(function (item, index) {
      if (index < pagesize) {} else {
        item.remove();
      }
    });
    var fullLength = $element.dataset.fullLength;
    var formUrl = $element.dataset.action;
    var formMethod = $element.dataset.method;
    var $controlTextBlock = $element.querySelector(selectors.controlText);
    var $controlMoreBtn = $element.querySelector(selectors.controlMore);
    var currentPage = 1;
    setMoreBtn(fullLength, currentPage, pagesizeAttr);
    setControlText(fullLength, currentPage, pagesizeAttr);
    $controlMoreBtn.addEventListener('click', function () {
      var filterblock = getFiltersArray(false);
      getData(filterblock);
    });

    function getFiltersArray() {
      var first = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

      if (first) {
        currentPage = 1;
      } else {
        ++currentPage;
      }

      return {
        page: currentPage
      };
    }

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

    function setItems(data) {
      var html = '';
      var items = data.items;

      if (data.items.length > pagesize) {
        items = data.items.slice(0, pagesize);
      }

      items.forEach(function (item) {
        html += "\n                <div class=\"js-item col col-12 col-md-6\">\n                    <a class=\"catalog-block__item\" href=\"".concat(item.link, "\">\n                        <div class=\"block__item__title\">").concat(item.title, "</div>\n                        <div class=\"block__item__description\">").concat(item.description, "</div>\n                        <div class=\"catalog-block__item__icon\">\n                                <svg width=\"66\" height=\"66\">\n                                  <use xlink:href=\"#i-").concat(item.icon, "\"></use>\n                                </svg>\n                        </div>\n                  </a>\n              </div>\n              ");
      });
      fullLength = data.size;
      setMoreBtn(fullLength, currentPage, pagesizeAttr);
      setControlText(fullLength, currentPage, pagesizeAttr);

      if (currentPage === 1) {
        $body.innerHTML = html;
      } else {
        $body.insertAdjacentHTML('beforeend', html);
      }
    }

    function setControlText(fullLength, page, pageSize) {
      if (page == 1 && fullLength <= pageSize) {
        $controlTextBlock.style.display = 'none';
      } else {
        if (page * pageSize < fullLength) {
          $controlTextBlock.textContent = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(+page * +pageSize, " \u0438\u0437 ").concat(fullLength);
        } else {
          $controlTextBlock.textContent = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(fullLength, " \u0438\u0437 ").concat(fullLength);
        }
      }
    }

    function setMoreBtn(fullLength, page, pageSize) {
      if (page * pageSize < fullLength) {
        $controlMoreBtn.classList.add(states.active);

        if (fullLength - page * pageSize > pagesize) {
          $controlMoreBtn.textContent = "\u0415\u0449\u0435 ".concat(pagesize);
        } else {
          $controlMoreBtn.textContent = "\u0415\u0449\u0435 ".concat(fullLength - page * pageSize);
        }
      } else {
        $controlMoreBtn.classList.remove(states.active);
      }
    }
  }

  if (window.innerWidth < 768) {
    catalogCompileFilter(catalogComplBlock, 5);
  } else {
    catalogCompileFilter(catalogComplBlock, 9);
  }

  var rightArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-right\" href=\"#i-chevron-right\"></use>\n              </svg>";
  var leftArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-left\" href=\"#i-chevron-left\"></use>\n              </svg>";
  var catalogSertSlider = tns({
    container: '.js-sert-slider-1',
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
    controlsContainer: document.querySelector('.js-slider-control-1'),
    controlsText: [leftArrow, rightArrow],
    responsive: {
      640: {
        items: 2,
        gutter: 30
      },
      1020: {
        items: 3,
        gutter: 40
      }
    }
  });
  var catalogSert2Slider = tns({
    container: '.js-sert-slider-2',
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
    controlsContainer: document.querySelector('.js-slider-control-2'),
    responsive: {
      640: {
        items: 2,
        gutter: 30
      },
      1020: {
        items: 3,
        gutter: 40
      }
    }
  });
  var contactForm = document.getElementById('home-contact-form');

  if (contactForm) {
    var $submit = contactForm.querySelector('[type="submit"]');
    var validator = utils.validator(contactForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      company: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        required: {
          message: 'Обязательное поле'
        },
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        contactForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(contactForm, function (response) {
          contactForm.classList.remove('pending');
          if ($submit) $submit.disabled = false;

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }
})();
"use strict";

(function () {
  // PAGES.ABOUT_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isCatalogComplPage = document.querySelector('.catalog-ind-page');
  if (!isCatalogComplPage) return;
  var catalogComplBlock = document.querySelector('.js-catalog');
  var selectors = {
    controlItem: '.js-control-item',
    blockItem: '.js-item',
    controlText: '.js-control-text',
    controlMore: '.js-control-more',
    body: '.catalog-block__body'
  };
  var states = {
    active: 'active',
    filled: 'filled',
    filtered: 'filtered'
  };

  function catalogCompileFilter($element) {
    var pagesize = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 9;
    if (!$element || !$element.classList.contains('js-catalog')) return;
    var $body = $element.querySelector(selectors.body);
    var pagesizeAttr = null;

    if (window.innerWidth < 768) {
      pagesizeAttr = $element.dataset.pageSizeMobile;
    } else {
      pagesizeAttr = $element.dataset.pageSize;
    }

    var fullLength = $element.dataset.fullLength;
    var formUrl = $element.dataset.action;
    var formMethod = $element.dataset.method;
    var $controlTextBlock = $element.querySelector(selectors.controlText);
    var $controlMoreBtn = $element.querySelector(selectors.controlMore);
    var currentPage = 1;
    setMoreBtn(fullLength, currentPage, pagesizeAttr);
    setControlText(fullLength, currentPage, pagesizeAttr);
    $controlMoreBtn.addEventListener('click', function () {
      var filterblock = getFiltersArray(false);
      getData(filterblock);
    });

    function getFiltersArray() {
      var first = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

      if (first) {
        currentPage = 1;
      } else {
        ++currentPage;
      }

      return {
        page: currentPage
      };
    }

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

    function setItems(data) {
      var html = '';
      var items = data.items;

      if (data.items.length > pagesize) {
        items = data.items.slice(0, pagesize);
      }

      items.forEach(function (item) {
        html += "\n                <div class=\"js-item col col-12 col-md-6\">\n                    <a class=\"catalog-block__item\" href=\"".concat(item.link, "\">\n                        <div class=\"block__item__title\">").concat(item.title, "</div>\n                        <div class=\"block__item__description\">").concat(item.description, "</div>\n                        <div class=\"catalog-block__item__icon\">\n                                <svg width=\"66\" height=\"66\">\n                                  <use xlink:href=\"#i-").concat(item.icon, "\"></use>\n                                </svg>\n                        </div>\n                  </a>\n              </div>\n              ");
      });
      fullLength = data.size;
      setMoreBtn(fullLength, currentPage, pagesizeAttr);
      setControlText(fullLength, currentPage, pagesizeAttr);

      if (currentPage === 1) {
        $body.innerHTML = html;
      } else {
        $body.insertAdjacentHTML('beforeend', html);
      }
    }

    function setControlText(fullLength, page, pageSize) {
      if (page == 1 && fullLength <= pageSize) {
        $controlTextBlock.style.display = 'none';
      } else {
        if (page * pageSize < fullLength) {
          $controlTextBlock.textContent = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(+page * +pageSize, " \u0438\u0437 ").concat(fullLength);
        } else {
          $controlTextBlock.textContent = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(fullLength, " \u0438\u0437 ").concat(fullLength);
        }
      }
    }

    function setMoreBtn(fullLength, page, pageSize) {
      if (page * pageSize < fullLength) {
        $controlMoreBtn.classList.add(states.active);

        if (fullLength - page * pageSize > pagesize) {
          $controlMoreBtn.textContent = "\u0415\u0449\u0435 ".concat(pagesize);
        } else {
          $controlMoreBtn.textContent = "\u0415\u0449\u0435 ".concat(fullLength - page * pageSize);
        }
      } else {
        $controlMoreBtn.classList.remove(states.active);
      }
    }
  }

  if (window.innerWidth < 768) {
    catalogCompileFilter(catalogComplBlock, 5);
  } else {
    catalogCompileFilter(catalogComplBlock, 9);
  }

  var rightArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-right\" href=\"#i-chevron-right\"></use>\n              </svg>";
  var leftArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-left\" href=\"#i-chevron-left\"></use>\n              </svg>";
  var catalogSertSlider = tns({
    container: '.js-sert-slider-1',
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
    controlsContainer: document.querySelector('.js-slider-control-1'),
    controlsText: [leftArrow, rightArrow],
    responsive: {
      640: {
        items: 2,
        gutter: 30
      },
      1020: {
        items: 3,
        gutter: 40
      }
    }
  });
  var catalogSert2Slider = tns({
    container: '.js-sert-slider-2',
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
    controlsContainer: document.querySelector('.js-slider-control-2'),
    controlsText: [leftArrow, rightArrow],
    responsive: {
      640: {
        items: 2,
        gutter: 30
      },
      1020: {
        items: 3,
        gutter: 40
      }
    }
  });
  var contactForm = document.getElementById('home-contact-form');

  if (contactForm) {
    var $submit = contactForm.querySelector('[type="submit"]');
    var validator = utils.validator(contactForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      company: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        required: {
          message: 'Обязательное поле'
        },
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        contactForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(contactForm, function (response) {
          contactForm.classList.remove('pending');
          if ($submit) $submit.disabled = false;

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }
})();
"use strict";

(function () {
  // PAGES.ABOUT_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isCatalogProductPage = document.querySelector('.catalog-product-page');
  if (!isCatalogProductPage) return;
  var filter_block = {};

  function choosenTemplateItem(name, id, filterName) {
    var template = "\n        <div data-id=\"".concat(id, "\" data-filter-name=\"").concat(filterName, "\" class=\"catalog-block__items__choosen-item\">\n            <span class=\"catalog-block__items__choosen-item__text\">").concat(name, "</span>\n            <div class=\"catalog-block__items__choosen-item__close\" data-js-ref=\"choosen-filter-remove\">\n                    <svg width=\"10\" height=\"10\">\n                      <use xlink:href=\"#i-chest-filter\" href=\"#i-chest-filter\"></use>\n                    </svg>\n            </div>\n          </div>\n        ");
    return template;
  }

  function productTemplateItem(item) {
    var itemsBlock = '';
    item.blocks.forEach(function (block) {
      itemsBlock += "\n                  <div class=\"catalog-block__items__item__block\">\n                    <div class=\"catalog-block__items__item__block__title\">".concat(block.title, "</div>\n                    <div class=\"catalog-block__items__item__block__value\">").concat(block.value, "</div>\n                  </div>\n            ");
    });
    var btn = '';

    if (item.available) {
      btn += "<a class=\"btn btn-primary-inverse\" href=\"".concat(item.href, "\">\u041F\u043E\u0434\u0440\u043E\u0431\u043D\u0435\u0435</a>");
    } else {
      btn += "<button class=\"btn btn-dis disabled\" disabled>\u0421\u043D\u044F\u0442 \u0441 \u043F\u0440\u043E\u0438\u0437\u0432\u043E\u0434\u0441\u0442\u0432\u0430</button>";
    }

    var template = "\n            <div class=\"catalog-block__items__item\">\n              <div class=\"catalog-block__items__item__wrap\">\n                <div class=\"catalog-block__items__item__title\">".concat(item.title, "</div>\n                <div class=\"catalog-block__items__item__description\">").concat(item.description, "</div>\n                <div class=\"catalog-block__items__item__blocks\">\n                    ").concat(itemsBlock, "\n                </div>\n                <div class=\"catalog-block__items__item__footer\">\n                  <div class=\"catalog-block__items__item__footer__image\"><img src=\"").concat(item.icon, "\"></div>\n                  ").concat(btn, "\n                </div>\n              </div>\n            </div>\n        ");
    return template;
  } //create filters array block


  var selectors = {
    controlItem: '.js-control-item',
    blockItem: '.js-item',
    controlText: '.js-control-text',
    controlMore: '.js-control-more',
    body: '.catalog-block__body'
  };
  var states = {
    active: 'active',
    filled: 'filled',
    filtered: 'filtered'
  };
  var form = document.querySelector('.js-catalog');
  var fullLength = form.dataset.fullLength;
  var pagesize = form.dataset.pageSize;
  var formUrl = form.dataset.action;
  var formMethod = form.dataset.method;
  var filters = document.querySelectorAll('[data-js-ref="catalog-checkbox-filter"]');
  var searchInput = document.querySelector('[data-js-ref="catalog-filter-search"]');
  var itemsContainer = document.querySelector('[data-js-ref="items-container"]');
  var choosenBlock = document.querySelector('[data-js-ref="catalog-choosen-block"]');
  var choosenContainer = document.querySelector('[data-js-ref="catalog-choosen-container"]');
  var choosenClear = document.querySelector('[data-js-ref="catalog-choosen-clear"]');
  var $controlTextBlock = form.querySelector(selectors.controlText);
  var $controlMoreBtn = form.querySelector(selectors.controlMore);
  var $filterClearBtn = document.querySelector('.js-clear-filters');
  var $filterApplyBtn = document.querySelector('.js-apply-filters');
  var $filterOpenBtn = document.querySelector('.btn-filter');
  var $filterCheckboxes = document.querySelector('.catalog-block__filter-col__checkboxes');
  var currentPage = 1;
  getData(true);
  var pagesizeAttr = null;

  if (window.innerWidth < 768) {
    pagesizeAttr = form.dataset.pageSizeMobile;
  } else {
    pagesizeAttr = form.dataset.pageSize;
  }

  itemsContainer.querySelectorAll('.catalog-block__items__choosen-item').forEach(function (item, index) {
    if (index < pagesizeAttr) {} else {
      item.remove();
    }
  });
  setMoreBtn(fullLength, currentPage, pagesizeAttr);
  setControlText(fullLength, currentPage, pagesizeAttr);
  $controlMoreBtn.addEventListener('click', function () {
    getData(false);
  });

  function setControlText(fullLength, page, pagesizeAttr) {
    if (page == 1 && +fullLength <= +pagesizeAttr) {
      $controlTextBlock.style.display = 'none';
    } else {
      if (page * pagesizeAttr < fullLength) {
        $controlTextBlock.textContent = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(+page * +pagesizeAttr, " \u0438\u0437 ").concat(fullLength);
      } else {
        $controlTextBlock.textContent = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(fullLength, " \u0438\u0437 ").concat(fullLength);
      }
    }
  }

  function setMoreBtn(fullLength, page, pagesizeAttr) {
    if (page * pagesizeAttr < fullLength) {
      $controlMoreBtn.classList.add(states.active);

      if (fullLength - page * pagesizeAttr > pagesizeAttr) {
        $controlMoreBtn.textContent = "\u0415\u0449\u0435 ".concat(pagesizeAttr);
      } else {
        $controlMoreBtn.textContent = "\u0415\u0449\u0435 ".concat(fullLength - page * pagesizeAttr);
      }
    } else {
      $controlMoreBtn.classList.remove(states.active);
    }
  }

  choosenBlock.style.display = 'none';
  var filtersArray = [];
  var filterChoosen = [];
  filters.forEach(function (item) {
    filtersArray.push({
      item: item,
      filterName: item.getAttribute('name'),
      filterNameShow: item.parentNode.querySelector('.checkbox-label').textContent.trim(),
      state: item.checked
    });
  });
  choosenContainer.addEventListener('click', function (event) {
    var target = event.target;

    if (target.classList.contains('catalog-block__items__choosen-item__close') || target.closest('.catalog-block__items__choosen-item__close')) {
      var container = target.closest('.catalog-block__items__choosen-item');
      var filterName = container.getAttribute('data-filter-name');
      var index = filterChoosen.findIndex(function (filter) {
        return filter.filterName === filterName;
      });

      if (index != -1) {
        removeChoosen(filterChoosen[index]);
        getData();
      }
    }
  });
  searchInput.addEventListener('input', function () {
    getData();
  });

  if (window.innerWidth > 1100) {
    filters.forEach(function (item) {
      item.addEventListener('change', function () {
        var itemIndex = filtersArray.findIndex(function (filter) {
          return filter.filterName === item.getAttribute('name');
        });

        if (itemIndex >= 0) {
          filtersArray[itemIndex].state = item.checked;

          if (item.checked) {
            addChoosen(filtersArray[itemIndex]);
          } else {
            removeChoosen(filtersArray[itemIndex]);
          }

          getData();
        }
      });
    });
  } else {
    // $filterCheckboxes
    // $filterOpenBtn
    // $filterApplyBtn
    // $filterClearBtn
    $filterOpenBtn.addEventListener('click', function () {
      if ($filterOpenBtn.classList.contains('active')) {
        $filterOpenBtn.classList.remove('active');
        $filterCheckboxes.classList.remove('active');
      } else {
        $filterOpenBtn.classList.add('active');
        $filterCheckboxes.classList.add('active');
      }
    });
    $filterClearBtn.addEventListener('click', function () {
      $filterOpenBtn.classList.remove('active');
      $filterCheckboxes.classList.remove('active');
      filterChoosen = [];
      filtersArray.forEach(function (filter) {
        filter.state = false;
        filter.item.checked = false;
      });
      choosenBlock.style.display = 'none';
      choosenContainer.innerHTML = '';
      getData();
    });
    $filterApplyBtn.addEventListener('click', function () {
      filterChoosen = [];
      choosenBlock.style.display = 'none';
      choosenContainer.innerHTML = '';
      filtersArray.forEach(function (filter, index) {
        filter.state = filter.item.checked;

        if (filter.item.checked) {
          addChoosen(filtersArray[index]);
        } else {
          removeChoosen(filtersArray[index]);
        }
      });
      getData();
      $filterOpenBtn.classList.remove('active');
      $filterCheckboxes.classList.remove('active');
    });
  }

  choosenClear.addEventListener('click', function () {
    choosenContainer.innerHTML = '';
    filterChoosen = [];
    filtersArray.forEach(function (filter) {
      filter.state = false;
      filter.item.checked = false;
    });
    choosenBlock.style.display = 'none';
    getData();
  });

  function getFiltersArray() {
    return {
      filters: filtersArray,
      query: searchInput.value ? searchInput.value : null
    };
  }

  function addChoosen(item) {
    var index = filterChoosen.findIndex(function (filter) {
      return filter.filterName === item.filterName;
    });

    if (index == -1) {
      choosenBlock.style.display = 'flex';
      filterChoosen.push(item);
      var template = choosenTemplateItem(item.filterNameShow, filterChoosen.length - 1, item.filterName);
      choosenContainer.insertAdjacentHTML('beforeend', template);
    }
  }

  function removeChoosen(item) {
    filterChoosen = filterChoosen.filter(function (filter) {
      return filter.filterName != item.filterName;
    });
    var filterNode = choosenContainer.querySelector("[data-filter-name=".concat(item.filterName, "]"));

    if (filterNode) {
      filterNode.remove();
      item.item.checked = false;
    }

    if (filterChoosen.length == 0) {
      choosenBlock.style.display = 'none';
    }
  }

  function setItems(data) {
    var template = '';
    var items = data.items;

    if (data.items.length > pagesizeAttr) {
      items = data.items.slice(0, pagesizeAttr);
    }

    items.forEach(function (item) {
      template += productTemplateItem(item);
    });
    fullLength = data.size;
    setMoreBtn(fullLength, currentPage, pagesizeAttr);
    setControlText(fullLength, currentPage, pagesizeAttr);

    if (currentPage === 1) {
      itemsContainer.innerHTML = template;
    } else {
      itemsContainer.insertAdjacentHTML('beforeend', template);
    }
  }

  function getData() {
    var first = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

    if (first) {
      currentPage = 1;
    } else {
      ++currentPage;
    }

    var filtersData = getFiltersArray();
    var formData = new FormData();

    for (var filterKey in filtersData.filters) {
      if (filtersData.filters[filterKey].state) {
        formData.append(filtersData.filters[filterKey].filterName, 'on');
      }
    }

    if (filtersData.query) {
      formData.append('query', filtersData.query);
    }

    formData.append('page', currentPage);
    formData.append('limit', pagesizeAttr);

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
})();
"use strict";

(function () {
  // PAGES.ABOUT_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isCatalogProductPage = document.querySelector('.catalog-product-page');
  if (!isCatalogProductPage) return;
  var rightArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-right\" href=\"#i-chevron-right\"></use>\n              </svg>";
  var leftArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-left\" href=\"#i-chevron-left\"></use>\n              </svg>";
  var catalogSertSlider = tns({
    container: '.js-sert-slider-1',
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
    controlsContainer: document.querySelector('.js-slider-control-1'),
    controlsText: [leftArrow, rightArrow],
    responsive: {
      640: {
        items: 2,
        gutter: 30
      },
      1020: {
        items: 3,
        gutter: 40
      }
    }
  });
  var catalogSert2Slider = tns({
    container: '.js-sert-slider-2',
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
    controlsContainer: document.querySelector('.js-slider-control-2'),
    responsive: {
      640: {
        items: 2,
        gutter: 30
      },
      1020: {
        items: 3,
        gutter: 40
      }
    }
  });
  var accordionFilters = document.querySelectorAll('.filter-dropdown:not(.filter-dropdown-solo)');
  components.accordionFilter(accordionFilters);
  var contactForm = document.getElementById('home-contact-form');

  if (contactForm) {
    var $submit = contactForm.querySelector('[type="submit"]');
    var validator = utils.validator(contactForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      company: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        required: {
          message: 'Обязательное поле'
        },
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        contactForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(contactForm, function (response) {
          contactForm.classList.remove('pending');
          if ($submit) $submit.disabled = false;

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }
})();
"use strict";

(function () {
  var page = document.querySelector('.page');
  if (!page) return;
  var isComplexCardPage = document.querySelector('.complex-card-page');
  if (!isComplexCardPage) return;
  var rightArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-right\" href=\"#i-chevron-right\"></use>\n              </svg>";
  var leftArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-left\" href=\"#i-chevron-left\"></use>\n              </svg>";
  var faq = document.getElementById('home-faq');

  if (faq) {
    components.accordion(faq);
  }

  var itemsBlockSlider = tns({
    container: '.js-items-slider-1',
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
    controlsContainer: document.querySelector('.js-items-slider-control-1'),
    controlsText: [leftArrow, rightArrow],
    responsive: {
      640: {
        items: 2,
        gutter: 30
      },
      1020: {
        items: 2,
        gutter: 40
      }
    }
  });
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
        gutter: 30
      },
      1020: {
        items: 3,
        gutter: 40
      }
    }
  });
  var contactForm = document.getElementById('home-contact-form');

  if (contactForm) {
    var $submit = contactForm.querySelector('[type="submit"]');
    var validator = utils.validator(contactForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      company: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        required: {
          message: 'Обязательное поле'
        },
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        contactForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(contactForm, function (response) {
          contactForm.classList.remove('pending');
          if ($submit) $submit.disabled = false;

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }
})();
"use strict";

document.addEventListener('DOMContentLoaded', function () {
  (function () {
    // PAGES.ABOUT_PAGE
    var page = document.querySelector('.page');
    if (!page) return;
    var isContactsPage = document.querySelector('.contacts-page');
    if (!isContactsPage) return;
    var contactForm = document.getElementById('home-contact-form');

    if (contactForm) {
      var $submit = contactForm.querySelector('[type="submit"]');
      var validator = utils.validator(contactForm, {
        name: {
          required: {
            message: 'Обязательное поле'
          }
        },
        company: {
          required: {
            message: 'Обязательное поле'
          }
        },
        email: {
          required: {
            message: 'Обязательное поле'
          },
          email: {
            message: 'Некорректный формат'
          }
        },
        phone: {
          required: {
            message: 'Обязательное поле'
          },
          mask: {
            re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
            message: 'Некорректный формат'
          }
        },
        agreement: {
          required: {
            message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
          }
        }
      }, {
        parent: '.form-field',
        submit: function submit() {
          contactForm.classList.add('pending');
          if ($submit) $submit.disabled = true;
          utils.submitForm(contactForm, function (response) {
            contactForm.classList.remove('pending');
            if ($submit) $submit.disabled = false;

            if (response.success) {
              if (parts.successModal) {
                parts.successModal.show();
              }
            } else {
              console.error(response);
            }
          });
        }
      });
    }

    var subscribe = document.querySelector('.contacts-form__block');

    if (subscribe) {
      var _$submit = subscribe.querySelector('[type="submit"]');

      var _validator = utils.validator(subscribe, {
        email: {
          required: {
            message: 'Обязательное поле'
          },
          email: {
            message: 'Некорректный формат'
          }
        },
        agreement: {
          required: {
            message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
          }
        }
      }, {
        parent: '.form-field',
        submit: function submit() {
          contactForm.classList.add('pending');
          if (_$submit) _$submit.disabled = true;
          utils.submitForm(subscribe, function (response) {
            subscribe.classList.remove('pending');
            if (_$submit) _$submit.disabled = false;

            if (response.success) {
              if (parts.successModal) {
                parts.successModal.show();
              }
            } else {
              console.error(response);
            }
          });
        }
      });
    }
  })();
});
"use strict";

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

(function () {
  // PAGES.HOME_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var main = page.querySelector('.page-main');
  if (!main) return;
  var isHomePage = main.classList.contains('home-page');
  if (!isHomePage) return;
  var homeSlider = document.getElementById('home-slider');

  if (homeSlider) {
    components.fadeSlider(homeSlider);
  }

  var clientsSlider = document.getElementById('clients-slider');

  if (clientsSlider) {
    components.infiniteSlider(clientsSlider, {
      slides: 2,
      offset: 10,
      breakpoints: {
        768: {
          slides: 3,
          center: true
        },
        1024: {
          slides: 4,
          center: true
        },
        1280: {
          slides: 6,
          center: true
        }
      }
    });
  }

  var solutionsSlider = document.getElementById('solutions-slider');

  if (solutionsSlider) {
    components.infiniteSlider(solutionsSlider, {
      slides: 1,
      offset: 10,
      breakpoints: {
        768: {
          slides: 2,
          center: true
        },
        1280: {
          slides: 3,
          center: true
        }
      }
    });
  }

  var casesSlider = document.getElementById('cases-slider');

  if (casesSlider) {
    components.infiniteSlider(casesSlider, {
      slides: 1,
      offset: 10,
      breakpoints: {
        768: {
          slides: 2,
          center: true
        },
        1280: {
          slides: 3,
          center: true
        }
      }
    });
  }

  var newsSlider = document.getElementById('news-slider');

  if (newsSlider) {
    components.infiniteSlider(newsSlider, {
      slides: 1,
      offset: 10,
      breakpoints: {
        768: {
          slides: 2,
          center: true
        },
        1024: {
          slides: 3,
          center: true
        },
        1280: {
          slides: 4,
          center: true
        }
      }
    });
  } // const sliders = document.querySelectorAll('.scroll-slider');
  // sliders.forEach((s) => {
  //   if (s.id === 'clients-slider') {
  //   } else components.scrollSlider(s);
  // });


  var faq = document.getElementById('home-faq');

  if (faq) {
    components.accordion(faq);
  }

  var contactForm = document.getElementById('home-contact-form');

  if (contactForm) {
    var $submit = contactForm.querySelector('[type="submit"]');
    var validator = utils.validator(contactForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      company: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        required: {
          message: 'Обязательное поле'
        },
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        contactForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(contactForm, function (response) {
          contactForm.classList.remove('pending');
          if ($submit) $submit.disabled = false;

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }

  function handleSliders(element) {
    if (!element) return;
    var $slider = element.querySelector('.scroll-slider');

    var $slides = _toConsumableArray($slider.querySelectorAll('.scroll-slider-slide')).map(function (el) {
      var block = el.querySelector('[data-type]');
      return {
        element: el,
        type: block.dataset.type
      };
    });

    var scrollSlider = $slider.infiniteSlider;

    var $filters = _toConsumableArray(element.querySelectorAll('.slider-filter')).map(function (el) {
      return {
        element: el,
        type: el.dataset.type
      };
    });

    var activeFilter = null;

    function applyFilter(filter) {
      if (activeFilter === filter) return;
      activeFilter = filter;
      $filters.forEach(function (filter) {
        filter.element.classList.toggle('active', filter === activeFilter);
      });
      $slides.forEach(function (slide) {
        if (!filter.type || filter.type === slide.type) {
          slide.element.removeAttribute('hidden');
        } else {
          slide.element.setAttribute('hidden', true);
        }
      });
      scrollSlider.update();
    }

    applyFilter($filters[0]);
    $filters.forEach(function (filter) {
      filter.element.addEventListener('click', function () {
        applyFilter(filter);
      });
    });
  }

  handleSliders(document.querySelector('.home-solutions'));
  handleSliders(document.querySelector('.home-news'));
})();
"use strict";

(function () {
  var page = document.querySelector('.page');
  if (!page) return;
  var isIndustryCardPage = document.querySelector('.industry-card-page');
  if (!isIndustryCardPage) return;
  var rightArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-right\" href=\"#i-chevron-right\"></use>\n              </svg>";
  var leftArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-left\" href=\"#i-chevron-left\"></use>\n              </svg>";
  var faq = document.getElementById('home-faq');

  if (faq) {
    components.accordion(faq);
  }

  var clietnsBlockSlider = tns({
    container: '.js-clients-slider-1',
    items: 2,
    nav: false,
    touch: true,
    mouseDrag: true,
    preventScrollOnTouch: "inner",
    slideBy: 1,
    gutter: 20,
    controls: true,
    autoplay: false,
    controlsPosition: 'bottom',
    controlsContainer: document.querySelector('.js-clients-slider-control-1'),
    controlsText: [leftArrow, rightArrow],
    responsive: {
      640: {
        items: 4,
        gutter: 30
      },
      1020: {
        items: 6,
        gutter: 40
      }
    }
  });
  var itemsBlockSlider = tns({
    container: '.js-items-slider-1',
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
    controlsContainer: document.querySelector('.js-items-slider-control-1'),
    controlsText: [leftArrow, rightArrow],
    responsive: {
      640: {
        items: 2,
        gutter: 30
      },
      1020: {
        items: 2,
        gutter: 40
      }
    }
  });
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
        gutter: 30
      },
      1020: {
        items: 3,
        gutter: 40
      }
    }
  });
  var contactForm = document.getElementById('home-contact-form');

  if (contactForm) {
    var $submit = contactForm.querySelector('[type="submit"]');
    var validator = utils.validator(contactForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      company: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        required: {
          message: 'Обязательное поле'
        },
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        contactForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(contactForm, function (response) {
          contactForm.classList.remove('pending');
          if ($submit) $submit.disabled = false;

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }
})();
"use strict";

(function () {
  // PAGES.ABOUT_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isPartnerPage = document.querySelector('.partner-page');
  if (!isPartnerPage) return;
  var rightArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-right\" href=\"#i-chevron-right\"></use>\n              </svg>";
  var leftArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-left\" href=\"#i-chevron-left\"></use>\n              </svg>";
  var searchFields = document.querySelectorAll('.js-input-search-field');
  searchFields.forEach(function (item) {
    var input = item.querySelector('.js-input-search');
    var clear = item.querySelector('.js-input-search-clear');

    if (input.value) {
      clear.style.display = 'block';
    } else {
      clear.style.display = 'none';
    }

    input.addEventListener('input', function () {
      if (input.value) {
        clear.style.display = 'block';
      } else {
        clear.style.display = 'none';
      }
    });
    clear.addEventListener('click', function () {
      input.value = '';
      clear.style.display = 'none';
    });
  });
  var tabs = document.querySelectorAll('.tab');

  if (tabs.length) {
    tabs.forEach(function (item) {
      components.tab(item);
    });
  }

  var catalogSertSlider = tns({
    container: '.js-partner-slider-1',
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
    controlsContainer: document.querySelector('.js-slider-control-1'),
    controlsText: [leftArrow, rightArrow],
    responsive: {
      640: {
        items: 2,
        gutter: 30
      },
      1020: {
        items: 3,
        gutter: 40
      }
    }
  });

  if (window.innerWidth < 1024) {
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
          gutter: 30,
          items: 2
        }
      }
    });
  }

  if (window.innerWidth < 500) {
    var items = document.querySelectorAll('.our-partners-item');
    var itemsLengthFull = items.length;
    items.forEach(function (item, index) {
      if (index < 8) {
        item.classList.add('showed');
      } else {
        item.style.display = 'none';
      }
    });
    var more = document.querySelector('.js-control-more-partner');
    var text = document.querySelector('.js-control-text-partner');
    var block = document.querySelector('.js-control-text-partner-show');

    if (itemsLengthFull - 8 == 0) {
      block.style.display = 'none';
    } else {
      more.style.display = 'block';

      if (itemsLengthFull - 8 > 8) {
        more.textContent = 'Еще 8';
      } else {
        more.textContent = "\u0415\u0449\u0435 ".concat(itemsLengthFull - 8);
      }
    }

    text.innerHTML = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E 8 \u0438\u0437 ".concat(itemsLengthFull);
    more.addEventListener('click', function () {
      var items = document.querySelectorAll('.our-partners-item:not(.showed)');
      var itemsLengthFull = items.length;
      items.forEach(function (item, index) {
        if (index < 8) {
          item.classList.add('showed');
          item.style.display = 'flex';
        } else {
          item.style.display = 'none';
        }
      });
      var more = document.querySelector('.js-control-more-partner');
      var text = document.querySelector('.js-control-text-partner');
      var block = document.querySelector('.js-control-text-partner-show');

      if (itemsLengthFull < 8) {
        block.style.display = 'none';
      } else {
        more.style.display = 'block';

        if (itemsLengthFull - 8 >= 8) {
          more.textContent = 'Еще 8';
        } else {
          more.textContent = "\u0415\u0449\u0435 ".concat(itemsLengthFull - 8);
        }

        if (itemsLengthFull - 8 == 0) {
          more.style.display = 'none';
        }
      }

      var itemsShowed = document.querySelectorAll('.our-partners-item.showed');
      var itemsFull = document.querySelectorAll('.our-partners-item');
      text.innerHTML = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(itemsShowed.length, " \u0438\u0437 ").concat(itemsFull.length);
    });
  }

  var itemLength = window.innerWidth > 1020 ? 12 : 12;
  var items2 = document.querySelectorAll('.our-partners__list__bottom__item');
  var itemsLengthFull2 = items2.length;
  items2.forEach(function (item, index) {
    if (index < itemLength) {
      item.classList.add('showed');
    } else {
      item.style.display = 'none';
    }
  });
  var more2 = document.querySelector('.js-control-more-partner-2');
  var text2 = document.querySelector('.js-control-text-partner-2');
  var block2 = document.querySelector('.js-control-text-partner-2-show');

  if (itemsLengthFull2 - itemLength <= 0) {
    block2.style.display = 'none';
  } else {
    more2.style.display = 'block';

    if (itemsLengthFull2 - itemLength > itemLength) {
      more2.textContent = 'Еще ' + itemLength;
    } else {
      more2.textContent = "\u0415\u0449\u0435 ".concat(itemsLengthFull2 - itemLength);
    }
  }

  text2.innerHTML = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(itemLength, " \u0438\u0437 ").concat(itemsLengthFull2);
  more2.addEventListener('click', function () {
    var items2 = document.querySelectorAll('.our-partners__list__bottom__item:not(.showed)');
    var itemsLengthFull2 = items2.length;
    items2.forEach(function (item, index) {
      if (index < itemLength) {
        item.classList.add('showed');
        item.style.display = 'flex';
      } else {
        item.style.display = 'none';
      }
    });
    var more2 = document.querySelector('.js-control-more-partner-2');
    var text2 = document.querySelector('.js-control-text-partner-2');
    var block2 = document.querySelector('.js-control-text-partner-2-show');

    if (itemsLengthFull2 - itemLength <= 0) {
      block2.style.display = 'none';
    } else {
      more2.style.display = 'block';

      if (itemsLengthFull2 - itemLength > itemLength) {
        more2.textContent = 'Еще 12';
      } else {
        more2.textContent = "\u0415\u0449\u0435 ".concat(itemsLengthFull2 - itemLength);
      }
    }

    text2.innerHTML = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(itemLength, " \u0438\u0437 ").concat(itemsLengthFull2);
    var itemsShowed2 = document.querySelectorAll('.our-partners__list__bottom__item.showed');
    var itemsFull2 = document.querySelectorAll('.our-partners__list__bottom__item');
    text2.innerHTML = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(itemsShowed2.length, " \u0438\u0437 ").concat(itemsFull2.length);
  });
  var modalSelect = document.querySelector('.custom-select-modal');
  var modalSelectTitle = document.querySelector('.custom-select-modal-title');
  var modalContent = document.querySelector('.custom-select-modal__content__bottom');
  var modalItem = document.querySelectorAll('.custom-select-modal__content__bottom__item');
  var modalItemsTop = document.querySelectorAll('.custom-select-modal__content__top-item:not(.disabled)');
  var modalItemsClose = document.querySelector('.custom-select-modal__content__close');
  var placeholder = modalSelectTitle.innerHTML;
  modalSelectTitle.addEventListener('click', function () {
    if (modalSelect.classList.contains('open')) {
      modalSelect.classList.remove('open');
    } else {
      modalSelect.classList.add('open');
    }
  });
  modalItemsClose.addEventListener('click', function () {
    modalSelect.classList.remove('open');
  });
  modalItem.forEach(function (item) {
    item.addEventListener('click', function () {
      var title = item.textContent;
      modalSelectTitle.innerHTML = "<span>".concat(title, "</span><span class=\"close-icon\"><svg width=\"15\" height=\"15\"><use xlink:href=\"#i-close-custom\"></use></svg></span>");
      modalSelect.classList.remove('open');
      modalSelectTitle.classList.remove('start');
      var closeIcon = modalSelectTitle.querySelector('.close-icon');
      closeIcon.addEventListener('click', function (e) {
        e.stopPropagation();
        modalSelectTitle.innerHTML = placeholder;
        modalSelectTitle.classList.add('start');
      });
    });
  });
  modalItemsTop.forEach(function (item) {
    item.addEventListener('click', function () {
      var title = item.textContent.toLowerCase();

      if (title === modalItemsTop[0].textContent.toLowerCase()) {
        modalContent.classList.remove('flex');
        modalItemsTop.forEach(function (item) {
          return item.classList.remove('active');
        });
        item.classList.add('active');
        modalItem.forEach(function (item) {
          return item.style.display = '';
        });
      } else {
        modalItemsTop.forEach(function (item) {
          return item.classList.remove('active');
        });
        item.classList.add('active');
        modalContent.classList.add('flex');
        modalItem.forEach(function (i) {
          if (i.textContent[0].toLowerCase() == title) {
            i.style.display = '';
          } else {
            i.style.display = 'none';
          }
        });
      }
    });
  });
  document.body.addEventListener('click', function (e) {
    if (e.target.classList.contains('custom-select-modal') || e.target.closest('.custom-select-modal')) {} else {
      modalSelect.classList.remove('open');
    }
  });
})();
"use strict";

(function () {
  var page = document.querySelector('.page');
  if (!page) return;
  var isPricePage = document.querySelector('.price-page');
  if (!isPricePage) return;
  var rightArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-right\" href=\"#i-chevron-right\"></use>\n              </svg>";
  var leftArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-left\" href=\"#i-chevron-left\"></use>\n              </svg>";
  var checkboxItems = document.querySelectorAll('input[type="checkbox"]');
  checkboxItems.forEach(function (item) {
    item.addEventListener('change', function () {
      var container = item.closest('.price-slider__item');
      var button = container.querySelector('.btn');

      if (item.checked) {
        button.classList.remove('disabled');
      } else {
        button.classList.add('disabled');
      }
    });
  });
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
        gutter: 30
      },
      1020: {
        items: 3,
        gutter: 40
      }
    }
  });
})();
"use strict";

(function () {
  // PAGES.ABOUT_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isProductCardPage = document.querySelector('.product-card-page');
  if (!isProductCardPage) return;

  if (window.innerWidth < 1021) {
    var productCard = tns({
      container: '.product-card-modification__block',
      items: 1,
      gutter: 30,
      nav: false,
      touch: true,
      mouseDrag: true,
      loop: false,
      preventScrollOnTouch: "inner",
      slideBy: 1,
      controls: true,
      autoplay: false,
      controlsPosition: 'bottom',
      controlsContainer: document.querySelector('.product-card-modification__buttons'),
      responsive: {
        640: {
          items: 2,
          gutter: 30
        }
      }
    });
  }

  var rightArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-right\" href=\"#i-chevron-right\"></use>\n              </svg>";
  var leftArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-left\" href=\"#i-chevron-left\"></use>\n              </svg>";
  var catalogSertSlider = tns({
    container: '.js-sert-slider-1',
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
    controlsContainer: document.querySelector('.js-slider-control-1'),
    controlsText: [leftArrow, rightArrow],
    responsive: {
      640: {
        items: 2,
        gutter: 30
      },
      1020: {
        items: 3,
        gutter: 40
      }
    }
  });
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
        gutter: 30
      },
      1020: {
        items: 3,
        gutter: 40
      }
    }
  });
  var itemsBlockSlider = tns({
    container: '.js-items-slider-1',
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
    controlsContainer: document.querySelector('.js-items-slider-control-1'),
    controlsText: [leftArrow, rightArrow],
    responsive: {
      640: {
        items: 2,
        gutter: 30
      },
      1020: {
        items: 3,
        gutter: 40
      }
    }
  });
  var accordionTabs = document.querySelector('.tabs-accordion');
  components.accordion(accordionTabs, true, false);
  var accordionAdvantages = document.querySelector('.accordion-advantages');
  components.accordion(accordionAdvantages, false, true);
  var tabs = document.querySelectorAll('.tab');

  if (tabs.length) {
    tabs.forEach(function (item) {
      components.tab(item);
    });
  }

  var contactForm = document.getElementById('home-contact-form');

  if (contactForm) {
    var $submit = contactForm.querySelector('[type="submit"]');
    var validator = utils.validator(contactForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      company: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        required: {
          message: 'Обязательное поле'
        },
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        contactForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(contactForm, function (response) {
          contactForm.classList.remove('pending');
          if ($submit) $submit.disabled = false;

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }
})();
"use strict";

(function () {
  // PAGES.ABOUT_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isSearchPage = document.querySelector('.search-page');
  console.log(isSearchPage);
  if (!isSearchPage) return;
  var searchFields = document.querySelectorAll('.js-input-search-field');
  console.log(123);
  searchFields.forEach(function (item) {
    var input = item.querySelector('.js-input-search');
    var clear = item.querySelector('.js-input-search-clear');

    if (input.value) {
      clear.style.display = 'block';
    } else {
      clear.style.display = 'none';
    }

    input.addEventListener('input', function () {
      if (input.value) {
        clear.style.display = 'block';
      } else {
        clear.style.display = 'none';
      }
    });
    clear.addEventListener('click', function () {
      input.value = '';
      clear.style.display = 'none';
    });
  });
})();
"use strict";

(function () {
  // PAGES.HOME_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isSupport2Page = document.querySelector('.support-documentation-tab-2');
  if (!isSupport2Page) return;
  var items = document.querySelectorAll('.support-documentation-tab-2__item');
  items.forEach(function (item) {
    var extraButton = item.querySelector('.support-documentation-tab-2__item__text__extra');
    var closeButton = item.querySelector('.support-documentation-tab-2__item__close');
    extraButton && extraButton.addEventListener('click', function () {
      items.forEach(function (item) {
        return item.classList.remove('open');
      });
      item.classList.add('open');
    });
    closeButton && closeButton.addEventListener('click', function () {
      item.classList.remove('open');
    });
  });
})();
"use strict";

(function () {
  // PAGES.HOME_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isSupport4Page = document.querySelector('.support-documentation-tab-4');
  if (!isSupport4Page) return;
  var faq = document.getElementById('home-faq');

  if (faq) {
    components.accordion(faq);
  }
})();
"use strict";

(function () {
  // PAGES.ABOUT_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isSuppoerEducationCourseItemPage = document.querySelector('.support-course-item-2');
  if (!isSuppoerEducationCourseItemPage) return;
  var vacantForm = document.getElementById('vacant-form');

  if (vacantForm) {
    var $submit = vacantForm.querySelector('[type="submit"]');
    var validator = utils.validator(vacantForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      company: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        required: {
          message: 'Обязательное поле'
        },
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Обязательное поле'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        vacantForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(vacantForm, function (response) {
          vacantForm.classList.remove('pending');
          if ($submit) $submit.disabled = false;

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }
})();
"use strict";

(function () {
  // PAGES.ABOUT_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isSuppoerEducationCourseItem2Page = document.querySelector('.support-course-item:not(.support-course-item-2)');
  if (!isSuppoerEducationCourseItem2Page) return;
  var vacantForm = document.getElementById('vacant-form');

  if (vacantForm) {
    var $submit = vacantForm.querySelector('[type="submit"]');
    var validator = utils.validator(vacantForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      company: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        required: {
          message: 'Обязательное поле'
        },
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Обязательное поле'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        vacantForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(vacantForm, function (response) {
          vacantForm.classList.remove('pending');
          if ($submit) $submit.disabled = false;

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }
})();
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
      html += "\n            <section class=\"home-faq-item accordion-item\">\n                  <header class=\"home-faq-item__header accordion-item-header accordion-trigger\">\n                    <h2 class=\"home-faq-item__title\">".concat(item.title, "</h2>\n                    <div class=\"home-faq-item__state\"></div>\n                  </header>\n                  <div class=\"accordion-item-panel\" >").concat(item.description, "\n                  </div>\n                </section>\n            ");
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
      $controlTextBlock.textContent = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(+page * +pageSize, " \u0438\u0437 ").concat(fullLength);
    } else {
      $controlTextBlock.textContent = "\u041F\u043E\u043A\u0430\u0437\u0430\u043D\u043E ".concat(fullLength, " \u0438\u0437 ").concat(fullLength);
    }
  }

  function setMoreBtn(fullLength, page, pageSize) {
    if (page * pageSize < fullLength) {
      $controlMoreBtn.classList.add(states.active);

      if (fullLength - page * pageSize > pagesize) {
        $controlMoreBtn.textContent = "\u0415\u0449\u0435 ".concat(pagesize);
      } else {
        $controlMoreBtn.textContent = "\u0415\u0449\u0435 ".concat(fullLength - page * pageSize);
      }
    } else {
      $controlMoreBtn.classList.remove(states.active);
    }
  }
})();
"use strict";

(function () {
  // PAGES.HOME_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isSupportMainPage = document.querySelector('.support-main-page');
  if (!isSupportMainPage) return;
  var faq = document.getElementById('home-faq');

  if (faq) {
    components.accordion(faq);
  }

  var rightArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-right\" href=\"#i-chevron-right\"></use>\n              </svg>";
  var leftArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-left\" href=\"#i-chevron-left\"></use>\n              </svg>";
  setTimeout(function () {
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
          gutter: 30
        },
        1020: {
          items: 3,
          gutter: 40
        }
      }
    });
  }, 300);

  if (window.innerWidth < 768) {
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
      controlsText: [leftArrow, rightArrow]
    });
  }

  if (window.innerWidth < 1020) {
    var descriptionAlertButton = document.querySelector('.description-with-title .icon-js');
    var descriptionAlertContent = document.querySelector('.description-with-title .description-with-title-abs');
    var descriptionAlertContentClose = document.querySelector('.description-with-title .description-with-title-abs__close');
    descriptionAlertButton.addEventListener('click', function () {
      if (descriptionAlertContent.classList.contains('open')) {
        descriptionAlertContent.classList.remove('open');
      } else {
        descriptionAlertContent.classList.add('open');
      }
    });
    descriptionAlertContentClose.addEventListener('click', function () {
      descriptionAlertContent.classList.remove('open');
    });
    document.body.addEventListener('click', function (e) {
      if (e.target.classList.contains('description-with-title-abs') || e.target.closest('.description-with-title-abs') || e.target.classList.contains('icon-js') || e.target.closest('.icon-js')) {} else {
        descriptionAlertContent.classList.remove('open');
      }
    });
  }
})();
"use strict";

(function () {
  // PAGES.ABOUT_PAGE
  var page = document.querySelector('.page');
  if (!page) return;
  var isVacantPage = document.querySelector('.vacancy-page');
  if (!isVacantPage) return;
  var event = new Event('change'); //datepicker

  var datepickers = document.querySelectorAll('.js-datepicker');
  datepickers.forEach(function (item) {
    var datepicker = new Datepicker(item, {
      language: 'ru'
    });
  }); //attachment field

  var dropArea = document.getElementById('drop-area');
  var inputFile = dropArea.querySelector('input[type="file"]');
  var dropAreaUploaded = document.getElementById('drop-area-uploaded');
  var removeAttachment = dropAreaUploaded.querySelector('svg');
  removeAttachment.addEventListener('click', function () {
    dropAreaUploaded.style.display = 'none';
    dropArea.style.display = 'flex';
    inputFile.value = '';

    if (!/safari/i.test(navigator.userAgent)) {
      inputFile.type = '';
      inputFile.type = 'file';
    }
  });
  inputFile.addEventListener('change', function (e) {
    var file = this.files[0];

    if (file) {
      previewFile(file);
    }
  });
  ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(function (eventName) {
    dropArea.addEventListener(eventName, preventDefaults, false);
  });

  function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
  }

  ;
  ['dragenter', 'dragover'].forEach(function (eventName) {
    dropArea.addEventListener(eventName, highlight, false);
  });
  ['dragleave', 'drop'].forEach(function (eventName) {
    dropArea.addEventListener(eventName, unhighlight, false);
  });

  function highlight(e) {
    dropArea.classList.add('highlight');
  }

  function unhighlight(e) {
    dropArea.classList.remove('highlight');
  }

  dropArea.addEventListener('drop', handleDrop, false);

  function handleDrop(e) {
    inputFile.files = e.dataTransfer.files;
    inputFile.dispatchEvent(event);
  }

  function previewFile(file) {
    var fileName = file.name;
    dropArea.style.display = 'none';
    var nameField = dropAreaUploaded.querySelector('span');
    nameField.textContent = fileName;
    dropAreaUploaded.style.display = 'block';
  }

  var vacantForm = document.getElementById('vacant-form');

  if (vacantForm) {
    var $submit = vacantForm.querySelector('[type="submit"]');
    var validator = utils.validator(vacantForm, {
      name: {
        required: {
          message: 'Обязательное поле'
        }
      },
      yearold: {
        required: {
          message: 'Обязательное поле'
        }
      },
      email: {
        required: {
          message: 'Обязательное поле'
        },
        email: {
          message: 'Некорректный формат'
        }
      },
      phone: {
        required: {
          message: 'Обязательное поле'
        },
        mask: {
          re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
          message: 'Некорректный формат'
        }
      },
      agreement: {
        required: {
          message: 'Обязательное поле'
        }
      }
    }, {
      parent: '.form-field',
      submit: function submit() {
        vacantForm.classList.add('pending');
        if ($submit) $submit.disabled = true;
        utils.submitForm(vacantForm, function (response) {
          vacantForm.classList.remove('pending');
          if ($submit) $submit.disabled = false;

          if (response.success) {
            if (parts.successModal) {
              parts.successModal.show();
            }
          } else {
            console.error(response);
          }
        });
      }
    });
  }
})();
"use strict";

document.addEventListener('DOMContentLoaded', function () {
  (function () {
    // PAGES.ABOUT_PAGE
    var page = document.querySelector('.page');
    if (!page) return;
    var isVacanciesPage = document.querySelector('.vacancies-page');
    if (!isVacanciesPage) return;
    var vacant = document.querySelector('.vacant');
    components.vacant(vacant);
    var rightArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-right\" href=\"#i-chevron-right\"></use>\n              </svg>";
    var leftArrow = "\n            <svg width=\"7\" height=\"12\">\n                <use xlink:href=\"#i-chevron-left\" href=\"#i-chevron-left\"></use>\n              </svg>";
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
    var workSlider = document.getElementById('work-slider');

    if (workSlider) {
      components.infiniteSlider(workSlider, {
        slides: 1,
        offset: 10,
        breakpoints: {
          768: {
            slides: 2,
            center: true
          },
          1280: {
            slides: 3,
            center: true
          }
        }
      });
    }
  })();
});
"use strict";

(function () {
  var cbs = window.delayedScripts || [];
  cbs.forEach(function (cb) {
    return cb();
  });
})();