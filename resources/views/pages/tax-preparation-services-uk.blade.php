@php
    $img = fn (string $file): string => asset('images/tax-preparation-services-uk/'.$file);
    $softwareImg = fn (string $file): string => asset('images/accounting-software-expertise-logos/'.$file);

    $tools = [
        ['src' => $img('Digita.webp'), 'alt' => 'Digita', 'blend' => true],
        ['src' => $img('IRIS.webp'), 'alt' => 'IRIS', 'blend' => true],
        ['src' => $softwareImg('Netsuite.webp'), 'alt' => 'NetSuite'],
        ['src' => $softwareImg('Quickbooks.webp'), 'alt' => 'QuickBooks'],
        ['src' => $softwareImg('Sage.webp'), 'alt' => 'Sage'],
        ['src' => $img('Taxcalc.webp'), 'alt' => 'TaxCalc', 'blend' => true],
        ['src' => $img('Zoho-Books.webp'), 'alt' => 'Zoho Books', 'blend' => true],
    ];

    $businessSolutions = [
        [
            'icon' => 'fa-file-lines',
            'title' => 'Corporate Tax Preparation & Filing',
            'text' => 'Complete CT600 preparation and submission. Expert handling of corporation tax returns with full HMRC compliance.',
            'items' => ['CT600 Forms', 'Tax Computations', 'HMRC Submissions', 'Deadline Management'],
        ],
        [
            'icon' => 'fa-table',
            'title' => 'VAT Return Filing & Compliance',
            'text' => 'Accurate VAT calculations and timely submissions. Full support for Making Tax Digital requirements.',
            'items' => ['VAT Returns', 'MTD Compliance', 'VAT Planning', 'HMRC Liaison'],
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Tax Planning & Strategy',
            'text' => 'Proactive tax planning to minimize liabilities and optimize your business structure for tax efficiency.',
            'items' => ['Tax Optimization', 'Strategic Planning', 'Liability Reduction', 'Growth Planning'],
        ],
    ];

    $individualSolutions = [
        [
            'icon' => 'fa-users',
            'title' => 'Self-Assessment Tax Returns',
            'text' => 'Complete self-assessment preparation for self-employed professionals, landlords, and high earners.',
            'items' => ['SA100 Forms', 'Income Tax', 'Capital Gains', 'Rental Income'],
        ],
        [
            'icon' => 'fa-user-shield',
            'title' => 'Personal Tax Advisory',
            'text' => 'Personalized tax planning strategies to minimize your personal tax burden legally and efficiently.',
            'items' => ['Tax Planning', 'Pension Advice', 'Investment Tax', 'Inheritance Tax'],
        ],
        [
            'icon' => 'fa-clock',
            'title' => 'Digital Tax Filing',
            'text' => 'Convenient online tax return preparation and submission with real-time progress tracking.',
            'items' => ['Online Filing', 'Digital Records', 'Mobile Access', 'Real-time Updates'],
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'HMRC Representation',
            'text' => 'Professional representation during HMRC enquiries and investigations with full support throughout.',
            'items' => ['HMRC Enquiries', 'Investigation Support', 'Appeals Process', 'Compliance Reviews'],
        ],
    ];

    $whyChoose = [
        [
            'icon' => 'fa-table',
            'title' => 'Advanced Tax Technology',
            'text' => 'We use advanced tax accounting software to simplify procedures, minimize mistakes, and deliver faster, more accurate results.',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Dedicated Tax Specialists',
            'text' => 'We assign our expert team and tax advisors to your account, guaranteeing consistent, personalized service and a thorough understanding of your needs.',
        ],
        [
            'icon' => 'fa-clock',
            'title' => 'Real-Time Tax Support',
            'text' => 'Access live reporting, instant updates, and real-time communication with your tax advisor. Stay informed about your tax position throughout the year.',
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Seamless Service Transition',
            'text' => 'Our onboarding process ensures zero disruption to your operations. We handle the complete transition from your current tax advisor smoothly.',
        ],
        [
            'icon' => 'fa-user-tie',
            'title' => 'Dedicated Tax Specialists',
            'text' => 'We assign our expert team and tax advisors to your account, guaranteeing consistent, personalized service and a thorough understanding of your needs.',
        ],
    ];

    $ctaPerks = [
        'Free initial consultation',
        'No setup fees',
        'Transparent pricing',
    ];

    $faqs = [
        [
            'q' => '1. Why should I outsource tax outsourcing services?',
            'a' => 'Outsourcing tax services improves efficiency, reduces costs, ensures compliance, and saves time by leveraging expert professionals and advanced tools.',
        ],
        [
            'q' => '2. How to start outsourcing my tax preparation services?',
            'a' => 'Simply email us at sales@ibntech.com. Our team will guide you through the onboarding process and answer any questions.',
            'email' => 'sales@ibntech.com',
        ],
        [
            'q' => '3. Can I outsource specific tasks such as payroll, accounts reconciliation, and financial reporting?',
            'a' => 'Yes, you can choose to outsource specific tasks or opt for full-service accounting based on your needs.',
        ],
        [
            'q' => '4. How do I communicate with my remote team?',
            'a' => 'You can easily connect via email, phone, video calls, or secure platforms like Microsoft Teams.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/tax-preparation-services-uk.css'])
