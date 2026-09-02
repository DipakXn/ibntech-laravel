@php
    $img = fn (string $file): string => asset('images/seo-testing/'.$file);

    $benefits = [
        [
            'title' => 'Keyword Testing:',
            'text' => 'Identify and implement the most effective keywords for your business, optimizing your site\'s search engine ranking.',
        ],
        [
            'title' => 'Content Testing:',
            'text' => 'Evaluate your site\'s content for SEO effectiveness, including relevance, readability, and keyword density.',
        ],
        [
            'title' => 'On-Page Optimization Testing:',
            'text' => 'Ensure all on-page elements, such as titles, meta tags, and images, are properly optimized for search engines.',
        ],
        [
            'title' => 'Backlink Testing:',
            'text' => 'Assess the quality and effectiveness of your site\'s backlinks, an important factor in search engine algorithms.',
        ],
        [
            'title' => 'Technical SEO Testing:',
            'text' => 'Evaluate the technical aspects of your site, such as load speed, mobile compatibility, and URL structure, which can affect your search engine ranking.',
        ],
    ];

    $fullRangeServices = [
        [
            'icon' => 'time-based-seo-testing.webp',
            'alt' => 'time-based seo testing',
            'title' => 'Time-Based SEO Testing',
            'text' => 'Implement and evaluate SEO strategies over specific time periods to identify the most effective tactics for your site.',
        ],
        [
            'icon' => 'seo-split-testing.webp',
            'alt' => 'seo split testing',
            'title' => 'SEO Split Testing',
            'text' => 'Compare the effectiveness of different SEO strategies to optimize your site\'s search engine ranking.',
        ],
    ];

    $uniqueApproach = [
        'A dedicated team of SEO experts with a deep understanding of search engine algorithms and ranking factors.',
        'A data-driven approach that uses comprehensive testing to identify the most effective SEO strategies for your site.',
        'Customized SEO solutions tailored to your business, industry, and target audience.',
        'Continuous monitoring and adjustment of SEO strategies to respond to changes in search engine algorithms and competitive landscapes.',
    ];

    $processSteps = [
        'Understanding your business, industry, and target audience to inform our SEO strategy.',
        'Developing and implementing a comprehensive SEO testing plan.',
        'Analyzing testing results to identify the most effective strategies for your site.',
        'Making necessary adjustments to your site\'s SEO elements based on testing results.',
        'Continuous monitoring and adjustment of SEO strategies to ensure sustained effectiveness.',
    ];

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/seo-testing.css'])
@endpush

