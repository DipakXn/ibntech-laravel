@php
    $img = fn (string $file): string => asset('images/accounts-payable-and-accounts-receivable-services/'.$file);

    $heroChecks = [
        ['strong' => '15-20%', 'text' => 'reduction in processing costs'],
        ['strong' => '90%', 'text' => 'decrease in payment errors and exceptions'],
        ['strong' => '100%', 'text' => 'visibility into payment status and cash position'],
    ];

    $whyItems = [
        [
            'icon' => 'fa-arrow-trend-up',
            'text' => 'As your business scales, managing an expanding number of invoices and collections through an in-house accounts payable system and receivables process becomes time-intensive and expensive. Growth can quickly overwhelm traditional accounts payable processes, leading to errors, missed discounts, and unpredictable accounts payable turnover.',
        ],
        [
            'icon' => 'fa-dollar-sign',
            'text' => 'When financial operations start slipping, you end up chasing payments, reconciling exceptions, and risking delays that hurt your account receivable turnover.',
        ],
        [
            'icon' => 'fa-shield-halved',
            'text' => 'Outsourcing AP and AR isn\'t just support, it\'s a strategic upgrade to minimize risks and strengthen financial predictability.',
        ],
    ];

    $apSolutions = [
        [
            'title' => 'Invoice processing and validation',
            'text' => 'Expert-led invoice handling with multi-point verification to ensure accuracy and timely approvals.',
        ],
        [
            'title' => 'Purchase order matching and verification',
            'text' => 'Ensure 2-way and 3-way PO matching to eliminate discrepancies and streamline approvals.',
        ],
        [
            'title' => 'Payment scheduling and execution',
            'text' => 'Strategic payment planning and execution aligned with client cash flow and vendor terms.',
        ],
        [
            'title' => 'Vendor master data management',
            'text' => 'Comprehensive vendor onboarding, updates, and governance to maintain clean and compliant records.',
        ],
        [
            'title' => 'Payment reconciliation and reporting',
            'text' => 'Detailed reconciliation and customized reporting for financial transparency and audit readiness.',
        ],
        [
            'title' => 'Fraud detection and prevention',
            'text' => 'Proactive monitoring and control checks to identify anomalies and mitigate payment fraud risks.',
        ],
        [
            'title' => 'Compliance management',
            'text' => 'Adherence to regulatory standards and internal policies through documented processes and expert oversight.',
        ],
        [
            'title' => 'End-to-end support for PR and PO',
            'text' => 'Full-cycle support for purchase requisition and order creation, tracking, and vendor coordination.',
        ],
    ];

    $apScale = [
        [
            'icon' => 'streamlined.webp',
            'title' => 'Streamlined Processing',
            'text' => 'Fast, accurate, and efficient accounts payable invoice processing',
        ],
        [
            'icon' => 'minimize-risk.webp',
            'title' => 'Minimized Risk',
            'text' => 'Lower chances of errors, discrepancies, and fraud through optimized accounts payable systems',
        ],
        [
            'icon' => 'expertise.webp',
            'title' => 'Expert Insights',
            'text' => 'Actionable recommendations from dedicated professionals',
        ],
        [
            'icon' => 'service.webp',
            'title' => 'Customized Support',
            'text' => 'Adaptive assistance that grows with your business needs',
        ],
    ];

    $arSolutions = [
        [
            'title' => 'Invoice generation and delivery',
            'text' => 'Timely creation and dispatch of client-approved invoices across preferred channels.',
        ],
        [
            'title' => 'Payment collection and processing',
            'text' => 'End-to-end handling of receivables through multi-mode payment tracking and processing.',
        ],
        [
            'title' => 'Customer account management',
            'text' => 'Dedicated support for account setup, updates, and ongoing customer ledger maintenance.',
        ],
        [
            'title' => 'Credit management and assessment',
            'text' => 'Manual credit evaluations and limit monitoring to mitigate risk and support sales.',
        ],
        [
            'title' => 'Aging analysis and reporting',
            'text' => 'Periodic aging reports with actionable insights to improve receivables turnover.',
        ],
        [
            'title' => 'Collections and dispute resolution',
            'text' => 'Proactive follow-ups and resolution of payment disputes to accelerate recovery.',
        ],
        [
            'title' => 'Cash application and reconciliation',
            'text' => 'Accurate allocation of incoming payments and reconciliation with customer accounts.',
        ],
    ];

    $arBenefits = [
        [
            'icon' => 'credit-card.webp',
            'title' => 'Faster Payments',
            'text' => 'Improved accounts receivable financing cycle',
        ],
        [
            'icon' => 'customer-loyalty.webp',
            'title' => 'Enhanced Customer Loyalty',
            'text' => 'Positive client interactions at every stag',
        ],
        [
            'icon' => 'transparency.webp',
            'title' => 'Greater Transparency',
            'text' => 'Full visibility through real-time dashboards',
        ],
        [
            'icon' => 'brain.webp',
            'title' => 'Real-Time Intelligence',
            'text' => 'Insights from AR experts for improved decision-making',
        ],
    ];

    $partnerReasons = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Certified Data Security',
            'text' => 'ISO 9001:2015 | 20000-1:2018 | 27001:2022 compliance',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Expert Team',
            'text' => 'Skilled accountants delivering superior accounts payable services and AR management',
        ],
        [
            'icon' => 'fa-bolt',
            'title' => 'Cutting-Edge Tools',
            'text' => 'Expertise in accounting software ensures accurate accounts payable invoice processing',
        ],
        [
            'icon' => 'fa-check',
            'title' => 'Quality Assurance',
            'text' => 'Every record verified through strict control checks',
        ],
        [
            'icon' => 'fa-lock',
            'title' => 'Detailed Verification',
            'text' => 'Rigorous checks to maintain error-free records',
        ],
        [
            'icon' => 'fa-layer-group',
            'title' => 'End-to-End Support',
            'text' => 'Complete management from invoicing to reconciliation',
        ],
        [
            'icon' => 'fa-building',
            'title' => 'Industry Solutions',
            'text' => 'Customized support for both accounts receivable outsourcing and accounts payable outsourcing.',
        ],
    ];

    $flowSteps = [
        [
            'icon' => 'bolt',
            'title' => 'Accurate, streamlined invoice workflows',
        ],
        [
            'icon' => 'check',
            'title' => 'Proactive follow-ups on collections, without harming relationships',
        ],
        [
            'icon' => 'eye',
            'title' => 'Real-time visibility into every dollar in or out',
        ],
        [
            'icon' => 'lock',
            'title' => 'Secure, error-free accounts payable system backed by compliance standards',
        ],
    ];

    $softwareLogos = [
        ['file' => 'sage-1.webp', 'alt' => 'Sage'],
        ['file' => 'quicbooks.webp', 'alt' => 'QuickBooks'],
        ['file' => 'oracle-netsuite.webp', 'alt' => 'Oracle NetSuite'],
        ['file' => 'dynamics-365.webp', 'alt' => 'Dynamics 365'],
        ['file' => 'acumatica.webp', 'alt' => 'Acumatica'],
        ['file' => 'microsoft-dynamics-gp.webp', 'alt' => 'Microsoft Dynamics GP'],
        ['file' => 'Netsuite.webp', 'alt' => 'NetSuite'],
        ['file' => 'realpage.webp', 'alt' => 'RealPage'],
        ['file' => 'xero.webp', 'alt' => 'Xero'],
        ['file' => 'yardi.webp', 'alt' => 'Yardi'],
    ];

    $offerings = [
        [
            'icon' => 'fa-chart-column',
            'title' => 'Accounting Services',
            'text' => 'Full-scope financial management with advanced automation and expert accountant oversight.',
            'href' => route('page.show', ['slug' => 'accounting-services-for-small-business']),
        ],
        [
            'icon' => 'fa-file-invoice-dollar',
            'title' => 'Tax Preparation',
            'text' => '27+ years of experience ensuring tax return filings support and maximum savings.',
            'href' => route('page.show', ['slug' => 'tax-preparation-services-usa']),
        ],
        [
            'icon' => 'fa-bolt',
            'title' => 'Invoice Processing',
            'text' => 'AI-powered accounts payable invoice processing designed for speed and accuracy.',
            'href' => route('page.show', ['slug' => 'invoice-process-automation']),
        ],
        [
            'icon' => 'fa-book-open',
            'title' => 'Bookkeeping',
            'text' => 'Automated record-keeping with real-time insights for better decision-making.',
            'href' => route('page.show', ['slug' => 'bookkeeping-services']),
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Payroll Processing',
            'text' => 'Complete payroll management with compliance, benefits administration, and tax processing.',
            'href' => route('page.show', ['slug' => 'payroll-processing']),
        ],
    ];

    $faqs = [
        [
            'q' => 'How do you ensure data security and compliance?',
            'a' => 'We operate under ISO/IEC 27001:2022 controls and maintain audit‑ready documentation across processes. Our security framework includes end-to-end encryption, multi-factor authentication, role-based access controls, and continuous monitoring with complete audit trails.',
        ],
        [
            'q' => 'Which tools and ERPs do you support?',
            'a' => 'We maintain native integrations with various leading platforms including SAP, Oracle NetSuite, Microsoft Dynamics 365, Sage Intacct, QuickBooks, and Xero. Our API-first architecture adapts to your existing technology stack without requiring system changes.',
        ],
        [
            'q' => 'Can you help reduce our DSO and exceptions?',
            'a' => 'Yes. We implement AI-powered proactive follow-up sequences and exception prevention workflows that typically reduce DSO by 20-30% and process errors by up to 90%. Our predictive analytics identify potential issues early for proactive resolution.',
        ],
    ];

