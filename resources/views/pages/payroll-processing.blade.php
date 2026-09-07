@php
    $img = fn (string $file): string => asset('images/payroll-processing/'.$file);

    $trustItems = ['Accurate', 'Secure', 'Affordable'];

    $excellenceItems = [
        [
            'file' => 'time-savings.webp',
            'alt' => 'time savings',
            'title' => 'Time Savings',
            'text' => 'Free up valuable hours each pay period with our efficient processes and user-friendly online platform.',
        ],
        [
            'file' => 'accuracy.webp',
            'alt' => 'accuracy',
            'title' => 'Accuracy & Compliance',
            'text' => 'Our payroll experts stay up-to-date with the latest regulations, ensuring every calculation is accurate.',
        ],
        [
            'file' => 'cost-efficiency.webp',
            'alt' => 'cost efficiency',
            'title' => 'Cost Efficiency',
            'text' => 'Avoid the high costs of hiring an in-house payroll specialist with our budget-friendly services.',
        ],
        [
            'file' => 'enhanced-security.webp',
            'alt' => 'enhanced security',
            'title' => 'Enhanced Security',
            'text' => 'We use advanced encryption to protect your sensitive employee data, ensuring privacy and security.',
        ],
        [
            'file' => 'scalability.webp',
            'alt' => 'scalability',
            'title' => 'Scalability',
            'text' => 'Whether you have one employee or a growing team, our payroll services can scale with your needs.',
        ],
        [
            'file' => 'comprehensive-reporting.webp',
            'alt' => 'comprehensive reporting',
            'title' => 'Comprehensive Reporting',
            'text' => 'Gain insights with detailed, customizable reports that help you make better business decisions.',
        ],
    ];

    $serviceItems = [
        [
            'file' => 'payroll-services-2.webp',
            'alt' => 'payroll services',
            'title' => 'Payroll Services',
            'text' => 'Our payroll processing takes care of wages, deductions, and tax filings, ensuring your payroll is always on time and accurate.',
        ],
        [
            'file' => 'tax-filing.webp',
            'alt' => 'tax filing',
            'title' => 'Tax Filing',
            'text' => 'We handle all payroll taxes, ensuring compliance with federal, state, and local regulations.',
        ],
        [
            'file' => 'payroll-management.webp',
            'alt' => 'payroll management',
            'title' => 'Payroll Management Made Easy',
            'text' => 'With payroll administration services and cutting-edge software, managing payroll has never been simpler.',
        ],
        [
            'file' => 'global-payroll.webp',
            'alt' => 'global payroll',
            'title' => 'Global Payroll Solutions',
            'text' => 'We handle currency conversions, international compliance, and more, making us a top choice for global payroll outsourcing.',
        ],
        [
            'file' => 'payroll-and-compliance.webp',
            'alt' => 'payroll and compliance',
            'title' => 'Payroll and Compliance Support',
            'text' => 'Stay ahead of payroll and compliance requirements with our expert team, ensuring no penalties or surprises.',
        ],
        [
            'file' => 'affordable-outsourcing.webp',
            'alt' => 'affordable outsourcing',
            'title' => 'Affordable Outsourcing Options',
            'text' => 'Outsource payroll services to IBNTech and enjoy the benefits of a third-party payroll company at a price that works for you.',
        ],
    ];

    $industryPills = ['Small Business', 'Construction', 'Tech Startups', 'Healthcare', 'Retail'];

    $integrations = ['QuickBooks', 'Xero', 'NetSuite'];

    $expertBenefits = [
        [
            'title' => 'Personalized Solutions',
            'text' => 'Tailored to meet your specific business needs',
        ],
        [
            'title' => 'Quick Implementation',
            'text' => 'Up and running within days, not weeks',
        ],
        [
            'title' => 'Dedicated Support',
            'text' => 'A personal account manager assigned to your business',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/payroll-processing.css'])
@endpush

@section('content')
    <div class="prlp-page">
        {{-- Hero --}}
        <section class="prlp-hero" aria-labelledby="prlp-hero-title">
            <div class="site-shell prlp-hero__inner">
                <div class="prlp-hero__copy">
                    <h1 id="prlp-hero-title">Outsourced Payroll Services for Streamlined Employee Management</h1>
                    <p class="prlp-hero__lede">
                        As a trusted payroll service provider, we offer full-service payroll that saves you time, reduces mistakes, and ensures compliance
                    </p>
                    <a href="#contact-us" class="prlp-btn">Get Free Consultation</a>
                    <ul class="prlp-hero__trust" aria-label="Payroll service strengths">
                        @foreach ($trustItems as $item)
                            <li>
                                <span class="prlp-hero__check" aria-hidden="true">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="prlp-hero__media">
                    <img
                        src="{{ $img('payrollbanner.webp') }}"
                        alt="payroll processing"
                        width="374"
                        height="389"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Payroll Processing Excellence --}}
        <section class="prlp-section" aria-labelledby="prlp-excellence-title">
            <div class="site-shell">
                <div class="prlp-heading">
                    <h2 id="prlp-excellence-title">Payroll Processing Excellence</h2>
                    <p>
                        As a leading payroll service provider, IBNTech specializes in online payroll services tailored to meet the needs of small &amp; large businesses companies, and accountants.
                    </p>
                </div>

                <div class="prlp-excellence-grid">
                    @foreach ($excellenceItems as $item)
                        <article class="prlp-excellence-card">
                            <figure>
                                <img
                                    src="{{ $img($item['file']) }}"
                                    alt="{{ $item['alt'] }}"
                                    width="32"
                                    height="32"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </figure>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="prlp-section__cta">
                    <a href="#our-services" class="prlp-btn">Explore Our Solution</a>
                </div>
            </div>
        </section>

        {{-- Our Payroll Services --}}
        <section class="prlp-services" id="our-services" aria-labelledby="prlp-services-title">
            <div class="site-shell">
                <div class="prlp-heading prlp-heading--light">
                    <h2 id="prlp-services-title">Our Payroll Services Tailored for Small Businesses</h2>
                    <p>Whether you’re a startup or an established company, IBNTech offers company payroll services that fit your needs</p>
                </div>

                <div class="prlp-services-grid">
                    @foreach ($serviceItems as $item)
                        <article class="prlp-service-card">
                            <figure>
                                <img
                                    src="{{ $img($item['file']) }}"
                                    alt="{{ $item['alt'] }}"
                                    width="50"
                                    height="57"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </figure>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="prlp-services-lower">
                    <div class="prlp-outsource">
                        <h3>Comprehensive Payroll Outsourcing Services</h3>
                        <p>
                            Our
                            <a href="{{ route('blog.index') }}">U.S. payroll services</a>
                            include everything you need for hassle-free payroll management. We take care of wages, deductions, and tax filings - ensuring your payroll is accurate, compliant, and always on time.
                        </p>
                        <div class="prlp-pills" role="list">
                            @foreach ($industryPills as $pill)
                                <span class="prlp-pill" role="listitem">{{ $pill }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="prlp-integrate">
                        <h3>Smart Payroll Integration</h3>
                        <p>
                            Our payroll application can be integrated with QuickBooks, Xero and with the help of Zapier connects with 100 of application like fresh books, Zoho Books, wave, for time tracking it can integrated with Deputy, at Sheets, Humanity, QuickBooks Time
                        </p>
                        <ul>
                            @foreach ($integrations as $name)
                                <li>
                                    <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                    <span>{{ $name }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Value banner --}}
        <section class="prlp-value" aria-labelledby="prlp-value-title">
            <div class="site-shell prlp-value__inner">
                <h2 id="prlp-value-title">Best Payroll Services for Small Business at Competitive Costs</h2>
                <p>At IBNTech, we believe great payroll services shouldn't cost a fortune. Our payroll services pricing is designed with small businesses in mind.</p>
            </div>
        </section>

        {{-- Talk to our expert + form --}}
        <section class="prlp-consult" id="contact-us" aria-labelledby="prlp-consult-title">
            <div class="site-shell prlp-consult__inner">
                <div class="prlp-consult__copy">
                    <h2 id="prlp-consult-title">Talk To Our Expert</h2>
                    <p class="prlp-consult__lede">
                        We'll work with you to understand your specific needs and create a customized payroll solution.
                    </p>

                    <ul class="prlp-consult__benefits">
                        @foreach ($expertBenefits as $item)
                            <li>
                                <span class="prlp-consult__icon" aria-hidden="true">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <div>
                                    <h3>{{ $item['title'] }}</h3>
                                    <p>{{ $item['text'] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="prlp-consult__contact">
                        <h3>Contact Information</h3>
                        <p>Our team is available 24/5 to assist you with any questions.</p>
                        <ul>
                            <li>
                                <a href="mailto:sales@ibntech.com">
                                    <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                                    sales@ibntech.com
                                </a>
                            </li>
                            <li>
                                <a href="tel:+1-844-644-8440">
                                    <i class="fa-solid fa-phone" aria-hidden="true"></i>
                                    +1-844-644-8440
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <aside class="prlp-consult__card" aria-labelledby="prlp-form-title">
                    <h2 id="prlp-form-title">Get Started with a Free Consultation Today</h2>
                    <livewire:forms.contact-form
                        form-name="payroll-processing"
                        id-prefix="prlp"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your payroll needs"
                        submit-label="BOOK FREE CONSULTATION"
                        layout="home"
                        thank-you-url="/thanks-you-for-payroll-service/"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
