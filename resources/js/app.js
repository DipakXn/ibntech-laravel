import './bootstrap';
import intlTelInput from 'intl-tel-input';

const initReferenceNavbar = () => {
    const navbarRoot = document.querySelector('.site-reference-navbar');

    if (!navbarRoot) {
        return;
    }

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
            initialCountry: 'us',
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

const initApp = () => {
    initReferenceNavbar();
    initPhoneInputs();
    initArticleToc();
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
    });
});

document.addEventListener('livewire:navigated', () => {
    initPhoneInputs();
    initArticleToc();
});
