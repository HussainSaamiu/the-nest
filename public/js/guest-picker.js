(() => {
    const select = document.querySelector('#guests');
    if (!select) { return; }
    const wrapper = document.createElement('span');
    wrapper.className = 'guest-picker';
    const input = document.createElement('input');
    input.type = 'text';
    input.className = 'guest-picker-input';
    input.value = select.selectedOptions[0].text;
    input.setAttribute('role', 'combobox');
    input.setAttribute('aria-label', 'Search guests');
    input.setAttribute('aria-autocomplete', 'list');
    input.setAttribute('aria-expanded', 'false');
    input.setAttribute('aria-controls', 'guest-options');
    input.autocomplete = 'off';
    const list = document.createElement('span');
    list.id = 'guest-options';
    list.className = 'guest-options';
    list.setAttribute('role', 'listbox');
    list.setAttribute('aria-label', 'Guest count');
    list.hidden = true;
    wrapper.append(input, list);
    select.after(wrapper);
    select.hidden = true;
    const options = [...select.options];
    let matches = options;
    let active = -1;
    const close = () => {
        list.hidden = true;
        input.setAttribute('aria-expanded', 'false');
        input.removeAttribute('aria-activedescendant');
        input.value = select.selectedOptions[0].text;
    };
    const choose = option => {
        select.value = option.value;
        select.dispatchEvent(new Event('change', { bubbles: true }));
        close();
    };
    const render = query => {
        matches = options.filter(option => option.text.toLowerCase().includes(query.toLowerCase().trim()));
        active = -1;
        input.removeAttribute('aria-activedescendant');
        list.replaceChildren();
        matches.forEach((option, index) => {
            const item = document.createElement('span');
            item.id = `guest-option-${index}`;
            item.setAttribute('role', 'option');
            item.setAttribute('aria-selected', String(option.value === select.value));
            item.textContent = option.text;
            item.addEventListener('mousedown', event => event.preventDefault());
            item.addEventListener('click', () => choose(option));
            list.append(item);
        });
        if (!matches.length) {
            const empty = document.createElement('span');
            empty.className = 'guest-empty';
            empty.setAttribute('role', 'status');
            empty.textContent = 'No matching guest count';
            list.append(empty);
        }
        list.hidden = false;
        input.setAttribute('aria-expanded', 'true');
    };
    input.addEventListener('focus', () => { render(''); input.select(); });
    input.addEventListener('click', () => { if (list.hidden) { render(''); input.select(); } });
    input.addEventListener('input', () => render(input.value));
    input.addEventListener('blur', close);
    input.addEventListener('keydown', event => {
        if (event.key === 'Escape') { event.preventDefault(); close(); }
        if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
            event.preventDefault();
            if (list.hidden) { render(''); }
            if (!matches.length) { return; }
            active = active < 0 ? (event.key === 'ArrowDown' ? 0 : matches.length - 1) : (active + (event.key === 'ArrowDown' ? 1 : -1) + matches.length) % matches.length;
            [...list.children].forEach((item, index) => item.classList.toggle('is-active', index === active));
            input.setAttribute('aria-activedescendant', list.children[active].id);
            list.children[active].scrollIntoView({ block: 'nearest' });
        }
        if (event.key === 'Enter' && !list.hidden) {
            event.preventDefault();
            if (matches.length) { choose(matches[active < 0 ? 0 : active]); }
        }
    });
})();
