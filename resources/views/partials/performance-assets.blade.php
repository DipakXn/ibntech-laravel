<link rel="stylesheet" href="{{ asset('vendor/font-awesome/6.5.2/all.min.css') }}" media="print" fetchpriority="low" onload="this.media='all'">
<noscript>
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/6.5.2/all.min.css') }}">
</noscript>
<script>
    (function () {
        var loaded = false;

        function loadRecaptcha() {
            if (loaded) {
                return;
            }

            loaded = true;
            var script = document.createElement('script');
            script.src = 'https://www.google.com/recaptcha/api.js?render=explicit';
            script.async = true;
            document.head.appendChild(script);
        }

        window.addEventListener('load', function () {
            if ('requestIdleCallback' in window) {
                window.requestIdleCallback(loadRecaptcha, { timeout: 2500 });
            } else {
                window.setTimeout(loadRecaptcha, 2000);
            }
        });

        ['pointerdown', 'keydown', 'touchstart'].forEach(function (eventName) {
            window.addEventListener(eventName, loadRecaptcha, { once: true, passive: true });
        });
    })();
</script>
