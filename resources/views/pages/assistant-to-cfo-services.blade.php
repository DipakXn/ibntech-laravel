@php
    $img = fn (string $file): string => asset('images/assistant-to-cfo-services/'.$file);

    $heroServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $services = [
        [
            'title' => 'Accounting Health check',
            'text' => 'Ensure the integrity and compliance of your financial records with a detailed review and actionable insights.',
        ],
        [
            'title' => 'Cash Flow Management',
            'text' => 'Optimize liquidity with strategies that maintain healthy cash flow for operational and investment agility.',
        ],
        [
            'title' => 'Month End Closing',
            'text' => 'Streamline your financial closing process for timely, accurate insights into monthly business performance.',
        ],
        [
            'title' => 'Preparing Weekly Cash Forecast',
            'text' => 'Gain foresight into your financial needs with regular, precise cash flow forecasting.',
        ],
        [
            'title' => 'Preparing and setting up Budgets',
            'text' => 'Deliver comprehensive reports to key stakeholders, enhancing transparency and trust.',
        ],
        [
            'title' => 'Budget V/S Actual reporting and analysis',
            'text' => 'Make informed adjustments with analyses that highlight deviations and opportunities within your finances.',
        ],
    ];

    $benefits = [
        [
            'icon' => 'invoice-generation.png',
            'alt' => 'Invoice generation',
            'title' => 'Financial Process Optimization',
            'text' => 'Enhance efficiency from month-end closings to budget preparations, enabling faster turnaround times for financial reporting and decision-making that supports rapid growth.',
        ],
        [
            'icon' => 'liaison-with-tax-advisors.png',
            'alt' => 'Liaison with tax advisors',
            'title' => 'Focused Leadership',
            'text' => 'Empower your CFOs to focus on high-level strategies and business development while we handle the detailed financial legwork.',
        ],
        [
            'icon' => 'invoice-generation.png',
            'alt' => 'Invoice generation',
            'title' => 'Adapt to your growing business',
            'text' => 'Our services seamlessly scale to meet your changing needs without the burden of recruiting and training new staff.',
        ],
        [
            'icon' => 'automatic-invoice-processing-and-payment.png',
            'alt' => 'Automatic Invoice Processing and Payment',
            'title' => 'Deliver projections that earn stakeholder trust',
            'text' => 'Enhance decision-making with accurate projections that support business continuity and compliance with audit and review standards.',
        ],
        [
            'icon' => 'vendor-contracts.png',
            'alt' => 'Vendor Contracts',
            'title' => 'Automate workflows',
            'text' => 'Improve efficiency and mitigate risks with automated workflows and secure online document management.',
        ],
        [
            'icon' => 'vendor-contracts.png',
            'alt' => 'Vendor Contracts',
            'title' => 'Enhance Customer Experience',
            'text' => 'Minimize instances of fraud and default rates while providing exceptional service to your customers, ensuring their satisfaction.',
        ],
    ];

    $stats = [
        ['value' => '26 +', 'label' => 'Years of Success', 'tone' => 'light'],
        ['value' => '10000+', 'label' => 'Clients Served', 'tone' => 'navy'],
        ['value' => '50M', 'label' => 'Transaction Processed', 'tone' => 'light'],
        ['value' => '99.99 %', 'label' => 'Accuracy Achieved', 'tone' => 'navy'],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/assistant-to-cfo-services.css'])
@endpush

@section('content')
    <div class="atcfo-page">
        {{-- Hero --}}
        <section class="atcfo-hero" aria-labelledby="atcfo-hero-title">
            <div class="site-shell atcfo-hero__inner">
                <div class="atcfo-hero__copy">
                    <h1 id="atcfo-hero-title">Virtual CFO Service</h1>
                    <p class="atcfo-hero__lede">
                        Expand Your Financial Capabilities Without Expanding Your Team
                    </p>
                </div>

                <aside class="atcfo-hero__form" id="atcfo-hero-form" aria-labelledby="atcfo-hero-form-title">
                    <h2 id="atcfo-hero-form-title">Want to Improve Your Accounting ?</h2>
                    <p class="atcfo-hero__form-sub">Submit the Form to Get Started!</p>

                    <livewire:forms.contact-form
                        form-name="assistant-to-cfo-services-hero"
                        id-prefix="atcfo-hero"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$heroServiceOptions"
                        service-placeholder="Please Select Services"
                        message-placeholder="What kind of accounting solution are you looking for?"
                        submit-label="Submit"
                        layout="home"
                    />
                </aside>
            </div>
        </section>

        {{-- Intro --}}
        <section class="atcfo-section" aria-labelledby="atcfo-intro-title">
            <div class="site-shell atcfo-intro">
                <div class="atcfo-intro__media">
                    <img
                        src="{{ $img('business-owners.webp') }}"
                        alt="Business Owners"
                        width="650"
                        height="433"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>

                <div class="atcfo-intro__copy">
                    <p class="atcfo-eyebrow">IBN Tech</p>
                    <h2 id="atcfo-intro-title">Your Dedicated Financial Support Partner</h2>
                    <p>
                        For CFOs and financial leaders like you, effective financial management is not just about handling numbers it's about strategic analysis and decision-making. That's why IBN Tech offers Virtual CFO Services that serve as a dynamic extension of your financial team.
                        Our experienced team acts as an extension of your financial department, providing a wealth of expertise and hands-on support to help you navigate the complexities of modern financial management. By outsourcing transactional and repetitive finance and accounting tasks to our experienced team, we enable CFOs to redirect their focus and resources toward strategic, high-value activities that are essential for business advancement.
                    </p>
                </div>
            </div>
        </section>

        {{-- Services accordion --}}
        <section class="atcfo-section" aria-labelledby="atcfo-services-title">
            <div class="site-shell">
                <div class="atcfo-heading">
                    <h2 id="atcfo-services-title">CFO Virtual Services</h2>
                    <p class="atcfo-heading__lede">Seamless Integration with Your Financial Operations</p>
                </div>

                <div class="atcfo-services">
                    <div class="atcfo-services__accordion atcfo-faq">
                        @foreach ($services as $service)
                            <details>
                                <summary>
                                    <span>{{ $service['title'] }}</span>
                                </summary>
                                <div>{{ $service['text'] }}</div>
                            </details>
                        @endforeach
                    </div>

                    <div class="atcfo-services__media">
                        <img
                            src="{{ $img('outsourcing-accounting.webp') }}"
                            alt="Outsourcing Accounting"
                            width="550"
                            height="279"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Why your business needs --}}
        <section class="atcfo-section" aria-labelledby="atcfo-why-title">
            <div class="site-shell">
                <div class="atcfo-heading">
                    <h2 id="atcfo-why-title">Why Your Business Needs Virtual CFO Services</h2>
                    <h3>Realizing Efficiency and Strategic Growth</h3>
                    <p>
                        Partner with IBN Tech and witness how our virtual assistance can transform your financial management processes. We help you achieve:
                    </p>
                </div>

                <div class="atcfo-benefits" role="list">
                    @foreach ($benefits as $item)
                        <article class="atcfo-benefit" role="listitem">
                            <figure class="atcfo-benefit__icon">
                                <img
                                    src="{{ $img($item['icon']) }}"
                                    alt="{{ $item['alt'] }}"
                                    width="118"
                                    height="93"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </figure>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- CTA banner --}}
        <section class="atcfo-cta-banner" aria-labelledby="atcfo-cta-title">
            <div class="site-shell atcfo-cta-banner__inner">
                <p id="atcfo-cta-title">Your vendors will thank you, and so will your finance team</p>
                <a href="{{ route('page.show', ['slug' => 'free-consultation']) }}" class="atcfo-btn atcfo-btn--green">
                    Free Consultation
                </a>
            </div>
        </section>

        {{-- Stats --}}
        <section class="atcfo-section" aria-labelledby="atcfo-stats-title">
            <div class="site-shell">
                <div class="atcfo-heading">
                    <h2 id="atcfo-stats-title">Why IBN Tech is the</h2>
                    <p class="atcfo-heading__sub">Preferred Choice for CFO Support</p>
                </div>

                <div class="atcfo-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="atcfo-stat atcfo-stat--{{ $stat['tone'] }}" role="listitem">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
