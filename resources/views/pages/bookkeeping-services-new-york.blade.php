@php
    $img = fn (string $file): string => asset('images/bookkeeping-services-new-york/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Accounting Services',
        'Payroll Processing',
        'Accounts Payable and Receivable',
        'Tax Preparation Support',
        'Financial Reporting',
        'Controller Services',
    ];

    $serviceTabs = [
        [
            'title' => 'Bookkeeping Services',
            'image' => 'bookkeeping-services-1.webp',
            'alt' => 'Bookkeeping Services in USA',
        ],
        [
            'title' => 'Payroll Processing',
            'image' => 'payroll-processing.webp',
            'alt' => 'Payroll Processing Services in USA',
        ],
        [
            'title' => 'Financial Reporting',
            'image' => 'financial-reporting-1.webp',
            'alt' => 'Financial Reporting Service in USA',
        ],
        [
            'title' => 'Accounting Services',
            'image' => 'accounting-services-1.webp',
            'alt' => 'Accounting Services in USA',
        ],
        [
            'title' => 'Controller Services',
            'image' => 'controller-services-1.webp',
            'alt' => 'Best Controller Services In USA',
        ],
        [
            'title' => 'Accounts Payable and Receivable',
            'image' => 'accounts-payable-and-receivable-1.webp',
            'alt' => 'Accounts Payable and Receivable Services In USA',
        ],
    ];

    $whyChoose = [
        [
            'num' => '01',
            'color' => '#ff9900',
            'title' => 'Strategic Insights',
            'text' => 'We go beyond basic bookkeeping, offering valuable insights and recommendations to help grow your business',
        ],
        [
            'num' => '02',
            'color' => '#ff3333',
            'title' => '24/7 Accessibility',
            'text' => 'Enjoy the convenience of managing your finances from anywhere with our online platforms, available 24/7',
        ],
        [
            'num' => '03',
            'color' => '#009999',
            'title' => 'Leverage the Best Accounting Tools',
            'text' => 'Our professionals work with your preferred accounting software or recommend the best tools to meet your needs',
        ],
        [
            'num' => '04',
            'color' => '#1cbf36',
            'title' => 'Local Knowledge',
            'text' => 'We understand Nevada’s specific business environment, including tax and compliance requirements, giving us an edge in providing accurate and efficient services',
        ],
        [
            'num' => '05',
            'color' => '#b117df',
            'title' => 'Clear Communication',
            'text' => 'We prioritize open, transparent communication, ensuring you’re always in the loop about your financial health',
        ],
        [
            'num' => '06',
            'color' => '#f10ab8',
            'title' => 'Your Data is Safe',
            'text' => 'We prioritize your data security, utilizing advanced technology and adhering to ISO 27001 certification standards to protect all sensitive information',
        ],
        [
            'num' => '07',
            'color' => '#27dd9b',
            'title' => 'Time and Cost Savings',
            'text' => 'Outsourcing your bookkeeping saves time and reduces overhead and administrative costs, making financial management more affordable',
        ],
        [
            'num' => '08',
            'color' => '#2a5712',
            'title' => 'Minimal Input Required',
            'text' => 'With our qualified team, you can stay hands-off, while we handle all aspects of your bookkeeping seamlessly',
        ],
    ];

    $whatYouGet = [
        [
            'Detailed Report Creation',
            'E-Document Management',
            'Quick Document Submission',
            'Access to Accounting Systems',
            'MIS and other Management Reporting',
        ],
        [
            'Ensuring GAAP Compliance',
            'Accounting Advisory Services',
            'Month Close and Ongoing Support',
            'Budget V/S Actual reporting and analysis',
        ],
    ];

    $stats = [
        ['value' => '30+', 'label' => 'Industry Served'],
        ['value' => '26+', 'label' => 'Years of Experience'],
        ['value' => '200+', 'label' => 'Active Global Clients'],
        ['value' => '50%', 'label' => 'Save operational cost'],
        ['value' => '95%', 'label' => 'Client Retention Rate'],
        ['value' => '99.99%', 'label' => 'Accuracy in Deliverables'],
        ['value' => '21+', 'label' => 'Accounting Software Expertise'],
        ['value' => '120+', 'label' => 'Qualified & Certified Bookkeepers'],
        ['value' => '10+', 'label' => 'Client-centric Account Managers'],
    ];

    $industries = [
        [
            'label' => 'Real Estate',
            'file' => 'real-estate.webp',
            'alt' => 'real estate',
            'slug' => 'real-estate-construction-bookkeeping-services',
        ],
        [
            'label' => 'Healthcare',
            'file' => 'healthcare.webp',
            'alt' => 'healthcare',
            'slug' => 'healthcare-bookkeeping-services',
        ],
        [
            'label' => "Restaurant's",
            'file' => 'restaurant.webp',
            'alt' => 'Restaurent',
            'slug' => 'restaurants-bookkeeping-services',
        ],
        [
            'label' => 'Finance Business',
            'file' => 'finance-business.webp',
            'alt' => 'Manufacturing',
            'slug' => 'finance-businesses-bookkeeping-service',
        ],
        [
            'label' => 'Retail Store',
            'file' => 'retail.webp',
            'alt' => 'retail',
            'slug' => 'bookkeeping-services-for-retail-stores',
        ],
        [
            'label' => 'Travel',
            'file' => 'travel.webp',
            'alt' => 'Travel',
            'slug' => 'travel-bookkeeping-service',
        ],
        [
            'label' => 'CPA Firms',
            'file' => 'cpa.webp',
            'alt' => 'CPA',
            'slug' => null,
        ],
        [
            'label' => 'E-Commerce',
            'file' => 'ecommerce.webp',
            'alt' => 'Ecommerce',
            'slug' => 'ecommerce-bookkeeping-services',
        ],
        [
            'label' => 'Legal Firms',
            'file' => 'legal.webp',
            'alt' => 'Legal',
            'slug' => 'legal-bookkeeping-services',
        ],
        [
            'label' => 'Marketing & Advertising',
            'file' => 'marketing-advertising.webp',
            'alt' => 'Marketing',
            'slug' => 'marketing-and-advertising-bookkeeping-services',
        ],
        [
            'label' => 'Food & Beverage',
            'file' => 'food-beverage.webp',
            'alt' => 'Bookkeeping for Food & Beverage',
            'slug' => 'food-and-beverage-bookkeeping-services',
        ],
        [
            'label' => 'IT Business',
            'file' => 'it-business.webp',
            'alt' => 'IT-Business',
            'slug' => 'it-business-bookkeeping-service',
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
    @vite(['resources/css/pages/bookkeeping-services-new-york.css'])
@endpush

@section('content')
    <div class="bkny-page">
        {{-- Hero --}}
        <section class="bkny-hero" aria-labelledby="bkny-hero-title">
            <div class="site-shell bkny-hero__inner">
                <div class="bkny-hero__copy">
                    <h1 id="bkny-hero-title">
                        Professional Bookkeeping Services in New York for Every Business
                    </h1>
                    <p class="bkny-hero__lede">
                        Your trusted partner for accounting and bookkeeping services in New York, offering tailored financial solutions and expert reporting. We manage your books, review key performance ratios, and provide monthly financial reviews for clarity and profitability insights.
                    </p>
                </div>

                <aside class="bkny-hero__form" id="contact-us" aria-labelledby="bkny-hero-form-title">
                    <h2 id="bkny-hero-form-title">Get Started with Our Bookkeeping Services</h2>
                    <p class="bkny-hero__form-sub">Fill Out the Form and Simplify Your Books</p>

                    <livewire:forms.contact-form
                        form-name="bookkeeping-services-new-york"
                        id-prefix="bkny"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$formServiceOptions"
                        service-placeholder="Please Select Services"
                        message-placeholder="Message"
                        submit-label="Submit"
                        layout="home"
                        thank-you-url="/thanks-you-for-bookkeeping/"
                    />
                </aside>
            </div>
        </section>

        {{-- Intro card --}}
        <section class="bkny-intro" aria-labelledby="bkny-intro-title">
            <div class="site-shell">
                <div class="bkny-intro__card">
                    <h2 id="bkny-intro-title">Expert Bookkeeping Services for NYC Businesses</h2>
                    <p>
                        In the dynamic business landscape of New York City,
                        <strong>IBN Technologies</strong>
                        provides
                        <a href="https://www.ibntech.com/blog/outsourced-bookkeeping-in-new-york/">expert bookkeeping services</a>
                        designed to navigate the complexities of local tax laws and business regulations. Our skilled team combines advanced software with deep industry knowledge to ensure your financials are accurate, compliant, and stress-free. We specialize in New York tax laws, understanding the nuances specific to your industry, and tailor our services to meet the unique demands of NYC businesses.
                    </p>
                </div>
            </div>
        </section>

        {{-- Outsourced services tabs --}}
        <section class="bkny-section" aria-labelledby="bkny-services-title">
            <div class="site-shell">
                <div class="bkny-heading bkny-heading--center">
                    <h2 id="bkny-services-title">Outsourced Bookkeeping Services in New York</h2>
                </div>

                <div
                    class="bkny-tabs"
                    x-data="{ active: 0 }"
                >
                    <div class="bkny-tabs__nav" role="tablist" aria-label="Bookkeeping service categories">
                        @foreach ($serviceTabs as $i => $tab)
                            <button
                                type="button"
                                class="bkny-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                role="tab"
                                id="bkny-tab-{{ $i }}"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                :class="{ 'is-active': active === {{ $i }} }"
                                @click="active = {{ $i }}"
                                aria-controls="bkny-panel-{{ $i }}"
                            >
                                <span>{{ $tab['title'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="bkny-tabs__panels">
                        @foreach ($serviceTabs as $i => $tab)
                            <div
                                class="bkny-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                                id="bkny-panel-{{ $i }}"
                                role="tabpanel"
                                aria-labelledby="bkny-tab-{{ $i }}"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :hidden="active !== {{ $i }}"
                            >
                                <div class="bkny-tabs__media">
                                    <img
                                        src="{{ $img($tab['image']) }}"
                                        alt="{{ $tab['alt'] }}"
                                        width="850"
                                        height="450"
                                        @if ($i === 0) loading="eager" fetchpriority="high" @else loading="lazy" @endif
                                        decoding="async"
                                    >
                                    <a
                                        href="#"
                                        class="bkny-btn bkny-btn--navy bkny-tabs__cta"
                                        data-contact-modal-trigger
                                    >
                                        Schedule a call with our accounting Expert Now
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Navy CTA band --}}
        <section class="bkny-band" aria-labelledby="bkny-band-title">
            <div class="site-shell bkny-band__inner">
                <div class="bkny-band__copy">
                    <p id="bkny-band-title">
                        Affordable, Accurate Bookkeeping for Small and Mid-Sized Businesses – Let Us Keep Your Books Tax-Ready and Stress-Free!
                    </p>
                    <p>Get started now with a free consultation; bookkeeping starts at just $10 per hour!</p>
                </div>
                <a href="#" class="bkny-btn bkny-btn--green" data-contact-modal-trigger>
                    Get Started Now
                </a>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="bkny-software" aria-labelledby="bkny-software-title">
            <div class="site-shell bkny-software__inner">
                <div class="bkny-software__copy">
                    <h2 id="bkny-software-title">
                        Software <span>Expertise</span>
                    </h2>
                    <p>
                        Our expert solutions ensure smooth data flow and enhanced efficiency across your accounting and financial systems. Boost performance and optimize processes with our seamless integration services.
                    </p>
                </div>
                <div class="bkny-software__media">
                    <img
                        src="{{ $img('software-logo-img.webp') }}"
                        alt="Best accounting software expertise in IBN"
                        width="688"
                        height="321"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Why New York businesses choose us --}}
        <section class="bkny-section" aria-labelledby="bkny-why-choose-title">
            <div class="site-shell">
                <div class="bkny-heading bkny-heading--center">
                    <h2 id="bkny-why-choose-title">
                        Why New York Businesses Choose Us for Expert <span class="bkny-accent">Bookkeeping</span> Solutions
                    </h2>
                </div>

                <div class="bkny-benefits" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="bkny-benefit" role="listitem">
                            <div
                                class="bkny-benefit__num"
                                style="--bkny-num-bg: {{ $item['color'] }}"
                                aria-hidden="true"
                            >
                                {{ $item['num'] }}
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="bkny-section__cta">
                    <a href="#" class="bkny-btn bkny-btn--green" data-contact-modal-trigger>
                        GET A QUOTE
                    </a>
                </div>
            </div>
        </section>

        {{-- What You Get --}}
        <section class="bkny-what" aria-labelledby="bkny-what-title">
            <div class="site-shell bkny-what__inner">
                <div class="bkny-what__copy">
                    <h2 id="bkny-what-title">
                        What You Get with Our <span class="bkny-accent">Bookkeeping</span> Services in New York
                    </h2>

                    <div class="bkny-what__lists">
                        @foreach ($whatYouGet as $column)
                            <ul>
                                @foreach ($column as $item)
                                    <li>
                                        <span class="bkny-what__check" aria-hidden="true">
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

                <div class="bkny-what__media">
                    <img
                        src="{{ $img('what-you-get.webp') }}"
                        alt="what-you-get-with-our-bookkeeping-services"
                        width="540"
                        height="540"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Why IBN / Stats --}}
        <section class="bkny-section" aria-labelledby="bkny-why-title">
            <div class="site-shell">
                <div class="bkny-heading bkny-heading--center">
                    <h2 id="bkny-why-title">
                        Why IBN Tech is the Leading <span class="bkny-accent">Bookkeeping</span> Outsourcing Provider in the New York
                    </h2>
                </div>

                <div class="bkny-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="bkny-stat" role="listitem">
                            <p class="bkny-stat__value">{{ $stat['value'] }}</p>
                            <h3 class="bkny-stat__label">{{ $stat['label'] }}</h3>
                        </article>
                    @endforeach
                </div>

                <div class="bkny-section__cta">
                    <a href="#" class="bkny-btn bkny-btn--green" data-contact-modal-trigger>
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- Free trial CTA --}}
        <section class="bkny-trial" aria-labelledby="bkny-trial-title">
            <div class="site-shell bkny-trial__inner">
                <p id="bkny-trial-title">
                    Discover how you can reduce costs with our services. Begin with a FREE trial—no obligations !
                </p>
                <a href="{{ route('page.show', ['slug' => 'free-trial']) }}" class="bkny-btn bkny-btn--green">
                    Get Free Trial
                </a>
            </div>
        </section>

        {{-- Industries --}}
        <section class="bkny-section" aria-labelledby="bkny-industries-title">
            <div class="site-shell">
                <div class="bkny-heading bkny-heading--center">
                    <h2 id="bkny-industries-title">Industries We Serve</h2>
                </div>

                <div class="bkny-industries" role="list">
                    @foreach ($industries as $industry)
                        @if ($industry['slug'])
                            <a
                                href="{{ route('page.show', ['slug' => $industry['slug']]) }}"
                                class="bkny-industry bkny-industry--link"
                                role="listitem"
                            >
                                <img
                                    src="{{ $img($industry['file']) }}"
                                    alt="{{ $industry['alt'] }}"
                                    width="75"
                                    height="75"
                                    loading="lazy"
                                    decoding="async"
                                >
                                <h3>{{ $industry['label'] }}</h3>
                            </a>
                        @else
                            <article class="bkny-industry" role="listitem">
                                <img
                                    src="{{ $img($industry['file']) }}"
                                    alt="{{ $industry['alt'] }}"
                                    width="75"
                                    height="75"
                                    loading="lazy"
                                    decoding="async"
                                >
                                <h3>{{ $industry['label'] }}</h3>
                            </article>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="bkny-testimonials" aria-labelledby="bkny-testimonials-title">
            <div class="site-shell">
                <div class="bkny-heading bkny-heading--center">
                    <p class="bkny-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="bkny-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="bkny-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="bkny-testimonials__nav bkny-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="bkny-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="bkny-testimonial{{ $i === 0 ? ' is-active' : '' }}"
                                :class="{ 'is-active': index === {{ $i }} }"
                                :aria-hidden="index !== {{ $i }} ? 'true' : 'false'"
                            >
                                <p>{{ $item['quote'] }}</p>
                                <cite>{{ $item['cite'] }}</cite>
                            </blockquote>
                        @endforeach
                    </div>

                    <button
                        type="button"
                        class="bkny-testimonials__nav bkny-testimonials__nav--next"
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
