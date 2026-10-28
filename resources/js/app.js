import './bootstrap';
import './smooth-scroll-to-section';
import intlTelInput from 'intl-tel-input';

const initSiteNavbar = () => {
    const navbarRoot = document.querySelector('.site-ibn-navbar');

    if (!navbarRoot || navbarRoot.dataset.navbarReady === 'true') {
        return;
    }

    navbarRoot.dataset.navbarReady = 'true';

    const loadNavIcons = () => {
        navbarRoot.querySelectorAll('image[data-nav-icon]').forEach((node) => {
            if (node.getAttribute('href')) {
                return;
            }

            const src = node.getAttribute('data-nav-icon');

            if (src) {
                node.setAttribute('href', src);
            }
        });
    };

    navbarRoot.addEventListener('pointerover', loadNavIcons, { once: true, passive: true });
    navbarRoot.addEventListener('pointerdown', loadNavIcons, { once: true, passive: true });
    navbarRoot.addEventListener('focusin', loadNavIcons, { once: true });

    const header = navbarRoot.closest('.site-ibn-header');
    const navbarToggler = navbarRoot.querySelector('#navbarToggler');
    const navbarNav = navbarRoot.querySelector('#navbarNav');
    const dropdowns = navbarRoot.querySelectorAll('.has-megamenu');
    const navMenuIcon = navbarToggler?.querySelector('.nav-menu-icon');
    const backdrop = header?.querySelector('.site-ibn-nav-backdrop');
    const navTogglerLabel = navbarToggler?.querySelector('.navbar-toggler__label');

    if (!header || !navbarToggler || !navbarNav || !dropdowns.length) {
        return;
    }

    const closeDelay = 180;
    let closeTimer = null;
    let desktopMode = window.innerWidth >= 992;

    const isDesktop = () => window.innerWidth >= 992;

    const normalizePath = (pathname) => {
        const trimmed = (pathname || '/').replace(/\/+$/, '');

        return trimmed === '' ? '/' : trimmed;
    };

    const markCurrentLinks = () => {
        const currentPath = normalizePath(window.location.pathname);

        navbarRoot.querySelectorAll('.navbar-nav a[href]').forEach((link) => {
            const href = link.getAttribute('href');

            if (!href || href.startsWith('#') || href.startsWith('javascript:')) {
                return;
            }

            let url;

            try {
                url = new URL(link.href, window.location.origin);
            } catch {
                return;
            }

            if (url.origin !== window.location.origin || normalizePath(url.pathname) !== currentPath) {
                return;
            }

            link.classList.add('is-current');
            link.setAttribute('aria-current', 'page');
            link.closest('.nav-item')?.classList.add('is-current');

            const submenu = link.closest('.submenu');

            if (submenu?.id) {
                navbarRoot.querySelector(`[data-target="${submenu.id}"]`)?.classList.add('is-current');
            }
        });
    };

    const updatePanelTop = () => {
        const bar = navbarRoot.querySelector('.navbar');

        if (!bar) {
            return;
        }

        header.style.setProperty('--nav-panel-top', `${Math.round(bar.getBoundingClientRect().bottom)}px`);
        header.style.setProperty('--nav-bar-bottom', `${Math.round(bar.getBoundingClientRect().bottom)}px`);

        const topbar = header.querySelector('.site-ibn-topbar');

        if (!isDesktop() && header.classList.contains('is-open') && topbar) {
            header.style.setProperty('--drawer-topbar-height', `${Math.round(topbar.getBoundingClientRect().height)}px`);
            return;
        }

        if (!isDesktop()) {
            header.style.setProperty('--drawer-topbar-height', '0px');
        }
    };

    const injectMobileSubmenus = () => {
        const capabilitiesDropdown = navbarRoot.querySelector('.has-megamenu .special-view');

        if (!capabilitiesDropdown) {
            return;
        }

        const menuCategories = capabilitiesDropdown.querySelector('.menu-categories');
        const menuContent = capabilitiesDropdown.querySelector('.menu-content');

        if (!menuCategories || !menuContent) {
            return;
        }

        menuCategories.querySelectorAll('.submenu').forEach((submenu) => submenu.remove());

        if (isDesktop()) {
            menuContent.style.display = '';
            return;
        }

        menuCategories.querySelectorAll('.menu-category-heading').forEach((heading) => {
            heading.classList.remove('active');
            heading.setAttribute('aria-expanded', 'false');
            const targetId = heading.getAttribute('data-target');
            const submenu = menuContent.querySelector(`#${targetId}`);

            if (!submenu) {
                return;
            }

            const clone = submenu.cloneNode(true);
            clone.removeAttribute('id');
            clone.querySelectorAll('[id]').forEach((node) => node.removeAttribute('id'));
            clone.classList.remove('active');
            heading.insertAdjacentElement('afterend', clone);
        });

        menuContent.style.display = 'none';
    };

    const syncDropdownToggleState = (dropdown, open) => {
        dropdown.querySelector('.dropdown-toggle')?.setAttribute('aria-expanded', open ? 'true' : 'false');
    };

    const closeDesktopMenus = (except = null) => {
        dropdowns.forEach((dropdown) => {
            if (dropdown === except) {
                return;
            }

            dropdown.classList.remove('is-open');
            syncDropdownToggleState(dropdown, false);
        });
    };

    const openDesktopMenu = (dropdown) => {
        clearTimeout(closeTimer);
        closeDesktopMenus(dropdown);
        dropdown.classList.add('is-open');
        syncDropdownToggleState(dropdown, true);
        updatePanelTop();
    };

    const scheduleDesktopClose = (dropdown) => {
        clearTimeout(closeTimer);
        closeTimer = window.setTimeout(() => {
            if (dropdown.contains(document.activeElement)) {
                return;
            }

            dropdown.classList.remove('is-open');
            syncDropdownToggleState(dropdown, false);
        }, closeDelay);
    };

    const syncNavTogglerState = (open) => {
        const label = open ? 'Close menu' : 'Open menu';
        navbarToggler.setAttribute('aria-expanded', open ? 'true' : 'false');
        navbarToggler.setAttribute('aria-label', label);

        if (navTogglerLabel) {
            navTogglerLabel.textContent = label;
        }
    };

    const setMobileOpen = (open) => {
        navbarNav.classList.toggle('active', open);
        header.classList.toggle('is-open', open);
        document.documentElement.classList.toggle('nav-menu-open', open);
        document.body.classList.toggle('nav-menu-open', open);
        syncNavTogglerState(open);
        navMenuIcon?.classList.toggle('fa-times', open);
        navMenuIcon?.classList.toggle('fa-bars', !open);

        if (backdrop) {
            backdrop.hidden = !open;
        }

        if (open) {
            navbarNav.removeAttribute('inert');
            window.requestAnimationFrame(() => window.requestAnimationFrame(updatePanelTop));
            return;
        }

        navbarNav.setAttribute('inert', '');
        dropdowns.forEach((dropdown) => {
            dropdown.classList.remove('active');
            syncDropdownToggleState(dropdown, false);
        });
        updatePanelTop();
    };

    const activateCategory = (dropdown, category) => {
        const categories = dropdown.querySelectorAll('.deskmeg-menu .menu-category-heading');
        const submenus = dropdown.querySelectorAll('.menu-content > .submenu');

        categories.forEach((item) => {
            const selected = item === category;
            item.classList.toggle('active', selected);
            item.setAttribute('aria-expanded', selected ? 'true' : 'false');
        });
        submenus.forEach((submenu) => submenu.classList.remove('active'));

        const targetSubmenu = dropdown.querySelector(`#${category.getAttribute('data-target')}`);
        targetSubmenu?.classList.add('active');
    };

    markCurrentLinks();
    injectMobileSubmenus();
    updatePanelTop();

    if (!isDesktop()) {
        navbarNav.setAttribute('inert', '');
    }

    navbarToggler.addEventListener('click', () => {
        if (isDesktop()) {
            return;
        }

        setMobileOpen(!navbarNav.classList.contains('active'));
    });

    backdrop?.addEventListener('click', () => {
        setMobileOpen(false);
        navbarToggler.focus();
    });

    dropdowns.forEach((dropdown) => {
        const toggleLink = dropdown.querySelector('.dropdown-toggle');

        if (!toggleLink) {
            return;
        }

        dropdown.addEventListener('pointerenter', () => {
            if (!isDesktop()) {
                return;
            }

            openDesktopMenu(dropdown);
        });

        dropdown.addEventListener('pointerleave', () => {
            if (!isDesktop()) {
                return;
            }

            scheduleDesktopClose(dropdown);
        });

        dropdown.addEventListener('focusout', (event) => {
            if (!isDesktop() || dropdown.contains(event.relatedTarget)) {
                return;
            }

            scheduleDesktopClose(dropdown);
        });

        toggleLink.addEventListener('click', (event) => {
            event.preventDefault();

            if (isDesktop()) {
                const open = !dropdown.classList.contains('is-open');

                if (open) {
                    openDesktopMenu(dropdown);
                    return;
                }

                clearTimeout(closeTimer);
                dropdown.classList.remove('is-open');
                syncDropdownToggleState(dropdown, false);
                return;
            }

            const wasActive = dropdown.classList.contains('active');
            dropdowns.forEach((item) => {
                item.classList.remove('active');
                syncDropdownToggleState(item, false);
            });

            if (!wasActive) {
                dropdown.classList.add('active');
            }

            syncDropdownToggleState(dropdown, dropdown.classList.contains('active'));
        });

        toggleLink.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowDown' && isDesktop()) {
                event.preventDefault();
                openDesktopMenu(dropdown);
                dropdown.querySelector('.menu-category-heading, .submenu a')?.focus();
            }
        });

        const tabbedMenu = dropdown.querySelector('.deskmeg-menu');

        if (!tabbedMenu) {
            return;
        }

        const categories = [...tabbedMenu.querySelectorAll('.menu-category-heading')];

        categories.forEach((category, index) => {
            category.setAttribute('role', 'button');
            category.setAttribute('tabindex', '0');
            category.setAttribute('aria-expanded', category.classList.contains('active') ? 'true' : 'false');

            category.addEventListener('mouseenter', () => {
                if (!isDesktop()) {
                    return;
                }

                activateCategory(dropdown, category);
            });

            category.addEventListener('click', (event) => {
                if (isDesktop()) {
                    activateCategory(dropdown, category);
                    return;
                }

                event.stopPropagation();

                const injectedSubmenu = category.nextElementSibling?.classList.contains('submenu')
                    ? category.nextElementSibling
                    : null;
                const wasActive = category.classList.contains('active');

                categories.forEach((item) => {
                    if (item === category) {
                        return;
                    }

                    item.classList.remove('active');
                    item.setAttribute('aria-expanded', 'false');

                    if (item.nextElementSibling?.classList.contains('submenu')) {
                        item.nextElementSibling.classList.remove('active');
                    }
                });

                if (!injectedSubmenu) {
                    return;
                }

                category.classList.toggle('active', !wasActive);
                category.setAttribute('aria-expanded', !wasActive ? 'true' : 'false');
                injectedSubmenu.classList.toggle('active', !wasActive);
            });

            category.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    category.click();
                    return;
                }

                if (!isDesktop()) {
                    return;
                }

                if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
                    event.preventDefault();
                    const next = event.key === 'ArrowDown'
                        ? categories[index + 1] || categories[0]
                        : categories[index - 1] || categories[categories.length - 1];
                    next.focus();
                    activateCategory(dropdown, next);
                }

                if (event.key === 'ArrowRight') {
                    event.preventDefault();
                    dropdown.querySelector(`#${category.getAttribute('data-target')} a`)?.focus();
                }
            });
        });
    });

    document.addEventListener('click', (event) => {
        if (!isDesktop() || header.contains(event.target)) {
            return;
        }

        clearTimeout(closeTimer);
        closeDesktopMenus();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') {
            return;
        }

        if (!isDesktop() && header.classList.contains('is-open')) {
            setMobileOpen(false);
            navbarToggler.focus();
            return;
        }

        const openDropdown = [...dropdowns].find((dropdown) => dropdown.classList.contains('is-open'));

        if (!openDropdown) {
            return;
        }

        clearTimeout(closeTimer);
        openDropdown.classList.remove('is-open');
        syncDropdownToggleState(openDropdown, false);
        openDropdown.querySelector('.dropdown-toggle')?.focus();
    });

    header.addEventListener('keydown', (event) => {
        if (event.key !== 'Tab' || isDesktop() || !header.classList.contains('is-open')) {
            return;
        }

        const focusable = [...header.querySelectorAll('a[href], button, [tabindex="0"]')].filter((node) => {
            if (node.hidden || node.closest('[inert]') || node.getAttribute('aria-hidden') === 'true') {
                return false;
            }

            return node.getClientRects().length > 0;
        });

        if (!focusable.length) {
            return;
        }

        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    });

    window.addEventListener('resize', () => {
        const nowDesktop = isDesktop();
        updatePanelTop();

        if (nowDesktop === desktopMode) {
            return;
        }

        desktopMode = nowDesktop;
        clearTimeout(closeTimer);
        closeDesktopMenus();
        injectMobileSubmenus();

        if (nowDesktop) {
            setMobileOpen(false);
            navbarNav.removeAttribute('inert');
            return;
        }

        if (!header.classList.contains('is-open')) {
            navbarNav.setAttribute('inert', '');
        }
    });

    let panelTopFrame = 0;
    const schedulePanelTop = () => {
        if (panelTopFrame) {
            return;
        }

        panelTopFrame = window.requestAnimationFrame(() => {
            panelTopFrame = 0;
            updatePanelTop();
        });
    };

    window.addEventListener('scroll', schedulePanelTop, { passive: true });
};

