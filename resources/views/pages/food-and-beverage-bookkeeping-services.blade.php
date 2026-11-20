@php
    $img = fn (string $file): string => asset('images/food-and-beverage-bookkeeping-services/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $inventoryFeatures = [
        [
            'title' => 'Inventory Tracking and Optimization:',
            'text' => 'Manage stock levels efficiently to reduce waste and maximize turnover.',
        ],
        [
            'title' => 'Vendor Payment Management:',
            'text' => 'Ensure timely payments and maintain good supplier relationships.',
        ],
        [
            'title' => 'Cost Analysis and Reduction Strategies:',
            'text' => 'Identify areas for cost savings while maintaining quality.',
        ],
        [
            'title' => 'Sales and Revenue Tracking:',
            'text' => 'Keep a close eye on your revenue streams for better financial planning.',
        ],
    ];

    $outsourcedFeatures = [
        [
            'title' => 'Daily Sales and Cash Flow Tracking:',
            'text' => 'Stay on top of your daily financial health with accurate monitoring.',
        ],
        [
            'title' => 'Payroll and Tips Processing:',
            'text' => 'Manage staff wages and tips efficiently and accurately.',
        ],
        [
            'title' => 'Periodic Financial Reporting:',
            'text' => 'Get insights into your business performance with detailed reports.',
        ],
        [
            'title' => 'Expense Management:',
            'text' => 'Keep your operational costs in check without compromising on quality.',
        ],
    ];

    $techFeatures = [
        [
            'title' => 'Point of Sale (POS) System Integration:',
            'text' => 'Experience seamless data flow from sales to financial records, ensuring every transaction is captured accurately.',
        ],
        [
            'title' => 'Automated Inventory Tracking:',
            'text' => 'Elevate your stock management with systems that minimize errors and enhance time efficiency.',
        ],
        [
            'title' => 'Unwavering Data Confidentiality:',
            'text' => 'With robust security measures, your business’s financial information is treated with the utmost confidentiality.',
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

    $processSteps = [
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

    $testimonials = \App\Support\Testimonials\Testimonials::cites('food-and-beverage-bookkeeping-services');

    $faqs = [
        [
            'question' => 'What services do you offer for Food & Beverage bookkeeping?',
            'answer' => '<strong>IBN Tech</strong> offers a range of bookkeeping services tailored specifically for the Food &amp; Beverage industry. This includes tracking expenses, managing revenue, reconciling accounts, and generating financial reports to help you keep a close eye on your finances.',
        ],
        [
            'question' => 'What is the cost of your bookkeeping services?',
            'answer' => 'Our pricing varies based on the size and complexity of your Food &amp; Beverage business. We offer customized quotes, so please contact us for a free consultation to discuss your specific needs and get a quote.',
        ],
        [
            'question' => 'How can I get started with your bookkeeping services?',
            'answer' => 'To get started, simply reach out to us through our website, and we’ll schedule a consultation to understand your business’s unique requirements. After that, we’ll create a tailored bookkeeping plan for you.',
        ],
        [
            'question' => 'What software do you use for Food & Beverage bookkeeping?',
            'answer' => '<strong>IBN Tech</strong> uses industry-standard accounting software such as QuickBooks, Xero, and FreshBooks, depending on your preferences and needs. These tools streamline the bookkeeping process and allow for easy collaboration.',
        ],
        [
            'question' => 'How do you ensure the security and confidentiality of my restaurant\'s financial data?',
            'answer' => 'IBN Tech take data security and confidentiality seriously. We use industry-standard encryption protocols, and our staff undergo strict privacy training. Your financial data is safe with us.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/food-and-beverage-bookkeeping-services.css'])
@endpush

@section('content')
    <div class="fnbbk-page">
        {{-- Hero --}}
        <section class="fnbbk-hero" aria-labelledby="fnbbk-hero-title">
            <div class="site-shell fnbbk-hero__inner">
                <div class="fnbbk-hero__copy">
                    <p class="fnbbk-hero__eyebrow">Manage your finances smartly with IBN Tech’s</p>
                    <h1 id="fnbbk-hero-title">Bookkeeping Services for Food and Beverages</h1>
                    <p class="fnbbk-hero__lede">
                        Partner with <strong>IBN Tech</strong> for food and beverage accounting solutions that provide in-depth financial insights and management specific to your operational needs
                    </p>
                    <div class="fnbbk-hero__actions">
                        <a href="#contact-us" class="fnbbk-btn fnbbk-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="fnbbk-hero__media">
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
        <section class="fnbbk-section" aria-labelledby="fnbbk-intro-title">
            <div class="site-shell fnbbk-split">
                <div class="fnbbk-split__media">
                    <img
                        src="{{ $img('at-ibn-tech-we-understand-the-essence-of.webp') }}"
                        alt="at ibn tech we understand the essence of"
                        width="526"
                        height="346"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="fnbbk-split__copy">
                    <h2 id="fnbbk-intro-title" class="sr-only">Food and Beverage Bookkeeping Services</h2>
                    <p>
                        At <strong>IBN Tech</strong>, we understand your focus is on delivering exceptional food and customer experiences. However, managing the financial aspects of your business is key to sustaining quality and service. Food and beverage bookkeeping comes with unique challenges, from inventory management to seasonal demand fluctuations.
                    </p>
                    <p>
                        Our Food and Beverage Bookkeeping Services are crafted to streamline your financial operations, optimize inventory management, and ensure regulatory compliance, letting you concentrate on crafting exceptional culinary experiences.
                    </p>
                    <a href="#contact-us" class="fnbbk-btn fnbbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Inventory and Cost Control --}}
        <section class="fnbbk-section fnbbk-section--soft" aria-labelledby="fnbbk-inventory-title">
            <div class="site-shell fnbbk-split">
                <div class="fnbbk-split__copy">
                    <h2 id="fnbbk-inventory-title">Inventory and Cost Control Management</h2>
                    <p class="fnbbk-subhead">Master Your Margins with Precision</p>
                    <p>
                        The financial health of your food and beverage business is deeply tied to effective inventory and cost control management. From procurement to plate, our team guarantees excellence in every aspect. We offer:
                    </p>
                    <ul class="fnbbk-feature-list">
                        @foreach ($inventoryFeatures as $item)
                            <li>
                                <strong>{{ $item['title'] }}</strong>
                                {{ $item['text'] }}
                            </li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="fnbbk-btn fnbbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="fnbbk-split__media">
                    <img
                        src="{{ $img('inventory-and-cost-control-management.png') }}"
                        alt="inventory and cost control management"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Outsourced Bookkeeping --}}
        <section class="fnbbk-section" aria-labelledby="fnbbk-outsourced-title">
            <div class="site-shell fnbbk-split">
                <div class="fnbbk-split__media">
                    <img
                        src="{{ $img('outsourced-bookkeeping-services-1.webp') }}"
                        alt="outsourced bookkeeping services"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="fnbbk-split__copy">
                    <h2 id="fnbbk-outsourced-title">Outsourced Bookkeeping Services</h2>
                    <p class="fnbbk-subhead">Designed to Satisfy Your Business Appetite</p>
                    <p>
                        From small cafes to large restaurants and bars, our bookkeeping services adapt to your specific needs:
                    </p>
                    <ul class="fnbbk-feature-list">
                        @foreach ($outsourcedFeatures as $item)
                            <li>
                                <strong>{{ $item['title'] }}</strong>
                                {{ $item['text'] }}
                            </li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="fnbbk-btn fnbbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Advanced Technology --}}
        <section class="fnbbk-section fnbbk-section--soft" aria-labelledby="fnbbk-tech-title">
            <div class="site-shell fnbbk-split">
                <div class="fnbbk-split__copy">
                    <h2 id="fnbbk-tech-title">Advanced Technology &amp; Secure Bookkeeping Solutions</h2>
                    <p class="fnbbk-subhead">Harness Precision and Protect Your Data with IBN Tech</p>
                    <p>
                        In the dynamic food and beverage sector, leveraging innovative technology not only refines efficiency but also fortifies data security. Our advanced bookkeeping solutions offer:
                    </p>
                    <ul class="fnbbk-feature-list">
                        @foreach ($techFeatures as $item)
                            <li>
                                <strong>{{ $item['title'] }}</strong>
                                {{ $item['text'] }}
                            </li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="fnbbk-btn fnbbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="fnbbk-split__media">
                    <img
                        src="{{ $img('advanced-technology-secure-bookkeeping-solutions.png') }}"
                        alt="advanced technology &amp; secure bookkeeping solutions"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- What Makes IBN Tech --}}
        <section class="fnbbk-section" aria-labelledby="fnbbk-stats-title">
            <div class="site-shell">
                <div class="fnbbk-heading">
                    <h2 id="fnbbk-stats-title">What Makes IBN Tech</h2>
                    <p>Top Bookkeeping Services Provider for Food &amp; Beverages Business</p>
                </div>

                <div class="fnbbk-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="fnbbk-stat" role="listitem">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="fnbbk-section__cta">
                    <a href="#contact-us" class="fnbbk-btn fnbbk-btn--navy">
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- Recipes CTA banner --}}
        <section class="fnbbk-banner" aria-labelledby="fnbbk-banner-title">
            <div class="site-shell fnbbk-banner__inner">
                <h2 id="fnbbk-banner-title">Your recipes are unique, and so are your financial needs.</h2>
                <p>Let us tailor our services to your taste.</p>
                <a href="#contact-us" class="fnbbk-btn fnbbk-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="fnbbk-section fnbbk-software" aria-labelledby="fnbbk-software-title">
            <div class="site-shell">
                <h2 id="fnbbk-software-title" class="fnbbk-software__title">
                    <span>Software</span>
                    <span class="fnbbk-software__accent">Expertise</span>
                </h2>
                <div class="fnbbk-software__media">
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
        <section class="fnbbk-section" aria-labelledby="fnbbk-process-title">
            <div class="site-shell">
                <div class="fnbbk-heading">
                    <h2 id="fnbbk-process-title">How We Work</h2>
                    <p>IBN Tech's streamlined outsourcing process ensures swift and efficient operations:</p>
                </div>

                <div class="fnbbk-process" role="list">
                    @foreach ($processSteps as $step)
                        <article class="fnbbk-process__card" role="listitem">
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

                <div class="fnbbk-section__cta">
                    <a href="#contact-us" class="fnbbk-btn fnbbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Areas We Serve --}}
        <section class="fnbbk-section fnbbk-section--soft" aria-labelledby="fnbbk-areas-title">
            <div class="site-shell">
                <div class="fnbbk-heading">
                    <h2 id="fnbbk-areas-title">Areas We Serve</h2>
                </div>

                <div class="fnbbk-areas" role="list">
                    @foreach ($areasColumns as $column)
                        <ul class="fnbbk-areas__col" role="presentation">
                            @foreach ($column as $area)
                                <li role="listitem">
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
        <section class="fnbbk-section fnbbk-consult" id="contact-us" aria-labelledby="fnbbk-consult-title">
            <div class="site-shell fnbbk-consult__inner">
                <aside class="fnbbk-consult__card" aria-labelledby="fnbbk-consult-title">
                    <div class="fnbbk-consult__header">
                        <h2 id="fnbbk-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="fnbbk-consult__body">
                        <livewire:forms.contact-form
                            form-name="food-and-beverage-bookkeeping-services"
                            id-prefix="fnbbk"
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

                <div class="fnbbk-consult__media">
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
        <section class="fnbbk-testimonials" aria-labelledby="fnbbk-testimonials-title">
            <div class="site-shell">
                <div class="fnbbk-testimonials__heading">
                    <p>Discover Why IBN Tech is the</p>
                    <h2 id="fnbbk-testimonials-title">Best Bookkeeping Firms in the USA</h2>
                </div>

                <div
                    class="fnbbk-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.total > 0 ? (this.index - 1 + this.total) % this.total : 0); },
                        next() { this.index = (this.total > 0 ? (this.index + 1) % this.total : 0); }
                    }"
                >
                    <button type="button" class="fnbbk-testimonials__nav fnbbk-testimonials__nav--prev" @click="prev()" aria-label="Previous testimonial">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="fnbbk-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="fnbbk-testimonial{{ $i === 0 ? ' is-active' : '' }}"
                                :class="{ 'is-active': index === {{ $i }} }"
                                :aria-hidden="index !== {{ $i }}"
                            >
                                <p>{{ $item['quote'] }}</p>
                                <cite>{{ $item['cite'] }}</cite>
                            </blockquote>
                        @endforeach
                    </div>

                    <button type="button" class="fnbbk-testimonials__nav fnbbk-testimonials__nav--next" @click="next()" aria-label="Next testimonial">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="fnbbk-section" aria-labelledby="fnbbk-faq-title">
            <div class="site-shell fnbbk-faq-wrap">
                <div class="fnbbk-heading">
                    <h2 id="fnbbk-faq-title">Frequently Asked Questions (FAQ)</h2>
                </div>

                <div class="fnbbk-faq">
                    @foreach ($faqs as $i => $faq)
                        <details @if ($i === 0) open @endif>
                            <summary>
                                <span>{{ $faq['question'] }}</span>
                            </summary>
                            <div>{!! $faq['answer'] !!}</div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
