@php
    $image = $model?->contentBlockMedia($data['block_id'] ?? '')->first();
    $src = $image?->getUrl()
        ?: (filled($data['url'] ?? null) && \App\Support\Html\HtmlToBlocks::isSafeContentUrl((string) $data['url'])
            ? $data['url']
            : null);
@endphp

@if ($src)
    <figure class="content-block content-block--image">
        <img
            src="{{ $src }}"
            alt="{{ $data['alt'] ?? $image?->getAttribute('name') }}"
            loading="lazy"
        >

        @if (filled($data['caption'] ?? null))
            <figcaption>{{ $data['caption'] }}</figcaption>
        @endif
    </figure>
@endif
