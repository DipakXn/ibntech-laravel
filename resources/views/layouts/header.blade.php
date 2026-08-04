@php
    $referenceNavbarPath = base_path('../navbar-design/live-new-navbar.html');
    $referenceNavbarMarkup = null;
    $siteName = $websiteSettings?->site_name ?: config('app.name');
    $logoUrl = $websiteSettings?->logoUrl();
    $contactEmail = $websiteSettings?->contact_email ?: 'sales@ibntech.com';
    $headerPhones = $websiteSettings?->header_phones ?: [
        ['label' => 'USA', 'number' => '+1-844-644-8440'],
        ['label' => 'UK', 'number' => '+44-800-041-8618'],
        ['label' => 'IND', 'number' => '020-711-79586'],
    ];

    if (is_file($referenceNavbarPath)) {
        $referenceNavbarHtml = file_get_contents($referenceNavbarPath);

        if (
            $referenceNavbarHtml !== false
            && preg_match('/<nav class="navbar">.*?<\/nav>/is', $referenceNavbarHtml, $navbarMatch)
        ) {
            $referenceNavbarMarkup = $navbarMatch[0];

            $referenceNavbarMarkup = preg_replace(
                '/\s*<div class="d-block d-sm-none">\s*<div class="calls-sec">.*?<\/div>\s*<\/div>\s*/is',
                '',
                $referenceNavbarMarkup,
            );

            $referenceNavbarMarkup = str_replace(
                [
                    'href="https://www.ibntech.com"',
                    'href="https://www.ibntech.com/contact-us/"',
                    'href="https://www.ibntech.com/about-us/"',
                    'href="https://www.ibntech.com/case-studies/"',
                    'href="https://www.ibntech.com/insights-resources/"',
                    'href="https://www.ibntech.com/services/"',
                ],
                [
                    'href="' . e(route('home')) . '"',
                    'href="' . e(route('page.show', ['slug' => 'contact'])) . '"',
                    'href="' . e(route('page.show', ['slug' => 'about'])) . '"',
                    'href="' . e(route('case-studies.index')) . '"',
                    'href="' . e(route('ebooks.index')) . '"',
                    'href="' . e(route('page.show', ['slug' => 'services'])) . '"',
                ],
                $referenceNavbarMarkup,
            );

            $referenceNavbarMarkup = preg_replace(
                '/<a class="Bookmeeting"[^>]*href="#"[^>]*>/i',
                '<a class="Bookmeeting" href="' . e(route('page.show', ['slug' => 'contact'])) . '">',
                $referenceNavbarMarkup,
            );
        }
    }
@endphp

@if ($referenceNavbarMarkup)
    <header class="site-reference-header">
        <div class="site-reference-topbar">
            <div class="site-reference-topbar__inner">
                <div class="site-reference-topbar__badge">SINCE 1999 | ISO 9001:2015 | 20000-1:2018 | 27001:2022</div>
                <div class="site-reference-topbar__contacts">
                    @foreach ($headerPhones as $phone)
                        @php
                            $phoneNumber = $phone['number'] ?? '';
                            $phoneLabel = $phone['label'] ?? null;
                            $telHref = 'tel:' . preg_replace('/[^\d+]/', '', $phoneNumber);
                        @endphp
                        @if ($phoneNumber !== '')
                            <a href="{{ $telHref }}"><i class="fa-solid fa-phone-volume" aria-hidden="true"></i> {{ $phoneLabel ? $phoneLabel . ': ' : '' }}{{ $phoneNumber }}</a>
                        @endif
                    @endforeach
                    @if ($contactEmail)
                        <a href="mailto:{{ $contactEmail }}"><i class="fa-regular fa-envelope" aria-hidden="true"></i> {{ $contactEmail }}</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="site-reference-navbar">
            {!! $referenceNavbarMarkup !!}
        </div>
    </header>
@else
    <header class="site-header">
        <div class="site-topbar">
            <div class="site-shell site-topbar__inner">
                <div class="site-topbar__badge">SINCE 1999 | ISO 9001:2015 | 20000-1:2018 | 27001:2022</div>
                <div class="site-topbar__contacts">
                    @foreach ($headerPhones as $phone)
                        @php
                            $phoneNumber = $phone['number'] ?? '';
                            $phoneLabel = $phone['label'] ?? null;
                            $telHref = 'tel:' . preg_replace('/[^\d+]/', '', $phoneNumber);
                        @endphp
                        @if ($phoneNumber !== '')
                            <a href="{{ $telHref }}"><i class="fa-solid fa-phone-volume" aria-hidden="true"></i> {{ $phoneLabel ? $phoneLabel . ': ' : '' }}{{ $phoneNumber }}</a>
                        @endif
                    @endforeach
                    @if ($contactEmail)
                        <a href="mailto:{{ $contactEmail }}"><i class="fa-regular fa-envelope" aria-hidden="true"></i> {{ $contactEmail }}</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="site-navbar">
            <div class="site-shell site-navbar__inner">
                <a href="{{ route('home') }}" class="site-logo" aria-label="{{ $siteName }} home">
                    @if ($logoUrl)
                        <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="site-logo__image">
                    @else
                        <span class="site-logo__tile site-logo__tile--navy">I</span>
                        <span class="site-logo__tile site-logo__tile--teal">B</span>
                        <span class="site-logo__tile site-logo__tile--green">N</span>
                    @endif
                </a>

                <nav class="site-nav" aria-label="Primary">
                    <a href="{{ route('page.show', ['slug' => 'services']) }}">Capabilities <span><i class="fa-solid fa-angle-down" aria-hidden="true"></i></span></a>
                    <a href="{{ route('case-studies.index') }}">Industries <span><i class="fa-solid fa-angle-down" aria-hidden="true"></i></span></a>
                    <a href="{{ route('ebooks.index') }}">Insights &amp; Resources <span><i class="fa-solid fa-angle-down" aria-hidden="true"></i></span></a>
                    <a href="{{ route('page.show', ['slug' => 'about']) }}">Company <span><i class="fa-solid fa-angle-down" aria-hidden="true"></i></span></a>
                </nav>

                <a href="{{ route('page.show', ['slug' => 'contact']) }}" class="site-contact-button"><i class="fa-regular fa-paper-plane" aria-hidden="true"></i> Get In Touch</a>
            </div>
        </div>
    </header>
@endif
