@php
    $img = fn (string $file): string => asset('images/record-to-report/'.$file);
    $consultUrl = route('page.show', ['slug' => 'free-consultation']);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);
    $q2cUrl = route('page.show', ['slug' => 'quote-to-cash']);
    $o2cUrl = route('page.show', ['slug' => 'order-to-cash']);

    $services = [
        [
            'title' => 'Data Collection and Management',
            'text' => 'Centralize financial data from various sources for precise insights and streamlined decision-making.',
        ],
        [
            'title' => 'The Closing Process',
            'text' => 'Accelerate month-end closures with automated, error-free workflows.',
        ],
        [
            'title' => 'Reconciliation and Validation',
            'text' => 'Ensure financial accuracy and compliance through meticulous data review.',
        ],
        [
            'title' => 'Financial Analysis',
            'text' => 'Empower your financial strategy with tailored analysis and financial forecasting.',
        ],
        [
            'title' => 'Financial Reporting',
            'text' => 'Deliver comprehensive reports to key stakeholders, enhancing transparency and trust.',
        ],
    ];

    $benefits = [
        [
            'icon' => 'regulatory-compliance.png',
            'alt' => 'Regulatory Compliance',
            'title' => 'Regulatory Compliance',
            'text' => 'Ensure compliance with regulations without straining your budget. Our cost-effective solutions keep your financial operations above board.',
        ],
        [
            'icon' => 'risk-mitigation.png',
            'alt' => 'Risk Mitigation',
            'title' => 'Risk Mitigation',
            'text' => 'Our team of specialists is dedicated to minimizing risks within your R2R process, ensuring the integrity and reliability of your financial data.',
        ],
        [
            'icon' => 'efficient-processes.png',
            'alt' => 'Efficient Processes',
            'title' => 'Efficient Processes',
            'text' => 'IBN Tech automates your financial workflows, eliminating manual tasks and saving you time and resources.',
        ],
        [
            'icon' => 'scalable-solutions.webp',
            'alt' => 'Scalable Solutions',
            'title' => 'Scalable Solutions',
            'text' => 'Tailored to your needs, our services align perfectly with your growth, whether you\'re a startup or an enterprise.',
        ],
        [
            'icon' => 'data-security.png',
            'alt' => 'Data Security',
            'title' => 'Data Security',
            'text' => 'We understand the importance of data security. IBN Tech guarantees the utmost information security, safeguarding your valuable data.',
        ],
        [
            'icon' => 'enhance-customer-experience.webp',
            'alt' => 'Enhance Customer Experience',
            'title' => 'Enhance Customer Experience',
            'text' => 'Minimize instances of fraud and default rates while providing exceptional service to your customers, ensuring their satisfaction.',
        ],
    ];

    $faqs = [
        [
            'question' => '1. Can automation tools assist in the R2R process?',
            'answer' => 'Yes, automation tools play a pivotal role in enhancing the R2R process. It streamlines data collection, validation, and reporting, reducing manual errors and saving time. Automation helps ensure data accuracy, compliance, and consistency, making financial reporting more efficient and reliable. It enables organizations to make informed decisions based on real-time data, ultimately contributing to improved financial performance.',
        ],
        [
            'question' => '2. How does the R2R process support financial decision-making?',
            'answer' => 'The R2R process supports financial decision-making by providing accurate, up-to-date financial information. Through systematic data reconciliation, consolidation, and reporting, R2R creates a comprehensive and consistent financial picture. This data empowers stakeholders to make informed decisions, develop financial strategies, and assess the impact of their choices. R2R helps ensure that financial decisions are grounded in reliable data, ultimately leading to better outcomes.',
        ],
        [
            'question' => '3. How do outsourced R2R services ensure data confidentiality?',
            'answer' => 'Outsourced R2R services with IBN Tech ensure data confidentiality through a comprehensive security approach. We utilize cutting-edge encryption techniques, enforce strict access controls, and fully comply with data protection regulations. Our commitment extends to establishing confidentiality agreements with our clients, providing an additional layer of assurance. When you partner with IBN Tech, rest assured that your financial data is handled with the highest level of confidentiality and security.',
        ],
        [
            'question' => '4. Can R2R outsourcing help in financial analysis and insights for decision-making?',
            'answer' => 'Partnering with IBN Tech for R2R outsourcing unlocks expertise in financial standards like GAAP and IFRS. Our experienced team, supported by cutting-edge technology, provides comprehensive financial analysis, including custom reports and key performance indicators (KPIs). These insights empower your organization to make confident, data-driven decisions. Choosing IBN Tech as your outsourcing partner ensures access to essential data-driven insights for strategic planning, driving your organization’s success.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/record-to-report.css'])
@endpush

