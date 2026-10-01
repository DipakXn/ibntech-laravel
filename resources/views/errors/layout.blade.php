@php
    $isAdminRequest = request()->is('admin') || request()->is('admin/*');
    $seoService = app(\App\Services\SeoService::class);
    $robots = $seoService->current()['robots'] ?? 'noindex, nofollow';

    if (! str_contains(strtolower((string) $robots), 'noindex')) {
        $robots = 'noindex, nofollow';
    }

    $seoService->setCurrent([
        'meta_title' => $errorPage['meta_title'],
        'meta_description' => $errorPage['meta_description'],
        'og_title' => $errorPage['meta_title'],
        'og_description' => $errorPage['meta_description'],
        'twitter_title' => $errorPage['meta_title'],
        'twitter_description' => $errorPage['meta_description'],
        'robots' => $robots,
    ]);
@endphp

@extends($isAdminRequest ? 'errors.layouts.admin' : 'layouts.app')

@section('content')
    @if ($isAdminRequest)
        @include('errors.partials.admin-card')
    @else
        @include('errors.partials.public-panel')
    @endif
@endsection
