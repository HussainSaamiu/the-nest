const video = document.querySelector('#hero-video');
const videoToggle = document.querySelector('#video-toggle');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
function updateVideoControl() {
    videoToggle.textContent = video.paused ? '▷' : 'Ⅱ';
    videoToggle.setAttribute('aria-label', video.paused ? 'Play background video' : 'Pause background video');
}
if (reducedMotion.matches) { video.autoplay = false; video.pause(); }
video.addEventListener('play', updateVideoControl);
video.addEventListener('pause', updateVideoControl);
video.addEventListener('error', () => { videoToggle.hidden = true; });
videoToggle.addEventListener('click', () => {
    if (video.paused) { video.play().catch(() => { videoToggle.hidden = true; }); }
    else { video.pause(); }
});
updateVideoControl();
const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('#nav-links');
function closeMenu() { navLinks.querySelectorAll('details[open]').forEach(dropdown => { dropdown.open = false; }); navLinks.classList.remove('is-open'); menuToggle.setAttribute('aria-expanded', 'false'); menuToggle.setAttribute('aria-label', 'Open navigation'); }
menuToggle.addEventListener('click', () => {
    const open = navLinks.classList.toggle('is-open');
    menuToggle.setAttribute('aria-expanded', String(open));
    menuToggle.setAttribute('aria-label', open ? 'Close navigation' : 'Open navigation');
});
navLinks.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMenu));
document.addEventListener('keydown', event => { if (event.key === 'Escape') { closeMenu(); } });
const imageUrl = id => `https://images.unsplash.com/${id}?auto=format&fit=crop&w=1400&q=85`;
const villas = JSON.parse(document.querySelector('#stay-data').textContent);
const galleryDialog = document.querySelector('#gallery-dialog');
let selectedVilla = Object.keys(villas)[0];
let photoIndex = 0;
function renderGalleryPhoto() {
    const villa = villas[selectedVilla];
    const photo = villa.photos[photoIndex];
    document.querySelector('#gallery-title').textContent = villa.name;
    document.querySelector('#gallery-image').src = imageUrl(photo[0]);
    document.querySelector('#gallery-image').alt = photo[1];
    document.querySelector('#gallery-count').textContent = `${photoIndex + 1} / ${villa.photos.length} · Illustrative photography`;
}
function openGallery(key) { selectedVilla = key; photoIndex = 0; renderGalleryPhoto(); galleryDialog.showModal(); }
document.querySelectorAll('[data-gallery]').forEach(button => button.addEventListener('click', () => openGallery(button.dataset.gallery)));
document.querySelectorAll('[data-villa]').forEach(button => button.addEventListener('click', () => openGallery(button.dataset.villa)));
function movePhoto(direction) { photoIndex = (photoIndex + direction + villas[selectedVilla].photos.length) % villas[selectedVilla].photos.length; renderGalleryPhoto(); }
document.querySelector('#gallery-prev').addEventListener('click', () => movePhoto(-1));
document.querySelector('#gallery-next').addEventListener('click', () => movePhoto(1));
galleryDialog.addEventListener('keydown', event => { if (event.key === 'ArrowLeft') { movePhoto(-1); } if (event.key === 'ArrowRight') { movePhoto(1); } });
document.querySelectorAll('dialog').forEach(dialog => {
    dialog.querySelector('.dialog-close').addEventListener('click', () => dialog.close());
    dialog.addEventListener('click', event => { if (event.target === dialog) { const rect = dialog.getBoundingClientRect(); if (event.clientX < rect.left || event.clientX > rect.right || event.clientY < rect.top || event.clientY > rect.bottom) { dialog.close(); } } });
});
document.querySelector('#gallery-book').addEventListener('click', () => { galleryDialog.close(); document.querySelector('#booking').scrollIntoView({ behavior: reducedMotion.matches ? 'instant' : 'smooth' }); dateTriggers.get(checkIn).focus({ preventScroll: true }); });
const checkIn = document.querySelector('#check-in');
const checkOut = document.querySelector('#check-out');
function localDate(date) { return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`; }
function addDays(value, count) { const date = new Date(`${value}T12:00:00`); date.setDate(date.getDate() + count); return localDate(date); }
const today = localDate(new Date());
checkIn.min = today;
checkIn.value = addDays(today, 7);
checkOut.min = addDays(checkIn.value, 1);
checkOut.value = addDays(checkIn.value, 4);
checkIn.addEventListener('change', () => { if (!checkIn.value) { return; } checkOut.min = addDays(checkIn.value, 1); if (checkOut.value <= checkIn.value) { checkOut.value = addDays(checkIn.value, 1); } });
const bookingDialog = document.querySelector('#booking-dialog');
const money = value => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 0 }).format(value);
document.querySelector('#booking-form').addEventListener('submit', event => {
    event.preventDefault();
    if (checkIn.value < localDate(new Date()) || checkOut.value <= checkIn.value) { checkOut.setCustomValidity('Choose a departure date after arrival and an arrival date from today onwards.'); checkOut.reportValidity(); return; }
    checkOut.setCustomValidity('');
    const nights = Math.round((Date.parse(checkOut.value) - Date.parse(checkIn.value)) / 86400000);
    const guests = Number(document.querySelector('#guests').value);
    const formatDate = value => new Date(`${value}T12:00:00`).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
    document.querySelector('#stay-summary').textContent = `${formatDate(checkIn.value)} — ${formatDate(checkOut.value)} · ${nights} night${nights === 1 ? '' : 's'} · ${guests} guest${guests === 1 ? '' : 's'}`;
    const results = document.querySelector('#booking-results');
    results.replaceChildren();
    Object.values(villas).forEach(villa => {
        const row = document.createElement('div'); row.className = 'result-row';
        const info = document.createElement('div'); const title = document.createElement('h3'); title.textContent = villa.name;
        const description = document.createElement('p'); description.textContent = guests <= villa.capacity ? `${money(villa.price)} per night · breakfast included` : `Accommodates up to ${villa.capacity} guests`;
        const total = document.createElement('strong'); total.textContent = guests <= villa.capacity ? `${money(villa.price * nights)} / stay` : 'Choose fewer guests';
        if (guests > villa.capacity) { row.classList.add('unavailable'); }
        info.append(title, description); row.append(info, total); results.append(row);
    });
    bookingDialog.showModal();
});
checkOut.addEventListener('input', () => checkOut.setCustomValidity(''));
checkIn.addEventListener('input', () => checkOut.setCustomValidity(''));
document.querySelector('#change-dates').addEventListener('click', () => { bookingDialog.close(); dateTriggers.get(checkIn).focus(); });

// Keep the native date inputs as the source of truth for the booking form.
const datePicker = document.createElement('section');
datePicker.className = 'date-picker';
datePicker.hidden = true;
datePicker.id = 'stay-calendar';
datePicker.setAttribute('role', 'dialog');
datePicker.setAttribute('aria-label', 'Choose your stay dates');
datePicker.innerHTML = `
    <div class="date-picker-heading"><span class="eyebrow green" id="date-picker-step">SELECT CHECK IN</span><button type="button" class="date-picker-close" aria-label="Close calendar">×</button></div>
    <div class="date-picker-calendars">
        <button type="button" class="calendar-nav calendar-prev" data-month="-1" aria-label="Previous month">‹</button>
        <button type="button" class="calendar-nav calendar-next" data-month="1" aria-label="Next month">›</button>
        ${[0, 1].map(index => `<section class="calendar-panel"><h3 id="calendar-month-${index}" aria-live="polite"></h3><div class="date-picker-week" aria-hidden="true"><span>S</span><span>M</span><span>T</span><span>W</span><span>T</span><span>F</span><span>S</span></div><div class="date-picker-days" role="group" aria-labelledby="calendar-month-${index}"></div></section>`).join('')}
    </div>
    <div class="date-picker-footer" aria-live="polite"></div>`;
document.body.append(datePicker);
let activeDateInput = checkIn;
let choosingDeparture = false;
let calendarOpener;
let calendarMonth = new Date(`${checkIn.value.slice(0, 7)}-01T12:00:00`);
const dateTriggers = new Map();
const calendarIcon = '<svg viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="3"/><path d="M7 2v6M17 2v6M3 11h18"/></svg>';
function updateDateTriggers() {
    [checkIn, checkOut].forEach(input => {
        dateTriggers.get(input).querySelector('span').textContent = new Date(`${input.value}T12:00:00`).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
    });
}
function positionDatePicker() {
    const anchor = dateTriggers.get(checkIn).getBoundingClientRect();
    const width = datePicker.offsetWidth;
    const height = datePicker.offsetHeight;
    datePicker.style.left = `${Math.max(12, Math.min(anchor.left, window.innerWidth - width - 12))}px`;
    const below = anchor.bottom + 14;
    const fitsBelow = below + height <= window.innerHeight - 12;
    datePicker.classList.toggle('opens-above', !fitsBelow);
    datePicker.style.top = `${Math.max(12, fitsBelow ? below : anchor.top - height - 14)}px`;
}
function closeDatePicker(restoreFocus = false) {
    datePicker.hidden = true;
    dateTriggers.forEach(trigger => trigger.setAttribute('aria-expanded', 'false'));
    if (restoreFocus) { calendarOpener?.focus(); }
}
function renderDatePicker(focusValue) {
    const currentToday = localDate(new Date());
    const minimum = activeDateInput === checkIn ? currentToday : addDays(checkIn.value, 1);
    document.querySelector('#date-picker-step').textContent = activeDateInput === checkIn ? 'CHOOSE YOUR STAY · CHECK IN' : 'CHOOSE YOUR STAY · CHECK OUT';
    datePicker.querySelector('[data-month="-1"]').disabled = localDate(calendarMonth).slice(0, 7) <= minimum.slice(0, 7);
    datePicker.querySelectorAll('.calendar-panel').forEach((panel, index) => {
        const month = new Date(calendarMonth.getFullYear(), calendarMonth.getMonth() + index, 1, 12);
        panel.querySelector('h3').textContent = month.toLocaleDateString('en-GB', { month: 'long', year: 'numeric' });
        const days = panel.querySelector('.date-picker-days');
        days.replaceChildren();
        const offset = month.getDay();
        for (let index = 0; index < offset; index++) {
            const empty = document.createElement('span'); empty.setAttribute('aria-hidden', 'true'); days.append(empty);
        }
        const count = new Date(month.getFullYear(), month.getMonth() + 1, 0).getDate();
        for (let day = 1; day <= count; day++) {
            const date = new Date(month.getFullYear(), month.getMonth(), day, 12);
            const value = localDate(date);
            const button = document.createElement('button');
            button.type = 'button'; button.textContent = day; button.dataset.date = value;
            button.disabled = value < minimum;
            const selected = value === checkIn.value || (!choosingDeparture && value === checkOut.value);
            button.classList.toggle('is-selected', selected);
            button.classList.toggle('in-stay', !choosingDeparture && value > checkIn.value && value < checkOut.value);
            button.classList.toggle('is-today', value === currentToday);
            if (value === currentToday) { button.setAttribute('aria-current', 'date'); }
            const endpoint = value === checkIn.value ? ', check in' : !choosingDeparture && value === checkOut.value ? ', check out' : '';
            button.setAttribute('aria-label', date.toLocaleDateString('en-GB', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }) + endpoint);
            button.addEventListener('click', () => {
                activeDateInput.value = value;
                activeDateInput.dispatchEvent(new Event('change', { bubbles: true }));
                activeDateInput.setCustomValidity('');
                checkOut.setCustomValidity('');
                updateDateTriggers();
                if (activeDateInput === checkIn) {
                    activeDateInput = checkOut;
                    choosingDeparture = true;
                    const nextDay = addDays(checkIn.value, 1);
                    const lastVisible = new Date(calendarMonth.getFullYear(), calendarMonth.getMonth() + 2, 0, 12);
                    if (nextDay > localDate(lastVisible)) { calendarMonth.setMonth(calendarMonth.getMonth() + 1); }
                    renderDatePicker(nextDay);
                    positionDatePicker();
                } else {
                    choosingDeparture = false;
                    closeDatePicker(true);
                }
            });
            days.append(button);
        }
    });
    const nights = Math.round((Date.parse(checkOut.value) - Date.parse(checkIn.value)) / 86400000);
    datePicker.querySelector('.date-picker-footer').textContent = choosingDeparture ? 'Now select your check-out date' : `${nights} night${nights === 1 ? '' : 's'} in your island sanctuary`;
    if (focusValue) {
        const target = datePicker.querySelector(`[data-date="${focusValue}"]:not(:disabled)`) || datePicker.querySelector('.date-picker-days button:not(:disabled)');
        target?.focus({ preventScroll: true });
    }
}
function openDatePicker(input, focusDay = false) {
    calendarOpener = dateTriggers.get(input);
    activeDateInput = checkIn;
    choosingDeparture = false;
    calendarMonth = new Date(`${checkIn.value.slice(0, 7)}-01T12:00:00`);
    dateTriggers.forEach(trigger => trigger.setAttribute('aria-expanded', 'true'));
    datePicker.hidden = false;
    renderDatePicker(focusDay ? checkIn.value : undefined);
    positionDatePicker();
}
[checkIn, checkOut].forEach(input => {
    const trigger = document.createElement('button');
    trigger.type = 'button'; trigger.className = 'date-trigger';
    trigger.setAttribute('aria-haspopup', 'dialog'); trigger.setAttribute('aria-expanded', 'false');
    trigger.setAttribute('aria-label', 'Choose check-in and check-out dates');
    trigger.setAttribute('aria-controls', 'stay-calendar');
    trigger.innerHTML = `<span></span>${calendarIcon}`;
    dateTriggers.set(input, trigger);
    input.hidden = true;
    input.after(trigger);
    trigger.addEventListener('click', () => {
        if (!datePicker.hidden) { closeDatePicker(); }
        else { openDatePicker(input, true); }
    });
    input.addEventListener('change', updateDateTriggers);
});
updateDateTriggers();
datePicker.querySelector('.date-picker-close').addEventListener('click', () => closeDatePicker(true));
datePicker.querySelectorAll('[data-month]').forEach(button => button.addEventListener('click', () => {
    calendarMonth.setMonth(calendarMonth.getMonth() + Number(button.dataset.month));
    renderDatePicker(); positionDatePicker();
}));
datePicker.addEventListener('keydown', event => {
    if (event.key === 'Escape') { event.preventDefault(); closeDatePicker(true); return; }
    const shifts = { ArrowLeft: -1, ArrowRight: 1, ArrowUp: -7, ArrowDown: 7 };
    if (event.target.dataset.date && event.key in shifts) {
        event.preventDefault();
        const next = addDays(event.target.dataset.date, shifts[event.key]);
        const minimum = activeDateInput === checkIn ? localDate(new Date()) : addDays(checkIn.value, 1);
        if (next < minimum) { return; }
        if (!datePicker.querySelector(`[data-date="${next}"]`)) {
            calendarMonth = new Date(`${next.slice(0, 7)}-01T12:00:00`);
        }
        renderDatePicker(next); positionDatePicker();
    }
});
document.addEventListener('pointerdown', event => {
    if (!datePicker.hidden && !datePicker.contains(event.target) && ![...dateTriggers.values()].some(trigger => trigger.contains(event.target))) { closeDatePicker(); }
});
document.addEventListener('focusin', event => {
    if (!datePicker.hidden && !datePicker.contains(event.target) && ![...dateTriggers.values()].includes(event.target)) { closeDatePicker(); }
});
window.addEventListener('resize', () => { if (!datePicker.hidden) { positionDatePicker(); } });
window.addEventListener('scroll', () => { if (!datePicker.hidden) { positionDatePicker(); } }, { passive: true });

const navigation = document.querySelector('.navigation');
function updateNavigationBackground() {
    navigation.classList.toggle('is-scrolled', window.scrollY > 8);
}
updateNavigationBackground();
window.addEventListener('scroll', updateNavigationBackground, { passive: true });
window.addEventListener('pageshow', updateNavigationBackground);
function updateNavigationHeight() {
    document.documentElement.style.setProperty('--navigation-height', `${navigation.offsetHeight}px`);
}
updateNavigationHeight();
new ResizeObserver(updateNavigationHeight).observe(navigation);

const navigationDropdowns = [...document.querySelectorAll('.navigation .room-dropdown')];
navigationDropdowns.forEach(dropdown => {
    function closeOtherDropdowns() {
        navigationDropdowns.forEach(other => { if (other !== dropdown) { other.open = false; } });
    }
    dropdown.querySelector('summary').addEventListener('click', closeOtherDropdowns);
    dropdown.addEventListener('pointerenter', event => {
        if (event.pointerType === 'mouse' || event.pointerType === 'pen') { closeOtherDropdowns(); dropdown.open = true; }
    });
    dropdown.addEventListener('pointerleave', event => {
        if (event.pointerType === 'mouse' && !dropdown.contains(document.activeElement)) { dropdown.open = false; }
    });
    dropdown.addEventListener('focusout', () => {
        requestAnimationFrame(() => { if (!dropdown.contains(document.activeElement)) { dropdown.open = false; } });
    });
    dropdown.addEventListener('keydown', event => {
        if (event.key === 'Escape') { event.stopPropagation(); dropdown.open = false; dropdown.querySelector('summary').focus(); }
    });
});
document.addEventListener('pointerdown', event => {
    navigationDropdowns.forEach(dropdown => { if (!dropdown.contains(event.target)) { dropdown.open = false; } });
});
