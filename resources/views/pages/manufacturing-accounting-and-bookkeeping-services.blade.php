@php
    $img = fn (string $file): string => asset('images/manufacturing-accounting-and-bookkeeping-services/'.$file);
    $pageUrl = fn (string $slug): string => \App\Support\PathPageUrl::withTrailingSlash(route('page.show', ['slug' => $slug]));

    $serviceItems = [
        'Expense Tracking',
        'Reimbursement Management',
        'Financial Reconciliation',
        'Accounts Payable (AP)',
        'Accounts Receivable (AR)',
        'Payroll Processing Services',
        'Cash Flow Management Services',
        'Inventory Accounting',
        'Financial Analysis and Reporting',
    ];

    $whyChoose = [
        ['icon' => 'increased-efficiency.webp', 'alt' => 'Increased Efficiency', 'title' => 'Quick Turnaround'],
        ['icon' => 'cost-reduction.webp', 'alt' => 'Cost Reduction', 'title' => 'End-to-End Data Security'],
        ['icon' => 'enhanced-competitiveness.webp', 'alt' => 'Enhanced Competitiveness', 'title' => 'Flexible Round-the-Clock Availability'],
        ['icon' => 'time-savings.webp', 'alt' => 'time Savings', 'title' => 'Compliance With Tax Regulations'],
        ['icon' => 'compliance-and-regulatory-adherence.webp', 'alt' => 'Compliance and Regulatory Adherence', 'title' => 'Industry-Specific Expertise'],
        ['icon' => 'advanced-technology-and-infrastructure.webp', 'alt' => 'Advanced Technology and Infrastructure', 'title' => 'Accurate Cost Tracking'],
        ['icon' => 'scalability-and-flexibility.webp', 'alt' => 'Scalability and Flexibility', 'title' => 'Financial Analysis and Reporting'],
        ['icon' => 'data-security-and-privacy.webp', 'alt' => 'Data Security and Privacy', 'title' => 'Expertise in Inventory Management'],
    ];

    $stats = [
        ['value' => '30+', 'label' => 'Industry Served'],
        ['value' => '27+', 'label' => 'Years of Experience'],
        ['value' => '1400+', 'label' => 'Active Global Clients'],
        ['value' => '50%', 'label' => 'Save operational cost'],
        ['value' => '95%', 'label' => 'Client Retention Rate'],
        ['value' => '99.99%', 'label' => 'Accuracy in Deliverables'],
        ['value' => '21+', 'label' => 'Accounting Software Expertise'],
        ['value' => '120+', 'label' => 'Qualified & Certified Bookkeepers'],
        ['value' => '10+', 'label' => 'Client-centric Account Managers'],
    ];

    $testimonials = [
        [
            'quote' => 'We have been with IBN for just a short of year now, and we are extremely happy with the service. They provide support and back-office accounts for us. The response time is often less than an hour and they have become instrumental in our daily running and have been able to tackle big projects without any problems. They are very professional, efficient and reliable and provide the results that we need, often on short notice. IBN are by far the best accountants I have worked with, and I would highly recommend IBN for anyone looking for an account’s solution.',
            'cite' => 'Janikin Rooke Contracts',
        ],
        [
            'quote' => 'We have been utilizing IBN now for about 6months, initially we were reluctant to allow access to our sensitive information, but we soon overcame these challenges. We have been working closely with Aniket the entire time, he is our dedicated reprehensive and we really enjoy his service. He started by doing standard banking reconciling for all our accounts. This has graduated to Invoicing, Banking, A/R Reporting, Imports & Exports, weekly P&L & journal entries. Not only has this really helped us streamline our process, but our overall Local accounting cost have been cut in half.',
            'cite' => 'RLCS Inc',
        ],
        [
            'quote' => 'We’ve had the opportunity to work with IBN Tech for over a year now and really enjoy the services they provide. The team is incredibly responsive, and the quality of work is wonderful – they are just an overall pleasure to work with.',
            'cite' => 'Mandi Loayza, Carnahan Group',
        ],
        [
            'quote' => 'I first searched for an outsourcing company based in India via google. There were 100’s of choices and not being based in India or heard of any of the companies, I really did not know who to use so I clicked on IBN and arranged for a call. Although the cost was to my liking, it was the total professionalism of the people I spoke to initially and then to the people who were going to take care of me on a daily/weekly basis that impressed me the most. Once the work got started and I saw their spreadsheets and work patterns, and their total understanding of my work, I realized how good they are. IBN has made my life easier to take more clients on and then to be cheeky enough to help with the workload so that I can offer the client other services. There might be 100 similar companies out there, but this is the one for me!',
            'cite' => 'AKS Accountants',
        ],
        [
            'quote' => 'The IBN team is great to work with and communicates efficiently and timely. They provided substantial assistance with our company needs and helped us push through projects.',
            'cite' => 'Sampson Business Solutions LLC',
        ],
        [
            'quote' => 'IBN has been providing excellent accounting services to our company for many years. Their staff is highly knowledgeable in GAAP standards. They perform very detailed analyses of all aspects of accounts and provide very professional reports. I would highly recommend them.',
            'cite' => 'Graviton Consulting Services',
        ],
    ];

    $checkSvg = '<svg aria-hidden="true" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path></svg>';
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/manufacturing-accounting-and-bookkeeping-services.css'])
@endpush

