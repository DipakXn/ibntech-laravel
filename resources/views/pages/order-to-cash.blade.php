@php
    $img = fn (string $file): string => asset('images/order-to-cash/'.$file);

    $solutions = [
        [
            'title' => 'Order Receipt and Validation',
            'body' => 'IBN Tech simplifies order intake by cross-referencing with ERP and CRM records automatically verifying accuracy. Any issues are flagged for quick manual review.',
        ],
        [
            'title' => 'Order Processing and Data Extraction',
            'body' => 'Upon validation, IBN Tech extracts and organizes order data for easy processing, including customer details and pricing information.',
        ],
        [
            'title' => 'Order Automation and Approval',
            'body' => 'IBN Tech\'s intelligent automation customizes the order routing and approval process. Automatic alerts and notifications eliminate bottlenecks and accelerate order approval.',
        ],
        [
            'title' => 'Invoice Generation and Data Validation',
            'body' => 'Approved orders trigger automatic invoice creation. Our system cross-checks invoices with original orders and your ERP/CRM data, maintaining precision.',
        ],
        [
            'title' => 'Payment Processing and Collections',
            'body' => 'Payments are processed efficiently, with reconciliation against invoices and financial records. IBN Tech automates payment reminders and follow-ups, ensuring optimal cash flow management.',
        ],
        [
            'title' => 'Reporting and Analytics',
            'body' => 'Unlock O2C performance insights with IBN Tech\'s reporting and analytics. Real-time KPIs drive data-based decisions, revealing growth opportunities and areas for improvement.',
        ],
    ];

    $benefits = [
        [
            'icon' => 'optimized-vendor-sourcing.svg',
            'alt' => 'optimized vendor sourcing',
            'title' => 'End-to-End O2C Expertise',
            'text' => 'IBN Tech offers comprehensive O2C services, from order processing to cash collection, ensuring seamless and efficient operations in one place.',
        ],
        [
            'icon' => 'invoice-processing.svg',
            'alt' => 'invoice processing',
            'title' => 'O2C Automation',
            'text' => 'IBN Tech\'s advanced automation optimizes O2C processes, reducing errors, accelerating order fulfillment, and delivering significant cost savings, with a remarkable 90% time reduction.',
        ],
        [
            'icon' => 'spend-analysis.svg',
            'alt' => 'spend analysis',
            'title' => 'Streamlined Scalability',
            'text' => 'IBN Tech\'s solutions remove staff dependency, automating data extraction, and routing for smooth O2C regardless of order volume, positioning your organization for growth.',
        ],
        [
            'icon' => 'payment-processing-1.svg',
            'alt' => 'payment processing',
            'title' => 'Accelerated Cash Flow and Reduced DSO',
            'text' => 'Our solutions expedite invoice processing, payment collection, and dispute resolution, accelerating cash flow and reducing your day\'s sales outstanding (DSO)',
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

    $faqs = [
        [
            'question' => '1. How do you automate an order-to-cash process?',
            'answer' => 'Automating the Order-to-Cash process involves implementing advanced software solutions to streamline tasks like invoicing, payment collection, and reconciliation. By digitizing these steps, businesses can reduce errors, save time, and enhance efficiency, resulting in improved cash flow and customer satisfaction.',
        ],
        [
            'question' => '2. What are the key risks in the order-to-cash process?',
            'answer' => 'Key risks in the Order-to-Cash process include late or non-payments, disputes, fraud, and regulatory compliance issues. Addressing these risks requires robust credit policies, effective collection strategies, and advanced fraud detection measures to safeguard revenue and maintain a healthy cash flow.',
        ],
        [
            'question' => '3. Is order-to-cash the same as accounts receivable?',
            'answer' => 'While Order-to-Cash and Accounts Receivable are related, they are not the same. Order-to-Cash encompasses the entire process, from order creation to payment receipt. Accounts Receivable focuses specifically on the outstanding invoices a company is waiting to be paid. It\'s a subset of the broader Order-to-Cash process, which includes various stages beyond invoicing.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/order-to-cash.css'])
@endpush

@section('content')
    <div class="o2c-page">
        {{-- Hero --}}
        <section class="o2c-hero" aria-labelledby="o2c-hero-title">
            <div class="site-shell o2c-hero__inner">
                <div class="o2c-hero__copy">
                    <p class="o2c-hero__tagline">Expand Your Business With Confidence</p>
                    <h1 id="o2c-hero-title">Transform your Order-to-Cash Processes Today!</h1>
                    <p class="o2c-hero__lede">
                        Experience unmatched efficiency in every stage of the O2C cycle. From seamless order processing to prompt cash collection, we've got you covered.
                    </p>
                </div>

                <aside class="o2c-hero__form" id="contact-us" aria-labelledby="o2c-hero-form-title">
                    <h2 id="o2c-hero-form-title">Want to Improve Your Accounting ?</h2>
                    <p class="o2c-hero__form-sub">Submit the Form to Get Started!</p>

                    <livewire:forms.contact-form
                        form-name="order-to-cash"
                        id-prefix="o2c"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$formServiceOptions"
                        service-placeholder="Please Select Services"
                        message-placeholder="How can we help you solve your accounting challenge?"
                        submit-label="Submit"
                        layout="home"
                        :message-rows="4"
                    />
                </aside>
            </div>
        </section>

        {{-- Intro --}}
        <section class="o2c-section o2c-intro" aria-labelledby="o2c-intro-title">
            <div class="site-shell o2c-intro__inner">
                <div class="o2c-intro__media">
                    <img
                        src="{{ $img('business-owners.jpg') }}"
                        alt="Business Owners"
                        width="650"
                        height="433"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
                <div class="o2c-intro__copy">
                    <p class="o2c-kicker">Order to Cash Management</p>
                    <h2 id="o2c-intro-title">Experience a New Era of Financial Clarity and Operational Excellence</h2>
                    <p>
                        An organization's Order-to-Cash (O2C) process significantly influences operational performance, revenue growth, working capital management, and profitability. In today's volatile economic climate, CFOs and business leaders are focusing on optimizing their O2C processes.
                    </p>
                    <p>
                        At IBN Tech, we're leading this financial transformation, utilizing cutting-edge technology to streamline O2C. With over 24+ years of experience in O2C management, our team can transform your processes into strategic assets, enhancing decision-making, financial clarity, and customer relationships.
                    </p>
                </div>
            </div>
        </section>

        {{-- Solutions --}}
        <section class="o2c-section o2c-sol" aria-labelledby="o2c-sol-title">
            <div class="site-shell">
                <div class="o2c-heading">
                    <h2 id="o2c-sol-title">Order To Cash Solution</h2>
                    <p>Optimize Your Business O2C Cycle with IBN Tech</p>
                </div>

                <div class="o2c-sol__grid">
                    <div class="o2c-acc" data-acc-group>
                        @foreach ($solutions as $item)
                            <details class="o2c-acc__item" name="o2c-solutions" @if ($loop->first) open @endif>
                                <summary>
                                    <span>{{ $item['title'] }}</span>
                                </summary>
                                <div class="o2c-acc__body">
                                    <p>{{ $item['body'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>

                    <div class="o2c-sol__media">
                        <img
                            src="{{ $img('outsourcing-accounting-final.webp') }}"
                            alt="Outsourcing Accounting"
                            width="550"
                            height="279"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Q2C CTA --}}
        <section class="o2c-cta" aria-labelledby="o2c-cta-title">
            <div class="site-shell o2c-cta__inner">
                <h2 id="o2c-cta-title">Expanding Beyond O2C?</h2>
                <h3>Dive into our Quote-to-Cash Services!</h3>
                <p>Maximize revenue and streamline each phase, from initial quote to final cash receipt.</p>
                <a href="{{ route('page.show', ['slug' => 'free-consultation']) }}" class="o2c-btn">
                    Explore Q2C Solutions
                </a>
            </div>
        </section>

        {{-- Benefits --}}
        <section class="o2c-section o2c-why" aria-labelledby="o2c-why-title">
            <div class="site-shell">
                <div class="o2c-heading">
                    <h2 id="o2c-why-title">Why Small Businesses Trust IBN Tech for</h2>
                    <p>Order-to-Cash Services</p>
                </div>

                <div class="o2c-why__grid" role="list">
                    @foreach ($benefits as $benefit)
                        <article class="o2c-why__card" role="listitem">
                            <img
                                src="{{ $img($benefit['icon']) }}"
                                alt="{{ $benefit['alt'] }}"
                                width="145"
                                height="145"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $benefit['title'] }}</h3>
                            <p>{{ $benefit['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="o2c-why__cta">
                    <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="o2c-btn">
                        Get Started Now
                    </a>
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="o2c-section o2c-faq" aria-labelledby="o2c-faq-title">
            <div class="site-shell">
                <h2 id="o2c-faq-title" class="o2c-heading o2c-heading--solo">Frequently Asked Questions (FAQ)</h2>

                <div class="o2c-faq__grid">
                    <div class="o2c-faq__media">
                        <img
                            src="{{ $img('contact-us-banner-1.webp') }}"
                            alt="contact us"
                            width="560"
                            height="500"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>

                    <div class="o2c-faq__acc" data-acc-group>
                        @foreach ($faqs as $faq)
                            <details class="o2c-faq__item" name="o2c-faqs" @if ($loop->first) open @endif>
                                <summary>
                                    <span>{{ $faq['question'] }}</span>
                                </summary>
                                <div class="o2c-faq__body">
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
        document.querySelectorAll('.o2c-page [data-acc-group]').forEach((group) => {
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