const getPhoneInputValue = (input, instance) => {
    if (!input.value.trim()) {
        return '';
    }

    return instance.isValidNumber() ? instance.getNumber() : input.value.trim();
};

const syncPhoneInput = (input, instance) => {
    const hiddenInput = document.querySelector(input.dataset.phoneHidden);

    if (!hiddenInput) {
        return;
    }

    const hasValue = Boolean(input.value.trim());
    const isValid = !hasValue || instance.isValidNumber();

    hiddenInput.value = getPhoneInputValue(input, instance);
    hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
    hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));

    input.setCustomValidity(isValid ? '' : 'Enter a valid international phone number.');
    input.classList.toggle('is-invalid', !isValid);
};

const clearPhoneInputs = (root = document) => {
    const inputs = root.matches?.('[data-phone-input]')
        ? [root]
        : Array.from(root.querySelectorAll('[data-phone-input]'));

    inputs.forEach((input) => {
        const instance = intlTelInput.getInstance(input);

        if (instance) {
            instance.setNumber('');
            syncPhoneInput(input, instance);
            return;
        }

        input.value = '';

        const hiddenInput = document.querySelector(input.dataset.phoneHidden);

        if (!hiddenInput) {
            return;
        }

        hiddenInput.value = '';
        hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
        hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
    });
};

