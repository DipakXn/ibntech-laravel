@props([
    'model',
    'conversion' => null,
    'alt' => null,
    'class' => '',
    'loading' => 'lazy',
    'decoding' => 'async',
    'fetchpriority' => null,
])

@php
    $imageUrl = method_exists($model, 'featuredImageUrl')
        ? $model->featuredImageUrl($conversion)
        : null;

    $dimensions = method_exists($model, 'featuredImageDimensions')
        ? $model->featuredImageDimensions($conversion)
        : null;

    $altText = $alt ?? ($model->title ?? '');
@endphp

@if ($imageUrl)
    <img
        {{ $attributes->merge(['class' => $class]) }}
        src="{{ $imageUrl }}"
        alt="{{ $altText }}"
        @if ($dimensions)
            width="{{ $dimensions['width'] }}"
            height="{{ $dimensions['height'] }}"
        @endif
        loading="{{ $loading }}"
        decoding="{{ $decoding }}"
        @if ($fetchpriority) fetchpriority="{{ $fetchpriority }}" @endif
    >
@endif
