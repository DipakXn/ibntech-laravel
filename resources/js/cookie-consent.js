const rootConfig = () => {
    const node = document.getElementById('ibn-cookie-consent-config');

    if (!node) {
        return null;
    }

    try {
        const config = JSON.parse(node.textContent || '');

        if (!config || config.mode !== 'opt_in') {
            if (config) {
                config.mode = 'opt_in';
            }
        }

        return config;
    } catch {
        return null;
    }
};

const readCookie = (name) => {
    const prefix = `${name}=`;

    return document.cookie.split('; ').reduce((found, part) => {
        if (found || !part.startsWith(prefix)) {
            return found;
        }

        return decodeURIComponent(part.slice(prefix.length));
    }, null);
};

const writeCookie = (name, value, days) => {
    const secure = window.location.protocol === 'https:' ? '; Secure' : '';
    const maxAge = Math.max(1, Number(days) || 365) * 86400;

    document.cookie = `${name}=${encodeURIComponent(value)}; Path=/; Max-Age=${maxAge}; SameSite=Lax${secure}`;
};

const expireCookie = (name) => {
    document.cookie = `${name}=; Path=/; Max-Age=0; SameSite=Lax`;
};

const categoryFlags = (config, source) => {
    const flags = {
        necessary: true,
        analytics: false,
        marketing: false,
        functional: false,
    };

    (config.categories || []).forEach((category) => {
        if (!category.enabled || category.key === 'necessary') {
            return;
        }

        flags[category.key] = source === true || source?.[category.key] === true;
    });

    return flags;
};

const parseState = (config) => {
    const raw = readCookie(config.cookieName);

    if (!raw || raw.length > 600) {
        return null;
    }

    let data;

    try {
        data = JSON.parse(raw);
    } catch {
        return null;
    }

    const now = Math.floor(Date.now() / 1000);

    if (!data || data.v !== config.policyVersion || data.cv !== config.configVersion) {
        return null;
    }

    if (typeof data.ts !== 'number' || data.ts > now + 300 || now - data.ts > config.lifetimeDays * 86400) {
        return null;
    }

    if (data.necessary !== true || !['accept_all', 'reject_all', 'custom'].includes(data.action)) {
        return null;
    }

    if (['analytics', 'marketing', 'functional'].some((key) => typeof data[key] !== 'boolean')) {
        return null;
    }

    return data;
};

const statePayload = (config, flags, action) => JSON.stringify({
    v: config.policyVersion,
    cv: config.configVersion,
    ts: Math.floor(Date.now() / 1000),
    necessary: true,
    analytics: flags.analytics === true,
    marketing: flags.marketing === true,
    functional: flags.functional === true,
    action,
});

const ensureGtag = (id) => {
    window.dataLayer = window.dataLayer || [];
    window.gtag = window.gtag || function gtag() { window.dataLayer.push(arguments); };

    if (document.getElementById('ibn-gtag')) {
        return;
    }

    const script = document.createElement('script');
    script.id = 'ibn-gtag';
    script.async = true;
    script.src = `https://www.googletagmanager.com/gtag/js?id=${encodeURIComponent(id)}`;
    document.head.appendChild(script);
};

const updateGoogleConsent = (flags) => {
    window.dataLayer = window.dataLayer || [];
    window.gtag = window.gtag || function gtag() { window.dataLayer.push(arguments); };
    const granted = (allowed) => (allowed ? 'granted' : 'denied');

    window.gtag('consent', 'update', {
        analytics_storage: granted(flags.analytics),
        ad_storage: granted(flags.marketing),
        ad_user_data: granted(flags.marketing),
        ad_personalization: granted(flags.marketing),
        functionality_storage: granted(flags.functional),
        personalization_storage: granted(flags.functional),
        security_storage: 'granted',
    });

    window.dataLayer.push({
        event: 'ibn_consent',
        ibn_consent_analytics: granted(flags.analytics),
        ibn_consent_marketing: granted(flags.marketing),
        ibn_consent_functional: granted(flags.functional),
    });
};

const integrationAllowed = (integration, flags) => (integration.categories || []).some((key) => flags[key] === true);

const loadIntegration = (integration, flags) => {
    if (!integrationAllowed(integration, flags) || window.__ibnLoaded?.[integration.key]) {
        return;
    }

    window.__ibnLoaded = window.__ibnLoaded || {};

    if (integration.key === 'ga4' && integration.id) {
        window.__ibnLoaded.ga4 = true;
        ensureGtag(integration.id);
        window.gtag('js', new Date());
        window.gtag('config', integration.id);
        return;
    }

    if (integration.key === 'google_ads' && integration.id) {
        window.__ibnLoaded.google_ads = true;
        ensureGtag(integration.id);
        window.gtag('config', integration.id);
        return;
    }

    if (integration.key === 'linkedin' && integration.id) {
        window.__ibnLoaded.linkedin = true;
        window._linkedin_partner_id = integration.id;
        window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
        window._linkedin_data_partner_ids.push(integration.id);
        const script = document.createElement('script');
        script.id = 'ibn-linkedin';
        script.async = true;
        script.src = 'https://snap.licdn.com/li.lms-analytics/insight.min.js';
        document.head.appendChild(script);
        return;
    }

    if (integration.key === 'gtm' && integration.id) {
        window.__ibnLoaded.gtm = true;
        window.dataLayer.push({ 'gtm.start': Date.now(), event: 'gtm.js' });
        const script = document.createElement('script');
        script.id = 'ibn-gtm';
        script.async = true;
        script.src = `https://www.googletagmanager.com/gtm.js?id=${encodeURIComponent(integration.id)}`;
        document.head.appendChild(script);
        return;
    }

    if (integration.key === 'media_embeds') {
        window.__ibnLoaded.media_embeds = true;
        document.querySelectorAll('[data-cookie-embed]').forEach((frame) => {
            if (frame.dataset.cookieEmbedLoaded === 'true' || !frame.dataset.cookieEmbed) {
                return;
            }

            const iframe = document.createElement('iframe');
            iframe.src = frame.dataset.cookieEmbed;
            iframe.title = frame.dataset.cookieEmbedTitle || 'Embedded media';
            iframe.loading = 'lazy';
            iframe.referrerPolicy = 'strict-origin-when-cross-origin';
            iframe.setAttribute('allowfullscreen', '');
            frame.replaceChildren(iframe);
            frame.dataset.cookieEmbedLoaded = 'true';
        });
    }
};

