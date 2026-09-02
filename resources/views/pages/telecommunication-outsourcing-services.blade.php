@php
    $img = fn (string $file): string => asset('images/telecommunication-outsourcing-services/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
        'Other',
    ];

    $services = [
        [
            'title' => '1. Data Management Solutions',
            'image' => 'data-processing-services-4.webp',
            'alt' => 'data processing services',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Efficient Routing and Scheduling:',
                    'text' => ' Overcome challenges in route optimization with our advanced data processing solutions. We handle complexities like traffic, weather, and delivery timelines, ensuring efficiency at every turn.',
                ],
                [
                    'title' => 'Real-Time Freight Tracking:',
                    'text' => ' Our sophisticated data processing capabilities provide you with precise, real-time freight tracking, ensuring timely and accurate delivery information.',
                ],
                [
                    'title' => 'Customs and Regulatory Compliance:',
                    'text' => ' Navigate the intricate world of customs data, tariffs, and trade regulations with our precise processing services, ensuring full compliance.',
                ],
            ],
        ],
        [
            'title' => '2. Finance and Accounting',
            'image' => 'finance-and-accounting-4.webp',
            'alt' => 'finance and accounting',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Revenue Recognition:',
                    'text' => ' Telecom revenue streams are complex. Our services simplify the accounting of recurring charges, usage-based fees, and promotional offers, ensuring accuracy in your financial statements.',
                ],
                [
                    'title' => 'Global Financial Management:',
                    'text' => ' Operating across borders brings financial complexity. We manage diverse currencies, tax regulations, and accounting standards, making global operations less daunting.',
                ],
                [
                    'title' => 'Regulatory Compliance:',
                    'text' => ' The telecom sector is heavily regulated. Our team stays abreast of all financial reporting and accounting standards, ensuring you remain compliant and avoid costly penalties.',
                ],
            ],
        ],
        [
            'title' => '3. Bookkeeping',
            'image' => 'bookkeeping-5.webp',
            'alt' => 'bookkeeping',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Efficient Transaction Management:',
                    'text' => ' Telecommunications companies handle millions of transactions daily. Our bookkeeping services are geared to manage this high volume with precision and efficiency.',
                ],
                [
                    'title' => 'Maintaining Precise Records:',
                    'text' => ' Accurate record-keeping is vital for auditing and compliance. Our meticulous bookkeeping procedures ensure every financial transaction is recorded and managed effectively.',
                ],
                [
                    'title' => 'Reconciliation of Accounts:',
                    'text' => ' We streamline the reconciliation of various accounts, reducing time consumption and minimizing errors.',
                ],
                [
                    'title' => 'Tax Regulation Compliance:',
                    'text' => ' We navigate the complexities of tax regulations for both domestic and international operations, ensuring full compliance.',
                ],
            ],
        ],
        [
            'title' => '4. AP/AR Management',
            'image' => 'ap-ar-management.webp',
            'alt' => 'ap-ar management',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Automated Invoice Processing:',
                    'text' => ' We transform your invoice processing with automation, increasing efficiency and reducing errors.',
                ],
                [
                    'title' => 'Complex Reconciliation Simplified:',
                    'text' => ' Our services make the reconciliation of payables and receivables less complex, especially in high-volume environments.',
                ],
                [
                    'title' => 'Streamlined Collections for Better Cash Flow:',
                    'text' => ' Prompt and accurate customer payments are vital. We implement effective credit control processes and collection strategies to improve your cash flow.',
                ],
                [
                    'title' => 'Supplier Relationship Optimization:',
                    'text' => ' Managing a large network of suppliers is challenging. Our services help in efficiently managing invoices, payments, and disputes, enhancing your supplier relations.',
                ],
            ],
        ],
        [
            'title' => '5. Payroll Processing',
            'image' => 'payroll-services.webp',
            'alt' => 'payroll services',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Global Payroll Expertise:',
                    'text' => ' Managing a worldwide workforce requires compliance with various international labor laws and payroll regulations. Our services ensure this is done seamlessly.',
                ],
                [
                    'title' => 'Handling Complex Pay Structures:',
                    'text' => ' From commissions to bonuses, we accurately calculate payroll for complex employee remuneration structures.',
                ],
                [
                    'title' => 'Timely and Accurate Payments:',
                    'text' => ' Ensuring your employees are paid on time and accurately is our priority, fostering morale and productivity.',
                ],
                [
                    'title' => 'Upholding Data Security in Payroll:',
                    'text' => ' We protect sensitive payroll data against breaches and unauthorized access, maintaining the highest level of confidentiality and compliance.',
                ],
            ],
        ],
        [
            'title' => '6. CFO Services',
            'image' => 'cfo-services-3.webp',
            'alt' => 'cfo services',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Bridging the Financial Expertise Gap:',
                    'text' => ' Our outsourced CFO services provide strategic financial guidance in areas like mergers and acquisitions, corporate finance, and risk management, where in-house expertise might be lacking.',
                ],
                [
                    'title' => 'Strengthening Internal Control and Reporting:',
                    'text' => ' We help maintain strong internal controls and ensure accurate, timely financial reporting, catering to stakeholder and investor expectations.',
                ],
                [
                    'title' => 'Enabling Data-Driven Decisions:',
                    'text' => ' With our advanced data analytics capabilities, we empower you to make informed, data-driven decisions.',
                ],
                [
                    'title' => 'Strategic Financial Planning for Future Growth:',
                    'text' => ' Our CFOs assist in developing comprehensive financial strategies, helping you navigate market changes, seize opportunities, and manage risks effectively.',
                ],
            ],
        ],
    ];

    $stats = [
        ['value' => '26+', 'label' => 'Years of Success', 'tone' => 'light'],
        ['value' => '10000+', 'label' => 'Clients Served', 'tone' => 'navy'],
        ['value' => '50M', 'label' => 'Transaction Processed', 'tone' => 'light'],
        ['value' => '99.99 %', 'label' => 'Accuracy Achieved', 'tone' => 'navy'],
    ];

    $testimonials = [
        [
            'quote' => 'We are now entering the fourth year of our relationship with IBN. This has been a hugely rewarding and valuable transaction for us with IBN as they are now responsible for',
            'cite' => 'David Barber',
        ],
        [
            'quote' => 'IBN financial support is a top-class accounting services outsourcer. They act with speed in getting work done, and mobilizing additional resources as needed. Their greatest strength is pro-active communication with clients. I consider IBN a strong partner.',
            'cite' => 'Salman Ghani',
        ],
        [
            'quote' => 'After approaching IBN with a complex and bespoke requirement, I’ve been impressed with the professionalism and knowledge of my technical contact and other',
            'cite' => 'DANIEL SCOTT',
        ],
    ];

    $faqs = [
        [
            'question' => 'How do you handle large-scale data management and analysis in your telecom data processing services?',
            'answer' => 'We utilize high-performance computing and big data analytics to manage and analyze vast volumes of telecom data, ensuring efficient processing and actionable insights for network optimization and customer segmentation.',
        ],
        [
            'question' => 'What specific strategies do you employ for managing the complex financial structures of telecommunication companies?',
            'answer' => 'Our approach includes managing intricate revenue streams, regulatory compliances, and international transactions, utilizing advanced software and expertise in telecom financial complexities.',
        ],
        [
            'question' => 'How is your bookkeeping service adapted to the frequent tariff changes and billing cycles in the telecom industry?',
            'answer' => 'We implement dynamic bookkeeping systems capable of adjusting to frequent tariff updates and complex billing cycles, ensuring accuracy in financial records and compliance with telecom regulations.',
        ],
        [
            'question' => 'Can your AP/AR management services handle the high-volume transactions typical in the telecommunications sector?',
            'answer' => 'Yes, our services are designed to efficiently handle high-volume transactions, leveraging automated systems and AI tools to manage customer billing, vendor payments, and financial reconciliation with accuracy and speed.',
        ],
        [
            'question' => 'How do your payroll services cater to the diverse and global workforce commonly found in telecommunications companies?',
            'answer' => 'We offer tailored payroll solutions that cater to a global workforce, ensuring compliance with international labor laws, handling diverse compensation structures, and managing multi-currency payroll requirements.',
        ],
        [
            'question' => 'In what ways do your CFO services assist telecommunications companies in strategic investment and technology adoption?',
            'answer' => 'Our CFO services provide strategic guidance on investment decisions, focusing on new technologies and market trends specific to the telecommunications industry, aiding in budget optimization and future-proofing business operations.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/telecommunication-outsourcing-services.css'])