const initPhoneInputs = (root = document) => {
    const inputs = root.matches?.('[data-phone-input]')
        ? [root]
        : Array.from(root.querySelectorAll('[data-phone-input]'));

    inputs.forEach((input) => {
        if (input.dataset.phoneReady === 'true') {
            return;
        }

        input.dataset.phoneReady = 'true';

        const instance = intlTelInput(input, {
            initialCountry: input.dataset.initialCountry || 'us',
            countryOrder: ['us', 'in', 'gb'],
            countrySearch: true,
            separateDialCode: true,
            formatAsYouType: true,
            formatOnDisplay: true,
            strictMode: true,
            loadUtils: () => import('intl-tel-input/utils'),
        });

        input.addEventListener('input', () => syncPhoneInput(input, instance));
        input.addEventListener('blur', () => syncPhoneInput(input, instance));
        input.addEventListener('countrychange', () => syncPhoneInput(input, instance));

        input.form?.addEventListener('submit', () => syncPhoneInput(input, instance));

        instance.promise.then(() => syncPhoneInput(input, instance));
    });
};

const schedulePhoneInputs = (root = document) => {
    const inputs = root.matches?.('[data-phone-input]')
        ? [root]
        : Array.from(root.querySelectorAll?.('[data-phone-input]') || []);

    if (!inputs.length) {
        return;
    }

    if (!('IntersectionObserver' in window)) {
        initPhoneInputs(root);

        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            observer.unobserve(entry.target);
            initPhoneInputs(entry.target);
        });
    }, { rootMargin: '400px 0px' });

    inputs.forEach((input) => {
        if (input.dataset.phoneReady === 'true' || input.dataset.phoneObserved === 'true') {
            return;
        }

        input.dataset.phoneObserved = 'true';
        input.addEventListener('focus', () => initPhoneInputs(input), { once: true });
        observer.observe(input);
    });
};

