@php
    $img = fn (string $file): string => asset('images/functional-testing/'.$file);

    $offerings = [
        [
            'title' => 'System Integration Testing: ',
            'text' => 'Ensure seamless interaction between your different software modules.',
        ],
        [
            'title' => 'Regression Testing:',
            'text' => ' Confirm that recent modifications have not impacted existing functionalities negatively.',
        ],
        [
            'title' => 'User Acceptance Testing: ',
            'text' => 'Validate software readiness from an end-user perspective, ensuring its suitability for intended use.',
        ],
        [
            'title' => 'Functional Test Automation:',
            'text' => ' Leverage advanced ',
            'linkLabel' => 'automation',
            'linkSlug' => 'test-automation',
            'after' => ' techniques to enhance efficiency and reduce human error in functional testing.',
        ],
    ];

    $deliverables = [
        [
            'title' => 'Requirement Analysis:',
            'text' => ' We start by gaining an in-depth understanding of your software\'s requirements.',
        ],
        [
            'title' => 'Test Planning:',
            'text' => ' We develop a comprehensive testing plan to cover all functionalities of your software.',
        ],
        [
            'title' => 'Test Case Development:',
            'text' => ' Our experts design precise test cases to ensure thorough testing.',
        ],
        [
            'title' => 'Test Execution:',
            'text' => ' We meticulously execute the test cases, ensuring all features are functioning as intended.',
        ],
        [
            'title' => 'Defect Tracking and Reporting:',
            'text' => ' We diligently track and report any defects discovered during testing.',
        ],
        [
            'title' => 'Regression Testing:',
            'text' => ' We ensure all modifications have not affected existing functionalities adversely.',
        ],
    ];

    $benefits = [
        [
            'title' => 'Elevated Product Quality: ',
            'text' => 'Our meticulous functional testing techniques uncover hidden defects, enhancing the overall quality and reliability of your product.',
        ],
        [
            'title' => 'Quick Time-to-Market:',
            'text' => ' By identifying and rectifying issues early in the development cycle, we facilitate faster product releases.',
        ],
        [
            'title' => 'Enhanced Customer Satisfaction:',
            'text' => ' A well-tested product ensures a seamless user experience, boosting customer satisfaction, and loyalty.',
        ],
    ];

    $processSteps = [
        [
            'title' => 'Comprehensive Requirement Analysis:',
            'text' => ' We begin with a detailed understanding of your software\'s requirements.',
        ],
        [
            'title' => 'Test Planning:',
            'text' => ' We develop an exhaustive testing plan tailored to your software.',
        ],
        [
            'title' => 'Test Case Development:',
            'text' => ' Our experts craft precise test cases designed to cover every function of your software.',
        ],
        [
            'title' => 'Test Execution and Defect Tracking :',
            'text' => ' We execute the test cases and track any defects diligently.',
        ],
        [
            'title' => 'Regression Testing:',
            'text' => ' We conduct rigorous regression testing to ensure modifications haven\'t affected existing functionalities.',
        ],
    ];

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/functional-testing.css'])
@endpush