@endpush

@section('content')
    <div class="tos-page">
        {{-- Section 1: Hero Banner --}}
        <section class="tos-hero" aria-labelledby="tos-hero-title">
            <div class="site-shell tos-hero__inner">
                <div class="tos-hero__copy">
                    <p class="tos-hero__eyebrow">Empower Your Telecommunication Business with IBN Tech's</p>
                    <h1 id="tos-hero-title">Telecom Outsourcing Services – Scalable Solutions for Growth</h1>
                    <p class="tos-hero__lede">
                        From data-driven network management to customer-centric support, our BPO solutions are designed to enhance your telecom business. Experience next-level efficiency and stay ahead in the dynamic telecom industry.
                    </p>
                    <div class="tos-hero__actions">
                        <a href="#contact-us" class="tos-btn tos-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="tos-hero__media">
                    <img
                        src="{{ $img('telecommunication-business.webp') }}"
                        alt="telecommunication business"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 2: Intro / Overview --}}
        <section class="tos-section" aria-labelledby="tos-intro-title">
            <div class="site-shell tos-split">
                <div class="tos-split__media">
                    <img
                        src="{{ $img('2nd-image.webp') }}"
                        alt="IBN Tech's Telecommunication"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="tos-split__copy">
                    <h2 id="tos-intro-title" class="sr-only">IBN Tech's Telecommunication Outsourcing Solutions</h2>
                    <div class="tos-intro-card">
                        <p>
                            IBN Tech's Telecommunication Outsourcing Solutions offer a strategic edge for telecom companies in the USA and UK. By embracing outsourcing, these businesses efficiently manage costs, access specialized resources, and optimize investments, all while enhancing customer acquisition and retention. Our services, ranging from call center to finance and accounting outsourcing, adapt to the evolving demands of growth, technology, and operational excellence. With IBN's expert team, telecom companies can extend their capabilities, transforming their value chain to unlock new potential. Our comprehensive <a href="{{ url('/bpo-services/') }}">BPO services</a> foster growth, cost efficiency, improved customer service, and innovative service offerings, making us an integral part of your telecommunication business strategy.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 3: Services Grid --}}
        <section class="tos-section tos-section--tight" aria-labelledby="tos-services-title">
            <div class="site-shell">
                <div class="tos-heading">
                    <h2 id="tos-services-title">
                        Empower Your Telecom Business with Cost-Effective &amp; Scalable Outsourcing Solutions
                    </h2>
                    <p class="tos-heading__sub">for Freight, Shipping, and Distribution Companies</p>
                </div>

                @foreach ($services as $service)
                    <article class="tos-split{{ $service['imageRight'] ? '' : ' tos-split--flip' }}">
                        <div class="tos-split__copy">
                            <h3>{{ $service['title'] }}</h3>
                            @foreach ($service['points'] as $point)
                                <p>
                                    <strong>{{ $point['title'] }}</strong>{{ $point['text'] }}
                                </p>
                            @endforeach
                            <a href="#contact-us" class="tos-btn tos-btn--navy">
                                Get a Free Consultation Today
                            </a>
                        </div>
                        <div class="tos-split__media">
                            <img
                                src="{{ $img($service['image']) }}"
                                alt="{{ $service['alt'] }}"
                                width="560"
                                height="500"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- Section 4: Stats --}}
        <section class="tos-section tos-section--soft" aria-labelledby="tos-stats-title">
            <div class="site-shell">
                <div class="tos-heading">
                    <h2 id="tos-stats-title">Why IBN Tech is the</h2>
                    <p class="tos-heading__sub">Telecommunication Business Process Services?</p>
                </div>

                <div class="tos-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="tos-stat tos-stat--{{ $stat['tone'] }}" role="listitem">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Section 5: Mid CTA Banner --}}
        <section class="tos-banner" aria-labelledby="tos-banner-title">
            <div class="site-shell tos-banner__inner">
                <h2 id="tos-banner-title">Elevate Your Telecom Operations with IBN Tech</h2>
                <p>Unleash the power of our BPO solutions to drive efficiency, enhance customer satisfaction, and fuel your growth ambitions in the dynamic telecom industry.</p>
                <a href="#contact-us" class="tos-btn tos-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Section 6: Contact Form / Schedule A Call with Our Experts --}}
        <section class="tos-section tos-consult" id="contact-us" aria-labelledby="tos-consult-title">
            <div class="site-shell tos-consult__inner">
                <aside class="tos-consult__card" aria-labelledby="tos-consult-title">
                    <div class="tos-consult__header">
                        <h2 id="tos-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="tos-consult__body">
                        <livewire:forms.contact-form
                            form-name="telecommunication-outsourcing-services"
                            id-prefix="tos"
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

                <div class="tos-consult__media">
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

        {{-- Section 7: Testimonials --}}
        <section class="tos-testimonials" aria-labelledby="tos-testimonials-title">
            <div class="site-shell">
                <div class="tos-heading">
                    <p class="tos-testimonials__eyebrow">Discover Why IBN Tech Leads in</p>
                    <h2 id="tos-testimonials-title">Bookkeeping Services</h2>
                </div>

                <div
                    class="tos-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="tos-testimonials__nav tos-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
                        </svg>
                    </button>

                    <div class="tos-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="tos-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="tos-testimonials__nav tos-testimonials__nav--next"
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

        {{-- Section 8: FAQ --}}
        <section class="tos-section" aria-labelledby="tos-faq-title">
            <div class="site-shell">
                <div class="tos-heading">
                    <h2 id="tos-faq-title">Frequently Asked Questions (FAQ)</h2>
                </div>

                <div class="tos-faq-wrap">
                    <div class="tos-faq-wrap__media">
                        <img
                            src="{{ $img('faq-banner.webp') }}"
                            alt="faq-banner"
                            width="1080"
                            height="1080"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <div class="tos-faq">
                        @foreach ($faqs as $i => $faq)
                            <details @if ($i === 0) open @endif>
                                <summary>
                                    <span>{{ $faq['question'] }}</span>
                                </summary>
                                <div>{{ $faq['answer'] }}</div>
                            </details>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
