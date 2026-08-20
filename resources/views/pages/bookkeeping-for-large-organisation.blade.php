@php
    $img = fn (string $file): string => asset('images/bookkeeping-for-large-organisation/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $serviceCards = [
        [
            'tone' => 'navy',
            'icon' => 'back-office-icon.webp',
            'icon_alt' => 'back-office-icon',
            'icon_w' => 90,
            'icon_h' => 90,
            'title' => 'Our Key Performance Matrix Consist of',
            'items' => [
                'Daily Cash Transaction record keeping',
                'Account Payable Processing (Complete procure to pay cycle)',
                'Account Receivable Processing (Complete order to cash cycle)',
                'Bank/ Credit Card Reconciliation',
                'Inventory Managemen',
                'Fixed Asset Management',
                'US Sales Tax',
                'UK VAT Management',
            ],
        ],
        [
            'tone' => 'mint',
            'icon' => 'accounting-system-integration.webp',
            'icon_alt' => 'accounting system & integration',
            'icon_w' => 65,
            'icon_h' => 65,
            'title' => 'Our bookkeeping services are complemented by our Accounting Services which includes',
            'items' => [
                'Cash Flow Management',
                'Costing & Budgeting',
                'MIS & other Management Reporting',
                'Monthly, Quarterly, Yearly closing',
                'Financial Statement Preparations',
                'Proforma Financial Statement Preparation & Analysis',
            ],
        ],
    ];

    $areas = [
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
    @vite(['resources/css/pages/bookkeeping-for-large-organisation.css'])
@endpush

@section('content')
    <div class="bklo-page">
        {{-- Hero --}}
        <section class="bklo-hero" aria-labelledby="bklo-hero-title">
            <div class="site-shell bklo-hero__inner">
                <div class="bklo-hero__copy">
                    <h1 id="bklo-hero-title">Bookkeeping For<br>Large Organization</h1>
                    <div class="bklo-hero__actions">
                        <a href="#contact-us" class="bklo-btn bklo-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="bklo-hero__media">
                    <img
                        src="{{ $img('food-and-beverages.png') }}"
                        alt="Food and Beverages"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="bklo-section" aria-labelledby="bklo-intro-title">
            <div class="site-shell bklo-intro">
                <div class="bklo-intro__media">
                    <img
                        src="{{ $img('outsourced-bookkeeping-services.webp') }}"
                        alt="outsourced bookkeeping services"
                        width="526"
                        height="469"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="bklo-intro__copy">
                    <h2 id="bklo-intro-title">Bookkeeping For Large Organization</h2>
                    <p>
                        Book keeping for large organisations that have Matrix structural organisations with multi-tier operations maintain an extensive accounting department. With huge capital investments locked in infrastructure as well maintenance and quality audits with overheads and employee benefits usually tends to retard the progress of a company. The last decade has seen many conglomerates shift their entire bookkeeping process to an online book keeping company.
                    </p>
                    <p>
                        IBN Technologies Limited offers comprehensive Book Keeping Services for Large Organisations which comprises of maintenance of General Ledger, Invoicing, regular updations of Accounts payable and Accounts Receivable, Bank reconciliation statements, Credit Card Reconciliations as well Fixed asset Management. Along with Financial statement preparations, Cash Flow Budgeting, and also prepares Monthly, quarterly and yearly financial statements as well as does MIS Preparations, costing and financial analysis for the company.
                    </p>
                    <p>
                        IBN’s online book keepers team are experienced are well acquaintanted,certified and experienced in using various globally accepted book keeping softwares such as Free Books, XERO, Wave, Intuit Pro-Advisors and Intuit Point of Sale PRO-Advisor
                    </p>
                    <p>
                        As well as book keeping softwares such as QuickBooks, CSA, Net Suite, Quicken, Peachtree, Sage, MYOB, ERPs, Tax Software Intuit’s Lacerte, Creative Solutions Ultra-Tax, Intuits ProSeries, ATX, Drake Tax, Prosystem FX, Go System, Turbo Tax, etc.
                    </p>
                    <a href="#contact-us" class="bklo-btn bklo-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- What We Do --}}
        <section class="bklo-section bklo-section--tight" aria-labelledby="bklo-services-title">
            <div class="site-shell">
                <div class="bklo-heading">
                    <p class="bklo-eyebrow bklo-eyebrow--center">Our Service</p>
                    <h2 id="bklo-services-title">What We Do</h2>
                </div>

                <div class="bklo-service-grid" role="list">
                    @foreach ($serviceCards as $card)
                        <article class="bklo-service-card bklo-service-card--{{ $card['tone'] }}" role="listitem">
                            <header class="bklo-service-card__header">
                                <img
                                    src="{{ $img($card['icon']) }}"
                                    alt="{{ $card['icon_alt'] }}"
                                    width="{{ $card['icon_w'] }}"
                                    height="{{ $card['icon_h'] }}"
                                    loading="lazy"
                                    decoding="async"
                                >
                                <h3>{{ $card['title'] }}</h3>
                            </header>
                            <ul class="bklo-service-list">
                                @foreach ($card['items'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-right" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Quality / CTA banner --}}
        <section class="bklo-banner" aria-labelledby="bklo-banner-title">
            <div class="site-shell bklo-banner__inner">
                <h2 id="bklo-banner-title" class="visually-hidden">Bookkeeping quality and security</h2>
                <p>
                    Larger Organisations accounting and book keeping needs are vast and extensive in nature. Keeping the clients needs in perspective customized Book Keeping solutions are designed irrespective of complexity and volume of work, keeping the entire online book keeping process within the given time frame always maintain its policy of qualitative deliverables.
                </p>
                <p>
                    IBN Technologies follows global accounting and book keeping standards as well has strict prohibitive infrastructural policies that are designed to address the need of clientele’s data security.
                </p>
                <p>
                    Book Keeping Services for are processed adhering to its quality policy of delivering accurate business process that assists businesses towards greater efficiency, productivity in a timely manner.
                </p>
                <a href="#contact-us" class="bklo-btn bklo-btn--green">GET STARTED NOW</a>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="bklo-section bklo-consult"
            id="contact-us"
            aria-labelledby="bklo-consult-title"
        >
            <div class="site-shell bklo-consult__inner">
                <aside class="bklo-consult__card" aria-labelledby="bklo-consult-title">
                    <div class="bklo-consult__header">
                        <h2 id="bklo-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="bklo-consult__body">
                        <livewire:forms.contact-form
                            form-name="bookkeeping-for-large-organisation"
                            id-prefix="bklo"
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

                <div class="bklo-consult__media">
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

        {{-- Areas --}}
        <section class="bklo-section" aria-labelledby="bklo-areas-title">
            <div class="site-shell">
                <div class="bklo-heading">
                    <h2 id="bklo-areas-title">Areas We Serve</h2>
                </div>

                <div class="bklo-areas">
                    @foreach ($areas as $column)
                        <ul class="bklo-areas__col">
                            @foreach ($column as $area)
                                <li>
                                    <a href="{{ route('page.show', ['slug' => $area['slug']]) }}">
                                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                                        <span>{{ $area['label'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="bklo-testimonials" aria-labelledby="bklo-testimonials-title">
            <div class="site-shell">
                <div class="bklo-heading bklo-heading--cream">
                    <p class="bklo-eyebrow bklo-eyebrow--green">Discover Why IBN Tech is the</p>
                    <h2 id="bklo-testimonials-title">Best Bookkeeping Firms in the USA</h2>
                </div>

                <div
                    class="bklo-testimonials__slider"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        next() { this.index = (this.index + 1) % this.total },
                        prev() { this.index = (this.index - 1 + this.total) % this.total },
                    }"
                >
                    <button type="button" class="bklo-testimonials__nav bklo-testimonials__nav--prev" @click="prev()" aria-label="Previous testimonial">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="bklo-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="bklo-testimonial{{ $i === 0 ? ' is-active' : '' }}"
                                x-show="index === {{ $i }}"
                                x-cloak
                                @if ($i === 0) x-transition.opacity @endif
                            >
                                <p>{{ $item['quote'] }}</p>
                                <cite>{{ $item['cite'] }}</cite>
                            </blockquote>
                        @endforeach
                    </div>

                    <button type="button" class="bklo-testimonials__nav bklo-testimonials__nav--next" @click="next()" aria-label="Next testimonial">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>
    </div>
@endsection
