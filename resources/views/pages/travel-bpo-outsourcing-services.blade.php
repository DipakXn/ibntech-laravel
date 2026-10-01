@php
    $img = fn (string $file): string => asset('images/travel-bpo-outsourcing-services/'.$file);

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
            'title' => '1. Capitalize Every Mile Traveled',
            'image' => 'outsourced-bookkeeping-services-1.webp',
            'alt' => 'outsourced bookkeeping services',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Seamless Integration: ',
                    'text' => 'Struggling with multiple booking systems? Our expert team ensures smooth integration, allowing you to manage diverse platforms effortlessly.',
                ],
                [
                    'title' => 'Dynamic Pricing Mastery: ',
                    'text' => 'With our advanced data processing, stay ahead of fluctuating pricing trends for flights, hotels, and packages.',
                ],
                [
                    'title' => 'Customer Insight Analysis: ',
                    'text' => 'Leverage our expertise in processing and analyzing customer data to offer personalized travel experiences.',
                ],
            ],
        ],
        [
            'title' => '2. Finance and Accounting',
            'image' => 'finance-and-accounting-2.webp',
            'alt' => 'finance and accounting',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Multi-Currency Expertise: ',
                    'text' => 'Navigating various currencies? We manage transactions and exchange rate nuances with precision.',
                ],
                [
                    'title' => 'Commission Management: ',
                    'text' => 'Leave the complex task of tracking commissions to us, ensuring accurate and timely accounting.',
                ],
                [
                    'title' => 'Budgeting for Peaks and Troughs: ',
                    'text' => 'Our strategic budgeting accommodates seasonal fluctuations, keeping your finances on track.',
                ],
                [
                    'title' => 'Travel Tax Compliance: ',
                    'text' => 'Stay compliant with travel-specific tax regulations, including international VAT complexities.',
                ],
            ],
        ],
        [
            'title' => '3. Bookkeeping',
            'image' => 'bookkeeping-3.webp',
            'alt' => 'bookkeeping',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Efficient Invoice Reconciliation: ',
                    'text' => 'Tackle the complexity of vendor invoices with our streamlined reconciliation services.',
                ],
                [
                    'title' => 'Accurate Expense Allocation: ',
                    'text' => 'We ensure every expense is precisely allocated, maintaining financial clarity across your offerings.',
                ],
                [
                    'title' => 'Package Costing Accuracy: ',
                    'text' => 'Trust us to deliver exact costing for travel packages, factoring in all variable expenses.',
                ],
            ],
        ],
        [
            'title' => '4. AP/AR Management',
            'image' => 'apar-management-1-1.webp',
            'alt' => 'apar management',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Automated Payment Processing: ',
                    'text' => 'Transform your accounts payable and receivable with our state-of-the-art automation solutions. Experience streamlined handling of customer deposits, vendor advances, and payment collections.',
                ],
                [
                    'title' => 'Credit Terms Mastery: ',
                    'text' => 'We expertly negotiate and manage varying credit terms, enhancing your financial agility.',
                ],
                [
                    'title' => 'Mitigating Delayed Payments: ',
                    'text' => 'Our strategies minimize the impact of delayed payments, safeguarding your cash flow.',
                ],
            ],
        ],
        [
            'title' => '5. Payroll Processing',
            'image' => 'payroll-processing-1-1.webp',
            'alt' => 'payroll processing',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Incentive and Commission Structures: ',
                    'text' => 'Complex payroll structures? We handle them with ease, including incentives and commissions.',
                ],
                [
                    'title' => 'International Staff Compliance: ',
                    'text' => 'Our payroll services ensure full compliance for your international staff, covering taxation and labor laws.',
                ],
                [
                    'title' => 'Timely Employee Payments: ',
                    'text' => 'Ensure satisfaction with accurate and prompt employee payments.',
                ],
            ],
        ],
        [
            'title' => '6. CFO Services',
            'image' => 'cfo-services-strategic-financial-leadership.webp',
            'alt' => 'cfo services strategic financial leadership',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Strategic Financial Leadership: ',
                    'text' => 'Gain access to our team of US-based outsourced CFOs, bringing you top-tier financial expertise and leadership.',
                ],
                [
                    'title' => 'Informed Investment Decisions: ',
                    'text' => 'Make strategic investment choices in emerging markets and innovative technologies with insights from our experienced CFOs',
                ],
                [
                    'title' => 'Expert Risk Management and M&A Guidance: ',
                    'text' => 'Navigate risks in volatile regions and smoothly manage financial aspects during mergers or acquisitions under the stewardship of our seasoned CFOs.',
                ],
            ],
        ],
    ];

    $stats = [
        ['value' => '27+', 'label' => 'Years of Success', 'tone' => 'light'],
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
            'question' => 'What bookkeeping services do you provide for real estate businesses?',
            'answer' => 'Our comprehensive bookkeeping services for real estate businesses include financial reporting, bank reconciliations, accounts payable and receivable, payroll processing, and cash flow management. We specialize in catering to the unique financial aspects of real estate transactions, property management, and investment tracking.',
        ],
        [
            'question' => 'How much do your bookkeeping services cost for construction companies?',
            'answer' => 'Our bookkeeping service costs for construction companies are customized based on the specific needs and size of your business. We understand that each construction project is unique, and our pricing reflects the level of detail and complexity required. Contact us for a personalized quote that aligns with your company\'s financial requirements.',
        ],
        [
            'question' => 'Can your bookkeeping services sync with my existing real estate management software?',
            'answer' => 'Yes, our bookkeeping services are designed to seamlessly integrate with leading real estate management software systems. We ensure a smooth integration process with your existing setup, allowing for real-time financial tracking and reporting without disrupting your ongoing operations.',
        ],
        [
            'question' => 'What measures do you take to secure my financial data?',
            'answer' => 'IBN Tech prioritizes the security of your financial data with a multi-layered approach that includes encryption, secure servers, and strict access controls. Our team is trained in data privacy laws and best practices to ensure your sensitive information is handled with the utmost care and confidentiality.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/travel-bpo-outsourcing-services.css'])