@section('content')
    <div class="mabk-page">
        {{-- Hero --}}
        <section class="mabk-hero" aria-labelledby="mabk-hero-title">
            <div class="site-shell mabk-hero__inner">
                <div class="mabk-hero__copy">
                    <h1 id="mabk-hero-title">Manufacturing Accounting and Bookkeeping Services</h1>
                    <p class="mabk-hero__lede">
                        Streamline your manufacturing finances with expert bookkeeping that covers everything from raw material tracking to final product sales, ensuring efficient operations and accurate records
                    </p>
                    <a href="#" class="mabk-btn mabk-btn--green" data-contact-modal-trigger>
                        Get started now
                    </a>
                </div>
                <div class="mabk-hero__media">
                    <img
                        src="{{ $img('banner-2-1.webp') }}"
                        alt="Manufacturing Bookkeeping"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro card --}}
        <section class="mabk-intro" aria-labelledby="mabk-intro-title">
            <div class="site-shell">
                <div class="mabk-intro__card">
                    <h2 id="mabk-intro-title">Streamline Your Production Finances with Expert Bookkeeping Solutions</h2>
                    <p>
                        Accuracy, efficiency, and reliability are crucial in manufacturing accounting. Companies must maintain inventory controls, manage vendor relationships, and meet compliance requirements. We serve companies in the
                        <strong><a href="{{ $pageUrl('bookkeeping-services-usa') }}">USA</a></strong>
                        and
                        <strong><a href="{{ $pageUrl('bookeeping-for-uk') }}">UK</a></strong>,
                        streamlining accounting processes to make businesses more efficient, competitive, and profitable. Our experts integrate accounting with budgeting and strategic planning, offering a comprehensive view of your financials
                    </p>
                </div>
            </div>
        </section>

        {{-- Comprehensive financial solutions --}}
        <section class="mabk-solutions" aria-labelledby="mabk-solutions-title">
            <div class="site-shell mabk-solutions__inner">
                <div class="mabk-solutions__copy">
                    <h2 id="mabk-solutions-title">
                        Comprehensive Financial Solutions Tailored for the Manufacturing Industry
                    </h2>
                    <ul class="mabk-solutions__lists">
                        @foreach ($serviceItems as $item)
                            <li>
                                <span class="mabk-check" aria-hidden="true">{!! $checkSvg !!}</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mabk-solutions__media">
                    <img
                        src="{{ $img('comprehensive-financial-solutions-tailored-for-the-manufacturing-industry.webp') }}"
                        alt="Comprehensive Financial Solutions Tailored for the Manufacturing Industry"
                        width="1080"
                        height="1080"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>

            <div class="site-shell mabk-solutions__cta">
                <p>
                    Save up to 50% on operational costs with our expert bookkeeping services and shift your focus to what truly matters—innovation and expansion
                </p>
                <a href="#" class="mabk-btn mabk-btn--green" data-contact-modal-trigger>
                    Get Started
                </a>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="mabk-software" aria-labelledby="mabk-software-title">
            <div class="site-shell mabk-software__inner">
                <div class="mabk-software__copy">
                    <h2 id="mabk-software-title">
                        <span>Software</span>
                        <span class="mabk-software__accent">Expertise</span>
                    </h2>
                    <p>
                        Our expert solutions ensure smooth data flow and enhanced efficiency across your accounting and financial systems. Boost performance and optimize processes with our seamless integration services.
                    </p>
                </div>
                <div class="mabk-software__media">
                    <img
                        src="{{ $img('software-logo.webp') }}"
                        alt="Software Expertise provided by IBN technologies"
                        width="800"
                        height="520"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Why choose --}}
        <section class="mabk-why" aria-labelledby="mabk-why-title">
            <div class="site-shell mabk-why__inner">
                <div class="mabk-why__lead">
                    <h2 id="mabk-why-title">
                        Why Our Bookkeeping Services Are a Top Choice for Manufacturing Companies
                    </h2>
                    <div class="mabk-why__media">
                        <img
                            src="{{ $img('why-our-bookkeeping-services-are-a-top-choice-for-manufacturing-companies.webp') }}"
                            alt="Why Our Bookkeeping Services Are a Top Choice for Manufacturing Companies"
                            width="1080"
                            height="1080"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <a href="#" class="mabk-btn mabk-btn--green" data-contact-modal-trigger>
                        Get Started
                    </a>
                </div>

                <div class="mabk-why__grid" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="mabk-why__card" role="listitem">
                            <img
                                src="{{ $img($item['icon']) }}"
                                alt="{{ $item['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $item['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Success indicators --}}
        <section class="mabk-success" aria-labelledby="mabk-success-title">
            <div class="site-shell">
                <h2 id="mabk-success-title">Success Indicators</h2>
                <ul class="mabk-success__grid">
                    @foreach ($stats as $item)
                        <li class="mabk-success__item">
                            <p class="mabk-success__value">{{ $item['value'] }}</p>
                            <h3>{{ $item['label'] }}</h3>
                        </li>
                    @endforeach
                </ul>
                <div class="mabk-success__cta">
                    <a
                        href="#request-form-demo"
                        class="mabk-btn mabk-btn--green mabk-btn--wide"
                        data-contact-modal-trigger
                    >
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- Consultation CTA --}}
        <section class="mabk-consult" aria-labelledby="mabk-consult-title" id="request-form-demo">
            <div class="site-shell mabk-consult__inner">
                <h2 id="mabk-consult-title">
                    Outsource your manufacturing bookkeeping—track transactions, reconcile accounts, and value inventory with precision. Get accurate reports and effective cash flow solutions today!
                </h2>
                <a href="#" class="mabk-btn mabk-btn--green mabk-btn--wide" data-contact-modal-trigger>
                    Schedule a Free Consultation Now
                </a>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="mabk-testimonials" aria-labelledby="mabk-testimonials-title">
            <div class="site-shell">
                <div class="mabk-testimonials__heading">
                    <p class="mabk-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="mabk-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="mabk-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="mabk-testimonials__nav mabk-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="mabk-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="mabk-testimonial{{ $i === 0 ? ' is-active' : '' }}"
                                :class="{ 'is-active': index === {{ $i }} }"
                                :aria-hidden="index !== {{ $i }}"
                            >
                                <p>{{ $item['quote'] }}</p>
                                <cite>{{ $item['cite'] }}</cite>
                            </blockquote>
                        @endforeach
                    </div>

                    <button
                        type="button"
                        class="mabk-testimonials__nav mabk-testimonials__nav--next"
                        @click="next()"
                        aria-label="Next testimonial"
                    >
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>

                <p class="mabk-testimonials__all">
                    <a href="{{ $pageUrl('testimonials') }}">VIEW ALL CLIENT TESTIMONIALS</a>
                </p>
            </div>
        </section>
    </div>
@endsection
