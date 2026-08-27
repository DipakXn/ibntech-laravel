@php
    $siteName = $websiteSettings?->site_name ?: config('app.name');
    $faviconUrl = $websiteSettings?->faviconUrl();
    $appleTouchIconUrl = $websiteSettings?->appleTouchIconUrl();
    $landingPageCss = ! empty($landingPage?->template)
        ? 'resources/css/landing-pages/'.$landingPage->template.'.css'
        : null;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo['meta_title'] ?? ($landingPage->title ?? $siteName) }}</title>
    <meta name="description" content="{{ $seo['meta_description'] ?? '' }}">
    @if(!empty($seo['meta_keywords']))
        <meta name="keywords" content="{{ $seo['meta_keywords'] }}">
    @endif

    @if(!empty($seo['robots']))
        <meta name="robots" content="{{ $seo['robots'] }}">
    @endif

    <meta property="og:title" content="{{ $seo['og_title'] ?? $siteName }}">
    <meta property="og:description" content="{{ $seo['og_description'] ?? '' }}">
    <meta property="og:url" content="{{ $seo['canonical_url'] ?? url()->current() }}">
    <meta property="og:type" content="{{ $seo['og_type'] ?? 'website' }}">
    <meta property="og:site_name" content="{{ $seo['og_site_name'] ?? $siteName }}">
    <meta property="og:locale" content="{{ $seo['og_locale'] ?? 'en_US' }}">
    @if(!empty($seo['og_image']))
        <meta property="og:image" content="{{ $seo['og_image'] }}">
        @if(!empty($seo['og_image_secure_url']))
            <meta property="og:image:secure_url" content="{{ $seo['og_image_secure_url'] }}">
        @endif
        @if(!empty($seo['og_image_width']))
            <meta property="og:image:width" content="{{ $seo['og_image_width'] }}">
        @endif
        @if(!empty($seo['og_image_height']))
            <meta property="og:image:height" content="{{ $seo['og_image_height'] }}">
        @endif
        @if(!empty($seo['og_image_type']))
            <meta property="og:image:type" content="{{ $seo['og_image_type'] }}">
        @endif
    @endif
    @if(!empty($seo['og_image_alt']))
        <meta property="og:image:alt" content="{{ $seo['og_image_alt'] }}">
    @endif
    @if(!empty($seo['og_updated_time']))
        <meta property="og:updated_time" content="{{ $seo['og_updated_time'] }}">
    @endif

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
        @if(!empty($seo['twitter_image_alt']))
            <meta name="twitter:image:alt" content="{{ $seo['twitter_image_alt'] }}">
        @endif
    @endif
    @if(!empty($seo['twitter_creator']))
        <meta name="twitter:creator" content="{{ $seo['twitter_creator'] }}">
    @endif
    @if(!empty($seo['twitter_site']))
        <meta name="twitter:site" content="{{ $seo['twitter_site'] }}">
    @endif
    @if(!empty($seo['twitter_label1']) && !empty($seo['twitter_data1']))
        <meta name="twitter:label1" content="{{ $seo['twitter_label1'] }}">
        <meta name="twitter:data1" content="{{ $seo['twitter_data1'] }}">
    @endif

    <link rel="canonical" href="{{ $seo['canonical_url'] ?? url()->current() }}">

    @if(!empty($seo['article_publisher']))
        <meta property="article:publisher" content="{{ $seo['article_publisher'] }}">
    @endif
    @if(!empty($seo['article_author']))
        <meta property="article:author" content="{{ $seo['article_author'] }}">
    @endif
    @if(!empty($seo['published_at']))
        <meta property="article:published_time" content="{{ $seo['published_at'] }}">
    @endif
    @if(!empty($seo['modified_at']))
        <meta property="article:modified_time" content="{{ $seo['modified_at'] }}">
    @endif
    @if(!empty($seo['article_section']))
        <meta property="article:section" content="{{ $seo['article_section'] }}">
    @endif
    @foreach(($seo['article_tags'] ?? []) as $articleTag)
        <meta property="article:tag" content="{{ $articleTag }}">
    @endforeach

    @if(!empty($seo['json_ld']))
        <script type="application/ld+json">{!! $seo['json_ld'] !!}</script>
    @endif

    @if(!empty($seo['custom_head_code']))
        {!! $seo['custom_head_code'] !!}
    @endif

    @if(!empty($websiteSettings?->google_site_verification))
        <meta name="google-site-verification" content="{{ $websiteSettings->google_site_verification }}">
    @endif
    @if(!empty($websiteSettings?->bing_site_verification))
        <meta name="msvalidate.01" content="{{ $websiteSettings->bing_site_verification }}">
    @endif

    @if ($faviconUrl)
        <link rel="icon" href="{{ $faviconUrl }}">
        <link rel="shortcut icon" href="{{ $faviconUrl }}">
    @else
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon_io/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon_io/favicon.svg') }}">
        <link rel="shortcut icon" href="{{ asset('favicon_io/favicon.ico') }}">
    @endif

    @if ($appleTouchIconUrl)
        <link rel="apple-touch-icon" sizes="180x180" href="{{ $appleTouchIconUrl }}">
    @else
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    @endif

    <meta name="apple-mobile-web-app-title" content="{{ $siteName }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/css/landing-pages/layout.css', 'resources/js/app.js'])
        @if ($landingPageCss && file_exists(base_path($landingPageCss)))
            @vite([$landingPageCss])
        @endif
    @endif
    @stack('styles')
    @livewireStyles
    <script src="https://www.google.com/recaptcha/api.js?render=explicit" async defer></script>

    @if(!empty($websiteSettings?->google_tag_manager_id))
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{{ $websiteSettings->google_tag_manager_id }}');</script>
    @endif

    @if(!empty($websiteSettings?->google_analytics_id))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $websiteSettings->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $websiteSettings->google_analytics_id }}');
        </script>
    @endif

    @if(!empty($websiteSettings?->custom_head_code))
        {!! $websiteSettings->custom_head_code !!}
    @endif
</head>
<body class="lp-site">
    @if(!empty($websiteSettings?->google_tag_manager_id))
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id={{ $websiteSettings->google_tag_manager_id }}"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
    @endif

    <x-landing.header />
    <main>
        @yield('content')
    </main>
    <x-landing.footer />
    @livewireScripts

    @if(!empty($websiteSettings?->custom_body_end_code))
        {!! $websiteSettings->custom_body_end_code !!}
    @endif
</body>
</html>