const applyConsent = (config, flags) => {
    updateGoogleConsent(flags);
    (config.integrations || []).forEach((integration) => loadIntegration(integration, flags));
};

const expireKnownCookies = () => {
    ['_ga', '_gid', '_gat', '_gcl_au'].forEach((name) => {
        expireCookie(name);
        document.cookie.split('; ').forEach((part) => {
            const cookieName = part.split('=')[0];

            if (cookieName.startsWith('_ga_')) {
                expireCookie(cookieName);
            }
        });
    });
};

const postMetric = (config, action) => {
    if (!config.metricsUrl) {
        return;
    }

    const body = new URLSearchParams({ action });

    if (navigator.sendBeacon) {
        navigator.sendBeacon(config.metricsUrl, body);
        return;
    }

    fetch(config.metricsUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body,
        keepalive: true,
    }).catch(() => {});
};

const initCookieConsent = () => {
    const config = rootConfig();
    const banner = document.getElementById('ibn-cookie-banner');
    const dialog = document.getElementById('ibn-cookie-dialog');

    if (!config || !banner || !dialog || window.__ibnConsentReady) {
        return;
    }

    window.__ibnConsentReady = true;
    const panel = dialog.querySelector('.cookie-dialog__panel');
    let current = parseState(config);
    let lastFocused = null;

    const showBanner = () => {
        if (config.banner?.enabled) {
            banner.hidden = false;
        }
    };

    const hideBanner = () => {
        banner.hidden = true;
    };

    const syncDialog = (flags) => {
        dialog.querySelectorAll('[data-cookie-category]').forEach((input) => {
            if (input.disabled) {
                input.checked = true;
                return;
            }

            input.checked = flags[input.dataset.cookieCategory] === true;
        });
    };

    const flagsFromDialog = () => {
        const flags = categoryFlags(config, false);

        dialog.querySelectorAll('[data-cookie-category]').forEach((input) => {
            if (!input.disabled && Object.prototype.hasOwnProperty.call(flags, input.dataset.cookieCategory)) {
                flags[input.dataset.cookieCategory] = input.checked;
            }
        });

        return flags;
    };

    const closeDialog = () => {
        dialog.hidden = true;
        document.documentElement.classList.remove('cookie-dialog-open');

        if (lastFocused && typeof lastFocused.focus === 'function') {
            lastFocused.focus();
        }
    };

    const openDialog = () => {
        lastFocused = document.activeElement;
        syncDialog(current ? categoryFlags(config, current) : categoryFlags(config, false));
        dialog.hidden = false;
        document.documentElement.classList.add('cookie-dialog-open');
        panel?.focus();
    };

    const save = (flags, action) => {
        const previous = current;
        const withdrawn = previous && ['analytics', 'marketing', 'functional'].some((key) => previous[key] === true && flags[key] !== true);

        writeCookie(config.cookieName, statePayload(config, flags, action), config.lifetimeDays);
        current = parseState(config);
        hideBanner();
        closeDialog();
        postMetric(config, withdrawn ? 'withdrawal' : action);

        if (withdrawn) {
            expireKnownCookies();
            window.location.reload();
            return;
        }

        applyConsent(config, flags);
    };

    banner.addEventListener('click', (event) => {
        const action = event.target.closest('[data-cookie-action]')?.dataset.cookieAction;

        if (action === 'accept') {
            save(categoryFlags(config, true), 'accept_all');
        }

        if (action === 'reject') {
            save(categoryFlags(config, false), 'reject_all');
        }

        if (action === 'settings') {
            openDialog();
        }
    });

    dialog.addEventListener('click', (event) => {
        if (event.target.closest('[data-cookie-dialog-dismiss]')) {
            closeDialog();
            return;
        }

        const action = event.target.closest('[data-cookie-action]')?.dataset.cookieAction;

        if (action === 'accept') {
            save(categoryFlags(config, true), 'accept_all');
        }

        if (action === 'reject') {
            save(categoryFlags(config, false), 'reject_all');
        }

        if (action === 'save') {
            const flags = flagsFromDialog();
            const optional = ['analytics', 'marketing', 'functional'].filter((key) => (config.categories || []).some((category) => category.key === key && category.enabled));
            const enabledCount = optional.filter((key) => flags[key]).length;
            const actionName = enabledCount === 0 ? 'reject_all' : (enabledCount === optional.length ? 'accept_all' : 'custom');
            save(flags, actionName);
        }
    });

    document.addEventListener('click', (event) => {
        if (event.target.closest('[data-cookie-settings]')) {
            event.preventDefault();
            openDialog();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !dialog.hidden) {
            closeDialog();
        }
    });

    if (current) {
        applyConsent(config, categoryFlags(config, current));
    } else {
        showBanner();
    }
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCookieConsent, { once: true });
} else {
    initCookieConsent();
}
