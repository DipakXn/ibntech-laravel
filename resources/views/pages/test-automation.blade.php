@php
    $img = fn (string $file): string => asset('images/test-automation/'.$file);

    $offerings = [
        [
            'icon' => 'test-automation-strategy-development.webp',
            'alt' => 'test automation strategy development',
            'title' => 'Test Automation Strategy Development',
            'text' => 'Design an effective automation strategy based on your business requirements and testing objectives.',
        ],
        [
            'icon' => 'test-automation-tool-selection-and-implementation.webp',
            'alt' => 'test automation tool selection and implementation',
            'title' => 'Test Automation Tool Selection and Implementation',
            'text' => 'Choose and implement the right automation tools that align with your technology stack and testing needs.',
        ],
        [
            'icon' => 'test-script-development.webp',
            'alt' => 'test script development',
            'title' => 'Test Script Development',
            'text' => 'Develop robust and reusable test scripts that can efficiently validate your software functionality.',
        ],
        [
            'icon' => 'test-execution-and-reporting.webp',
            'alt' => 'test execution and reporting',
            'title' => 'Test Execution and Reporting',
            'text' => 'Execute automated tests and provide detailed reports to help you understand the test outcomes and make informed decisions.',
        ],
        [
            'icon' => 'continuous-integration-and-delivery.webp',
            'alt' => 'continuous integration and delivery',
            'title' => 'Continuous Integration and Delivery',
            'text' => 'Integrate test automation into your CI/CD pipeline for continuous testing and quicker feedback.',
        ],
        [
            'icon' => 'assessment-roi-analysis.webp',
            'alt' => 'assessment & roi analysis',
            'title' => 'Assessment & ROI Analysis',
            'text' => 'Evaluate the effectiveness and ROI of your test automation efforts, ensuring you get maximum value from your investment.',
        ],
        [
            'icon' => 'end-to-end-test-strategy.webp',
            'alt' => 'end to end test strategy',
            'title' => 'End to End Test Strategy',
            'text' => 'Develop a comprehensive test strategy that covers all aspects of your application, from front-end to back-end.',
        ],
        [
            'icon' => 'framework-implementation.webp',
            'alt' => 'framework implementation',
            'title' => 'Framework Implementation',
            'text' => 'Implement robust automation frameworks that support efficient test creation, execution, and maintenance.',
        ],
        [
            'icon' => 'scripting-execution.webp',
            'alt' => 'scripting & execution',
            'title' => 'Scripting & Execution',
            'text' => 'Develop and execute test scripts that thoroughly test your software functionality and performance.',
        ],
        [
            'icon' => 'automated-regression-testing.webp',
            'alt' => 'automated regression testing',
            'title' => 'Automated Regression Testing',
            'text' => 'Automate your regression testing to quickly validate your software after changes, enhancements, or bug fixes.',
        ],
        [
            'icon' => 'selenium-testing.webp',
            'alt' => 'selenium testing',
            'title' => 'Selenium Testing',
            'text' => 'Leverage Selenium, a popular open-source automation tool, for testing web applications across different browsers and platforms.',
        ],
        [
            'icon' => 'intelligent-testing.webp',
            'alt' => 'intelligent testing',
            'title' => 'Intelligent Testing',
            'text' => 'Implement intelligent testing techniques that use AI and machine learning to improve test effectiveness and efficiency.',
        ],
    ];

    $benefits = [
        'A team of experienced automation experts who understand the complexities of the testing process and the importance of quality assurance.',
        'An approach that focuses on reducing manual effort, improving testing efficiency, and accelerating time to market.',
        'Customized automation solutions that cater to your specific needs and objectives.',
        'Continuous support and consultation to ensure your test automation efforts are always aligned with your business goals.',
    ];

    $processSteps = [
        'Understanding your testing needs and objectives.',
        'Developing a comprehensive automation strategy.',
        'Selecting and implementing the right automation tools.',
        'Developing and maintaining robust test scripts.',
        'Executing automated tests and providing detailed reports.',
        'Integrating test automation into your CI/CD pipeline for continuous testing.',
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
    @vite(['resources/css/pages/test-automation.css'])
@endpush

@section('content')
    <div class="ta-page">
        {{-- Hero --}}
        <section class="ta-hero" aria-labelledby="ta-hero-title">
            <div class="site-shell ta-hero__inner">
                <div class="ta-hero__copy">
                    <p class="ta-hero__eyebrow">
                        Improve efficiency and speed of your testing process with IBN Tech's innovative Test Automation services.
                    </p>
                    <h1 id="ta-hero-title">Test Automation</h1>
                    <p class="ta-hero__lede">
                        In the rapidly evolving digital landscape, accelerate your testing process without compromising quality.
                    </p>
                    <div class="ta-hero__actions">
                        <a href="#contact-us" class="ta-btn ta-btn--green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="ta-hero__media">
                    <img
                        src="{{ $img('test-automation.webp') }}"
                        alt="test automation"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="ta-section ta-intro" aria-labelledby="ta-intro-title">
            <div class="site-shell ta-split">
                <div class="ta-split__media">
                    <img
                        src="{{ $img('at-ibn-tech-we-laverage-advanced-tool.webp') }}"
                        alt="at ibn tech we laverage advanced tool"
                        width="560"
                        height="250"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="ta-split__copy">
                    <h2 id="ta-intro-title" class="sr-only">About IBN Tech Test Automation</h2>
                    <p>
                        At IBN Tech, we leverage advanced tools and technologies to provide comprehensive test automation services. Our proficient team has extensive experience in developing robust automation frameworks that enable businesses to streamline their testing processes, reduce manual effort, enhance software quality, and accelerate time to market.
                    </p>
                    <div class="ta-split__actions">
                        <a href="#contact-us" class="ta-btn ta-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Key Offerings at a Glance --}}
        <section class="ta-section ta-offerings" aria-labelledby="ta-offerings-title">
            <div class="site-shell">
                <div class="ta-heading">
                    <h2 id="ta-offerings-title">Key Offerings at a Glance</h2>
                    <p>Our API Testing services provide a comprehensive approach to validating your APIs:</p>
                </div>

                <div class="ta-offer-grid" role="list">
                    @foreach ($offerings as $item)
                        <article class="ta-offer-card" role="listitem">
                            <div class="ta-offer-card__icon">
                                <img
                                    src="{{ $img($item['icon']) }}"
                                    alt="{{ $item['alt'] }}"
                                    width="65"
                                    height="65"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="ta-section__cta">
                    <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="ta-btn ta-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Service Scope --}}
        <section class="ta-section ta-scope" aria-labelledby="ta-scope-title">
            <div class="site-shell ta-split">
                <div class="ta-split__copy">
                    <p class="ta-kicker">Service Scope</p>
                    <h2 id="ta-scope-title">
                        Our Test Automation services provide a comprehensive solution to streamline your testing processes:
                    </h2>
                    <div class="ta-scope-list">
                        <p><strong>Test Automation Strategy Development:</strong> Create an effective automation strategy that aligns with your business and testing objectives.</p>
                        <p><strong>Test Automation Tool Selection and Implementation:</strong> Identify and implement the right automation tools that are compatible with your technology stack and testing needs.</p>
                        <p><strong>Test Script Development:</strong> Develop robust and reusable test scripts that can validate your <a href="{{ route('page.show', ['slug' => 'functional-testing']) }}">software functionality</a> and performance efficiently.</p>
                        <p><strong>Test Execution and Reporting:</strong> Conduct automated tests and provide detailed reports to help you understand the test results and make informed decisions.</p>
                        <p><strong>Continuous Integration and Delivery:</strong> Integrate test automation into your CI/CD pipeline to enable continuous testing and quicker feedback.</p>
                    </div>
                    <div class="ta-split__actions">
                        <a href="#contact-us" class="ta-btn ta-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="ta-split__media ta-split__media--photo">
                    <img
                        src="{{ $img('our-test-automation-services.webp') }}"
                        alt="our test automation services"
                        width="560"
                        height="600"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Our Unique Approach to Customer Benefits --}}
        <section class="ta-section ta-benefits" aria-labelledby="ta-benefits-title">
            <div class="site-shell ta-split ta-split--reverse">
                <div class="ta-split__media ta-split__media--photo">
                    <img
                        src="{{ $img('our-unique-approach-to-customer-benefits-4.webp') }}"
                        alt="our unique approach to customer benefits"
                        width="515"
                        height="555"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="ta-split__copy">
                    <p class="ta-kicker">Our Unique Approach to Customer Benefits</p>
                    <h2 id="ta-benefits-title">
                        Choosing IBN Tech as your test automation partner brings:
                    </h2>
                    <ul class="ta-check-list">
                        @foreach ($benefits as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <div class="ta-split__actions">
                        <a href="#contact-us" class="ta-btn ta-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Test Automation Process at IBN Tech --}}
        <section class="ta-section ta-process" aria-labelledby="ta-process-title">
            <div class="site-shell ta-split">
                <div class="ta-split__copy">
                    <p class="ta-kicker">Test Automation Process at IBN Tech</p>
                    <h2 id="ta-process-title">
                        Our systematic approach to test automation includes:
                    </h2>
                    <ul class="ta-check-list">
                        @foreach ($processSteps as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ul>
                    <div class="ta-split__actions">
                        <a href="#contact-us" class="ta-btn ta-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="ta-split__media ta-split__media--photo">
                    <img
                        src="{{ $img('test-automation-process-at-ibn-tech.webp') }}"
                        alt="test automation process at ibn tech"
                        width="515"
                        height="459"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Closing Banner --}}
        <section class="ta-section ta-closing" aria-labelledby="ta-closing-title">
            <div class="site-shell ta-closing__inner">
                <h2 id="ta-closing-title" class="sr-only">Partner with IBN Tech</h2>
                <p>
                    At IBN Tech, we understand that effective test automation is crucial in today's fast-paced digital world. We are committed to helping businesses like yours improve testing efficiency, reduce time to market, and enhance software quality. Trust us to transform your testing process with our advanced Test Automation services.
                </p>
                <div class="ta-closing__actions">
                    <a href="#contact-us" class="ta-btn ta-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Contact form --}}
        <section class="ta-section ta-consult" id="contact-us" aria-labelledby="ta-consult-title">
            <div class="site-shell ta-consult__inner">
                <aside class="ta-consult__card" aria-labelledby="ta-consult-title">
                    <div class="ta-consult__header">
                        <h2 id="ta-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="ta-consult__body">
                        <livewire:forms.contact-form
                            form-name="test-automation"
                            id-prefix="testauto"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="What kind of accounting solution are you looking for?"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="ta-consult__media">
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
