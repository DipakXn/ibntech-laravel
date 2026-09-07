@php
    $filingStatusOptions = [
        'Single',
        'Married Filing Jointly',
        'Married Filing Separately',
        'Head of Household',
        'Qualifying widow(er)',
        'Other',
    ];

    $heroStats = [
        [
            'icon' => 'fa-check',
            'value' => '100,000+ Returns',
            'label' => 'Filed',
        ],
        [
            'icon' => 'fa-trophy',
            'value' => '3+ Years',
            'label' => 'Industry Experience',
        ],
        [
            'icon' => 'fa-star',
            'value' => '4.9/5',
            'label' => 'Customer Rating',
        ],
    ];

    $solutions = [
        [
            'icon' => 'fa-user-check',
            'tone' => 'violet',
            'title' => 'No Confusion, No Guesswork',
            'text' => 'Before you start, we give you a clear checklist of everything you need. Our step-by-step process keeps things simple, no complicated tax terminology, just transparency, and confidence.',
        ],
        [
            'icon' => 'fa-clock',
            'tone' => 'sky',
            'title' => 'Your Time, Your Terms',
            'text' => 'Tax filing shouldn’t feel hastened. Take your time, stop when you need to, and return whenever you’re ready. Your progress is saved securely for complete flexibility.',
        ],
        [
            'icon' => 'fa-chart-line',
            'tone' => 'navy',
            'title' => 'Maximum Refunds',
            'text' => 'Our real-time tax optimization ensures you claim every eligible deduction, whether you’re a freelancer, investor, student, or small business owner.',
        ],
    ];

    $addOns = [
        [
            'icon' => 'fa-book-open',
            'tone' => 'green',
            'title' => 'Bookkeeping Add-Ons',
            'text' => 'Keep your financial records organized and accurate throughout the year.',
            'href' => route('page.show', ['slug' => 'bookkeeping-services']),
        ],
        [
            'icon' => 'fa-calendar-check',
            'tone' => 'orange',
            'title' => 'Quarterly Estimated Tax Help',
            'text' => 'Stay compliant and avoid penalties with expert guidance on quarterly payments.',
            'href' => route('page.show', ['slug' => 'us-uk-tax-preparation-services']),
        ],
        [
            'icon' => 'fa-bell',
            'tone' => 'green',
            'title' => 'Tax Notice Support',
            'text' => 'If the IRS sends you a notice, we\'ll help you respond quickly and correctly.',
            'href' => '#tax1040-consult',
        ],
    ];

    $faqs = [
        [
            'q' => 'Can I file even if I’m self-employed?',
            'a' => 'Yes. We provide assistance in filing Form 1040 with Schedule C to allow freelancers and self-employed individuals to report their income and claim business deductions. We also help calculate the necessary Self-Employment Tax using Schedule SE.',
        ],
        [
            'q' => 'What documents do I need?',
            'a_html' => true,
            'a' => '<p>You’ll typically need:</p><ul><li>W-2 forms from employers</li><li>1099 forms for freelance or contract income</li><li>Records of deductions and credits (education, childcare, mortgage interest, etc.)</li><li>Social Security numbers for you and any dependents</li></ul><p>We provide a checklist before you start so you’re fully prepared.</p>',
        ],
        [
            'q' => 'How long does filing take?',
            'a' => 'Most users complete their return in under an hour, depending on complexity. You can start, pause, and resume anytime; your progress is saved securely.',
        ],
        [
            'q' => 'Is my data secure?',
            'a' => 'Yes. We use bank-level encryption and comply with IRS e-file security standards to protect your personal and financial information.',
        ],
        [
            'q' => 'What happens if I make a mistake?',
            'a' => 'Our system checks for common errors before submission. If the IRS flags an issue, our support team and tax specialists are here to help you resolve it quickly.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/1040-tax-filing.css'])
@endpush

