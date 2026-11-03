@php
    $consent = $cookieConsent ?? app(\App\Services\CookieConsent\CookieConsentRepository::class)->payload();
    $banner = $consent['banner'];
    $categories = $consent['categories'] ?? [];
@endphp

<section id="ibn-cookie-banner" class="cookie-banner" hidden aria-labelledby="ibn-cookie-banner-title">
    <div class="cookie-banner__inner">
        <p id="ibn-cookie-banner-title" class="cookie-banner__message">{{ $banner['text'] }}</p>
        <div class="cookie-banner__actions">
            <button type="button" class="cookie-banner__button cookie-banner__button--secondary" data-cookie-action="settings">{{ $banner['settingsLabel'] }}</button>
            <button type="button" class="cookie-banner__button cookie-banner__button--secondary" data-cookie-action="reject">{{ $banner['rejectLabel'] }}</button>
            <button type="button" class="cookie-banner__button cookie-banner__button--primary" data-cookie-action="accept">{{ $banner['acceptLabel'] }}</button>
        </div>
    </div>
</section>

<div id="ibn-cookie-dialog" class="cookie-dialog" hidden>
    <div class="cookie-dialog__backdrop" data-cookie-dialog-dismiss></div>
    <div
        class="cookie-dialog__panel"
        role="dialog"
        aria-modal="true"
        aria-labelledby="ibn-cookie-dialog-title"
        tabindex="-1"
    >
        <h2 id="ibn-cookie-dialog-title">{{ $banner['modalTitle'] }}</h2>
        <p>{{ $banner['modalText'] }}</p>

        <div class="cookie-dialog__categories">
            @foreach ($categories as $category)
                @continue(! $category['enabled'] && $category['key'] !== 'necessary')
                <article class="cookie-category">
                    <div class="cookie-category__row">
                        <h3>{{ $category['name'] }}</h3>
                        <label class="cookie-switch">
                            <input
                                type="checkbox"
                                data-cookie-category="{{ $category['key'] }}"
                                @checked($category['required'])
                                @disabled($category['required'])
                            >
                            <span class="cookie-switch__track" aria-hidden="true"></span>
                            <span class="sr-only">
                                {{ $category['required'] ? $category['name'].' always on' : 'Allow '.$category['name'] }}
                            </span>
                        </label>
                    </div>
                    <p>{{ $category['description'] }}</p>
                    @if (! empty($category['details']))
                        <details>
                            <summary>Details</summary>
                            <p>{{ $category['details'] }}</p>
                        </details>
                    @endif
                </article>
            @endforeach
        </div>

        <p class="cookie-banner__links">
            <a href="{{ $banner['cookieUrl'] }}">Cookie Policy</a>
            <a href="{{ $banner['privacyUrl'] }}">Privacy Policy</a>
        </p>

        <div class="cookie-banner__actions">
            <button type="button" class="cookie-banner__button cookie-banner__button--primary" data-cookie-action="save">{{ $banner['saveLabel'] }}</button>
            <button type="button" class="cookie-banner__button cookie-banner__button--secondary" data-cookie-action="accept">{{ $banner['acceptLabel'] }}</button>
            <button type="button" class="cookie-banner__button cookie-banner__button--text" data-cookie-action="reject">{{ $banner['rejectLabel'] }}</button>
        </div>
    </div>
</div>

<noscript>
    <p class="cookie-banner cookie-banner--static">Optional cookies stay off because JavaScript is unavailable. <a href="{{ $banner['cookieUrl'] }}">Cookie Policy</a></p>
</noscript>

<script type="application/json" id="ibn-cookie-consent-config">{!! json_encode($consent, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) !!}</script>
