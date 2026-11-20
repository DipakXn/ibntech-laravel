@php
    $img = fn (string $file): string => asset('images/treasury-management-services-outsourcing/'.$file);
    $url = fn (string $slug): string => route('page.show', ['slug' => $slug]);

    $services = [
        [
            'icon' => 'finance-and-accounting-icon-1.webp',
            'icon_alt' => 'Finance and Accounting',
            'title' => 'Finance and Accounting',
            'href' => $url('finance-and-accounting-services'),
            'items' => [
                ['label' => 'Bookkeeping', 'href' => $url('bookkeeping-services')],
                ['label' => 'Payroll Processing', 'href' => $url('payroll-processing')],
                ['label' => 'Tax Preparation Support', 'href' => $url('us-uk-tax-preparation-services')],
                ['label' => 'AP/AR Services', 'href' => $url('accounts-payable-and-accounts-receivable-services')],
            ],
        ],
        [
            'icon' => 'intelligent-process-automation.webp',
            'icon_alt' => 'Intelligent Process Automation',
            'title' => 'Cash Management',
            'href' => '#',
            'items' => [
                ['label' => 'Analyzing global liquidity', 'href' => $url('intelligent-process-automation')],
                ['label' => 'Minimize external debt', 'href' => '#'],
                ['label' => 'Decreasing organization costs', 'href' => '#'],
                ['label' => 'Smooth cash flow management', 'href' => '#'],
            ],
        ],
        [
            'icon' => 'cfo-services-1.webp',
            'icon_alt' => 'CFO Services',
            'title' => 'Treasury Control',
            'href' => $url('treasury-management-services-outsourcing'),
            'items' => [
                ['label' => 'Virtual Assistance to CFOs', 'href' => $url('assistant-to-cfo-services')],
                ['label' => 'Virtual & Fractional CFO Services', 'href' => $url('assistant-to-cfo-services')],
                ['label' => 'Premium CFO Services', 'href' => $url('cfo-services')],
                ['label' => 'Reporting, Analysis, Planning', 'href' => $url('reporting-analysis-planning')],
            ],
        ],
        [
            'icon' => 'treasury-management.webp',
            'icon_alt' => 'Treasury Management',
            'title' => 'Treasury Control',
            'href' => $url('treasury-management-services-outsourcing'),
            'items' => [
                ['label' => 'Cash Management', 'href' => $url('treasury-management-services-outsourcing')],
                ['label' => 'Risk Management', 'href' => '#'],
                ['label' => 'Finance', 'href' => null],
                ['label' => 'Treasury Control', 'href' => null],
            ],
        ],
        [
            'icon' => 'hedge-fund-back-office-services.webp',
            'icon_alt' => 'Hedge Fund & Back Office Services',
            'title' => 'Hedge Fund & Back Office Services',
            'href' => '#',
            'items' => [
                ['label' => 'Fund Administration', 'href' => $url('hedgefund-administration')],
                ['label' => 'Fund Investor Reporting', 'href' => $url('fund-investor-reporting')],
                ['label' => 'Fund Accounting Services', 'href' => $url('fund-accounting-services')],
            ],
        ],
        [
            'icon' => 'it-services.webp',
            'icon_alt' => 'IT Services',
            'title' => 'Risk Management',
            'href' => '#',
            'items' => [
                ['label' => 'Credit Risk', 'href' => $url('it-services')],
                ['label' => 'Country Risk', 'href' => null],
                ['label' => 'Accounting Risk (FASB and IFRS / IAS)', 'href' => null],
                ['label' => 'Commodity Price Risk', 'href' => 'https://www.cloudibn.com/'],
            ],
        ],
    ];

    $testimonials = \App\Support\Testimonials\Testimonials::cites('treasury-management-services-outsourcing');
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/treasury-management-services-outsourcing.css'])
@endpush

