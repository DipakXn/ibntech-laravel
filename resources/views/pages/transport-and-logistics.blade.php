@php
    $img = fn (string $file): string => asset('images/transport-and-logistics/'.$file);

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
            'title' => '1. Data Handling Services',
            'image' => 'data-processing-services-3.webp',
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
            'image' => 'finance-and-accounting-3.webp',
            'alt' => 'finance and accounting',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Fuel Cost Fluctuations:',
                    'text' => ' Our financial expertise helps you manage the impact of fuel cost variations, optimizing your financial planning and stability.',
                ],
                [
                    'title' => 'Freight Rate Management:',
                    'text' => ' Stay ahead with our services in managing fluctuating freight rates and surcharges, ensuring accurate and efficient billing processes.',
                ],
                [
                    'title' => 'Asset Depreciation:',
                    'text' => ' Expertly handle the depreciation accounting of your assets, from trucks to ships, enhancing your financial accuracy.',
                ],
            ],
        ],
        [
            'title' => '3. Bookkeeping',
            'image' => 'bookkeeping-4.webp',
            'alt' => 'bookkeeping',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Fleet Maintenance Records:',
                    'text' => ' Our meticulous record-keeping ensures every detail of your fleet\'s maintenance is tracked and managed efficiently.',
                ],
                [
                    'title' => 'Contract Management:',
                    'text' => ' We handle logistics service contracts, ensuring every detail is managed and recorded for optimal service delivery.',
                ],
                [
                    'title' => 'Inventory Management:',
                    'text' => ' Trust us to keep accurate bookkeeping for your in-transit and warehoused inventory, ensuring precision and reliability.',
                ],
            ],
        ],
        [
            'title' => '4. AP/AR Management',
            'image' => 'apar-management-1-2.webp',
            'alt' => 'apar management',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Fuel and Toll Expense Management:',
                    'text' => ' Manage your high-volume expenses like fuel and tolls with our streamlined accounts payable services.',
                ],
                [
                    'title' => 'Client Freight Invoicing:',
                    'text' => ' We handle the complexities of freight invoicing with variable pricing, ensuring accuracy and client satisfaction.',
                ],
                [
                    'title' => 'Timely Supplier Payments:',
                    'text' => ' Our services ensure prompt and accurate payments to suppliers, maintaining strong and reliable partnerships.',
                ],
            ],
        ],
        [
            'title' => '5. Payroll Processing',
            'image' => 'payroll-processing-1-2.webp',
            'alt' => 'payroll processing',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Driver Compensation Calculations:',
                    'text' => ' Our payroll services consider all variables, from distance traveled to load carried, ensuring fair and accurate driver compensation.',
                ],
                [
                    'title' => 'Manage Overtime and Per Diems:',
                    'text' => ' Our payroll services efficiently handle overtime and per diems, particularly for on-the-road staff.',
                ],
                [
                    'title' => 'Unionized Workforce Payroll:',
                    'text' => ' We navigate the complexities of a unionized workforce, ensuring adherence to agreements and smooth payroll operations.',
                ],
            ],
        ],
        [
            'title' => '6. CFO Services',
            'image' => 'cfo-services-1-1.webp',
            'alt' => 'cfo services',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Investment in Fleet and Technology:',
                    'text' => ' Purchasing new trucks or upgrading logistics tech can be overwhelming. With our CFO services, get clear, actionable financial insights for informed decisions, ensuring every investment drives greater ROI.',
                ],
                [
                    'title' => 'Profitability and Efficiency Analysis:',
                    'text' => ' Unlock financial success with our CFOs. We analyze routes and contracts for optimal profitability, streamlining operations and boosting your bottom line while enhancing service delivery efficiency.',
                ],
                [
                    'title' => 'Risk Management in Global Trade:',
                    'text' => ' Manage financial risks in global trade, from currency fluctuations to international trade laws, with our expert CFO services.',
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
            'question' => 'How do your data processing services ensure timely and accurate tracking of logistics and transportation schedules ?',
            'answer' => 'Our data processing services utilize real-time tracking systems and advanced analytics to monitor and optimize logistics and transportation schedules. This ensures timely updates and accurate scheduling, critical for efficient travel operations.',
        ],
        [
            'question' => 'What measures do you implement to ensure the confidentiality and security of sensitive travel and logistics data in your bookkeeping services?',
            'answer' => 'We prioritize data security in our bookkeeping services through robust encryption, secure data transmission protocols, and strict access controls. This is essential for safeguarding sensitive logistics information, including customer data and financial transactions.',
        ],
        [
            'question' => 'How are your accounts payable and receivable services handle the financial transactions such as multi-currency billing and seasonal fluctuations?',
            'answer' => 'Our AP/AR services are specifically designed for the travel industry, equipped to manage multi-currency transactions and adapt to seasonal business variations. We employ specialized software and tailored strategies to ensure smooth financial operations in this dynamic sector.',
        ],
        [
            'question' => 'Can your payroll services be adapted for the varied and often seasonal workforce?',
            'answer' => 'Absolutely. Our payroll services are highly adaptable to the diverse and seasonal staffing patterns in the travel and logistics industry. We handle different employment types, from permanent staff to seasonal workers, ensuring compliance and accurate payroll processing.',
        ],
        [
            'question' => 'What role do your CFO services play in strategic planning for transportation and logistics operations?',
            'answer' => 'Our CFO services play a crucial role in strategic financial planning and decision-making for transportation and logistics operations in the travel industry. They provide insights on cost management, investment strategies, and financial forecasting tailored to the specific needs and challenges of this sector.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/transport-and-logistics.css'])
