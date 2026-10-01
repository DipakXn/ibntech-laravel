@php
    $heroStats = [
        ['value' => '2.5K+', 'label' => 'Global Clients'],
        ['value' => '27+', 'label' => 'Years of Expertise'],
        ['value' => '100%', 'label' => 'Compliance Rate'],
        ['value' => '99.9%', 'label' => 'Cloud Uptime'],
    ];

    $coreValues = [
        [
            'icon' => 'Transparency.webp',
            'title' => 'Transparency',
            'text' => 'We believe in open communication and honesty, ensuring clarity in all our interactions and decisions, both internally and with our clients',
            'tone' => 'light',
        ],
        [
            'icon' => 'reliability.webp',
            'title' => 'Reliability',
            'text' => 'We are dependable and consistent, taking full ownership of our work to meet deadlines and deliver exceptional results every time',
            'tone' => 'navy',
        ],
        [
            'icon' => 'creativity.webp',
            'title' => 'Creativity',
            'text' => 'We foster a culture of thinking outside the box, encouraging fresh perspectives and bold approaches to solve complex challenges',
            'tone' => 'light',
        ],
        [
            'icon' => 'customer-centricity.webp',
            'title' => 'Customer-Centricity',
            'text' => 'We provide personalized solutions to meet our clients\' needs, aiming to go beyond expectations and support long-term success',
            'tone' => 'navy',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/about-ibn.css'])
@endpush

@section('content')
    <div class="about-ibn-page">
        {{-- Hero --}}
        <section class="about-ibn-hero" aria-labelledby="about-ibn-hero-title">
            <div class="site-shell about-ibn-hero__inner">
                <div class="about-ibn-hero__copy">
                    <h1 id="about-ibn-hero-title">About Us</h1>
                    <p class="about-ibn-hero__lede">
                        IBN Technologies- Intelligent Solutions That Simplify, Secure, and Scale Your Business
                    </p>
                    <div class="about-ibn-hero__actions">
                        <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="button-primary">
                            Get Started
                        </a>
                    </div>
                </div>

                <div class="about-ibn-hero__stats" role="list">
                    @foreach ($heroStats as $stat)
                        <div class="about-ibn-hero__stat" role="listitem">
                            <strong>{{ $stat['value'] }}</strong>
                            <span>{{ $stat['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Committed Expertise --}}
        <section class="about-ibn-section" aria-labelledby="about-ibn-expertise-title">
            <div class="site-shell">
                <div class="about-ibn-heading about-ibn-heading--center">
                    <h2 id="about-ibn-expertise-title">
                        Committed Expertise <span class="about-ibn-accent">Meets Quality</span>
                    </h2>
                </div>

                <div class="about-ibn-split">
                    <div class="about-ibn-split__copy">
                        <p>
                            With over 26 years of experience, IBN Technologies is a trusted outsourcing partner serving clients in the USA, UK, Middle East, and India. From our state-of-the-art Global Delivery Center in Pune, India, we ensure top-tier quality and security with ISO 9001:2015 and ISO 27001:2022 certifications.
                        </p>
                        <p>
                            We are a trusted partner in driving digital and operational transformation for businesses worldwide. Beyond our expertise in cybersecurity and cloud transformation, we deliver end-to-end finance and accounting services along with middle- and back-office solutions customized for global funds.
                        </p>
                        <p>
                            By integrating Intelligent Process Automation (IPA), we empower organizations to improve efficiency, cut costs up to 50%, and achieve an unparalleled 99% client retention rate. Our expertise in robotic process automation also helps improve efficiency, increase accuracy, and implement intelligent scalability.
                        </p>
                        <p>
                            Complementing this, our BPO solutions make complex processes easier, cut costs, and increase productivity, leaving our clients to innovate and grow their businesses while we manage the back-end for them.
                        </p>
                        <p class="about-ibn-split__emphasis">
                            At IBN Technologies, our commitment is simple yet powerful: to serve smarter strategies, stronger outcomes, and sustainable success for every client we serve.
                        </p>
                    </div>

                    <div class="about-ibn-split__media">
                        <img
                            src="{{ asset('images/about-ibn/about-ibn-banner.webp') }}"
                            alt="About IBN Technologies team"
                            width="1080"
                            height="1080"
                            fetchpriority="high"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Core Values --}}
        <section class="about-ibn-section about-ibn-section--soft" aria-labelledby="about-ibn-values-title">
            <div class="site-shell">
                <div class="about-ibn-heading about-ibn-heading--center">
                    <h2 id="about-ibn-values-title" class="about-ibn-values-title">
                        <span class="about-ibn-values-title__plain">Core</span>
                        <span class="about-ibn-values-title__accent">values</span>
                    </h2>
                    <p>(The Cornerstone of Our Collaborative Growth)</p>
                </div>

                <div class="about-ibn-values" role="list">
                    @foreach ($coreValues as $value)
                        <article class="about-ibn-value about-ibn-value--{{ $value['tone'] }}" role="listitem">
                            <div class="about-ibn-value__icon">
                                <img
                                    src="{{ asset('images/about-ibn/'.$value['icon']) }}"
                                    alt=""
                                    width="75"
                                    height="75"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <h3>{{ $value['title'] }}</h3>
                            <p>{{ $value['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- What We Stand For --}}
        <section class="about-ibn-section" aria-labelledby="about-ibn-stand-title">
            <div class="site-shell about-ibn-split about-ibn-split--stand">
                <div class="about-ibn-split__copy">
                    <h2 id="about-ibn-stand-title">What We Stand For</h2>
                    <p>
                        Our strength balances in diverse, cross-functional teams with cloud architects and cybersecurity specialists, working alongside product managers, bookkeepers, data scientists, automation specialists, and project leads. With our collective capabilities, companies can operate with confidence and realize sustained growth through our solutions in cloud transformation and cybersecurity, finance and accounting, and automation solutions.
                    </p>
                    <div class="about-ibn-split__actions">
                        <a href="#" class="button-primary" data-contact-modal-trigger>
                            Schedule a Free Consultation
                        </a>
                    </div>
                </div>

                <div class="about-ibn-split__media">
                    <img
                        src="{{ asset('images/about-ibn/what-we-stand-for.webp') }}"
                        alt="What we stand for"
                        width="450"
                        height="450"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Our Commitment --}}
        <section class="about-ibn-section about-ibn-section--soft" aria-labelledby="about-ibn-commitment-title">
            <div class="site-shell about-ibn-split about-ibn-split--commitment">
                <div class="about-ibn-split__media">
                    <img
                        src="{{ asset('images/about-ibn/our-commitment-to-client-success.webp') }}"
                        alt="Our commitment to client success"
                        width="450"
                        height="450"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="about-ibn-split__copy">
                    <h2 id="about-ibn-commitment-title">Our Commitment to Client Success</h2>
                    <p>
                        Our clients’ success is our priority, and we take pride in leading productivity, minimizing operational risks, and improving outcomes. We wish to deliver faster response times, high-quality results, governance, and transparency leading to greater employee satisfaction, stronger client relationships, and higher returns on investment (ROI)
                    </p>
                </div>
            </div>
        </section>

        {{-- Partner With Us --}}
        <section class="about-ibn-partner" aria-labelledby="about-ibn-partner-title">
            <div class="site-shell about-ibn-partner__panel">
                <h2 id="about-ibn-partner-title">Partner With Us</h2>
                <p>
                    Whether it’s securing your digital infrastructure, modernizing your cloud environment, automating workflows, or managing finance and accounting operations, IBN Technologies is your partner in innovation, efficiency, and growth.
                </p>
                <a href="#" class="button-primary" data-contact-modal-trigger>
                    Book a Call
                </a>
            </div>
        </section>
    </div>
@endsection
