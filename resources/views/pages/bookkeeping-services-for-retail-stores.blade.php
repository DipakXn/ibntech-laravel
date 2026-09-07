@php
    $img = fn (string $file): string => asset('images/bookkeeping-services-for-retail-stores/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $lifecycleFeatures = [
        [
            'icon' => 'inventory-accounting.gif',
            'alt' => 'inventory accounting',
            'title' => 'Inventory Accounting',
            'text' => 'Keep track of your stock levels and value, ensuring your accounting reflects the true cost of goods sold.',
        ],
        [
            'icon' => 'sales-tracking-and-reporting.gif',
            'alt' => 'sales tracking and reporting',
            'title' => 'Sales Tracking and Reporting',
            'text' => 'Monitor the performance of your products, understanding which items drive revenue and which may need reevaluation.',
        ],
        [
            'icon' => 'cost-analysis-and-reduction.gif',
            'alt' => 'cost analysis and reduction',
            'title' => 'Cost Analysis and Reduction',
            'text' => 'Identify and trim unnecessary expenses throughout your product lifecycle to improve margins.',
        ],
        [
            'icon' => 'vendor-and-supply-chain-management.gif',
            'alt' => 'vendor and supply chain management',
            'title' => 'Vendor and Supply Chain Management',
            'text' => 'Streamline your purchase orders and payments with comprehensive vendor management',
        ],
    ];

    $customPoints = [
        [
            'title' => 'Real-Time Financial Health Checks:',
            'text' => 'Keep your finger on the pulse of your business with up-to-date records that reflect your current financial health, critical for making timely decisions.',
        ],
        [
            'title' => 'Regulatory Adherence:',
            'text' => 'With ever-evolving tax laws and financial regulations, our expertise ensures your business remains compliant, avoiding costly penalties and legal issues.',
        ],
        [
            'title' => 'Strategic Cash Flow Management:',
            'text' => 'Optimize your cash flow to support each phase of your product life cycle, ensuring that funds are available for development, marketing, and scaling operations.',
        ],
        [
            'title' => 'Payroll and Expense Tracking:',
            'text' => 'Precisely track and manage payroll and expenses, which are pivotal during the growth and maturity stages of your product life cycle.',
        ],
    ];

    $techPoints = [
        [
            'title' => 'Point of Sale (POS) Integration:',
            'text' => 'Seamlessly connect sales data with financial records for real-time analysis.',
        ],
        [
            'title' => 'E-commerce Reconciliation:',
            'text' => 'Expert handling of online sales platforms, ensuring every transaction is accounted for accurately.',
        ],
        [
            'title' => 'Ensuring Data Security:',
            'text' => 'Employing robust security measures to keep your financial data safe.',
        ],
    ];

    $stats = [
        ['value' => '30+', 'label' => 'Industry Served'],
        ['value' => '26+', 'label' => 'Years of Experience'],
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

    $faqs = [
        [
            'question' => 'How does retail accounting work?',
            'answer' => 'Retail accounting involves tracking and managing financial transactions specific to retail businesses. It includes tasks like recording sales, monitoring inventory, and managing expenses. Our retail bookkeeping services streamline this process, ensuring accurate and organized financial records that help businesses make informed decisions.',
        ],
        [
            'question' => 'Can I outsource only specific accounting tasks instead of the entire accounting function?',
            'answer' => 'Yes, our bookkeeping services for retail stores offer flexibility. You can choose to outsource specific accounting tasks such as transaction recording, payroll, or reconciliations. This allows you to tailor the outsourcing to your business needs and budget while ensuring efficient and accurate financial management.',
        ],
        [
            'question' => 'Is my financial data secure with an outsourced service?',
            'answer' => 'Absolutely. We prioritize the security of your financial data. Our outsourced bookkeeping services adhere to industry-leading security measures, employing encryption, access controls, and regular audits. Our team is committed to maintaining the confidentiality and integrity of your financial information, providing you with peace of mind regarding data security.',
        ],
        [
            'question' => 'What happens if there is a discrepancy or error in my books?',
            'answer' => 'In the rare event of a discrepancy or error, our dedicated team promptly rectifies the issue. We conduct regular reconciliations to catch potential errors early. Our commitment to accuracy means that we strive to minimize errors, and if they do occur, we take swift action to correct them, ensuring the integrity of your financial records.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/bookkeeping-services-for-retail-stores.css'])
@endpush

@section('content')
    <div class="rtlbk-page">
        {{-- Hero --}}
        <section class="rtlbk-hero" aria-labelledby="rtlbk-hero-title">
            <div class="site-shell rtlbk-hero__inner">
                <div class="rtlbk-hero__copy">
                    <p class="rtlbk-hero__eyebrow">Accurately Track Your Retail Finances with IBN Tech’s</p>
                    <h1 id="rtlbk-hero-title">Retail Bookkeeping Services</h1>
                    <p class="rtlbk-hero__lede">
                        IBN Tech's bookkeeping services for retail stores offers real-time financial data, empowering you to make informed decisions, optimize your inventory, and increase your profitability.
                    </p>
                    <div class="rtlbk-hero__actions">
                        <a href="#contact-us" class="rtlbk-btn rtlbk-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="rtlbk-hero__media">
                    <img
                        src="{{ $img('bookkeeping-services-for-retail-stores.webp') }}"
                        alt="bookkeeping services for retail stores"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="rtlbk-section" aria-labelledby="rtlbk-intro-title">
            <div class="site-shell rtlbk-split">
                <div class="rtlbk-split__media">
                    <img
                        src="{{ $img('in-the-fast-paced-retail-sector-managing-finances-can-be-as.webp') }}"
                        alt="in the fast-paced retail sector, managing finances can be as"
                        width="400"
                        height="460"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="rtlbk-split__copy">
                    <h2 id="rtlbk-intro-title" class="sr-only">Retail Bookkeeping Overview</h2>
                    <p>
                        In the fast-paced retail sector, managing finances can be as dynamic as the market itself. Staying on top of the product life cycle from introduction to decline is crucial for sustainable growth. However, this requires focusing on financial health, often sidelined due to operational demands.
                    </p>
                    <p>
                        We understand these challenges. Our Retail Bookkeeping Services are designed to provide comprehensive financial oversight, ensuring your business remains profitable throughout various stages of your product's life cycles. By outsourcing your bookkeeping, you gain more than accurate books; you get a strategic financial planning and management partner.
                    </p>
                </div>
            </div>
        </section>

        {{-- Product Lifecycle Management --}}
        <section class="rtlbk-section rtlbk-section--soft" aria-labelledby="rtlbk-lifecycle-title">
            <div class="site-shell">
                <div class="rtlbk-heading rtlbk-heading--center">
                    <h2 id="rtlbk-lifecycle-title">Product Lifecycle Management</h2>
                    <h3>Staying Ahead in Every Stage</h3>
                    <p>
                        The product life cycle is pivotal in the retail industry, influencing stocking decisions, marketing strategies, and ultimately, business growth. Our bookkeeping services integrate these life cycle stages with financial insights, providing:
                    </p>
                </div>

                <div class="rtlbk-feature-grid" role="list">
                    @foreach ($lifecycleFeatures as $item)
                        <article class="rtlbk-feature-card" role="listitem">
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

                <div class="rtlbk-section__cta">
                    <a href="#contact-us" class="rtlbk-btn rtlbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Customized Bookkeeping --}}
        <section class="rtlbk-section" aria-labelledby="rtlbk-custom-title">
            <div class="site-shell rtlbk-split">
                <div class="rtlbk-split__copy">
                    <h2 id="rtlbk-custom-title">Customized Bookkeeping for Retail Businesses</h2>
                    <h3>Adapting to Your Unique Needs</h3>
                    <p>
                        From small boutiques to large retail chains, our services cater to your specific requirements. We provide:
                    </p>
                    @foreach ($customPoints as $point)
                        <p>
                            <strong>{{ $point['title'] }}</strong> {{ $point['text'] }}
                        </p>
                    @endforeach
                    <a href="#contact-us" class="rtlbk-btn rtlbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="rtlbk-split__media">
                    <img
                        src="{{ $img('customized-bookkeeping-for-retail-businesses.webp') }}"
                        alt="customized bookkeeping for retail businesses"
                        width="500"
                        height="560"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Technology-Enabled Precision --}}
        <section class="rtlbk-section" aria-labelledby="rtlbk-tech-title">
            <div class="site-shell rtlbk-split">
                <div class="rtlbk-split__media">
                    <img
                        src="{{ $img('technology-enabled-precision.webp') }}"
                        alt="technology-enabled precision"
                        width="500"
                        height="560"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="rtlbk-split__copy">
                    <h2 id="rtlbk-tech-title">Technology-Enabled Precision</h2>
                    <h3>Harness the Power of Modern Bookkeeping</h3>
                    <p>
                        We leverage the latest technology to deliver <strong>error-free bookkeeping services</strong>, ensuring that your retail business has access to the most efficient tools and software for:
                    </p>
                    @foreach ($techPoints as $point)
                        <p>
                            <strong>{{ $point['title'] }}</strong> {{ $point['text'] }}
                        </p>
                    @endforeach
                    <a href="#contact-us" class="rtlbk-btn rtlbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- What Makes IBN Tech --}}
        <section class="rtlbk-section rtlbk-stats-section" aria-labelledby="rtlbk-stats-title">
            <div class="site-shell">
                <div class="rtlbk-heading rtlbk-heading--center">
                    <h2 id="rtlbk-stats-title">What Makes IBN Tech</h2>
                    <p class="rtlbk-heading__sub">
                        Top Bookkeeping Services Provider for Marketing and Advertising Agencies
                    </p>
                </div>

                <div class="rtlbk-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="rtlbk-stat" role="listitem">
                            <p class="rtlbk-stat__value">{{ $stat['value'] }}</p>
                            <h3 class="rtlbk-stat__label">{{ $stat['label'] }}</h3>
                        </article>
                    @endforeach
                </div>

                <div class="rtlbk-section__cta">
                    <a href="#contact-us" class="rtlbk-btn rtlbk-btn--navy">
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- CTA banner --}}
        <section class="rtlbk-banner" aria-labelledby="rtlbk-banner-title">
            <div class="site-shell rtlbk-banner__inner">
                <h2 id="rtlbk-banner-title">For every retail decision, we ensure financial precision.</h2>
                <p class="rtlbk-banner__sub">Outsource your bookkeeping with confidence.</p>
                <a href="#contact-us" class="rtlbk-btn rtlbk-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="rtlbk-section" aria-labelledby="rtlbk-software-title">
            <div class="site-shell">
                <div class="rtlbk-heading rtlbk-heading--center">
                    <h2 id="rtlbk-software-title" class="rtlbk-software-title">
                        Software <span>Expertise</span>
                    </h2>
                </div>
                <div class="rtlbk-software">
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
        <section class="rtlbk-section" aria-labelledby="rtlbk-work-title">
            <div class="site-shell">
                <div class="rtlbk-heading rtlbk-heading--center">
                    <h2 id="rtlbk-work-title">How We Work</h2>
                    <p>IBN Tech's streamlined outsourcing process ensures swift and efficient operations:</p>
                </div>

                <div class="rtlbk-steps" role="list">
                    @foreach ($workSteps as $step)
                        <article class="rtlbk-step" role="listitem">
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

                <div class="rtlbk-section__cta">
                    <a href="#contact-us" class="rtlbk-btn rtlbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Areas We Serve --}}
        <section class="rtlbk-section" aria-labelledby="rtlbk-areas-title">
            <div class="site-shell">
                <div class="rtlbk-heading rtlbk-heading--center">
                    <h2 id="rtlbk-areas-title">Areas We Serve</h2>
                </div>

                <div class="rtlbk-areas">
                    @foreach ($areasColumns as $column)
                        <ul class="rtlbk-areas__col">
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
        <section class="rtlbk-section rtlbk-consult" id="contact-us" aria-labelledby="rtlbk-consult-title">
            <div class="site-shell rtlbk-consult__inner">
                <aside class="rtlbk-consult__card" aria-labelledby="rtlbk-consult-title">
                    <div class="rtlbk-consult__header">
                        <h2 id="rtlbk-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="rtlbk-consult__body">
                        <livewire:forms.contact-form
                            form-name="bookkeeping-services-for-retail-stores"
                            id-prefix="rtlbk"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="What kind of accounting solution are you looking for?"
                            submit-label="Submit"
                            layout="home"
                            thank-you-url="/thanks-you-for-bookkeeping/"
                        />
                    </div>
                </aside>

                <div class="rtlbk-consult__media">
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

        {{-- FAQ --}}
        <section class="rtlbk-section rtlbk-section--soft" aria-labelledby="rtlbk-faq-title">
            <div class="site-shell">
                <div class="rtlbk-heading rtlbk-heading--center">
                    <h2 id="rtlbk-faq-title">Frequently Asked Questions (FAQ's)</h2>
                </div>

                <div class="rtlbk-faq">
                    <div class="rtlbk-faq__media">
                        <img
                            src="{{ $img('faq-banner.webp') }}"
                            alt="faq-banner"
                            width="1080"
                            height="1080"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>

                    <div class="rtlbk-faq__list">
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
