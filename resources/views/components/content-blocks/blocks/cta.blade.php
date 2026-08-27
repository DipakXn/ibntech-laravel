@php
    $heading = trim((string) ($data['heading'] ?? ''));
    $description = trim((string) ($data['description'] ?? ''));
    $buttonLabel = trim((string) ($data['button_label'] ?? ''));
    $buttonUrl = trim((string) ($data['button_url'] ?? ''));
    $buttonTarget = ($data['button_target'] ?? '_self') === '_blank' ? '_blank' : '_self';
    $theme = \App\Support\ContentCta::theme($data['theme'] ?? null);
    $iconClass = \App\Support\ContentCta::iconClass($data['icon'] ?? null);
    $hasButton = $buttonLabel !== '' && $buttonUrl !== '';
    $headingId = $heading !== '' ? 'content-cta-'.md5($heading.'|'.$buttonUrl) : null;
@endphp

@if ($heading !== '' || $description !== '' || $hasButton)
    <section
        class="content-block content-block--cta content-block--cta-{{ $theme }}{{ $iconClass ? '' : ' is-iconless' }}"
        @if ($headingId) aria-labelledby="{{ $headingId }}" @endif
    >
        @if ($iconClass)
            <span class="content-cta__icon" aria-hidden="true">
                <i class="{{ $iconClass }}"></i>
            </span>
        @endif

        <div class="content-cta__body">
            @if ($heading !== '')
                <h2 @if ($headingId) id="{{ $headingId }}" @endif class="content-cta__heading">{{ $heading }}</h2>
            @endif

            @if ($description !== '')
                <p class="content-cta__description">{{ $description }}</p>
            @endif

            @if ($hasButton)
                <a
                    href="{{ $buttonUrl }}"
                    class="content-cta__button"
                    target="{{ $buttonTarget }}"
                    @if ($buttonTarget === '_blank') rel="noopener noreferrer" @endif
                >
                    {{ $buttonLabel }}
                </a>
            @endif
        </div>
    </section>
@endif