@endpush

@section('content')
    <div class="tbps-page">
        {{-- Section 1: Hero Banner --}}
        <section class="tbps-hero" aria-labelledby="tbps-hero-title">
            <div class="site-shell tbps-hero__inner">
                <div class="tbps-hero__copy">
                    <p class="tbps-hero__eyebrow">Elevate Your Travel Operations with</p>
                    <h1 id="tbps-hero-title">Travel Business Process Outsourcing Services</h1>
                    <p class="tbps-hero__lede">
                        From seamless booking processes to strategic financial management, our tailored solutions ensure your travel business soars to new heights. Elevate customer experiences and operational excellence with IBN Tech.
                    </p>
                    <div class="tbps-hero__actions">
                        <a href="#contact-us" class="tbps-btn tbps-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="tbps-hero__media">
                    <img
                        src="{{ $img('travel-business-process.webp') }}"
                        alt="Travel Business Process"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 2: Intro / Company Overview --}}
        <section class="tbps-section tbps-section--intro" aria-labelledby="tbps-intro-title">
            <div class="site-shell tbps-intro-grid">
                <div class="tbps-intro-grid__copy">
                    <h2 id="tbps-intro-title">IBN Tech - Leading Travel Process Outsourcing Company</h2>
                    <p>
                        IBN Tech stands at the forefront of travel process outsourcing, transforming the way travel businesses operate. Our focus is not just on managing operations but on driving growth and enhancing productivity. By taking charge of routine tasks, we enable travel agencies to explore new revenue streams and opportunities. Our approach combines cost-effective solutions with deep industry insights, giving our clients a competitive edge in a rapidly evolving market. With IBN Tech, travel businesses receive more than just outsourcing services; they gain a strategic partner committed to their success in the dynamic world of travel and tourism.
                    </p>
                    <div class="tbps-intro-grid__action">
                        <a href="#contact-us" class="tbps-btn tbps-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="tbps-intro-grid__media">
                    <img
                        src="{{ $img('ibn-tech-leading-travel-process-outsourcing-company.webp') }}"
                        alt="ibn tech - leading travel process outsourcing company"
                        width="526"
                        height="518"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 3: Services Section --}}
        <section class="tbps-section tbps-section--services" aria-labelledby="tbps-services-title">
            <div class="site-shell">
                <div class="tbps-heading">
                    <h2 id="tbps-services-title">
                        Travel business process outsourcing services
                    </h2>
                    <p class="tbps-heading__sub">for Travel Businesses and Tour Operators</p>
                </div>

                <div class="tbps-services-list">
                    @foreach ($services as $service)
                        <article class="tbps-split{{ $service['imageRight'] ? '' : ' tbps-split--flip' }}">
                            <div class="tbps-split__copy">
                                <h3>{{ $service['title'] }}</h3>
                                <div class="tbps-split__points">
                                    @foreach ($service['points'] as $point)
                                        <p>
                                            <strong>{{ $point['title'] }}</strong>{{ $point['text'] }}
                                        </p>
                                    @endforeach
                                </div>
                                <div class="tbps-split__action">
                                    <a href="#contact-us" class="tbps-btn tbps-btn--navy">
                                        Get a Free Consultation Today
                                    </a>
                                </div>
                            </div>
                            <div class="tbps-split__media">
                                <img
                                    src="{{ $img($service['image']) }}"
                                    alt="{{ $service['alt'] }}"
                                    width="516"
                                    height="412"
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
        <section class="tbps-section tbps-section--soft" aria-labelledby="tbps-stats-title">
            <div class="site-shell">
                <div class="tbps-heading">
                    <h2 id="tbps-stats-title">Why IBN Tech is the</h2>
                    <p class="tbps-heading__sub">Outsourcing Your Travel Business Processes?</p>
                </div>

                <div class="tbps-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="tbps-stat tbps-stat--{{ $stat['tone'] }}" role="listitem">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Section 5: Mid CTA Banner --}}
        <section class="tbps-banner" aria-labelledby="tbps-banner-title">
            <div class="site-shell tbps-banner__inner">
                <h2 id="tbps-banner-title">Transform Your Travel Business Back Office Operations</h2>
                <p>Discover How Our BPO Services Can Simplify Your Processes, Enhance Customer Experience, and Increase Revenue!</p>
                <div class="tbps-banner__action">
                    <a href="#contact-us" class="tbps-btn tbps-btn--green">
                        GET STARTED NOW
                    </a>
                </div>
            </div>
        </section>

        {{-- Section 6: Consultation / Form --}}
        <section class="tbps-section tbps-consult" id="contact-us" aria-labelledby="tbps-consult-title">
            <div class="site-shell tbps-consult__inner">
                <aside class="tbps-consult__card" aria-labelledby="tbps-consult-title">
                    <div class="tbps-consult__header">
                        <h2 id="tbps-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="tbps-consult__body">
                        <livewire:forms.contact-form
                            form-name="travel-bpo-outsourcing-services"
                            id-prefix="tbps"
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

                <div class="tbps-consult__media">
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
        <section class="tbps-testimonials" aria-labelledby="tbps-testimonials-title">
            <div class="site-shell">
                <div class="tbps-heading">
                    <p class="tbps-testimonials__eyebrow">Discover Why IBN Tech Leads in</p>
                    <h2 id="tbps-testimonials-title">BOOKKEEPING SERVICES</h2>
                </div>

                <div
                    class="tbps-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="tbps-testimonials__nav tbps-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
                        </svg>
                    </button>

                    <div class="tbps-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="tbps-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="tbps-testimonials__nav tbps-testimonials__nav--next"
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
        <section class="tbps-section tbps-section--faq" aria-labelledby="tbps-faq-title">
            <div class="site-shell">
                <div class="tbps-heading">
                    <h2 id="tbps-faq-title">Frequently Asked Questions (FAQ)</h2>
                </div>

                <div class="tbps-faq">
                    @foreach ($faqs as $i => $faq)
                        <details @if ($i === 0) open @endif>
                            <summary>
                                <span>{{ $faq['question'] }}</span>
                                <span class="tbps-faq__icon" aria-hidden="true">
                                    <svg class="tbps-faq__icon-open" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 432V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48zm355.515-140.485l-123.03-123.03c-4.686-4.686-12.284-4.686-16.971 0L92.485 291.515c-7.56 7.56-2.206 20.485 8.485 20.485h246.059c10.691 0 16.045-12.926 8.486-20.485z"></path>
                                    </svg>
                                    <svg class="tbps-faq__icon-closed" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M448 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zM92.5 220.5l123 123c4.7 4.7 12.3 4.7 17 0l123-123c7.6-7.6 2.2-20.5-8.5-20.5H101c-10.7 0-16.1 12.9-8.5 20.5z"></path>
                                    </svg>
                                </span>
                            </summary>
                            <div class="tbps-faq__content">
                                <p>{{ $faq['answer'] }}</p>
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
