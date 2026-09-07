@php
    $img = fn (string $file): string => asset('images/electronic-funds-transfer/'.$file);

    $paymentOptions = [
        [
            'file' => 'virtual-credit-card-payments.webp',
            'alt' => 'Virtual Credit Card Payments',
            'title' => 'Virtual Credit Card Payments',
        ],
        [
            'file' => 'digital-checks.webp',
            'alt' => 'Digital Checks',
            'title' => 'Digital Checks',
        ],
        [
            'file' => 'ach-payment-processing-1.webp',
            'alt' => 'ACH Payment Processing',
            'title' => 'ACH Payment Processing',
        ],
    ];

    $benefits = [
        [
            'file' => 'save-on-every-transaction.webp',
            'alt' => 'Electronic Funds Transfer for small business',
            'title' => 'Save on Every Transaction',
        ],
        [
            'file' => 'link-invoicing-to-payments.webp',
            'alt' => 'Link invoicing to payments',
            'title' => 'Link invoicing to payments',
        ],
        [
            'file' => 'speed-up-payments-to-vendors.webp',
            'alt' => 'Speed up payments to vendors',
            'title' => 'Speed up payments to vendors',
        ],
        [
            'file' => 'mitigate-exposure-to-fraud.webp',
            'alt' => 'Mitigate exposure to fraud',
            'title' => 'Mitigate exposure to fraud',
        ],
        [
            'file' => 'shorten-payment-cycles.webp',
            'alt' => 'Shorten payment cycles in EFT',
            'title' => 'Shorten payment cycles',
        ],
        [
            'file' => 'capture-early-payment-discounts.webp',
            'alt' => 'Capture early payment discounts',
            'title' => 'Capture early payment discounts',
        ],
        [
            'file' => 'cut-issuance-costs.webp',
            'alt' => 'Cut issuance costs',
            'title' => 'Cut issuance costs',
        ],
        [
            'file' => 'reduce-payment-processing-time.webp',
            'alt' => 'Reduce payment processing time',
            'title' => 'Reduce payment processing time',
        ],
    ];

    $caseStudies = $caseStudies ?? app(\App\Repositories\CaseStudyRepository::class)->getPublishedByCategorySlug(
        'finance-and-accounting-case-studies',
        limit: 3
    );
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/electronic-funds-transfer.css'])
@endpush

