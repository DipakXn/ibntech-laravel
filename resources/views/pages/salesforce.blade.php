@php
    $img = fn (string $file): string => asset('images/salesforce/'.$file);

    $scopeItems = [
        'Salesforce Implementation Services',
        'Salesforce Customization Services',
        'Salesforce Integration Services',
        'Salesforce Migration Services',
        'Salesforce Optimization Services',
        'Salesforce Training Services',
        'Salesforce Support Services',
        'Salesforce Marketing Cloud Services',
        'Salesforce Commerce Cloud Services',
    ];

    $offeringsBlock1 = [
        [
            'number' => '1',
            'title' => 'CRM Solution Design',
            'text' => 'Collaborate with our experienced Salesforce consultants to design a customized CRM solution tailored to your specific business requirements.',
        ],
        [
            'number' => '2',
            'title' => 'Salesforce Implementation Services',
            'text' => 'Seamlessly implement Salesforce and ensure a successful rollout that meets your business objectives.',
        ],
        [
            'number' => '3',
            'title' => 'Salesforce Customization Services',
            'text' => 'Leverage the flexibility of Salesforce to customize and tailor the platform to align with your unique business processes.',
        ],
        [
            'number' => '4',
            'title' => 'Salesforce Integration Services',
            'text' => 'Integrate Salesforce with your existing systems and applications to streamline operations and enhance data visibility.',
        ],
        [
            'number' => '5',
            'title' => 'Salesforce Migration Services',
            'text' => 'Seamlessly migrate your data from legacy systems or other CRM platforms to Salesforce, ensuring a smooth transition.',
        ],
    ];

    $offeringsBlock2 = [
        [
            'number' => '6',
            'title' => 'Salesforce Optimization Services',
            'text' => 'Optimize your Salesforce instance for improved performance, efficiency, and user adoption.',
        ],
        [
            'number' => '7',
            'title' => 'Salesforce Training Services',
            'text' => 'Empower your team with comprehensive Salesforce training to maximize their productivity and proficiency on the platform.',
        ],
        [
            'number' => '8',
            'title' => 'Salesforce Support Services',
            'text' => 'Access ongoing support and maintenance to ensure the smooth functioning of your Salesforce implementation.',
        ],
        [
            'number' => '9',
            'title' => 'Salesforce Marketing Cloud Services',
            'text' => 'Leverage the power of Salesforce Marketing Cloud to deliver personalized, targeted marketing campaigns.',
        ],
        [
            'number' => '10',
            'title' => 'Salesforce Commerce Cloud Services',
            'text' => 'Enhance your e-commerce capabilities with Salesforce Commerce Cloud for seamless online shopping experiences.',
        ],
        [
            'number' => '11',
            'title' => 'Salesforce Analytics Services',
            'text' => 'Unlock the value of your data with Salesforce Analytics, gaining actionable insights for data-driven decision-making.',
        ],
    ];

    $benefitsItems = [
        '1. Access to a team of certified Salesforce consultants with deep expertise in Salesforce implementation and optimization.',
        '2. Tailored Salesforce solutions designed to align with your business goals and objectives.',
        '3. Enhanced user adoption and productivity through comprehensive training and support services.',
        '4. Streamlined operations and improved business efficiency with seamless Salesforce integrations.',
        '5. Ongoing guidance and consultation to drive continuous improvement and growth.',
    ];

    $processItems = [
        '1. In-depth analysis of your business requirements and objectives.',
        '2. Collaborative design and planning of the Salesforce solution.',
        '3. Efficient implementation and configuration of Salesforce to meet your specific needs.',
        '4. Rigorous testing and quality assurance to ensure a seamless user experience.<br>Comprehensive training and enablement programs for your team.',
        '5. Ongoing support, maintenance, and optimization services to maximize your Salesforce investment.',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/salesforce.css'])
@endpush

@section('content')
    <div class="sf-page">
        {{-- Section 1: Hero --}}
        <section class="sf-hero" aria-labelledby="sf-hero-title">
            <div class="site-shell sf-hero__inner">
                <div class="sf-hero__content">
                    <h1 id="sf-hero-title" class="sf-hero__title">
                        &ldquo;Boost Salesforce Efficiency with Expert Consulting <span class="sf-highlight">IBN Tech</span>&rdquo;
                    </h1>
                    <h2 class="sf-hero__subtitle">Salesforce Consulting Services</h2>
                    <p class="sf-hero__tagline">
                        &ldquo;Transform Your Business with Our Comprehensive Salesforce Consulting Solutions&rdquo;
                    </p>
                    <div class="sf-hero__cta">
                        <a href="#" id="california-btn" class="sf-btn sf-btn--hero" data-contact-modal-trigger>
                            Get Started Now
                        </a>
                    </div>
                </div>
                <div class="sf-hero__media">
                    <img
                        src="{{ $img('group-26-1.webp') }}"
                        alt="Salesforce Consulting Services"
                        width="319"
                        height="354"
                        loading="eager"
                        fetchpriority="high"
                        class="sf-hero__img"
                    >
                </div>
            </div>
        </section>

        {{-- Section 2: Intro & Primary Services --}}
        <section class="sf-intro" aria-label="Introduction and Primary Services">
            <div class="site-shell">
                <div class="sf-intro__text-wrap">
                    <p class="sf-intro__lead">
                        Salesforce has emerged as a game-changer for businesses, revolutionizing customer relationship management (CRM) and driving growth. However, realizing the full potential of Salesforce requires expertise and strategic guidance. At IBN Tech, we offer comprehensive Salesforce consulting services that empower businesses to harness the true power of this remarkable platform and achieve their goals.
                    </p>
                </div>

                <div class="sf-badge-wrap">
                    <h2 class="sf-badge">Primary Services</h2>
                </div>

                <div class="sf-process-graphic">
                    <img
                        src="{{ $img('group-27.webp') }}"
                        alt="Salesforce-Consulting-Services"
                        width="1238"
                        height="416"
                        loading="lazy"
                        class="sf-process-graphic__img"
                    >
                </div>
            </div>
        </section>

        {{-- Section 3: Service Scope Grid --}}
        <section class="sf-scope" aria-label="Service Scope">
            <div class="site-shell">
                <div class="sf-badge-wrap">
                    <h2 class="sf-badge sf-badge--scope">SERVICE SCOPE</h2>
                </div>

                <div class="sf-scope__grid">
                    @foreach ($scopeItems as $item)
                        <div class="sf-scope__card">
                            <span class="sf-scope__card-text">{{ $item }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Section 4: Detailed Offerings Breakdown --}}
        <section class="sf-offerings" aria-label="Detailed Salesforce Services">
            <div class="site-shell">
                {{-- Block 1: Left Image, Right List 1-5 --}}
                <div class="sf-offerings__block sf-offerings__block--media-left">
                    <div class="sf-offerings__media">
                        <img
                            src="{{ $img('salesforceimage-1.webp') }}"
                            alt="Salesforce CRM Solution and Implementation"
                            width="600"
                            height="600"
                            loading="lazy"
                            class="sf-offerings__img"
                        >
                    </div>
                    <div class="sf-offerings__content">
                        <ul class="sf-offerings__list">
                            @foreach ($offeringsBlock1 as $item)
                                <li class="sf-offerings__item">
                                    <p class="sf-offerings__item-text">
                                        <strong>{{ $item['number'] }}. {{ $item['title'] }}:</strong> {{ $item['text'] }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Block 2: Left List 6-11, Right Image --}}
                <div class="sf-offerings__block sf-offerings__block--media-right">
                    <div class="sf-offerings__content">
                        <ul class="sf-offerings__list">
                            @foreach ($offeringsBlock2 as $item)
                                <li class="sf-offerings__item">
                                    <p class="sf-offerings__item-text">
                                        <strong>{{ $item['number'] }}. {{ $item['title'] }}:</strong> {{ $item['text'] }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sf-offerings__media">
                        <img
                            src="{{ $img('salesforceimage-2.webp') }}"
                            alt="Salesforce Optimization"
                            width="600"
                            height="600"
                            loading="lazy"
                            class="sf-offerings__img"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 5: Distinctive Approach & Benefits --}}
        <section class="sf-benefits" aria-label="Our Distinctive Approach and Process">
            <div class="site-shell">
                {{-- Top Block: Left Green Box, Right Benefits List --}}
                <div class="sf-benefits__block sf-benefits__block--media-left">
                    <div class="sf-benefits__graphic-box">
                        <img
                            src="{{ $img('character1.webp') }}"
                            alt="Our Distinctive Approach to Customer Benefits"
                            width="367"
                            height="341"
                            loading="lazy"
                            class="sf-benefits__graphic-img"
                        >
                    </div>
                    <div class="sf-benefits__content">
                        <h2 class="sf-benefits__heading">Our Distinctive Approach to Customer Benefits</h2>
                        <ul class="sf-benefits__list">
                            @foreach ($benefitsItems as $item)
                                <li class="sf-benefits__item">
                                    <p class="sf-benefits__item-text">{!! $item !!}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Bottom Block: Left Process List, Right Green Box --}}
                <div class="sf-benefits__block sf-benefits__block--media-right">
                    <div class="sf-benefits__content">
                        <ul class="sf-benefits__list">
                            @foreach ($processItems as $item)
                                <li class="sf-benefits__item">
                                    <p class="sf-benefits__item-text">{!! $item !!}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sf-benefits__graphic-box">
                        <img
                            src="{{ $img('character2.webp') }}"
                            alt="Salesforce Consulting Process at IBN Tech"
                            width="438"
                            height="355"
                            loading="lazy"
                            class="sf-benefits__graphic-img"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 6: Closing Highlight --}}
        <section class="sf-highlight-section" aria-label="Why Partner with IBN Tech">
            <div class="site-shell">
                <div class="sf-highlight-box">
                    <p class="sf-highlight-box__text">
                        At IBN Tech, we are passionate about helping businesses unlock the full potential of Salesforce. Our expert consultants collaborate closely with you to understand your unique needs and design tailored solutions that drive growth and success. Trust IBN Tech to transform your business with our comprehensive Salesforce Consulting Services.
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
