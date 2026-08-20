@php
    $img = fn (string $file): string => asset('images/bookkeeping-for-small-business/'.$file);

    $bookkeeperServices = [
        'Manage your finances and keep track of transactions accurately and efficiently.',
        'Provides real-time financial information about cash flow, bills, receipts, taxes, payroll, and more through meticulous record-keeping and account analysis.',
        'Create budgets for future planning and identifies opportunities for cost reduction or increased profitability.',
        'Help to run day-to-day operations smoothly.',
    ];

    $ourServices = [
        [
            'title' => 'Bank & Credit Card Activity:',
            'text' => "Processing daily bank & credit card activities feed via accounting software's ; keeping track on AP and AR processes.",
        ],
        [
            'title' => 'Expense Claims Processing:',
            'text' => 'Employee expenses are made easy, with meticulous attention to the record, verification, and reimbursement. Trust in the numbers and maintain your financial accuracy.',
        ],
        [
            'title' => 'Invoice Processing:',
            'text' => 'Efficiently generate a sales invoice as per service level agreement and customers purchase order, skillfully audit and reconcile it, and promptly deliver it to your valued customer via email.',
        ],
        [
            'title' => 'AP/AR reconciliation:',
            'text' => 'Match the invoices, payments, and credits on the AP and AR ledgers to ensure that they correspond with each other. Accurate and efficient tracking and management of financial transactions, ensuring transparency and integrity of your financial records.',
        ],
        [
            'title' => 'Accounting & Data Administration:',
            'text' => "Determine your business's financial status and profitability through accurate Accounting and Data Administration.",
        ],
        [
            'title' => 'Cash flow forecasting:',
            'text' => 'Strong AR follow-up, strong cash flow game! You can easily whip up some weekly and monthly cash flow projections.',
            'bold' => false,
        ],
        [
            'title' => 'Month End Closing/ Monthly bookkeeping services:',
            'text' => 'As a part of our all-inclusive month-end closing process, we examine the accounts on your balance sheet, open bills, and invoices, categories for income and spending, and provide tailored reports to manage your business.',
        ],
    ];

    $andMore = [
        'GAAP Compliance following',
        'Payroll processing',
        'Budget V/S Actual reporting and analysis',
        'MIS and other Management Reporting',
        'Accounting Advisory Services',
    ];

    $committedTo = [
        'Customized and tailored solutions with 24+ years of expertise.',
        'Delivering high-quality work on time.',
        'Services are designed to comply with global accounting regulations.',
        'Strive to minimize the occurrence of defects in our work to ensure optimal results.',
    ];

    $whyOutsource = [
        'Reduce Costs (up to 50%)',
        'Improve Processes And Productivity',
        'Customized services designed to meet the specific requirements of your business.',
        'Reduce the time, energy, and cost of maintaining financial records.',
        'Offshoring Bookkeeping services are available.',
        'Trustworthy and dependable handling of data security.',
        'Exceptional service and support that exceed expectations.',
    ];

    $industries = [
        [
            'label' => 'Bookkeeping Service for Restaurants',
            'slug' => 'restaurants-bookkeeping-services',
        ],
        [
            'label' => 'Bookkeeping For Small Business',
            'slug' => 'bookkeeping-for-small-business',
        ],
        [
            'label' => 'Bookkeeping For CPA Firms',
            'slug' => 'cpa-outsourcing',
        ],
        [
            'label' => 'Bookkeeping for Non Profit',
            'slug' => null,
            'href' => route('page.show', ['slug' => 'restaurants-bookkeeping-services']).'#',
        ],
        [
            'label' => 'Bookkeeping For Large Organisation',
            'slug' => 'bookkeeping-for-large-organisation',
        ],
    ];

    $areas = [
        [
            'label' => 'Bookkeeping For U.S.A',
            'slug' => 'bookkeeping-services-usa',
        ],
        [
            'label' => 'Bookkeeping For U.K',
            'slug' => 'bookeeping-for-uk',
        ],
    ];

    $checkSvg = '<svg aria-hidden="true" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path></svg>';
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/bookkeeping-for-small-business.css'])
@endpush

