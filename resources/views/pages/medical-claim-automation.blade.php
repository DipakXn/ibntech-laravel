@php
    $img = fn (string $file): string => asset('images/medical-claim-automation/'.$file);
    $contactService = 'Medical Claim Automation';

    $benefits = [
        [
            'title' => 'Reduced manual data entry and processing',
            'icon' => 'reduced-manual-data-entry-and-processing.webp',
        ],
        [
            'title' => 'Easy customization to meet business needs',
            'icon' => 'easy-customization-to-meet-business-needs.webp',
        ],
        [
            'title' => 'Accelerated claim processing',
            'icon' => 'accelerated-claim-processing.webp',
        ],
        [
            'title' => 'Capability to handle high volumes of claims',
            'icon' => 'capability-to-handle-high-volumes-of-claims.webp',
        ],
        [
            'title' => 'Enhanced accuracy with reduced errors',
            'icon' => 'enhanced-accuracy-with-reduced-errors.webp',
        ],
        [
            'title' => 'Swift implementation',
            'icon' => 'swift-implementation.webp',
        ],
        [
            'title' => 'Significant cost savings',
            'icon' => 'cost-savings.webp',
        ],
    ];

    $featureCards = [
        [
            'title' => 'Diverse Input Sources',
            'text' => 'Supports scanning, fax, remote storage, and formats like PDFs',
            'tone' => 'navy',
        ],
        [
            'title' => 'Automatic Job Registration',
            'text' => 'Monitors folders and emails to auto-register jobs',
            'tone' => 'green',
        ],
        [
            'title' => 'Multiple Claim Types',
            'text' => 'Processes CMS 1500, UB04, ADA dental, Advantage, Crossovers, and other claims',
            'tone' => 'gray',
        ],
    ];

    $audiences = [
        [
            'title' => 'Dental Practitioners',
            'text' => 'Dental practices submit ADA Dental Claim Forms for insurance reimbursement, providing clear records of services and costs for smooth, transparent communication with insurers',
            'image' => 'dental-practitioners.webp',
        ],
        [
            'title' => 'Dental Insurance Companies',
            'text' => 'Dental insurers assess ADA Dental Claim Forms to verify eligibility, coverage, and reimbursement in line with policy terms',
            'image' => 'dental-insurance-companies.webp',
        ],
        [
            'title' => 'BPO Companies',
            'text' => 'BPOs handle medical claims for healthcare providers and insurers, using advanced software to manage large volumes accurately, reducing internal workload and minimizing errors',
            'image' => 'bpo-companies.webp',
        ],
        [
            'title' => 'Healthcare Organizations',
            'text' => 'Hospitals, clinics, insurers, and government agencies rely on automation or BPOs to process high volumes of CMS 1500, UB04, and UB-92 claims efficiently, ensuring timely reimbursements and coverage',
            'image' => 'healthcare-organizations.webp',
        ],
    ];
    $audienceCount = count($audiences);

    $claimForms = [
        [
            'title' => 'CMS 1500',
            'text' => 'Used for billing patient services, this form is essential for healthcare providers to receive reimbursement from insurers, including Medicare and Medicaid.',
        ],
        [
            'title' => 'HCFA',
            'text' => 'The former name for the CMS 1500 form, now processed efficiently by automation solutions.',
        ],
        [
            'title' => 'UB04 (CMS-1450)',
            'text' => 'A standard form for billing inpatient and outpatient services to Medicare, Medicaid, and private insurers. Automation captures data from all 81 fields and table parts.',
        ],
        [
            'title' => 'UB-92',
            'text' => 'Replaced by the UB04 in 2007, but automation solutions still support data capture for both UB92 and UB04 forms.',
        ],
        [
            'title' => 'ADA Dental Claim Form',
            'text' => 'This standardized dental claim form enables automated data extraction, reducing errors, speeding up processing, and improving reimbursement accuracy.',
        ],
    ];
    $formCount = count($claimForms);

    $caseStudies = $caseStudies ?? app(\App\Repositories\CaseStudyRepository::class)->getPublishedByCategorySlug(
        limit: 3
    );
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/medical-claim-automation.css'])
@endpush

