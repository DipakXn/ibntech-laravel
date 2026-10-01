@php
    $img = fn (string $file): string => asset('images/kpo-services/'.$file);

    $stats = [
        ['value' => '27+', 'label' => 'Years of experience'],
        ['value' => '150+', 'label' => 'Experienced Employees'],
        ['value' => '1500+', 'label' => 'Global clients'],
        ['value' => '100%', 'label' => 'Data Security'],
    ];

    $coreServices = [
        [
            'title' => 'Fund Services',
            'image' => 'fund-middle-and-back-office-service.webp',
            'alt' => 'Fund Middle and Back Office Service',
            'width' => 1080,
            'height' => 800,
            'slug' => 'hedge-fund-services',
            'bullets' => [
                'Hedge Fund & Fund of Funds Back & Middle Office Services',
                'Quant Research Services',
                'Fund Administration Services',
            ],
        ],
        [
            'title' => 'Finance & Accounting',
            'image' => 'finance-and-accounting-2.webp',
            'alt' => 'finance and accounting',
            'width' => 778,
            'height' => 618,
            'slug' => 'finance-and-accounting-services',
            'bullets' => [
                'Accounting & Book Keeping Outsourcing Services',
                'Tax Preparation, Payroll Processing',
                'A/R Processing',
            ],
        ],
        [
            'title' => 'BPO / KPO',
            'image' => 'cfo-services-2.webp',
            'alt' => 'cfo services',
            'width' => 778,
            'height' => 618,
            'slug' => 'bpo-services',
            'bullets' => [
                'Data Capturing & Reporting',
                'Data Processing, Insurance Claim Management',
                'Card Processing',
                'Tech Support Services',
            ],
        ],
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

    $hedgeColumns = [
        [
            'title' => 'Fund Administration Outsourcing',
            'text' => 'IBN is an independent global service provider who offers a full suite of comprehensive administration outsourcing services .',
        ],
        [
            'title' => 'Back Office Services',
            'text' => 'IBN Back Office Outsourcing Services are renowned to Fund of Hedge Funds & Hedge Funds, Funds Administrator.',
        ],
        [
            'title' => 'Risk & Quantitative Analysis',
            'text' => 'IBN Risk & Quantitative Analysis services can assist Fund Managers by applying advanced statistical technique .',
        ],
        [
            'title' => 'Middle office services',
            'text' => 'IBN Middle office services covers full range of operational process which helps fund managers or other investments.',
        ],
    ];

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
        'Other',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/kpo-services.css'])
@endpush

@section('content')
    <div class="kpo-page">
        {{-- Hero --}}
        <section class="kpo-hero" aria-labelledby="kpo-hero-title">
            <div class="site-shell kpo-hero__inner">
                <p class="kpo-hero__tagline">Streamline Finances | Save Big | Focus on Growth</p>
                <h1 id="kpo-hero-title">KPO Services</h1>
                <div class="kpo-hero__actions">
                    <a href="#accounting-enquire" class="kpo-btn kpo-btn--cream">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Stats --}}
        <section class="kpo-stats" aria-label="Company statistics">
            <div class="site-shell">
                <div class="kpo-stats__inner">
                    @foreach ($stats as $stat)
                        <div class="kpo-stats__item">
                            <strong>{{ $stat['value'] }}</strong>
                            <span>{{ $stat['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Core Services --}}
        <section class="kpo-section kpo-core" aria-labelledby="kpo-core-title">
            <div class="site-shell">
                <h2 id="kpo-core-title" class="kpo-heading">Core Services</h2>

                <div class="kpo-core__grid" role="list">
                    @foreach ($coreServices as $service)
                        <article class="kpo-core-card" role="listitem">
                            <a
                                href="{{ route('page.show', ['slug' => $service['slug']]) }}"
                                class="kpo-core-card__media"
                                tabindex="-1"
                            >
                                <img
                                    src="{{ $img($service['image']) }}"
                                    alt="{{ $service['alt'] }}"
                                    width="{{ $service['width'] }}"
                                    height="{{ $service['height'] }}"
                                    @if ($loop->first) fetchpriority="high" @else loading="lazy" @endif
                                    decoding="async"
                                >
                            </a>
                            <div class="kpo-core-card__body">
                                <h3>
                                    <a href="{{ route('page.show', ['slug' => $service['slug']]) }}">
                                        {{ $service['title'] }}
                                    </a>
                                </h3>
                                <ul>
                                    @foreach ($service['bullets'] as $bullet)
                                        <li>{{ $bullet }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Finance And Accounting --}}
        <section class="kpo-section kpo-finance" aria-labelledby="kpo-finance-title">
            <div class="site-shell">
                <div class="kpo-heading kpo-heading--center">
                    <h2 id="kpo-finance-title">Finance And Accounting</h2>
                    <p>Why You Should Use Finance And Accounting Services</p>
                </div>

                <div class="kpo-finance__grid" role="list">
                    @foreach ($financeServices as $service)
                        <article class="kpo-finance-card" role="listitem">
                            <a
                                href="{{ route('page.show', ['slug' => $service['slug']]) }}"
                                class="kpo-finance-card__icon"
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
                            <div class="kpo-finance-card__body">
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

        {{-- Hedge Fund Back Office Services --}}
        <section class="kpo-section kpo-hedge" aria-labelledby="kpo-hedge-title">
            <div class="site-shell">
                <h2 id="kpo-hedge-title" class="kpo-heading">Hedge Fund Back Office Services</h2>

                <div class="kpo-hedge__grid">
                    @foreach ($hedgeColumns as $column)
                        <article class="kpo-hedge-col">
                            <h3>{{ $column['title'] }}</h3>
                            <p>{{ $column['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="kpo-section kpo-consult"
            id="accounting-enquire"
            aria-labelledby="kpo-consult-title"
        >
            <div class="site-shell kpo-consult__inner">
                <aside class="kpo-consult__card" aria-labelledby="kpo-consult-title">
                    <div class="kpo-consult__header">
                        <h2 id="kpo-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="kpo-consult__body">
                        <livewire:forms.contact-form
                            form-name="kpo-services"
                            id-prefix="kpo"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="What services are you interested in?"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="kpo-consult__media">
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
