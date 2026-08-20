@php
    $img = fn (string $file): string => asset('images/marketing-and-advertising-bookkeeping-services/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $costingFeatures = [
        [
            'icon' => 'expense-categorization-and-analysis.webp',
            'alt' => 'expense categorization and analysis',
            'title' => 'Expense Categorization and Analysis',
            'text' => 'Discover opportunities to optimize your spending with our expense analysis tailored for high-impact marketing decisions.',
        ],
        [
            'icon' => 'campaign-cost-analysis.webp',
            'alt' => 'campaign cost analysis',
            'title' => 'Campaign Cost Analysis',
            'text' => 'Empower your strategy with comprehensive cost breakdowns that highlight efficiencies and drive profitability.',
        ],
        [
            'icon' => 'revenue-recognition.webp',
            'alt' => 'revenue recognition',
            'title' => 'Revenue Recognition',
            'text' => 'We develop sophisticated systems for recognizing revenue, particularly crucial for long-term campaigns.',
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
    @vite(['resources/css/pages/marketing-and-advertising-bookkeeping-services.css'])
@endpush

@section('content')
    <div class="mktbk-page">
        {{-- Hero --}}
        <section class="mktbk-hero" aria-labelledby="mktbk-hero-title">
            <div class="site-shell mktbk-hero__inner">
                <div class="mktbk-hero__copy">
                    <p class="mktbk-hero__eyebrow">Unlock Financial Success with</p>
                    <h1 id="mktbk-hero-title">
                        Outsourced Bookkeeping for Marketing &amp; Ad Agencies – Save Time &amp; Scale
                    </h1>
                    <p class="mktbk-hero__lede">
                        IBN Tech specializes in providing project-based bookkeeping for marketing and advertising agencies to manage their project timelines and budgets effectively.
                    </p>
                    <div class="mktbk-hero__actions">
                        <a href="#contact-us" class="mktbk-btn mktbk-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="mktbk-hero__media">
                    <img
                        src="{{ $img('bookkeeping-for-marketing-and-advertising-companies.webp') }}"
                        alt="bookkeeping for marketing and advertising companies"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="mktbk-section" aria-labelledby="mktbk-intro-title">
            <div class="site-shell mktbk-split">
                <div class="mktbk-split__media">
                    <img
                        src="{{ $img('at-ibn-tech-we-understand-that-marketing-and.webp') }}"
                        alt="at ibn tech, we understand that marketing and"
                        width="532"
                        height="362"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="mktbk-split__copy">
                    <h2 id="mktbk-intro-title">Online Data Entry Services</h2>
                    <p>
                        At IBN Tech, we understand that marketing and advertising businesses thrive on creativity and innovation. However, managing the financial aspect is equally vital for success. The dynamic nature of marketing projects, with varied expenses and revenue streams, demands expert financial oversight.
                    </p>
                    <p>
                        Our<strong>
                            <a href="{{ route('page.show', ['slug' => 'bookkeeping-services']) }}">Outsourced Bookkeeping Services</a>
                        </strong>
                        are designed specifically for the unique challenges of the marketing and advertising sector. We provide comprehensive financial management solutions, from project budgeting to expenditure tracking and accurate revenue recognition, to empower your business's growth.
                    </p>
                </div>
            </div>
        </section>

        {{-- Project Costing --}}
        <section class="mktbk-section mktbk-section--soft" aria-labelledby="mktbk-costing-title">
            <div class="site-shell">
                <div class="mktbk-heading mktbk-heading--center">
                    <h2 id="mktbk-costing-title">Project Costing and Expenditure Tracking</h2>
                    <h3>Tailored Solutions for Marketing Efficiency</h3>
                    <p>
                        Managing the financial aspects of marketing and advertising projects demands expertise and attention to detail. We offer:
                    </p>
                </div>

                <div class="mktbk-feature-grid" role="list">
                    @foreach ($costingFeatures as $item)
                        <article class="mktbk-feature-card" role="listitem">
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

                <div class="mktbk-section__cta">
                    <a href="#contact-us" class="mktbk-btn mktbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Customized Bookkeeping Solutions --}}
        <section class="mktbk-section" aria-labelledby="mktbk-custom-title">
            <div class="site-shell mktbk-split">
                <div class="mktbk-split__copy">
                    <h2 id="mktbk-custom-title">Customized Bookkeeping Solutions</h2>
                    <h3>Designed for the Creativity of Your Business</h3>
                    <p>
                        Your marketing and advertising business is one-of-a-kind, and so are your financial requirements. <strong>IBN Tech</strong> offers personalized bookkeeping services that are designed to benefit your business:
                    </p>
                    <p>
                        <strong>Detailed Financial Reporting:</strong> Gain a clear view of your financial health with our comprehensive monthly reports, providing the insights you need to make informed decisions.
                    </p>
                    <p>
                        <strong>Effective Cash Flow Management:</strong> Keep your business running smoothly with optimal cash flow, ensuring you have the resources you need when you need them.
                    </p>
                    <p>
                        <strong>Payroll Processing:</strong> Trust us for timely and accurate payroll management, ensuring your team is compensated accurately and on time.
                    </p>
                    <a href="#contact-us" class="mktbk-btn mktbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="mktbk-split__media">
                    <img
                        src="{{ $img('customized-bookkeeping-solutions.webp') }}"
                        alt="customized bookkeeping solutions"
                        width="502"
                        height="448"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Leverage Technology --}}
        <section class="mktbk-section" aria-labelledby="mktbk-tech-title">
            <div class="site-shell mktbk-split">
                <div class="mktbk-split__media">
                    <img
                        src="{{ $img('leverage-technology-for-strategic-advantage.webp') }}"
                        alt="leverage technology for strategic advantage"
                        width="322"
                        height="317"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="mktbk-split__copy">
                    <h2 id="mktbk-tech-title">Leverage Technology for Strategic Advantage</h2>
                    <h3>Harness the Power of Automation for Creativity</h3>
                    <p>
                        We employ the latest technology to enhance the accuracy and efficiency of our bookkeeping services:
                    </p>
                    <p>
                        <strong>Automated Expense Tracking:</strong> Leverage cutting-edge tools for flawless tracking and management of your marketing expenditures.
                    </p>
                    <p>
                        <strong>System Integration:</strong> Integrate your operational and financial data seamlessly, allowing for consolidated and informed decision-making.
                    </p>
                    <p>
                        <strong>Secure Data Handling Practices:</strong> Trust in our robust security measures to keep your sensitive financial information safe and sound.
                    </p>
                    <a href="#contact-us" class="mktbk-btn mktbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- What Makes IBN Tech --}}
        <section class="mktbk-section mktbk-stats-section" aria-labelledby="mktbk-stats-title">
            <div class="site-shell">
                <div class="mktbk-heading mktbk-heading--center">
                    <h2 id="mktbk-stats-title">What Makes IBN Tech</h2>
                    <p class="mktbk-heading__sub">
                        Top Bookkeeping Services Provider for Marketing and Advertising Agencies
                    </p>
                </div>

                <div class="mktbk-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="mktbk-stat" role="listitem">
                            <p class="mktbk-stat__value">{{ $stat['value'] }}</p>
                            <h3 class="mktbk-stat__label">{{ $stat['label'] }}</h3>
                        </article>
                    @endforeach
                </div>

                <div class="mktbk-section__cta">
                    <a href="#contact-us" class="mktbk-btn mktbk-btn--navy">
                        Let's Get Started
                    </a>
                </div>
            </div>
        </section>

        {{-- Transform banner --}}
        <section class="mktbk-banner" aria-labelledby="mktbk-banner-title">
            <div class="site-shell mktbk-banner__inner">
                <h2 id="mktbk-banner-title">Transform Your Agency's Finances with</h2>
                <p class="mktbk-banner__lead">
                    <strong>Outsourced Bookkeeping Services for Marketing and Advertising Firms</strong>
                </p>
                <p class="mktbk-banner__sub">No More Spreadsheets, Just Creativity and Growth!</p>
                <a href="#contact-us" class="mktbk-btn mktbk-btn--green">
                    Get Started Now
                </a>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="mktbk-section" aria-labelledby="mktbk-software-title">
            <div class="site-shell">
                <div class="mktbk-heading mktbk-heading--center">
                    <h2 id="mktbk-software-title" class="mktbk-software-title">
                        Software <span>Expertise</span>
                    </h2>
                </div>
                <div class="mktbk-software">
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
        <section class="mktbk-section" aria-labelledby="mktbk-work-title">
            <div class="site-shell">
                <div class="mktbk-heading mktbk-heading--center">
                    <h2 id="mktbk-work-title">How We Work</h2>
                    <p>IBN Tech's streamlined outsourcing process ensures swift and efficient operations:</p>
                </div>

                <div class="mktbk-steps" role="list">
                    @foreach ($workSteps as $step)
                        <article class="mktbk-step" role="listitem">
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

                <div class="mktbk-section__cta">
                    <a href="#contact-us" class="mktbk-btn mktbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Areas We Serve --}}
        <section class="mktbk-section" aria-labelledby="mktbk-areas-title">
            <div class="site-shell">
                <div class="mktbk-heading mktbk-heading--center">
                    <h2 id="mktbk-areas-title">Areas We Serve</h2>
                </div>

                <div class="mktbk-areas">
                    @foreach ($areasColumns as $column)
                        <ul class="mktbk-areas__col">
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
        <section class="mktbk-section mktbk-consult" id="contact-us" aria-labelledby="mktbk-consult-title">
            <div class="site-shell mktbk-consult__inner">
                <aside class="mktbk-consult__card" aria-labelledby="mktbk-consult-title">
                    <div class="mktbk-consult__header">
                        <h2 id="mktbk-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="mktbk-consult__body">
                        <livewire:forms.contact-form
                            form-name="marketing-and-advertising-bookkeeping-services"
                            id-prefix="mktbk"
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

                <div class="mktbk-consult__media">
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
        <section class="mktbk-testimonials" aria-labelledby="mktbk-testimonials-title">
            <div class="site-shell">
                <div class="mktbk-heading mktbk-heading--center">
                    <p class="mktbk-testimonials__eyebrow">Discover Why IBN Tech is the</p>
                    <h2 id="mktbk-testimonials-title">Best Bookkeeping Firms in the USA</h2>
                </div>

                <div
                    class="mktbk-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="mktbk-testimonials__nav mktbk-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="mktbk-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="mktbk-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="mktbk-testimonials__nav mktbk-testimonials__nav--next"
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
