(() => {
  // COMPONENTS.ACCORDION
  const selectors = {
    item: '.filter-dropdown',
    trigger: '.filter-dropdown-title svg',
    panel: '.filter-dropdown-container'
  };

  const states = {
    active: 'active'
  };

  function accordionFilter($element, setActive = false) {
    if (!$element) return;

    const $items = $element;

    if (!$items.length) return;

    const items = [];
    $items.forEach(($item) => {
      let trigger = $item.querySelector(selectors.trigger);
      let panel = $item.querySelector(selectors.panel);
      let collapsiblePanel = utils.collapsible(panel, 400);
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

      if (activeItem){
        closePanel(activeItem);
      }
      openPanel(item);
      activeItem = item;
    }
    if(setActive){
      openPanel(activeItem);
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
  window.components.accordionFilter = accordionFilter;
})();