const initArticleToc = (root = document) => {
    const articleRoot = root.querySelector?.('.article-detail') ?? (root.matches?.('.article-detail') ? root : null);

    if (!articleRoot) {
        return;
    }

    const tocRoot = articleRoot.querySelector('[data-article-toc-root]');
    const tocList = articleRoot.querySelector('[data-article-toc-list]');
    const contentRoot = articleRoot.querySelector('[data-article-content]');

    if (!tocRoot || !tocList || !contentRoot) {
        return;
    }

    const slugify = (value) =>
        value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '') || 'section';

    const getHeadings = () => Array.from(contentRoot.querySelectorAll('h2[id], h3[id], h2:not([id]), h3:not([id])'));

    const syncHeadingIds = (headings) => {
        const used = new Set();

        headings.forEach((heading, index) => {
            const currentId = heading.id?.trim();

            if (currentId && !used.has(currentId)) {
                used.add(currentId);
                return;
            }

            const baseId = slugify(heading.textContent || `section ${index + 1}`);
            let nextId = baseId;
            let suffix = 2;

            while (used.has(nextId) || document.querySelectorAll(`#${CSS.escape(nextId)}`).length > 1) {
                nextId = `${baseId}-${suffix}`;
                suffix += 1;
            }

            heading.id = nextId;
            used.add(nextId);
        });
    };

    const buildToc = () => {
        const headings = getHeadings().filter((heading) => heading.textContent?.trim());
        let h2Index = 0;
        let h3Index = 0;

        syncHeadingIds(headings);

        tocList.innerHTML = '';

        headings.forEach((heading) => {
            const item = document.createElement('li');
            const link = document.createElement('a');
            const number = document.createElement('span');
            const isSubheading = heading.tagName.toLowerCase() === 'h3';

            if (isSubheading) {
                h3Index += 1;
            } else {
                h2Index += 1;
                h3Index = 0;
            }

            link.href = `#${heading.id}`;
            link.className = 'article-detail__toc-link';
            link.dataset.tocLink = 'true';
            link.dataset.targetId = heading.id;
            link.dataset.level = heading.tagName.toLowerCase();
            number.className = 'article-detail__toc-number';
            number.textContent = isSubheading ? `${h2Index}.${h3Index}` : `${h2Index}`;

            link.appendChild(number);
            link.append(document.createTextNode(heading.textContent.trim()));

            item.appendChild(link);
            tocList.appendChild(item);
        });

        tocRoot.hidden = headings.length === 0;

        return headings;
    };

    const activateCurrentHeading = (headings) => {
        if (!headings.length) {
            return;
        }

        const offset = 140;
        let activeHeading = headings[0];

        headings.forEach((heading) => {
            if (heading.getBoundingClientRect().top - offset <= 0) {
                activeHeading = heading;
            }
        });

        tocList.querySelectorAll('[data-toc-link]').forEach((link) => {
            link.classList.toggle('is-active', link.dataset.targetId === activeHeading.id);
        });
    };

    let headings = buildToc();
    activateCurrentHeading(headings);

    if (articleRoot.dataset.tocReady === 'true') {
        return;
    }

    articleRoot.dataset.tocReady = 'true';

    tocList.addEventListener('click', (event) => {
        const link = event.target.closest('[data-toc-link]');

        if (!link) {
            return;
        }

        const target = document.getElementById(link.dataset.targetId || '');

        if (!target) {
            return;
        }

        event.preventDefault();

        target.scrollIntoView({
            behavior: 'smooth',
            block: 'start',
        });

        history.replaceState(null, '', `#${target.id}`);
    });

    const refresh = () => {
        headings = buildToc();
        activateCurrentHeading(headings);
    };

    const observer = new MutationObserver(() => {
        window.requestAnimationFrame(refresh);
    });

    observer.observe(contentRoot, {
        childList: true,
        subtree: true,
        characterData: true,
    });

    document.addEventListener('scroll', () => activateCurrentHeading(headings), { passive: true });
    window.addEventListener('resize', () => activateCurrentHeading(headings), { passive: true });
};

const FOCUSABLE_SELECTOR = [
    'a[href]',
    'button:not([disabled])',
    'textarea:not([disabled])',
    'input:not([disabled]):not([type="hidden"])',
    'select:not([disabled])',
    '[tabindex]:not([tabindex="-1"])',
].join(',');