@section('content')
    <div class="r2r-page">
        {{-- Hero --}}
        <section class="r2r-hero" aria-labelledby="r2r-hero-title">
            <div class="site-shell r2r-hero__inner">
                <p class="r2r-hero__eyebrow">Manage Your Financial Operations with</p>
                <h1 id="r2r-hero-title">Record to Report Outsourcing Services</h1>
                <p class="r2r-hero__lede">
                    Don’t let data inconsistencies hinder your performance; Unlock success with IBN Tech’s precise, reliable reporting, ensuring your business stays on track with our expertise
                </p>
                <a href="{{ $consultUrl }}" class="r2r-btn r2r-btn--navy">
                    Free Consultation
                </a>
            </div>
        </section>

        {{-- Intro --}}
        <section class="r2r-section r2r-intro" aria-labelledby="r2r-intro-title">
            <div class="site-shell r2r-intro__inner">
                <div class="r2r-intro__media">
                    <img
                        src="{{ $img('r2r-process-automation.webp') }}"
                        alt="R2R process automation with IBN Tech"
                        width="650"
                        height="433"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
                <div class="r2r-intro__copy">
                    <p class="r2r-kicker">R2R Process automation</p>
                    <h2 id="r2r-intro-title">Experience Seamless Workflow, Reduced Risks, and Enhanced Decision-Making with IBN Tech</h2>
                    <p>
                        Any disruption in your R2R workflow can impede your accounting and finance teams, affecting strategic decision-making. When processes are fragmented, it can result in reporting delays, manual errors, and compliance complexities. Enhance your R2R process with IBN Tech’s two decades of finance and accounting expertise. Our seamless R2R automation streamlines operations reduces risks and costs and empowers you with centralized control under a transparent framework.
                    </p>
                </div>
            </div>
        </section>

        {{-- Services --}}
        <section class="r2r-section r2r-services" aria-labelledby="r2r-services-title">
            <div class="site-shell">
                <div class="r2r-heading">
                    <h2 id="r2r-services-title">
                        Optimize Your Financial Workflow with IBN Tech's
                        <span>Record to Report Services</span>
                    </h2>
                    <p>Leverage automation and expert strategies to streamline your R2R process. Explore end-to-end solutions for small businesses.</p>
                </div>

                <div class="r2r-services__grid">
                    <ul class="r2r-check-list">
                        @foreach ($services as $service)
                            <li>
                                <strong>{{ $service['title'] }}</strong>
                                <span>{{ $service['text'] }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="r2r-services__media">
                        <img
                            src="{{ $img('record-to-report-services.webp') }}"
                            alt="Record to Report services"
                            width="550"
                            height="367"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Q2C CTA --}}
        <section class="r2r-banner" aria-labelledby="r2r-banner-title">
            <div class="site-shell r2r-banner__inner">
                <h2 id="r2r-banner-title">Want to Boost Your Sales Cycle Too?</h2>
                <p>
                    Upgrade your end-to-end finance operations by exploring our
                    <a href="{{ $q2cUrl }}">Quote-to-Cash (Q2C)</a>
                    solutions. Dive deep into how we simplify and streamline sales cycle processes for businesses like yours.
                </p>
                <a href="{{ $contactUrl }}" class="r2r-btn r2r-btn--navy">
                    Connect with us
                </a>
            </div>
        </section>

        {{-- Benefits --}}
        <section class="r2r-section r2r-why" aria-labelledby="r2r-why-title">
            <div class="site-shell">
                <div class="r2r-heading">
                    <h2 id="r2r-why-title">
                        Reclaim Your Productivity with IBN Tech’s
                        <span>Record to Report (R2R) Services</span>
                    </h2>
                    <p>Unlock a world of benefits for your Small Business</p>
                </div>

                <div class="r2r-why__grid" role="list">
                    @foreach ($benefits as $benefit)
                        <article class="r2r-why__card" role="listitem">
                            <img
                                src="{{ $img($benefit['icon']) }}"
                                alt="{{ $benefit['alt'] }}"
                                width="118"
                                height="93"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $benefit['title'] }}</h3>
                            <p>{{ $benefit['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Navy CTA bar --}}
        <section class="r2r-bar" aria-label="Free consultation">
            <div class="site-shell r2r-bar__inner">
                <p>Your vendors will thank you, and so will your finance team</p>
                <a href="{{ $consultUrl }}" class="r2r-btn r2r-btn--green">
                    Free Consultation
                </a>
            </div>
        </section>

        {{-- Order-to-Cash --}}
        <section class="r2r-section r2r-next" aria-labelledby="r2r-next-title">
            <div class="site-shell r2r-next__inner">
                <div class="r2r-next__copy">
                    <h2 id="r2r-next-title">Interested in Streamlining Order-to-Cash Processes?</h2>
                    <p>
                        Your financial operations don’t end at reporting. Check out how we can assist you in managing and optimizing your
                        <a href="{{ $o2cUrl }}">Order-to-Cash (O2C)</a>
                        process, ensuring a smoother cash flow and satisfied clients.
                    </p>
                    <a href="{{ $o2cUrl }}" class="r2r-btn r2r-btn--green">
                        Order-to-Cash
                    </a>
                </div>
                <div class="r2r-next__media">
                    <img
                        src="{{ $img('order-to-cash-illustration.webp') }}"
                        alt="Streamlining Order-to-Cash processes"
                        width="650"
                        height="433"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="r2r-section r2r-faq" aria-labelledby="r2r-faq-title">
            <div class="site-shell r2r-faq__grid">
                <h2 id="r2r-faq-title" class="visually-hidden">Frequently Asked Questions</h2>

                <div class="r2r-faq__media">
                    <img
                        src="{{ $img('faq-banner.webp') }}"
                        alt="IBN Tech team discussing Record to Report services"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="r2r-faq__acc" data-acc-group>
                    @foreach ($faqs as $faq)
                        <details class="r2r-faq__item" name="r2r-faqs" @if ($loop->first) open @endif>
                            <summary>
                                <span>{{ $faq['question'] }}</span>
                            </summary>
                            <div class="r2r-faq__body">
                                <p>{{ $faq['answer'] }}</p>
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.r2r-page [data-acc-group]').forEach((group) => {
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
