@php
    $img = fn (string $file): string => asset('images/hospitality/'.$file);

    $services = [
        [
            'title' => '1. Data Processing Services',
            'image' => 'data-processing-services-1.webp',
            'alt' => 'data processing services',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Managing High Volume of Data:',
                    'text' => ' Overwhelmed by the sheer volume of booking data, customer feedback, and operational information? Our data processing solutions are tailored to manage high volumes efficiently, ensuring you make informed decisions swiftly.',
                ],
                [
                    'title' => 'Seamless Platform Integration:',
                    'text' => ' Imagine having all your data, from bookings to feedback, in one place. Our seamless platform integration gives you a complete picture, empowering you to make smarter, data-driven decisions.',
                ],
                [
                    'title' => 'Upholding Data Security and Privacy:',
                    'text' => ' Your data is safe with us. We employ the highest security standards and adhere to strict international data protection laws, ensuring your customers\' information is always protected',
                ],
            ],
        ],
        [
            'title' => '2. Finance and Accounting',
            'image' => 'finance-and-accounting.webp',
            'alt' => 'finance and accounting',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Mastering Revenue Management:',
                    'text' => ' Juggling diverse revenue streams? We expertly manage your financial portfolio, from room bookings to additional services, ensuring optimal revenue flow.',
                ],
                [
                    'title' => 'Tax Law Compliance:',
                    'text' => ' Don\'t stress about taxes! Our expert team keeps you compliant with local and international regulations, mitigating risks and avoiding penalties, so you can focus on running your business.',
                ],
                [
                    'title' => 'Adapting to Seasonal Shifts:',
                    'text' => ' Don\'t let your profits fluctuate! Our financial strategies adapt to seasonal variations, so your budget stays rock-solid, all year long.',
                ],
            ],
        ],
        [
            'title' => '3. Bookkeeping',
            'image' => 'bookkeeping-1.webp',
            'alt' => 'bookkeeping',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Meticulous Transaction Tracking:',
                    'text' => ' Our detailed tracking systems capture every transaction, from guest check-ins to cancellations, ensuring unwavering accuracy and transparency.',
                ],
                [
                    'title' => 'Real-Time Financial Record:',
                    'text' => ' Gain instant control over your finances! Our real-time financial records provide crucial, up-to-date information, empowering you to make timely decisions and achieve financial transparency.',
                ],
                [
                    'title' => 'Unlock efficiency and save time:',
                    'text' => ' Automate tedious tasks like data entry and reconciliation, freeing you to focus on growing your business.',
                ],
            ],
        ],
        [
            'title' => '4. AP/AR Management',
            'image' => 'apar-management-1.webp',
            'alt' => 'apar management',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Customer Deposit and Refund Handling:',
                    'text' => ' Never miss a deposit or refund again! Our efficient system handles customer deposits for bookings and processes refunds smoothly, ensuring positive cash flow and happy customers.',
                ],
                [
                    'title' => 'Strengthening Supplier Relationships:',
                    'text' => ' Our efficient accounts payable system takes the burden off your shoulders, allowing you to focus on building trust and negotiating better deals. No more missed payments, no more strained relationships!',
                ],
            ],
        ],
        [
            'title' => '5. Payroll Processing',
            'image' => 'payroll-processing-1.webp',
            'alt' => 'payroll processing',
            'imageRight' => true,
            'points' => [
                [
                    'title' => 'Accurate Handling of Tips and Service Charges:',
                    'text' => ' Eliminate the administrative burden of handling tips and service charges. We ensure fair and correct distribution and reporting, freeing you to focus on running your business.',
                ],
                [
                    'title' => 'Workforce Payroll Diversity:',
                    'text' => ' Seamlessly manage payroll for a diverse workforce. We handle everything from shift differences to contract variations with precision and care, so you can rest assured your employees are paid accurately and on time.',
                ],
                [
                    'title' => 'Labor Law Expertise:',
                    'text' => ' Rest easy knowing IBN Tech ensures full compliance with varying labor laws across regions and countries.',
                ],
            ],
        ],
        [
            'title' => '6. CFO Services',
            'image' => 'cfo-services-1.webp',
            'alt' => 'cfo services',
            'imageRight' => false,
            'points' => [
                [
                    'title' => 'Maximize Revenue and Control Costs:',
                    'text' => ' Elevate your hospitality business with our expert CFO services. We specialize in optimizing your RevPAR strategies and cost management, ensuring higher occupancy rates, optimal pricing, and efficient operations.',
                ],
                [
                    'title' => 'Tech and Infrastructure Investment:',
                    'text' => ' Invest smarter, not harder. With our CFO\'s guidance you on strategically invest in technology and infrastructure that will enhance your guest experience, improve operational efficiency, and boost your bottom line.',
                ],
                [
                    'title' => 'Performance Analysis and Benchmarking:',
                    'text' => ' Gain a clear understanding of your financial performance and identify areas for improvement. Our CFOs will compare your performance to industry benchmarks, providing valuable insights to help you make data-driven decisions and achieve continuous growth.',
                ],
            ],
        ],
    ];

    $stats = [
        ['value' => '27+', 'label' => 'Years of Success', 'tone' => 'light'],
        ['value' => '10000+', 'label' => 'Clients Served', 'tone' => 'navy'],
        ['value' => '50M', 'label' => 'Transaction Processed', 'tone' => 'light'],
        ['value' => '99.99 %', 'label' => 'Accuracy Achieved', 'tone' => 'navy'],
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

    $faqs = [
        [
            'question' => 'What bookkeeping services do you provide for real estate businesses?',
            'answer' => 'Our comprehensive bookkeeping services for real estate businesses include financial reporting, bank reconciliations, accounts payable and receivable, payroll processing, and cash flow management. We specialize in catering to the unique financial aspects of real estate transactions, property management, and investment tracking.',
        ],
        [
            'question' => 'How much do your bookkeeping services cost for construction companies?',
            'answer' => 'Our bookkeeping service costs for construction companies are customized based on the specific needs and size of your business. We understand that each construction project is unique, and our pricing reflects the level of detail and complexity required. Contact us for a personalized quote that aligns with your company’s financial requirements.',
        ],
        [
            'question' => 'Can your bookkeeping services sync with my existing real estate management software?',
            'answer' => 'Yes, our bookkeeping services are designed to seamlessly integrate with leading real estate management software systems. We ensure a smooth integration process with your existing setup, allowing for real-time financial tracking and reporting without disrupting your ongoing operations.',
        ],
        [
            'question' => 'What measures do you take to secure my financial data?',
            'answer' => 'IBN Tech prioritizes the security of your financial data with a multi-layered approach that includes encryption, secure servers, and strict access controls. Our team is trained in data privacy laws and best practices to ensure your sensitive information is handled with the utmost care and confidentiality.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/hospitality.css'])
@endpush

@section('content')
    <div class="hosp-page">
        {{-- Hero --}}
        <section class="hosp-hero" aria-labelledby="hosp-hero-title">
            <div class="site-shell hosp-hero__inner">
                <div class="hosp-hero__copy">
                    <p class="hosp-hero__eyebrow">Transform Your Hospitality Business with IBN Tech's</p>
                    <h1 id="hosp-hero-title">Hospitality Outsourcing Services</h1>
                    <p class="hosp-hero__lede">
                        Experience seamless operations from booking to checkout. IBN Tech's BPO services redefine hospitality, ensuring unparalleled guest satisfaction and operational excellence.
                    </p>
                    <div class="hosp-hero__actions">
                        <a href="#contact-us" class="hosp-btn hosp-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="hosp-hero__media">
                    <img
                        src="{{ $img('hospitality-outsourcing.webp') }}"
                        alt="hospitality outsourcing"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="hosp-section" aria-labelledby="hosp-intro-title">
            <div class="site-shell hosp-split">
                <div class="hosp-split__media">
                    <img
                        src="{{ $img('at-ibn-tech-we-understand-the.webp') }}"
                        alt="at ibn tech, we understand the"
                        width="500"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="hosp-split__copy">
                    <h2 id="hosp-intro-title" class="sr-only">Hospitality back-office outsourcing</h2>
                    <p>
                        At IBN Tech, we understand the challenges faced by executives in the hospitality industry, such as high operational costs and the need to stay technologically up-to-date. We recognize that the industry's success hinges on customer satisfaction, which can be impacted by unpredictability and back-office inefficiencies. That's where our expertise comes in. We offer specialized outsourcing services tailored specifically for hotels, resorts, and food service providers. Our focus is on enhancing your efficiency and profitability, by managing those crucial yet time-consuming back-office operations. This allows you to devote more resources and attention to what matters: delivering outstanding guest experiences.
                    </p>
                    <a href="#contact-us" class="hosp-btn hosp-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Services --}}
        <section class="hosp-section hosp-section--tight" aria-labelledby="hosp-services-title">
            <div class="site-shell">
                <div class="hosp-heading">
                    <h2 id="hosp-services-title">
                        Outsourcing in hospitality industry<br>
                        for Hotels, Resorts, and REITs
                    </h2>
                </div>

                @foreach ($services as $service)
                    <article class="hosp-split{{ $service['imageRight'] ? '' : ' hosp-split--flip' }}">
                        <div class="hosp-split__copy">
                            <h3>{{ $service['title'] }}</h3>
                            @foreach ($service['points'] as $point)
                                <p>
                                    <strong>{{ $point['title'] }}</strong>{{ $point['text'] }}
                                </p>
                            @endforeach
                            <a href="#contact-us" class="hosp-btn hosp-btn--navy">
                                Get a Free Consultation Today
                            </a>
                        </div>
                        <div class="hosp-split__media">
                            <img
                                src="{{ $img($service['image']) }}"
                                alt="{{ $service['alt'] }}"
                                width="500"
                                height="500"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- Stats --}}
        <section class="hosp-section hosp-section--soft" aria-labelledby="hosp-stats-title">
            <div class="site-shell">
                <div class="hosp-heading">
                    <h2 id="hosp-stats-title">What Makes IBN Tech the</h2>
                    <p class="hosp-heading__sub">Outsourcing Your Travel Business Processes?</p>
                </div>

                <div class="hosp-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="hosp-stat hosp-stat--{{ $stat['tone'] }}" role="listitem">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="hosp-banner" aria-labelledby="hosp-banner-title">
            <div class="site-shell hosp-banner__inner">
                <h2 id="hosp-banner-title">Elevate Your Hospitality Operations</h2>
                <p>Discover How Our Outsourcing Solutions Can Transform Your Business, Elevate Guest Experiences, and Drive Growth!</p>
                <a href="#contact-us" class="hosp-btn hosp-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="hosp-testimonials" aria-labelledby="hosp-testimonials-title">
            <div class="site-shell">
                <div class="hosp-heading">
                    <p class="hosp-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="hosp-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="hosp-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="hosp-testimonials__nav hosp-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
                        </svg>
                    </button>

                    <div class="hosp-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="hosp-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="hosp-testimonials__nav hosp-testimonials__nav--next"
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

        {{-- FAQ --}}
        <section class="hosp-section" aria-labelledby="hosp-faq-title">
            <div class="site-shell">
                <div class="hosp-heading">
                    <h2 id="hosp-faq-title">Frequently Asked Questions (FAQ)</h2>
                </div>

                <div class="hosp-faq">
                    @foreach ($faqs as $i => $faq)
                        <details @if ($i === 0) open @endif>
                            <summary>
                                <span>{{ $faq['question'] }}</span>
                            </summary>
                            <div>{{ $faq['answer'] }}</div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