@section('content')
    <div class="ftest-page">
        {{-- Hero --}}
        <section class="ftest-hero" aria-labelledby="ftest-hero-title">
            <div class="site-shell ftest-hero__inner">
                <div class="ftest-hero__copy">
                    <p class="ftest-hero__eyebrow">
                        Deliver High-Quality Software Products with IBN Tech's Comprehensive Functional Testing Services
                    </p>
                    <h1 id="ftest-hero-title">Functional Testing Services</h1>
                    <p class="ftest-hero__lede">
                        Unlock flawless software performance with our meticulous functional testing solutions.
                    </p>
                    <div class="ftest-hero__actions">
                        <a href="#contact-us" class="ftest-btn ftest-btn--green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="ftest-hero__media">
                    <img
                        src="{{ $img('functional-testing-2.webp') }}"
                        alt="Functional Testing Services"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="ftest-section" aria-labelledby="ftest-intro-title">
            <div class="site-shell ftest-split">
                <div class="ftest-split__media">
                    <img
                        src="{{ $img('ibn-techs-functional-testing-services-is.webp') }}"
                        alt="ibn tech’s functional testing services is"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="ftest-split__copy">
                    <h2 id="ftest-intro-title" class="sr-only">About IBN Tech Functional Testing</h2>
                    <p>
                        IBN Tech’s Functional Testing Services is your partner in achieving software that operates impeccably, meeting user needs consistently. Our experienced team assures that every feature of your software functions as intended, lending you the confidence to deliver quality products every time.
                    </p>
                    <a href="#contact-us" class="ftest-btn ftest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- What We Offer --}}
        <section class="ftest-section ftest-section--soft" aria-labelledby="ftest-offer-title">
            <div class="site-shell ftest-split">
                <div class="ftest-split__copy">
                    <h2 id="ftest-offer-title">What We Offer</h2>
                    <p>
                        Our Functional Testing Services are designed to cater to a wide range of needs, including
                    </p>
                    <div class="ftest-scope">
                        @foreach ($offerings as $item)
                            <p>
                                <strong>{{ $item['title'] }}</strong>{{ $item['text'] }}@if (! empty($item['linkLabel']))<a href="{{ route('page.show', ['slug' => $item['linkSlug']]) }}">{{ $item['linkLabel'] }}</a>{{ $item['after'] }}@endif
                            </p>
                        @endforeach
                    </div>
                    <a href="#contact-us" class="ftest-btn ftest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="ftest-split__media ftest-split__media--photo">
                    <img
                        src="{{ $img('service-highlights-1.webp') }}"
                        alt="service highlights"
                        width="560"
                        height="590"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- What We Deliver --}}
        <section class="ftest-section" aria-labelledby="ftest-deliver-title">
            <div class="site-shell ftest-split">
                <div class="ftest-split__media ftest-split__media--photo">
                    <img
                        src="{{ $img('service-scope.webp') }}"
                        alt="service scope"
                        width="560"
                        height="590"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="ftest-split__copy">
                    <h2 id="ftest-deliver-title">What We Deliver</h2>
                    <h3>Our range of functional testing services include:</h3>
                    <ul class="ftest-list">
                        @foreach ($deliverables as $item)
                            <li><strong>{{ $item['title'] }}</strong>{{ $item['text'] }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="ftest-btn ftest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Unique approach --}}
        <section class="ftest-section ftest-section--mint" aria-labelledby="ftest-benefits-title">
            <div class="site-shell ftest-split">
                <div class="ftest-split__copy">
                    <h2 id="ftest-benefits-title">Our Unique Approach to Customer Benefits</h2>
                    <p>When you choose IBN Tech for your functional testing needs, you can expect:</p>
                    <div class="ftest-scope">
                        @foreach ($benefits as $item)
                            <p>
                                <strong>{{ $item['title'] }}</strong>{{ $item['text'] }}
                            </p>
                        @endforeach
                    </div>
                    <a href="#contact-us" class="ftest-btn ftest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="ftest-split__media ftest-split__media--photo">
                    <img
                        src="{{ $img('our-unique-approach-to-customer-benefits-5.webp') }}"
                        alt="our unique approach to customer benefits"
                        width="515"
                        height="555"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Process --}}
        <section class="ftest-section" aria-labelledby="ftest-process-title">
            <div class="site-shell ftest-split">
                <div class="ftest-split__media ftest-split__media--photo">
                    <img
                        src="{{ $img('functional-testing-process-at-ibn-tech.webp') }}"
                        alt="functional testing process at ibn tech"
                        width="560"
                        height="590"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="ftest-split__copy">
                    <h2 id="ftest-process-title">Functional Testing Process at IBN Tech</h2>
                    <p>Our functional testing process is thorough and systematic, incorporating the following steps:</p>
                    <ul class="ftest-list">
                        @foreach ($processSteps as $step)
                            <li><strong>{{ $step['title'] }}</strong>{{ $step['text'] }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="ftest-btn ftest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Closing CTA --}}
        <section class="ftest-section ftest-closing" aria-labelledby="ftest-closing-title">
            <div class="site-shell ftest-closing__inner">
                <h2 id="ftest-closing-title" class="sr-only">Partner with IBN Tech</h2>
                <p>
                    At IBN Tech, we take pride in delivering high-quality, unique, and tailored functional testing services that cater to your specific needs. Trust us to ensure your software systems meet their requirements and offer a seamless user experience that stands the test of time.
                </p>
                <a href="#contact-us" class="ftest-btn ftest-btn--navy">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section class="ftest-section ftest-consult ftest-section--soft" id="contact-us" aria-labelledby="ftest-consult-title">
            <div class="site-shell ftest-consult__inner">
                <aside class="ftest-consult__card" aria-labelledby="ftest-consult-title">
                    <div class="ftest-consult__header">
                        <h2 id="ftest-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="ftest-consult__body">
                        <livewire:forms.contact-form
                            form-name="functional-testing"
                            id-prefix="ftest"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="Message"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="ftest-consult__media">
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