@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/accounts-payable-and-accounts-receivable-services.css'])
@endpush

@section('content')
    <div class="aparsvc-page">
        {{-- Promo offer banner --}}
        <div
            class="aparsvc-promo"
            x-data="{
                open: true,
                init() {
                    try { this.open = sessionStorage.getItem('aparsvcPromoDismissed') !== '1'; } catch (e) {}
                },
                dismiss() {
                    this.open = false;
                    try { sessionStorage.setItem('aparsvcPromoDismissed', '1'); } catch (e) {}
                }
            }"
            x-show="open"
            x-cloak
            x-transition.opacity
        >
            <div class="site-shell aparsvc-promo__inner">
                <p class="aparsvc-promo__copy">
                    <span class="aparsvc-promo__bell" aria-hidden="true">🔔</span>
                    <strong>Book now and Get 20% off for the coming quarter – limited time offer!</strong>
                </p>
                <a href="#aparsvc-consult" class="aparsvc-promo__btn">Schedule Free Consultation</a>
                <button type="button" class="aparsvc-promo__close" @click="dismiss()" aria-label="Close banner">
                    <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        {{-- Hero --}}
        <section
            class="aparsvc-hero"
            aria-labelledby="aparsvc-hero-title"
            style="--aparsvc-hero-image: url('{{ asset('images/accounts-payable-and-accounts-receivable-services/expert-ap-ar-hero.webp') }}')"
        >
            <div class="site-shell aparsvc-hero__inner">
                <div class="aparsvc-hero__copy">
                    <h1 id="aparsvc-hero-title">
                        Accounts Payable and Accounts Receivable Services for Strategic Business Operations
                    </h1>
                    <p class="aparsvc-hero__lede">
                        IBN Technologies delivers flexible, innovative, and cost-effective accounts receivable outsourcing and accounts payable services. As one of the most trusted accounts payable solution providers, our smart approach ensures quick implementation and exceptional quality—setting a new standard for financial process excellence.
                    </p>
                    <div class="aparsvc-hero__actions">
                        <a href="#aparsvc-consult" class="aparsvc-btn aparsvc-btn--light">
                            Book a Free Consultation
                            <i class="fa-solid fa-circle-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <aside class="aparsvc-hero__card" aria-label="Key outcomes">
                    <ul class="aparsvc-hero__checks">
                        @foreach ($heroChecks as $check)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span><strong>{{ $check['strong'] }}</strong> {{ $check['text'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </aside>
            </div>
        </section>

        {{-- Why manage in-house --}}
        <section class="aparsvc-section" aria-labelledby="aparsvc-why-title">
            <div class="site-shell aparsvc-why">
                <div class="aparsvc-why__copy">
                    <h2 id="aparsvc-why-title">
                        Why Manage AP &amp; AR In-House When It’s Costing You Time, Money, and Control?
                    </h2>
                    <ul class="aparsvc-why__list">
                        @foreach ($whyItems as $item)
                            <li>
                                <span class="aparsvc-why__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $item['icon'] }}"></i>
                                </span>
                                <p>{{ $item['text'] }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="aparsvc-why__media">
                    <img
                        src="{{ $img('Why-Handle-AP-and-AR.webp') }}"
                        alt="Why handle AP and AR with IBN Technologies"
                        width="540"
                        height="460"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Transform AP intro --}}
        <section class="aparsvc-section aparsvc-section--tight" aria-labelledby="aparsvc-ap-intro-title">
            <div class="site-shell">
                <div class="aparsvc-heading">
                    <h2 id="aparsvc-ap-intro-title">
                        Transform Accounts Payable with Precision and Full Process Control
                    </h2>
                    <p>
                        Manual invoice entry, mismatches, and approval delays are common pain points in the accounts payable process. These inefficiencies lead to missed discounts, poor vendor relationships, and extra costs. It’s time to simplify your workflow with professional accounts payable outsourcing that ensures speed, compliance, and control.
                    </p>
                </div>
            </div>
        </section>

        {{-- Core AP solutions --}}
        <section class="aparsvc-section aparsvc-section--tight" aria-labelledby="aparsvc-ap-solutions-title">
            <div class="site-shell">
                <div class="aparsvc-solutions-head">
                    <h2 id="aparsvc-ap-solutions-title" class="aparsvc-solutions-head__title">
                        Core Accounts Payable Solutions
                    </h2>
                    <span class="aparsvc-badge">Up to 60% Cost Savings</span>
                </div>

                <div class="aparsvc-solution-grid" role="list">
                    @foreach ($apSolutions as $item)
                        <article class="aparsvc-solution-card" role="listitem">
                            <span class="aparsvc-solution-card__icon" aria-hidden="true">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <div>
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Responsive AP services --}}
        <section class="aparsvc-section" aria-labelledby="aparsvc-ap-scale-title">
            <div class="site-shell">
                <div class="aparsvc-heading aparsvc-heading--left">
                    <h2 id="aparsvc-ap-scale-title">Responsive AP Services That Scale with You</h2>
                </div>

                <div class="aparsvc-circle-grid" role="list">
                    @foreach ($apScale as $item)
                        <article class="aparsvc-circle-card" role="listitem">
                            <img
                                src="{{ $img($item['icon']) }}"
                                alt=""
                                width="64"
                                height="64"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- AP CTA --}}
        <section class="aparsvc-cta aparsvc-cta--blue-green" aria-labelledby="aparsvc-cta-ap-title">
            <div class="site-shell aparsvc-cta__inner">
                <h2 id="aparsvc-cta-ap-title">Is your success creating finance headaches?</h2>
                <p>
                    Don’t let scaling volume disrupt your finances. Strengthen your system with proactive follow-ups and predictable accounts payable turnover for consistent cash flow stability.
                </p>
                <a href="#" class="aparsvc-btn aparsvc-btn--green" data-contact-modal-trigger>
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    Schedule a Consultation to Scale Up
                </a>
            </div>
        </section>

        {{-- AR intro --}}
        <section class="aparsvc-section" aria-labelledby="aparsvc-ar-intro-title">
            <div class="site-shell">
                <div class="aparsvc-heading">
                    <h2 id="aparsvc-ar-intro-title">
                        Collect Smarter, Cash Faster: Accounts Receivable Made Easy
                    </h2>
                    <p>
                        Effective accounts receivable services implement strategic collection approaches that maintain positive customer relationships while ensuring timely payments. By analyzing payment patterns and implementing proactive measures, these services significantly improve cash flow predictability.
                    </p>
                </div>
            </div>
        </section>

        {{-- Core AR solutions --}}
        <section class="aparsvc-section aparsvc-section--tight" aria-labelledby="aparsvc-ar-solutions-title">
            <div class="site-shell">
                <div class="aparsvc-solutions-head">
                    <h2 id="aparsvc-ar-solutions-title" class="aparsvc-solutions-head__title">
                        Core Accounts Receivable Solutions
                    </h2>
                    <span class="aparsvc-badge">Up to 30% DSO Reduction</span>
                </div>

                <div class="aparsvc-solution-grid" role="list">
                    @foreach ($arSolutions as $item)
                        <article class="aparsvc-solution-card" role="listitem">
                            <span class="aparsvc-solution-card__icon" aria-hidden="true">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <div>
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- AR benefits --}}
        <section class="aparsvc-section" aria-labelledby="aparsvc-ar-benefits-title">
            <div class="site-shell">
                <div class="aparsvc-heading aparsvc-heading--left">
                    <h2 id="aparsvc-ar-benefits-title">
                        Stronger Cash Flow. Better Customer Relationships. Full Control
                    </h2>
                </div>

                <div class="aparsvc-circle-grid" role="list">
                    @foreach ($arBenefits as $item)
                        <article class="aparsvc-circle-card" role="listitem">
                            <img
                                src="{{ $img($item['icon']) }}"
                                alt=""
                                width="64"
                                height="64"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- AR CTA --}}
        <section class="aparsvc-cta aparsvc-cta--green-blue" aria-labelledby="aparsvc-cta-ar-title">
            <div class="site-shell aparsvc-cta__inner">
                <h2 id="aparsvc-cta-ar-title">Improve your cash flow and build financial resilience</h2>
                <p>
                    Learn how our accounts receivable services can reduce your DSO by up to 30% and minimize bad debt write-offs.
                </p>
                <a href="#" class="aparsvc-btn aparsvc-btn--green" data-contact-modal-trigger>
                    Schedule a Free Call
                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </section>

        {{-- Why partner --}}
        <section class="aparsvc-section" aria-labelledby="aparsvc-partner-title">
            <div class="site-shell">
                <div class="aparsvc-heading">
                    <h2 id="aparsvc-partner-title">Why Partner with IBN Technologies?</h2>
                    <p>Let’s automate, optimize, and scale – together</p>
                </div>

                <div class="aparsvc-partner-grid" role="list">
                    @foreach ($partnerReasons as $item)
                        <article class="aparsvc-partner-card" role="listitem">
                            <span class="aparsvc-partner-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- How we make it happen --}}
        <section class="aparsvc-section aparsvc-section--soft" aria-labelledby="aparsvc-flow-title">
            <div class="site-shell">
                <div class="aparsvc-heading">
                    <h2 id="aparsvc-flow-title">How We Make It Happen</h2>
                    <p>
                        Here’s how IBN Technologies simplifies your payable and receivable operations through advanced accounts payable solutions and outsourcing practices:
                    </p>
                </div>

                <div class="aparsvc-flow" role="list">
                    @foreach ($flowSteps as $step)
                        <article class="aparsvc-flow__item" role="listitem">
                            <div class="aparsvc-flow__diamond" aria-hidden="true">
                                <div class="aparsvc-flow__diamond-inner">
                                    @if ($step['icon'] === 'bolt')
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" /></svg>
                                    @elseif ($step['icon'] === 'check')
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10" /><path d="M9 12l2 2l4-4" /></svg>
                                    @elseif ($step['icon'] === 'eye')
                                        <svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" clip-rule="evenodd" d="M6.30147 15.5771C4.77832 14.2684 3.6904 12.7726 3.18002 12C3.6904 11.2274 4.77832 9.73158 6.30147 8.42294C7.87402 7.07185 9.81574 6 12 6C14.1843 6 16.1261 7.07185 17.6986 8.42294C19.2218 9.73158 20.3097 11.2274 20.8201 12C20.3097 12.7726 19.2218 14.2684 17.6986 15.5771C16.1261 16.9282 14.1843 18 12 18C9.81574 18 7.87402 16.9282 6.30147 15.5771ZM12 4C9.14754 4 6.75717 5.39462 4.99812 6.90595C3.23268 8.42276 2.00757 10.1376 1.46387 10.9698C1.05306 11.5985 1.05306 12.4015 1.46387 13.0302C2.00757 13.8624 3.23268 15.5772 4.99812 17.0941C6.75717 18.6054 9.14754 20 12 20C14.8525 20 17.2429 18.6054 19.002 17.0941C20.7674 15.5772 21.9925 13.8624 22.5362 13.0302C22.947 12.4015 22.947 11.5985 22.5362 10.9698C21.9925 10.1376 20.7674 8.42276 19.002 6.90595C17.2429 5.39462 14.8525 4 12 4ZM10 12C10 10.8954 10.8955 10 12 10C13.1046 10 14 10.8954 14 12C14 13.1046 13.1046 14 12 14C10.8955 14 10 13.1046 10 12ZM12 8C9.7909 8 8.00004 9.79086 8.00004 12C8.00004 14.2091 9.7909 16 12 16C14.2092 16 16 14.2091 16 12C16 9.79086 14.2092 8 12 8Z"/></svg>
                                    @else
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2" /><path d="M7 11V7a5 5 0 0110 0v4" /></svg>
                                    @endif
                                </div>
                            </div>
                            <h3>{{ $step['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Workflow CTA --}}
        <section class="aparsvc-cta aparsvc-cta--green-blue" aria-labelledby="aparsvc-cta-workflow-title">
            <div class="site-shell aparsvc-cta__inner">
                <h2 id="aparsvc-cta-workflow-title">Are you Struggling with slow invoices and delayed payments?</h2>
                <p>Our experts identify bottlenecks, speed up approvals, and keep your cash flow healthy.</p>
                <a href="#" class="aparsvc-btn aparsvc-btn--light" data-contact-modal-trigger>
                    Request a Free AP Workflow Assessment
                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </section>

        {{-- Accounting software --}}
        <section class="aparsvc-section" aria-labelledby="aparsvc-software-title">
            <div class="site-shell">
                <div class="aparsvc-heading">
                    <h2 id="aparsvc-software-title">Accounting Software We Use</h2>
                    <p>
                        We deliver maximum value with proven expertise in leading finance and accounting software, robust processes, and industry best practices for seamless outsourcing solutions.
                    </p>
                </div>

                <div
                    class="aparsvc-logos"
                    x-data="{
                        index: 0,
                        perView: 6,
                        total: {{ count($softwareLogos) }},
                        get maxIndex() { return Math.max(0, this.total - this.perView); },
                        get pages() { return Array.from({ length: Math.max(1, this.maxIndex + 1) }, (_, i) => i); },
                        prev() { this.index = Math.max(0, this.index - 1); },
                        next() { this.index = Math.min(this.maxIndex, this.index + 1); },
                        go(i) { this.index = Math.min(this.maxIndex, Math.max(0, i)); },
                        resize() {
                            this.perView = window.innerWidth < 640 ? 2 : (window.innerWidth < 900 ? 3 : (window.innerWidth < 1100 ? 4 : 6));
                            this.index = Math.min(this.index, this.maxIndex);
                        }
                    }"
                    x-init="resize(); window.addEventListener('resize', () => resize())"
                >
                    <button type="button" class="aparsvc-logos__nav" @click="prev()" :disabled="index === 0" aria-label="Previous logos">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="aparsvc-logos__viewport">
                        <div
                            class="aparsvc-logos__track"
                            :style="`transform: translateX(calc(-${index} * (100% / ${perView}))); --per-view: ${perView}`"
                        >
                            @foreach ($softwareLogos as $logo)
                                <div class="aparsvc-logos__item">
                                    <img
                                        src="{{ $img($logo['file']) }}"
                                        alt="{{ $logo['alt'] }}"
                                        width="140"
                                        height="56"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="button" class="aparsvc-logos__nav" @click="next()" :disabled="index >= maxIndex" aria-label="Next logos">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>

                    <div class="aparsvc-logos__dots" aria-hidden="true">
                        <template x-for="i in pages" :key="i">
                            <button
                                type="button"
                                class="aparsvc-logos__dot"
                                :class="{ 'is-active': index === i }"
                                @click="go(i)"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        {{-- Additional offerings --}}
        <section class="aparsvc-section aparsvc-section--cream" aria-labelledby="aparsvc-offerings-title">
            <div class="site-shell">
                <div class="aparsvc-heading">
                    <h2 id="aparsvc-offerings-title">Additional Offerings</h2>
                    <p>Comprehensive financial services portfolio to support your complete business operations</p>
                </div>

                <div class="aparsvc-offerings" role="list">
                    @foreach ($offerings as $item)
                        <a href="{{ $item['href'] }}" class="aparsvc-offering-card" role="listitem">
                            <span class="aparsvc-offering-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- FAQ + form --}}
        <section class="aparsvc-section aparsvc-section--soft" id="aparsvc-consult" aria-labelledby="aparsvc-faq-title">
            <div class="site-shell aparsvc-consult">
                <div class="aparsvc-consult__faq">
                    <h2 id="aparsvc-faq-title">Frequently Asked Questions</h2>

                    <div class="content-faq-list aparsvc-faq">
                        @foreach ($faqs as $index => $faq)
                            <details @if ($index === 0) open @endif>
                                <summary>
                                    <span>{{ $index + 1 }}. {{ $faq['q'] }}</span>
                                </summary>
                                <div>{{ $faq['a'] }}</div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <aside class="aparsvc-consult__card" aria-labelledby="aparsvc-consult-title">
                    <h3 id="aparsvc-consult-title">Ready to transform your financial operations?</h3>
                    <p>Fill out the form below and our experts will help you optimize your Accounts Payable and Receivable processes.</p>

                    <livewire:forms.contact-form
                        form-name="accounts-payable-and-accounts-receivable-services"
                        id-prefix="aparsvc"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your AP/AR needs"
                        submit-label="BOOK FREE CONSULTATION"
                        layout="home"
                        thank-you-url="/thanks-you-for-ap-ar-management/"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
