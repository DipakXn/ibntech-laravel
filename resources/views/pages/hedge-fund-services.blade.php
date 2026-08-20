@php
    $img = fn (string $file): string => asset('images/hedge-fund-services/'.$file);

    $serviceTabs = [
        [
            'title' => 'Finance Support',
            'image' => 'finance-support.webp',
            'alt' => 'finance-support',
        ],
        [
            'title' => 'Investment Operation Support',
            'image' => 'investment-operation-support.webp',
            'alt' => 'investment operation support',
        ],
        [
            'title' => 'Sales & Marketing Support',
            'image' => 'sales-marketing-support.webp',
            'alt' => 'sales and marketing support',
        ],
    ];

    $valueItems = [
        ['num' => '01', 'title' => 'Consulting-led solutions', 'color' => '#ff9900'],
        ['num' => '02', 'title' => 'Hedge fund industry expertise', 'color' => '#ff3333'],
        ['num' => '03', 'title' => 'Strong team of financial experts', 'color' => '#009999'],
        ['num' => '04', 'title' => 'Comprehensive training programs', 'color' => '#1cbf36'],
        ['num' => '05', 'title' => 'Advanced technology infrastructure', 'color' => '#b117df'],
        ['num' => '06', 'title' => 'Deep platform knowledge', 'color' => '#f10ab8'],
        ['num' => '07', 'title' => 'Global delivery capabilities', 'color' => '#27dd9b'],
        ['num' => '08', 'title' => 'Client-Centric Approach', 'color' => '#2a5712'],
    ];

    $trackItems = [
        [
            'icon' => 'fa-money-bill-wave',
            'text' => '$20 Billion in Assets Under Back Office and Outsourcing',
        ],
        [
            'icon' => 'fa-table-cells-large',
            'text' => '100+ Funds under Fund Accounting and Administration Outsourcing',
        ],
        [
            'icon' => 'fa-database',
            'text' => '1,000+ Accounts Reporting',
        ],
        [
            'icon' => 'fa-bullseye',
            'text' => 'Expertise across All Asset Classes, including exotic instruments',
        ],
    ];

    $successItems = [
        ['value' => '26', 'suffix' => '+', 'label' => 'Years of Experience'],
        ['value' => '99.99', 'suffix' => '%', 'label' => 'Accuracy in Deliverables'],
        ['value' => '10', 'suffix' => '+', 'label' => 'Software expertise'],
        ['value' => '50', 'suffix' => '%', 'label' => 'Save operational cost'],
        ['value' => '99', 'suffix' => '%', 'label' => 'Client Retention Rate'],
        ['value' => '30', 'suffix' => '+', 'label' => 'Client Investment Manager'],
    ];

    $outcomeItems = [
        'Data accuracy and integrity',
        'Professional proficiency',
        'Round-the-clock support',
        'Transparent Reporting',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/hedge-fund-services.css'])
@endpush

@section('content')
    <div class="hfs-page">
        {{-- Hero --}}
        <section class="hfs-hero" aria-labelledby="hfs-hero-title">
            <div class="site-shell hfs-hero__inner">
                <div class="hfs-hero__copy">
                    <h1 id="hfs-hero-title">Fund middle and back office Services</h1>
                    <p class="hfs-hero__lede">
                        Secure 99% Satisfaction and Operational Savings of Up to 50% with Our Hedge Fund Operations
                    </p>
                    <a href="#" class="hfs-btn hfs-btn--green" data-contact-modal-trigger>
                        Get Expert Advice
                    </a>
                </div>
                <div class="hfs-hero__media">
                    <img
                        src="{{ $img('fund-middle-and-back-office-services.webp') }}"
                        alt="fund-middle-and back-office-services"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Trusted expertise --}}
        <section class="hfs-intro" aria-labelledby="hfs-intro-title">
            <div class="site-shell">
                <div class="hfs-intro__card">
                    <h2 id="hfs-intro-title">Trusted Expertise in Fund Middle &amp; Back Office Solutions</h2>
                    <p>
                        IBN Technologies, recognized among the <strong>top hedge fund accounting firms</strong>,
                        provides a full spectrum of
                        <a href="{{ route('blog.category', ['slug' => 'hedge-fund']) }}"><strong>fund middle and back office services</strong></a>,
                        ensuring accurate and timely reporting.
                    </p>
                </div>
            </div>
        </section>

        {{-- Who we serve --}}
        <section class="hfs-section hfs-serve" aria-labelledby="hfs-serve-title">
            <div class="site-shell">
                <div class="hfs-heading">
                    <h2 id="hfs-serve-title">Who We Serve</h2>
                </div>
                <img
                    class="hfs-serve__image"
                    src="{{ $img('who-we-serve.webp') }}"
                    alt="Hedge fund services"
                    width="650"
                    height="279"
                    loading="lazy"
                    decoding="async"
                >
            </div>
        </section>

        {{-- Fund middle & back office service tabs --}}
        <section class="hfs-section hfs-services" aria-labelledby="hfs-services-title">
            <div class="site-shell">
                <div class="hfs-heading">
                    <h2 id="hfs-services-title">Fund Middle &amp; Back Office Service</h2>
                </div>

                <div class="hfs-tabs" x-data="{ active: 0 }">
                    

                    <div
                        class="hfs-tabs__nav"
                        role="tablist"
                        aria-label="Fund middle and back office services"
                        aria-orientation="vertical"
                    >
                        @foreach ($serviceTabs as $i => $tab)
                            <button
                                type="button"
                                class="hfs-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                id="hfs-tab-{{ $i }}"
                                role="tab"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                aria-controls="hfs-panel-{{ $i }}"
                                @click="active = {{ $i }}"
                                @keydown.arrow-down.prevent="active = {{ ($i + 1) % count($serviceTabs) }}"
                                @keydown.arrow-up.prevent="active = {{ ($i - 1 + count($serviceTabs)) % count($serviceTabs) }}"
                            >
                                {{ $tab['title'] }}
                            </button>
                        @endforeach
                    </div>

                    <div class="hfs-tabs__panels">
                        @foreach ($serviceTabs as $i => $tab)
                            <div
                                class="hfs-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                                id="hfs-panel-{{ $i }}"
                                role="tabpanel"
                                aria-labelledby="hfs-tab-{{ $i }}"
                                :class="{ 'is-active': active === {{ $i }} }"
                                x-show="active === {{ $i }}"
                                x-cloak
                            >
                                <img
                                    src="{{ $img($tab['image']) }}"
                                    alt="{{ $tab['alt'] }}"
                                    width="850"
                                    height="450"
                                    loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                                    decoding="async"
                                >
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Value proposition --}}
        <section class="hfs-section hfs-value" aria-labelledby="hfs-value-title">
            <div class="site-shell">
                <div class="hfs-heading">
                    <h2 id="hfs-value-title">IBN's Value Proposition</h2>
                </div>
                <ul class="hfs-value__grid">
                    @foreach ($valueItems as $item)
                        <li class="hfs-value__item">
                            <span class="hfs-value__num" style="background-color: {{ $item['color'] }}">
                                {{ $item['num'] }}
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        {{-- Proven track record --}}
        <section class="hfs-section hfs-track" aria-labelledby="hfs-track-title">
            <div class="site-shell">
                <div class="hfs-heading">
                    <h2 id="hfs-track-title">Proven track record</h2>
                </div>
                <ul class="hfs-track__grid">
                    @foreach ($trackItems as $item)
                        <li class="hfs-track__item">
                            <span class="hfs-track__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <p>{{ $item['text'] }}</p>
                        </li>
                    @endforeach
                </ul>
                <div class="hfs-center">
                    <a href="#" class="hfs-btn hfs-btn--green hfs-btn--lg" data-contact-modal-trigger>
                        Talk To Our Experts
                    </a>
                </div>
            </div>
        </section>

        {{-- Success indicators --}}
        <section class="hfs-section hfs-success" aria-labelledby="hfs-success-title">
            <div class="site-shell">
                <div class="hfs-heading">
                    <h2 id="hfs-success-title">Success Indicators</h2>
                </div>
                <ul class="hfs-success__grid">
                    @foreach ($successItems as $item)
                        <li class="hfs-success__item">
                            <p class="hfs-success__value">
                                <span>{{ $item['value'] }}</span>{{ $item['suffix'] }}
                            </p>
                            <h3>{{ $item['label'] }}</h3>
                        </li>
                    @endforeach
                </ul>
                <div class="hfs-center">
                    <a href="#" class="hfs-btn hfs-btn--green hfs-btn--lg" data-contact-modal-trigger>
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="hfs-cta-bar" aria-labelledby="hfs-cta-bar-title">
            <div class="site-shell hfs-cta-bar__inner">
                <h2 id="hfs-cta-bar-title">
                    Outsource your operations and invest more time in growing your hedge fund portfolio
                </h2>
                <a href="#" class="hfs-btn hfs-btn--green" data-contact-modal-trigger>
                    Connect with Us
                </a>
            </div>
        </section>

        {{-- Software expertise --}}
        <section class="hfs-section hfs-software" aria-labelledby="hfs-software-title">
            <div class="site-shell hfs-software__inner">
                <div class="hfs-software__copy">
                    <h2 id="hfs-software-title">
                        Software <span>Expertise</span>
                    </h2>
                    <p>
                        Drive operational excellence in your fund operations. Our expert integration services deliver accurate, timely data to support strategic decision-making.
                    </p>
                </div>
                <div class="hfs-software__media">
                    <img
                        src="{{ $img('software-expertise.webp') }}"
                        alt="software-logo-img-hedge-fund"
                        width="1920"
                        height="825"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- What you get --}}
        <section class="hfs-section hfs-outcomes" aria-labelledby="hfs-outcomes-title">
            <div class="site-shell">
                <div class="hfs-heading">
                    <h2 id="hfs-outcomes-title">What You Get with Our Fund Operation Services</h2>
                </div>
                <ul class="hfs-outcomes__grid">
                    @foreach ($outcomeItems as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
@endsection
