@php
    $img = fn (string $file): string => asset('images/outsourcing/'.$file);
    $pageUrl = fn (?string $slug): string => $slug
        ? route('page.show', ['slug' => $slug])
        : '#request-form-demo';

    $services = [
        [
            'title' => 'Finance and Accounting',
            'icon' => 'real-estate.webp',
            'alt' => 'real estate',
            'slug' => 'finance-and-accounting-services',
        ],
        [
            'title' => 'Bookkeeping Services',
            'icon' => 'healthcare.webp',
            'alt' => 'healthcare',
            'slug' => 'bookkeeping-services',
        ],
        [
            'title' => 'CFO Services',
            'icon' => 'restaurant.webp',
            'alt' => 'Restaurent',
            'slug' => 'cfo-services',
        ],
        [
            'title' => 'Order to Cash',
            'icon' => 'manufacturing.webp',
            'alt' => 'Manufacturing',
            'slug' => 'order-to-cash',
        ],
        [
            'title' => 'Account Payable / Account Receivable',
            'icon' => 'retail.webp',
            'alt' => 'retail',
            'slug' => 'accounts-payable-and-accounts-receivable-services',
        ],
        [
            'title' => 'Procure to Pay',
            'icon' => 'travel.webp',
            'alt' => 'Travel',
            'slug' => 'procure-to-pay',
        ],
        [
            'title' => 'Quote to Cash',
            'icon' => 'cpa.webp',
            'alt' => 'CPA',
            'slug' => 'quote-to-cash',
        ],
        [
            'title' => 'Record to Report',
            'icon' => 'ecommerce.webp',
            'alt' => 'Ecommerce',
            'slug' => 'record-to-report',
        ],
        [
            'title' => 'AP/AR Automation',
            'icon' => 'legal.webp',
            'alt' => 'Legal',
            'slug' => 'ap-ar-automation',
        ],
        [
            'title' => 'Payroll Processing',
            'icon' => 'marketing-advertising.webp',
            'alt' => 'Marketing',
            'slug' => 'payroll-processing',
        ],
        [
            'title' => 'Accounting Firms and CPA\'s',
            'icon' => 'food.webp',
            'alt' => 'Bookkeeping for Food & Beverage',
            'slug' => 'cpa-outsourcing',
        ],
        [
            'title' => 'Treasury Management',
            'icon' => 'it-business.webp',
            'alt' => 'IT-Business',
            'slug' => 'treasury-management-services-outsourcing',
        ],
        [
            'title' => 'Data Entry Services',
            'icon' => 'legal.webp',
            'alt' => 'Legal',
            'slug' => 'data-entry',
        ],
        [
            'title' => 'Hedge Fund Admin & Back Office Services',
            'icon' => 'marketing-advertising.webp',
            'alt' => 'Marketing',
            'slug' => 'hedge-fund-services',
        ],
        [
            'title' => 'BPO Services',
            'icon' => 'food.webp',
            'alt' => 'Bookkeeping for Food & Beverage',
            'slug' => 'bpo-services',
        ],
        [
            'title' => 'Industry Specialized Services',
            'icon' => 'it-business.webp',
            'alt' => 'IT-Business',
            'slug' => null,
        ],
    ];

    $leaderBenefits = [
        'Minimized operational costs and maximized revenue',
        'Timely delivery of services, surpassing expectations',
        'Access to specialized experts that cover client’s non-core functions, effectively',
        'More time to focus on core competencies and strategic initiatives',
        'Significant cost-cutting by eliminating the need to invest in hiring, infrastructure as well as overheads',
    ];

    $approach = [
        [
            'icon' => 'proposal.webp',
            'alt' => 'proposal',
            'title' => 'Proposal',
            'text' => 'Based on IBN’s experience initial marketing meetings and customer\'s interests',
        ],
        [
            'icon' => 'contract-signing.webp',
            'alt' => 'contract-signing',
            'title' => 'Contract signing',
            'text' => 'Agreement Formation including commercials',
        ],
        [
            'icon' => 'knowledge-transfer.webp',
            'alt' => 'knowledge-transfer',
            'title' => 'Knowledge Transfer',
            'text' => 'Knowledge Transfer by doing pilot project for shadow work',
        ],
        [
            'icon' => 'access-information-and-review.webp',
            'alt' => 'access-information-and-review',
            'title' => 'Access information and Review',
            'text' => 'S/W access, information review, Queries and concern on unclear process',
        ],
    ];

    $whyChoose = [
        [
            'title' => 'Transparency and Integrity:',
            'text' => 'We uphold the highest business ethics, ensuring transparency and integrity in all our operations.',
        ],
        [
            'title' => 'Infrastructural Excellence:',
            'text' => 'With a robust infrastructure and qualified resources, we deliver uninterrupted services to our customers.',
        ],
        [
            'title' => 'Data Security: CERT certified',
            'text' => '',
        ],
        [
            'title' => 'A wealth of Experience:',
            'text' => 'With over 24 + years of experience serving international clients, we bring knowledge to our outsourced services.',
        ],
        [
            'title' => 'Solutions of Outstanding Quality:',
            'text' => 'Our adherence to industry-standard best practices and methodologies guarantees exceptional quality in every aspect of our services and are backed by ISO standards.',
        ],
        [
            'title' => 'Cost-Effective Pricing:',
            'text' => 'We offer our professional services at competitive prices, accommodating a wide range of budgets.',
        ],
    ];

    $reliefBenefits = [
        'Unrivalled Quality Assured',
        '100% accuracy guaranteed',
        'Swift turnaround times for your convenience',
    ];

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
        'Other',
    ];

    $testimonials = [
        [
            'quote' => 'We have been with IBN for just a short of year now, and we are extremely happy with the service. They provide support and back-office accounts for us. The response time is often less than an hour and they have become instrumental in our daily running and have been able to tackle big projects without any problems. They are very professional, efficient and reliable and provide the results that we need, often on short notice. IBN are by far the best accountants I have worked with, and I would highly recommend IBN for anyone looking for an account’s solution.',
            'cite' => 'Janikin Rooke Contracts',
        ],
        [
            'quote' => 'We have been utilizing IBN now for about 6months, initially we were reluctant to allow access to our sensitive information, but we soon overcame these challenges. We have been working closely with Aniket the entire time, he is our dedicated reprehensive and we really enjoy his service. He started by doing standard banking reconciling for all our accounts. This has graduated to Invoicing, Banking, A/R Reporting, Imports & Exports, weekly P&L & journal entries. Not only has this really helped us streamline our process, but our overall Local accounting cost have been cut in half.',
            'cite' => 'RLCS Inc',
        ],
        [
            'quote' => 'We’ve had the opportunity to work with IBN Tech for over a year now and really enjoy the services they provide. The team is incredibly responsive, and the quality of work is wonderful – they are just an overall pleasure to work with.',
            'cite' => 'Mandi Loayza, Carnahan Group',
        ],
        [
            'quote' => 'I first searched for an outsourcing company based in India via google. There were 100’s of choices and not being based in India or heard of any of the companies, I really did not know who to use so I clicked on IBN and arranged for a call. Although the cost was to my liking, it was the total professionalism of the people I spoke to initially and then to the people who were going to take care of me on a daily/weekly basis that impressed me the most. Once the work got started and I saw their spreadsheets and work patterns, and their total understanding of my work, I realized how good they are. IBN has made my life easier to take more clients on and then to be cheeky enough to help with the workload so that I can offer the client other services. There might be 100 similar companies out there, but this is the one for me!',
            'cite' => 'AKS Accountants',
        ],
        [
            'quote' => 'The IBN team is great to work with and communicates efficiently and timely. They provided substantial assistance with our company needs and helped us push through projects.',
            'cite' => 'Sampson Business Solutions LLC',
        ],
        [
            'quote' => 'IBN has been providing excellent accounting services to our company for many years. Their staff is highly knowledgeable in GAAP standards. They perform very detailed analyses of all aspects of accounts and provide very professional reports. I would highly recommend them.',
            'cite' => 'Graviton Consulting Services',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/outsourcing.css'])
@endpush

@section('content')
    <div class="out-page">
        {{-- Hero --}}
        <section class="out-hero" aria-labelledby="out-hero-title">
            <div class="site-shell out-hero__inner">
                <div class="out-hero__copy">
                    <p class="out-hero__eyebrow">Trusted by Hundreds of Businesses</p>
                    <h1 id="out-hero-title">Offshore Outsourcing Services</h1>
                    <p class="out-hero__lede">
                        Delivering Consistent Quality and Measurable Outcomes: Our Distinct Outsourced Business Model in Action
                    </p>
                    <div class="out-hero__actions">
                        <a href="#request-form-demo" class="out-btn out-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="out-hero__media">
                    <img
                        src="{{ $img('outsourcing-banner.webp') }}"
                        alt="outsourcing"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="out-section" aria-labelledby="out-intro-title">
            <div class="site-shell out-split">
                <div class="out-split__media">
                    <img
                        src="{{ $img('a-wealth-of-experience.webp') }}"
                        alt="a wealth of experience"
                        width="846"
                        height="550"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="out-split__copy">
                    <h2 id="out-intro-title" class="sr-only">Offshore outsourcing for growing businesses</h2>
                    <p>
                        Unlock the potential of your business by delegating repetitive back-office tasks such as bookkeeping, data entry, payroll, accounting, human resources support, and customer support to the leading offshore outsourcing services provider, IBN Technologies. The key to success lies in doing it right. In order to stay competitive, offshore outsourcing must be executed effectively to generate growth for your business, enhance performance, and boost a business’s bottom line.
                    </p>
                </div>
            </div>
        </section>

        {{-- Leader / why outsourcing --}}
        <section class="out-leader" aria-labelledby="out-leader-title">
            <div class="site-shell">
                <h2 id="out-leader-title">IBN Tech a leader in offshore outsourcing</h2>
                <p>
                    Operating since 24+years, IBN Technologies is a pioneer in outsourcing has been providing secured and scalable offshore outsourcing solutions to global companies, on time, every time. Our track record speaks for itself, as we have consistently delivered quality and cost-effective services ahead of schedule, creating substantial value for our customers in the US, UK, and beyond.
                </p>
                <p>
                    By partnering with IBN Tech, our clients have gained a competitive edge in their respective industries. They have experienced the following benefits from our risk-free offshore outsourcing services:
                </p>
                <ul class="out-checks out-checks--light">
                    @foreach ($leaderBenefits as $benefit)
                        <li>{{ $benefit }}</li>
                    @endforeach
                </ul>
                <p>
                    At IBN Tech, we are dedicated to elevating your operations by tackling talent shortages and ensuring cost-effectiveness through our personnel management and processes that prioritize data security principles. This advantage empowers your business to boost profits, embrace greater flexibility, and scale without shouldering additional risks. Count on us to assist you in adapting to the dynamic market and effectively meeting your as well as your clients' evolving demands. Trust us to help you adapt to the changing market and effectively meet your business demands.
                </p>
                <p class="out-leader__close">Embark on a Journey to Excellence: Start Your Path with Us!</p>
            </div>
        </section>

        {{-- Services grid --}}
        <section class="out-section" aria-labelledby="out-services-title">
            <div class="site-shell">
                <div class="out-heading">
                    <h2 id="out-services-title">Our Offshore Outsourcing Services</h2>
                </div>

                <div class="out-services" role="list">
                    @foreach ($services as $service)
                        <article class="out-service" role="listitem">
                            <a
                                href="{{ $pageUrl($service['slug']) }}"
                                class="out-service__link"
                            >
                                <span class="out-service__icon">
                                    <img
                                        src="{{ $img($service['icon']) }}"
                                        alt="{{ $service['alt'] }}"
                                        width="75"
                                        height="75"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </span>
                                <h3>{{ $service['title'] }}</h3>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Operational approach --}}
        <section class="out-section out-section--mint" aria-labelledby="out-approach-title">
            <div class="site-shell">
                <div class="out-heading">
                    <h2 id="out-approach-title">Our Operational Approach</h2>
                </div>

                <div class="out-approach" role="list">
                    @foreach ($approach as $step)
                        <article class="out-approach__item" role="listitem">
                            <img
                                src="{{ $img($step['icon']) }}"
                                alt="{{ $step['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Why choose --}}
        <section class="out-why" aria-labelledby="out-why-title">
            <div class="out-why__copy">
                <div class="out-why__inner">
                    <h2 id="out-why-title">Why Make Us Your Top Choice for Offshore Outsourcing Services?</h2>
                    <p>As a leading provider of comprehensive offshore outsourcing services, we offer numerous advantages to our clients. These benefits include:</p>
                    <ul class="out-checks out-checks--light">
                        @foreach ($whyChoose as $item)
                            <li>
                                <strong>{{ $item['title'] }}</strong>
                                @if ($item['text'] !== '')
                                    {{ $item['text'] }}
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <a href="#request-form-demo" class="out-btn out-btn--gold">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
            <div class="out-why__media">
                <img
                    src="{{ $img('outsourcing2.webp') }}"
                    alt="Cost savings from offshore outsourcing"
                    width="720"
                    height="540"
                    loading="lazy"
                    decoding="async"
                >
            </div>
        </section>

        {{-- Dark CTA ribbon --}}
        <section class="out-ribbon" aria-labelledby="out-ribbon-title">
            <div class="site-shell out-ribbon__inner">
                <img
                    src="{{ $img('outsourcing1.webp') }}"
                    alt=""
                    width="120"
                    height="80"
                    loading="lazy"
                    decoding="async"
                >
                <h2 id="out-ribbon-title">
                    Choose us as your trusted offshore outsourcing partner and experience the advantages of our expertise, reliability, and affordability.
                </h2>
                <a href="#request-form-demo" class="out-btn out-btn--navy">
                    Get a Free Consultation
                </a>
            </div>
        </section>

        {{-- Path to relief --}}
        <section class="out-section out-section--mint" aria-labelledby="out-relief-title">
            <div class="site-shell out-relief">
                <h2 id="out-relief-title">Offshore Outsourcing: The Path to Business Relief - Let Our Precision Lead the Way</h2>
                <p>Join our global community of delighted clients who trust us to deliver, and experience the following benefits:</p>
                <ul class="out-checks">
                    @foreach ($reliefBenefits as $benefit)
                        <li>{{ $benefit }}</li>
                    @endforeach
                </ul>
                <p>
                    Unlock your business's full potential with IBN's offshore outsourcing services. Streamline your financial management processes as well as back-office work and reach your business goals faster. Don't delay any further – entrust your business needs to us for precise and compliant records. Take the first step towards financial efficiency today! Contact us now to get started!
                </p>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="out-section out-consult"
            id="request-form-demo"
            aria-labelledby="out-consult-title"
        >
            <div class="site-shell out-consult__inner">
                <aside class="out-consult__card" aria-labelledby="out-consult-title">
                    <div class="out-consult__header">
                        <h2 id="out-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="out-consult__body">
                        <livewire:forms.contact-form
                            form-name="outsourcing"
                            id-prefix="out"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="What services are you interested in?"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="out-consult__media">
                    <img
                        src="{{ $img('form-image.webp') }}"
                        alt="form Image"
                        width="540"
                        height="364"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="out-testimonials" aria-labelledby="out-testimonials-title">
            <div class="site-shell">
                <div class="out-heading">
                    <p class="out-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="out-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="out-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="out-testimonials__nav out-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
                        </svg>
                    </button>

                    <div class="out-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="out-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="out-testimonials__nav out-testimonials__nav--next"
                        @click="next()"
                        aria-label="Next testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M696 533C708 521 713 504 713 487 713 471 708 454 696 446L400 146C388 133 375 125 354 125 338 125 325 129 313 142 300 154 292 171 292 187 292 204 296 221 308 233L563 492 304 771C292 783 288 800 288 817 288 833 296 850 308 863 321 871 338 875 354 875 371 875 388 867 400 854L696 533Z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </section>
    </div>
@endsection
