@php($image = $model?->contentBlockMedia($data['block_id'] ?? '')->first())

@if ($image)
    <figure class="content-block content-block--image">
        <img
            src="{{ $image->getUrl() }}"
            alt="{{ $data['alt'] ?? $image->getAttribute('name') }}"
            loading="lazy"
        >

        @if (filled($data['caption'] ?? null))
            <figcaption>{{ $data['caption'] }}</figcaption>
        @endif
    </figure>
@endif

