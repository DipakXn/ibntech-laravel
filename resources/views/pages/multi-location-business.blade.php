@php
    $img = fn (string $file): string => asset('images/multi-location-business/'.$file);

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
            'image' => 'data-processing-services-6.webp',
            'alt' => 'data processing services',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Data Consistency and Integrity:',
                    'text' => ' Say goodbye to data inconsistencies and inaccurate information. Our standardized protocols and advanced technology ensure data integrity across all locations, giving you a clear and reliable picture of your business.',
                ],
                [
                    'title' => 'Real-time insights, real-time decisions:',
                    'text' => ' Our cutting-edge systems provide instant data access and analysis, giving you the power to make informed decisions and react quickly to opportunities.',
                ],
                [
                    'title' => 'Compliance with Local Regulations:',
                    'text' => ' We\'ve got your back with expertise in diverse data protection and privacy laws, ensuring smooth compliance for each of your locations.',
                ],
            ],
        ],
        [
            'title' => '2. Finance and Accounting',
            'image' => 'finance-and-accounting-6.webp',
            'alt' => 'finance and accounting',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Standardize Financial Processes:',
                    'text' => ' Eliminate the headaches of multiple accounting practices. We implement consistent processes across all locations, making reporting and consolidation effortless.',
                ],
                [
                    'title' => 'Inter-location Financial Transfers:',
                    'text' => ' We streamline inter-company fund transfers, manage currency fluctuations, and reconcile accounts, ensuring your financial flow remains smooth and transparent.',
                ],
                [
                    'title' => 'Customized Reporting:',
                    'text' => ' We tailor financial reports to meet the specific needs of each location, offering you a clear picture of individual financial performance and insights to optimize operations.',
                ],
            ],
        ],
        [
            'title' => '3. Bookkeeping',
            'image' => 'bookkeeping-7.webp',
            'alt' => 'bookkeeping',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Automated Recordkeeping:',
                    'text' => ' IBN Tech implements automated systems that will monitor transactions and reconcile books across all locations, eliminating errors and saving you valuable time.',
                ],
                [
                    'title' => 'Segmented Financial Tracking:',
                    'text' => ' We offer segmented revenue and expense tracking for each location, giving you a clear understanding of their financial performance and areas for improvement.',
                ],
                [
                    'title' => 'Accounting Software Integration:',
                    'text' => ' No more struggling with incompatible systems. We\'ll integrate your existing software to ensure smooth data flow and reporting.',
                ],
            ],
        ],
        [
            'title' => '4. AP/AR Management',
            'image' => 'ap-ar-management-1.webp',
            'alt' => 'ap-ar management',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Streamline your operations:',
                    'text' => ' Juggling invoices, payments, and collections across different time zones and currencies can be a logistical nightmare. That\'s why IBN Tech offers standardized processes and technology to ensure consistent and efficient AP/AR management across all locations, freeing you to focus on what matters most.',
                ],
                [
                    'title' => 'Reduce manual work:',
                    'text' => ' Our automated solutions will handle time-consuming tasks like invoice processing and payment reminders, freeing up your staff to focus on more strategic activities.',
                ],
                [
                    'title' => 'Gain real-time visibility:',
                    'text' => ' Our cloud-based platform provides you with a real-time overview of your AP/AR data across all locations, allowing you to make informed financial decisions.',
                ],
                [
                    'title' => 'Efficiently manage diverse vendors and customers:',
                    'text' => ' Let us handle the complexities of managing a variety of vendors and customers across locations, ensuring timely payments and collections.',
                ],
            ],
        ],
        [
            'title' => '5. Payroll Processing',
            'image' => 'payroll-processing-3.webp',
            'alt' => 'payroll processing',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Manage Diverse Employee Contracts and Pay Structures:',
                    'text' => ' We have the expertise to handle a variety of employment contracts, including different pay scales, benefits, and deductions, ensuring accurate and timely payroll processing.',
                ],
                [
                    'title' => 'Implement Efficient Time and Attendance Tracking:',
                    'text' => ' We will help you implement systems to accurately track time and attendance for all employees, regardless of location or work schedule.',
                ],
                [
                    'title' => 'Guarantee Payroll Accuracy:',
                    'text' => ' Our team will ensure accurate payroll processing for all employees across all locations, taking into account local regulations and deductions.',
                ],
            ],
        ],
        [
            'title' => '6. CFO Services',
            'image' => 'cfo-services-4.webp',
            'alt' => 'cfo services',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Gain Local Business Insights:',
                    'text' => ' Our CFOs possess a deep understanding of local business dynamics and market conditions in each location, enabling them to provide tailored financial advice and strategies that cater to the specific needs of each region.',
                ],
                [
                    'title' => 'Optimize Cash Flow and Inter-company Transactions:',
                    'text' => ' Gain control over your finances with our expertise in managing cash flow and inter-company transactions. We will optimize your financial operations, ensuring you have the funds you need to operate smoothly in all locations.',
                ],
                [
                    'title' => 'Receive Strategic Financial Planning and Advisory:',
                    'text' => ' Our CFOs will become your trusted partners, offering comprehensive financial planning and advisory services. We will help you develop strategic plans aligned with your overall business goals, considering the unique aspects of each location.',
                ],
                [
                    'title' => 'Enjoy Integrated Financial Reporting:',
                    'text' => ' We can create a fully integrated financial reporting system that encompasses all locations, offering you a clear and comprehensive overview of your business\'s financial health.',
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
            'question' => 'How do your data processing services handle the varied data needs of different locations within a multi-location business?',
            'answer' => 'Our services integrate data from multiple locations using centralized databases and advanced harmonization techniques, ensuring accuracy and real-time availability for consistent reporting and strategic decision-making.',
        ],
        [
            'question' => 'Can your finance and accounting services adapt to the diverse regulatory and tax environments of multi-location businesses?',
            'answer' => 'Yes, our services are designed to manage regional tax laws and financial regulations, providing tailored, compliant solutions for each location while maintaining a unified financial strategy.',
        ],
        [
            'question' => 'How do you ensure accurate and consistent bookkeeping across multiple business locations?',
            'answer' => 'We use standardized practices and advanced software for uniform financial records, conducting regular data synchronization and cross-location audits to maintain accuracy and integrity.',
        ],
        [
            'question' => 'What strategies do you use to optimize accounts payable and receivable management for businesses with multiple locations?',
            'answer' => 'We employ centralized processing with automated systems for invoice and payment handling, while adapting to each location\'s unique vendor and customer relationships for localized efficiency.',
        ],
        [
            'question' => 'How do your payroll services cater to the diverse employee and regulatory landscapes of multi-location businesses?',
            'answer' => 'Our payroll services are customizable for various employment structures and local regulations, ensuring compliance and a cohesive payroll system that respects the specific needs of each location.',
        ],
        [
            'question' => 'How do your outsourced CFO services assist in financial strategy and growth planning for multi-location businesses?',
            'answer' => 'Our CFO services provide expert guidance on location-specific financial strategies, aligning them with overall business goals. They offer insights into regional market trends and financial challenges, aiding in cost optimization and growth planning across the business network.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/multi-location-business.css'])
