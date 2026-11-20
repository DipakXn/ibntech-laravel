@php
    $img = fn (string $file): string => asset('images/finance-and-accounting-services/'.$file);
    $consult = '#fas-consult';
    $contactUrl = route('page.show', ['slug' => 'contact-us']);

    $formServiceOptions = [
        'Bookkeeping',
        'Payroll Services',
        'Tax Support',
        'Accounts Receivable & Payable',
        'Strategic Financial Management',
    ];

    $benefits = [
        [
            'title' => 'Save Up to 70% on Operational Costs',
            'text' => 'Our expert team leverages cutting-edge automation to optimize your financial processes—without the hefty price tag of an in-house staff.',
            'icon' => 'cost',
        ],
        [
            'title' => 'Accuracy You Can Trust',
            'text' => 'Say goodbye to errors. Our certified bookkeepers and AI-driven tools ensure 100% precision in your books, payroll, and tax prep.',
            'icon' => 'accuracy',
        ],
        [
            'title' => 'Get Paid Faster',
            'text' => 'Struggling with cash flow? Our accounts receivable services streamline invoicing and collections, reducing delays and improving liquidity.',
            'icon' => 'time',
        ],
        [
            'title' => 'Stress-Free Compliance',
            'text' => 'From tax documentation to payroll regulations, we keep you compliant and audit-ready—so you can sleep easy.',
            'icon' => 'compliance',
        ],
        [
            'title' => 'Scalable Solutions',
            'text' => 'Whether you\'re a small business or a growing enterprise, our flexible services adapt to your needs, no matter the size.',
            'icon' => 'scale',
        ],
        [
            'title' => '99% Client Retention Rate',
            'text' => 'Join thousands of businesses across the USA, UK, Middle East, and India who trust IBN Technologies to transform their finances.',
            'icon' => 'retention',
        ],
    ];

    $services = [
        [
            'image' => 'bookkeeping.webp',
            'alt' => 'bookkeeping',
            'title' => 'Bookkeeping Made Simple',
            'text' => 'Overwhelmed by data entry and financial reporting? Outsource to us and get accurate, timely insights that drive smarter decisions.',
            'cta' => 'Start with a Free Consultation',
            'href' => $consult,
        ],
        [
            'image' => 'payroll.webp',
            'alt' => 'payroll',
            'title' => 'Payroll That Runs Itself',
            'text' => 'Ditch the manual headaches. Our automated payroll solutions handle compliance, benefits, and reporting—ensuring your team gets paid on time, every time.',
            'cta' => 'Get a Demo Now',
            'href' => $consult,
        ],
        [
            'image' => 'tax-support.webp',
            'alt' => 'tax support',
            'title' => 'Tax Support That Saves You Money',
            'text' => 'Tax season doesn\'t have to be taxing. We streamline documentation and collaborate with your advisors to maximize efficiency and deductions.',
            'cta' => 'Claim Your Free Tax Review',
            'href' => $consult,
        ],
        [
            'image' => 'accounts-receivable-payable.webp',
            'alt' => 'accounts receivable & payable',
            'title' => 'Accounts Receivable & Payable Mastery',
            'text' => 'Boost cash flow and vendor relationships with our AI-powered invoice processing and payment management. See how we can cut your costs by 50%.',
            'cta' => 'Contact Us Today',
            'href' => $consult,
        ],
        [
            'image' => 'financial-management.webp',
            'alt' => 'financial management',
            'title' => 'Strategic Financial Management',
            'text' => 'Need more than just number-crunching? Our automated financial tools provide real-time insights to fuel your growth strategy.',
            'cta' => 'Unlock Your Financial Potential',
            'href' => $contactUrl,
        ],
    ];

    $stats = [
        ['value' => 70, 'suffix' => '%', 'label' => 'Cost Savings on Financial Operations'],
        ['value' => 99, 'suffix' => '%', 'label' => 'Client Retention Rate'],
        ['value' => 26, 'suffix' => '+', 'label' => 'Years of Industry Experience'],
    ];

    $testimonials = \App\Support\Testimonials\Testimonials::cards('finance-and-accounting-services');

    $testimonialPages = array_chunk($testimonials, 2);
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/finance-and-accounting-services.css'])
@endpush