const openContactModal = (options = {}) => {
    const detail = {
        service: typeof options.service === 'string' && options.service !== '' ? options.service : null,
        variant: typeof options.variant === 'string' && options.variant !== '' ? options.variant : null,
        title: typeof options.title === 'string' && options.title !== '' ? options.title : null,
        subtitle: typeof options.subtitle === 'string' && options.subtitle !== '' ? options.subtitle : null,
    };

    window.dispatchEvent(new CustomEvent('open-contact-modal', { detail }));

    if (window.Livewire?.dispatch) {
        window.Livewire.dispatch('open-contact-modal', detail);
    }
};

window.openContactModal = openContactModal;

const getScrollableParent = (element) => {
    let parent = element?.parentElement;

    while (parent && parent !== document.body) {
        const style = window.getComputedStyle(parent);
        const overflowY = style.overflowY;
        const canScroll =
            (overflowY === 'auto' || overflowY === 'scroll' || overflowY === 'overlay') &&
            parent.scrollHeight > parent.clientHeight + 1;

        if (canScroll || parent.matches('.contact-modal__body, [data-form-scroll-container]')) {
            return parent;
        }

        parent = parent.parentElement;
    }

    return null;
};

window.revealFormSuccess = (element) => {
    if (!(element instanceof HTMLElement)) {
        return;
    }

    const reveal = () => {
        const container = getScrollableParent(element);

        if (container) {
            container.scrollTo({ top: 0, behavior: 'smooth' });
        }

        element.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'nearest' });

        try {
            element.focus({ preventScroll: true });
        } catch {
            element.focus?.();
        }
    };

    window.requestAnimationFrame(() => {
        window.requestAnimationFrame(reveal);
    });
};

document.addEventListener('alpine:init', () => {
    window.Alpine.data('contactModal', () => ({
        previouslyFocused: null,

        init() {
            this.$watch('$wire.isOpen', (open) => {
                document.documentElement.classList.toggle('contact-modal-open', Boolean(open));

                const inertTargets = [
                    document.getElementById('main-content'),
                    document.getElementById('site-header'),
                ];

                inertTargets.forEach((element) => {
                    if (!element) {
                        return;
                    }

                    if (open) {
                        element.setAttribute('inert', '');
                        return;
                    }

                    element.removeAttribute('inert');
                });

                if (!open) {
                    this.$nextTick(() => {
                        this.previouslyFocused?.focus?.();
                        this.previouslyFocused = null;
                    });
                    return;
                }

                this.previouslyFocused = document.activeElement;

                this.$nextTick(() => {
                    const dialog = this.$refs.dialog;
                    const focusTarget =
                        dialog?.querySelector(
                            'input:not([type="hidden"]), textarea, button.contact-modal__close',
                        ) || dialog;

                    focusTarget?.focus?.();
                    initPhoneInputs(dialog || document);
                    initConsentTooltips(dialog || document);
                });
            });
        },

        open() {
            this.$wire.open();
        },

        close() {
            this.$wire.close();
        },

        trapFocus(event) {
            const dialog = this.$refs.dialog;

            if (!dialog || !this.$wire.isOpen) {
                return;
            }

            const focusable = Array.from(dialog.querySelectorAll(FOCUSABLE_SELECTOR)).filter(
                (element) => !element.hasAttribute('disabled') && element.offsetParent !== null,
            );

            if (!focusable.length) {
                event.preventDefault();
                dialog.focus();
                return;
            }

            const first = focusable[0];
            const last = focusable[focusable.length - 1];
            const active = document.activeElement;

            if (event.shiftKey && active === first) {
                event.preventDefault();
                last.focus();
                return;
            }

            if (!event.shiftKey && active === last) {
                event.preventDefault();
                first.focus();
            }
        },
    }));
});

let blogContactModalAutoTimer = null;

const clearBlogContactModalAutoTimer = () => {
    if (blogContactModalAutoTimer !== null) {
        window.clearTimeout(blogContactModalAutoTimer);
        blogContactModalAutoTimer = null;
    }
};

const initBlogContactModalAutoOpen = () => {
    clearBlogContactModalAutoTimer();

    const root = document.querySelector('[data-blog-contact-modal-auto]');

    if (!root) {
        return;
    }

    const title = root.dataset.contactModalTitle;
    const subtitle = root.dataset.contactModalSubtitle;

    if (!title || !subtitle) {
        return;
    }

    const schedule = () => {
        clearBlogContactModalAutoTimer();

        blogContactModalAutoTimer = window.setTimeout(() => {
            blogContactModalAutoTimer = null;

            if (document.documentElement.classList.contains('contact-modal-open')) {
                return;
            }

            openContactModal({ title, subtitle });
        }, 30000);
    };

    if (document.readyState === 'complete') {
        schedule();
    } else {
        window.addEventListener('load', schedule, { once: true });
    }
};

window.addEventListener('pagehide', clearBlogContactModalAutoTimer);

const initContactModalTriggers = () => {
    document.querySelectorAll('[data-contact-modal-trigger]').forEach((trigger) => {
        if (trigger.dataset.contactModalBound === 'true') {
            return;
        }

        trigger.dataset.contactModalBound = 'true';
        trigger.setAttribute('aria-haspopup', 'dialog');

        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            openContactModal({
                service: trigger.dataset.contactService || null,
                variant: trigger.dataset.contactVariant || null,
            });
        });
    });
};