@section('content')
    <div class="seotest-page">
        {{-- Hero --}}
        <section class="seotest-hero" aria-labelledby="seotest-hero-title">
            <div class="site-shell seotest-hero__inner">
                <div class="seotest-hero__copy">
                    <p class="seotest-hero__eyebrow">
                        Optimize Your Digital Presence with IBN Tech's Comprehensive SEO Testing Services
                    </p>
                    <h1 id="seotest-hero-title">SEO Testing Services</h1>
                    <p class="seotest-hero__lede">
                        Did you know that 75% of users never scroll past the first page of search results? Let's make sure you're there.
                    </p>
                    <div class="seotest-hero__actions">
                        <a href="#contact-us" class="seotest-btn seotest-btn--green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="seotest-hero__media">
                    <img
                        src="{{ $img('seo-testing-banner.webp') }}"
                        alt="seo testing banner"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro Section --}}
        <section class="seotest-section" aria-labelledby="seotest-intro-title">
            <div class="site-shell seotest-split">
                <div class="seotest-split__media">
                    <img
                        src="{{ $img('ibn-tech-database-consulting-service-provide.webp') }}"
                        alt="ibn tech database consulting service provide"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="seotest-split__copy">
                    <h2 id="seotest-intro-title" class="sr-only">About IBN Tech SEO Testing Services</h2>
                    <p>
                        In the digital era, visibility is key to business success. And, with nearly 68% of online experiences beginning with a search engine, SEO (Search Engine Optimization) has never been more crucial. IBN Tech's comprehensive SEO Testing Services are designed to ensure your website is optimized for visibility and reach, helping you stand out in the crowded digital marketplace.
                    </p>
                    <a href="#contact-us" class="seotest-btn seotest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Top Service Benefits --}}
        <section class="seotest-section" aria-labelledby="seotest-benefits-title">
            <div class="site-shell">
                <div class="seotest-heading">
                    <h2 id="seotest-benefits-title">Top Service Benefits</h2>
                    <p>Our SEO Testing Services include a wide array of strategies to boost your digital presence:</p>
                </div>

                <div class="seotest-split seotest-split--benefits">
                    <div class="seotest-benefits__copy">
                        <ul class="seotest-benefits__list">
                            @foreach ($benefits as $item)
                                <li>
                                    <strong>{{ $item['title'] }}</strong> {{ $item['text'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="seotest-benefits__media">
                        <img
                            src="{{ $img('service-highlights.webp') }}"
                            alt="service highlights"
                            width="778"
                            height="618"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>

                <div class="seotest-section__cta">
                    <a href="#contact-us" class="seotest-btn seotest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Full Range of Services --}}
        <section class="seotest-section" aria-labelledby="seotest-range-title">
            <div class="site-shell">
                <div class="seotest-heading">
                    <h2 id="seotest-range-title">Full Range of Services</h2>
                    <p>Our API Testing services provide a comprehensive approach to validating your APIs:</p>
                </div>

                <div class="seotest-cards-grid" role="list">
                    @foreach ($fullRangeServices as $service)
                        <article class="seotest-card" role="listitem">
                            <figure class="seotest-card__icon">
                                <img
                                    src="{{ $img($service['icon']) }}"
                                    alt="{{ $service['alt'] }}"
                                    width="65"
                                    height="65"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </figure>
                            <h3>{{ $service['title'] }}</h3>
                            <p>{{ $service['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="seotest-section__cta">
                    <a href="#contact-us" class="seotest-btn seotest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Our Unique Approach to Customer Benefits --}}
        <section class="seotest-section seotest-section--mint" aria-labelledby="seotest-approach-title">
            <div class="site-shell seotest-split seotest-split--approach">
                <div class="seotest-split__copy">
                    <h2 id="seotest-approach-title" class="seotest-heading--navy">Our Unique Approach to Customer Benefits</h2>
                    <p class="seotest-subhead">Choosing IBN Tech for your SEO Testing needs brings:</p>
                    <ul class="seotest-list">
                        @foreach ($uniqueApproach as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="seotest-btn seotest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="seotest-split__media seotest-split__media--photo">
                    <img
                        src="{{ $img('our-unique-approach-2.webp') }}"
                        alt="our unique approach"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- SEO Testing Process at IBN Tech --}}
        <section class="seotest-section" aria-labelledby="seotest-process-title">
            <div class="site-shell seotest-split seotest-split--process">
                <div class="seotest-split__media">
                    <img
                        src="{{ $img('seo-testing-process.webp') }}"
                        alt="seo testing process"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="seotest-split__copy">
                    <p class="seotest-process__eyebrow">SEO Testing Process at IBN Tech</p>
                    <h2 id="seotest-process-title">Our SEO testing process is thorough and methodical:</h2>
                    <ul class="seotest-list seotest-list--spaced">
                        @foreach ($processSteps as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="seotest-btn seotest-btn--green">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Callout Banner --}}
        <section class="seotest-banner" aria-labelledby="seotest-banner-title">
            <div class="site-shell seotest-banner__inner">
                <h2 id="seotest-banner-title" class="sr-only">IBN Tech SEO and API Testing Capabilities</h2>
                <p>
                    At IBN Tech, we understand the critical role APIs play in modern software systems. Trust us to ensure the seamless functionality and interoperability of your APIs with our comprehensive API Testing services. Let us help you deliver high-quality, reliable software experiences.
                </p>
                <div class="seotest-banner__cta">
                    <a href="#contact-us" class="seotest-btn seotest-btn--green">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Schedule A Call with Our Experts --}}
        <section class="seotest-section seotest-consult" id="contact-us" aria-labelledby="seotest-consult-title">
            <div class="site-shell seotest-consult__inner">
                <aside class="seotest-consult__card" aria-labelledby="seotest-consult-title">
                    <div class="seotest-consult__header">
                        <h2 id="seotest-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="seotest-consult__body">
                        <livewire:forms.contact-form
                            form-name="seo-testing"
                            id-prefix="seotest"
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

                <div class="seotest-consult__media">
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
    </div>
@endsection
