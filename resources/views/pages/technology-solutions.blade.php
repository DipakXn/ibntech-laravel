@php
    $img = fn (string $file): string => asset('images/technology-solutions/'.$file);

    $crmChecklist = [
        'Expert-driven data handling with a proven track record of success',
        'Significantly reduced downtime, minimizing disruption to daily operations',
        'State-of-the-art data security throughout the migration process',
        'Post-migration database performance optimization',
        'Ongoing support and maintenance services for continued satisfaction and improvement',
    ];

    $usabilityChecklist = [
        'Intuitive rule forms to easily configure and manage business rules.',
        'A graphical front-end to link rules with applications',
        'Built-in review and approval processes.',
        'A version-controlled rules inventory that supports the efficient reuse of existing rules.',
        'A secure audit trail for all rules changes.',
        'Automatic documentation generation.',
    ];

    $infrastructureChecklist = [
        'Process rules that automate work flow management.',
        'Declarative rules that compute values based on detected changes in other related values.',
        'Transformation rules that appropriately transform data as it passes across heterogeneous systems.',
        'Integration rules that determine the right system to invoke in each situation.',
    ];

    $biImplementationList = [
        'BI Implementation Services',
        'BI Dashboard Services',
        'BI Migration Services',
        'BI Performance Management',
        'BI Governance Services',
    ];

    $biConsultingList = [
        'BI Assessment & Tool Evaluation',
        'BI Consulting Services',
        'BI Architecture Design Services',
    ];

    $biSupportList = [
        'BI Support and Maintenance Services',
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
    @vite(['resources/css/pages/technology-solutions.css'])
@endpush

@section('content')
    <div class="ts-page">
        {{-- Section 1: Hero Banner --}}
        <section class="ts-hero" aria-labelledby="ts-hero-title">
            <div class="site-shell ts-hero__inner">
                <div class="ts-hero__copy">
                    <h1 id="ts-hero-title">Technology Solutions</h1>
                    <div class="ts-hero__actions">
                        <a href="#contact-us" class="ts-btn">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="ts-hero__media">
                    <img
                        src="{{ $img('banner-5.webp') }}"
                        alt="Technology Solutions"
                        width="580"
                        height="514"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 2: Consultants Overview --}}
        <section class="ts-section ts-consultants" aria-labelledby="ts-consultants-title">
            <div class="site-shell ts-split">
                <div class="ts-split__media">
                    <img
                        src="{{ $img('our-technology-consultants-combine.webp') }}"
                        alt="Our technology consultants combine"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="ts-split__copy">
                    <h2 id="ts-consultants-title" class="visually-hidden">Our Technology Consultants</h2>
                    <p class="ts-prose">
                        Our technology consultants combine extensive technical experience with strong strategic and business focused leadership. We help our clients in building a high performance IT organization through formalizing the IT strategy, governance, metrics, business processes, and technology and organization structure needed to deliver and manage efficient, high quality IT services. We work with our clients in architecture, business value analysis, asset management, product evaluation and selection, Application Development, Testing Services, data privacy and security of their IT function.
                    </p>
                    <p class="ts-prose">
                        Our certified engineers work with clients to design flexible technology solutions based on the right combination of service offerings, experience and highly skilled resources. The technical expertise coupled with the business understanding is what allows our consultants’ work with you to improve process efficiency, reduce costs and help you realize better returns on your IT investments.
                    </p>
                    <div class="ts-split__actions">
                        <a href="#contact-us" class="ts-btn">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 3: Dynamics CRM Services (2-Column Feature Breakdown) --}}
        <section class="ts-section ts-crm-overview" aria-labelledby="ts-crm-overview-title">
            <div class="site-shell ts-crm-overview__inner">
                <div class="ts-crm-overview__left">
                    <p class="ts-eyebrow">Technology Solutions</p>
                    <h2 id="ts-crm-overview-title" class="ts-heading-md">Dynamics CRM Services</h2>
                    <p class="ts-prose">
                        IBN Technologies provides implementation &amp; Consultation Services on Microsoft Dynamics CRM to automate entire sales and support processes. IBN has strong industry understating in terms of Business Processes, productivity measures, sales force effectiveness, etc. Our experts can come, sit with your team, understand your Business Processes &amp; ground realities and suggest how to implement Dynamics CRM. <strong>Our services includes:</strong>
                    </p>
                </div>

                <div class="ts-crm-overview__right">
                    <div class="ts-crm-service-item">
                        <h3 class="ts-crm-service-item__title">Analysis and Consultation</h3>
                        <p class="ts-crm-service-item__text">Analyze existing business processes and suggest how effectively CRM can benefit the client’s business.</p>
                    </div>

                    <div class="ts-crm-service-item">
                        <h3 class="ts-crm-service-item__title">Creative Designing</h3>
                        <p class="ts-crm-service-item__text">Team will design professional, appealing and unique design which will resemble product brand and services that the client is into.</p>
                    </div>

                    <div class="ts-crm-service-item">
                        <h3 class="ts-crm-service-item__title">Implementation, deployment &amp; support</h3>
                        <p class="ts-crm-service-item__text">Set up CRM installations rapidly, and also offer comprehensive customer support and service, providing dedicated full-time resources and/or an AMC.</p>
                    </div>

                    <div class="ts-crm-service-item">
                        <h3 class="ts-crm-service-item__title">Custom development</h3>
                        <p class="ts-crm-service-item__text">Develop and integrate custom tools and web parts to meet client business needs.t business needs.</p>
                    </div>

                    <div class="ts-crm-service-item">
                        <h3 class="ts-crm-service-item__title">Data Migration</h3>
                    </div>

                    <div class="ts-crm-service-item">
                        <h3 class="ts-crm-service-item__title">Integration</h3>
                    </div>

                    <div class="ts-crm-service-item">
                        <h3 class="ts-crm-service-item__title">Extension or Add-on Development</h3>
                    </div>

                    <div class="ts-crm-service-item">
                        <h3 class="ts-crm-service-item__title">Business Intelligence and Reporting</h3>
                    </div>

                    <div class="ts-crm-overview__actions">
                        <a href="#contact-us" class="ts-btn">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 4: Dynamics CRM Services (Checklist + Image) --}}
        <section class="ts-section ts-crm-details" aria-labelledby="ts-crm-details-title">
            <div class="site-shell ts-split">
                <div class="ts-split__copy">
                    <p class="ts-eyebrow">Technology Solutions</p>
                    <h2 id="ts-crm-details-title">Dynamics CRM Services</h2>
                    <p class="ts-prose">
                        IBN Technologies provides implementation &amp; Consultation Services on Microsoft Dynamics CRM to automate entire sales and support processes. IBN has strong industry understating in terms of Business Processes, productivity measures, sales force effectiveness, etc. Our experts can come, sit with your team, understand your Business Processes &amp; ground realities and suggest how to implement Dynamics CRM. Our services includes:
                    </p>
                    <ul class="ts-checklist" role="list">
                        @foreach ($crmChecklist as $item)
                            <li class="ts-checklist__item">
                                <span class="ts-checklist__bullet" aria-hidden="true">&bull;</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="ts-split__actions">
                        <a href="#contact-us" class="ts-btn">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="ts-split__media">
                    <img
                        src="{{ $img('dynamics-crm-services.webp') }}"
                        alt="Dynamics CRM Services"
                        width="500"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 5: Workflow Solution --}}
        <section class="ts-section ts-workflow" aria-labelledby="ts-workflow-title">
            <div class="site-shell ts-split ts-split--reverse">
                <div class="ts-split__media">
                    <img
                        src="{{ $img('outsourced-bookkeeping-services.webp') }}"
                        alt="Workflow Solution"
                        width="526"
                        height="469"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="ts-split__copy">
                    <h2 id="ts-workflow-title">Workflow Solution</h2>
                    <p class="ts-prose">
                        IBN Consultants help you to design and optimize the business models which align with your overall business vision and goals. IBN provides innovative features to design, develop, execute and monitor your business processes. IBN has an in-depth expertise and skills in BPM, both by transforming clients new and legacy, manual and semi-automated business processes into change-ready, automated processes by building and delivering workflow solutions and services.
                    </p>
                    <p class="ts-prose">
                        IBN team of consultants has extensive experience on many open source framework. IBN combines three solutions in one: an innovative studio for process modeling, a powerful BPM and workflow engine and feature rich user interface. BPM processes can be designed by simple drawing graphical solution in the framework.
                    </p>
                    <div class="ts-split__actions">
                        <a href="#contact-us" class="ts-btn">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 6: Business Intelligence --}}
        <section class="ts-section ts-bi" aria-labelledby="ts-bi-title">
            <div class="site-shell ts-split">
                <div class="ts-split__copy">
                    <h2 id="ts-bi-title">Business Intelligence</h2>
                    <p class="ts-prose">
                        IBN services offerings in Business Intelligence and Data Warehousing includes Data Integration, Master Data Management, Data Cleansing, Data Warehouse Management, Quality Management, Dashboard creations, Customized Reports creation, Advanced Analytics, Corporate Performance Management, etc.
                    </p>
                    <p class="ts-prose">
                        IBN team has expertise in SQL Server Reporting Services, Pentaho Business Analytics and Pentaho Data Integration tools. At IBN this is what we do, understands the value of data and provides Enterprise Business Intelligence solutions that transform data into measurable and actionable information as per the business needs to produce desirable results.
                    </p>
                    <div class="ts-split__actions">
                        <a href="#contact-us" class="ts-btn">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="ts-split__media">
                    <img
                        src="{{ $img('business-intelligence.webp') }}"
                        alt="Business Intelligence"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 7: Our BI Services includes --}}
        <section class="ts-section ts-bi-cards" aria-labelledby="ts-bi-cards-title">
            <div class="site-shell ts-bi-cards__inner">
                <h2 id="ts-bi-cards-title" class="ts-section-title ts-section-title--center">Our BI Services includes</h2>

                <div class="ts-bi-grid" role="list">
                    {{-- Card 1: Implementation (Dark Card) --}}
                    <div class="ts-bi-card ts-bi-card--dark" role="listitem">
                        <div class="ts-bi-card__icon-box">
                            <img
                                src="{{ $img('implementation.webp') }}"
                                alt="Implementation"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                        <h3 class="ts-bi-card__title">Implementation</h3>
                        <ul class="ts-bi-card__list">
                            @foreach ($biImplementationList as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Card 2: Consulting (Light Card) --}}
                    <div class="ts-bi-card ts-bi-card--light" role="listitem">
                        <div class="ts-bi-card__icon-box">
                            <img
                                src="{{ $img('consulting.webp') }}"
                                alt="Consulting"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                        <h3 class="ts-bi-card__title">Consulting</h3>
                        <ul class="ts-bi-card__list">
                            @foreach ($biConsultingList as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Card 3: Support (Light Card) --}}
                    <div class="ts-bi-card ts-bi-card--light" role="listitem">
                        <div class="ts-bi-card__icon-box">
                            <img
                                src="{{ $img('support.webp') }}"
                                alt="Support"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                        <h3 class="ts-bi-card__title">Support</h3>
                        <ul class="ts-bi-card__list">
                            @foreach ($biSupportList as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 8: Business Rule Management Software --}}
        <section class="ts-section ts-brms" aria-labelledby="ts-brms-title">
            <div class="site-shell ts-split ts-split--reverse">
                <div class="ts-split__media">
                    <img
                        src="{{ $img('outsourced-bookkeeping-services.webp') }}"
                        alt="Business Rule Management Software"
                        width="526"
                        height="469"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="ts-split__copy">
                    <h2 id="ts-brms-title">Business Rule Management Software</h2>
                    <p class="ts-prose">
                        IBN BRMS is completely web based business rule management system that helps organizations define, develop, manage and support the business rules of an organization
                    </p>
                    <p class="ts-prose">
                        The engine separates business logic from your mission-critical applications in order to gain agility and improve operational performance. To get the most benefit from this application architecture, you need a business rules engine that: Empowers business users to create and manage business rules with minimal involvement from IT staff. Supports sophisticated, powerful rules that can capture your business workflow and your policies and procedures in all their dynamic complexity. Integrates seamlessly with your existing IT assets and scales for enterprise-class performance
                    </p>
                    <div class="ts-split__actions">
                        <a href="#contact-us" class="ts-btn">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 9: Usability --}}
        <section class="ts-section ts-usability" aria-labelledby="ts-usability-title">
            <div class="site-shell ts-split">
                <div class="ts-split__copy">
                    <h2 id="ts-usability-title">Usability</h2>
                    <p class="ts-prose ts-prose--bold">
                        IBN business rules engine puts business users firmly in charge of creating and managing business rules, for maximum agility. Usability features include:
                    </p>
                    <ul class="ts-checklist" role="list">
                        @foreach ($usabilityChecklist as $item)
                            <li class="ts-checklist__item">
                                <span class="ts-checklist__bullet" aria-hidden="true">&bull;</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="ts-split__actions">
                        <a href="#contact-us" class="ts-btn">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="ts-split__media">
                    <img
                        src="{{ $img('usability.webp') }}"
                        alt="Usability"
                        width="516"
                        height="410"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 10: Infrastructure --}}
        <section class="ts-section ts-infrastructure" aria-labelledby="ts-infrastructure-title">
            <div class="site-shell ts-split ts-split--reverse">
                <div class="ts-split__media">
                    <img
                        src="{{ $img('infrastructure-1.webp') }}"
                        alt="Infrastructure"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="ts-split__copy">
                    <h2 id="ts-infrastructure-title">Infrastructure</h2>
                    <p class="ts-prose ts-prose--bold">
                        The business rules engine is unmatched in its support for a wide range of rule types, including:
                    </p>
                    <ul class="ts-checklist" role="list">
                        @foreach ($infrastructureChecklist as $item)
                            <li class="ts-checklist__item">
                                <span class="ts-checklist__bullet" aria-hidden="true">&bull;</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="ts-split__actions">
                        <a href="#contact-us" class="ts-btn">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 11: Scalability --}}
        <section class="ts-section ts-scalability" aria-labelledby="ts-scalability-title">
            <div class="site-shell ts-split">
                <div class="ts-split__copy">
                    <h2 id="ts-scalability-title">Scalability</h2>
                    <p class="ts-prose">
                        With the business rules engine, distributed application nodes can share a common rules database, for optimum scalability. The system employs a .Net, Silverlight and XML architecture
                    </p>
                    <div class="ts-split__actions">
                        <a href="#contact-us" class="ts-btn">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="ts-split__media">
                    <img
                        src="{{ $img('scalability.webp') }}"
                        alt="Scalability"
                        width="359"
                        height="320"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 12: Schedule A Call with Our Experts --}}
        <section class="ts-section ts-consult" id="contact-us" aria-labelledby="ts-consult-title">
            <div class="site-shell ts-consult__inner">
                <aside class="ts-consult__card" aria-labelledby="ts-consult-title">
                    <div class="ts-consult__header">
                        <h2 id="ts-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="ts-consult__body">
                        <livewire:forms.contact-form
                            form-name="technology-solutions"
                            id-prefix="ts"
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

                <div class="ts-consult__media">
                    <img
                        src="{{ $img('schedule-a-call-with-our-experts.webp') }}"
                        alt="Schedule A Call with Our Experts"
                        width="400"
                        height="269"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>
    </div>
@endsection