@endpush

@section('content')
    <div class="tls-page">
        {{-- Section 1: Hero Banner --}}
        <section class="tls-hero" aria-labelledby="tls-hero-title">
            <div class="site-shell tls-hero__inner">
                <div class="tls-hero__copy">
                    <p class="tls-hero__eyebrow">Pave the Way for Logistics Excellence with</p>
                    <h1 id="tls-hero-title">Transport and Logistics Business Process Outsourcing Services</h1>
                    <p class="tls-hero__lede">
                        Maximize fleet efficiency, optimize routes, and ensure timely deliveries. IBN Tech's BPO solutions redefine logistics, bringing precision and growth to your transportation business.
                    </p>
                    <div class="tls-hero__actions">
                        <a href="#contact-us" class="tls-btn tls-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="tls-hero__media">
                    <img
                        src="{{ $img('transport-and-logistics.webp') }}"
                        alt="Transport and Logistics"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 2: Intro / Overview --}}
        <section class="tls-section tls-section--intro" aria-labelledby="tls-intro-title">
            <div class="site-shell tls-intro-grid">
                <div class="tls-intro-grid__media">
                    <img
                        src="{{ $img('in-the-dynamic-world-of-transport.webp') }}"
                        alt="in the dynamic world of transport"
                        width="278"
                        height="353"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="tls-intro-grid__copy">
                    <h2 id="tls-intro-title" class="sr-only">About Our Transport and Logistics Outsourcing Services</h2>
                    <p>
                        In the dynamic world of transport and logistics, IBN Tech recognizes the challenges you face - from managing complex supply chains to adapting to market changes. High operational costs and the need for technological advancement remain pivotal concerns. Success in this sector is deeply linked to efficiency, reliability, and customer service. Our role? To provide specialized outsourcing services designed for transport and logistics enterprises. We focus on streamlining your operations and enhancing profitability, managing those critical yet cumbersome back-office tasks. This enables you to focus on what's important: delivering exceptional service and reliability to your clients.
                    </p>
                </div>
            </div>
        </section>

        {{-- Section 3: Services Grid --}}
        <section class="tls-section tls-section--services" aria-labelledby="tls-services-title">
            <div class="site-shell">
                <div class="tls-heading">
                    <h2 id="tls-services-title">
                        Transport and Logistics Process Outsourcing Services
                    </h2>
                    <p class="tls-heading__sub">for Freight, Shipping, and Distribution Companies</p>
                </div>

                <div class="tls-services-list">
                    @foreach ($services as $service)
                        <article class="tls-split{{ $service['imageRight'] ? '' : ' tls-split--flip' }}">
                            <div class="tls-split__copy">
                                <h3>{{ $service['title'] }}</h3>
                                <div class="tls-split__points">
                                    @foreach ($service['points'] as $point)
                                        <p>
                                            <strong>{{ $point['title'] }}</strong>{{ $point['text'] }}
                                        </p>
                                    @endforeach
                                </div>
                                <div class="tls-split__action">
                                    <a href="#contact-us" class="tls-btn tls-btn--navy">
                                        Get a Free Consultation Today
                                    </a>
                                </div>
                            </div>
                            <div class="tls-split__media">
                                <img
                                    src="{{ $img($service['image']) }}"
                                    alt="{{ $service['alt'] }}"
                                    width="400"
                                    height="400"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Section 4: Stats --}}
        <section class="tls-section tls-section--soft" aria-labelledby="tls-stats-title">
            <div class="site-shell">
                <div class="tls-heading">
                    <h2 id="tls-stats-title">Why IBN Tech is the</h2>
                    <p class="tls-heading__sub">Transport and Logistics Business Process Services</p>
                </div>

                <div class="tls-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="tls-stat tls-stat--{{ $stat['tone'] }}" role="listitem">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Section 5: Mid CTA Banner --}}
        <section class="tls-banner" aria-labelledby="tls-banner-title">
            <div class="site-shell tls-banner__inner">
                <h2 id="tls-banner-title">Transform Your Logistics and Transport Services</h2>
                <p>Discover how Our BPO Solutions Can Drive Efficiency, Enhance Customer Satisfaction, and Support Your Growth Ambitions!</p>
                <div class="tls-banner__action">
                    <a href="#contact-us" class="tls-btn tls-btn--green">
                        GET STARTED NOW
                    </a>
                </div>
            </div>
        </section>

        {{-- Section 6: Contact Form / Schedule A Call with Our Experts --}}
        <section class="tls-section tls-consult" id="contact-us" aria-labelledby="tls-consult-title">
            <div class="site-shell tls-consult__inner">
                <aside class="tls-consult__card" aria-labelledby="tls-consult-title">
                    <div class="tls-consult__header">
                        <h2 id="tls-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="tls-consult__body">
                        <livewire:forms.contact-form
                            form-name="transport-and-logistics"
                            id-prefix="tls"
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

                <div class="tls-consult__media">
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
        <section class="tls-testimonials" aria-labelledby="tls-testimonials-title">
            <div class="site-shell">
                <div class="tls-heading">
                    <p class="tls-testimonials__eyebrow">Discover Why IBN Tech Leads in</p>
                    <h2 id="tls-testimonials-title">Bookkeeping Services</h2>
                </div>

                <div
                    class="tls-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="tls-testimonials__nav tls-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
                        </svg>
                    </button>

                    <div class="tls-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="tls-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="tls-testimonials__nav tls-testimonials__nav--next"
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
        <section class="tls-section" aria-labelledby="tls-faq-title">
            <div class="site-shell">
                <div class="tls-heading">
                    <h2 id="tls-faq-title">Frequently Asked Questions (FAQ)</h2>
                </div>

                <div class="tls-faq-wrap">
                    <div class="tls-faq-wrap__media">
                        <img
                            src="{{ $img('faq-banner.webp') }}"
                            alt="faq-banner"
                            width="1080"
                            height="1080"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <div class="tls-faq">
                        @foreach ($faqs as $i => $faq)
                            <details @if ($i === 0) open @endif>
                                <summary>
                                    <span>{{ $faq['question'] }}</span>
                                    <span class="tls-faq__icon" aria-hidden="true">
                                        <svg class="tls-faq__icon-open" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 432V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48zm355.515-140.485l-123.03-123.03c-4.686-4.686-12.284-4.686-16.971 0L92.485 291.515c-7.56 7.56-2.206 20.485 8.485 20.485h246.059c10.691 0 16.045-12.926 8.486-20.485z"></path>
                                        </svg>
                                        <svg class="tls-faq__icon-closed" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M448 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zM92.5 220.5l123 123c4.7 4.7 12.3 4.7 17 0l123-123c7.6-7.6 2.2-20.5-8.5-20.5H101c-10.7 0-16.1 12.9-8.5 20.5z"></path>
                                        </svg>
                                    </span>
                                </summary>
                                <div class="tls-faq__content">
                                    <p>{{ $faq['answer'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
