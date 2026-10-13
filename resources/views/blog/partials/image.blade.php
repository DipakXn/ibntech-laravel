@php
    $class ??= '';
    $conversion ??= null;
    $imageUrl = method_exists($post, 'featuredImageUrl')
        ? $post->featuredImageUrl($conversion)
        : null;
@endphp

@if($imageUrl)
    <x-featured-image :model="$post" :conversion="$conversion" :class="$class" />
@else
    <div class="{{ $class }} blog-image-placeholder" aria-hidden="true">
        <span>{{ $post->category?->name ?? 'IBN' }}</span>
    </div>
@endif
