(() => {
    const motionPreference = window.matchMedia('(prefers-reduced-motion: reduce)');
    if (motionPreference.matches || !('IntersectionObserver' in window)) { return; }

    const selectors = [
        '.welcome-note > *',
        '.experience-story-intro > div', '.experience-story-highlights > li', '.experience-story-plan', '.experience-story-return', '.home-discover-card', '.intro-copy', '.intro-visual', '.section-heading', '.category-toolbar',
        '.category-card', '.experience-toolbar', '.experience-card', '.offers-heading',
        '.escape-intro', '.escape-card', '.escape-personal', '.offer-card', '.collection-card', '.dining-image', '.dining-copy', '.moments > .eyebrow',
        '.moments > h2', '.moment-grid > div', '.closing > *',
        '.stay-heading', '.stay-photo', '.stay-content > div',
        '.offer-detail-top > *', '.offer-detail-body > div > *',
    ];
    const elements = [...document.querySelectorAll(selectors.join(','))];
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) { return; }
            entry.target.classList.add('is-revealed');
            observer.unobserve(entry.target);
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });

    elements.forEach(element => {
        const bounds = element.getBoundingClientRect();
        // Keep content already on screen visible, including restored scroll positions.
        if (bounds.top < window.innerHeight && bounds.bottom > 0) { return; }
        if (bounds.bottom <= 0) { return; }
        const siblings = [...element.parentElement.children];
        const staggered = element.matches('.welcome-note > *, .home-discover-card, .category-card, .experience-card, .offer-card, .moment-grid > div, .stay-photo, .closing > *');
        const delay = staggered ? (siblings.indexOf(element) % 3) * 100 : 0;
        element.style.setProperty('--reveal-delay', `${delay}ms`);
        element.classList.add('scroll-reveal');
        observer.observe(element);
    });

    document.addEventListener('focusin', event => {
        const element = event.target.closest('.scroll-reveal');
        if (element) { element.classList.add('is-revealed'); observer.unobserve(element); }
    });
    function revealAll() {
        elements.forEach(element => element.classList.add('is-revealed'));
        observer.disconnect();
    }
    motionPreference.addEventListener('change', event => { if (event.matches) { revealAll(); } });
    window.addEventListener('beforeprint', revealAll);
})();

// Fit editorial headings to their column without introducing line breaks.
(() => {
    const headings = [...document.querySelectorAll('.heading-one-line')];
    function fitHeading(heading) {
        heading.style.removeProperty('font-size');
        const available = heading.clientWidth;
        const required = heading.scrollWidth;
        if (available > 0 && required > available) {
            const size = parseFloat(getComputedStyle(heading).fontSize);
            heading.style.fontSize = `${Math.floor(size * available / required * 0.98)}px`;
        }
    }
    function fitAll() { headings.forEach(fitHeading); }
    fitAll();
    document.fonts.ready.then(fitAll);
    const resize = new ResizeObserver(fitAll);
    new Set(headings.map(heading => heading.parentElement)).forEach(parent => resize.observe(parent));
})();

// Fade in pending content images when the browser finishes loading them.
(() => {
    const preference = window.matchMedia('(prefers-reduced-motion: reduce)');
    if (preference.matches) { return; }
    const images = [...document.querySelectorAll('main img:not([fetchpriority="high"])')];
    const show = image => image.classList.remove('image-loading');
    images.forEach(image => {
        if (image.complete) { return; }
        image.classList.add('image-loading');
        image.addEventListener('load', () => show(image), { once: true });
        image.addEventListener('error', () => show(image), { once: true });
    });
    const showAll = () => images.forEach(show);
    preference.addEventListener('change', event => { if (event.matches) { showAll(); } });
    window.addEventListener('beforeprint', showAll);
    window.addEventListener('pageshow', event => { if (event.persisted) { showAll(); } });
})();

// Give inner-page headers the same scroll treatment as the home page.
(() => {
    const navigation = document.querySelector('.stay-navigation');
    if (!navigation) { return; }
    const update = () => navigation.classList.toggle('is-scrolled', window.scrollY > 8);
    const measure = () => document.documentElement.style.setProperty('--navigation-height', `${navigation.offsetHeight}px`);
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('pageshow', update);
    new ResizeObserver(measure).observe(navigation);
    measure();
    update();
})();
