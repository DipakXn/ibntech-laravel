import './bootstrap';
import intlTelInput from 'intl-tel-input';

const initSiteNavbar = () => {
    const navbarRoot = document.querySelector('.site-ibn-navbar');

    if (!navbarRoot || navbarRoot.dataset.navbarReady === 'true') {
        return;
    }

    navbarRoot.dataset.navbarReady = 'true';

    const navbarToggler = navbarRoot.querySelector('#navbarToggler');
    const navbarNav = navbarRoot.querySelector('#navbarNav');
    const dropdowns = navbarRoot.querySelectorAll('.has-megamenu');
    const navMenuIcon = navbarToggler?.querySelector('.nav-menu-icon');

    if (!navbarToggler || !navbarNav || !dropdowns.length) {
        return;
    }

    const isDesktop = () => window.innerWidth >= 992;

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
            const targetId = heading.getAttribute('data-target');
            const submenu = menuContent.querySelector(`#${targetId}`);

            if (!submenu) {
                return;
            }

            const clone = submenu.cloneNode(true);
            clone.classList.remove('active');
            heading.insertAdjacentElement('afterend', clone);
        });

        menuContent.style.display = 'none';
    };

    const resetDesktopState = () => {
        navbarNav.classList.remove('active');
        navMenuIcon?.classList.remove('fa-times');
        navMenuIcon?.classList.add('fa-bars');

        dropdowns.forEach((dropdown) => {
            dropdown.classList.remove('active');

            const tabbedMenu = dropdown.querySelector('.deskmeg-menu');

            if (!tabbedMenu) {
                return;
            }

            const headings = tabbedMenu.querySelectorAll('.menu-category-heading');
            const submenus = dropdown.querySelectorAll('.menu-content > .submenu');

            headings.forEach((heading) => heading.classList.remove('active'));
            submenus.forEach((submenu) => submenu.classList.remove('active'));

            headings[0]?.classList.add('active');
            submenus[0]?.classList.add('active');
        });
    };

    injectMobileSubmenus();

    navbarToggler.addEventListener('click', () => {
        navbarNav.classList.toggle('active');

        if (navbarNav.classList.contains('active')) {
            navMenuIcon?.classList.remove('fa-bars');
            navMenuIcon?.classList.add('fa-times');
            return;
        }

        navMenuIcon?.classList.remove('fa-times');
        navMenuIcon?.classList.add('fa-bars');
    });

    dropdowns.forEach((dropdown) => {
        const toggleLink = dropdown.querySelector('.dropdown-toggle');

        if (!toggleLink) {
            return;
        }

        toggleLink.addEventListener('click', (event) => {
            if (isDesktop()) {
                return;
            }

            event.preventDefault();

            const wasActive = dropdown.classList.contains('active');
            dropdowns.forEach((item) => item.classList.remove('active'));

            if (!wasActive) {
                dropdown.classList.add('active');
            }
        });

        const tabbedMenu = dropdown.querySelector('.deskmeg-menu');

        if (!tabbedMenu) {
            return;
        }

        const categories = tabbedMenu.querySelectorAll('.menu-category-heading');
        const getDesktopSubmenus = () => Array.from(dropdown.querySelectorAll('.menu-content > .submenu'));

        categories.forEach((category) => {
            category.addEventListener('mouseenter', () => {
                if (!isDesktop()) {
                    return;
                }

                categories.forEach((item) => item.classList.remove('active'));
                getDesktopSubmenus().forEach((submenu) => submenu.classList.remove('active'));

                category.classList.add('active');

                const targetId = category.getAttribute('data-target');
                const targetSubmenu = dropdown.querySelector(`#${targetId}`);
                targetSubmenu?.classList.add('active');
            });

            category.addEventListener('click', (event) => {
                if (isDesktop()) {
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

                    if (item.nextElementSibling?.classList.contains('submenu')) {
                        item.nextElementSibling.classList.remove('active');
                    }
                });

                if (!injectedSubmenu) {
                    return;
                }

                category.classList.toggle('active', !wasActive);
                injectedSubmenu.classList.toggle('active', !wasActive);
            });
        });
    });

    window.addEventListener('resize', () => {
        injectMobileSubmenus();

        if (isDesktop()) {
            resetDesktopState();
        }
    });
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
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const swipeThreshold = 48;
    let pointerId = null;
    let startX = 0;
    let startY = 0;
    let dragging = false;
    let lockedAxis = null;
    let suppressClick = false;

    const show = (nextIndex) => {
        index = (nextIndex + slides.length) % slides.length;

        slides.forEach((slide, slideIndex) => {
            const active = slideIndex === index;
            slide.classList.toggle('is-active', active);
            slide.setAttribute('aria-hidden', active ? 'false' : 'true');
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
    start();
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
                dot.classList.toggle('is-active', index === page);
                dot.setAttribute('aria-selected', index === page ? 'true' : 'false');
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
                card.setAttribute('aria-hidden', pageIndex === page ? 'false' : 'true');
            });

            // Include the trailing gap between page groups so pages stay aligned.
            track.style.transform = `translateX(-${page * (viewportWidth + gap)}px)`;
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

const initApp = () => {
    initSiteNavbar();
    initContactModalTriggers();
    initConsentTooltips();
    initPhoneInputs();
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
        initPhoneInputs(el);
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
    initSiteNavbar();
    initContactModalTriggers();
    initConsentTooltips();
    initPhoneInputs();
    initArticleToc();
    initHomeHero();
    initHomeTestimonials();
});
