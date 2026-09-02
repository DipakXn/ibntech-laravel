@php
    $img = fn (string $file): string => asset('images/mortgage/'.$file);
    $pageUrl = fn (string $slug): string => \App\Support\PathPageUrl::withTrailingSlash(route('page.show', ['slug' => $slug]));

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
            'image' => 'data-processing-services-5.webp',
            'alt' => 'data processing services',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Data Inconsistency and Inaccuracy: ',
                    'text' => 'Eliminate errors and delays in loan processing with our precision-driven data processing services. We ensure consistent, accurate data management, crucial for regulatory compliance and efficient operations',
                ],
                [
                    'title' => 'Data Silos and Integration: ',
                    'text' => 'Overcome integration hurdles with our sophisticated solutions, offering you a unified view of data for better decision-making and operational transparency.',
                ],
                [
                    'title' => 'Expert Data Management: ',
                    'text' => 'Leverage our data expertise to handle complex data pipelines, turning your data into actionable insights and strategic advantages.',
                ],
            ],
        ],
        [
            'title' => '2. Finance and Accounting',
            'image' => 'finance-and-accounting-5.webp',
            'alt' => 'finance and accounting',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Loan Servicing and Collections Management: ',
                    'text' => 'Enhance your loan servicing efficiency, from payment tracking to handling delinquencies, through our robust accounting procedures.',
                ],
                [
                    'title' => 'Financial Reporting and Analysis: ',
                    'text' => 'Access timely and precise financial reports, empowering your strategic decisions and performance tracking.',
                ],
                [
                    'title' => 'Navigating Complex Regulations: ',
                    'text' => 'Stay ahead of regulatory challenges with our comprehensive <a href="'.$pageUrl('finance-and-accounting-services').'">finance and accounting services</a>, ensuring accurate reporting and compliance.',
                    'html' => true,
                ],
            ],
        ],
        [
            'title' => '3. Bookkeeping',
            'image' => 'bookkeeping-6.webp',
            'alt' => 'bookkeeping',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Maintaining Account Balances: ',
                    'text' => 'Trust our meticulous attention to detail in tracking income, expenses, and loan balances, ensuring your accounts reflect the true financial status of your business.',
                ],
                [
                    'title' => 'Reconciling Transactions: ',
                    'text' => 'Master the complexity of mortgage transactions with our expert bookkeeping services. We ensure seamless reconciliation, maintaining the accuracy and integrity of your financial records.',
                ],
                [
                    'title' => 'Tax Preparation and Regulatory Reporting: ',
                    'text' => 'Relieve the burden of tax preparation and regulatory reporting. Our in-depth knowledge of tax regulations specific to the mortgage industry ensures accurate and compliant filings.',
                ],
            ],
        ],
        [
            'title' => '4. AP/AR Management',
            'image' => 'apar-management-1-3.webp',
            'alt' => 'apar management',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Streamlining Accounts Payable: ',
                    'text' => 'Efficiently manage your invoices and payments with our streamlined AP services. We ensure timely payments, fraud prevention, and workflow optimization.',
                ],
                [
                    'title' => 'Effective Accounts Receivable Collection: ',
                    'text' => 'Enhance your collections with our robust strategies and communication tools, improving cash flow and reducing delinquencies.',
                ],
                [
                    'title' => 'Maintaining Healthy Cash Flow: ',
                    'text' => 'Balance your income and expenses expertly with our management services, ensuring your business always has the liquidity to meet its operational needs.',
                ],
            ],
        ],
        [
            'title' => '5. Payroll Processing',
            'image' => 'payroll-processing-1-3.webp',
            'alt' => 'payroll processing',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Complex Payroll Management: ',
                    'text' => 'Handle diverse pay structures, commissions, and bonuses effortlessly with our payroll services, eliminating errors and simplifying calculations.',
                ],
                [
                    'title' => 'Efficient Management of Payroll Taxes and Benefits: ',
                    'text' => 'Manage your payroll taxes and employee benefits efficiently, ensuring compliance with labor laws and reducing administrative burdens.',
                ],
                [
                    'title' => 'Compliance with Tax Regulations: ',
                    'text' => 'Navigate the complexities of payroll tax regulations with our expertise. We ensure accurate withholdings, deductions, and tax filings, keeping your business compliant and secure.',
                ],
            ],
        ],
        [
            'title' => '6. CFO Services',
            'image' => 'cfo-services-1-2.webp',
            'alt' => 'cfo services',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Financial Risk Management: ',
                    'text' => 'Mitigate financial risks inherent in the mortgage sector, such as interest rate volatility and credit risks, with our seasoned CFOs who bring industry-specific knowledge and risk management strategies.',
                ],
                [
                    'title' => 'Capital and Investment Management: ',
                    'text' => 'Managing capital effectively is key in the mortgage business. Our CFO services assist in making informed decisions about investments, funding options, and capital utilization to optimize financial health.',
                ],
                [
                    'title' => 'Performance Measurement and Improvement: ',
                    'text' => 'Implement robust financial performance metrics and improvement strategies. Our CFOs help in setting up efficient systems for tracking financial performance, identifying areas for cost reduction, and driving profitability.',
                ],
                [
                    'title' => 'Regulatory Compliance and Reporting: ',
                    'text' => 'Navigating the complex regulatory landscape is a significant challenge for mortgage businesses. Our CFOs ensure compliance with financial regulations, reducing the risk of penalties and enhancing credibility with stakeholders.',
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
            'question' => 'What measures are in place for data backup and recovery in your data processing services?',
            'answer' => 'IBN Tech employs advanced cloud-based backup solutions and redundant storage systems for robust data protection. Regular backups, alongside comprehensive disaster recovery plans, ensure quick data restoration and minimal downtime in case of any disruptions.',
        ],
        [
            'question' => 'How do you manage the confidentiality of financial records in your bookkeeping services?',
            'answer' => 'Our bookkeeping services prioritize confidentiality through strict data privacy policies, advanced encryption, and controlled access. We maintain high-security standards and comply with industry regulations to ensure the privacy and safety of financial records.',
        ],
        [
            'question' => 'What technologies do you use to streamline accounts payable and receivable processes?',
            'answer' => 'IBN Tech utilizes automated invoicing systems, electronic payment solutions, and AI-driven tools integrated with cloud-based accounting platforms. These technologies enhance efficiency, and accuracy, and provide better cash flow visibility in accounts payable and receivable processes.',
        ],
        [
            'question' => 'Can your payroll services be customized for different employee structures in the mortgage industry?',
            'answer' => 'Yes, our payroll services are customizable to accommodate various employee structures in the mortgage industry, ensuring compliance with tax laws and labor regulations while managing diverse pay scales, commissions, and bonuses.',
        ],
        [
            'question' => 'What role do your CFO services play in guiding mortgage businesses through financial audits and reviews?',
            'answer' => 'Our CFO services provide expert guidance through financial audits and reviews, ensuring accuracy and compliance in financial records. They assist in best practice implementation, smooth auditor communication, and effective response to audit findings.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/mortgage.css'])