@section('content')
    <div class="eft-page">
        {{-- Hero --}}
        <section class="eft-hero" aria-labelledby="eft-hero-title">
            <div class="site-shell eft-hero__inner">
                <h1 id="eft-hero-title">
                    Automate Your AP from Process to Payment – Pay Smarter, Grow Faster
                </h1>
                <p class="eft-hero__lede">
                    On-Time Vendor Payments, Save on Costs, and Boost Revenue with Electronic Fund Transfers
                </p>
                <a href="#" class="eft-btn" data-contact-modal-trigger>
                    Schedule a Free Demo
                </a>
            </div>
        </section>

        {{-- Automated Payment Processing --}}
        <section class="eft-section" aria-labelledby="eft-auto-title">
            <div class="site-shell eft-split">
                <div class="eft-split__copy">
                    <h2 id="eft-auto-title">Automated Payment Processing</h2>
                    <p>
                        Are you finding that your AP automation falls short when it comes to completing payments to vendors? It's time to transition to electronic funds transfer for a seamless solution.
                    </p>
                    <p>
                        Cloud-based payment automation streamlines invoices and ensures prompt, accurate payments—all within a unified process. Our solution integrates smoothly into your systems, providing full control over cash outflows and vendor relationships through an automated AP workflow
                    </p>
                </div>
                <div class="eft-split__media">
                    <img
                        src="{{ $img('automated-payment-processing.webp') }}"
                        alt="Automated Payment Processing"
                        width="650"
                        height="600"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Mid-page CTA --}}
        <section class="eft-cta-band" aria-labelledby="eft-cta-title">
            <div class="site-shell eft-cta-band__inner">
                <h2 id="eft-cta-title">With Our Payment Automation Solution</h2>
                <p>Ensure Timely Vendor Payments and Maximize Cost Savings</p>
                <a href="#" class="eft-btn" data-contact-modal-trigger>
                    Book Your Free Demo
                </a>
            </div>
        </section>

        {{-- Why Choose --}}
        <section class="eft-section" aria-labelledby="eft-why-title">
            <div class="site-shell eft-split eft-split--media-first">
                <div class="eft-split__media">
                    <img
                        src="{{ $img('why-choose-our-payment-automation-service.webp') }}"
                        alt="Why Choose Our Payment Automation Service"
                        width="650"
                        height="600"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="eft-split__copy">
                    <h2 id="eft-why-title">Why Choose Our Payment Automation Service?</h2>
                    <p>
                        Most AP automation stops at invoice processing. Our solution extends to payment processing, enabling vendor payments via Virtual Credit Card, Enhanced ACH, and Digital Check.
                    </p>
                    <p>
                        You save on transaction costs and can issue payments directly from your accounting system without changing your ERP. Our service streamlines the entire AP process from invoice receipt to final payment, ensuring full control over cash flow and vendor relationships
                    </p>
                </div>
            </div>
        </section>

        {{-- Payment options --}}
        <section class="eft-section eft-section--tight" aria-labelledby="eft-options-title">
            <div class="site-shell">
                <div class="eft-heading">
                    <h2 id="eft-options-title">Save with Multiple Payment Options</h2>
                </div>
                <div class="eft-pay-grid" role="list">
                    @foreach ($paymentOptions as $option)
                        <article class="eft-pay-card" role="listitem">
                            <img
                                src="{{ $img($option['file']) }}"
                                alt="{{ $option['alt'] }}"
                                width="50"
                                height="50"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $option['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Benefits --}}
        <section class="eft-benefits" aria-labelledby="eft-benefits-title">
            <div class="site-shell eft-benefits__inner">
                <div class="eft-benefits__intro">
                    <h2 id="eft-benefits-title">Benefits of Our Payment Automation</h2>
                    <img
                        src="{{ $img('benefits-of-our-payment-automation.webp') }}"
                        alt="Benefits of Our Payment Automation"
                        width="650"
                        height="600"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="eft-benefits__grid" role="list">
                    @foreach ($benefits as $benefit)
                        <article class="eft-benefit-card" role="listitem">
                            <img
                                src="{{ $img($benefit['file']) }}"
                                alt="{{ $benefit['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $benefit['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Timely payments --}}
        <section class="eft-section eft-timely" aria-labelledby="eft-timely-title">
            <div class="site-shell eft-timely__inner">
                <h2 id="eft-timely-title">How do we ensure timely payments to your vendors?</h2>
                <p>
                    Integrated payment automation bridges the gap from invoice processing to vendor payments. With options for ACH, checks, and credit card payments, you can automate the entire process based on your vendors' preferred remittance methods
                </p>
                <a href="#" class="eft-btn" data-contact-modal-trigger>
                    Get a Demo
                </a>
            </div>
        </section>

        {{-- Make Profit --}}
        <section class="eft-section eft-section--tight" aria-labelledby="eft-profit-title">
            <div class="site-shell eft-split">
                <div class="eft-split__copy">
                    <h2 id="eft-profit-title">Make Profit While Paying Bills</h2>
                    <p>
                        Payment automation offers a chance to generate revenue using virtual credit cards. This technology turns routine expenses into profit-making activities. With no manpower costs and vendor-covered processing fees, our system saves you money while managing payments. This approach streamlines operations, reduces errors, boosts efficiency, and generates additional revenue
                    </p>
                </div>
                <div class="eft-split__media">
                    <img
                        src="{{ $img('make-profit-while-paying-bills.webp') }}"
                        alt="Make Profit While Paying Bills"
                        width="650"
                        height="600"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- AP cycle --}}
        <section class="eft-section eft-cycle" aria-labelledby="eft-cycle-title">
            <div class="site-shell">
                <div class="eft-heading eft-heading--wide">
                    <h2 id="eft-cycle-title">
                        Complete Your AP Cycle for Maximum Savings and Efficiency
                    </h2>
                    <p>
                        Payment automation completes your AP cycle, maximizing savings and revenue with timely, error-free vendor payments. Virtual payments are faster, cost-effective, and secure. A unified platform for invoices and payments provides seamless connectivity and full control, transforming AP operations
                    </p>
                </div>
                <div class="eft-cycle__row">
                    <div class="eft-cycle__media">
                        <img
                            src="{{ $img('complete-your-ap-cycle-for-maximum-savings-and-efficiency.webp') }}"
                            alt="Complete Your AP Cycle for Maximum Savings and Efficiency"
                            width="650"
                            height="600"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <a href="#" class="eft-btn" data-contact-modal-trigger>
                        Get a Demo
                    </a>
                </div>
            </div>
        </section>

        {{-- Case studies --}}
        @if ($caseStudies->isNotEmpty())
            <section class="eft-section eft-cases" aria-labelledby="eft-cases-title">
                <div class="site-shell">
                    <div class="eft-heading eft-heading--wide">
                        <h2 id="eft-cases-title">
                            Real Results: How Our Clients Achieved Timely Vendor Payments and Cost Savings
                        </h2>
                    </div>
                    <div class="eft-case-grid" role="list">
                        @foreach ($caseStudies as $case)
                            <article class="eft-case-card" role="listitem">
                                @php
                                    $caseImageUrl = $case->featuredImageUrl();
                                    if (! $caseImageUrl && $case->featured_image) {
                                        if (file_exists(public_path('images/electronic-funds-transfer/' . $case->featured_image))) {
                                            $caseImageUrl = asset('images/electronic-funds-transfer/' . $case->featured_image);
                                        } elseif (file_exists(public_path('images/bookkeeping-services/' . $case->featured_image))) {
                                            $caseImageUrl = asset('images/bookkeeping-services/' . $case->featured_image);
                                        } elseif (file_exists(public_path($case->featured_image))) {
                                            $caseImageUrl = asset($case->featured_image);
                                        }
                                    }
                                @endphp
                                @if ($caseImageUrl)
                                    <div class="eft-case-card__media">
                                        <img
                                            src="{{ $caseImageUrl }}"
                                            alt="{{ $case->title }}"
                                            width="640"
                                            height="400"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    </div>
                                @endif
                                <div class="eft-case-card__body">
                                    <h3>{{ $case->title }}</h3>
                                    <a
                                        href="{{ route('case-studies.show', $case->slug) }}"
                                        class="eft-case-card__link"
                                    >
                                        Know More
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div class="eft-cases__cta">
                        <a href="{{ route('case-studies.index') }}" class="eft-btn">
                            View All
                        </a>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