const setConsentTooltipOpen = (tooltip, open) => {
    const trigger = tooltip.querySelector('.consent-tooltip__trigger');
    const content = tooltip.querySelector('.consent-tooltip__content');

    tooltip.classList.toggle('is-open', open);
    trigger?.setAttribute('aria-expanded', open ? 'true' : 'false');
    content?.setAttribute('aria-hidden', open ? 'false' : 'true');
};

const closeAllConsentTooltips = (except = null) => {
    document.querySelectorAll('[data-consent-tooltip].is-open').forEach((tooltip) => {
        if (tooltip !== except) {
            setConsentTooltipOpen(tooltip, false);
        }
    });
};

const initConsentTooltips = (root = document) => {
    const tooltips = root.matches?.('[data-consent-tooltip]')
        ? [root]
        : Array.from(root.querySelectorAll('[data-consent-tooltip]'));

    tooltips.forEach((tooltip) => {
        if (tooltip.dataset.consentTooltipReady === 'true') {
            return;
        }

        tooltip.dataset.consentTooltipReady = 'true';

        const trigger = tooltip.querySelector('.consent-tooltip__trigger');

        if (!trigger) {
            return;
        }

        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            event.stopPropagation();

            const willOpen = !tooltip.classList.contains('is-open');
            closeAllConsentTooltips(tooltip);
            setConsentTooltipOpen(tooltip, willOpen);
        });

        trigger.addEventListener('keydown', (event) => {
            if (event.key !== 'Escape') {
                return;
            }

            setConsentTooltipOpen(tooltip, false);
        });

        tooltip.addEventListener('focusout', (event) => {
            if (!tooltip.contains(event.relatedTarget)) {
                setConsentTooltipOpen(tooltip, false);
            }
        });
    });

    if (document.documentElement.dataset.consentTooltipGlobalBound === 'true') {
        return;
    }

    document.documentElement.dataset.consentTooltipGlobalBound = 'true';

    document.addEventListener('click', (event) => {
        if (event.target.closest('[data-consent-tooltip]')) {
            return;
        }

        closeAllConsentTooltips();
    });

    document.addEventListener(
        'keydown',
        (event) => {
            if (event.key !== 'Escape') {
                return;
            }

            const openTooltip = document.querySelector('[data-consent-tooltip].is-open');

            if (!openTooltip) {
                return;
            }

            event.stopPropagation();
            closeAllConsentTooltips();
        },
        true,
    );
};

const initHomeHero = () => {
    const root = document.querySelector('[data-home-hero]');

    if (!root || root.dataset.homeHeroReady === 'true') {
        return;
    }

    const viewport = root.querySelector('.home-hero__viewport') || root;
    const slides = Array.from(root.querySelectorAll('[data-home-hero-slide]'));
    const dots = Array.from(root.querySelectorAll('[data-home-hero-dot]'));
    const prev = root.querySelector('[data-home-hero-prev]');
    const next = root.querySelector('[data-home-hero-next]');

    if (slides.length < 2) {
        return;
    }

    root.dataset.homeHeroReady = 'true';

    let index = slides.findIndex((slide) => slide.classList.contains('is-active'));
    index = index < 0 ? 0 : index;
    let timer = null;
    let allowPrefetch = false;
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const swipeThreshold = 48;
    let pointerId = null;
    let startX = 0;
    let startY = 0;
    let dragging = false;
    let lockedAxis = null;
    let suppressClick = false;

    const loadSlideImage = (slide) => {
        const image = slide?.querySelector('img[data-src]');

        if (!image || image.getAttribute('src')) {
            return;
        }

        if (image.dataset.srcset) {
            image.sizes = image.dataset.sizes || '100vw';
            image.srcset = image.dataset.srcset;
        }

        image.src = image.dataset.src;
    };

    const show = (nextIndex) => {
        index = (nextIndex + slides.length) % slides.length;
        loadSlideImage(slides[index]);

        if (allowPrefetch) {
            loadSlideImage(slides[(index + 1) % slides.length]);
        }

        slides.forEach((slide, slideIndex) => {
            const active = slideIndex === index;
            slide.classList.toggle('is-active', active);
            slide.setAttribute('aria-hidden', active ? 'false' : 'true');

            if (active) {
                slide.removeAttribute('inert');
            } else {
                slide.setAttribute('inert', '');
            }
        });

        dots.forEach((dot, dotIndex) => {
            const active = dotIndex === index;
            dot.classList.toggle('is-active', active);
            if (active) {
                dot.setAttribute('aria-current', 'true');
            } else {
                dot.removeAttribute('aria-current');
            }
        });
    };

    const stop = () => {
        if (timer) {
            window.clearInterval(timer);
            timer = null;
        }
    };

    const start = () => {
        if (reduceMotion) {
            return;
        }

        stop();
        timer = window.setInterval(() => show(index + 1), 7000);
    };

    const endDrag = () => {
        dragging = false;
        pointerId = null;
        lockedAxis = null;
        viewport.classList.remove('is-dragging');
    };

    prev?.addEventListener('click', () => {
        show(index - 1);
        start();
    });

    next?.addEventListener('click', () => {
        show(index + 1);
        start();
    });

    dots.forEach((dot, dotIndex) => {
        dot.addEventListener('click', () => {
            show(dotIndex);
            start();
        });
    });

    viewport.addEventListener('pointerdown', (event) => {
        if (event.button !== 0 && event.pointerType === 'mouse') {
            return;
        }

        if (event.target.closest('a, button, input, textarea, select, label')) {
            return;
        }

        pointerId = event.pointerId;
        startX = event.clientX;
        startY = event.clientY;
        dragging = true;
        lockedAxis = null;
        suppressClick = false;
        stop();
        viewport.classList.add('is-dragging');
        viewport.setPointerCapture?.(event.pointerId);
    });

    viewport.addEventListener(
        'pointermove',
        (event) => {
            if (!dragging || event.pointerId !== pointerId) {
                return;
            }

            const dx = event.clientX - startX;
            const dy = event.clientY - startY;

            if (!lockedAxis && (Math.abs(dx) > 8 || Math.abs(dy) > 8)) {
                lockedAxis = Math.abs(dx) > Math.abs(dy) ? 'x' : 'y';
            }

            if (lockedAxis === 'x') {
                event.preventDefault();
            }
        },
        { passive: false },
    );

    viewport.addEventListener('pointerup', (event) => {
        if (!dragging || event.pointerId !== pointerId) {
            return;
        }

        const dx = event.clientX - startX;

        if (lockedAxis === 'x' && Math.abs(dx) >= swipeThreshold) {
            show(dx < 0 ? index + 1 : index - 1);
            suppressClick = true;
        }

        endDrag();
        start();
    });

    viewport.addEventListener('pointercancel', () => {
        endDrag();
        start();
    });

    viewport.addEventListener(
        'click',
        (event) => {
            if (!suppressClick) {
                return;
            }

            event.preventDefault();
            event.stopPropagation();
            suppressClick = false;
        },
        true,
    );

    root.addEventListener('mouseenter', stop);
    root.addEventListener('mouseleave', start);
    root.addEventListener('focusin', stop);
    root.addEventListener('focusout', (event) => {
        if (!root.contains(event.relatedTarget)) {
            start();
        }
    });

    show(index);
    allowPrefetch = true;
    start();

    const prefetchUpcoming = () => {
        loadSlideImage(slides[(index + 1) % slides.length]);
    };

    if ('requestIdleCallback' in window) {
        window.requestIdleCallback(prefetchUpcoming, { timeout: 4000 });
    } else {
        window.addEventListener('load', () => window.setTimeout(prefetchUpcoming, 1200), { once: true });
    }
};