@section('content')
    <div class="mca-page">
        <section class="mca-hero" aria-labelledby="mca-hero-title">
            <div class="site-shell mca-hero__inner">
                <div class="mca-hero__media">
                    <img
                        src="{{ $img('the-benefits-of-medical-claim-automation.webp') }}"
                        alt="The benefits of Medical Claim Automation"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
                <div class="mca-hero__copy">
                    <h1 id="mca-hero-title">Transform Medical Claims Processing with Advanced Automation</h1>
                    <p class="mca-hero__lede">Process Medical Claim Forms - CMS 1500 (HCFA), CMS-1450 (UB04), and ADA Dental</p>
                    <a
                        href="#"
                        class="mca-btn"
                        data-contact-modal-trigger
                        data-contact-service="{{ $contactService }}"
                    >Schedule a Free Demo</a>
                </div>
            </div>
        </section>

        <section class="mca-section" aria-labelledby="mca-extract-title">
            <div class="site-shell mca-split">
                <div class="mca-split__copy">
                    <h2 id="mca-extract-title">
                        Extract and Auto-Validate Every Data Field With<br>
                        Medical Claim Automation Solutions
                    </h2>
                    <p>
                        Medical Claim Automation Solutions streamline healthcare operations by capturing and validating data from millions of forms. They support various scan types, authenticate data, and export to back-end systems in HIPAA-compliant 837, XML, JSON, and other formats. Our solution uses machine learning, advanced data capture, and AI-enabled workflow automation. Its no-code architecture allows quick configuration without custom coding, supporting intelligent processing for various healthcare claim forms.
                    </p>
                </div>
                <div class="mca-split__media">
                    <img
                        src="{{ $img('extract-and-auto-validate-every-data-field-with.webp') }}"
                        alt="Extract and Auto-Validate Every Data Field With"
                        width="650"
                        height="650"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        <section class="mca-benefits" aria-labelledby="mca-benefits-title">
            <div class="site-shell mca-benefits__inner">
                <div class="mca-benefits__media">
                    <h2 id="mca-benefits-title">The benefits of Medical Claim Automation</h2>
                    <img
                        src="{{ $img('the-benefits-of-medical-claim-automation.webp') }}"
                        alt="The benefits of Medical Claim Automation"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="mca-benefits__grid">
                    @foreach ($benefits as $benefit)
                        <article class="mca-benefit-card">
                            <img
                                src="{{ $img($benefit['icon']) }}"
                                alt=""
                                width="75"
                                height="75"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $benefit['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="mca-mid-cta" aria-labelledby="mca-mid-cta-title">
            <div class="site-shell mca-mid-cta__inner">
                <h2 id="mca-mid-cta-title">Automate Medical Claim Forms</h2>
                <p>Effortlessly handle data from all fields and tables, including black and white and drop-out scans</p>
                <a
                    href="#"
                    class="mca-btn"
                    data-contact-modal-trigger
                    data-contact-service="{{ $contactService }}"
                >Book a Demo Now</a>
            </div>
        </section>

        <section class="mca-section mca-features" aria-labelledby="mca-features-title">
            <div class="site-shell">
                <div class="mca-features__layout">
                    <div class="mca-features__copy">
                        <h2 id="mca-features-title">Key features Facilitating Medical Claims Processing</h2>
                        <p><strong>Complete Audit Trail:</strong> Logs all administrative and security actions in claims processing system.</p>
                        <p><strong>Advanced Reporting:</strong> Tracks workload, spots bottlenecks, analyzes performance, and compares efficiency in real-time.</p>
                        <img
                            src="{{ $img('untitled-1-1.png') }}"
                            alt="Medical claims processing specialist reviewing documents"
                            width="700"
                            height="768"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <div class="mca-features__stack">
                        @foreach ($featureCards as $card)
                            <article class="mca-feature-card mca-feature-card--{{ $card['tone'] }}">
                                <h3>{{ $card['title'] }}</h3>
                                <p>{{ $card['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="mca-cta-banner" aria-labelledby="mca-banner-title">
            <div class="site-shell mca-cta-banner__inner">
                <h2 id="mca-banner-title">Handle Medical Insurance Claims Electronically - Know How!</h2>
                <p>Our automation software enables healthcare providers and BPOs to process both electronic and paper claims, capturing data from forms like CMS 1500, UB04, UB92, and ADA Dental.</p>
                <p>Request a demo to see how it simplifies data capture and processing.</p>
                <a
                    href="#"
                    class="mca-btn"
                    data-contact-modal-trigger
                    data-contact-service="{{ $contactService }}"
                >Book Your Free Demo</a>
            </div>
        </section>

        <section
            class="mca-section mca-audiences"
            aria-labelledby="mca-audiences-title"
            x-data="{
                index: 0,
                total: {{ $audienceCount }},
                prev() { this.index = (this.index - 1 + this.total) % this.total; },
                next() { this.index = (this.index + 1) % this.total; },
            }"
        >
            <div class="site-shell">
                <div class="mca-heading">
                    <h2 id="mca-audiences-title">Who Benefits from Advanced Medical and Dental Claim Processing?</h2>
                </div>
                <div class="mca-audiences__slider">
                    <button type="button" class="mca-audiences__arrow" @click="prev()" aria-label="Previous audience">
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path></svg>
                    </button>
                    <div class="mca-audiences__viewport" aria-live="polite">
                        @foreach ($audiences as $i => $audience)
                            <article
                                class="mca-audiences__slide"
                                x-show="index === {{ $i }}"
                                x-cloak
                            >
                                <img
                                    src="{{ $img($audience['image']) }}"
                                    alt="{{ $audience['title'] }}"
                                    width="180"
                                    height="180"
                                    loading="lazy"
                                    decoding="async"
                                >
                                <h3>{{ $audience['title'] }}</h3>
                                <p>{{ $audience['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                    <button type="button" class="mca-audiences__arrow" @click="next()" aria-label="Next audience">
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M696 533C708 521 713 504 713 487 713 471 708 454 696 446L400 146C388 133 375 125 354 125 338 125 325 129 313 142 300 154 292 171 292 187 292 204 296 221 308 233L563 492 304 771C292 783 288 800 288 817 288 833 296 850 308 863 321 871 338 875 354 875 371 875 388 867 400 854L696 533Z"></path></svg>
                    </button>
                </div>
                <div class="mca-audiences__dots" role="tablist" aria-label="Audience slides">
                    @foreach ($audiences as $i => $audience)
                        <button
                            type="button"
                            :class="{ 'is-active': index === {{ $i }} }"
                            :aria-current="index === {{ $i }} ? 'true' : 'false'"
                            @click="index = {{ $i }}"
                            aria-label="Show {{ $audience['title'] }}"
                        ></button>
                    @endforeach
                </div>
            </div>
        </section>

        <section
            class="mca-forms"
            aria-labelledby="mca-forms-title"
            x-data="{ active: 0 }"
        >
            <div class="site-shell">
                <div class="mca-heading">
                    <h2 id="mca-forms-title">Types of Medical Claim Forms We Process</h2>
                </div>
                <div class="mca-forms__layout">
                    <div class="mca-forms__nav" role="tablist" aria-label="Medical claim forms">
                        @foreach ($claimForms as $i => $form)
                            <button
                                type="button"
                                class="mca-forms__tab{{ $i === 0 ? ' is-active' : '' }}"
                                id="mca-form-tab-{{ $i }}"
                                role="tab"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                aria-controls="mca-form-panel"
                                @click="active = {{ $i }}"
                                @keydown.arrow-down.prevent="active = {{ ($i + 1) % $formCount }}"
                                @keydown.arrow-up.prevent="active = {{ ($i - 1 + $formCount) % $formCount }}"
                                @keydown.arrow-right.prevent="active = {{ ($i + 1) % $formCount }}"
                                @keydown.arrow-left.prevent="active = {{ ($i - 1 + $formCount) % $formCount }}"
                            >
                                <span>{{ $form['title'] }}</span>
                                <svg aria-hidden="true" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" d="M9.3 5.3a1 1 0 0 1 1.4 0l6 6a1 1 0 0 1 0 1.4l-6 6a1 1 0 1 1-1.4-1.4L14.58 12 9.3 6.7a1 1 0 0 1 0-1.4z"/>
                                </svg>
                            </button>
                        @endforeach
                    </div>
                    <div
                        class="mca-forms__panel"
                        id="mca-form-panel"
                        role="tabpanel"
                        :aria-labelledby="'mca-form-tab-' + active"
                    >
                        @foreach ($claimForms as $i => $form)
                            <div x-show="active === {{ $i }}" x-cloak>
                                <h3>{{ $form['title'] }}</h3>
                                <p>{{ $form['text'] }}</p>
                                <a
                                    href="#"
                                    class="mca-btn mca-btn--navy"
                                    data-contact-modal-trigger
                                    data-contact-service="{{ $contactService }}"
                                >Schedule a call with our Expert Now</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="mca-section mca-streamline" aria-labelledby="mca-streamline-title">
            <div class="site-shell mca-split">
                <div class="mca-split__media">
                    <img
                        src="{{ $img('streamline-your-healthcare-operations-with-medical-claims-automation.webp') }}"
                        alt="Streamline Your Healthcare Operations with Medical Claims Automation"
                        width="650"
                        height="600"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="mca-split__copy">
                    <h2 id="mca-streamline-title">
                        Streamline Your Healthcare Operations with<br>
                        Medical Claims Automation
                    </h2>
                    <p>Automating medical claims reduces costs, improves efficiency, minimizes errors, and enhances the customer experience — allowing you to navigate healthcare complexities and focus on quality care.</p>
                    <p>Streamline your workflow with our claims automation solutions.</p>
                    <a
                        href="#"
                        class="mca-btn"
                        data-contact-modal-trigger
                        data-contact-service="{{ $contactService }}"
                    >Request a Free Demo</a>
                </div>
            </div>
        </section>

        @if ($caseStudies->isNotEmpty())
            <section class="mca-section mca-cases" aria-labelledby="mca-cases-title">
                <div class="site-shell">
                    <div class="mca-heading">
                        <h2 id="mca-cases-title">Medical Claims Automation in Action</h2>
                    </div>
                    <div class="mca-case-grid" role="list">
                        @foreach ($caseStudies as $case)
                            <article class="mca-case-card" role="listitem">
                                @php
                                    $caseImageUrl = $case->featuredImageUrl();
                                    if (! $caseImageUrl && $case->featured_image) {
                                        if (file_exists(public_path('images/medical-claim-automation/' . $case->featured_image))) {
                                            $caseImageUrl = asset('images/medical-claim-automation/' . $case->featured_image);
                                        } elseif (file_exists(public_path('images/vapt-case-studies/' . $case->featured_image))) {
                                            $caseImageUrl = asset('images/vapt-case-studies/' . $case->featured_image);
                                        } elseif (file_exists(public_path('images/invoice-process-automation/' . $case->featured_image))) {
                                            $caseImageUrl = asset('images/invoice-process-automation/' . $case->featured_image);
                                        } elseif (file_exists(public_path($case->featured_image))) {
                                            $caseImageUrl = asset($case->featured_image);
                                        }
                                    }
                                @endphp
                                @if ($caseImageUrl)
                                    <div class="mca-case-card__media">
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
                                <div class="mca-case-card__body">
                                    <h3>{{ $case->title }}</h3>
                                    <a href="{{ route('case-studies.show', $case->slug) }}">Read More</a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div class="mca-cases__cta">
                        <a href="{{ route('case-studies.index') }}" class="mca-btn">View All</a>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
