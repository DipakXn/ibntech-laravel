@php
    $img = fn (string $file): string => asset('images/invoice-process-automation/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Accounting Services',
        'Payroll Processing',
        'Accounts Payable and Receivable',
        'Tax Preparation Support',
        'Financial Reporting',
        'Controller Services',
    ];

    $benefits = [
        'Gain Full Visibility and Control',
        'Effortless Approvals',
        'Speed Up Invoice Processing Cycle Times',
        'Seamless ERP System Integration',
        'Reduce Manual Data Entry & Errors',
        'Cut Transaction Costs by 50-80%',
        'ROI in Less Than 12 Months',
        'User-Friendly, No-Code Framework',
    ];

    $capabilitiesLeft = [
        'Acquires Invoices from Multiple Sources',
        'Accepts all file types including digital files',
        'Automatic 2- or 3-way Invoice Matching',
        'Extracts and Validates Data on the Invoices',
        'Machine Learning (ML) Learns from User Actions.',
        'Notifies and Routes Invoices for Approval',
        'Validates Information About the Invoice with AP Databases',
    ];

    $capabilitiesRight = [
        'Trigger Alerts',
        'Classifies and Sorts Invoices by Vendor',
        'Transforms Data Using AI and Multiple OCR Engines',
        'Integrates with RPA and BPM Platforms',
        'Enters Data and Invoice Images in ERP and Other Document Management or ECM Platforms',
        'Cascading Classification and Data Validation Matching',
    ];

    $caseStudies = $caseStudies ?? app(\App\Repositories\CaseStudyRepository::class)->getPublishedByCategorySlug(
        limit: 3
    );
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/invoice-process-automation.css'])
@endpush