@endpush

@section('content')
    <div class="mlb-page">
        {{-- Hero --}}
        <section class="mlb-hero" aria-labelledby="mlb-hero-title">
            <div class="site-shell mlb-hero__inner">
                <div class="mlb-hero__copy">
                    <p class="mlb-hero__eyebrow">Unify Your Success Across Locations with IBN Tech's</p>
                    <h1 id="mlb-hero-title">Multi-Location Business Process Outsourcing Services</h1>
                    <p class="mlb-hero__lede">
                        Efficiently manage operations, data, and finances across your diverse locations. IBN Tech's BPO solutions provide the foundation for cohesive growth and centralized control.
                    </p>
                    <div class="mlb-hero__actions">
                        <a href="#contact-us" class="mlb-btn mlb-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="mlb-hero__media">
                    <img
                        src="{{ $img('multi-location-banner.webp') }}"
                        alt="multi-location-banner"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="mlb-section" aria-labelledby="mlb-intro-title">
            <div class="site-shell mlb-split">
                <div class="mlb-split__media">
                    <img
                        src="{{ $img('second-image-2.webp') }}"
                        alt="we expertly navigate the landscape"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="mlb-split__copy">
                    <h2 id="mlb-intro-title" class="sr-only">Multi-location business process outsourcing</h2>
                    <p>
                        At IBN Tech, we expertly navigate the landscape of multi-location businesses. Our specialized services are meticulously designed to address challenges in regulatory compliance, globalization, and service expansion. Whether operating across borders or within diverse regulatory frameworks, we adeptly manage various billing models, supporting high-growth sectors with precision. Our approach focuses on enhancing deliverables across industries, providing expertise in efficient invoice handling, thorough supplier audits, and robust recovery processes. Through meticulous monitoring and reporting, we ensure seamless operations and task execution in diverse business environments.
                    </p>
                </div>
            </div>
        </section>

        {{-- Services --}}
        <section class="mlb-section mlb-section--tight" aria-labelledby="mlb-services-title">
            <div class="site-shell">
                <div class="mlb-heading">
                    <h2 id="mlb-services-title">
                        Scalable Business Process Outsourcing Solutions for Multi-Location Businesses
                    </h2>
                </div>

                @foreach ($services as $service)
                    <article class="mlb-split{{ $service['imageRight'] ? '' : ' mlb-split--flip' }}">
                        <div class="mlb-split__copy">
                            <h3>{{ $service['title'] }}</h3>
                            @foreach ($service['points'] as $point)
                                <p>
                                    <strong>{{ $point['title'] }}</strong>{{ $point['text'] }}
                                </p>
                            @endforeach
                            <a href="#contact-us" class="mlb-btn mlb-btn--navy">
                                Get a Free Consultation Today
                            </a>
                        </div>
                        <div class="mlb-split__media">
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

        {{-- Stats --}}
        <section class="mlb-section mlb-section--soft" aria-labelledby="mlb-stats-title">
            <div class="site-shell">
                <div class="mlb-heading">
                    <h2 id="mlb-stats-title">Why IBN Tech is the</h2>
                    <p class="mlb-heading__sub">Multi-Location Business Process Services?</p>
                </div>

                <div class="mlb-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="mlb-stat mlb-stat--{{ $stat['tone'] }}" role="listitem">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="mlb-banner" aria-labelledby="mlb-banner-title">
            <div class="site-shell mlb-banner__inner">
                <h2 id="mlb-banner-title">Maximize Your Global Footprint!</h2>
                <p>Explore IBN Tech's BPO Solutions – Streamlining Multi-Location Operations, Ensuring Regulatory Compliance, and Igniting Strategic Growth!</p>
                <a href="#contact-us" class="mlb-btn mlb-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section class="mlb-section mlb-consult" id="contact-us" aria-labelledby="mlb-consult-title">
            <div class="site-shell mlb-consult__inner">
                <aside class="mlb-consult__card" aria-labelledby="mlb-consult-title">
                    <div class="mlb-consult__header">
                        <h2 id="mlb-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="mlb-consult__body">
                        <livewire:forms.contact-form
                            form-name="multi-location-business"
                            id-prefix="mlb"
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

                <div class="mlb-consult__media">
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
        <section class="mlb-testimonials" aria-labelledby="mlb-testimonials-title">
            <div class="site-shell">
                <div class="mlb-heading">
                    <p class="mlb-testimonials__eyebrow">Discover Why IBN Tech Leads in</p>
                    <h2 id="mlb-testimonials-title">Bookkeeping Services</h2>
                </div>

                <div
                    class="mlb-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="mlb-testimonials__nav mlb-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
                        </svg>
                    </button>

                    <div class="mlb-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="mlb-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="mlb-testimonials__nav mlb-testimonials__nav--next"
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

        {{-- FAQ --}}
        <section class="mlb-section" aria-labelledby="mlb-faq-title">
            <div class="site-shell">
                <div class="mlb-heading">
                    <h2 id="mlb-faq-title">Frequently Asked Questions (FAQ)</h2>
                </div>

                <div class="mlb-faq-wrap">
                    <div class="mlb-faq-wrap__media">
                        <img
                            src="{{ $img('faq-banner.webp') }}"
                            alt="faq-banner"
                            width="1080"
                            height="1080"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <div class="mlb-faq">
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
