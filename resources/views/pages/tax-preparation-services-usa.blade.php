@php
    $img = fn (string $file): string => asset('images/tax-preparation-services-usa/'.$file);

    $heroStats = [
        [
            'file' => '99-accuracy-assurance.webp',
            'alt' => '99 percent accuracy assurance',
            'title' => '99% Accuracy Assurance',
        ],
        [
            'file' => '100-client-satisfaction.webp',
            'alt' => '100 percent client satisfaction',
            'title' => '100% Client Satisfaction',
        ],
        [
            'file' => '100-pre-post-filing-support.webp',
            'alt' => '100 percent pre and post filing support',
            'title' => '100% Pre & Post Filing Support',
        ],
    ];

    $services = [
        [
            'file' => 'personal-tax-preparation-services.webp',
            'alt' => 'Personal tax preparation services',
            'title' => 'Personal Tax Preparation Services',
            'text' => 'Individual tax returns (Form 1040) and related schedules',
            'items' => [
                'W-2 Income Reporting',
                'Investment Income & Capital Gains',
                'Self-Employment Income',
                'Retirement Distributions',
                'Education Credits & Deductions',
                'Electronic Filing & Refund Tracking',
                'Audit Support',
            ],
        ],
        [
            'file' => 'business-tax-preparation-services.webp',
            'alt' => 'Business tax preparation services',
            'title' => 'Business Tax Preparation Services',
            'text' => 'Complex business needs from sole proprietorships to corporations',
            'items' => [
                'Schedule C (Sole Proprietors)',
                'Partnership Returns (Form 1065)',
                'S-Corporation Returns (Form 1120-S)',
                'C-Corporation Returns (Form 1120)',
                'Business Expense Optimization',
                'Quarterly Estimated Tax Planning',
                'Audit Support & IRS Correspondence',
            ],
        ],
        [
            'file' => 'tax-planning-and-advisory.webp',
            'alt' => 'Tax planning and advisory',
            'title' => 'Tax Planning and Advisory',
            'text' => 'Forward-looking services to minimize future tax liabilities',
            'items' => [
                'Year-Round Strategy',
                'Retirement Planning',
                'Investment Optimization',
                'Business Structure Advice',
                'Estate & Gift Planning',
                'Charitable Giving',
                'Family & Education Planning',
            ],
        ],
    ];

    $whyItems = [
        'Maximize deductions and credits you might miss on your own',
        'Avoid costly errors that could trigger audits',
        'Save valuable time and reduce stress',
        'Get expert guidance on tax planning strategies',
        'Receive year-round support for tax questions',
        'Stay compliant with constantly changing tax laws',
        'Availability of year-round tax support',
        'Audit assistance and representation',
        'Tax planning services',
        'Record retention policies',
    ];

    $steps = [
        [
            'icon' => 'fa-users',
            'num' => '01',
            'title' => 'Initial Consultation',
            'text' => 'We assess your tax needs—individual, family, or business—and explain how we can help.',
        ],
        [
            'icon' => 'fa-file-arrow-down',
            'num' => '02',
            'title' => 'Document Collection',
            'text' => 'You submit financial records securely through our encrypted client portal for review.',
        ],
        [
            'icon' => 'fa-table',
            'num' => '03',
            'title' => 'Preparation & Analysis',
            'text' => 'We prepare and double-check your return for accuracy, deductions, and compliance.',
        ],
        [
            'icon' => 'fa-circle-check',
            'num' => '04',
            'title' => 'Review & Approval',
            'text' => 'We prepare and double-check your return for accuracy, deductions, and compliance.',
        ],
        [
            'icon' => 'fa-file-lines',
            'num' => '05',
            'title' => 'Filing & Follow-up',
            'text' => 'We help you to submit your tax return and provide updates, guidance, and support as needed.',
        ],
    ];

    $features = [
        [
            'icon' => 'fa-file-invoice',
            'tone' => 'navy',
            'title' => 'Bookkeeping Integration',
            'text' => 'Combine our bookkeeping and tax services for a comprehensive financial management solution. Our integrated approach ensures accurate financial data flows seamlessly into tax preparation.',
        ],
        [
            'icon' => 'fa-shield-halved',
            'tone' => 'green',
            'title' => 'Secure Document Exchange',
            'text' => 'Our encrypted client portal facilitates safe transfer of sensitive tax documents and information, maintaining confidentiality and compliance with data protection regulations',
        ],
        [
            'icon' => 'fa-bolt',
            'tone' => 'gold',
            'title' => 'Software Compatibility',
            'text' => 'We work with all major tax preparation software including Intuit TurboTax, Drake, CCH Axcess Tax, TaxSlayer Pro, Lacerte, Proconnect and ProSeries ensuring seamless data transfer and workflow integration with your existing systems.',
        ],
    ];

    $tools = [
        ['file' => 'picture1.webp', 'alt' => 'Intuit TurboTax'],
        ['file' => 'picture2.webp', 'alt' => 'Drake Software'],
        ['file' => 'picture3.webp', 'alt' => 'TaxSlayer Pro'],
        ['file' => 'picture4.webp', 'alt' => 'Intuit Lacerte Tax'],
        ['file' => 'picture7.webp', 'alt' => 'Intuit ProSeries Tax'],
        ['file' => 'picture6.webp', 'alt' => 'Intuit ProConnect'],
    ];

    $faqs = [
        [
            'q' => 'How do you review the information?',
            'paragraphs' => [
                'For Proper scrutinization of all the documents is mandatory which provided by the taxpayer and accordingly cross verification is processed. Apart from it Page one of the return is very important; previous return is to be tallied wherever required.',
                '(Individual returns do take some time for reviewing as it has various forms and schedules for various head)',
            ],
        ],
        [
            'q' => 'How do you ask questions?',
            'paragraphs' => [
                'Questions can be asked in two-way process and majorly its totally depend on client in whichever way they need us to communicate. Immediate Communication can be through call or Teams Chat app, but Mails can also be used if the client has big team plus for asking any docs.',
            ],
        ],
        [
            'q' => 'What are the documents you need before start working on tax return for?',
            'lists' => [
                'Individual- For 1040 we need PY Tax Return + W2s + 1099 + 1098 + K1 + any info Related to Schedule C accordingly we need to categorize proportionate to the demand of Taxpayer.',
                'S Corp- S Corp(1120S) + C Corp (1120) and Partnership (1065) these three business returns as more or the less have same sort of document list like Income Statement and Balance sheet + different documents required according to the nature of the business (For e.g.: – Investment Fund Return 1065 must have Investment partners Bifurcation list, etc.)',
                'Trust- 990 Forms too have Income Statement & B/S with this they too come with donors’ information which need to be mentioned in the return.',
            ],
        ],
        [
            'q' => 'How much time you spend on finalization of below types of tax returns?',
            'paragraphs' => [
                'It totally depends on the expertise and the nature of return.',
            ],
            'lists' => [
                'Individual- If only 4 to 5 forms (W2s 1099 1098) are there than 30mins; if return contains credit, K1s, deductions, FBAR, then 1 to 2 hrs. (Variable).',
                'S Corp- For S Corp, C Corp & Partnership if Pro Series is directly connected to QB Desktop than only 15 to 20 mins but if we have to do manually than return can range from 30mins to 3hrs (Hedge Funds).',
                'Trust- 30mins to 1Hr.',
            ],
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/tax-preparation-services-usa.css'])
@endpush

@section('content')
    <div class="tpsusa-page">
        {{-- Hero --}}
        <section class="tpsusa-hero" aria-labelledby="tpsusa-hero-title">
            <div class="site-shell">
                <h1 id="tpsusa-hero-title">Simplify Tax Filing with Outsourced U.S. Tax Return Preparation Services</h1>
                <p class="tpsusa-hero__lede">
                    Meet urgent tax deadlines confidently with streamlined processes and expert oversight
                </p>
                <ul class="tpsusa-hero__stats">
                    @foreach ($heroStats as $stat)
                        <li>
                            <img
                                src="{{ $img($stat['file']) }}"
                                alt="{{ $stat['alt'] }}"
                                width="55"
                                height="55"
                                @if ($loop->first) fetchpriority="high" @endif
                                decoding="async"
                            >
                            <h2>{{ $stat['title'] }}</h2>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        {{-- CTA banner --}}
        <section class="tpsusa-banner" aria-labelledby="tpsusa-banner-title">
            <div class="site-shell">
                <div class="tpsusa-banner__inner">
                    <div class="tpsusa-banner__copy">
                        <h2 id="tpsusa-banner-title">Don't Wait Until the Last Minute</h2>
                        <p>Tax deadlines approach quickly. Secure your peace of mind today with our expert tax preparation services.</p>
                    </div>
                    <a href="#tpsusa-enquire" class="tpsusa-btn">
                        <i class="fa-solid fa-calendar-check" aria-hidden="true"></i>
                        Schedule Your Free Consultation
                    </a>
                </div>
            </div>
        </section>

        {{-- Tax Preparation Outsourcing --}}
        <section class="tpsusa-section" aria-labelledby="tpsusa-services-title">
            <div class="site-shell">
                <div class="tpsusa-heading">
                    <h2 id="tpsusa-services-title">Tax Preparation Outsourcing</h2>
                    <p>Convenient way to file your taxes whether you file online, through a professional, or via our advanced outsourced services.</p>
                </div>
                <div class="tpsusa-service-grid" role="list">
                    @foreach ($services as $service)
                        <article class="tpsusa-service-card" role="listitem">
                            <img
                                src="{{ $img($service['file']) }}"
                                alt="{{ $service['alt'] }}"
                                width="75"
                                height="75"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $service['title'] }}</h3>
                            <p>{{ $service['text'] }}</p>
                            <ul>
                                @foreach ($service['items'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Why Choose --}}
        <section class="tpsusa-section tpsusa-why" aria-labelledby="tpsusa-why-title">
            <div class="site-shell">
                <div class="tpsusa-heading">
                    <h2 id="tpsusa-why-title">Why Choose Our Tax Return Preparation Services?</h2>
                </div>
                <div class="tpsusa-why__grid">
                    <figure class="tpsusa-why__media">
                        <img
                            src="{{ $img('why-choose-our-tax-return-preparation-services.webp') }}"
                            alt="Professional reviewing tax documents with a calculator and laptop"
                            width="518"
                            height="511"
                            loading="lazy"
                            decoding="async"
                        >
                    </figure>
                    <div class="tpsusa-why__copy">
                        <h3>Benefits of Professional Tax Preparation</h3>
                        <ul>
                            @foreach ($whyItems as $item)
                                <li>
                                    <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- How We Work --}}
        <section class="tpsusa-section tpsusa-how" aria-labelledby="tpsusa-how-title">
            <div class="site-shell">
                <div class="tpsusa-heading">
                    <h2 id="tpsusa-how-title">How We Work</h2>
                    <h3>What Can You Expect From Us</h3>
                </div>
                <ol class="tpsusa-steps">
                    @foreach ($steps as $step)
                        <li>
                            <span class="tpsusa-steps__icon" aria-hidden="true">
                                <i class="fa-solid {{ $step['icon'] }}"></i>
                            </span>
                            <span class="tpsusa-steps__num">{{ $step['num'] }}</span>
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                        </li>
                    @endforeach
                </ol>
                <div class="tpsusa-feature-grid" role="list">
                    @foreach ($features as $feature)
                        <article class="tpsusa-feature tpsusa-feature--{{ $feature['tone'] }}" role="listitem">
                            <span class="tpsusa-feature__icon" aria-hidden="true">
                                <i class="fa-solid {{ $feature['icon'] }}"></i>
                            </span>
                            <h3>{{ $feature['title'] }}</h3>
                            <p>{{ $feature['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="tpsusa-section tpsusa-software" aria-labelledby="tpsusa-software-title">
            <div class="site-shell">
                <h2 id="tpsusa-software-title">Software Expertise</h2>
                <div
                    class="tpsusa-logos"
                    x-data="{
                        index: 0,
                        perView: 5,
                        total: {{ count($tools) }},
                        get maxIndex() { return Math.max(0, this.total - this.perView); },
                        get pages() { return Array.from({ length: Math.max(1, this.maxIndex + 1) }, (_, i) => i); },
                        go(i) { this.index = Math.min(this.maxIndex, Math.max(0, i)); },
                        resize() {
                            this.perView = window.innerWidth < 640 ? 2 : (window.innerWidth < 900 ? 3 : (window.innerWidth < 1100 ? 4 : 5));
                            this.index = Math.min(this.index, this.maxIndex);
                        }
                    }"
                    x-init="resize(); window.addEventListener('resize', () => resize())"
                >
                    <div class="tpsusa-logos__viewport">
                        <div
                            class="tpsusa-logos__track"
                            :style="`transform: translateX(calc(-${index} * (100% / ${perView}))); --per-view: ${perView}`"
                        >
                            @foreach ($tools as $tool)
                                <div class="tpsusa-logos__item">
                                    <img
                                        src="{{ $img($tool['file']) }}"
                                        alt="{{ $tool['alt'] }}"
                                        width="160"
                                        height="56"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tpsusa-logos__dots" role="tablist" aria-label="Software expertise slides">
                        <template x-for="i in pages" :key="i">
                            <button
                                type="button"
                                class="tpsusa-logos__dot"
                                :class="{ 'is-active': index === i }"
                                :aria-selected="index === i ? 'true' : 'false'"
                                @click="go(i)"
                                :aria-label="'Show software logos slide ' + (i + 1)"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ + form --}}
        <section class="tpsusa-section tpsusa-section--faq" aria-labelledby="tpsusa-faq-heading">
            <div class="site-shell">
                <div class="tpsusa-heading">
                    <h2 id="tpsusa-faq-heading">Looking for Specific Tax Preparation Services?</h2>
                    <p>Your tax filing, your choice—do it yourself, get expert help, or let us handle everything.</p>
                </div>
                <div class="tpsusa-faq-layout">
                    <div>
                        <h3 id="tpsusa-faq-title">FAQ’s</h3>
                        <div class="tpsusa-faq">
                            @foreach ($faqs as $index => $faq)
                                <details class="tpsusa-faq__item" @if ($index === 0) open @endif>
                                    <summary>
                                        <span>{{ $faq['q'] }}</span>
                                        <span class="tpsusa-faq__toggle" aria-hidden="true">
                                            <i class="fa-solid fa-plus"></i>
                                            <i class="fa-solid fa-minus"></i>
                                        </span>
                                    </summary>
                                    <div class="tpsusa-faq__body">
                                        @foreach ($faq['paragraphs'] ?? [] as $paragraph)
                                            <p>{{ $paragraph }}</p>
                                        @endforeach
                                        @if (! empty($faq['lists']))
                                            <ul>
                                                @foreach ($faq['lists'] as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </details>
                            @endforeach
                        </div>
                    </div>

                    <aside class="tpsusa-form" id="tpsusa-enquire" aria-labelledby="tpsusa-form-title">
                        <div class="tpsusa-form__head">
                            <h2 id="tpsusa-form-title">Schedule A Call with Our Experts</h2>
                            <p>Explore our packages and enhance your finances with our team !</p>
                        </div>
                        <div class="tpsusa-form__body">
                            <livewire:forms.contact-form
                                form-name="tax-preparation-services-usa"
                                id-prefix="tpsusa"
                                :show-company="false"
                                :show-service="false"
                                message-placeholder="Tell us how we can help"
                                submit-label="Schedule Your Free Consultation"
                                layout="modal"
                                :message-rows="2"
                                thank-you-url="/thanks-you-for-tax-preparation/"
                            />
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </div>
@endsection
