@php
    $img = fn (string $file): string => asset('images/bookkeeping-services-for-small-businesses/'.$file);

    $heroBullets = [
        '50+ Certified Bookkeepers on US Accounting available On Demand.',
        'Price $10/H Basis. More than 3 Seats ask for Enterprise Pricing.',
        'ISO Certified | Cert Certified for Data Security | Cloud Environment.',
        'Scalable With Short Notice.',
    ];

    $financeServices = [
        [
            'icon' => 'bookkeeping-services.webp',
            'title' => 'Bookkeeping Services',
            'text' => 'Bookkeeping plays an extensive and crucial role for all businesses. This elemental function assists business owners in crucial financial decisions.',
            'slug' => 'bookkeeping-services',
        ],
        [
            'icon' => 'assistant-to-cfo-services.webp',
            'title' => 'Assistant to CFO services',
            'text' => 'Assistant to CFO services are designed to provide their client with professional expertise in the cost analysis as well as expenditure budgeting for the organization.',
            'slug' => 'assistant-to-cfo-services',
        ],
        [
            'icon' => 'tax-preparation-services.webp',
            'title' => 'Tax Preparation Services',
            'text' => 'IBN’s team of Chartered Accountants and Certified Public Accountants & Tax professionals in liaison with you provide an optimum delivery model .',
            'slug' => 'us-uk-tax-preparation-services',
        ],
        [
            'icon' => 'accounting-firm-cpa-study.webp',
            'title' => 'Accounting Firm & CPA Study',
            'text' => 'IBN’s Finance and Accounting team of professional Accountants and Tax experts works closely with US CPA Firms and render them services like Book-keeping, payroll services.',
            'slug' => 'cpa-outsourcing',
        ],
        [
            'icon' => 'payroll-servicespreparation-services.webp',
            'title' => 'Payroll Services',
            'text' => 'Payroll Processing is an important aspect for every organization. Payroll is also crucial because payroll and payroll taxes considerably affect the net income.',
            'slug' => 'payroll-processing',
        ],
        [
            'icon' => 'accounts-payable-and-receivable.webp',
            'title' => 'Accounts Payable and Receivable',
            'text' => 'IBN caters to various industries with value added AP & AR services. IBNs AP & AR services help companies reduce and maintain low cost and effectively manage their operations.',
            'slug' => 'accounts-payable-and-accounts-receivable-services',
        ],
    ];

    $processSteps = [
        [
            'icon' => 'send-us-your-information.webp',
            'title' => 'Send Us Your Information',
            'text' => 'To start with we take all related data from you, once we get a similar our team addresses your requirement.',
        ],
        [
            'icon' => 'we-analyse-and-record-the-information.webp',
            'title' => 'We Analyse and Record the Information',
            'text' => 'In the wake of getting your important data, our master group begins analysing and recording results. This is on the grounds that data which you give.',
        ],
        [
            'icon' => 'submitting-results.webp',
            'title' => 'Submitting Results',
            'text' => 'Toward the finish of all, you would get the results. We at IBN Technologies concentrate on meeting end to end customer’s necessity.',
        ],
    ];

    $clientLogos = [
        ['file' => 'iso1.png', 'alt' => 'ISO1'],
        ['file' => 'microsoft-gold-partner.png', 'alt' => 'Microsoft Gold Partner'],
        ['file' => 'pap-logo.png', 'alt' => 'PAP logo'],
        ['file' => 'wave1.png', 'alt' => 'Wave'],
        ['file' => 'xeropartner.webp', 'alt' => 'Xero Partner'],
        ['file' => 'xero.webp', 'alt' => 'Xero'],
        ['file' => 'freshbook.png', 'alt' => 'FreshBooks certification'],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/bookkeeping-services-for-small-businesses.css'])
@endpush

@section('content')
    <div class="bkssb-page">
        {{-- Hero --}}
        <section class="bkssb-hero" aria-labelledby="bkssb-hero-title">
            <div class="bkssb-hero__bg" aria-hidden="true">
                <img
                    src="{{ $img('accounting-advisory-services-for-small-businesses.webp') }}"
                    alt=""
                    width="960"
                    height="640"
                    fetchpriority="high"
                    decoding="async"
                >
            </div>
            <div class="site-shell bkssb-hero__inner">
                <div class="bkssb-hero__copy">
                    <h1 id="bkssb-hero-title">Accounting Advisory Services For Small Businesses</h1>
                    <p class="bkssb-hero__lede"><strong>Pay As You Go, 40% + Cost Reduction.</strong></p>
                    <ul class="bkssb-hero__list">
                        @foreach ($heroBullets as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <div class="bkssb-hero__actions">
                        <a
                            href="{{ route('page.show', ['slug' => 'contact-us']) }}"
                            class="bkssb-btn bkssb-btn--cream"
                        >
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="bkssb-section bkssb-intro" aria-labelledby="bkssb-intro-title">
            <div class="site-shell bkssb-intro__inner">
                <h2 id="bkssb-intro-title">Accounting Advisory Services for Small Businesses</h2>
                <p>
                    Today’s business world is characterized by aggressive competition. In this scenario, experienced and expert advisory services is a necessity. IBNs expert team of accounting will provide you with high level consultative and accounting advisory Services for Small Businesses. With experience outsource bookkeeping service in catering to the advisory needs of a wide range of clients from diverse industrial sectors, out dedicated team offers responsive and customised advisory services. Even check for bookkeeping fees for small business.
                </p>
                <p>
                    We would love to hear from you. Call us at
                    <a href="tel:+18446448440"><strong>+1-844-644-8440</strong></a>
                    or drop us an electronic mail to avail our services!
                </p>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="bkssb-section bkssb-software" aria-labelledby="bkssb-software-title">
            <div class="site-shell">
                <div class="bkssb-heading bkssb-heading--center">
                    <h2 id="bkssb-software-title">
                        Software <span class="bkssb-accent">Expertise</span>
                    </h2>
                </div>
                <div class="bkssb-software__media">
                    <img
                        src="{{ $img('software-bookkeeping.webp') }}"
                        alt="Software-Bookkeeping"
                        width="1200"
                        height="560"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Finance And Accounting --}}
        <section class="bkssb-section bkssb-finance" aria-labelledby="bkssb-finance-title">
            <div class="site-shell">
                <div class="bkssb-heading bkssb-heading--center">
                    <h2 id="bkssb-finance-title">Finance And Accounting</h2>
                    <p>Why You Should Use Finance And Accounting Services</p>
                </div>

                <div class="bkssb-finance__grid" role="list">
                    @foreach ($financeServices as $service)
                        <article class="bkssb-finance-card" role="listitem">
                            <a
                                href="{{ route('page.show', ['slug' => $service['slug']]) }}"
                                class="bkssb-finance-card__icon"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <img
                                    src="{{ $img($service['icon']) }}"
                                    alt=""
                                    width="65"
                                    height="65"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </a>
                            <div class="bkssb-finance-card__body">
                                <h3>
                                    <a href="{{ route('page.show', ['slug' => $service['slug']]) }}">
                                        {{ $service['title'] }}
                                    </a>
                                </h3>
                                <p>{{ $service['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Our Services (process) --}}
        <section class="bkssb-section bkssb-process" aria-labelledby="bkssb-process-title">
            <div class="site-shell">
                <div class="bkssb-heading bkssb-heading--center">
                    <h2 id="bkssb-process-title">Our Services</h2>
                </div>

                <div class="bkssb-process__grid" role="list">
                    @foreach ($processSteps as $step)
                        <article class="bkssb-process-card" role="listitem">
                            <div class="bkssb-process-card__icon">
                                <img
                                    src="{{ $img($step['icon']) }}"
                                    alt="{{ $step['title'] }}"
                                    width="65"
                                    height="65"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Our Clients Love Us --}}
        <section class="bkssb-section bkssb-clients" aria-labelledby="bkssb-clients-title">
            <div class="site-shell">
                <div class="bkssb-heading bkssb-heading--center">
                    <h2 id="bkssb-clients-title">Our Clients Love Us</h2>
                </div>

                <div
                    class="bkssb-clients__carousel"
                    x-data="{
                        index: 0,
                        perView: 4,
                        total: {{ count($clientLogos) }},
                        get maxIndex() { return Math.max(0, this.total - this.perView); },
                        prev() { this.index = Math.max(0, this.index - 1); },
                        next() { this.index = Math.min(this.maxIndex, this.index + 1); },
                        resize() {
                            this.perView = window.innerWidth < 560 ? 2 : (window.innerWidth < 860 ? 3 : 4);
                            this.index = Math.min(this.index, this.maxIndex);
                        }
                    }"
                    x-init="resize(); window.addEventListener('resize', () => resize())"
                >
                    <button
                        type="button"
                        class="bkssb-clients__nav bkssb-clients__nav--prev"
                        @click="prev()"
                        :disabled="index === 0"
                        aria-label="Previous logos"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
                        </svg>
                    </button>

                    <div class="bkssb-clients__viewport">
                        <div
                            class="bkssb-clients__track"
                            :style="`transform: translateX(calc(-${index} * (100% / ${perView}))); --per-view: ${perView}`"
                        >
                            @foreach ($clientLogos as $logo)
                                <div class="bkssb-clients__item">
                                    <img
                                        src="{{ $img($logo['file']) }}"
                                        alt="{{ $logo['alt'] }}"
                                        width="150"
                                        height="130"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button
                        type="button"
                        class="bkssb-clients__nav bkssb-clients__nav--next"
                        @click="next()"
                        :disabled="index >= maxIndex"
                        aria-label="Next logos"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M696 533C708 521 713 504 713 487 713 471 708 454 696 446L400 146C388 133 375 125 354 125 338 125 325 129 313 142 300 154 292 171 292 187 292 204 296 221 308 233L563 492 304 771C292 783 288 800 288 817 288 833 296 850 308 863 321 871 338 875 354 875 371 875 388 867 400 854L696 533Z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        {{-- Contact form (WordPress “Let’s Talk Business”) --}}
        <section
            class="bkssb-section bkssb-consult"
            id="contact-us"
            aria-labelledby="bkssb-consult-title"
        >
            <div class="site-shell bkssb-consult__inner">
                <aside class="bkssb-consult__card" aria-labelledby="bkssb-consult-title">
                    <div class="bkssb-consult__header">
                        <h2 id="bkssb-consult-title">Let’s Talk Business</h2>
                        <p>Book a quick strategy call with our experts to discuss your business needs.</p>
                    </div>
                    <div class="bkssb-consult__body">
                        <livewire:forms.contact-form
                            form-name="bookkeeping-services-for-small-businesses"
                            id-prefix="bkssb"
                            :show-company="true"
                            :show-service="false"
                            message-placeholder="Message"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>
            </div>
        </section>
    </div>
@endsection
