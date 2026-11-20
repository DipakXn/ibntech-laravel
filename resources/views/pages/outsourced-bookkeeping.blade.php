@php
    $img = fn (string $file): string => asset('images/outsourced-bookkeeping/'.$file);

    $reasons = [
        [
            'icon' => 'certified-experts.webp',
            'alt' => 'certified experts',
            'title' => 'Certified Experts',
            'text' => '120+ bookkeepers with 27+ years of experience.',
        ],
        [
            'icon' => 'save-70-on-costs.webp',
            'alt' => 'save 70% on costs',
            'title' => 'Save 70% on Costs',
            'text' => 'Reduce costs with efficient offshore solutions.',
        ],
        [
            'icon' => 'industry-specific.webp',
            'alt' => 'industry-specific',
            'title' => 'Industry-Specific',
            'text' => 'Tailored for real estate, retail, ecommerce, healthcare, and more.',
        ],
        [
            'icon' => '99-accuracy.webp',
            'alt' => '99% accuracy',
            'title' => '99% Accuracy',
            'text' => 'Real-time insights with 20+ accounting software integrations.',
        ],
        [
            'icon' => 'trusted-by-1500-clients.webp',
            'alt' => 'trusted by 1500+ clients',
            'title' => 'Trusted by 1500+ Clients',
            'text' => 'Join businesses worldwide who rely on us.',
        ],
        [
            'icon' => '24-7-support.webp',
            'alt' => '24-7 support',
            'title' => '24/7 Support',
            'text' => 'Access our global team of experts and AI assistants whenever you need help.',
        ],
    ];

    $stats = [
        ['value' => '27+', 'label' => 'Years of Success', 'tone' => 'light'],
        ['value' => '1500+', 'label' => "Active Client's", 'tone' => 'dark'],
        ['value' => '50M', 'label' => 'Transaction Processed', 'tone' => 'light'],
        ['value' => '50+', 'label' => 'Software Expertise', 'tone' => 'dark'],
    ];

    $services = [
        [
            'icon' => 'invoicing-expense-tracking.webp',
            'alt' => 'invoicing & expense tracking',
            'title' => 'Invoicing & expense tracking',
        ],
        [
            'icon' => 'bank-credit-card-reconciliation.webp',
            'alt' => 'bank & credit card reconciliation',
            'title' => 'Bank & credit card reconciliation',
        ],
        [
            'icon' => 'payroll-processing.webp',
            'alt' => 'payroll processing',
            'title' => 'Payroll Processing',
        ],
        [
            'icon' => 'cash-flow.webp',
            'alt' => 'cash flow',
            'title' => 'Cash Flow Forecasting',
        ],
        [
            'icon' => 'receivables-payables-management-1.webp',
            'alt' => 'receivables payables management',
            'title' => 'Receivables / payables management',
        ],
        [
            'icon' => 'financial-reporting-tax-compliance-1.webp',
            'alt' => 'financial reporting & tax compliance',
            'title' => 'Financial reporting & tax compliance',
        ],
    ];

    $transactionVolumes = [
        '0-50 transactions',
        '51-150 transactions',
        '151-250 transactions',
        '251-500 transactions',
        '500+ transactions',
    ];

    $plans = [
        [
            'name' => 'Basic Plan',
            'price' => '150',
            'yearly' => '$120/mo if billed yearly',
            'tagline' => 'Perfect for growing businesses',
            'features' => [
                ['text' => 'Up to 150 transactions/month', 'included' => true],
                ['text' => 'Easy-to-use platform', 'included' => true],
                ['text' => 'Free consultation included', 'included' => true],
                ['text' => 'Monthly Profit & Loss Report', 'included' => true],
                ['text' => 'Monthly Balance Sheet', 'included' => false],
            ],
        ],
        [
            'name' => 'Intermediate Plan',
            'price' => '349',
            'yearly' => '$300/mo if billed yearly',
            'tagline' => 'Ideal for established businesses',
            'features' => [
                ['text' => 'Up to 750 transactions/month', 'included' => true],
                ['text' => 'Easy-to-use platform', 'included' => true],
                ['text' => 'Free consultation included', 'included' => true],
                ['text' => 'Monthly Profit & Loss Report', 'included' => true],
                ['text' => 'Monthly Balance Sheet', 'included' => true],
            ],
        ],
    ];

    $testimonials = \App\Support\Testimonials\Testimonials::cards('outsourced-bookkeeping');
@endphp

@extends('layouts.app')

@push('styles')
    @vite([
        'resources/css/pages/home.css',
        'resources/css/pages/outsourced-bookkeeping.css',
    ])
@endpush