@section('content')
    <div class="inva-page">
        {{-- Hero --}}
        <section class="inva-hero" aria-labelledby="inva-hero-title">
            <div class="site-shell inva-hero__inner">
                <div class="inva-hero__media">
                    <img
                        src="{{ $img('invoice-process-automation-banner.webp') }}"
                        alt="Invoice process automation"
                        width="1000"
                        height="1000"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
                <div class="inva-hero__copy">
                    <h1 id="inva-hero-title">Automate Your AP Process with Intelligent Solutions</h1>
                    <p class="inva-hero__lede">Handle AP with Ease! Ask Us How!</p>
                    <a href="#inva-form" class="inva-btn">Get Started</a>
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="inva-section" aria-labelledby="inva-intro-title">
            <div class="site-shell inva-split">
                <div class="inva-split__copy">
                    <h2 id="inva-intro-title">
                        Leave Manual Process Behind<br>
                        Transform Your Workflow with Invoice Processing Automation!
                    </h2>
                    <p>
                        Managing Accounts Payable (AP) monthly can be daunting, but smart automation simplifies the process. Manual invoice processing leads to high AP costs, delays, errors, dissatisfied suppliers, inefficient cash management, and inaccurate financial statements. Why not streamline your workload and avoid these issues with our intelligent AP automation solution?
                    </p>
                    <p>
                        Our Invoice Processing Automation solution is an easy-to-use cloud or on-premises AP automation platform designed for both complex and simple workflows. It accelerates invoice data availability through end-to-end processing and data validation.
                    </p>
                </div>
                <div class="inva-split__media">
                    <img
                        src="{{ $img('leave-manual-process-behind-transform-your-workflow-with-invoice-processing-automation.webp') }}"
                        alt="Leave Manual Process Behind Transform Your Workflow with Invoice Processing Automation"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Mid-page CTA --}}
        <section class="inva-cta-band" aria-labelledby="inva-cta-title">
            <div class="site-shell inva-cta-band__inner">
                <h2 id="inva-cta-title">
                    Are you looking for Invoice Processing
                    <span>Automation</span>?
                </h2>
                <a href="#inva-form" class="inva-btn">Request a free product tour</a>
            </div>
        </section>

        {{-- Benefits + form --}}
        <section class="inva-section inva-benefits" aria-labelledby="inva-benefits-title">
            <div class="site-shell inva-benefits__inner">
                <div class="inva-benefits__copy">
                    <h2 id="inva-benefits-title">Benefits of AP Automation Solutions</h2>
                    <ul class="inva-check-list">
                        @foreach ($benefits as $benefit)
                            <li>{{ $benefit }}</li>
                        @endforeach
                    </ul>
                </div>

                <aside class="inva-form" id="inva-form" aria-labelledby="inva-form-title">
                    <div class="inva-form__head">
                        <h2 id="inva-form-title">Book a Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team!</p>
                    </div>
                    <div class="inva-form__body">
                        <livewire:forms.contact-form
                            form-name="invoice-process-automation"
                            id-prefix="inva"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="How can we help you?"
                            submit-label="Submit"
                            layout="home"
                            :message-rows="4"
                        />
                    </div>
                </aside>
            </div>
        </section>

        {{-- Capabilities --}}
        <section class="inva-section inva-caps" aria-labelledby="inva-caps-title">
            <div class="site-shell inva-caps__inner">
                <div class="inva-caps__media">
                    <img
                        src="{{ $img('everything-you-can-do-with-our-ap-automation-solution.webp') }}"
                        alt="Everything You Can Do with Our AP Automation Solution"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                    <a href="#inva-form" class="inva-btn">Get Started</a>
                </div>
                <div class="inva-caps__copy">
                    <h2 id="inva-caps-title">Everything You Can Do with Our AP Automation Solution</h2>
                    <div class="inva-caps__grid">
                        <ul class="inva-check-list inva-check-list--round">
                            @foreach ($capabilitiesLeft as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                        <ul class="inva-check-list inva-check-list--round">
                            @foreach ($capabilitiesRight as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Process diagram --}}
        <section class="inva-section inva-diagram" aria-labelledby="inva-diagram-title">
            <div class="site-shell">
                <div class="inva-heading">
                    <h2 id="inva-diagram-title">Explanatory Diagram for Automated Invoice Processing System</h2>
                </div>
                <img
                    class="inva-diagram__img"
                    src="{{ $img('explanatory-diagram-for-automated-invoice-processing-system.webp') }}"
                    alt="Explanatory diagram for automated invoice processing system"
                    width="2050"
                    height="1080"
                    loading="lazy"
                    decoding="async"
                >
            </div>
        </section>

        {{-- Beyond invoice processing --}}
        <section class="inva-beyond" aria-labelledby="inva-beyond-title">
            <div class="site-shell">
                <div class="inva-heading inva-heading--wide">
                    <h2 id="inva-beyond-title">
                        But That’s Not All – Let’s Go Beyond Just
                        <span>Invoice Processing</span>
                    </h2>
                    <p>
                        We understand that AP automation should extend beyond invoice processing. That’s why our solution integrates seamlessly with a payments automation service to handle vendor payments directly after your invoices are processed. This added convenience ensures a smooth, end-to-end workflow
                    </p>
                </div>
                <div class="inva-beyond__row">
                    <div class="inva-beyond__media">
                        <img
                            src="{{ $img('but-thats-not-all-lets-go-beyond-just-invoice-processing.webp') }}"
                            alt="Let’s go beyond just invoice processing"
                            width="1000"
                            height="1000"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <div class="inva-beyond__cta">
                        <h3>Interested in learning more?</h3>
                        <a href="#inva-form" class="inva-btn">Schedule a short call with us!</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Success stories --}}
        @if ($caseStudies->isNotEmpty())
            <section class="inva-section inva-cases" aria-labelledby="inva-cases-title">
                <div class="site-shell">
                    <div class="inva-heading inva-heading--wide">
                        <h2 id="inva-cases-title">
                            Real Results<br>
                            Success Stories of AP Automation in Action
                        </h2>
                    </div>
                    <div class="inva-case-grid" role="list">
                        @foreach ($caseStudies as $case)
                            <article class="inva-case-card" role="listitem">
                                <a
                                    href="{{ route('case-studies.show', $case->slug) }}"
                                    class="inva-case-card__link"
                                >
                                    @php
                                        $caseImageUrl = $case->featuredImageUrl();
                                        if (! $caseImageUrl && $case->featured_image) {
                                            if (file_exists(public_path('images/invoice-process-automation/' . $case->featured_image))) {
                                                $caseImageUrl = asset('images/invoice-process-automation/' . $case->featured_image);
                                            } elseif (file_exists(public_path('images/aws-partner/' . $case->featured_image))) {
                                                $caseImageUrl = asset('images/aws-partner/' . $case->featured_image);
                                            } elseif (file_exists(public_path('images/cloud-consulting-and-migration-services/' . $case->featured_image))) {
                                                $caseImageUrl = asset('images/cloud-consulting-and-migration-services/' . $case->featured_image);
                                            } elseif (file_exists(public_path($case->featured_image))) {
                                                $caseImageUrl = asset($case->featured_image);
                                            }
                                        }
                                    @endphp
                                    @if ($caseImageUrl)
                                        <img
                                            src="{{ $caseImageUrl }}"
                                            alt="{{ $case->title }}"
                                            width="640"
                                            height="400"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    @endif
                                    <div class="inva-case-card__body">
                                        <h3>{{ $case->title }}</h3>
                                        <span>Read More &raquo;</span>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                    <div class="inva-cases__cta">
                        <a href="{{ route('case-studies.index') }}" class="inva-btn">View All</a>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
