@php
    $img = fn (string $file): string => asset('images/infrastructure/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);

    $facilityItems = [
        'IBNs Global Delivery Centre, Located at Pune, India',
        '24X7 Tech Support for All Processes | ISO 9001 : 2008 Certified',
        'Internet Lease Lines from Multiple ISP’s for Redundancy |100% Power Back up | CCTV Enabled 24×7 Security',
        'Secured & Rule Based Bio Metric Access | Comprehensive Business Contingency Plan in Place',
    ];

    $featureCards = [
        [
            'icon' => 'connectivity.webp',
            'alt' => 'connectivity',
            'title' => 'Connectivity',
            'text' => 'Complete fiber optic based connectivity. Fail safe ring architecture for redundancy and SLA with the ISPs to office 24X7 support and 99.9% uptime guarantee. IBN provides totally secure SSL, high-level encryption service as per privacy policy.',
        ],
        [
            'icon' => 'data-security-1.webp',
            'alt' => 'data security',
            'title' => 'Data Security',
            'text' => 'We work closely with our technology partners to offer clients with the most secure and robust data protection. We identify all areas of vulnerability and develop strategies for securing data and information systems. Our data security policies are built on ISO 27001 best practices in Information Security.',
        ],
    ];

    $networkItems = [
        'Windows Server 2022 Domain Controller and Azure AD, Primary and Backup Server.',
        'Virus scanner Installed for Servers and Clients.',
        'Office 365 for email and team collaboration.',
        'Multi-Factor Authentication is Enforced.',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/infrastructure.css'])
@endpush

@section('content')
    <div class="infra-page">
        {{-- Hero --}}
        <section class="infra-hero" aria-labelledby="infra-hero-title">
            <div class="site-shell infra-hero__inner">
                <div class="infra-hero__copy">
                    <h1 id="infra-hero-title">Infrastructure</h1>
                    <a href="{{ $contactUrl }}" class="infra-btn infra-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="infra-hero__visual">
                    <img
                        src="{{ $img('infrastructure.webp') }}"
                        alt="infrastructure"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Facility --}}
        <section class="infra-facility" aria-labelledby="infra-facility-title">
            <div class="site-shell">
                <h2 id="infra-facility-title" class="infra-facility__heading">
                    Facility with State of the Art Infrastructure
                </h2>

                <div class="infra-facility__grid">
                    <div class="infra-facility__media">
                        <img
                            src="{{ $img('facility-with-state-of-the-art-infrastructure.webp') }}"
                            alt="facility with state of the art infrastructure"
                            width="526"
                            height="309"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>

                    <div class="infra-facility__copy">
                        <p class="infra-facility__eyebrow">(27+ Years of Expertise)</p>
                        <ul class="infra-list">
                            @foreach ($facilityItems as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Connectivity / Data Security --}}
        <section class="infra-features" aria-label="Connectivity and data security">
            <div class="site-shell">
                <div class="infra-features__grid">
                    @foreach ($featureCards as $card)
                        <article class="infra-card">
                            <img
                                src="{{ $img($card['icon']) }}"
                                alt="{{ $card['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="infra-features__cta">
                    <a href="{{ $contactUrl }}" class="infra-btn infra-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Server and Network Security --}}
        <section class="infra-network" aria-labelledby="infra-network-title">
            <div class="site-shell infra-network__inner">
                <div class="infra-network__copy">
                    <h2 id="infra-network-title">Server and Network Security</h2>
                    <p>
                        Computers and VPN access to internal and external users are secured with Domain Controller along with Sophos Firewall Policies. These policies are defined per users, their hierarchy, and departments.
                    </p>
                    <ul class="infra-list">
                        @foreach ($networkItems as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="infra-network__media">
                    <img
                        src="{{ $img('top-data-conversion-outsourcing-services.webp') }}"
                        alt="top data conversion outsourcing services"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>
    </div>
@endsection
