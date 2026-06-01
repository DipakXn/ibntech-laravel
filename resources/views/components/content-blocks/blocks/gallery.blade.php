@php($images = $model?->contentBlockMedia($data['block_id'] ?? '') ?? collect())

@if ($images->isNotEmpty())
    <section class="content-block content-block--gallery">
        @if (filled($data['title'] ?? null))
            <h3>{{ $data['title'] }}</h3>
        @endif

        <div class="content-gallery">
            @foreach ($images as $image)
                <figure>
                    <img src="{{ $image->getUrl() }}" alt="{{ $image->getAttribute('name') }}" loading="lazy">
                </figure>
            @endforeach
        </div>

        @if (filled($data['caption'] ?? null))
            <p class="content-gallery__caption">{{ $data['caption'] }}</p>
        @endif
    </section>
@endif

