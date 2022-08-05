(() => {
    // COMPONENTS.TAB
    const selectors = {
        itemBody: '.tab-body__item',
        itemHead: '.tab-head__item',
        trigger: '.tab-head__button',
    };

    const states = {
        active: 'active'
    };

    function tab($element) {
        if (!$element || !$element.classList.contains('tab')) return;

        const $headItems = $element.querySelectorAll(selectors.itemHead);

        if (!$headItems.length) return;

        const items = [];
        $headItems.forEach(($item) => {
            let tabName = $item.dataset.type;
            let trigger = $item.querySelector(selectors.trigger);
            let $bodyItem = $element.querySelector(selectors.itemBody + `[data-type="${tabName}"]`)
            items.push({
                headElement: $item,
                bodyElement: $bodyItem,
                trigger
            });
        });

        let activeItem = items[1];
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

        items.forEach((item) => {
            if (item.trigger) {
                item.trigger.addEventListener('click', () => toggleItem(item));
            }
        });

    }

    window.components = window.components || {};
    window.components.tab = tab;
})();
