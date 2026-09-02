@php
    $img = fn (string $file): string => asset('images/quote-to-cash/'.$file);
    $consultUrl = route('page.show', ['slug' => 'free-consultation']);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);

    $processItems = [
        [
            'title' => 'Sales and Order Processing',
            'items' => [
                'Generating quotes and processing orders',
                'Handling billing and invoicing',
                'Creating credit/debit notes',
                'Applying for cash payments',
                'Processing customer refunds',
            ],
        ],
        [
            'title' => 'Credit and Financial Management',
            'items' => [
                'Analyzing credit and providing decision support',
                'Managing deduction accounting',
                'Managing collections',
            ],
        ],
        [
            'title' => 'Customer Data Management and Account Operations',
            'items' => [
                'Managing customer master data',
                'Reconciling customer accounts',
            ],
        ],
        [
            'title' => 'Customer Support and Issue Resolution',
            'items' => [
                'Resolving disputes',
                'Addressing customer queries',
            ],
        ],
        [
            'title' => 'Reporting and Period-End Processes',
            'items' => [
                'Analyzing credit and providing decision support',
                'Managing deduction accounting',
                'Managing collections',
            ],
        ],
    ];

    $solutions = [
        [
            'icon' => 'invoice-generation.png',
            'alt' => 'Invoice generation',
            'title' => 'Enhance Financial Insights',
            'text' => 'With our solutions, you gain a comprehensive view of billing and revenue, ensuring precise revenue recognition.',
        ],
        [
            'icon' => 'liaison-with-tax-advisors.png',
            'alt' => 'Liaison with tax advisors',
            'title' => 'Seamless Integration',
            'text' => 'Our platform effortlessly integrates with your existing enterprise systems, ensuring a smooth transition without disruptions.',
        ],
        [
            'icon' => 'invoice-generation.png',
            'alt' => 'Invoice generation',
            'title' => 'Strategic Automation',
            'text' => 'Save valuable time by automating key processes strategically, and streamlining your operations for productivity gains.',
        ],
        [
            'icon' => 'automatic-invoice-processing-and-payment.png',
            'alt' => 'Automatic Invoice Processing and Payment',
            'title' => 'Optimize Resource Management',
            'text' => 'Efficiently manage projects and resources, allowing you to allocate resources effectively and improve overall productivity.',
        ],
        [
            'icon' => 'improve-financial-performance-icon.webp',
            'alt' => 'improve-financial-performance-icon',
            'title' => 'Improve Financial Performance',
            'text' => 'Experience a remarkable 30-65% boost in overall performance, leading to improved cash flows and enhanced business metrics.',
        ],
        [
            'icon' => 'enhance-customer-experience-icon2.webp',
            'alt' => 'enhance customer experience-icon2',
            'title' => 'Enhance Customer Experience',
            'text' => 'Minimize instances of fraud and default rates while providing exceptional service to your customers, ensuring their satisfaction.',
        ],
    ];

    $faqs = [
        [
            'question' => '1. Who owns quote-to-cash process?',
            'answer' => 'The ownership of the Quote-to-Cash (QTC) process typically falls under the purview of cross-functional teams comprising sales, finance, and operations. It\'s a collaborative effort to ensure accuracy and efficiency throughout. Many businesses choose to outsource specific aspects of the QTC process to expert service providers. Outsourcing can bring in specialized knowledge and skills, ensuring that each element of the process is managed efficiently.',
        ],
        [
            'question' => '2. How can businesses optimize their Quote to Cash process?',
            'answer' => 'Businesses can optimize their Quote-to-Cash process by partnering with outsourcing experts such as IBN Tech who specialize in QTC operations. Outsourcing providers streamline workflows, automate repetitive tasks, and enhance communication between different teams, thus improving the overall efficiency of the process.',
        ],
        [
            'question' => '3. How does CPQ software fit into the Quote-to-Cash process?',
            'answer' => 'Configure, Price, Quote (CPQ) software plays a pivotal role in the Quote-to-Cash process by enabling businesses to create accurate quotes, configure complex products, set pricing rules, and generate quotes swiftly, ensuring consistency and accuracy in sales quotes.',
        ],
        [
            'question' => '4. Why is automation important in the QTC process?',
            'answer' => 'Automation is crucial in the QTC process to eliminate manual errors, reduce processing time, enhance customer experiences, and improve overall operational efficiency. It enables businesses to respond quickly to customer requests and adapt to changing market conditions, ultimately driving profitability and customer satisfaction.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/quote-to-cash.css'])
@endpush