@endpush

@section('content')
    <div class="tpsuk-page">
        {{-- Hero --}}
        <section
            class="tpsuk-hero"
            aria-labelledby="tpsuk-hero-title"
            style="--tpsuk-hero-bg: url('{{ $img('UK-Tax-Preparation-hero-4.webp') }}')"
        >
            <div class="site-shell tpsuk-hero__inner">
                <h1 id="tpsuk-hero-title">
                    <span class="tpsuk-accent">Tax Preparation Services UK</span> – Trusted Accuracy, Timely Compliance
                </h1>
                <p class="tpsuk-hero__lede">
                    Professional tax preparation services for UK businesses and individuals. Our chartered accountants ensure accurate filings, minimize tax liabilities, and keep you compliant with all HMRC regulations.
                </p>
                <a href="#tpsuk-enquire" class="tpsuk-btn">Book a Free Consultation</a>
            </div>
        </section>

        {{-- Tools We Work With --}}
        <section class="tpsuk-tools" aria-labelledby="tpsuk-tools-title">
            <div class="site-shell">
                <h2 id="tpsuk-tools-title">Tools We Work With</h2>
                <div
                    class="tpsuk-logos"
                    x-data="{
                        index: 0,
                        perView: 6,
                        total: {{ count($tools) }},
                        get maxIndex() { return Math.max(0, this.total - this.perView); },
                        get pages() { return Array.from({ length: Math.max(1, this.maxIndex + 1) }, (_, i) => i); },
                        prev() { this.index = Math.max(0, this.index - 1); },
                        next() { this.index = Math.min(this.maxIndex, this.index + 1); },
                        go(i) { this.index = Math.min(this.maxIndex, Math.max(0, i)); },
                        resize() {
                            this.perView = window.innerWidth < 640 ? 2 : (window.innerWidth < 900 ? 3 : (window.innerWidth < 1100 ? 4 : 6));
                            this.index = Math.min(this.index, this.maxIndex);
                        }
                    }"
                    x-init="resize(); window.addEventListener('resize', () => resize())"
                >
                    <button type="button" class="tpsuk-logos__nav" @click="prev()" :disabled="index === 0" aria-label="Previous logos">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="tpsuk-logos__viewport">
                        <div
                            class="tpsuk-logos__track"
                            :style="`transform: translateX(calc(-${index} * (100% / ${perView}))); --per-view: ${perView}`"
                        >
                            @foreach ($tools as $tool)
                                <div class="tpsuk-logos__item">
                                    <img
                                        src="{{ $tool['src'] }}"
                                        alt="{{ $tool['alt'] }}"
                                        width="140"
                                        height="56"
                                        loading="lazy"
                                        decoding="async"
                                        class="{{ ! empty($tool['blend']) ? 'is-dark' : '' }}"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="button" class="tpsuk-logos__nav" @click="next()" :disabled="index >= maxIndex" aria-label="Next logos">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>

                    <div class="tpsuk-logos__dots" aria-hidden="true">
                        <template x-for="i in pages" :key="i">
                            <button
                                type="button"
                                class="tpsuk-logos__dot"
                                :class="{ 'is-active': index === i }"
                                @click="go(i)"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        {{-- Comprehensive UK Tax Services --}}
        <section class="tpsuk-section" aria-labelledby="tpsuk-services-title">
            <div class="site-shell">
                <div class="tpsuk-heading">
                    <h2 id="tpsuk-services-title">Comprehensive UK Tax Services</h2>
                    <p>From corporate tax compliance to personal self-assessments, our chartered accountants provide expert tax services customized to your specific needs.</p>
                </div>

                <h3 class="tpsuk-subhead">Business Tax Solutions</h3>
                <div class="tpsuk-card-grid tpsuk-card-grid--3" role="list">
                    @foreach ($businessSolutions as $item)
                        <article class="tpsuk-card tpsuk-card--green" role="listitem">
                            <span class="tpsuk-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                            <ul>
                                @foreach ($item['items'] as $point)
                                    <li>
                                        <i class="fa-regular fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $point }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>

                <h3 class="tpsuk-subhead">Individual Tax Preparation</h3>
                <div class="tpsuk-card-grid tpsuk-card-grid--4" role="list">
                    @foreach ($individualSolutions as $item)
                        <article class="tpsuk-card tpsuk-card--navy" role="listitem">
                            <span class="tpsuk-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                            <ul>
                                @foreach ($item['items'] as $point)
                                    <li>
                                        <i class="fa-regular fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $point }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Quote --}}
        <section class="tpsuk-quote" aria-label="UK tax insight">
            <div class="site-shell tpsuk-quote__inner">
                <span class="tpsuk-quote__mark" aria-hidden="true">
                    <i class="fa-solid fa-quote-left"></i>
                </span>
                <blockquote>
                    <p>Stay ahead of the curve - understanding tax changes today means smarter financial decisions tomorrow</p>
                    <cite>- IBN Tech's UK Tax Expert Team</cite>
                </blockquote>
            </div>
        </section>

        {{-- Why UK Businesses Choose IBN Tech --}}
        <section class="tpsuk-section" aria-labelledby="tpsuk-why-title">
            <div class="site-shell">
                <div class="tpsuk-heading">
                    <h2 id="tpsuk-why-title">Why UK Businesses Choose <span class="tpsuk-accent">IBN Tech</span></h2>
                    <p>Over 26 years of expertise in UK tax law, combined with modern technology and personalized service, makes us the trusted choice for tax preparation.</p>
                </div>
                <div class="tpsuk-why-grid" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="tpsuk-why-card" role="listitem">
                            <span class="tpsuk-why-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Ready CTA --}}
        <section class="tpsuk-cta" aria-labelledby="tpsuk-cta-title">
            <div class="site-shell tpsuk-cta__inner">
                <h2 id="tpsuk-cta-title">Ready to Experience the Difference?</h2>
                <p>Join over 1,000 satisfied clients who trust us with their UK tax compliance. Get started with a free consultation to discuss your specific requirements.</p>
                <ul class="tpsuk-cta__perks">
                    @foreach ($ctaPerks as $perk)
                        <li>
                            <i class="fa-regular fa-circle-check" aria-hidden="true"></i>
                            <span>{{ $perk }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="#tpsuk-enquire" class="tpsuk-btn">Book Your Free Consultation</a>
            </div>
        </section>

        {{-- How It Works --}}
        <section class="tpsuk-section tpsuk-how" aria-labelledby="tpsuk-how-title">
            <div class="site-shell">
                <div class="tpsuk-heading">
                    <h2 id="tpsuk-how-title">How It Works</h2>
                </div>
                <div class="tpsuk-how__media">
                    <img
                        src="{{ $img('How-It-Works-1.webp') }}"
                        alt="How tax preparation with IBN Tech works: efficient onboarding, transparent communication, and accurate financial management"
                        width="800"
                        height="687"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- FAQ + form --}}
        <section class="tpsuk-section tpsuk-section--faq" aria-labelledby="tpsuk-faq-title">
            <div class="site-shell tpsuk-faq-layout">
                <div>
                    <h2 id="tpsuk-faq-title">Frequently Asked Questions</h2>
                    <div class="tpsuk-faq">
                        @foreach ($faqs as $index => $faq)
                            <details class="tpsuk-faq__item" @if ($index === 0) open @endif>
                                <summary>
                                    <span class="tpsuk-faq__toggle" aria-hidden="true">
                                        <i class="fa-solid fa-plus"></i>
                                        <i class="fa-solid fa-minus"></i>
                                    </span>
                                    <span>{{ $faq['q'] }}</span>
                                </summary>
                                <div class="tpsuk-faq__body">
                                    <p>
                                        @if (! empty($faq['email']))
                                            Simply email us at
                                            <a href="mailto:{{ $faq['email'] }}">{{ $faq['email'] }}</a>.
                                            Our team will guide you through the onboarding process and answer any questions.
                                        @else
                                            {{ $faq['a'] }}
                                        @endif
                                    </p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <aside class="tpsuk-form" id="tpsuk-enquire" aria-labelledby="tpsuk-form-title">
                    <div class="tpsuk-form__head">
                        <h2 id="tpsuk-form-title">Get Your Taxes Done Right – UK Experts at Your Service!</h2>
                        <p>Professional, accurate, and hassle-free tax filing for individuals and businesses.</p>
                    </div>
                    <div class="tpsuk-form__body">
                        <livewire:forms.contact-form
                            form-name="tax-preparation-services-uk"
                            id-prefix="tpsuk"
                            :show-company="false"
                            :show-service="false"
                            message-placeholder="Have Questions or Need Help with Your Taxes?"
                            submit-label="BOOK FREE CONSULTATION"
                            layout="modal"
                            :message-rows="2"
                            thank-you-url="/thanks-you-for-tax-preparation/"
                        />
                    </div>
                </aside>
            </div>
        </section>
    </div>
@endsection