@endpush

@section('content')
    <div class="mtg-page">
        {{-- Hero --}}
        <section class="mtg-hero" aria-labelledby="mtg-hero-title">
            <div class="site-shell mtg-hero__inner">
                <div class="mtg-hero__copy">
                    <p class="mtg-hero__eyebrow">Unlock New Horizons for Your Mortgage Business with IBN Tech's</p>
                    <h1 id="mtg-hero-title">Mortgage process outsourcing</h1>
                    <p class="mtg-hero__lede">
                        Navigate the complexities of mortgage operations seamlessly. From data-driven loan processing to financial compliance, IBN Tech is your dedicated partner for success in the mortgage industry.
                    </p>
                    <div class="mtg-hero__actions">
                        <a href="#contact-us" class="mtg-btn mtg-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="mtg-hero__media">
                    <img
                        src="{{ $img('mortgage-process.webp') }}"
                        alt="Mortgage process"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="mtg-section" aria-labelledby="mtg-intro-title">
            <div class="site-shell mtg-split">
                <div class="mtg-split__media">
                    <img
                        src="{{ $img('at-ibn-tech-1.webp') }}"
                        alt="at ibn tech"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="mtg-split__copy">
                    <h2 id="mtg-intro-title" class="sr-only">Mortgage back-office outsourcing</h2>
                    <p>
                        At IBN Tech, we understand the intricacies and challenges faced in the mortgage industry, including the need for precision in loan processing, regulatory compliance, and the importance of timely customer service. We know that success in the mortgage sector hinges on accuracy, efficiency, and customer satisfaction, which can be compromised by back-office bottlenecks and outdated technology. This is where our specialized outsourcing services come in. We offer tailor-made solutions for mortgage brokers, lenders, and loan servicing firms. Our goal is to boost your efficiency and profitability by handling those critical, yet time-consuming back-office tasks, allowing you to focus more on providing exceptional client services.
                    </p>
                    <a href="#contact-us" class="mtg-btn mtg-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Services --}}
        <section class="mtg-section mtg-section--tight" aria-labelledby="mtg-services-title">
            <div class="site-shell">
                <div class="mtg-heading">
                    <h2 id="mtg-services-title">Mortgage business process outsourcing</h2>
                    <p class="mtg-heading__sub">for Brokers, Lenders, and Loan Servicing Firms</p>
                </div>

                @foreach ($services as $service)
                    <article class="mtg-split{{ $service['imageRight'] ? '' : ' mtg-split--flip' }}">
                        <div class="mtg-split__copy">
                            <h3>{{ $service['title'] }}</h3>
                            @foreach ($service['points'] as $point)
                                <p>
                                    <strong>{{ $point['title'] }}</strong>@if (! empty($point['html'])){!! $point['text'] !!}@else{{ $point['text'] }}@endif
                                </p>
                            @endforeach
                            <a href="#contact-us" class="mtg-btn mtg-btn--navy">
                                Get a Free Consultation Today
                            </a>
                        </div>
                        <div class="mtg-split__media">
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
        </section>

        {{-- Stats --}}
        <section class="mtg-section mtg-section--soft" aria-labelledby="mtg-stats-title">
            <div class="site-shell">
                <div class="mtg-heading">
                    <h2 id="mtg-stats-title">Why IBN Tech is the</h2>
                    <p class="mtg-heading__sub">Mortgage Business Outsourcing Needs?</p>
                </div>

                <div class="mtg-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="mtg-stat mtg-stat--{{ $stat['tone'] }}" role="listitem">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="mtg-banner" aria-labelledby="mtg-banner-title">
            <div class="site-shell mtg-banner__inner">
                <h2 id="mtg-banner-title">Fast-Track Your Mortgage Processing</h2>
                <p>Streamline Loan Applications, Reduce Processing Time, and Improve Customer Experience with Our Expert BPO Services!</p>
                <a href="#contact-us" class="mtg-btn mtg-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="mtg-section mtg-consult"
            id="contact-us"
            aria-labelledby="mtg-consult-title"
        >
            <div class="site-shell mtg-consult__inner">
                <aside class="mtg-consult__card" aria-labelledby="mtg-consult-title">
                    <div class="mtg-consult__header">
                        <h2 id="mtg-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="mtg-consult__body">
                        <livewire:forms.contact-form
                            form-name="mortgage"
                            id-prefix="mtg"
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
                <div class="mtg-consult__media">
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
        <section class="mtg-testimonials" aria-labelledby="mtg-testimonials-title">
            <div class="site-shell">
                <div class="mtg-heading">
                    <p class="mtg-testimonials__eyebrow">Discover Why IBN Tech Leads in</p>
                    <h2 id="mtg-testimonials-title">Bookkeeping Services</h2>
                </div>

                <div
                    class="mtg-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="mtg-testimonials__nav mtg-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
                        </svg>
                    </button>

                    <div class="mtg-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="mtg-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="mtg-testimonials__nav mtg-testimonials__nav--next"
                        @click="next()"
                        aria-label="Next testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M696 533C708 521 713 504 713 487 713 471 708 454 696 446L400 146C388 133 375 125 354 125 338 125 325 129 313 142 300 154 292 171 292 204 296 221 308 233L563 492 304 771C292 783 288 800 288 817 288 833 296 850 308 863 321 871 338 875 354 875 371 875 388 867 400 854L696 533Z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="mtg-section" aria-labelledby="mtg-faq-title">
            <div class="site-shell">
                <div class="mtg-heading">
                    <h2 id="mtg-faq-title">Frequently Asked Questions (FAQ)</h2>
                </div>

                <div class="mtg-faq">
                    <div class="mtg-faq__media">
                        <img
                            src="{{ $img('faq-banner.webp') }}"
                            alt="faq-banner"
                            width="1080"
                            height="1080"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <div class="mtg-faq__list">
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
