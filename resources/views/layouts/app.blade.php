<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo['meta_title'] ?? config('app.name') }}</title>
    <meta name="description" content="{{ $seo['meta_description'] ?? '' }}">
    @if(!empty($seo['meta_keywords']))
        <meta name="keywords" content="{{ $seo['meta_keywords'] }}">
    @endif

    @if(!empty($seo['robots']))
        <meta name="robots" content="{{ $seo['robots'] }}">
    @endif

    <meta property="og:title" content="{{ $seo['og_title'] ?? config('app.name') }}">
    <meta property="og:description" content="{{ $seo['og_description'] ?? '' }}">
    <meta property="og:url" content="{{ $seo['canonical_url'] ?? url()->current() }}">
    <meta property="og:type" content="{{ $seo['og_type'] ?? 'website' }}">
    <meta property="og:site_name" content="{{ $seo['og_site_name'] ?? config('app.name') }}">
    <meta property="og:locale" content="{{ $seo['og_locale'] ?? str_replace('_', '-', app()->getLocale()) }}">
    @if(!empty($seo['og_image']))
        <meta property="og:image" content="{{ $seo['og_image'] }}">
    @endif
    @if(!empty($seo['og_image_alt']))
        <meta property="og:image:alt" content="{{ $seo['og_image_alt'] }}">
    @endif

    {{-- Twitter cards --}}
    @if(!empty($seo['twitter_card_type']))
        <meta name="twitter:card" content="{{ $seo['twitter_card_type'] }}">
    @endif
    @if(!empty($seo['twitter_title']))
        <meta name="twitter:title" content="{{ $seo['twitter_title'] }}">
    @endif
    @if(!empty($seo['twitter_description']))
        <meta name="twitter:description" content="{{ $seo['twitter_description'] }}">
    @endif
    @if(!empty($seo['twitter_image']))
        <meta name="twitter:image" content="{{ $seo['twitter_image'] }}">
    @endif
    @if(!empty($seo['twitter_creator']))
        <meta name="twitter:creator" content="{{ $seo['twitter_creator'] }}">
    @endif
    @if(!empty($seo['twitter_site']))
        <meta name="twitter:site" content="{{ $seo['twitter_site'] }}">
    @endif

    <link rel="canonical" href="{{ $seo['canonical_url'] ?? url()->current() }}">

    {{-- Article metadata --}}
    @if(!empty($seo['article_author']))
        <meta property="article:author" content="{{ $seo['article_author'] }}">
    @endif
    @if(!empty($seo['published_at']))
        <meta property="article:published_time" content="{{ $seo['published_at'] }}">
    @endif
    @if(!empty($seo['modified_at']))
        <meta property="article:modified_time" content="{{ $seo['modified_at'] }}">
    @endif

    {{-- JSON-LD / Schema --}}
    @if(!empty($seo['json_ld']))
        <script type="application/ld+json">{!! $seo['json_ld'] !!}</script>
    @endif

    {{-- Custom head injection from SEO panel (admin-supplied) --}}
    @if(!empty($seo['custom_head_code']))
        {!! $seo['custom_head_code'] !!}
    @endif
    {{-- Favicons (place generated files in `public/favicon_io/`) --}}
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon_io/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon_io/favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon_io/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    @include('layouts.header')
    <main>
        @yield('content')
    </main>
    @include('layouts.footer')
    @livewireScripts
</body>
</html>
