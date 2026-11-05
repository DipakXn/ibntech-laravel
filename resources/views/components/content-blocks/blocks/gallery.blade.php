@php
    use App\Support\Media\FeaturedImageDimensionResolver;

    $images = $model?->contentBlockMedia($data['block_id'] ?? '') ?? collect();
    $dimensionResolver = app(FeaturedImageDimensionResolver::class);
@endphp

@if ($images->isNotEmpty())
    <section class="content-block content-block--gallery">
        @if (filled($data['title'] ?? null))
            <h3>{{ $data['title'] }}</h3>
        @endif

        <div class="content-gallery">
            @foreach ($images as $image)
                @php
                    $galleryAlt = trim((string) ($image->getCustomProperty('alt') ?? ''));
                    $galleryDimensions = $dimensionResolver->fromMedia($image);
                @endphp
                <figure>
                    <img
                        src="{{ $image->getUrl() }}"
                        alt="{{ $galleryAlt !== '' ? $galleryAlt : '' }}"
                        @if ($galleryDimensions)
                            width="{{ $galleryDimensions['width'] }}"
                            height="{{ $galleryDimensions['height'] }}"
                        @endif
                        loading="lazy"
                    >
                </figure>
            @endforeach
        </div>

        @if (filled($data['caption'] ?? null))
            <p class="content-gallery__caption">{{ $data['caption'] }}</p>
        @endif
    </section>
@endif

