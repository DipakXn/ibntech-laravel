@php
    $img = fn (string $file): string => asset('images/hedge-fund-accounting/'.$file);

    $formRoleOptions = [
        'Hedge Fund Manager',
        'Fund Of Funds',
        'Private Capital/Equity',
        'Fund Administrator',
        'Service Provider',
    ];

    $checkSvg = '<svg aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm141.63 177.667l-184 184c-6.248 6.248-16.379 6.248-22.627 0l-104-104c-6.248-6.248-6.248-16.379 0-22.627l22.627-22.627c6.248-6.248 16.379-6.249 22.628 0L202.667 308.667l150.039-150.039c6.248-6.248 16.379-6.248 22.628 0l22.627 22.627c6.249 6.249 6.249 16.379.001 22.628z"></path></svg>';

    $serviceTabs = [
        [
            'title' => 'Finance Support',
            'description' => 'Assuring the accuracy of reports and the satisfaction of investors by providing comprehensive financial management solutions',
            'left' => ['Shadow Fund Accounting', 'NAV processing', 'Trade processing & reconciliation'],
            'right' => ['Fund audit assistance', 'Fees calculation', 'Investor reporting'],
        ],
        [
            'title' => 'Investment Operation Support',
            'description' => 'Improve the efficiency of operational processes and track investment performance more accurately',
            'left' => ['Updating NAV/returns', 'Processing fund data'],
            'right' => ['Managing fund documents', 'Tracking performance'],
        ],
        [
            'title' => 'Sales & Marketing Support',
            'description' => 'Communicate strategically and manage data to enhance client relationships and market presence',
            'left' => ['Contact data research & management', 'Website content management', 'Investor portal management'],
            'right' => ['CRM management', 'Fund Newsletter posting', 'Ad-hoc activities'],
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

    $testimonials = [
        [
            'quote' => 'After months of researching 100’s of companies, visiting their offices, and extensive reference checks, we are extremely happy with our decision to select IBN. They have exceeded our expectations with consistent levels of specialized knowledge, quality, speed, and professionalism',
            'cite' => 'Client is engaged in advising Fund Of Hedge Funds and providing technology facilitating the management of investment portfolios. Fund of Funds, ~$2B AUM, New York',
        ],
        [
            'quote' => 'We are now entering the fourth year of our relationship with IBN. This has been a hugely rewarding and valuable transaction for us with IBN as they are now responsible for the maintenance of data covering over 70% of the funds within our proprietary Hedge Fund database. The most compelling aspects of IBN’s service are their professionalism and commitment to provide the highest standards of service possible. Each month we randomly samples over 300 funds to monitor the data maintained by IBN and I cannot recall IBN’s accuracy ever falling below 99.5% throughout our entire relationship – infact IBN usually achieves 100% accuracy. The clearest indication of my satisfaction with the service provided is that I am currently considering further activities that can be outsourced to IBN',
            'cite' => 'Client is a leading Hedge Fund of Funds with AUM of USD 9.5 billion globally. David Barber, Director',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/hedge-fund-accounting.css'])
@endpush

@section('content')
    <div class="hfa-page">
        {{-- Hero --}}
        <section class="hfa-hero" aria-labelledby="hfa-hero-title">
            <div class="site-shell hfa-hero__inner">
                <div class="hfa-hero__copy">
                    <h1 id="hfa-hero-title">Expert Back and Middle Office Support for Fund Administration and Accounting Services</h1>
                    <p class="hfa-hero__lede">
                        Get reliable back and middle office services for your investment strategies. Let us manage your hedge fund accounting while you focus on returns.
                    </p>
                    <ul class="hfa-hero__points">
                        <li>
                            <span class="hfa-check hfa-check--light" aria-hidden="true">{!! $checkSvg !!}</span>
                            99% Client Satisfaction
                        </li>
                        <li>
                            <span class="hfa-check hfa-check--light" aria-hidden="true">{!! $checkSvg !!}</span>
                            Cut Operational Costs by Up to 50%
                        </li>
                    </ul>
                </div>

                <aside class="hfa-hero__form" id="hero-form-section" aria-labelledby="hfa-hero-form-title">
                    <h2 id="hfa-hero-form-title">Top-Notch Back and Middle Office Support for Fund Administration</h2>
                    <p class="hfa-hero__form-sub">Reliable Fund Management solutions</p>

                    <livewire:forms.contact-form
                        form-name="hedge-fund-accounting"
                        id-prefix="hfa"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$formRoleOptions"
                        service-placeholder="Choose Your Professional Role"
                        message-placeholder="Message"
                        submit-label="Get Started Now"
                        layout="home"
                    />
                </aside>
            </div>
        </section>

        {{-- Trusted support --}}
        <section class="hfa-intro" aria-labelledby="hfa-intro-title">
            <div class="site-shell">
                <div class="hfa-intro__card">
                    <h2 id="hfa-intro-title">Trusted Support for Funds Management</h2>
                    <p>
                        IBN Technologies, recognized among the top hedge fund service solutions, offers a full spectrum of
                        <strong>fund back and middle office services</strong>, ensuring accurate and timely reporting.
                    </p>
                </div>
            </div>
        </section>

        {{-- Expertise for investment advisors --}}
        <section class="hfa-section hfa-serve" aria-labelledby="hfa-serve-title">
            <div class="site-shell">
                <div class="hfa-heading">
                    <h2 id="hfa-serve-title">Expertise for Investment Advisors</h2>
                </div>
                <img
                    class="hfa-serve__image"
                    src="{{ $img('who-we-serve.webp') }}"
                    alt="Who We Serve-Hedge Fund-change image"
                    width="1105"
                    height="475"
                    loading="lazy"
                    decoding="async"
                >
            </div>
        </section>

        {{-- Fund back and middle office service tabs --}}
        <section class="hfa-section hfa-services" aria-labelledby="hfa-services-title">
            <div class="site-shell">
                <div class="hfa-heading">
                    <h2 id="hfa-services-title">Fund Back and middle Office Service</h2>
                </div>

                <div class="hfa-tabs" x-data="{ active: 0 }">
                    <div
                        class="hfa-tabs__nav"
                        role="tablist"
                        aria-label="Fund back and middle office services"
                        aria-orientation="vertical"
                    >
                        @foreach ($serviceTabs as $i => $tab)
                            <button
                                type="button"
                                class="hfa-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                id="hfa-tab-{{ $i }}"
                                role="tab"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                aria-controls="hfa-panel-{{ $i }}"
                                @click="active = {{ $i }}"
                                @keydown.arrow-down.prevent="active = {{ ($i + 1) % count($serviceTabs) }}"
                                @keydown.arrow-up.prevent="active = {{ ($i - 1 + count($serviceTabs)) % count($serviceTabs) }}"
                            >
                                {{ $tab['title'] }}
                            </button>
                        @endforeach
                    </div>

                    <div class="hfa-tabs__panels">
                        @foreach ($serviceTabs as $i => $tab)
                            <div
                                class="hfa-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                                id="hfa-panel-{{ $i }}"
                                role="tabpanel"
                                aria-labelledby="hfa-tab-{{ $i }}"
                                :class="{ 'is-active': active === {{ $i }} }"
                                x-show="active === {{ $i }}"
                                x-cloak
                            >
                                <h3>{{ $tab['title'] }}</h3>
                                <p>{{ $tab['description'] }}</p>
                                <div class="hfa-tabs__lists">
                                    <ul>
                                        @foreach ($tab['left'] as $item)
                                            <li>
                                                <span class="hfa-check hfa-check--light" aria-hidden="true">{!! $checkSvg !!}</span>
                                                {{ $item }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    <ul>
                                        @foreach ($tab['right'] as $item)
                                            <li>
                                                <span class="hfa-check hfa-check--light" aria-hidden="true">{!! $checkSvg !!}</span>
                                                {{ $item }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <a href="#hero-form-section" class="hfa-btn hfa-btn--navy">Get Started Now</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Value proposition --}}
        <section class="hfa-section hfa-value" aria-labelledby="hfa-value-title">
            <div class="site-shell">
                <div class="hfa-heading">
                    <h2 id="hfa-value-title">IBN's Value Proposition</h2>
                </div>
                <ul class="hfa-value__grid">
                    @foreach ($valueItems as $item)
                        <li class="hfa-value__item">
                            <span class="hfa-value__num" style="background-color: {{ $item['color'] }}">
                                {{ $item['num'] }}
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        {{-- Proven track record --}}
        <section class="hfa-section hfa-track" aria-labelledby="hfa-track-title">
            <div class="site-shell">
                <div class="hfa-heading">
                    <h2 id="hfa-track-title">Proven track record</h2>
                </div>
                <ul class="hfa-track__grid">
                    @foreach ($trackItems as $item)
                        <li class="hfa-track__item">
                            <span class="hfa-track__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <p>{{ $item['text'] }}</p>
                        </li>
                    @endforeach
                </ul>
                <div class="hfa-center">
                    <a href="#hero-form-section" class="hfa-btn hfa-btn--green hfa-btn--lg">
                        Talk To Our Experts
                    </a>
                </div>
            </div>
        </section>

        {{-- Success indicators --}}
        <section class="hfa-section hfa-success" aria-labelledby="hfa-success-title">
            <div class="site-shell">
                <div class="hfa-heading">
                    <h2 id="hfa-success-title">Success Indicators</h2>
                </div>
                <ul class="hfa-success__grid">
                    @foreach ($successItems as $item)
                        <li class="hfa-success__item">
                            <p class="hfa-success__value">
                                <span>{{ $item['value'] }}</span>{{ $item['suffix'] }}
                            </p>
                            <h3>{{ $item['label'] }}</h3>
                        </li>
                    @endforeach
                </ul>
                <div class="hfa-center">
                    <a href="#hero-form-section" class="hfa-btn hfa-btn--green hfa-btn--lg">
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="hfa-cta-bar" aria-labelledby="hfa-cta-bar-title">
            <div class="site-shell hfa-cta-bar__inner">
                <h2 id="hfa-cta-bar-title">
                    Transform Your Fund's Efficiency with Outsourced Hedge Fund and Private Equity Operations!
                </h2>
                <a href="#hero-form-section" class="hfa-btn hfa-btn--green">
                    Connect with Us
                </a>
            </div>
        </section>

        {{-- Software --}}
        <section class="hfa-section hfa-software" aria-labelledby="hfa-software-title">
            <div class="site-shell hfa-software__inner">
                <div class="hfa-software__copy">
                    <h2 id="hfa-software-title">Fund Administration and accounting: Simplified Financial Data and Analytics</h2>
                    <p>Boost Operational Efficiency with Our Expert Fund Software Solutions. Get Accurate, Real-Time Data for Smarter Investment Decisions.</p>
                </div>
                <div class="hfa-software__media">
                    <img
                        src="{{ $img('software-expertise.webp') }}"
                        alt="software logo"
                        width="1920"
                        height="825"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Onboard process --}}
        <section class="hfa-section hfa-onboard" aria-labelledby="hfa-onboard-title">
            <div class="site-shell">
                <div class="hfa-heading">
                    <h2 id="hfa-onboard-title">Onboard expert fund administration and accounting support now !</h2>
                </div>
                <img
                    class="hfa-onboard__image"
                    src="{{ $img('onboard-support.gif') }}"
                    alt="Onboard expert fund administration and accounting support"
                    width="1920"
                    height="880"
                    loading="lazy"
                    decoding="async"
                >
            </div>
        </section>

        {{-- What you get --}}
        <section class="hfa-section hfa-outcomes" aria-labelledby="hfa-outcomes-title">
            <div class="site-shell">
                <div class="hfa-heading">
                    <h2 id="hfa-outcomes-title">What You Get with Our Fund Operation Services</h2>
                </div>
                <ul class="hfa-outcomes__grid">
                    @foreach ($outcomeItems as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
                <div class="hfa-center">
                    <a href="#hero-form-section" class="hfa-btn hfa-btn--green hfa-btn--lg">
                        Talk To Our Experts
                    </a>
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="hfa-testimonials" aria-labelledby="hfa-testimonials-title">
            <div class="site-shell">
                <div class="hfa-heading hfa-heading--center">
                    <p class="hfa-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="hfa-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="hfa-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="hfa-testimonials__nav hfa-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="hfa-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="hfa-testimonial{{ $i === 0 ? ' is-active' : '' }}"
                                :class="{ 'is-active': index === {{ $i }} }"
                                :aria-hidden="index !== {{ $i }}"
                            >
                                <p>{{ $item['quote'] }}</p>
                                <cite>{{ $item['cite'] }}</cite>
                            </blockquote>
                        @endforeach
                    </div>

                    <button
                        type="button"
                        class="hfa-testimonials__nav hfa-testimonials__nav--next"
                        @click="next()"
                        aria-label="Next testimonial"
                    >
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>
    </div>
@endsection
