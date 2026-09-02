@php
    $img = fn (string $file): string => asset('images/recruitment-firms/'.$file);

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
            'title' => '1. Data Processing Services',
            'image' => 'data-processing-services-2.webp',
            'alt' => 'data processing services',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Streamline Candidate Data Management:',
                    'text' => ' Automate the collection, processing, and integration of candidate data with your HR and recruitment systems for a seamless and efficient workflow.',
                ],
                [
                    'title' => 'Ensure Data Accuracy and Compliance:',
                    'text' => ' Utilize our expertise in data cleansing, validation, and encryption to protect candidate information and comply with recruitment-specific regulatory requirements.',
                ],
                [
                    'title' => 'Gain Insights from Data:',
                    'text' => ' Harness real-time analytics and advanced reporting to gain actionable insights, enabling you to refine and improve your recruitment strategies.',
                ],
            ],
        ],
        [
            'title' => '2. Bookkeeping',
            'image' => 'bookkeeping-2.webp',
            'alt' => 'bookkeeping',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Streamline your record-keeping :',
                    'text' => ' Let us transform your financial record-keeping with precision and ease, enhancing both accuracy and accessibility.',
                ],
                [
                    'title' => 'Eliminate discrepancies with regular reconciliation:',
                    'text' => ' Our regular reconciliation services not only prevent discrepancies but also maintain your firm\'s financial health, ensuring operational excellence.',
                ],
                [
                    'title' => 'Gain control over expenses:',
                    'text' => ' Take command of your expenses with our detailed operational and recruitment cost reports, empowering your strategic financial decisions',
                ],
                [
                    'title' => 'Enjoy software integration: ',
                    'text' => 'Our services seamlessly integrate with your existing accounting software and other business systems, simplifying your financial operations.',
                ],
            ],
        ],
        [
            'title' => '3. Finance and Accounting',
            'image' => 'finance-and-accounting-1.webp',
            'alt' => 'finance and accounting',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Optimize your cash flow:',
                    'text' => ' We implement efficient financial management strategies to ensure you have the necessary funds to support your recruitment activities and overall business operations.',
                ],
                [
                    'title' => 'Accurate budgeting and forecasting:',
                    'text' => ' We help you create precise budgets for your recruitment campaigns and overall business expenses, allowing you to make informed decisions and track progress.',
                ],
                [
                    'title' => 'Get timely and accurate financial reports:',
                    'text' => ' Gain access to transparent financial reports, offering deep insights into your fiscal performance, and guiding strategic decisions.',
                ],
            ],
        ],
        [
            'title' => '4. AP/AR Management',
            'image' => 'apar-management-2.webp',
            'alt' => 'apar management',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Process invoices efficiently:',
                    'text' => ' We implement efficient workflows to ensure the timely processing of invoices and payments, avoiding delays and disruptions.',
                ],
                [
                    'title' => 'Maintain effective credit control:',
                    'text' => ' We manage your credit effectively to ensure you receive timely payments and maintain a healthy cash flow.',
                ],
                [
                    'title' => 'Resolve disputes quickly and effectively:',
                    'text' => ' We have the expertise to handle any discrepancies in payments or invoicing efficiently and professionally. We foster positive relationships with your vendors and service providers, promoting trust and collaboration.',
                ],
            ],
        ],
        [
            'title' => '5. Payroll Processing',
            'image' => 'payroll-processing-2.webp',
            'alt' => 'payroll processing',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Ensure compliance and accuracy:',
                    'text' => ' We handle all tax deductions and comply with all relevant employment tax laws to avoid penalties and ensure accurate payroll processing.',
                ],
                [
                    'title' => 'Pay your employees on time:',
                    'text' => ' Our efficient system ensures timely and accurate delivery of salaries, bonuses, and commissions, boosting employee satisfaction and reducing errors.',
                ],
                [
                    'title' => 'Streamline payroll administration:',
                    'text' => ' Free up valuable time and resources by allowing us to handle the complexities of payroll administration.',
                ],
            ],
        ],
        [
            'title' => '6. CFO Services',
            'image' => 'cfo-services-2.webp',
            'alt' => 'cfo services',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Gain strategic financial insights:',
                    'text' => ' Our experienced CFOs provide comprehensive financial analysis, identify key trends, and offer expert advice on investments and expansion opportunities.',
                ],
                [
                    'title' => 'Develop a winning financial strategy:',
                    'text' => ' We work closely with you to develop a long-term financial strategy aligned with your business goals and objectives.',
                ],
                [
                    'title' => 'Mitigate financial risks: ',
                    'text' => 'Proactively identify and manage financial risks, ensuring your business remains resilient in the face of market fluctuations.',
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
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/recruitment-firms.css'])
@endpush

@section('content')
    <div class="rf-page">
        {{-- Hero --}}
        <section class="rf-hero" aria-labelledby="rf-hero-title">
            <div class="site-shell rf-hero__inner">
                <div class="rf-hero__copy">
                    <p class="rf-hero__eyebrow">Elevate Your Hiring Standards with</p>
                    <h1 id="rf-hero-title">Recruitment Firms Business Process Outsourcing Services</h1>
                    <p class="rf-hero__lede">
                        Experience a new era of recruitment efficiency. Our BPO solutions unlock your firm potential, delivering unparalleled results in candidate sourcing, screening, and placement.
                    </p>
                    <div class="rf-hero__actions">
                        <a href="#contact-us" class="rf-btn rf-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="rf-hero__media">
                    <img
                        src="{{ $img('recruitment-1.webp') }}"
                        alt="recruitment"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="rf-section" aria-labelledby="rf-intro-title">
            <div class="site-shell rf-split">
                <div class="rf-split__media">
                    <img
                        src="{{ $img('ibn-tech-stands.webp') }}"
                        alt="ibn tech stands"
                        width="516"
                        height="410"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="rf-split__copy">
                    <h2 id="rf-intro-title" class="sr-only">Recruitment firm process outsourcing</h2>
                    <p>
                        IBN Tech stands at the forefront of travel process outsourcing, transforming the way travel businesses operate. Our focus is not just on managing operations but on driving growth and enhancing productivity. By taking charge of routine tasks, we enable travel agencies to explore new revenue streams and opportunities. Our approach combines cost-effective solutions with deep industry insights, giving our clients a competitive edge in a rapidly evolving market. With IBN Tech, travel businesses receive more than just outsourcing services; they gain a strategic partner committed to their success in the dynamic world of travel and tourism.
                    </p>
                    <a href="#contact-us" class="rf-btn rf-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Services --}}
        <section class="rf-section rf-section--tight" aria-labelledby="rf-services-title">
            <div class="site-shell">
                <div class="rf-heading">
                    <h2 id="rf-services-title">Streamline Your Hiring Process with Expert Recruitment Outsourcing</h2>
                </div>

                @foreach ($services as $service)
                    <article class="rf-split{{ $service['imageRight'] ? '' : ' rf-split--flip' }}">
                        <div class="rf-split__copy">
                            <h3>{{ $service['title'] }}</h3>
                            @foreach ($service['points'] as $point)
                                <p>
                                    <strong>{{ $point['title'] }}</strong>{{ $point['text'] }}
                                </p>
                            @endforeach
                            <a href="#contact-us" class="rf-btn rf-btn--navy">
                                Get a Free Consultation Today
                            </a>
                        </div>
                        <div class="rf-split__media">
                            <img
                                src="{{ $img($service['image']) }}"
                                alt="{{ $service['alt'] }}"
                                width="500"
                                height="500"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- Stats --}}
        <section class="rf-section rf-section--soft" aria-labelledby="rf-stats-title">
            <div class="site-shell">
                <div class="rf-heading">
                    <h2 id="rf-stats-title">Why IBN Tech is Your Ideal</h2>
                    <p class="rf-heading__sub">Recruitment Firm Process Outsourcing Services?</p>
                </div>

                <div class="rf-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="rf-stat rf-stat--{{ $stat['tone'] }}" role="listitem">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="rf-banner" aria-labelledby="rf-banner-title">
            <div class="site-shell rf-banner__inner">
                <h2 id="rf-banner-title">Transform Your Hiring Process</h2>
                <p>Discover how our outsourcing solutions can transform your recruitment processes, enhance candidate and client experiences, and drive your firm's growth!</p>
                <a href="#contact-us" class="rf-btn rf-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section class="rf-section rf-consult" id="contact-us" aria-labelledby="rf-consult-title">
            <div class="site-shell rf-consult__inner">
                <aside class="rf-consult__card" aria-labelledby="rf-consult-title">
                    <div class="rf-consult__header">
                        <h2 id="rf-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="rf-consult__body">
                        <livewire:forms.contact-form
                            form-name="recruitment-firms"
                            id-prefix="rf"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="Briefly Describe Your Needs"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>
                <div class="rf-consult__media">
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
        <section class="rf-testimonials" aria-labelledby="rf-testimonials-title">
            <div class="site-shell">
                <div class="rf-heading">
                    <p class="rf-testimonials__eyebrow">Discover Why IBN Tech Leads in</p>
                    <h2 id="rf-testimonials-title">Bookkeeping Services</h2>
                </div>

                <div
                    class="rf-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="rf-testimonials__nav rf-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
                        </svg>
                    </button>

                    <div class="rf-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="rf-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="rf-testimonials__nav rf-testimonials__nav--next"
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