@section('content')
    <div class="fas-page">
        <section class="fas-hero" aria-labelledby="fas-hero-title">
            <div class="site-shell fas-hero__inner">
                <h1 id="fas-hero-title">Take Control of Your Finances with IBN Technologies</h1>
                <p>
                    <strong>Are you tired of juggling complex financial tasks, chasing overdue invoices, or worrying about payroll compliance?</strong>
                    At IBN Technologies, we turn your finance and accounting challenges into opportunities for growth. With over 26 years of expertise, we deliver tailored outsourcing solutions that save you time, cut costs, and boost your bottom line. Ready to streamline your finances and focus on what really matters—growing your business? Let’s make it happen.
                </p>
                <div class="fas-hero__actions">
                    <a href="{{ $consult }}" class="fas-btn fas-btn--light">Book Free Consultation</a>
                    <a href="#services-section" class="fas-btn fas-btn--ghost">Explore Services</a>
                </div>
            </div>
        </section>

        <section class="fas-benefits" id="benefits" aria-labelledby="fas-benefits-title">
            <div class="site-shell">
                <div class="fas-intro">
                    <h2 id="fas-benefits-title">Why Choose IBN for Your Finance &amp; Accounting Needs?</h2>
                    <p>We transform your financial challenges into opportunities for growth, saving you time and money.</p>
                </div>
                <div class="fas-benefits__grid">
                    @foreach ($benefits as $benefit)
                        <article class="fas-benefit">
                            <span class="fas-benefit__icon" aria-hidden="true">
                                @switch($benefit['icon'])
                                    @case('cost')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"></path>
                                            <path d="M12 18V6"></path>
                                        </svg>
                                        @break
                                    @case('accuracy')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <path d="m9 11 3 3L22 4"></path>
                                        </svg>
                                        @break
                                    @case('time')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                        @break
                                    @case('compliance')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        @break
                                    @case('scale')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 3v18h18"></path>
                                            <path d="m19 9-5 5-4-4-3 3"></path>
                                        </svg>
                                        @break
                                    @default
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                @endswitch
                            </span>
                            <h3>{{ $benefit['title'] }}</h3>
                            <p>{{ $benefit['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="fas-services" id="services-section" aria-labelledby="fas-services-title">
            <div class="site-shell">
                <div class="fas-intro">
                    <h2 id="fas-services-title">Our Proven Finance &amp; Accounting Services</h2>
                    <p>Comprehensive solutions tailored to your business needs</p>
                </div>

                <div class="fas-services__list">
                    @foreach ($services as $index => $service)
                        <article class="fas-service{{ $index % 2 === 1 ? ' fas-service--reverse' : '' }}">
                            <div class="fas-service__media">
                                <img
                                    src="{{ $img($service['image']) }}"
                                    alt="{{ $service['alt'] }}"
                                    width="970"
                                    height="610"
                                    @if ($index === 0) fetchpriority="high" @else loading="lazy" @endif
                                    decoding="async"
                                >
                            </div>
                            <div class="fas-service__copy">
                                <h3>{{ $service['title'] }}</h3>
                                <p>{{ $service['text'] }}</p>
                                <a href="{{ $service['href'] }}" class="fas-btn fas-btn--navy">{{ $service['cta'] }}</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section
            class="fas-stats"
            aria-labelledby="fas-stats-title"
            x-data="{
                started: false,
                values: [0, 0, 0],
                targets: [{{ implode(',', array_column($stats, 'value')) }}],
                start() {
                    if (this.started) {
                        return;
                    }
                    this.started = true;
                    const duration = 1400;
                    this.targets.forEach((target, index) => {
                        const begin = performance.now();
                        const tick = (now) => {
                            const progress = Math.min((now - begin) / duration, 1);
                            const eased = 1 - Math.pow(1 - progress, 3);
                            this.values[index] = Math.round(target * eased);
                            if (progress < 1) {
                                requestAnimationFrame(tick);
                            }
                        };
                        requestAnimationFrame(tick);
                    });
                }
            }"
            x-init="
                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    values = [...targets];
                    started = true;
                    return;
                }
                const observer = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        start();
                        observer.disconnect();
                    }
                }, { threshold: 0.35 });
                observer.observe($el);
            "
        >
            <div class="site-shell">
                <div class="fas-intro fas-intro--light">
                    <h2 id="fas-stats-title">Real Results, Real Impact</h2>
                    <p>Join thousands of businesses across the USA, UK, Middle East, and India who trust IBN Technologies to transform their finances.</p>
                </div>
                <div class="fas-stats__grid">
                    @foreach ($stats as $index => $stat)
                        <div class="fas-stat">
                            <p class="fas-stat__value">
                                <span x-text="values[{{ $index }}]">0</span>{{ $stat['suffix'] }}
                            </p>
                            <h3>{{ $stat['label'] }}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section
            class="fas-testimonials"
            aria-labelledby="fas-testimonials-title"
            x-data="{
                index: 0,
                total: {{ count($testimonialPages) }},
                go(i) { this.index = i; },
                next() { this.index = (this.total > 0 ? (this.index + 1) % this.total : 0); },
                prev() { this.index = (this.total > 0 ? (this.index - 1 + this.total) % this.total : 0); }
            }"
        >
            <div class="site-shell">
                <div class="fas-intro">
                    <h2 id="fas-testimonials-title">What Our Clients Say</h2>
                    <p>Don't just take our word for it. Here's what our clients have to say about working with IBN Technologies.</p>
                </div>

                <div class="fas-testimonials__carousel">
                    <div class="fas-testimonials__viewport">
                        <div
                            class="fas-testimonials__track"
                            :style="`transform: translateX(-${index * 100}%)`"
                        >
                            @foreach ($testimonialPages as $pageIndex => $page)
                                <div
                                    class="fas-testimonials__page"
                                    :aria-hidden="index !== {{ $pageIndex }} ? 'true' : 'false'"
                                >
                                    @foreach ($page as $item)
                                        <article class="fas-quote">
                                            <div class="fas-quote__head">
                                                <img
                                                    src="{{ $img('clutch-co-logo.webp') }}"
                                                    alt="{{ $item['name'] }}"
                                                    width="72"
                                                    height="72"
                                                    loading="lazy"
                                                    decoding="async"
                                                >
                                                <div>
                                                    <h3>{{ $item['name'] }}</h3>
                                                    <p>{{ $item['role'] }}</p>
                                                </div>
                                            </div>
                                            <p class="fas-quote__stars" aria-label="5 out of 5 stars">
                                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                                            </p>
                                            <blockquote>
                                                <p>“{{ $item['quote'] }}”</p>
                                            </blockquote>
                                        </article>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="fas-testimonials__dots" role="tablist" aria-label="Testimonial slides">
                        @foreach ($testimonialPages as $pageIndex => $page)
                            <button
                                type="button"
                                role="tab"
                                class="fas-testimonials__dot"
                                :class="{ 'is-active': index === {{ $pageIndex }} }"
                                :aria-selected="index === {{ $pageIndex }} ? 'true' : 'false'"
                                aria-label="Show testimonials {{ ($pageIndex * 2) + 1 }} and {{ min(($pageIndex * 2) + 2, count($testimonials)) }}"
                                @click="go({{ $pageIndex }})"
                            ></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="fas-consult" id="fas-consult" aria-labelledby="fas-consult-title">
            <div class="site-shell">
                <div class="fas-intro fas-intro--light">
                    <h2 id="fas-consult-title">Ready to Simplify Your Finances and Accelerate Growth?</h2>
                    <p>Don't let financial chaos hold your business back. Take the first step toward efficiency, savings, and peace of mind.</p>
                </div>
                <div class="fas-consult__card">
                    <h3>Book Your Free Consultation Now</h3>
                    <livewire:forms.contact-form
                        form-name="finance-and-accounting-services"
                        id-prefix="fas"
                        layout="home"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$formServiceOptions"
                        service-placeholder="Please Select Services"
                        message-placeholder="How can we help your business?"
                        submit-label="Book Your Free Consultation"
                        :message-rows="4"
                        wire:key="finance-and-accounting-services-consult"
                    />
                </div>
            </div>
        </section>
    </div>
@endsection
