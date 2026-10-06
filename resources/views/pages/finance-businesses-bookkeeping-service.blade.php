@php
    $img = fn (string $file): string => asset('images/finance-businesses-bookkeeping-service/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $recordFeatures = [
        [
            'icon' => 'transaction-recording.webp',
            'alt' => 'transaction recording',
            'title' => 'Transaction Recording',
            'text' => 'Achieve utmost accuracy in financial transactions, ensuring error-free records.',
        ],
        [
            'icon' => 'compliance-reporting.webp',
            'alt' => 'compliance reporting',
            'title' => 'Compliance Reporting',
            'text' => 'Your financial reports are meticulously prepared to always meet regulatory requirements, ensuring compliance without hassle.',
        ],
        [
            'icon' => 'account-reconciliations.webp',
            'alt' => 'account reconciliations',
            'title' => 'Account Reconciliations',
            'text' => 'Keep your accounts in perfect balance, ready for audit at any time, and instill confidence in your financial stability.',
        ],
        [
            'icon' => 'financial-reporting.webp',
            'alt' => 'financial reporting',
            'title' => 'Financial Reporting',
            'text' => 'Gain access to comprehensive, data-rich reports that empower strategic decision-making, offering you a competitive edge in your financial endeavors.',
        ],
    ];

    $stats = [
        ['value' => '30+', 'label' => 'Industry Served'],
        ['value' => '27+', 'label' => 'Years of Experience'],
        ['value' => '1,500+', 'label' => 'Active Global Clients'],
        ['value' => '50%', 'label' => 'Save operational cost'],
        ['value' => '95%', 'label' => 'Client Retention Rate'],
        ['value' => '99.99%', 'label' => 'Accuracy in Deliverables'],
        ['value' => '21+', 'label' => 'Accounting Software Expertise'],
        ['value' => '120+', 'label' => 'Qualified & Certified Bookkeepers'],
        ['value' => '10+', 'label' => 'Client-centric Account Managers'],
    ];

    $workSteps = [
        [
            'icon' => 'consultation.webp',
            'alt' => 'consultation',
            'title' => 'Step 1: Consultation',
            'text' => 'Understand your business needs.',
        ],
        [
            'icon' => 'onboarding.webp',
            'alt' => 'onboarding',
            'title' => 'Step 2 : Onboarding',
            'text' => 'Seamlessly integrate with your existing systems.',
        ],
        [
            'icon' => 'execution.webp',
            'alt' => 'execution',
            'title' => 'Step 3: Execution',
            'text' => 'Expert team members handle your bookkeeping tasks.',
        ],
        [
            'icon' => 'review.webp',
            'alt' => 'review',
            'title' => 'Step 4 : Review',
            'text' => 'Regular check-ins and reports ensure transparency.',
        ],
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
    @vite(['resources/css/pages/finance-businesses-bookkeeping-service.css'])
@endpush

@section('content')
    <div class="finbk-page">
        {{-- Hero --}}
        <section class="finbk-hero" aria-labelledby="finbk-hero-title">
            <div class="site-shell finbk-hero__inner">
                <div class="finbk-hero__copy">
                    <p class="finbk-hero__eyebrow">Empower your Financial Businesses with IBN Tech’s</p>
                    <h1 id="finbk-hero-title">
                        Outsourced Bookkeeping Services for Finance Businesses
                    </h1>
                    <p class="finbk-hero__lede">
                        Explore bookkeeping solutions for finance businesses that aim to enhance accuracy, reduce overhead costs, and provide insightful financial reporting for strategic decision-making.
                    </p>
                    <div class="finbk-hero__actions">
                        <a href="#contact-us" class="finbk-btn finbk-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="finbk-hero__media">
                    <img
                        src="{{ $img('bookkeeping-for-finance-businesses.webp') }}"
                        alt="Bookkeeping for Finance Businesses"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Fund Administration Outsourcing --}}
        <section class="finbk-section" aria-labelledby="finbk-fund-title">
            <div class="site-shell finbk-split">
                <div class="finbk-split__media">
                    <img
                        src="{{ $img('fund-administration-outsourcing.webp') }}"
                        alt="fund administration outsourcing"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="finbk-split__copy">
                    <h2 id="finbk-fund-title">Fund Administration Outsourcing Services</h2>
                    <p>
                        At IBN Tech, we understand that finance businesses are the backbone of the economy, yet managing financial records can be daunting. With a myriad of regulations and financial standards to comply with, it's easy to get overwhelmed.
                    </p>
                    <p>
                        Our specialized Bookkeeping Services for Finance Businesses are expertly designed to handle complex financial transactions, ensure regulatory compliance, and reduce administrative burdens, allowing you to focus on your core business activities.
                    </p>
                </div>
            </div>
        </section>

        {{-- Financial Record Excellence --}}
        <section class="finbk-section finbk-section--soft" aria-labelledby="finbk-records-title">
            <div class="site-shell">
                <div class="finbk-heading finbk-heading--center">
                    <h2 id="finbk-records-title">Financial Record Excellence</h2>
                    <h3>Navigate Financial Complexities with Expertise</h3>
                    <p>
                        Your business's financial health hinges on meticulous financial record-keeping. Our team ensures that every financial transaction is accurately recorded and managed. We provide you with:
                    </p>
                    <a href="#contact-us" class="finbk-btn finbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="finbk-feature-grid" role="list">
                    @foreach ($recordFeatures as $item)
                        <article class="finbk-feature-card" role="listitem">
                            <img
                                src="{{ $img($item['icon']) }}"
                                alt="{{ $item['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Customized Bookkeeping Services --}}
        <section class="finbk-section" aria-labelledby="finbk-custom-title">
            <div class="site-shell finbk-split">
                <div class="finbk-split__copy">
                    <h2 id="finbk-custom-title">Customized Bookkeeping Services</h2>
                    <h3>Tailored to Your Business's Unique Financial Needs</h3>
                    <p>
                        No matter the size of your finance business, our <strong>bookkeeping services</strong> are customized to meet your specific requirements. We offer:
                    </p>
                    <p>
                        <strong>Detailed Account Management:</strong> We deliver meticulous tracking and management of your financial accounts, ensuring nothing is overlooked.
                    </p>
                    <p>
                        <strong>Efficient Payroll Processing:</strong> Timely and precise payroll management guarantees accuracy and compliance, reducing your administrative burden.
                    </p>
                    <p>
                        <strong>Strategic Cash Flow Management:</strong> We optimize your cash flow to fuel seamless business operations, fostering growth and resilience.
                    </p>
                    <a href="#contact-us" class="finbk-btn finbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="finbk-split__media">
                    <img
                        src="{{ $img('fund-administration-outsourcing.webp') }}"
                        alt="fund administration outsourcing"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Technology-Driven Accuracy --}}
        <section class="finbk-section" aria-labelledby="finbk-tech-title">
            <div class="site-shell finbk-split">
                <div class="finbk-split__media">
                    <img
                        src="{{ $img('technology-driven-accuracy.webp') }}"
                        alt="technology-driven accuracy"
                        width="469"
                        height="418"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="finbk-split__copy">
                    <h2 id="finbk-tech-title">Technology-Driven Accuracy</h2>
                    <h3>Harness Advanced Tools for Precision and Efficiency</h3>
                    <p>
                        Our bookkeeping services leverage cutting-edge technology for unmatched accuracy and efficiency. We provide:
                    </p>
                    <p>
                        <strong>Automated Financial Efficiency:</strong> Our advanced tools minimize errors through automated data entry and processing, saving you time and resources.
                    </p>
                    <p>
                        <strong>Integrated Financial Systems:</strong> Seamlessly integrate various financial platforms for a consolidated view of your finances, simplifying decision-making.
                    </p>
                    <p>
                        <strong>Maximum Confidentiality:</strong> Rest easy knowing your sensitive financial information is handled with the utmost discretion and security, safeguarding your business's reputation.
                    </p>
                    <a href="#contact-us" class="finbk-btn finbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- What Makes IBN Tech --}}
        <section class="finbk-section finbk-stats-section" aria-labelledby="finbk-stats-title">
            <div class="site-shell">
                <div class="finbk-heading finbk-heading--center">
                    <h2 id="finbk-stats-title">What Makes IBN Tech</h2>
                    <p class="finbk-heading__sub">
                        Top Bookkeeping Services Provider for Marketing and Advertising Agencies
                    </p>
                </div>

                <div class="finbk-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="finbk-stat" role="listitem">
                            <p class="finbk-stat__value">{{ $stat['value'] }}</p>
                            <h3 class="finbk-stat__label">{{ $stat['label'] }}</h3>
                        </article>
                    @endforeach
                </div>

                <div class="finbk-section__cta">
                    <a href="#contact-us" class="finbk-btn finbk-btn--navy">
                        Let's Get Started
                    </a>
                </div>
            </div>
        </section>

        {{-- Transform banner --}}
        <section class="finbk-banner" aria-labelledby="finbk-banner-title">
            <div class="site-shell finbk-banner__inner">
                <h2 id="finbk-banner-title">Transform Your Agency's Finances with</h2>
                <p class="finbk-banner__lead">
                    <strong>Outsourced Bookkeeping Services for Marketing and Advertising Firms</strong>
                </p>
                <p class="finbk-banner__sub">No More Spreadsheets, Just Creativity and Growth!</p>
                <a href="#contact-us" class="finbk-btn finbk-btn--green">
                    Get Started Now
                </a>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="finbk-section" aria-labelledby="finbk-software-title">
            <div class="site-shell">
                <div class="finbk-heading finbk-heading--center">
                    <h2 id="finbk-software-title" class="finbk-software-title">
                        Software <span>Expertise</span>
                    </h2>
                </div>
                <div class="finbk-software">
                    <img
                        src="{{ $img('software-bookkeeping.webp') }}"
                        alt="Software-Bookkeeping"
                        width="1920"
                        height="900"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- How We Work --}}
        <section class="finbk-section finbk-section--soft" aria-labelledby="finbk-work-title">
            <div class="site-shell">
                <div class="finbk-heading finbk-heading--center">
                    <h2 id="finbk-work-title">How We Work</h2>
                    <p>IBN Tech's streamlined outsourcing process ensures swift and efficient operations:</p>
                </div>

                <div class="finbk-steps" role="list">
                    @foreach ($workSteps as $step)
                        <article class="finbk-step" role="listitem">
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

                <div class="finbk-section__cta">
                    <a href="#contact-us" class="finbk-btn finbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Areas We Serve --}}
        <section class="finbk-section" aria-labelledby="finbk-areas-title">
            <div class="site-shell">
                <div class="finbk-heading finbk-heading--center">
                    <h2 id="finbk-areas-title">Areas We Serve</h2>
                </div>

                <div class="finbk-areas">
                    @foreach ($areasColumns as $column)
                        <ul class="finbk-areas__col">
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

        {{-- Contact form --}}
        <section class="finbk-section finbk-consult" id="contact-us" aria-labelledby="finbk-consult-title">
            <div class="site-shell finbk-consult__inner">
                <aside class="finbk-consult__card" aria-labelledby="finbk-consult-title">
                    <div class="finbk-consult__header">
                        <h2 id="finbk-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="finbk-consult__body">
                        <livewire:forms.contact-form
                            form-name="finance-businesses-bookkeeping-service"
                            id-prefix="finbk"
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

                <div class="finbk-consult__media">
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
        <section class="finbk-testimonials" aria-labelledby="finbk-testimonials-title">
            <div class="site-shell">
                <div class="finbk-heading finbk-heading--center">
                    <p class="finbk-testimonials__eyebrow">Discover Why IBN Tech is the</p>
                    <h2 id="finbk-testimonials-title">Best Bookkeeping Firms in the USA</h2>
                </div>

                <div
                    class="finbk-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="finbk-testimonials__nav finbk-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="finbk-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="finbk-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="finbk-testimonials__nav finbk-testimonials__nav--next"
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
