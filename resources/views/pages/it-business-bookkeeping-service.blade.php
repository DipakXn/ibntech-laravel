@php
    $img = fn (string $file): string => asset('images/it-business-bookkeeping-service/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $pricing = [
        [
            'amount' => '$10',
            'period' => 'Hour',
            'label' => 'Flexible hourly support',
            'icon' => 'fa-clock',
            'slug' => 'free-consultation',
        ],
        [
            'amount' => '$150',
            'period' => 'Month',
            'label' => 'Monthly bookkeeping plan',
            'icon' => 'fa-calendar-days',
            'slug' => 'free-consultation',
        ],
        [
            'amount' => '$20,000',
            'period' => 'Year',
            'label' => 'Annual partnership package',
            'icon' => 'fa-calendar-check',
            'slug' => 'free-consultation',
        ],
    ];

    $serviceCards = [
        [
            'tone' => 'navy',
            'icon' => 'back-office-icon.webp',
            'icon_alt' => 'back-office-icon',
            'icon_w' => 90,
            'icon_h' => 90,
            'title' => 'Bookkeeping Services',
            'items' => [
                'Accounts Payable (Vendor Bills and Payments)',
                'Accounts Receivable (Customer Invoices and Collections)',
                'Reconciliations (Checking and Credit Cards)',
                'Revenue Reconciliation with Bank Deposits',
                'Electronic Document Management',
            ],
        ],
        [
            'tone' => 'mint',
            'icon' => 'image-controller-service.webp',
            'icon_alt' => 'controller service',
            'icon_w' => 65,
            'icon_h' => 65,
            'title' => 'Controller Service',
            'items' => [
                'Costing, MIS Reports Preparation, Vertical & Horizontal analysis',
                'Yearly Budget Preparation & periodical analysis',
                'Accounts Payable (Vendor Bills and Payments)',
                'Preparation of financial statements',
                'Cash Flow Preparation & Forecasting',
            ],
        ],
        [
            'tone' => 'mint',
            'icon' => 'accounting-system-integration.webp',
            'icon_alt' => 'accounting system & integration',
            'icon_w' => 65,
            'icon_h' => 65,
            'title' => 'Accounting System & Integration',
            'items' => [
                'Integration Accounts Payable (Vendor Bills and Payments)',
                'Accounts Receivable (Customer Invoices and Collections)',
                'Reconciliations (Checking and Credit Cards)',
                'Revenue Reconciliation with Bank Deposits',
                'Electronic Document Management',
            ],
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

    $benefits = [
        [
            'icon' => 'experienced-bookkeepers.webp',
            'alt' => 'experienced bookkeepers',
            'title' => 'Experienced Bookkeepers',
            'text' => 'We have a solid track record of adequately handling retail bookkeeping for firms across the United States, with over 24+ years of expertise',
        ],
        [
            'icon' => 'value-driven-approach.webp',
            'alt' => 'value-driven approach',
            'title' => 'Value-Driven Approach',
            'text' => 'Our goal is not just to lower your costs but also to give value that exceeds the cost.',
        ],
        [
            'icon' => 'ready-to-scale.webp',
            'alt' => 'ready to scale',
            'title' => 'Ready to Scale',
            'text' => 'Our efficient management systems enable you to quickly increase or decrease the number of bookkeeping services required.',
        ],
        [
            'icon' => 'minimal-input-required.webp',
            'alt' => 'minimal input required',
            'title' => 'Minimal Input Required',
            'text' => 'Our certified bookkeepers manage all parts of the bookkeeping process, enabling you to sit back and relax.',
        ],
        [
            'icon' => 'your-data-is-safe.webp',
            'alt' => 'your data is safe',
            'title' => 'Your Data is Safe',
            'text' => 'You can trust IBN\'s capacity to secure your data since we use cutting-edge security technologies to protect our clients\' information.',
        ],
        [
            'icon' => 'utilize-best-tools.webp',
            'alt' => 'utilize best tools',
            'title' => 'Utilize Best Tools',
            'text' => 'Our experienced bookkeepers can work with whatever accounting program you like, or we may recommend one that would be appropriate for you.',
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
    @vite(['resources/css/pages/it-business-bookkeeping-service.css'])
@endpush

@section('content')
    <div class="itbk-page">
        {{-- Hero --}}
        <section class="itbk-hero" aria-labelledby="itbk-hero-title">
            <div class="site-shell itbk-hero__inner">
                <div class="itbk-hero__copy">
                    <p class="itbk-eyebrow">Manage Finances the Right Way with IBN</p>
                    <h1 id="itbk-hero-title">Bookkeeping for IT Businesses</h1>
                    <p class="itbk-hero__lede">
                        Focus on satisfying your customers, and let us handle the bookkeeping - our team of experts understands the unique financial needs of IT businesses, and we'll make sure you stay on top of your numbers.
                    </p>
                    <div class="itbk-hero__actions">
                        <a href="#contact-us" class="itbk-btn itbk-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="itbk-hero__media">
                    <img
                        src="{{ $img('bookkeeping-it-businesses.png') }}"
                        alt="bookkeeping-it-businesses"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Pricing --}}
        <section class="itbk-pricing" aria-labelledby="itbk-pricing-title">
            <div class="site-shell">
                <div class="itbk-pricing__header">
                    <p class="itbk-pricing__eyebrow">Transparent pricing</p>
                    <h2 id="itbk-pricing-title">Starts at</h2>
                    <p class="itbk-pricing__lede">Choose the engagement model that fits your IT finance needs.</p>
                </div>

                <div class="itbk-pricing__grid" role="list">
                    @foreach ($pricing as $item)
                        <a
                            href="{{ route('page.show', ['slug' => $item['slug']]) }}"
                            class="itbk-pricing-card"
                            role="listitem"
                        >
                            <span class="itbk-pricing-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <span class="itbk-pricing-card__amount">
                                {{ $item['amount'] }}<sup>*</sup>
                            </span>
                            <span class="itbk-pricing-card__period">per {{ strtolower($item['period']) }}</span>
                            <span class="itbk-pricing-card__label">{{ $item['label'] }}</span>
                            <span class="itbk-pricing-card__cta">
                                Get started
                                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Importance banner --}}
        <section class="itbk-importance" aria-labelledby="itbk-importance-title">
            <div class="site-shell itbk-importance__inner">
                <h2 id="itbk-importance-title">Importance of Bookkeeping in IT Businesses</h2>
                <hr class="itbk-importance__rule" aria-hidden="true">
                <p class="itbk-importance__lead"><strong>Bookkeeping is a Challenge for IT Businesses</strong></p>
                <p>
                    Most IT businesses, including SaaS businesses and outsourcing service providers, face the following bookkeeping challenges:
                </p>
                <a href="#contact-us" class="itbk-btn itbk-btn--green">GET STARTED NOW</a>
            </div>
        </section>

        {{-- Outsource --}}
        <section class="itbk-section" aria-labelledby="itbk-outsource-title">
            <div class="site-shell itbk-outsource">
                <div class="itbk-outsource__media">
                    <img
                        src="{{ $img('outsourced-bookkeeping-services.webp') }}"
                        alt="outsourced bookkeeping services"
                        width="526"
                        height="469"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="itbk-outsource__copy">
                    <h2 id="itbk-outsource-title">Outsource Bookkeeping Service</h2>
                    <p>
                        IBN's team of experienced bookkeepers works closely with your IT business to ensure that your financial records are accurate, up-to-date, and compliant with all applicable regulations. We can handle all aspects of your bookkeeping, including managing payments to subcontractors and employees, handling expense reimbursements, and issuing 1099 forms at the end of the year.
                    </p>
                    <p>
                        We can also help you manage your billing and payment processes more efficiently. We work with you to set up a system that allows you to track all of your client pricing plans, service level agreements (SLAs), and payment schedules in one place. This can help ensure that you are billing clients accurately and on time and that you have a clear understanding of your revenue streams and expenses.
                    </p>
                    <p>
                        In addition, the financial reporting and analysis tools we use can provide you with valuable insights into your finances. We'll help you track and analyze key financial metrics, such as revenue, expenses, and profitability, so that you can make more informed decisions about resource planning and management.
                    </p>
                    <a href="#contact-us" class="itbk-btn itbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- What We Do --}}
        <section class="itbk-section itbk-section--tight" aria-labelledby="itbk-services-title">
            <div class="site-shell">
                <div class="itbk-heading">
                    <p class="itbk-eyebrow itbk-eyebrow--center">Our Service</p>
                    <h2 id="itbk-services-title">What We Do</h2>
                </div>

                <div class="itbk-service-grid" role="list">
                    @foreach ($serviceCards as $card)
                        <article class="itbk-service-card itbk-service-card--{{ $card['tone'] }}" role="listitem">
                            <header class="itbk-service-card__header">
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
                            <ul class="itbk-service-list">
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

        {{-- Stats --}}
        <section class="itbk-section" aria-labelledby="itbk-stats-title">
            <div class="site-shell">
                <div class="itbk-heading">
                    <h2 id="itbk-stats-title">What Makes IBN Tech</h2>
                    <p class="itbk-heading__sub">
                        Top Bookkeeping Services Provider for Marketing and Advertising Agencies
                    </p>
                </div>

                <div class="itbk-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="itbk-stat" role="listitem">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="itbk-section__cta">
                    <a href="#contact-us" class="itbk-btn itbk-btn--navy">LET'S GET STARTED</a>
                </div>
            </div>
        </section>

        {{-- Areas --}}
        <section class="itbk-section" aria-labelledby="itbk-areas-title">
            <div class="site-shell">
                <div class="itbk-heading">
                    <h2 id="itbk-areas-title">Areas We Serve</h2>
                </div>

                <div class="itbk-areas">
                    @foreach ($areas as $column)
                        <ul class="itbk-areas__col">
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

        {{-- Benefits --}}
        <section class="itbk-section" aria-labelledby="itbk-benefits-title">
            <div class="site-shell">
                <div class="itbk-heading">
                    <h2 id="itbk-benefits-title">
                        <span class="itbk-heading__light">Benefits of</span>
                        <span class="itbk-heading__strong">IBN Outsource Bookkeeping Services</span>
                    </h2>
                </div>

                <div class="itbk-benefits" role="list">
                    @foreach ($benefits as $item)
                        <article class="itbk-benefit" role="listitem">
                            <figure class="itbk-benefit__icon">
                                <img
                                    src="{{ $img($item['icon']) }}"
                                    alt="{{ $item['alt'] }}"
                                    width="65"
                                    height="65"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </figure>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="itbk-section__cta">
                    <a href="#contact-us" class="itbk-btn itbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="itbk-section itbk-consult"
            id="contact-us"
            aria-labelledby="itbk-consult-title"
        >
            <div class="site-shell itbk-consult__inner">
                <aside class="itbk-consult__card" aria-labelledby="itbk-consult-title">
                    <div class="itbk-consult__header">
                        <h2 id="itbk-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="itbk-consult__body">
                        <livewire:forms.contact-form
                            form-name="it-business-bookkeeping-service"
                            id-prefix="itbk"
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

                <div class="itbk-consult__media">
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
        <section class="itbk-testimonials" aria-labelledby="itbk-testimonials-title">
            <div class="site-shell">
                <div class="itbk-heading itbk-heading--cream">
                    <p class="itbk-eyebrow itbk-eyebrow--green">Discover Why IBN Tech is the</p>
                    <h2 id="itbk-testimonials-title">Best Bookkeeping Firms in the USA</h2>
                </div>

                <div
                    class="itbk-testimonials__slider"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        next() { this.index = (this.index + 1) % this.total },
                        prev() { this.index = (this.index - 1 + this.total) % this.total },
                    }"
                >
                    <button type="button" class="itbk-testimonials__nav itbk-testimonials__nav--prev" @click="prev()" aria-label="Previous testimonial">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="itbk-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="itbk-testimonial{{ $i === 0 ? ' is-active' : '' }}"
                                x-show="index === {{ $i }}"
                                x-cloak
                                @if ($i === 0) x-transition.opacity @endif
                            >
                                <p>{{ $item['quote'] }}</p>
                                <cite>{{ $item['cite'] }}</cite>
                            </blockquote>
                        @endforeach
                    </div>

                    <button type="button" class="itbk-testimonials__nav itbk-testimonials__nav--next" @click="next()" aria-label="Next testimonial">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>
    </div>
@endsection
