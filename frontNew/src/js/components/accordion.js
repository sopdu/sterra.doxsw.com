(() => {
  // COMPONENTS.ACCORDION
  const selectors = {
    item: '.accordion-item',
    trigger: '.accordion-trigger',
    panel: '.accordion-item-panel'
  };

  const states = {
    active: 'active'
  };

  function accordion($element, setActive = true, changeButtonText = false) {
    if (!$element) return;

    const $items = $element.querySelectorAll(selectors.item);

    if (!$items.length) return;

    const items = [];
    $items.forEach(($item) => {
      let trigger = $item.querySelector(selectors.trigger);
      let panel = $item.querySelector(selectors.panel);
      let collapsiblePanel = utils.collapsible(panel, 700);
      items.push({
        element: $item,
        trigger,
        panel: collapsiblePanel
      });
    });
    let activeItem = null;
    if(setActive){
      activeItem = items[0];
    }

    function closePanel(item) {
      item.element.classList.remove(states.active);
      item.panel.close();
      if(changeButtonText){
        item.trigger.textContent = 'Развернуть'
      }
    }
    let first = true
    function openPanel(item) {
      item.element.classList.add(states.active);
      if(changeButtonText){
        item.trigger.textContent = 'Свернуть'
      }
      // setTimeout(function () {
        item.panel.open();
      // }, 450)
      if(!first){


      }
      first = false
    }

    function toggleItem(item) {
      if (item === activeItem) {
        closePanel(item);
        activeItem = null;
        return;
      }

      if (activeItem){

        closePanel(activeItem);
        const yActive = activeItem.trigger.getBoundingClientRect().top + window.scrollY;
        const yOpened = item.trigger.getBoundingClientRect().top + window.scrollY;
        if(yActive > yOpened){
          scrollTo(item.trigger.getBoundingClientRect().top + window.scrollY - 100, 400)
        } else {
          scrollTo(yActive - 100, 250)
        }
      }
      openPanel(item);
      activeItem = item;
    }
    if(setActive){
      setTimeout(() => {
        openPanel(activeItem);

      }, 200)
    }

    items.forEach((item) => {
      if (item.trigger) {
        item.trigger.addEventListener('click', () => toggleItem(item));
      }
    });

    window.addEventListener('resize', () => {
      if (activeItem) {
        activeItem.panel.resize();
      }
    });
  }

  window.components = window.components || {};
  window.components.accordion = accordion;

  Math.easeInOutQuad = function (t, b, c, d) {
    t /= d/2;
    if (t < 1) return c/2*t*t + b;
    t--;
    return -c/2 * (t*(t-2) - 1) + b;
  };
  function scrollTo(to, duration) {
    const element = document.scrollingElement;
    const start = (element && element.scrollTop) || window.pageYOffset,
        change = to - start,
        increment = 20;
    let currentTime = 150;

    const animateScroll = function(){
      currentTime += increment;
      const val = Math.easeInOutQuad(currentTime, start, change, duration);
      window.scrollTo(0, val);
      if(currentTime < duration) {
        console.log(val)
        window.setTimeout(animateScroll, increment);
      }
    };
    animateScroll();
  }


})();
