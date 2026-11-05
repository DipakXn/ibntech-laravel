@php
    use App\Support\Media\FeaturedImageDimensionResolver;

    $image = $model?->contentBlockMedia($data['block_id'] ?? '')->first();
    $src = $image?->getUrl()
        ?: (filled($data['url'] ?? null) && \App\Support\Html\HtmlToBlocks::isSafeContentUrl((string) $data['url'])
            ? $data['url']
            : null);

    $dimensionResolver = app(FeaturedImageDimensionResolver::class);
    $dimensions = $image
        ? $dimensionResolver->fromMedia($image)
        : ($src ? $dimensionResolver->fromPublicPath(parse_url($src, PHP_URL_PATH) ?: $src) : null);
@endphp

@if ($src)
    <figure class="content-block content-block--image">
        <img
            src="{{ $src }}"
            alt="{{ filled($data['alt'] ?? null) ? $data['alt'] : trim((string) ($image?->getCustomProperty('alt') ?? '')) }}"
            @if ($dimensions)
                width="{{ $dimensions['width'] }}"
                height="{{ $dimensions['height'] }}"
            @endif
            loading="lazy"
        >

        @if (filled($data['caption'] ?? null))
            <figcaption>{{ $data['caption'] }}</figcaption>
        @endif
    </figure>
@endif
