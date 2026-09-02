@props([
    'model' => null,
])

@php
    $styleTag = \App\Support\AdditionalAssets::styleTag($model?->additional_css);
    $scriptTag = \App\Support\AdditionalAssets::scriptTag($model?->additional_js);
@endphp

@if (filled($styleTag))
    @push('styles')
        {!! $styleTag !!}
    @endpush
@endif

@if (filled($scriptTag))
    @push('scripts')
        {!! $scriptTag !!}
    @endpush
@endif
