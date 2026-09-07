/**
 * Opt-in same-page scrolling via data-scroll-target / data-scroll-anchor.
 * Independent of existing href="#section-id" navigation.
 */
const TARGET_SELECTOR = '[data-scroll-target]';
const HEADER_SELECTORS = ['.site-ibn-header', '.lp-header'];

const prefersReducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const cssEscape = (value) => {
    if (window.CSS?.escape) {
        return CSS.escape(value);
    }

    return String(value).replace(/\\/g, '\\\\').replace(/"/g, '\\"');
};

const findScrollAnchor = (name) => {
    const value = typeof name === 'string' ? name.trim() : '';

    if (!value) {
        return null;
    }

    try {
        return document.querySelector(`[data-scroll-anchor="${cssEscape(value)}"]`);
    } catch {
        return null;
    }
};

const stickyHeaderOffset = () => {
    let offset = 0;

    HEADER_SELECTORS.forEach((selector) => {
        const header = document.querySelector(selector);

        if (!header) {
            return;
        }

        const style = window.getComputedStyle(header);

        if (style.position !== 'sticky' && style.position !== 'fixed') {
            return;
        }

        const rect = header.getBoundingClientRect();

        if (rect.bottom > 0 && rect.top < 160) {
            offset = Math.max(offset, Math.round(rect.bottom));
        }
    });

    return offset;
};

const isModifiedClick = (event) =>
    event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.button !== 0;

const isExistingHashNavigation = (trigger) => {
    if (trigger.tagName.toLowerCase() !== 'a' || !trigger.hasAttribute('href')) {
        return false;
    }

    const rawHref = trigger.getAttribute('href')?.trim() ?? '';

    if (rawHref.length > 1 && rawHref.startsWith('#') && !rawHref.startsWith('#/')) {
        return true;
    }

    try {
        const url = new URL(trigger.href, window.location.href);
        const current = new URL(window.location.href);

        return (
            url.origin === current.origin &&
            url.pathname === current.pathname &&
            url.search === current.search &&
            url.hash.length > 1
        );
    } catch {
        return false;
    }
};

const isCrossPageLink = (trigger) => {
    if (trigger.tagName.toLowerCase() !== 'a' || !trigger.hasAttribute('href')) {
        return false;
    }

    const rawHref = trigger.getAttribute('href')?.trim() ?? '';

    if (rawHref === '' || rawHref === '#' || rawHref.startsWith('javascript:')) {
        return false;
    }

    try {
        const url = new URL(trigger.href, window.location.href);
        const current = new URL(window.location.href);

        return url.origin !== current.origin || url.pathname !== current.pathname || url.search !== current.search;
    } catch {
        return true;
    }
};

const isSubmitControl = (trigger) => {
    const tag = trigger.tagName.toLowerCase();

    if (tag === 'button') {
        return (trigger.getAttribute('type') || 'submit').toLowerCase() === 'submit';
    }

    if (tag === 'input') {
        const type = (trigger.getAttribute('type') || 'text').toLowerCase();

        return type === 'submit' || type === 'image';
    }

    return false;
};

const scrollToAnchor = (target) => {
    const top = window.scrollY + target.getBoundingClientRect().top - stickyHeaderOffset();

    window.scrollTo({
        top: Math.max(0, Math.round(top)),
        behavior: prefersReducedMotion() ? 'auto' : 'smooth',
    });
};

const activateScrollTarget = (event, trigger) => {
    if (event.defaultPrevented || isExistingHashNavigation(trigger) || isCrossPageLink(trigger) || isSubmitControl(trigger)) {
        return;
    }

    const target = findScrollAnchor(trigger.getAttribute('data-scroll-target'));

    if (!target) {
        return;
    }

    if (isModifiedClick(event) && trigger.tagName.toLowerCase() === 'a') {
        return;
    }

    event.preventDefault();
    scrollToAnchor(target);
};

const handleDelegatedClick = (event) => {
    const trigger = event.target.closest?.(TARGET_SELECTOR);

    if (!trigger) {
        return;
    }

    activateScrollTarget(event, trigger);
};

const handleDelegatedKeydown = (event) => {
    if (event.key !== 'Enter' && event.key !== ' ') {
        return;
    }

    const trigger = event.target.closest?.(TARGET_SELECTOR);

    if (!trigger) {
        return;
    }

    const tag = trigger.tagName.toLowerCase();

    if (['a', 'button', 'input', 'textarea', 'select', 'summary'].includes(tag)) {
        return;
    }

    if (event.key === ' ') {
        event.preventDefault();
    }

    activateScrollTarget(event, trigger);
};

export const initSmoothScrollToSection = () => {
    if (document.documentElement.dataset.smoothScrollBound === 'true') {
        return;
    }

    document.documentElement.dataset.smoothScrollBound = 'true';
    document.addEventListener('click', handleDelegatedClick);
    document.addEventListener('keydown', handleDelegatedKeydown);
};

initSmoothScrollToSection();
