@php
    $img = fn (string $file): string => asset('images/real-estate-construction-bookkeeping-services/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $challenges = [
        [
            'icon' => 'managing-costs.webp',
            'alt' => 'Complex Payroll Costs',
            'title' => 'Managing Costs',
            'text' => 'Tracking labor, materials, and rental expenses is complex, often leading to budget overruns. We address this by accurately tracking and allocating costs to prevent inefficiencies and maximize profitability',
        ],
        [
            'icon' => 'compliance-issues.png',
            'alt' => 'Compliance Issues',
            'title' => 'Compliance Issues',
            'text' => 'Navigating labor laws in construction and IRS guidelines in real estate can be difficult. We ensure full compliance with evolving regulations, helping you avoid costly penalties and legal issues',
        ],
        [
            'icon' => 'accurate-record-keeping.webp',
            'alt' => 'Dynamic Pricing',
            'title' => 'Accurate Record-Keeping',
            'text' => 'Errors in financial records can lead to mismanagement. Our advanced bookkeeping tools maintain precise records, empowering you to make informed financial decisions and stay on top of your finances',
        ],
        [
            'icon' => 'maximizing-tax-deductions.webp',
            'alt' => 'Vendor Contracts',
            'title' => 'Maximizing Tax Deductions',
            'text' => 'Both industries require careful tracking of project costs and expenses like mortgage interest. We help you identify and claim all eligible deductions while ensuring IRS compliance',
        ],
    ];

    $softwareLogos = [
        ['file' => 'acumatica.webp', 'alt' => 'acumatica'],
        ['file' => 'daxco.webp', 'alt' => 'daxco'],
        ['file' => 'dynamics-365.webp', 'alt' => 'dynamics 365'],
        ['file' => 'ez.webp', 'alt' => 'ez'],
        ['file' => 'bill-com.webp', 'alt' => 'bill.com'],
        ['file' => 'intacct.webp', 'alt' => 'intacct'],
        ['file' => 'microsoft-dynamics-gp.webp', 'alt' => 'microsoft-dynamics-gp'],
        ['file' => 'netsuite.webp', 'alt' => 'netsuite'],
        ['file' => 'oracle-netsuite.webp', 'alt' => 'oracle-netsuite'],
        ['file' => 'peachtree.webp', 'alt' => 'peachtree'],
        ['file' => 'quickbooks.webp', 'alt' => 'quickbooks'],
        ['file' => 'realpage.webp', 'alt' => 'realpage'],
        ['file' => 'sage50.webp', 'alt' => 'sage50'],
        ['file' => 'xero.webp', 'alt' => 'xero software for small business'],
        ['file' => 'yardi.webp', 'alt' => 'yardi'],
        ['file' => 'wave.webp', 'alt' => 'wave'],
    ];

    $whyChoose = [
        [
            'title' => 'Industry Expertise',
            'text' => 'Our experienced team specializes in real estate and construction accounting, offering tailored solutions to meet your financial challenges.',
        ],
        [
            'title' => 'Technology-Driven Approach',
            'text' => 'We use advanced tools like QuickBooks and Xero to deliver real-time insights and ensure accuracy.',
        ],
        [
            'title' => 'Cost-Effective Solutions',
            'text' => 'Outsource your bookkeeping to save on administrative costs while receiving top-tier financial management services.',
        ],
        [
            'title' => 'Accuracy, Security, and Reliability',
            'text' => 'We ensure precise, dependable data management with rigorous quality controls and a secure, access-restricted environment.',
        ],
        [
            'title' => 'Dedicated Expert Team with 24/7 Support',
            'text' => 'Our team ensures compliance and expert guidance with up-to-date industry knowledge, offering 24/7 support for fast communication and proactive financial insights.',
        ],
        [
            'title' => 'Multi-Domain Expertise',
            'text' => 'Our team’s broad experience in real estate and construction ensures specialized solutions for your accounting needs.',
        ],
    ];

    $benefitColumns = [
        [
            'Accurate tracking of project costs',
            'Better management of labor and materials',
            'Improved budget control and profitability',
        ],
        [
            'Compliance with tax laws and labor regulations',
            'Streamlined invoicing and payment processes',
            'Maximized tax deductions for construction projects',
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
    @vite(['resources/css/pages/real-estate-construction-bookkeeping-services.css'])
@endpush

@section('content')
    <div class="recbk-page">
        {{-- Hero --}}
        <section class="recbk-hero" aria-labelledby="recbk-hero-title">
            <div class="site-shell recbk-hero__inner">
                <div class="recbk-hero__copy">
                    <h1 id="recbk-hero-title">
                        Outsourced Real Estate and Construction Bookkeeping Services
                    </h1>
                    <p class="recbk-hero__lede">
                        With 27+ years of experience, we provide tailored real estate and construction bookkeeping for contractors, single properties or large portfolios, using software like Yardi and QuickBooks for precise financial management, including month-end reporting, cost segregation, and property management accounting
                    </p>
                </div>

                <aside class="recbk-hero__form" id="contact-us" aria-labelledby="recbk-hero-form-title">
                    <h2 id="recbk-hero-form-title">Want to Improve Your Accounting ?</h2>
                    <p class="recbk-hero__form-sub">Submit the Form to Get Started!</p>

                    <livewire:forms.contact-form
                        form-name="real-estate-construction-bookkeeping-services"
                        id-prefix="recbk"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$formServiceOptions"
                        service-placeholder="Please Select Services"
                        message-placeholder="What kind of accounting solution are you looking for?"
                        submit-label="Submit"
                        layout="home"
                    />
                </aside>
            </div>
        </section>

        {{-- Intro card --}}
        <section class="recbk-intro" aria-labelledby="recbk-intro-title">
            <div class="site-shell">
                <div class="recbk-intro__card">
                    <h2 id="recbk-intro-title">
                        Master Your Real Estate and Construction Finances—Build, Sell, and Succeed !
                    </h2>
                    <p>
                        IBN Technologies specializes in real estate and construction bookkeeping in the USA and UK, addressing industry-specific challenges such as fluctuating income, commissions, and project costs. Our expert team, combined with intuitive software, streamlines financial management to ensure organized records, optimized tax deductions, and compliance with regulations like RESPA. With us managing your books, you can focus on finding the perfect properties, closing deals, and efficiently overseeing construction projects
                    </p>
                </div>
            </div>
        </section>

        {{-- E-commerce platforms --}}
        <section class="recbk-section" aria-labelledby="recbk-platforms-title">
            <div class="site-shell recbk-platforms">
                <div class="recbk-platforms__media">
                    <img
                        src="{{ $img('we-support-all-e-commerce-platforms.png') }}"
                        alt="We Support All E-Commerce Platforms"
                        width="1080"
                        height="704"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="recbk-platforms__copy">
                    <h2 id="recbk-platforms-title">We Support All E-Commerce Platforms</h2>
                    <p>Seamlessly Integrate Your Sales Channels with QuickBooks Online or Xero</p>
                    <a href="#" class="recbk-btn recbk-btn--green" data-contact-modal-trigger>
                        GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- Consultation CTA --}}
        <section class="recbk-cta-banner" aria-labelledby="recbk-cta-title">
            <div class="site-shell recbk-cta-banner__inner">
                <h2 id="recbk-cta-title">
                    Book a call with our industry experts who understand the unique challenges of real estate and construction bookkeeping and let us streamline your finances
                </h2>
                <a href="#" class="recbk-btn recbk-btn--green" data-contact-modal-trigger>
                    Get Started with a Free Consultation
                </a>
            </div>
        </section>

        {{-- Challenges --}}
        <section class="recbk-section" aria-labelledby="recbk-challenges-title">
            <div class="site-shell">
                <div class="recbk-heading recbk-heading--center">
                    <h2 id="recbk-challenges-title">
                        Challenges We Address in Real Estate and Construction Bookkeeping
                    </h2>
                </div>

                <div class="recbk-challenges" role="list">
                    @foreach ($challenges as $item)
                        <article class="recbk-challenge" role="listitem">
                            <img
                                src="{{ $img($item['icon']) }}"
                                alt="{{ $item['alt'] }}"
                                width="120"
                                height="90"
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

        {{-- Software Expertise --}}
        <section class="recbk-section recbk-software" aria-labelledby="recbk-software-title">
            <div class="site-shell">
                <div class="recbk-heading recbk-heading--center">
                    <h2 id="recbk-software-title" class="recbk-software__title">
                        Software <span>Expertise</span>
                    </h2>
                </div>

                <div
                    class="recbk-software__carousel"
                    x-data="{
                        index: 0,
                        perPage: 6,
                        total: {{ count($softwareLogos) }},
                        get maxIndex() { return Math.max(0, this.total - this.perPage); },
                        syncPerPage() {
                            const width = window.innerWidth;
                            this.perPage = width <= 480 ? 1 : (width <= 720 ? 2 : (width <= 1024 ? 3 : 6));
                            if (this.index > this.maxIndex) this.index = this.maxIndex;
                        },
                        prev() { this.index = this.index <= 0 ? this.maxIndex : this.index - 1; },
                        next() { this.index = this.index >= this.maxIndex ? 0 : this.index + 1; },
                        go(i) { this.index = Math.min(i, this.maxIndex); },
                        init() {
                            this.syncPerPage();
                            this._onResize = () => this.syncPerPage();
                            window.addEventListener('resize', this._onResize);
                        },
                        destroy() {
                            window.removeEventListener('resize', this._onResize);
                        }
                    }"
                >
                    <div class="recbk-software__viewport">
                        <div
                            class="recbk-software__track"
                            :style="`transform: translateX(-${index * (100 / perPage)}%)`"
                        >
                            @foreach ($softwareLogos as $logo)
                                <div
                                    class="recbk-software__item"
                                    :style="`flex-basis: calc(100% / ${perPage})`"
                                >
                                    <img
                                        src="{{ $img($logo['file']) }}"
                                        alt="{{ $logo['alt'] }}"
                                        width="300"
                                        height="154"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="recbk-software__dots" role="tablist" aria-label="Software logo slides">
                        <template x-for="i in (maxIndex + 1)" :key="i">
                            <button
                                type="button"
                                class="recbk-software__dot"
                                :class="{ 'is-active': index === (i - 1) }"
                                @click="go(i - 1)"
                                :aria-selected="index === (i - 1)"
                                :aria-label="`Show software logos starting at ${i}`"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        {{-- Why Choose --}}
        <section class="recbk-section recbk-why" aria-labelledby="recbk-why-title">
            <div class="site-shell">
                <div class="recbk-heading recbk-heading--center">
                    <h2 id="recbk-why-title">
                        Why Choose Our Real Estate and Construction Bookkeeping Services?
                    </h2>
                </div>

                <div class="recbk-why__grid" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="recbk-why__card" role="listitem">
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Benefits + pricing CTA --}}
        <section class="recbk-benefits" aria-labelledby="recbk-benefits-title">
            <div class="site-shell">
                <div class="recbk-benefits__top">
                    <div class="recbk-benefits__copy">
                        <h2 id="recbk-benefits-title">
                            Benefits of Hiring a Real Estate and Construction Bookkeeper
                        </h2>
                        <div class="recbk-benefits__lists">
                            @foreach ($benefitColumns as $column)
                                <ul>
                                    @foreach ($column as $item)
                                        <li>
                                            <span class="recbk-benefits__check" aria-hidden="true">
                                                <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path>
                                                </svg>
                                            </span>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </div>
                    </div>

                    <div class="recbk-benefits__media">
                        <img
                            src="{{ $img('construction-bookkeeping-benefits.webp') }}"
                            alt="IBN Technologies Helps US Construction Companies Overcome Accounting Challenges"
                            width="350"
                            height="233"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>

                <div class="recbk-pricing">
                    <div class="recbk-pricing__copy">
                        <h3>Started at just $10/Hour!</h3>
                        <p>
                            Experience efficient bookkeeping with automation, seamless e-commerce integration, and top-tier data security, compliant with GDPR, CCPA, and other data protection laws
                        </p>
                    </div>
                    <a href="#" class="recbk-btn recbk-btn--green" data-contact-modal-trigger>
                        GET STARTED NOW
                    </a>
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="recbk-testimonials" aria-labelledby="recbk-testimonials-title">
            <div class="site-shell">
                <div class="recbk-heading recbk-heading--center">
                    <p class="recbk-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="recbk-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="recbk-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="recbk-testimonials__nav recbk-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="recbk-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="recbk-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="recbk-testimonials__nav recbk-testimonials__nav--next"
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