@section('content')
    <div class="tmso-page">
        {{-- Hero --}}
        <section class="tmso-hero" aria-labelledby="tmso-hero-title">
            <div class="site-shell tmso-hero__inner">
                <div class="tmso-hero__copy">
                    <h1 id="tmso-hero-title">Outsource Treasury Management Services</h1>
                    <div class="tmso-hero__actions">
                        <a href="{{ $url('contact-us') }}" class="tmso-btn tmso-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="tmso-hero__media">
                    <img
                        src="{{ $img('bookkeeping-for-marketing-and-advertising-companies.webp') }}"
                        alt="bookkeeping for marketing and advertising companies"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="tmso-section" aria-labelledby="tmso-intro-title">
            <div class="site-shell tmso-intro">
                <div class="tmso-intro__media">
                    <img
                        src="{{ $img('management-services.webp') }}"
                        alt="management services"
                        width="556"
                        height="633"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="tmso-intro__copy">
                    <h2 id="tmso-intro-title">Outsource Treasury Management Services</h2>
                    <p>Treasury management services focus on business liquidity while managing financial assets, cash and investments of an organization. Treasury is increasingly recognized as a business-critical function, as every organization needs to establish and optimize the most appropriate systems and processes to mitigate risks.</p>
                    <p>As an Accounting, Middle and Back Office service provider to US and UK businesses, IBN has adequate knowledge of US GAAP's &amp; IFRS and can provide qualitative, offshore and outsourced treasury management services as per business requirements.</p>
                    <p>When clients outsource treasury management services, they benefit from years of IBN’s experience and a team of finance and accounting experts who help define goals, objectives, treasury strategy, develop required policies and much more in an efficient and cost-effective manner. Whether planning to set up an organization, build Infrastructure, structure required processes, or looking at acquisitions, mergers, dividends distributions and fund raising, IBN is your go-to partner for outsourcing treasury management services.</p>
                </div>
            </div>
        </section>

        {{-- Case study CTA --}}
        <section class="tmso-banner" aria-labelledby="tmso-banner-title">
            <div class="site-shell tmso-banner__inner">
                <h2 id="tmso-banner-title">Download a Case Study on Our Treasury Management Services</h2>
                <a
                    href="{{ route('case-studies.show', ['slug' => 'treasury-operations-for-pennsylvania-based-company']) }}"
                    class="tmso-btn tmso-btn--green"
                >
                    Free Download
                </a>
            </div>
        </section>

        {{-- Our Services --}}
        <section class="tmso-section" aria-labelledby="tmso-services-title">
            <div class="site-shell">
                <div class="tmso-heading tmso-heading--center">
                    <h2 id="tmso-services-title">Our Services</h2>
                </div>

                <div class="tmso-services">
                    @foreach ($services as $service)
                        <article class="tmso-card">
                            <a
                                href="{{ $service['href'] }}"
                                class="tmso-card__icon"
                                tabindex="-1"
                            >
                                <img
                                    src="{{ $img($service['icon']) }}"
                                    alt="{{ $service['icon_alt'] }}"
                                    width="65"
                                    height="65"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </a>
                            <h3>
                                <a href="{{ $service['href'] }}">{{ $service['title'] }}</a>
                            </h3>
                            <ul>
                                @foreach ($service['items'] as $item)
                                    <li>
                                        @if (!empty($item['href']))
                                            <a href="{{ $item['href'] }}">{{ $item['label'] }}</a>
                                        @else
                                            <span>{{ $item['label'] }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="tmso-testimonials" aria-labelledby="tmso-testimonials-title">
            <div class="site-shell">
                <div class="tmso-heading tmso-heading--center">
                    <p class="tmso-testimonials__eyebrow">Discover Why IBN Tech is the</p>
                    <h2 id="tmso-testimonials-title">Best Bookkeeping Firms in the USA</h2>
                </div>

                <div
                    class="tmso-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.total > 0 ? (this.index - 1 + this.total) % this.total : 0); },
                        next() { this.index = (this.total > 0 ? (this.index + 1) % this.total : 0); }
                    }"
                >
                    <button
                        type="button"
                        class="tmso-testimonials__nav tmso-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="tmso-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="tmso-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="tmso-testimonials__nav tmso-testimonials__nav--next"
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
