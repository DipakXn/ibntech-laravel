@php
    $img = fn (string $file): string => asset('images/retail/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
        'Other',
    ];

    $services = [
        [
            'title' => '1. Data Processing Services',
            'image' => 'data-processing-services.webp',
            'alt' => 'data processing services',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Inventory Management:',
                    'text' => ' Never lose a sale due to stock outs with real-time inventory management. Our data processing services ensure you always have the right inventory on hand to fulfill customer orders and maximize your profits.',
                ],
                [
                    'title' => 'Customer Data Analysis:',
                    'text' => ' Discover the hidden buying patterns and preferences of your customers with our data analysis experts. This information can be used to create targeted marketing campaigns that drive sales and boost your bottom line.',
                ],
                [
                    'title' => 'Supply Chain Data Management:',
                    'text' => ' Drowning in data from different points in your supply chain? IBN Tech streamlines data management, providing real-time visibility into your entire operation. This empowers you to make informed decisions quickly, ensuring efficient deliveries, reduced costs, and happier customers.',
                ],
            ],
        ],
        [
            'title' => '2. Finance and Accounting Services',
            'image' => 'finance-and-accounting-services.webp',
            'alt' => 'finance and accounting services',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Cash Flow Management:',
                    'text' => ' Worried about navigating seasonal sales fluctuations? Our cash flow management experts help you optimize your cash flow, considering the unique seasonality of the retail industry. This ensures you have the financial flexibility to weather any storm and capitalize on growth opportunities.',
                ],
                [
                    'title' => 'Expense Tracking and Management:',
                    'text' => ' IBN Tech provides a clear picture of your financial landscape by tracking and managing various costs, including inventory purchases, operational expenses, and marketing costs. This allows you to identify areas for improvement and optimize your budget for maximum efficiency.',
                ],
                [
                    'title' => 'Margin Analysis:',
                    'text' => ' Not sure if your pricing strategy is optimized for profitability? We conduct in-depth margin analysis to provide insights into the true profitability of each product. This empowers you to set optimal retail prices, maximize your margins, and make informed decisions about stocking and promotions.',
                ],
                [
                    'title' => 'Financial Compliance:',
                    'text' => ' Concerned about staying compliant with complex retail regulations? IBN Tech handles the complexities of sales tax collection and remittance, giving you the freedom to focus on your business growth without compliance worries.',
                ],
            ],
        ],
        [
            'title' => '3. Bookkeeping Services',
            'image' => 'bookkeeping-services-1.webp',
            'alt' => 'bookkeeping services',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Sales and Revenue Tracking:',
                    'text' => ' Never lose track of your sales or revenue again. Our meticulous sales and revenue tracking provides a clear and accurate picture of your financial performance, empowering you to make data-driven decisions that drive growth.',
                ],
                [
                    'title' => 'Vendor Invoice Management:',
                    'text' => ' Overwhelmed by managing invoices from multiple suppliers? IBN Tech streamlines this process by reconciling invoices with inventory receipts, ensuring accuracy and efficiency. This frees up your valuable time to focus on other crucial tasks and foster better relationships with your suppliers.',
                ],
                [
                    'title' => 'Account Reconciliation:',
                    'text' => ' Imagine never having to worry about the accuracy of your financial records. IBN Tech performs regular reconciliations of all your accounts, ensuring financial integrity and providing a solid foundation for sound business decisions.',
                ],
            ],
        ],
        [
            'title' => '4. AP/AR Management',
            'image' => 'apar-management.webp',
            'alt' => 'apar management',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Vendor Payment Scheduling:',
                    'text' => ' Never again miss a supplier payment and risk stock outs! IBN Tech facilitates smooth vendor payment scheduling, ensuring uninterrupted inventory supply and maintaining positive supplier relationships.',
                ],
                [
                    'title' => 'Customer Credit Management:',
                    'text' => ' Are you concerned about managing customer credit and ensuring healthy cash flow? IBN Tech provides efficient customer credit management, especially in B2B transactions. This allows you to extend credit responsibly, minimize bad debt, and maintain financial stability.',
                ],
                [
                    'title' => 'Debt Collection:',
                    'text' => ' Say goodbye to overdue invoices! IBN Tech\'s streamlined debt collection process helps you recover outstanding debts quickly, improve your cash flow, and free up valuable resources. This allows you to invest in your business and achieve your goals faster.',
                ],
            ],
        ],
        [
            'title' => '5. Payroll Processing',
            'image' => 'payroll-processing.webp',
            'alt' => 'payroll processing',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Handling Diverse Workforce Pay:',
                    'text' => ' Are you overwhelmed by the complexities of managing payroll for your diverse workforce? IBN Tech takes the weight off your shoulders, ensuring accurate and compliant payroll processing for everyone, from full-time employees to seasonal workers.',
                ],
                [
                    'title' => 'Compliance with Labor Laws:',
                    'text' => ' Say goodbye to the stress of complex labor regulations! Our experts ensure your payroll processes comply with all relevant laws, including minimum wage, overtime, and work hours.',
                ],
                [
                    'title' => 'Employee Benefits Management:',
                    'text' => ' Free up your time and resources by letting IBN Tech handle employee benefits. We seamlessly administer health insurance, retirement plans, and other valuable benefits, ensuring your employees have access to the support they need.',
                ],
            ],
        ],
        [
            'title' => '6. CFO Services',
            'image' => 'cfo-services.webp',
            'alt' => 'cfo services',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Strategic Financial Planning:',
                    'text' => ' Do you feel lost when it comes to developing strategic financial plans for your growing business? IBN Tech\'s experienced CFOs work side-by-side with you to chart a course for success. Whether you\'re planning expansions, opening new stores, or venturing into the online retail space, we provide the expertise to chart a course for success.',
                ],
                [
                    'title' => 'Budgeting and Forecasting:',
                    'text' => ' Make every dollar count with precise budgeting and forecasting With our CFOs analyze your past performance and market trends to create realistic budgets that fuel your growth initiatives.',
                ],
                [
                    'title' => 'Risk Management:',
                    'text' => ' Worried about unforeseen financial risks? Our CFOs will help you identify and mitigate potential threats, from economic shifts to changing consumer behavior. Get peace of mind knowing your finances are in expert hands.',
                ],
            ],
        ],
    ];

    $stats = [
        ['value' => '26+', 'label' => 'Years of Success', 'tone' => 'light'],
        ['value' => '10000+', 'label' => 'Clients Served', 'tone' => 'navy'],
        ['value' => '50M', 'label' => 'Transaction Processed', 'tone' => 'light'],
        ['value' => '99.99 %', 'label' => 'Accuracy Achieved', 'tone' => 'navy'],
    ];

    $testimonials = [
        [
            'quote' => 'We are now entering the fourth year of our relationship with IBN. This has been a hugely rewarding and valuable transaction for us with IBN as they are now responsible for',
            'cite' => 'David Barber',
        ],
        [
            'quote' => 'IBN financial support is a top-class accounting services outsourcer. They act with speed in getting work done, and mobilizing additional resources as needed. Their greatest strength is pro-active communication with clients. I consider IBN a strong partner.',
            'cite' => 'Salman Ghani',
        ],
        [
            'quote' => 'After approaching IBN with a complex and bespoke requirement, I’ve been impressed with the professionalism and knowledge of my technical contact and other',
            'cite' => 'DANIEL SCOTT',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/retail.css'])
@endpush

@section('content')
    <div class="ret-page">
        {{-- Hero --}}
        <section class="ret-hero" aria-labelledby="ret-hero-title">
            <div class="site-shell ret-hero__inner">
                <div class="ret-hero__copy">
                    <p class="ret-hero__eyebrow">Unlock Retail Success with IBN Tech's</p>
                    <h1 id="ret-hero-title">Retail Business Process Outsourcing Services.</h1>
                    <p class="ret-hero__lede">
                        From precise data processing to strategic CFO services, we've got your retail challenges covered. Experience streamlined operations and accelerated growth with our dedicated solutions.
                    </p>
                    <div class="ret-hero__actions">
                        <a href="#contact-us" class="ret-btn ret-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="ret-hero__media">
                    <img
                        src="{{ $img('retail-business.webp') }}"
                        alt="retail business"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="ret-section" aria-labelledby="ret-intro-title">
            <div class="site-shell ret-split">
                <div class="ret-split__media">
                    <img
                        src="{{ $img('ibn-tech-stands-as-a-leader-in-retail-process.webp') }}"
                        alt="ibn tech stands as a leader in retail process"
                        width="300"
                        height="300"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="ret-split__copy">
                    <h2 id="ret-intro-title" class="sr-only">Retail process outsourcing</h2>
                    <p>
                        IBN Tech stands as a leader in retail process outsourcing, transforming how retail businesses function. We focus on operational management as well as growth and productivity enhancement. By overseeing routine tasks, we empower retailers to unlock new revenue channels and opportunities. Our services blend cost-efficient solutions with deep industry knowledge, providing our clients with a competitive advantage in the ever-changing retail landscape. With IBN Tech, retailers receive more than outsourcing services; they gain a strategic ally dedicated to their success in the dynamic retail sector.
                    </p>
                    <a href="#contact-us" class="ret-btn ret-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Services --}}
        <section class="ret-section ret-section--tight" aria-labelledby="ret-services-title">
            <div class="site-shell">
                <div class="ret-heading">
                    <h2 id="ret-services-title">Retail Process Outsourcing Services</h2>
                    <p class="ret-heading__sub">for your Retail Business</p>
                </div>

                @foreach ($services as $service)
                    <article class="ret-split{{ $service['imageRight'] ? '' : ' ret-split--flip' }}">
                        <div class="ret-split__copy">
                            <h3>{{ $service['title'] }}</h3>
                            @foreach ($service['points'] as $point)
                                <p>
                                    <strong>{{ $point['title'] }}</strong>{{ $point['text'] }}
                                </p>
                            @endforeach
                            <a href="#contact-us" class="ret-btn ret-btn--navy">
                                Get a Free Consultation Today
                            </a>
                        </div>
                        <div class="ret-split__media">
                            <img
                                src="{{ $img($service['image']) }}"
                                alt="{{ $service['alt'] }}"
                                width="560"
                                height="444"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- Stats --}}
        <section class="ret-section ret-section--soft" aria-labelledby="ret-stats-title">
            <div class="site-shell">
                <div class="ret-heading">
                    <h2 id="ret-stats-title">Why Choose IBN Tech as Your</h2>
                    <p class="ret-heading__sub">Retail Business Process Outsourcing?</p>
                </div>

                <div class="ret-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="ret-stat ret-stat--{{ $stat['tone'] }}" role="listitem">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="ret-banner" aria-labelledby="ret-banner-title">
            <div class="site-shell ret-banner__inner">
                <h2 id="ret-banner-title">Transform Your Retail Business Operations</h2>
                <p>Discover How Our BPO Services Can Streamline Your Processes, Elevate Customer Experience, and Drive Sales Growth!</p>
                <a href="#contact-us" class="ret-btn ret-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="ret-section ret-consult"
            id="contact-us"
            aria-labelledby="ret-consult-title"
        >
            <div class="site-shell ret-consult__inner">
                <aside class="ret-consult__card" aria-labelledby="ret-consult-title">
                    <div class="ret-consult__header">
                        <h2 id="ret-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="ret-consult__body">
                        <livewire:forms.contact-form
                            form-name="retail"
                            id-prefix="ret"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="Briefly Describe Your Needs"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>
                <div class="ret-consult__media">
                    <img
                        src="{{ $img('schedule-a-call-with-our-experts.webp') }}"
                        alt="schedule a call with our experts"
                        width="400"
                        height="269"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="ret-testimonials" aria-labelledby="ret-testimonials-title">
            <div class="site-shell">
                <div class="ret-heading">
                    <p class="ret-testimonials__eyebrow">Discover Why IBN Tech Leads in</p>
                    <h2 id="ret-testimonials-title">Bookkeeping Services</h2>
                </div>

                <div
                    class="ret-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="ret-testimonials__nav ret-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
                        </svg>
                    </button>

                    <div class="ret-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="ret-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="ret-testimonials__nav ret-testimonials__nav--next"
                        @click="next()"
                        aria-label="Next testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M696 533C708 521 713 504 713 487 713 471 708 454 696 446L400 146C388 133 375 125 354 125 338 125 325 129 313 142 300 154 292 171 292 187 292 204 296 221 308 233L563 492 304 771C292 783 288 800 288 817 288 833 296 850 308 863 321 871 338 875 354 875 371 875 388 867 400 854L696 533Z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </section>
    </div>
@endsection
