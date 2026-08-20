@php
    $img = fn (string $file): string => asset('images/legal-bookkeeping-services/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $trustFeatures = [
        [
            'icon' => 'expense-categorization-and-analysis.webp',
            'alt' => 'expense categorization and analysis',
            'title' => 'Compliant Trust Account Management',
            'slug' => 'finance-and-accounting-services',
            'text' => 'Safeguard client funds with meticulous trust account management, ensuring your firm upholds the highest standards of fiduciary responsibility.',
        ],
        [
            'icon' => 'campaign-cost-analysis.webp',
            'alt' => 'campaign cost analysis',
            'title' => 'Accurate Time Tracking',
            'slug' => 'intelligent-process-automation',
            'text' => 'Capture every billable hour with our sophisticated tracking systems.',
        ],
        [
            'icon' => 'revenue-recognition.webp',
            'alt' => 'revenue recognition',
            'title' => 'Detailed Expense Management',
            'slug' => 'cfo-services',
            'text' => 'Gain unparalleled control over your firm\'s finances with detailed expense tracking, ensuring comprehensive financial clarity and oversight.',
        ],
    ];

    $outsourcingPoints = [
        [
            'title' => 'Account Reconciliations:',
            'text' => 'Keep your financial records in flawless condition with thorough reconciliations, reflecting the precision your legal practice is known for.',
        ],
        [
            'title' => 'Payroll Processing:',
            'text' => 'Ensure timely and precise compensation for your team, reinforcing your commitment to fairness and accuracy.',
        ],
        [
            'title' => 'Financial Reporting:',
            'text' => 'Make informed decisions with insightful monthly financial reports that illuminate your firm\'s economic trajectory.',
        ],
        [
            'title' => 'Cash Flow Management:',
            'text' => 'Master your firm\'s financial future with proactive cash flow management, ensuring liquidity and stability for sustained growth.',
        ],
    ];

    $strategicPoints = [
        [
            'title' => 'Bookkeeping Automation:',
            'text' => 'Integrate cutting-edge technology into your financial practices for enhanced efficiency and accuracy.',
        ],
        [
            'title' => 'Adherence to Legal Standards:',
            'text' => 'Rest easy knowing every financial process is aligned with legal industry standards, ensuring your firm\'s reputation for integrity.',
        ],
        [
            'title' => 'Confidentiality Assurance:',
            'text' => 'Trust in our uncompromising security measures to protect sensitive financial data, giving you peace of mind in a world of confidentiality.',
        ],
    ];

    $stats = [
        ['value' => '26+', 'label' => 'Years of Success', 'tone' => 'light'],
        ['value' => '1500+', 'label' => 'Active Client\'s', 'tone' => 'navy'],
        ['value' => '200+', 'label' => 'Clients Served', 'tone' => 'light'],
        ['value' => '99.99%', 'label' => 'Accuracy Achieved', 'tone' => 'navy'],
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

    $faqs = [
        [
            'question' => 'Can your bookkeeping services integrate with my current legal practice management software?',
            'answer' => 'Yes, our legal bookkeeping services are designed to seamlessly integrate with various legal practice management software. We ensure compatibility to streamline your financial processes and enhance overall efficiency.',
        ],
        [
            'question' => 'What are the rates for your legal bookkeeping services?',
            'answer' => 'Our legal bookkeeping service rates are tailored to meet the specific needs of your legal practice. To provide you with accurate pricing, we consider factors such as the size of your firm, the volume of transactions, and the level of customization required. Please contact us for a personalized quote that aligns with your unique requirements.',
        ],
        [
            'question' => 'How do you ensure confidentiality and security in your bookkeeping practices?',
            'answer' => 'We prioritize the utmost confidentiality and security of your financial data. Our practices include encrypted communication, restricted access protocols, and regular security audits. Rest assured, your sensitive information is safeguarded with the highest industry standards.',
        ],
        [
            'question' => 'How do I get started with your legal bookkeeping services?',
            'answer' => 'Getting started is simple. Reach out to us and we\'ll schedule a consultation to understand your specific needs, discuss the onboarding process, and tailor our services to align with your legal practice\'s financial requirements. Start optimizing your bookkeeping processes with us today.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/legal-bookkeeping-services.css'])
@endpush

@section('content')
    <div class="legbk-page">
        {{-- Hero --}}
        <section class="legbk-hero" aria-labelledby="legbk-hero-title">
            <div class="site-shell legbk-hero__inner">
                <div class="legbk-hero__copy">
                    <p class="legbk-hero__eyebrow">Unlock Your Law Firm's Financial Performance with</p>
                    <h1 id="legbk-hero-title">
                        Outsourced Legal Accounting and Bookkeeping Services
                    </h1>
                    <p class="legbk-hero__lede">
                        <strong>IBN Tech’s</strong> bookkeeping services for law firms ensure compliance, maximize profitability, and free you to focus on what you do best practicing law.
                    </p>
                    <div class="legbk-hero__actions">
                        <a href="#contact-us" class="legbk-btn legbk-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="legbk-hero__media">
                    <img
                        src="{{ $img('outsourced-legal-accounting.webp') }}"
                        alt="outsourced legal accounting"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="legbk-section" aria-labelledby="legbk-intro-title">
            <div class="site-shell legbk-split">
                <div class="legbk-split__media">
                    <img
                        src="{{ $img('at-ibn-tech-we-understand-that-marketing-and.webp') }}"
                        alt="at ibn tech, we understand that marketing and"
                        width="532"
                        height="362"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="legbk-split__copy">
                    <h2 id="legbk-intro-title" class="sr-only">Legal Bookkeeping Services</h2>
                    <p>
                        At IBN Tech, we recognize the distinct financial management needs of legal businesses. In such a demanding field, financial management should support, not hinder, your firm’s mission. Legal bookkeeping presents its own set of challenges, from trust accounting to compliance with strict regulatory standards.
                    </p>
                    <p>
                        Our specialized Legal Bookkeeping Services are expertly crafted to manage your firm's financials with the precision and attention to detail that the legal field demands. We take the burden off your shoulders, ensuring every financial aspect aligns with legal and ethical requirements, allowing you to concentrate on your clients.
                    </p>
                </div>
            </div>
        </section>

        {{-- Streamlined Trust Account Management --}}
        <section class="legbk-section legbk-section--soft" aria-labelledby="legbk-trust-title">
            <div class="site-shell">
                <div class="legbk-heading legbk-heading--center">
                    <h2 id="legbk-trust-title">Streamlined Trust Account Management</h2>
                    <h3>Elevate Trust Account Management for Legal Firms</h3>
                    <p>Ensuring the highest level of trust and accountability, our services include:</p>
                </div>

                <div class="legbk-trust-grid" role="list">
                    @foreach ($trustFeatures as $item)
                        <article class="legbk-trust-card" role="listitem">
                            <a href="{{ route('page.show', ['slug' => $item['slug']]) }}" tabindex="-1" aria-hidden="true">
                                <img
                                    src="{{ $img($item['icon']) }}"
                                    alt=""
                                    width="65"
                                    height="65"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </a>
                            <h3>
                                <a href="{{ route('page.show', ['slug' => $item['slug']]) }}">
                                    {{ $item['title'] }}
                                </a>
                            </h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="legbk-section__cta">
                    <a href="#contact-us" class="legbk-btn legbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Bookkeeping outsourcing services --}}
        <section class="legbk-section" aria-labelledby="legbk-outsource-title">
            <div class="site-shell legbk-split">
                <div class="legbk-split__copy">
                    <h2 id="legbk-outsource-title">bookkeeping outsourcing services</h2>
                    <h3>Customized to Legal Industry Standards</h3>
                    <p>
                        Your legal practice demands financial services that are as detailed and precise as the legal work you provide. Our <strong>outsourced bookkeeping services</strong> are meticulously tailored to meet these needs:
                    </p>
                    @foreach ($outsourcingPoints as $point)
                        <p>
                            <strong>{{ $point['title'] }}</strong> {{ $point['text'] }}
                        </p>
                    @endforeach
                    <a href="#contact-us" class="legbk-btn legbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="legbk-split__media">
                    <img
                        src="{{ $img('strategic-financial-management.webp') }}"
                        alt="strategic financial management"
                        width="500"
                        height="560"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Strategic Financial Management --}}
        <section class="legbk-section" aria-labelledby="legbk-strategic-title">
            <div class="site-shell legbk-split">
                <div class="legbk-split__media">
                    <img
                        src="{{ $img('at-ibn-tech-we-understand-that-marketing-and.webp') }}"
                        alt="at ibn tech, we understand that marketing and"
                        width="532"
                        height="362"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="legbk-split__copy">
                    <h2 id="legbk-strategic-title">Strategic Financial Management</h2>
                    <h3>Bookkeeping Innovation for Legal Businesses</h3>
                    <p>
                        Transform your financial management with our advanced automation services tailored for the legal sector's unique needs.
                    </p>
                    @foreach ($strategicPoints as $point)
                        <p>
                            <strong>{{ $point['title'] }}</strong> {{ $point['text'] }}
                        </p>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- What Makes IBN Tech --}}
        <section class="legbk-section" aria-labelledby="legbk-stats-title">
            <div class="site-shell">
                <div class="legbk-heading legbk-heading--center">
                    <h2 id="legbk-stats-title">What Makes IBN Tech</h2>
                    <p class="legbk-heading__sub">
                        Best Bookkeeping Services Provider for Healthcare Business
                    </p>
                </div>

                <div class="legbk-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="legbk-stat legbk-stat--{{ $stat['tone'] }}" role="listitem">
                            <p class="legbk-stat__value">{{ $stat['value'] }}</p>
                            <h3 class="legbk-stat__label">{{ $stat['label'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Banner CTA --}}
        <section class="legbk-banner" aria-labelledby="legbk-banner-title">
            <div class="site-shell legbk-banner__inner">
                <h2 id="legbk-banner-title">
                    Missing a financial detail can be as costly as a legal oversight.
                </h2>
                <hr class="legbk-banner__rule" aria-hidden="true">
                <p>Ensure your legal firm accounting is as precise as your legal documents.</p>
                <a href="#contact-us" class="legbk-btn legbk-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="legbk-section" aria-labelledby="legbk-software-title">
            <div class="site-shell">
                <div class="legbk-heading legbk-heading--center">
                    <h2 id="legbk-software-title" class="legbk-software-title">
                        Software <span>Expertise</span>
                    </h2>
                </div>
                <div class="legbk-software">
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
        <section class="legbk-section" aria-labelledby="legbk-work-title">
            <div class="site-shell">
                <div class="legbk-heading legbk-heading--center">
                    <h2 id="legbk-work-title">How We Work</h2>
                    <p>IBN Tech's streamlined outsourcing process ensures swift and efficient operations:</p>
                </div>

                <div class="legbk-steps" role="list">
                    @foreach ($workSteps as $step)
                        <article class="legbk-step" role="listitem">
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

                <div class="legbk-section__cta">
                    <a href="#contact-us" class="legbk-btn legbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Areas We Serve --}}
        <section class="legbk-section" aria-labelledby="legbk-areas-title">
            <div class="site-shell">
                <div class="legbk-heading legbk-heading--center">
                    <h2 id="legbk-areas-title">Areas We Serve</h2>
                </div>

                <div class="legbk-areas">
                    @foreach ($areasColumns as $column)
                        <ul class="legbk-areas__col">
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
        <section class="legbk-section legbk-consult" id="contact-us" aria-labelledby="legbk-consult-title">
            <div class="site-shell legbk-consult__inner">
                <aside class="legbk-consult__card" aria-labelledby="legbk-consult-title">
                    <div class="legbk-consult__header">
                        <h2 id="legbk-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="legbk-consult__body">
                        <livewire:forms.contact-form
                            form-name="legal-bookkeeping-services"
                            id-prefix="legbk"
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

                <div class="legbk-consult__media">
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
        <section class="legbk-testimonials" aria-labelledby="legbk-testimonials-title">
            <div class="site-shell">
                <div class="legbk-heading legbk-heading--center">
                    <p class="legbk-testimonials__eyebrow">Discover Why IBN Tech is the</p>
                    <h2 id="legbk-testimonials-title">Best Bookkeeping Firms in the USA</h2>
                </div>

                <div
                    class="legbk-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="legbk-testimonials__nav legbk-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="legbk-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="legbk-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="legbk-testimonials__nav legbk-testimonials__nav--next"
                        @click="next()"
                        aria-label="Next testimonial"
                    >
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="legbk-section legbk-section--soft" aria-labelledby="legbk-faq-title">
            <div class="site-shell">
                <div class="legbk-heading legbk-heading--center">
                    <h2 id="legbk-faq-title">Frequently Asked Questions (FAQ's)</h2>
                </div>

                <div class="legbk-faq">
                    <div class="legbk-faq__media">
                        <img
                            src="{{ $img('faq-banner.webp') }}"
                            alt="faq-banner"
                            width="1080"
                            height="1080"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>

                    <div class="legbk-faq__list">
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