@section('content')
    <div class="bksb-page">
        {{-- Hero --}}
        <section class="bksb-hero" aria-labelledby="bksb-hero-title">
            <div class="site-shell bksb-hero__inner">
                <div class="bksb-hero__copy">
                    <h1 id="bksb-hero-title">Bookkeeping Services for Small Businesses</h1>
                    <div class="bksb-hero__actions">
                        <a
                            href="{{ route('page.show', ['slug' => 'contact-us']) }}"
                            class="bksb-btn bksb-btn--cream"
                        >
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="bksb-hero__media">
                    <img
                        src="{{ $img('bookkeeping-services-for-small-businesses.webp') }}"
                        alt="Bookkeeping Services for Small Businesses"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="bksb-section" aria-labelledby="bksb-intro-title">
            <div class="site-shell bksb-intro">
                <div class="bksb-intro__media">
                    <img
                        src="{{ $img('bookkeeping-services-1.webp') }}"
                        alt="Bookkeeping Services for Small Businesses"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="bksb-intro__copy">
                    <h2 id="bksb-intro-title">Bookkeeping Services for Small Businesses</h2>
                    <h3>A trusted partner for hundreds of small businesses</h3>
                    <p>
                        Tired of drowning in an accounting sea of receipts and invoices? Let our expert bookkeepers take the wheel and steer you out
                    </p>
                    <p>
                        IBN Tech is a reliable provider of outsourced bookkeeping services for small businesses across the USA and the UK. Managing clients' books is a crucial responsibility for these firms, demanding significant time, effort, and expertise. But with IBN's assistance, this task becomes a breeze - our ultimate offering for all your bookkeeping and outsourced accounting needs! Our team of skilled bookkeepers possesses a wealth of industry knowledge and a thorough understanding of accounting laws, supported by accounting software expertise, enabling us to be a trusted advisor for all aspects of your business.
                    </p>
                </div>
            </div>
        </section>

        {{-- What services --}}
        <section class="bksb-band" aria-labelledby="bksb-provide-title">
            <div class="site-shell bksb-band__inner">
                <h2 id="bksb-provide-title">What services can a bookkeeper provide for you?</h2>
                <ul class="bksb-band__list">
                    @foreach ($bookkeeperServices as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </section>

        {{-- Our services --}}
        <section class="bksb-section" aria-labelledby="bksb-services-title">
            <div class="site-shell bksb-services">
                <div class="bksb-heading bksb-heading--center">
                    <h2 id="bksb-services-title">Our services</h2>
                    <p>
                        We have specialized outsourced bookkeeping services for small businesses which you can avail for your aspiring venture to make things easy-going!!
                    </p>
                </div>

                <div class="bksb-services__body">
                    @foreach ($ourServices as $service)
                        <p>
                            @if (($service['bold'] ?? true))
                                <strong>{{ $service['title'] }}</strong>
                            @else
                                {{ $service['title'] }}
                            @endif
                            {{ ' '.$service['text'] }}
                        </p>
                    @endforeach

                    <p class="bksb-services__more-label"><strong>AND MORE:</strong></p>
                    <ul class="bksb-services__more">
                        @foreach ($andMore as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>

                    <p class="bksb-services__committed-label"><strong>Committed to</strong></p>
                    <ul class="bksb-bullet-list">
                        @foreach ($committedTo as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <p class="bksb-services__closing">Customer-centric approach</p>
                </div>
            </div>
        </section>

        {{-- Why outsource --}}
        <section class="bksb-section bksb-section--mint" aria-labelledby="bksb-why-title">
            <div class="site-shell bksb-why">
                <div class="bksb-why__media">
                    <img
                        src="{{ $img('why-outsource.webp') }}"
                        alt="Why outsource your bookkeeping to IBN Tech"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="bksb-why__copy">
                    <h2 id="bksb-why-title">Why outsource your bookkeeping to IBN Tech?</h2>
                    <p>
                        IBN Tech is well known for providing the best accounting and bookkeeping services for small businesses to various businesses including accounting and CPA firms in the US and the UK. Our services offer numerous advantages that can significantly benefit your business. Some of the notable benefits to our clients are:
                    </p>
                    <ul class="bksb-bullet-list">
                        @foreach ($whyOutsource as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        {{-- Industries & Areas --}}
        <section class="bksb-serve" aria-labelledby="bksb-industries-title">
            <div class="site-shell bksb-serve__inner">
                <div class="bksb-serve__copy">
                    <div class="bksb-serve__cols">
                        <div class="bksb-serve__col">
                            <h2 id="bksb-industries-title">Industries We Serve</h2>
                            <ul class="bksb-check-list">
                                @foreach ($industries as $item)
                                    <li>
                                        <a
                                            href="{{ $item['href'] ?? route('page.show', ['slug' => $item['slug']]) }}"
                                        >
                                            {!! $checkSvg !!}
                                            <span>{{ $item['label'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="bksb-serve__col">
                            <h2 id="bksb-areas-title">Areas We Serve</h2>
                            <ul class="bksb-check-list">
                                @foreach ($areas as $item)
                                    <li>
                                        <a href="{{ route('page.show', ['slug' => $item['slug']]) }}">
                                            {!! $checkSvg !!}
                                            <span>{{ $item['label'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bksb-serve__media">
                    <img
                        src="{{ $img('signs-you-need-offshore-bookkeeping.webp') }}"
                        alt="Signs You Need Offshore Bookkeeping"
                        width="650"
                        height="650"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Contact form (WordPress “Let’s Talk Business”) --}}
        <section
            class="bksb-section bksb-consult"
            id="contact-us"
            aria-labelledby="bksb-consult-title"
        >
            <div class="site-shell bksb-consult__inner">
                <aside class="bksb-consult__card" aria-labelledby="bksb-consult-title">
                    <div class="bksb-consult__header">
                        <h2 id="bksb-consult-title">Let’s Talk Business</h2>
                        <p>Book a quick strategy call with our experts to discuss your business needs.</p>
                    </div>
                    <div class="bksb-consult__body">
                        <livewire:forms.contact-form
                            form-name="bookkeeping-for-small-business"
                            id-prefix="bksb"
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