@section('content')
    <div class="osbk-page">
        <section class="osbk-hero" aria-labelledby="osbk-hero-title">
            <div class="site-shell osbk-hero__inner">
                <div class="osbk-hero__copy">
                    <h1 id="osbk-hero-title">Expert Bookkeeping to Fuel Your Business Growth</h1>
                    <p class="osbk-hero__lede">
                        Ditch time-consuming bookkeeping. IBN Tech's outsourced services save up to 70% on costs, streamline financials, and let you focus on scaling your business.
                    </p>
                </div>

                <aside class="osbk-hero__form" id="contact-us-section" aria-label="Request a quote">
                    <livewire:forms.contact-form
                        form-name="outsourced-bookkeeping"
                        id-prefix="osbk"
                        layout="home"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$transactionVolumes"
                        service-placeholder="Select transaction volume"
                        message-placeholder="Describe your current bookkeeping needs and the support you're looking for."
                        submit-label="Submit"
                        :message-rows="4"
                        thank-you-url="/thanks-you-for-bookkeeping/"
                    />
                </aside>
            </div>
        </section>

        <section class="osbk-why" aria-labelledby="osbk-why-title">
            <div class="site-shell">
                <div class="osbk-section-head">
                    <h2 id="osbk-why-title">Why IBN Tech?</h2>
                    <p>
                        Join the financial revolution with our <strong>Outsourced Bookkeeping Services</strong> designed for the modern business landscape.
                    </p>
                </div>

                <div class="osbk-why__grid">
                    @foreach ($reasons as $item)
                        <article class="osbk-why__card">
                            <img
                                src="{{ $img($item['icon']) }}"
                                alt="{{ $item['alt'] }}"
                                width="52"
                                height="52"
                                loading="lazy"
                            >
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="osbk-stats__grid" role="group" aria-label="Company statistics">
                    @foreach ($stats as $stat)
                        <article class="osbk-stats__card osbk-stats__card--{{ $stat['tone'] }}">
                            <strong>{{ $stat['value'] }}</strong>
                            <span>{{ $stat['label'] }}</span>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="osbk-services" aria-labelledby="osbk-services-title">
            <div class="site-shell">
                <div class="osbk-section-head osbk-section-head--light">
                    <h2 id="osbk-services-title">Our Services</h2>
                    <p>Comprehensive bookkeeping solutions tailored for modern businesses</p>
                </div>

                <div class="osbk-services__grid">
                    @foreach ($services as $service)
                        <article class="osbk-services__card">
                            <img
                                src="{{ $img($service['icon']) }}"
                                alt="{{ $service['alt'] }}"
                                width="52"
                                height="52"
                                loading="lazy"
                            >
                            <h3>{{ $service['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="osbk-plans" aria-labelledby="osbk-plans-title">
            <div class="site-shell">
                <div class="osbk-section-head">
                    <h2 id="osbk-plans-title">Choose Your Plan</h2>
                    <p>Flexible pricing options designed to scale with your business needs.</p>
                </div>

                <div class="osbk-plans__grid">
                    @foreach ($plans as $plan)
                        <article class="osbk-plan">
                            <div class="osbk-plan__head">
                                <h3>{{ $plan['name'] }}</h3>
                                <p class="osbk-plan__price">
                                    ${{ $plan['price'] }}<span>/month</span>
                                </p>
                                <p class="osbk-plan__yearly">{{ $plan['yearly'] }}</p>
                                <p class="osbk-plan__tagline">{{ $plan['tagline'] }}</p>
                            </div>
                            <div class="osbk-plan__body">
                                <ul>
                                    @foreach ($plan['features'] as $feature)
                                        <li @class(['is-excluded' => ! $feature['included']])>
                                            <span class="osbk-plan__icon" aria-hidden="true">
                                                <i class="fa-solid {{ $feature['included'] ? 'fa-check' : 'fa-square-xmark' }}"></i>
                                            </span>
                                            <span>{{ $feature['text'] }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <a class="osbk-plan__cta" href="#contact-us-section">Get a Quote</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <x-home.testimonials
            :items="$testimonials"
            title="Client Testimonial"
            subtitle="We redefine possibilities, helping you gain fresh perspectives, uncover new opportunities, and achieve remarkable results that transform aspirations into reality."
        />

        <section class="osbk-cta" aria-labelledby="osbk-cta-title">
            <div class="site-shell osbk-cta__inner">
                <h2 id="osbk-cta-title">Ready to Transform Your Finances?</h2>
                <p>Join 1500+ businesses who trust IBN Tech for their bookkeeping needs. Get started with a free consultation today.</p>
                <a class="osbk-cta__btn" href="#contact-us-section">Get Free Consultation</a>
            </div>
        </section>
    </div>
@endsection
