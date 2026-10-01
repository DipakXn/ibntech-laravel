@php
    $img = fn (string $file): string => asset('images/healthcare-bookkeeping-services/'.$file);

    $heroServiceOptions = [
        'Bookkeeping Services',
        'Accounting Services',
        'Payroll Processing',
        'Accounts Payable and Receivable',
        'Tax Preparation Support',
        'Financial Reporting',
        'Controller Services',
    ];

    $cfoServices = [
        [
            'title' => 'Patient Registration and Insurance Verification',
            'text' => 'Start the cycle with thorough checks and accurate data capture.',
        ],
        [
            'title' => 'Claim Submission and Denial Management',
            'text' => 'Our timely and persistent claim follow-ups mean fewer denials and quicker resolutions.',
        ],
        [
            'title' => 'Payment Posting and Reconciliation',
            'text' => 'Ensure accuracy in your financial records with our meticulous posting and reconciliation services.',
        ],
        [
            'title' => 'Reporting',
            'text' => 'Make informed decisions with comprehensive financial reports and actionable insights.',
        ],
    ];

    $bookkeepingServices = [
        [
            'icon' => 'invoice-generation.png',
            'alt' => 'Invoice generation',
            'title' => 'Account Reconciliations',
            'text' => 'Keep your books accurate and up-to-date with our diligent account reconciliation services.',
        ],
        [
            'icon' => 'liaison-with-tax-advisors.png',
            'alt' => 'Liaison with tax advisors',
            'title' => 'Payroll Processing',
            'text' => 'Ensure your staff is paid on time and your payroll taxes are handled correctly',
        ],
        [
            'icon' => 'invoice-generation.png',
            'alt' => 'Invoice generation',
            'title' => 'Financial Reporting',
            'text' => 'Gain clarity on your financial performance with detailed monthly reports.',
        ],
        [
            'icon' => 'automatic-invoice-processing-and-payment.png',
            'alt' => 'Automatic Invoice Processing and Payment',
            'title' => 'Cash Flow Management',
            'text' => 'Keep your operations running smoothly with effective cash flow strategies',
        ],
    ];

    $techPoints = [
        [
            'title' => 'Automated Data Entry:',
            'text' => 'Our automated systems ensure data accuracy by reducing errors.',
        ],
        [
            'title' => 'Secure Cloud Storage:',
            'text' => 'Access your financial data anytime, anywhere, with our secure cloud-based solutions.',
        ],
        [
            'title' => 'Integrated Platforms:',
            'text' => 'Enjoy the convenience of integrated systems that connect your clinical and financial data seamlessly.',
        ],
    ];

    $compliancePoints = [
        [
            'title' => 'Adhering to HIPAA Guidelines:',
            'text' => 'We ensure all processes comply with HIPAA regulations, protecting patient privacy and your practice\'s reputation.',
        ],
        [
            'title' => 'Maintaining Confidentiality:',
            'text' => 'Your financial data is treated with the utmost confidentiality and security measures.',
        ],
    ];

    $stats = [
        ['value' => '27+', 'label' => 'Years of Success', 'tone' => 'light'],
        ['value' => '120+', 'label' => 'Certified Accountant', 'tone' => 'navy'],
        ['value' => '1500+', 'label' => 'Clients Served', 'tone' => 'light'],
        ['value' => '99.99 %', 'label' => 'Accuracy Achieved', 'tone' => 'navy'],
    ];

    $partners = [
        ['file' => 'netsuite.webp', 'alt' => 'netsuite', 'width' => 300, 'height' => 154],
        ['file' => 'quickbooks.webp', 'alt' => 'quickbooks', 'width' => 300, 'height' => 154],
        ['file' => 'quicken.webp', 'alt' => 'Quicken', 'width' => 381, 'height' => 75],
        ['file' => 'sage50.webp', 'alt' => 'sage50', 'width' => 300, 'height' => 154],
        ['file' => 'xero.webp', 'alt' => 'xero software for small business', 'width' => 300, 'height' => 154],
    ];

    $areasColumns = [
        [
            ['label' => 'California', 'slug' => 'bookkeeping-services-california'],
            ['label' => 'San Francisco', 'slug' => 'bookkeeping-services-san-francisco'],
            ['label' => 'Los Angeles', 'slug' => 'bookkeeping-services-los-angeles'],
            ['label' => 'San Diego', 'slug' => 'bookkeeping-services-san-diego'],
            ['label' => 'Las Vegas', 'slug' => 'bookkeeping-services-las-vegas'],
        ],
        [
            ['label' => 'San Jose', 'slug' => 'bookkeeping-services-san-jose'],
            ['label' => 'Chicago', 'slug' => 'bookkeeping-services-chicago'],
            ['label' => 'New York', 'slug' => 'bookkeeping-services-new-york'],
            ['label' => 'Florida', 'slug' => 'bookkeeping-services-florida'],
            ['label' => 'Texas', 'slug' => 'bookkeeping-services-texas'],
        ],
        [
            ['label' => 'Vermont', 'slug' => 'bookkeeping-services-vermont'],
            ['label' => 'Hartford', 'slug' => 'bookkeeping-services-hartford'],
            ['label' => 'Austin', 'slug' => 'bookkeeping-services-austin'],
            ['label' => 'Phoenix', 'slug' => 'bookkeeping-services-phoenix'],
        ],
    ];

    $testimonials = [
        [
            'quote' => 'We are now entering the fourth year of our relationship with IBN. This has been a hugely rewarding and valuable transaction for us with IBN as they are now responsible for',
            'cite' => 'David Barber',
        ],
        [
            'quote' => 'IBN financial support is a top-class accounting services outsourcer. They act with speed in getting work done, and mobilizing additional resources as needed. Their greatest strength is pro-active communication with clients. I consider IBN a strong partner."',
            'cite' => 'Salman Ghani',
        ],
        [
            'quote' => 'After approaching IBN with a complex and bespoke requirement, I’ve been impressed with the professionalism and knowledge of my technical contact and other',
            'cite' => 'DANIEL SCOTT',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/healthcare-bookkeeping-services.css'])
@endpush

@section('content')
    <div class="hcbk-page">
        {{-- Hero --}}
        <section class="hcbk-hero" aria-labelledby="hcbk-hero-title">
            <div class="site-shell hcbk-hero__inner">
                <div class="hcbk-hero__copy">
                    <p class="hcbk-hero__eyebrow">Achieve financial clarity and efficiency with IBN Tech’s</p>
                    <h1 id="hcbk-hero-title">Outsource Healthcare Bookkeeping Services</h1>
                    <p class="hcbk-hero__lede">
                        Our expert team simplifies your healthcare practice's financial management, optimizing revenue while maintaining cost-effectiveness.
                    </p>
                </div>

                <aside class="hcbk-hero__form" id="contact-us" aria-labelledby="hcbk-hero-form-title">
                    <h2 id="hcbk-hero-form-title">Want to Improve Your Accounting ?</h2>
                    <p class="hcbk-hero__form-sub">Submit the Form to Get Started!</p>

                    <livewire:forms.contact-form
                        form-name="healthcare-bookkeeping-services"
                        id-prefix="hcbk"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$heroServiceOptions"
                        service-placeholder="Please Select Services"
                        message-placeholder="What kind of accounting solution are you looking for?"
                        submit-label="Submit"
                        layout="home"
                    />
                </aside>
            </div>
        </section>

        {{-- Intro --}}
        <section class="hcbk-section" aria-labelledby="hcbk-intro-title">
            <div class="site-shell hcbk-intro">
                <div class="hcbk-intro__media">
                    <img
                        src="{{ $img('business-owners.webp') }}"
                        alt="Business Owners"
                        width="650"
                        height="433"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>

                <div class="hcbk-intro__copy">
                    <h2 id="hcbk-intro-title">IBN Tech</h2>
                    <p>
                        We recognize that healthcare providers prioritize patient well-being above all else. Yet, the financial and operational aspects of your practice are crucial for delivering top-tier care. Healthcare bookkeeping can be challenging, even for the most experienced providers. With so many regulations and reimbursement models to understand, it can be easy to fall behind.
                        Our specialized Healthcare Bookkeeping Services are meticulously designed to manage your revenue cycle, reduce administrative burdens, and ensure compliance, allowing you to focus on what you do best caring for patients.
                    </p>
                </div>
            </div>
        </section>

        {{-- Virtual CFO Services --}}
        <section class="hcbk-section" aria-labelledby="hcbk-cfo-title">
            <div class="site-shell">
                <div class="hcbk-heading">
                    <h2 id="hcbk-cfo-title">Virtual CFO Services</h2>
                    <p class="hcbk-heading__lede">Seamless Integration with Your Financial Operations</p>
                </div>

                <div class="hcbk-cfo">
                    <div class="hcbk-cfo__accordion hcbk-faq">
                        @foreach ($cfoServices as $i => $service)
                            <details name="hcbk-cfo" @if ($i === 0) open @endif>
                                <summary>
                                    <span>{{ $service['title'] }}</span>
                                </summary>
                                <div>{{ $service['text'] }}</div>
                            </details>
                        @endforeach
                    </div>

                    <div class="hcbk-cfo__media">
                        <img
                            src="{{ $img('outsourcing-accounting.webp') }}"
                            alt="Outsourcing-Accounting-final"
                            width="550"
                            height="279"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Outsourced Bookkeeping Services --}}
        <section class="hcbk-section" aria-labelledby="hcbk-services-title">
            <div class="site-shell">
                <div class="hcbk-heading">
                    <h2 id="hcbk-services-title">Outsourced Bookkeeping Services</h2>
                    <h3>Customized for Your Unique Needs</h3>
                    <p>
                        Whether you run a small clinic or a large healthcare institution, our
                        <a href="{{ route('page.show', ['slug' => 'bookkeeping-services']) }}"><strong>bookkeeping services</strong></a>
                        are tailored to meet your specific needs. We offer:
                    </p>
                </div>

                <div class="hcbk-benefits" role="list">
                    @foreach ($bookkeepingServices as $item)
                        <article class="hcbk-benefit" role="listitem">
                            <figure class="hcbk-benefit__icon">
                                <img
                                    src="{{ $img($item['icon']) }}"
                                    alt="{{ $item['alt'] }}"
                                    width="118"
                                    height="93"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </figure>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- CTA banner --}}
        <section class="hcbk-cta-banner" aria-labelledby="hcbk-cta-title">
            <div class="site-shell hcbk-cta-banner__inner">
                <p id="hcbk-cta-title">Your vendors will thank you, and so will your finance team</p>
                <a href="{{ route('page.show', ['slug' => 'free-consultation']) }}" class="hcbk-btn hcbk-btn--green">
                    Free Consultation
                </a>
            </div>
        </section>

        {{-- Technology-Driven Efficiency --}}
        <section class="hcbk-section" aria-labelledby="hcbk-tech-title">
            <div class="site-shell hcbk-split">
                <div class="hcbk-split__media">
                    <img
                        src="{{ $img('technology-driven-efficiency.webp') }}"
                        alt="Technology-Driven Efficiency"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="hcbk-split__copy">
                    <p class="hcbk-eyebrow">Technology-Driven Efficiency</p>
                    <h2 id="hcbk-tech-title">Leverage Cutting-Edge Tools for Enhanced Accuracy</h2>
                    <p>
                        Technology is at the core of our bookkeeping services. We utilize advanced software and tools to provide you with:
                    </p>
                    @foreach ($techPoints as $point)
                        <p>
                            <strong>{{ $point['title'] }}</strong> {{ $point['text'] }}
                        </p>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Compliance and Confidentiality --}}
        <section class="hcbk-section" aria-labelledby="hcbk-compliance-title">
            <div class="site-shell hcbk-split">
                <div class="hcbk-split__copy">
                    <h2 id="hcbk-compliance-title">Compliance and Confidentiality</h2>
                    <p class="hcbk-subhead">Your Data's Security, Our Priority</p>
                    <p>
                        We take the responsibility of handling your sensitive financial data seriously. Our team is committed to:
                    </p>
                    @foreach ($compliancePoints as $point)
                        <p>
                            <strong>{{ $point['title'] }}</strong> {{ $point['text'] }}
                        </p>
                    @endforeach
                </div>
                <div class="hcbk-split__media">
                    <img
                        src="{{ $img('compliance-and-confidentiality.webp') }}"
                        alt="compliance and confidentiality"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- What Makes IBN Tech --}}
        <section class="hcbk-section" aria-labelledby="hcbk-stats-title">
            <div class="site-shell">
                <div class="hcbk-heading">
                    <h2 id="hcbk-stats-title">What Makes IBN Tech</h2>
                    <p class="hcbk-heading__sub">Best Bookkeeping Services Provider for Healthcare Business</p>
                </div>

                <div class="hcbk-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="hcbk-stat hcbk-stat--{{ $stat['tone'] }}" role="listitem">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Yellow CTA --}}
        <section class="hcbk-consult-banner" aria-labelledby="hcbk-consult-title">
            <div class="site-shell hcbk-consult-banner__inner">
                <h2 id="hcbk-consult-title">Trust IBN Tech to keep your Books in Perfect Health</h2>
                <p>So you can focus on keeping your Patients in Perfect Health</p>
                <a href="{{ route('page.show', ['slug' => 'free-consultation']) }}" class="hcbk-btn hcbk-btn--green">
                    Free Consultation
                </a>
            </div>
        </section>

        {{-- Partners --}}
        <section class="hcbk-section" aria-labelledby="hcbk-partners-title">
            <div class="site-shell">
                <div class="hcbk-heading">
                    <h2 id="hcbk-partners-title">Our Industry Leading Partners</h2>
                </div>
                <div class="hcbk-partners">
                    @foreach ($partners as $partner)
                        <img
                            src="{{ $img($partner['file']) }}"
                            alt="{{ $partner['alt'] }}"
                            width="{{ $partner['width'] }}"
                            height="{{ $partner['height'] }}"
                            loading="lazy"
                            decoding="async"
                        >
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Areas We Serve --}}
        <section class="hcbk-section" aria-labelledby="hcbk-areas-title">
            <div class="site-shell">
                <div class="hcbk-heading">
                    <h2 id="hcbk-areas-title">Areas We Serve</h2>
                </div>

                <div class="hcbk-areas">
                    @foreach ($areasColumns as $column)
                        <ul class="hcbk-areas__col">
                            @foreach ($column as $area)
                                <li>
                                    <a href="{{ route('page.show', ['slug' => $area['slug']]) }}">
                                        <svg aria-hidden="true" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path>
                                        </svg>
                                        <span>{{ $area['label'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="hcbk-testimonials" aria-labelledby="hcbk-testimonials-title">
            <div class="site-shell">
                <div class="hcbk-heading hcbk-heading--center">
                    <p class="hcbk-testimonials__eyebrow">Discover Why IBN Tech is among the</p>
                    <h2 id="hcbk-testimonials-title">Best Bookkeeping Firms in the USA</h2>
                </div>

                <div
                    class="hcbk-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="hcbk-testimonials__nav hcbk-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="hcbk-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="hcbk-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="hcbk-testimonials__nav hcbk-testimonials__nav--next"
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
