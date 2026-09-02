@php
    $img = fn (string $file): string => asset('images/tech-support-services/'.$file);

    $industriesCol1 = [
        'Application Service Providers (ASPs)',
        'Wireless Vendors',
        'Consultants',
        'Logistics',
    ];

    $industriesCol2 = [
        'Real Estate',
        'Original Equipment Manufacturers',
        'IT-enabled toys, games and products',
        'Integrators',
    ];

    $industriesCol3 = [
        'Insurance',
        'Hospitality',
        'Banking and Finance',
        'Internet Service Providers',
    ];

    $benefitsList = [
        'Upgraded customer support services',
        'Skilled and trained technical helpdesk executives',
        'Rationalized business processes',
        'Lucrative online computer support services',
        'Round-the-clock service',
        'Save time, effort and resources',
    ];

    $adminServicesList = [
        'Inbound Technical Support',
        'AWS Expert Services',
        'Server Management',
        'Azure Expert Services',
        'MS SQL Database Expert Services',
        'Cloud Security Services',
        'IIS 6.0/7.0 Web Server, Active Directory and Domain Controller Configuration Services',
    ];

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/tech-support-services.css'])
@endpush

@section('content')
    <div class="tss-page">
        {{-- Section 1: Hero Banner --}}
        <section class="tss-hero" aria-labelledby="tss-hero-title">
            <div class="site-shell tss-hero__inner">
                <div class="tss-hero__copy">
                    <h1 id="tss-hero-title">Outsourced technical support</h1>
                    <p class="tss-hero__lede">
                        Focus on satisfying your customers, and let us handle the bookkeeping - our team of experts understands the unique financial needs of IT businesses, and we'll make sure you stay on top of your numbers.
                    </p>
                    <div class="tss-hero__actions">
                        <a href="#contact-us" class="tss-btn tss-btn--green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="tss-hero__media">
                    <img
                        src="{{ $img('outsourced-technical.webp') }}"
                        alt="outsourced technical"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 2: Intro --}}
        <section class="tss-section tss-intro" aria-labelledby="tss-intro-title">
            <div class="site-shell tss-intro__inner">
                <div class="tss-heading">
                    <p class="tss-eyebrow">Tech Support Services</p>
                    <h2 id="tss-intro-title">Have a look what technical support service companies are:</h2>
                </div>

                <div class="tss-intro__content">
                    <div class="tss-intro__media">
                        <img
                            src="{{ $img('tech-support-services.webp') }}"
                            alt="tech support services"
                            width="400"
                            height="400"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <div class="tss-intro__card">
                        <p>
                            Outsourced technical support service companies help the sustenance of a service, product or application for an end-user of the same. These are kind of help of helpdesks which solve queries of the users through emails, voice chat and web. Apart from a helpdesk you can also address them as customer interaction centre, IT response centre, resource centre, service desk, IT solutions centre and contact centre that thoroughly lever the entire gamut of technical support services.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 3: Industries --}}
        <section class="tss-section tss-industries" aria-labelledby="tss-ind-title">
            <div class="site-shell tss-industries__inner">
                <div class="tss-heading">
                    <p class="tss-eyebrow">Outsourced tech support</p>
                    <h2 id="tss-ind-title">So, the industries which outsource to technical support service companies are:</h2>
                </div>

                <div class="tss-ind-grid" role="list">
                    {{-- Column 1 --}}
                    <div class="tss-ind-card tss-ind-card--dark" role="listitem">
                        <ul class="tss-ind-list">
                            @foreach ($industriesCol1 as $item)
                                <li>
                                    <svg class="tss-ind-icon" aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z"></path>
                                    </svg>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Column 2 --}}
                    <div class="tss-ind-card tss-ind-card--light" role="listitem">
                        <ul class="tss-ind-list">
                            @foreach ($industriesCol2 as $item)
                                <li>
                                    <svg class="tss-ind-icon" aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z"></path>
                                    </svg>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Column 3 --}}
                    <div class="tss-ind-card tss-ind-card--light" role="listitem">
                        <ul class="tss-ind-list">
                            @foreach ($industriesCol3 as $item)
                                <li>
                                    <svg class="tss-ind-icon" aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z"></path>
                                    </svg>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 4: Benefits --}}
        <section class="tss-section tss-benefits" aria-labelledby="tss-benefits-title">
            <div class="site-shell tss-split">
                <div class="tss-split__copy">
                    <p class="tss-eyebrow tss-eyebrow--start">Benefits</p>
                    <h2 id="tss-benefits-title">What benefits will you derive from tech support service company like IBN ?</h2>
                    <ul class="tss-bullet-list">
                        @foreach ($benefitsList as $benefit)
                            <li>{{ $benefit }}</li>
                        @endforeach
                    </ul>
                    <div class="tss-split__actions">
                        <a href="#contact-us" class="tss-btn tss-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="tss-split__media">
                    <img
                        src="{{ $img('benefits.webp') }}"
                        alt="benefits"
                        width="429"
                        height="339"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 5: 24/7 Administration Support --}}
        <section class="tss-section tss-admin" aria-labelledby="tss-admin-title">
            <div class="site-shell tss-split tss-split--reverse">
                <div class="tss-split__media">
                    <img
                        src="{{ $img('247-administration-support.webp') }}"
                        alt="247 administration support"
                        width="419"
                        height="373"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="tss-split__copy">
                    <p class="tss-eyebrow tss-eyebrow--start">24/7 Administration support</p>
                    <h2 id="tss-admin-title">IBN 24*7 Administration Services comprise of:</h2>
                    <ul class="tss-bullet-list">
                        @foreach ($adminServicesList as $service)
                            <li>{{ $service }}</li>
                        @endforeach
                    </ul>
                    <div class="tss-split__actions">
                        <a href="#contact-us" class="tss-btn tss-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 6: Feature 1 --}}
        <section class="tss-section tss-feature">
            <div class="site-shell tss-split">
                <div class="tss-split__copy">
                    <p class="tss-prose">
                        IBN Tech is a tech support service company which gives the customers the edge to perform better even in critical situations. Our speedy troubleshooting methods and customized solutions bring in elevated customer satisfaction. We have remote network and well-equipped server management system which supplies directed, safe and cohesive solutions for network communication. Being one of the best tech support services company, it facilitates interconnection between offices even that are at different locations. Along with the offices, it also provides support to suppliers, clients and buyers with smooth access to dire information at any point of time from any place.
                    </p>
                    <div class="tss-split__actions">
                        <a href="#contact-us" class="tss-btn tss-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="tss-split__media">
                    <img
                        src="{{ $img('ibntech-image.webp') }}"
                        alt="ibntech-image"
                        width="419"
                        height="373"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 7: Feature 2 --}}
        <section class="tss-section tss-feature">
            <div class="site-shell tss-split tss-split--reverse">
                <div class="tss-split__media">
                    <img
                        src="{{ $img('ibn-as-a-tech-support-service-company-extends-technical.webp') }}"
                        alt="ibn as a tech support service company, extends technical"
                        width="419"
                        height="373"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="tss-split__copy">
                    <p class="tss-prose">
                        Among all tech support service companies, IBNs support services enable drive a customers proficiency through ascendable, technology-empowered support. Offering these services through its tools, and offers network outsource services, operations &amp; management, integration, maintenance, deployment services and many such features. Not only this, IBN also monitors next generation BPO services and network applications. With our versatile tech support system our customers enjoy expertise from a team of experienced and skilled set of people. It helps in lowering the costs as well as reduces risks.
                    </p>
                    <div class="tss-split__actions">
                        <a href="#contact-us" class="tss-btn tss-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 8: Feature 3 --}}
        <section class="tss-section tss-feature">
            <div class="site-shell tss-split">
                <div class="tss-split__copy">
                    <p class="tss-prose">
                        IBN as a tech support service company, extends technical support to different parts of the world with secured knowledge in a 24×7 environment. We always try to abide by the timelines and the promised levels of quality of service.
                    </p>
                    <p class="tss-prose">
                        Outsourcing your technical support to tech support service companies might be a tedious and expensive task but not with IBN. We offer the best services in the industry at the most economized rates. You will not even feel the pinch on your pocket and your work will be done!! Our representatives closely work with the customer teams which results to advanced solutions easy resolutions of issues. The timely online support system helps you in managing your business even more professionally and competently.
                    </p>
                    <div class="tss-split__actions">
                        <a href="#contact-us" class="tss-btn tss-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="tss-split__media">
                    <img
                        src="{{ $img('ibn-tech-is-a-tech-support-service-company-which.webp') }}"
                        alt="ibn tech is a tech support service company which"
                        width="419"
                        height="373"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 9: Feature 4 --}}
        <section class="tss-section tss-feature">
            <div class="site-shell tss-split tss-split--reverse">
                <div class="tss-split__media">
                    <img
                        src="{{ $img('among-all-tech-support-service-companies-ibns.webp') }}"
                        alt="among all tech support service companies, ibns"
                        width="419"
                        height="373"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="tss-split__copy">
                    <p class="tss-prose">
                        IBN – a tech support service company influence the control of knowledge banks, technical assets and proficiency centres to come up with appropriate and well-timed online computer support services. Our premeditated call centre technical support team makes sure to deliver superior services through our arduous recruitment, guidance and development programs.
                    </p>
                    <div class="tss-split__actions">
                        <a href="#contact-us" class="tss-btn tss-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 10: Schedule A Call with Our Experts (Contact form) --}}
        <section class="tss-section tss-consult" id="contact-us" aria-labelledby="tss-consult-title">
            <div class="site-shell tss-consult__inner">
                <aside class="tss-consult__card" aria-labelledby="tss-consult-title">
                    <div class="tss-consult__header">
                        <h2 id="tss-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="tss-consult__body">
                        <livewire:forms.contact-form
                            form-name="tech-support-services"
                            id-prefix="tss"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="What kind of accounting solution are you looking for?"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="tss-consult__media">
                    <img
                        src="{{ $img('schedule-a-call-with-our-experts.webp') }}"
                        alt="schedule a call with our experts"
                        width="400"
                        height="269"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>
    </div>
@endsection

