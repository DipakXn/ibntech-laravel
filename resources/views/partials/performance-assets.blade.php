<link rel="stylesheet" href="{{ asset('vendor/font-awesome/6.5.2/all.min.css') }}" media="print" fetchpriority="low" onload="this.media='all'">
<noscript>
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/6.5.2/all.min.css') }}">
</noscript>
<script>
    (function () {
        var loaded = false;

        function pageCanUseRecaptcha() {
            return document.querySelector('.contact-form__recaptcha, [id^="recaptcha-"], .g-recaptcha, [data-contact-modal-trigger]');
        }

        function loadRecaptcha() {
            if (loaded || !pageCanUseRecaptcha()) {
                return;
            }

            loaded = true;
            var script = document.createElement('script');
            script.src = 'https://www.google.com/recaptcha/api.js?render=explicit';
            script.async = true;
            document.head.appendChild(script);
        }

        function scheduleRecaptcha() {
            if (document.querySelector('.contact-form__recaptcha, [id^="recaptcha-"], .g-recaptcha')) {
                if ('requestIdleCallback' in window) {
                    window.requestIdleCallback(loadRecaptcha, { timeout: 2500 });
                } else {
                    window.setTimeout(loadRecaptcha, 2000);
                }

                return;
            }

            document.addEventListener('pointerdown', function (event) {
                if (event.target.closest('[data-contact-modal-trigger], .contact-form__recaptcha')) {
                    loadRecaptcha();
                }
            }, { passive: true });
            window.addEventListener('open-contact-modal', loadRecaptcha);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', scheduleRecaptcha, { once: true });
        } else {
            scheduleRecaptcha();
        }
    })();
</script>
