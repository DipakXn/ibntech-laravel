@php
    $class ??= '';
    $conversion ??= null;
    $imageUrl = method_exists($post, 'featuredImageUrl')
        ? $post->featuredImageUrl($conversion)
        : null;
@endphp

@if($imageUrl)
    <img class="{{ $class }}" src="{{ $imageUrl }}" alt="{{ $post->title }}" loading="lazy">
@else
    <div class="{{ $class }} blog-image-placeholder" aria-hidden="true">
        <span>{{ $post->category?->name ?? 'IBN' }}</span>
    </div>
@endif