@section('content')
    <div class="tax1040-page">
        {{-- Hero --}}
        <section class="tax1040-hero" aria-labelledby="tax1040-hero-title">
            <div class="site-shell tax1040-hero__inner">
                <div class="tax1040-hero__copy">
                    <h1 id="tax1040-hero-title">
                        <span class="tax1040-hero__lead">IRS 1040 Tax Filing Starts Here-</span>
                        Maximize Your Refund Today and Secure Every Dollar You Deserve
                    </h1>
                    <p class="tax1040-hero__lede">
                        Get Easy, Accurate IRS 1040 Filing with IBN Technologies
                    </p>
                    <div class="tax1040-hero__actions">
                        <a href="#tax1040-consult" class="tax1040-btn tax1040-btn--green">
                            File Your 1040 Now
                            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <div class="tax1040-hero__media">
                    <img
                        src="{{ asset('images/1040-tax-filing/IRS-Tax-Filing.webp') }}"
                        alt="IRS Tax Filing"
                        width="900"
                        height="879"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>

            <div class="site-shell tax1040-hero__stats-wrap">
                <div class="tax1040-hero__stats" role="list">
                    @foreach ($heroStats as $stat)
                        <div class="tax1040-hero__stat" role="listitem">
                            <span class="tax1040-hero__stat-icon fa-solid {{ $stat['icon'] }}" aria-hidden="true"></span>
                            <div>
                                <strong>{{ $stat['value'] }}</strong>
                                <span>{{ $stat['label'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Solutions --}}
        <section class="tax1040-section" aria-labelledby="tax1040-solutions-title">
            <div class="site-shell">
                <div class="tax1040-heading">
                    <h2 id="tax1040-solutions-title">
                        <span class="tax1040-accent">Clear 1040 Tax Filing Solutions</span>
                        That Actually Work
                    </h2>
                    <p>No Confusion, No Guesswork</p>
                </div>

                <div class="tax1040-card-grid">
                    @foreach ($solutions as $item)
                        <article class="tax1040-card">
                            <span class="tax1040-card__icon tax1040-card__icon--{{ $item['tone'] }}" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Process --}}
        <section class="tax1040-section tax1040-section--soft" aria-labelledby="tax1040-process-title">
            <div class="site-shell">
                <div class="tax1040-heading">
                    <h2 id="tax1040-process-title">
                        <span class="tax1040-accent">Simple 1040 Tax Filing</span> Process
                    </h2>
                    <p>Four easy steps to file your federal tax form 1040 with confidence.</p>
                </div>

                <figure class="tax1040-process">
                    <img
                        src="{{ asset('images/1040-tax-filing/Simple-1040-Tax-Filing-Process.webp') }}"
                        alt="Simple 1040 Tax Filing Process — four easy steps"
                        width="1724"
                        height="819"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="tax1040-mid-cta" aria-labelledby="tax1040-mid-cta-title">
            <div class="site-shell tax1040-mid-cta__inner">
                <h2 id="tax1040-mid-cta-title">Stop Filing Blindly. Start Filing Confidently</h2>
                <p>
                    Don't wait until the deadline. File your IRS Form 1040 online with IBN Technologies
                    and experience a smarter, faster, and stress-free tax season.
                </p>
                <a href="#tax1040-consult" class="tax1040-btn tax1040-btn--light">Start Filing Now</a>
            </div>
        </section>

        {{-- Add-ons --}}
        <section class="tax1040-section tax1040-section--cream" aria-labelledby="tax1040-addons-title">
            <div class="site-shell">
                <div class="tax1040-heading">
                    <h2 id="tax1040-addons-title">
                        <span class="tax1040-accent">Add-On Services</span> for Complete Tax Support
                    </h2>
                    <p>Enhance your best tax filing experience with our optional services designed to give you peace of mind:</p>
                </div>

                <div class="tax1040-card-grid">
                    @foreach ($addOns as $item)
                        <a href="{{ $item['href'] }}" class="tax1040-card tax1040-card--centered tax1040-card--link">
                            <span class="tax1040-card__icon tax1040-card__icon--{{ $item['tone'] }}" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- FAQ + consultation form --}}
        <section class="tax1040-section tax1040-section--soft" id="tax1040-consult" aria-labelledby="tax1040-faq-title">
            <div class="site-shell tax1040-split">
                <div class="tax1040-split__faq">
                    <div class="tax1040-heading tax1040-heading--left">
                        <h2 id="tax1040-faq-title">Frequently Asked Questions</h2>
                    </div>

                    <div class="content-faq-list tax1040-faq">
                        @foreach ($faqs as $index => $faq)
                            <details @if ($index === 0) open @endif>
                                <summary>
                                    <span>{{ $index + 1 }}. {{ $faq['q'] }}</span>
                                </summary>
                                <div>
                                    @if (! empty($faq['a_html']))
                                        {!! $faq['a'] !!}
                                    @else
                                        {{ $faq['a'] }}
                                    @endif
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <aside class="tax1040-consult-card" aria-labelledby="tax1040-consult-title">
                    <h3 id="tax1040-consult-title">Have Questions? Let's Talk Today.</h3>
                    <p>Your tax clarity starts now - reach out before deadlines hit.</p>

                    <livewire:forms.contact-form
                        form-name="1040-tax-filing"
                        id-prefix="tax1040"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$filingStatusOptions"
                        service-placeholder="Select Your Filing Status"
                        message-placeholder="Tell us about your tax situation or any questions you have"
                        submit-label="BOOK FREE CONSULTATION"
                        layout="home"
                        thank-you-url="/thanks-you-for-tax-preparation/"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