@section('content')
    <div class="q2c-page">
        {{-- Hero --}}
        <section class="q2c-hero" aria-labelledby="q2c-hero-title">
            <div class="site-shell q2c-hero__inner">
                <p class="q2c-hero__eyebrow">Boost Your Business Performance with</p>
                <h1 id="q2c-hero-title">Quote-to-Cash Process Outsourcing</h1>
                <p class="q2c-hero__lede">
                    From estimating services to billing and revenue recognition, IBN Tech's end-to-end solution handles it all, unlocking your business's full potential.
                </p>
                <a href="{{ $consultUrl }}" class="q2c-btn q2c-btn--navy">
                    Free Consultation
                </a>
            </div>
        </section>

        {{-- Intro --}}
        <section class="q2c-section q2c-intro" aria-labelledby="q2c-intro-title">
            <div class="site-shell q2c-intro__inner">
                <div class="q2c-intro__media">
                    <img
                        src="{{ $img('delivers-all-quote-precision-transaction-efficiency-and-cash-flow-visibility.webp') }}"
                        alt="Delivers-All-Quote-Precision-Transaction-Efficiency-and-Cash-Flow-Visibility"
                        width="650"
                        height="433"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
                <div class="q2c-intro__copy">
                    <p class="q2c-kicker">Q2C Process</p>
                    <h2 id="q2c-intro-title">Delivers All Quote Precision, Transaction Efficiency, and Cash Flow Visibility— IBN Tech’s</h2>
                    <p>
                        The Quote-to-cash process is imperative for any organization to prioritize cash flow management as a means of sustaining a sound financial stance and enhancing profitability and liquidity.
                    </p>
                    <p>
                        With over 26+ years of experience in Quote-to-Cash management, IBN Tech offers an extensive range of services, customized to your unique business needs. The synergy of our expert team, along with our steadfast commitment to automation and integration, enables your business to achieve operational excellence and drive sustainable growth.
                    </p>
                </div>
            </div>
        </section>

        {{-- Personalizing --}}
        <section class="q2c-section q2c-process" aria-labelledby="q2c-process-title">
            <div class="site-shell q2c-process__inner">
                <div class="q2c-process__copy">
                    <h2 id="q2c-process-title">
                        <span>Personalizing</span>
                        Quote-to-Cash Process
                    </h2>
                    <p class="q2c-process__sub">to Match Your Business Goals</p>

                    <div class="q2c-acc" data-acc-group>
                        @foreach ($processItems as $item)
                            <details class="q2c-acc__item" name="q2c-process">
                                <summary>
                                    <span>{{ $item['title'] }}</span>
                                </summary>
                                <div class="q2c-acc__body">
                                    <ul>
                                        @foreach ($item['items'] as $line)
                                            <li>{{ $line }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <div class="q2c-process__media">
                    <img
                        src="{{ $img('outsourcing-accounting-final.webp') }}"
                        alt="Outsourcing-Accounting-final"
                        width="550"
                        height="279"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Record-to-Report CTA --}}
        <section class="q2c-banner" aria-labelledby="q2c-banner-title">
            <div class="site-shell q2c-banner__inner">
                <h2 id="q2c-banner-title">Record-to-Report services</h2>
                <p>Enhance your financial accuracy and compliance with IBN Tech’s</p>
                <h3>Now that you've tailored your Quote-to-Cash workflow, why not take the next steps?</h3>
                <a href="{{ $contactUrl }}" class="q2c-btn q2c-btn--navy">
                    Connect with us
                </a>
            </div>
        </section>

        {{-- Solutions --}}
        <section class="q2c-section q2c-why" aria-labelledby="q2c-why-title">
            <div class="site-shell">
                <div class="q2c-heading">
                    <h2 id="q2c-why-title">Small Business Quote-to-Cash Solutions</h2>
                    <p>What makes IBN Tech the Top Provider of</p>
                </div>

                <div class="q2c-why__grid" role="list">
                    @foreach ($solutions as $solution)
                        <article class="q2c-why__card" role="listitem">
                            <img
                                src="{{ $img($solution['icon']) }}"
                                alt="{{ $solution['alt'] }}"
                                width="118"
                                height="93"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $solution['title'] }}</h3>
                            <p>{{ $solution['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="q2c-why__bar">
                    <p>Your vendors will thank you, and so will your finance team</p>
                    <a href="{{ $consultUrl }}" class="q2c-btn q2c-btn--green">
                        Free Consultation
                    </a>
                </div>
            </div>
        </section>

        {{-- Streamline / O2C --}}
        <section class="q2c-section q2c-next" aria-labelledby="q2c-next-title">
            <div class="site-shell q2c-next__inner">
                <div class="q2c-next__copy">
                    <h2 id="q2c-next-title">Ready to streamline your revenue management process beyond Q2C?</h2>
                    <p><strong>IBN Tech’s Order-to-Cash (O2C) solutions</strong></p>
                    <p>Optimize your revenue cycles and enhance customer relationships</p>
                    <a href="{{ $consultUrl }}" class="q2c-btn q2c-btn--green">
                        Free Consultation
                    </a>
                </div>
                <div class="q2c-next__media">
                    <img
                        src="{{ $img('ready-to-streamline-your-revenue-management-process-beyond-q2c.webp') }}"
                        alt="Ready to streamline your revenue management process beyond Q2C"
                        width="650"
                        height="433"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="q2c-section q2c-faq" aria-labelledby="q2c-faq-title">
            <div class="site-shell">
                <h2 id="q2c-faq-title" class="q2c-heading q2c-heading--solo">Frequently Asked Questions (FAQ's)</h2>

                <div class="q2c-faq__grid">
                    <div class="q2c-faq__media">
                        <img
                            src="{{ $img('banner-1.webp') }}"
                            alt="banner-1"
                            width="560"
                            height="500"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>

                    <div class="q2c-faq__acc" data-acc-group>
                        @foreach ($faqs as $faq)
                            <details class="q2c-faq__item" name="q2c-faqs" @if ($loop->first) open @endif>
                                <summary>
                                    <span>{{ $faq['question'] }}</span>
                                    <span class="q2c-faq__icon" aria-hidden="true">
                                        <svg class="q2c-faq__icon-play" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path>
                                        </svg>
                                        <svg class="q2c-faq__icon-check" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm141.4 179.3l-176 176c-4.7 4.7-12.3 4.7-17 0l-104-104c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l72.7 72.7 144.7-144.7c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.6 4.7 12.2 0 16.9z"></path>
                                        </svg>
                                    </span>
                                </summary>
                                <div class="q2c-faq__body">
                                    <p>{{ $faq['answer'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.q2c-page [data-acc-group]').forEach((group) => {
            group.querySelectorAll('details').forEach((item) => {
                item.addEventListener('toggle', () => {
                    if (!item.open) {
                        return;
                    }
                    group.querySelectorAll('details[open]').forEach((other) => {
                        if (other !== item) {
                            other.open = false;
                        }
                    });
                });
            });
        });
    </script>
@endpush