const initHomeTestimonials = () => {
    document.querySelectorAll('[data-home-testimonials]').forEach((root) => {
        if (root.dataset.homeTestimonialsReady === 'true') {
            return;
        }

        const viewport = root.querySelector('[data-home-testimonials-viewport]');
        const track = root.querySelector('[data-home-testimonials-track]');
        const cards = track ? Array.from(track.querySelectorAll('[data-home-testimonial-card]')) : [];
        const prev = root.querySelector('[data-home-testimonials-prev]');
        const next = root.querySelector('[data-home-testimonials-next]');
        const dotsHost = root.querySelector('[data-home-testimonials-dots]');

        if (!viewport || !track || cards.length < 1) {
            return;
        }

        root.dataset.homeTestimonialsReady = 'true';

        let page = 0;
        let perPage = 2;
        let pageCount = 1;
        let gap = 16;
        let touchStartX = null;

        const getPerPage = () => (window.matchMedia('(max-width: 720px)').matches ? 1 : 2);

        const getGap = () => {
            const styles = window.getComputedStyle(track);
            const raw = Number.parseFloat(styles.columnGap || styles.gap || '16');

            return Number.isFinite(raw) ? raw : 16;
        };

        const maxPage = () => Math.max(0, pageCount - 1);

        const syncDots = () => {
            if (!dotsHost) {
                return;
            }

            const existing = Array.from(dotsHost.querySelectorAll('[data-home-testimonials-dot]'));

            if (existing.length !== pageCount) {
                dotsHost.replaceChildren(
                    ...Array.from({ length: pageCount }, (_, index) => {
                        const button = document.createElement('button');
                        button.type = 'button';
                        button.setAttribute('data-home-testimonials-dot', '');
                        button.setAttribute('aria-label', `Show testimonials page ${index + 1}`);
                        button.addEventListener('click', () => {
                            page = Math.min(index, maxPage());
                            render();
                        });
                        return button;
                    }),
                );
            }

            Array.from(dotsHost.querySelectorAll('[data-home-testimonials-dot]')).forEach((dot, index) => {
                const active = index === page;
                dot.classList.toggle('is-active', active);

                if (active) {
                    dot.setAttribute('aria-current', 'true');
                } else {
                    dot.removeAttribute('aria-current');
                }
            });
        };

        const render = () => {
            const nextPerPage = getPerPage();
            const viewportWidth = viewport.clientWidth;

            if (nextPerPage !== perPage) {
                const firstVisible = page * perPage;
                perPage = nextPerPage;
                page = Math.floor(firstVisible / perPage);
            }

            gap = getGap();
            pageCount = Math.max(1, Math.ceil(cards.length / perPage));
            page = Math.min(page, maxPage());

            const cardWidth =
                perPage === 1 ? viewportWidth : Math.max(0, (viewportWidth - gap * (perPage - 1)) / perPage);

            cards.forEach((card, index) => {
                card.style.flex = `0 0 ${cardWidth}px`;
                card.style.width = `${cardWidth}px`;
                card.style.maxWidth = `${cardWidth}px`;

                const pageIndex = Math.floor(index / perPage);
                const visible = pageIndex === page;
                card.setAttribute('aria-hidden', visible ? 'false' : 'true');

                if (visible) {
                    card.removeAttribute('inert');
                } else {
                    card.setAttribute('inert', '');
                }
            });

            // Include the trailing gap between page groups so pages stay aligned.
            track.style.transform = `translateX(-${page * (viewportWidth + gap)}px)`;

            const visibleStart = page * perPage;
            const visibleCards = cards.slice(visibleStart, visibleStart + perPage);
            const visibleHeight = Math.max(0, ...visibleCards.map((card) => card.offsetHeight));

            if (visibleHeight > 0) {
                viewport.style.height = `${visibleHeight}px`;
            } else {
                viewport.style.removeProperty('height');
            }

            syncDots();
        };

        prev?.addEventListener('click', () => {
            page = page <= 0 ? maxPage() : page - 1;
            render();
        });

        next?.addEventListener('click', () => {
            page = page >= maxPage() ? 0 : page + 1;
            render();
        });

        viewport.addEventListener(
            'touchstart',
            (event) => {
                touchStartX = event.changedTouches?.[0]?.clientX ?? null;
            },
            { passive: true },
        );

        viewport.addEventListener(
            'touchend',
            (event) => {
                if (touchStartX === null) {
                    return;
                }

                const touchEndX = event.changedTouches?.[0]?.clientX ?? touchStartX;
                const delta = touchEndX - touchStartX;
                touchStartX = null;

                if (Math.abs(delta) < 40) {
                    return;
                }

                if (delta < 0) {
                    page = page >= maxPage() ? 0 : page + 1;
                } else {
                    page = page <= 0 ? maxPage() : page - 1;
                }

                render();
            },
            { passive: true },
        );

        let resizeFrame = 0;
        window.addEventListener('resize', () => {
            window.cancelAnimationFrame(resizeFrame);
            resizeFrame = window.requestAnimationFrame(render);
        });

        render();
    });
};

