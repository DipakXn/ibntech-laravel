@php
    $img = fn (string $file): string => asset('images/microsoft-dynamics-nav/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);
    $office365Url = route('page.show', ['slug' => 'microsoft-office-365-migration-support-services']);

    $capabilities = [
        [
            'title' => 'Finance Management',
            'text' => 'Track and manage your production, inventory, orders, and vendors.',
        ],
        [
            'title' => 'Project Management',
            'text' => 'Create estimates, track projects, and manage capacity.',
        ],
        [
            'title' => 'Sales, Marketing, and Service Management',
            'text' => 'Manage your contacts, campaigns, sales opportunities, and service contract.',
        ],
        [
            'title' => 'Business intelligence and reporting',
            'text' => 'Get a holistic view of your business and make informed decisions.',
        ],
        [
            'title' => 'Supply Chain Management (SCM) & Manufacturing',
            'text' => 'Track and manage your production, inventory, orders, and vendors.',
        ],
        [
            'title' => 'Human Resources Management (HRM)',
            'text' => 'We analyses the present stand of every situation that we face and come up with the best possible solution for our Clients.',
        ],
        [
            'title' => 'Mobile',
            'text' => 'With the new browser-based user interface, Microsoft Dynamics NAV flexibly adapts to the respective device format, the type of interaction (touch, mouse or keyboard) and the browser type.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/microsoft-dynamics-nav.css'])
@endpush

@section('content')
    <div class="mdn-page">
        <section class="mdn-hero" aria-labelledby="mdn-hero-title">
            <div class="site-shell mdn-hero__inner">
                <div class="mdn-hero__copy">
                    <p class="mdn-hero__eyebrow">Get More Out Of Your Business</p>
                    <h1 id="mdn-hero-title">Microsoft Dynamics Nav</h1>
                    <a href="{{ $contactUrl }}" class="mdn-btn">Get a Free Consultation Today</a>
                </div>

                <div class="mdn-hero__media">
                    <img
                        src="{{ $img('microsoft-dynamics-nav-banner.webp') }}"
                        alt="microsoft dynamics nav banner"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        <section class="mdn-split" aria-labelledby="mdn-intro-title">
            <div class="site-shell mdn-split__inner">
                <div class="mdn-split__media">
                    <img
                        src="{{ $img('microsoft-dynamics-nav.webp') }}"
                        alt="microsoft dynamics nav"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="mdn-split__copy">
                    <h2 id="mdn-intro-title">Microsoft Dynamics Nav</h2>
                    <p>Microsoft Dynamics NAV is multi-language, multi-currency business management solution that helps small and mid-size companies worldwide manage their accounting and finances, supply chain, and operations. Start with what you need now, and easily adapt as your business needs change. In the Microsoft cloud or on your serversthe choice is yours</p>
                    <p>With access to real-time data and a wide range of analytical and reporting tools your people can make informed, confident decisions that help drive business success. With desktop integration, built-in tools, robust security and open architecture, Microsoft NAV makes it easy to add functionality, custom applications and online business capabilities for you with your business partner.</p>
                </div>
            </div>
        </section>

        <section class="mdn-split mdn-split--reverse" aria-labelledby="mdn-login-title">
            <div class="site-shell mdn-split__inner">
                <div class="mdn-split__copy">
                    <h2 id="mdn-login-title">One Login To Your Day</h2>
                    <p>Microsoft Dynamics NAV and <a href="{{ $office365Url }}">Office 365</a> is the winning combination for business. When your email, calendar, and files seamlessly come together with your data, reports and business processes you get an integrated experience that no other stand-alone enterprise resource planning (ERP) solution can match. Share the big picture on your team collaboration site and conveniently drill into the details within Microsoft Dynamics NAV without the need to change from one application to the other.</p>
                    <a href="{{ $contactUrl }}" class="mdn-btn">Get a Free Consultation Today</a>
                </div>

                <div class="mdn-split__media">
                    <img
                        src="{{ $img('one-login-to-your-day.webp') }}"
                        alt="one login to your day"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        <section class="mdn-split" aria-labelledby="mdn-boost-title">
            <div class="site-shell mdn-split__inner">
                <div class="mdn-split__media">
                    <img
                        src="{{ $img('ibn-boost.webp') }}"
                        alt="ibn boost"
                        width="794"
                        height="515"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="mdn-split__copy">
                    <h2 id="mdn-boost-title">IBN Boost Success For Small And Midsize Businesses</h2>
                    <p>Microsoft Dynamics NAV is sold, implemented, and supported by IBN. we meet with you to discuss your requirements and then create a price quote based upon your business needs. Ultimately, the price of your solution depends on your specific functionality needs, the number and type of users who will be accessing the system, the needed implementation support, and how you choose to deploy the software-premises or in the cloud, whichever model best fits your business.</p>
                </div>
            </div>
        </section>

        <section class="mdn-split mdn-split--reverse mdn-split--last" aria-labelledby="mdn-deploy-title">
            <div class="site-shell mdn-split__inner">
                <div class="mdn-split__copy">
                    <h2 id="mdn-deploy-title">Deploy a system that does everything you need to achieve more</h2>
                    <div class="mdn-capabilities">
                        @foreach ($capabilities as $item)
                            <div class="mdn-capability">
                                <h3>{{ $item['title'] }}:</h3>
                                <p>{{ $item['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ $contactUrl }}" class="mdn-btn">Get a Free Consultation Today</a>
                </div>

                <div class="mdn-split__media mdn-split__media--tall">
                    <img
                        src="{{ $img('deploy-a-system-last-img.webp') }}"
                        alt="deploy a system-last img"
                        width="618"
                        height="778"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>
    </div>
@endsection