const initAdminToolbar = () => {
    const root = document.querySelector('#admin-toolbar');

    if (!root || root.dataset.toolbarReady === 'true') {
        return;
    }

    root.dataset.toolbarReady = 'true';

    const menus = [...root.querySelectorAll('[data-admin-toolbar-menu]')];

    const closeMenus = () => {
        menus.forEach((menu) => {
            const button = menu.querySelector('[aria-expanded]');
            const panel = menu.querySelector('[data-admin-toolbar-panel]');

            button?.setAttribute('aria-expanded', 'false');

            if (panel) {
                panel.hidden = true;
            }
        });
    };

    const canHover = () => window.matchMedia('(hover: hover) and (pointer: fine)').matches;

    const openMenu = (menu) => {
        const button = menu.querySelector('[aria-expanded]');
        const panel = menu.querySelector('[data-admin-toolbar-panel]');

        closeMenus();

        if (!button || !panel) {
            return;
        }

        button.setAttribute('aria-expanded', 'true');
        panel.hidden = false;
    };

    menus.forEach((menu) => {
        const button = menu.querySelector('[aria-expanded]');
        const panel = menu.querySelector('[data-admin-toolbar-panel]');
        let openedByPointer = false;

        menu.addEventListener('pointerenter', () => {
            if (!canHover()) {
                return;
            }

            openedByPointer = true;
            openMenu(menu);
        });

        menu.addEventListener('pointerleave', () => {
            if (!canHover()) {
                return;
            }

            openedByPointer = false;

            if (menu.contains(document.activeElement) && document.activeElement !== button) {
                return;
            }

            button?.setAttribute('aria-expanded', 'false');

            if (panel) {
                panel.hidden = true;
            }
        });

        button?.addEventListener('click', () => {
            if (openedByPointer) {
                openedByPointer = false;

                return;
            }

            const open = button.getAttribute('aria-expanded') === 'true';

            closeMenus();

            if (!open && panel) {
                button.setAttribute('aria-expanded', 'true');
                panel.hidden = false;
            }
        });
    });

    document.addEventListener('click', (event) => {
        if (root.contains(event.target)) {
            return;
        }

        closeMenus();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeMenus();
        }
    });
};

const initApp = () => {
    initAdminToolbar();
    initSiteNavbar();
    initContactModalTriggers();
    initBlogContactModalAutoOpen();
    initConsentTooltips();
    schedulePhoneInputs();
    initArticleToc();
    initHomeHero();
    initHomeTestimonials();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initApp, { once: true });
} else {
    initApp();
}

document.addEventListener('livewire:init', () => {
    window.Livewire?.hook('morph.updated', ({ el }) => {
        schedulePhoneInputs(el);
        initArticleToc(el);
        initContactModalTriggers();
        initConsentTooltips(el);
    });

    window.Livewire?.on('form-success-revealed', () => {
        window.requestAnimationFrame(() => {
            const modalSuccess = document.querySelector('.contact-modal__body [data-form-success]');
            const pageSuccess = document.querySelector('[data-form-success]');
            const success = modalSuccess || pageSuccess;
            const scope = success?.closest('form') || success?.closest('[wire\\:id]') || document;

            clearPhoneInputs(scope);

            if (success) {
                window.revealFormSuccess(success);
            }
        });
    });
});

document.addEventListener('livewire:navigated', () => {
    clearBlogContactModalAutoTimer();
    initAdminToolbar();
    initSiteNavbar();
    initContactModalTriggers();
    initBlogContactModalAutoOpen();
    initConsentTooltips();
    schedulePhoneInputs();
    initArticleToc();
    initHomeHero();
    initHomeTestimonials();
});
