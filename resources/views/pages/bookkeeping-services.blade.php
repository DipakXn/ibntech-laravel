@php
    $img = fn (string $file): string => asset('images/bookkeeping-services/'.$file);

    $trustPills = [
        ['icon' => 'fa-medal', 'label' => '120+ Certified Bookkeeper'],
        ['icon' => 'fa-gauge-high', 'label' => '70% Operational Cost Savings'],
        ['icon' => 'fa-layer-group', 'label' => '26+ Software Expertise'],
    ];

    $stats = [
        ['value' => '95%', 'label' => 'Client Retention Rate'],
        ['value' => '26+', 'label' => 'Years of Experience'],
        ['value' => '1,500+', 'label' => 'Active Global Clients'],
        ['value' => '30+', 'label' => 'Industries Served'],
    ];

    $caseStudies = $caseStudies ?? app(\App\Repositories\CaseStudyRepository::class)->getPublishedByCategorySlug('finance-and-accounting-case-studies', limit: 3);

    $outsourcedCards = [
        [
            'icon' => 'fa-file-lines',
            'title' => 'Transaction Management',
            'text' => 'Complete categorization and reconciliation of all your accounts to ensure accuracy.',
        ],
        [
            'icon' => 'fa-chart-column',
            'title' => 'Financial Reporting',
            'text' => 'Detailed financial reports and business insights crucial for strategic planning.',
        ],
        [
            'icon' => 'fa-file-pen',
            'title' => 'Tax Preparation',
            'text' => 'Professional support for tax return preparation and filing, giving you peace of mind.',
        ],
        [
            'icon' => 'fa-cloud',
            'title' => 'Cloud-Based Solutions',
            'text' => 'Secure, accessible financial management, allowing you to view and manage your data from anywhere.',
        ],
    ];

    $professionalServices = [
        [
            'image' => 'invoice-generation.webp',
            'title' => 'Invoice Generation & Expense Posting',
            'bullets' => [
                'Create and manage professional invoices.',
                'Record and categorize expenses for accurate tracking.',
                'Maintain organized financial records.',
            ],
        ],
        [
            'image' => 'bank-credit-card-transaction-processing.webp',
            'title' => 'Bank & Credit Card Transaction Processing',
            'bullets' => [
                'Import and reconcile transactions from bank and credit card accounts.',
                'Ensure accurate categorization and detect discrepancies early.',
            ],
        ],
        [
            'image' => 'track-receivables-payables.webp',
            'title' => 'Track Receivables & Payables',
            'bullets' => [
                'Monitor incoming payments and outstanding invoices.',
                'Stay on top of vendor bills and outgoing payments.',
                'Maintain healthy cash flow visibility.',
            ],
        ],
        [
            'image' => 'end-to-end-payroll-processing.webp',
            'title' => 'End-to-End Payroll Processing',
            'bullets' => [
                'Manage payroll calculations, deductions, and disbursements.',
                'Ensure a timely and compliant payroll for your team.',
                'Handle statutory filings and reports.',
            ],
        ],
        [
            'image' => null,
            'icon' => 'fa-book',
            'title' => 'Journal Entry Processing',
            'bullets' => [
                'Record and manage journal entries with precision.',
                'Maintain accurate and compliant financial statements.',
            ],
        ],
        [
            'image' => 'cash-flow-forecasting.webp',
            'title' => 'Cash Flow Forecasting',
            'bullets' => [
                'Analyze income and expenses to project future cash flow.',
                'Make proactive financial decisions with confidence.',
                'Identify potential shortfalls and opportunities.',
            ],
        ],
    ];

    $cfoBullets = [
        'Weekly/Monthly Cash Flow Forecasting',
        'Financial Health Checks – detect unusual accounting practices',
        'Long-term Forecasting (3-5 year P&L, Balance Sheet projections)',
        'Budgeting & Budget vs. Actual Analysis',
        'Industry Benchmarking & Ratio Analysis via ProfitCents tool',
        'Management Reporting – comparative P&L, balance sheets, cash flow, AR/AP aging',
    ];

    $usFeatures = [
        [
            'icon' => 'fa-calculator',
            'title' => 'Tax Filing & Planning',
            'text' => 'Expert management of multi-jurisdictional sales tax, federal and state inome tax preparation, and strategic tax planning to minimize liabilities and ensure timely filings across all 50 states. We keep you compliant with ever-changing tax laws.',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Bookkeeping and Payroll Services',
            'text' => 'Seamless processing of Social Security, Medicare, and unemployment taxes. Our bookkeeping and payroll services ensure accurate and timely compensation for your employees, handling all deductions and compliance requirements with precision.',
        ],
        [
            'icon' => 'fa-file-lines',
            'title' => 'Regulatory Adherence & Reporting',
            'text' => 'Complete SEC reporting support and strict adherence to US GAAP compliance. We ensure your financial statements are accurate, transparent, and meet all regulatory standards, building trust with stakeholders.',
        ],
        [
            'icon' => 'fa-map-location-dot',
            'title' => 'State-Specific Requirements',
            'text' => 'Leverage our specialized knowledge of varying state regulations, licenses, and reporting mandates. We provide localized expertise to ensure your business remains compliant no matter where you operate within the US.',
        ],
        [
            'icon' => 'fa-diagram-project',
            'title' => 'Technology Integration',
            'text' => 'QuickBooks Desktop and Online expertise for streamlined operations. NetSuite and Xero implementation and management for modern cloud accounting. Real-time financial dashboards providing instant insights into your business performance.',
        ],
    ];

    $ukFeatures = [
        [
            'icon' => 'fa-desktop',
            'title' => 'Making Tax Digital (MTD) Compliance',
            'text' => 'Complete MTD compliance for VAT, Income Tax, and Corporation Tax. We ensure your digital records and submissions meet all HMRC requirements, simplifying your tax obligations and avoiding penalties.',
        ],
        [
            'icon' => 'fa-percent',
            'title' => 'VAT Management & Optimization',
            'text' => 'Expert handling of VAT registration, accurate returns, and strategic optimization strategies. We help you manage your VAT obligations efficiently, ensuring compliance and maximizing cash flow.',
        ],
        [
            'icon' => 'fa-user-check',
            'title' => 'PAYE Services & Payroll Compliance',
            'text' => 'Comprehensive PAYE services, including Real-Time Information (RTI) submissions and full payroll compliance. We manage all aspects of your UK payroll, ensuring your employees are paid correctly and on time.',
        ],
        [
            'icon' => 'fa-building-columns',
            'title' => 'Regulatory Support & Filings',
            'text' => 'Assistance with Companies House filings and adherence to IFRS reporting standards. We keep your business compliant with all statutory requirements, providing peace of mind.',
        ],
        [
            'icon' => 'fa-gears',
            'title' => 'Advanced UK Capabilities',
            'text' => 'Expertise in Sage, Xero, and FreeAgent platforms for seamless integration. Specialized Construction Industry Scheme (CIS) compliance services. Guidance on IR35 and working off-payroll regulations to ensure correct employment status. Support with Brexit-related trade documentation for smooth international operations.',
        ],
    ];

    $softwareLogos = [
        ['file' => 'Intuit-QuickBooks.webp', 'alt' => 'Intuit QuickBooks'],
        ['file' => 'Sage.webp', 'alt' => 'Sage'],
        ['file' => 'zoho-books.webp', 'alt' => 'Zoho Books'],
        ['file' => 'Yardi.webp', 'alt' => 'Yardi'],
        ['file' => 'Xero-software.webp', 'alt' => 'Xero'],
        ['file' => 'Netsuite-1.webp', 'alt' => 'NetSuite'],
    ];

    $processSteps = [
        [
            'title' => 'Discovery & Setup',
            'items' => [
                'In-depth business requirements analysis to understand your unique needs and goals.',
                'Strategic platform selection and meticulous setup of your chosen accounting software.',
                'Seamless historical data migration, ensuring accuracy and continuity from day one.',
                'Introduction to your dedicated bookkeeping team, fostering clear communication and trust.',
            ],
        ],
        [
            'title' => 'Integration & Automation',
            'items' => [
                'Standardization of all financial processes to enhance efficiency and consistency.',
                'Implementation of advanced automation tools to reduce manual effort and errors.',
                'Establishment of rigorous quality assurance protocols for data integrity and accuracy.',
                'Definition and establishment of key performance metrics to track financial health.',
            ],
        ],
        [
            'title' => 'Optimization & Strategic Advisory',
            'items' => [
                'Continuous improvement initiatives to refine processes and maximize financial efficiency.',
                'Regular performance reviews and detailed reporting to keep you informed and in control.',
                'Proactive technology upgrades and enhancements to leverage the latest financial tools.',
                'Strategic advisory services, providing insights and guidance for future business growth.',
            ],
        ],
    ];

    $industries = [
        [
            'icon' => 'fa-building',
            'color' => '#3b82f6',
            'title' => 'Real Estate Bookkeeping Services',
            'text' => 'We simplify financial management for property owners by accurately tracking rental income, expenses, and deductions. We are a service that grows with your portfolio. Keep things organized and keep up with compliance all while your efforts are concentrated on growing the assets.',
            'slug' => 'real-estate-construction-bookkeeping-services',
        ],
        [
            'icon' => 'fa-chart-pie',
            'color' => '#8b5cf6',
            'title' => 'Financial Reporting Bookkeeping Services',
            'text' => 'Stay audit-ready with precise recordkeeping and compliance-focused bookkeeping. We support financial institutions with reliable and secure financial management. Focus on growth while we ensure regulatory alignment.',
            'slug' => 'finance-businesses-bookkeeping-service',
        ],
        [
            'icon' => 'fa-bullhorn',
            'color' => '#ec4899',
            'title' => 'Marketing Agencies Bookkeeping Services',
            'text' => 'Track campaign budgets, expenses, and ROI with clarity. Our bookkeeping helps you optimize resource allocation and improve profitability. Make data-driven decisions with confidence.',
            'slug' => 'marketing-and-advertising-bookkeeping-services',
        ],
        [
            'icon' => 'fa-hotel',
            'color' => '#f59e0b',
            'title' => 'Hospitality Bookkeeping',
            'text' => 'Manage fluctuating cash flows and vendor payments with accuracy. Our real-time financial reporting helps you maintain control during peak and off-peak seasons. Focus on guest satisfaction while we handle your books.',
            'slug' => 'hospitality-bookkeeping-and-accounting-services',
        ],
        [
            'icon' => 'fa-store',
            'color' => '#10b981',
            'title' => 'Retail Bookkeeping',
            'text' => 'Keep your inventory and sales data aligned with streamlined bookkeeping. We help you maintain healthy profit margins and reduce financial discrepancies. Make smarter business decisions with clear financial insights.',
            'slug' => 'bookkeeping-services-for-retail-stores',
        ],
        [
            'icon' => 'fa-cart-shopping',
            'color' => '#06b6d4',
            'title' => 'Ecommerce Bookkeeping',
            'text' => 'Manage multi-channel sales and returns with digital bookkeeping. Your online growth is reflected in your financial records by us. Stand fast and stay informed in an ecommerce whirlwind.',
            'slug' => 'ecommerce-bookkeeping-services',
        ],
        [
            'icon' => 'fa-heart-pulse',
            'color' => '#ef4444',
            'title' => 'Healthcare Bookkeeping',
            'text' => 'Keep on top of medical requirements and make sure billing and payroll run smoothly. Our payroll and bookkeeper service safeguards sensitive financial information. Concentrate on patients while we work on your business.',
            'slug' => 'healthcare-bookkeeping-services',
        ],
        [
            'icon' => 'fa-briefcase',
            'color' => '#6366f1',
            'title' => 'CPA Bookkeeping Services',
            'text' => 'Offload routine bookkeeping tasks to free up time for strategic advisory and tax planning. Accuracy and consistency are assured in your financial records. The client services offer seamless back-office support.',
            'slug' => null,
        ],
        [
            'icon' => 'fa-plane',
            'color' => '#0ea5e9',
            'title' => 'Travel Bookkeeping Services',
            'text' => 'Track bookings, commissions, and travel-related expenses with customized financial solutions. We help you stay organized and profitable in a dynamic industry. Spend time creating beautiful memories as we manage your finances.',
            'slug' => 'travel-bookkeeping-service',
        ],
        [
            'icon' => 'fa-scale-balanced',
            'color' => '#78716c',
            'title' => 'Legal Bookkeeping Services',
            'text' => 'Maintain trust account integrity and billing accuracy with meticulous bookkeeping. Our services are tailored to meet the unique needs of law firms. Stay compliant and focused on your legal practice.',
            'slug' => 'legal-bookkeeping-services',
        ],
        [
            'icon' => 'fa-industry',
            'color' => '#64748b',
            'title' => 'Manufacturing Bookkeeping Services',
            'text' => 'Monitor production costs and supply chain finances with detailed financial reporting. We help you identify inefficiencies and boost profitability. Stay competitive with clear insights into your operations.',
            'slug' => 'manufacturing-accounting-and-bookkeeping-services',
        ],
        [
            'icon' => 'fa-laptop-code',
            'color' => '#14b8a6',
            'title' => 'IT Bookkeeping Services',
            'text' => 'Manage project-based billing and R&D expenses with scalable financial solutions. We support innovation-driven companies with accurate and flexible bookkeeping. Focus on development while we keep your finances in check.',
            'slug' => 'it-business-bookkeeping-service',
        ],
    ];

    $specializedServices = [
        [
            'image' => null,
            'icon' => 'fa-file-invoice-dollar',
            'title' => 'Accounts Receivable Services',
            'items' => [
                'Invoice generation',
                'Payment tracking and reconciliation',
                'Customer communication and follow-ups',
                'Aging reports and analysis',
                'Dispute resolution and escalation',
                'Integration with accounting systems',
            ],
        ],
        [
            'image' => null,
            'icon' => 'fa-file-invoice',
            'title' => 'Accounts Payable Services',
            'items' => [
                'Invoice processing and approvals',
                'Vendor management and payments',
                'Expense tracking and reporting',
                'Payment scheduling and automation',
                'Compliance and audit support',
                'Integration with ERP/accounting platforms',
            ],
        ],
        [
            'image' => 'payroll-services-1.webp',
            'title' => 'Payroll Services',
            'items' => [
                'Live payroll processing',
                'After-the-fact payroll',
                'Tax filing and compliance',
                'Employee self-service portal',
            ],
        ],
        [
            'image' => 'tax-support.webp',
            'title' => 'Tax Support',
            'items' => [
                'Updating tax forms (990s, 1040s, 1120s)',
                'Tax planning and strategy',
                'Liaison with tax advisors',
                'Comprehensive tax review',
            ],
        ],
        [
            'image' => 'financial-reporting.webp',
            'title' => 'Financial Reporting',
            'items' => [
                'Cash flow statements',
                'Income statements & balance sheets',
                'Key performance indicators (KPIs)',
            ],
        ],
        [
            'image' => null,
            'icon' => 'fa-vault',
            'title' => 'Treasury Management Services',
            'items' => [
                'Cash Flow & Liquidity Optimization',
                'Treasury Control Frameworks',
                'Financial Risk mitigation',
                'Working capital optimization',
                'Cost Reduction & Efficiency',
                'Payment and collection solution optimization',
            ],
        ],
    ];

    $faqs = [
        [
            'q' => 'How do you ensure the security of our financial data?',
            'a' => 'We secure your financial information through encrypted systems, secure cloud storage, and strict assigned access.',
        ],
        [
            'q' => 'How do I maintain control over my finances when using outsourced bookkeeping?',
            'a' => 'Yes, you receive regular updates, full record access, and clear communication at every step.',
        ],
        [
            'q' => 'How does remote bookkeeping work?',
            'a' => 'We handle your accounts using cloud-based tools, securely exchange documents, and deliver timely financial updates.',
        ],
    ];

    $pricingUrl = \Illuminate\Support\Facades\Route::has('page.show')
        ? route('page.show', ['slug' => 'pricing'])
        : url('/pricing');
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/bookkeeping-services.css'])
@endpush

@section('content')
    <div class="bkpsvc-page">
        {{-- 1. Promo banner --}}
        <div
            class="bkpsvc-promo"
            x-data="{
                open: true,
                init() {
                    try { this.open = sessionStorage.getItem('bkpsvcPromoDismissed') !== '1'; } catch (e) {}
                },
                dismiss() {
                    this.open = false;
                    try { sessionStorage.setItem('bkpsvcPromoDismissed', '1'); } catch (e) {}
                }
            }"
            x-show="open"
            x-cloak
            x-transition.opacity
        >
            <div class="site-shell bkpsvc-promo__inner">
                <p class="bkpsvc-promo__copy">
                    <span class="bkpsvc-promo__bell" aria-hidden="true">🔔</span>
                    <strong>Book now and Get 20% off for the coming quarter – limited time offer!</strong>
                </p>
                <a href="{{ $pricingUrl }}" class="bkpsvc-promo__btn">Check Pricing Plans</a>
                <button type="button" class="bkpsvc-promo__close" @click="dismiss()" aria-label="Close banner">
                    <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        {{-- 2. Hero --}}
        <section
            class="bkpsvc-hero"
            aria-labelledby="bkpsvc-hero-title"
            style="--bkpsvc-hero-image: url('{{ $img('Outsource-Bookkeeping-Services-for-US-and-UK-Businesses.webp') }}')"
        >
            <div class="site-shell bkpsvc-hero__inner">
                <div class="bkpsvc-hero__copy">
                    <h1 id="bkpsvc-hero-title">
                        Outsource Bookkeeping Services for
                        <span class="bkpsvc-hero__accent">US and UK Businesses</span>
                    </h1>
                    <p class="bkpsvc-hero__sub">Professional, reliable, and cost-effective.</p>
                    <p class="bkpsvc-hero__lede">
                        Transform your financial operations with our cutting-edge business book keeping services in the USA and UK.
                    </p>
                    <div class="bkpsvc-hero__actions">
                        <a href="#bkpsvc-consult" class="bkpsvc-btn bkpsvc-btn--navy">
                            Get Started with 20-Hour Free Trial
                            <i class="fa-solid fa-circle-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                    <ul class="bkpsvc-trust" aria-label="Key trust metrics">
                        @foreach ($trustPills as $pill)
                            <li>
                                <i class="fa-solid {{ $pill['icon'] }}" aria-hidden="true"></i>
                                <span>{{ $pill['label'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bkpsvc-hero__media">
                    <img
                        src="{{ $img('outsource-bookkeeping-US-UK-Banner.webp') }}"
                        alt="Outsource Bookkeeping Services for US and UK Businesses"
                        width="385"
                        height="385"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- 3. Stats bar --}}
        <section class="bkpsvc-stats" aria-label="Company statistics">
            <div class="site-shell">
                <div class="bkpsvc-stats__inner">
                    @foreach ($stats as $stat)
                        <div class="bkpsvc-stats__item">
                            <strong>{{ $stat['value'] }}</strong>
                            <span>{{ $stat['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- 4. Virtual Bookkeeping --}}
        <section class="bkpsvc-section" aria-labelledby="bkpsvc-virtual-title">
            <div class="site-shell bkpsvc-split">
                <div class="bkpsvc-split__copy">
                    <h2 id="bkpsvc-virtual-title">Virtual Bookkeeping Services for Growing Businesses</h2>
                    <p>
                        For many growing businesses, keeping financial records accurate and up to date is a constant challenge. It feels like a risk to pick the right firm to help. Yet, right book keeping is key not just for rules, but for smart business moves.
                    </p>
                    <p>
                        IBN Tech is here to help. We are a leading provider of virtual bookkeeping services, offering cloud-based solutions that are efficient, affordable, and customized to your business. Our team of experienced professionals handles everything from transaction categorization and account reconciliation to tax preparation and financial reporting.
                    </p>
                    <p>
                        We serve clients in the U.S., and U.K. Our services include internal bookkeeping, enterprise accounting, tax return preparation and filing, and financial advisory- all delivered through secure cloud platforms and leading accounting software. We understand that every business is different, which is why we offer fully customizable solutions that grow with you.
                    </p>
                </div>
                <div class="bkpsvc-split__media">
                    <img
                        src="{{ $img('Virtual-Bookkeeping-Services-for-Growing-Businesses.webp') }}"
                        alt="Virtual Bookkeeping Services for Growing Businesses"
                        width="540"
                        height="540"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- 5. Success Stories --}}
        @if ($caseStudies->isNotEmpty())
            <section class="bkpsvc-section" aria-labelledby="bkpsvc-stories-title">
                <div class="site-shell">
                    <div class="bkpsvc-heading">
                        <h2 id="bkpsvc-stories-title">Success Stories: Transforming Businesses Through Outsourced Bookkeeping</h2>
                    </div>

                    <div class="bkpsvc-stories" role="list">
                        @foreach ($caseStudies as $study)
                            <article class="bkpsvc-story-card" role="listitem">
                                @php
                                    $studyImageUrl = $study->featuredImageUrl();
                                    if (! $studyImageUrl && $study->featured_image) {
                                        if (file_exists(public_path('images/bookkeeping-services/' . $study->featured_image))) {
                                            $studyImageUrl = asset('images/bookkeeping-services/' . $study->featured_image);
                                        } elseif (file_exists(public_path($study->featured_image))) {
                                            $studyImageUrl = asset($study->featured_image);
                                        }
                                    }
                                @endphp
                                @if ($studyImageUrl)
                                    <div class="bkpsvc-story-card__media">
                                        <img
                                            src="{{ $studyImageUrl }}"
                                            alt="{{ $study->title }}"
                                            width="400"
                                            height="225"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    </div>
                                @endif
                                <div class="bkpsvc-story-card__body">
                                    <h3>{{ $study->title }}</h3>
                                    <a href="{{ route('case-studies.show', $study->slug) }}">
                                        VIEW CASE STUDY »
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- 6. CTA band --}}
        <section class="bkpsvc-cta bkpsvc-cta--navy" aria-labelledby="bkpsvc-cta-success-title">
            <div class="site-shell bkpsvc-cta__inner">
                <h2 id="bkpsvc-cta-success-title">Want to become our next success story?</h2>
                <p>Join hundreds of businesses that have transformed their financial operations with our outsourced bookkeeping services.</p>
                <a href="#" class="bkpsvc-btn bkpsvc-btn--light" data-contact-modal-trigger>
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    Schedule Your Free Consultation
                </a>
            </div>
        </section>

        {{-- 7. Outsourced Bookkeeping Services --}}
        <section class="bkpsvc-section bkpsvc-section--soft" aria-labelledby="bkpsvc-outsourced-title">
            <div class="site-shell">
                <div class="bkpsvc-heading">
                    <h2 id="bkpsvc-outsourced-title">Outsourced Bookkeeping Services</h2>
                    <p>
                        From freelancers and small businesses to large enterprises, every business needs good bookkeeping. We offer online accounting and bookkeeping services that cover a wide spectrum of solutions, ensuring your accounts are accurate, compliant, and ready for decision-making. Our offerings include:
                    </p>
                </div>

                <div class="bkpsvc-icon-grid" role="list">
                    @foreach ($outsourcedCards as $card)
                        <article class="bkpsvc-icon-card" role="listitem">
                            <span class="bkpsvc-icon-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </span>
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- 8. Professional Bookkeeping Services --}}
        <section class="bkpsvc-section bkpsvc-section--soft bkpsvc-section--tight-top" aria-labelledby="bkpsvc-pro-title">
            <div class="site-shell">
                <div class="bkpsvc-heading">
                    <h2 id="bkpsvc-pro-title">Professional Bookkeeping Services</h2>
                    <p>We handle the day-to-day financial tasks with precision, ensuring your records are always up-to-date and organized.</p>
                </div>

                <div class="bkpsvc-pro-grid" role="list">
                    @foreach ($professionalServices as $service)
                        <article class="bkpsvc-pro-card" role="listitem">
                            <div class="bkpsvc-pro-card__icon" aria-hidden="true">
                                @if (! empty($service['image']))
                                    <img
                                        src="{{ $img($service['image']) }}"
                                        alt=""
                                        width="65"
                                        height="65"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                @else
                                    <i class="fa-solid {{ $service['icon'] }}"></i>
                                @endif
                            </div>
                            <h3>{{ $service['title'] }}</h3>
                            <ul>
                                @foreach ($service['bullets'] as $bullet)
                                    <li>
                                        <i class="fa-solid fa-thumbs-up" aria-hidden="true"></i>
                                        <span>{{ $bullet }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>

                <article class="bkpsvc-cfo" aria-labelledby="bkpsvc-cfo-title">
                    <h3 id="bkpsvc-cfo-title">CFO Assistance &amp; Financial Advisory</h3>
                    <p>Beyond bookkeeping, IBN Tech provides strategic financial guidance:</p>
                    <ul class="bkpsvc-cfo__list">
                        @foreach ($cfoBullets as $bullet)
                            <li>
                                <i class="fa-solid fa-thumbs-up" aria-hidden="true"></i>
                                <span>{{ $bullet }}</span>
                            </li>
                        @endforeach
                    </ul>
                </article>
            </div>
        </section>

        {{-- 9. Specialized Services by Region --}}
        <section class="bkpsvc-section" aria-labelledby="bkpsvc-region-title">
            <div class="site-shell">
                <div class="bkpsvc-heading">
                    <h2 id="bkpsvc-region-title">Specialized Services by Region</h2>
                    <p>
                        Our expert teams provide personalized bookkeeping solutions designed to meet the unique regulatory and financial demands of businesses in the U.S. and the U.K. We help you navigate complex compliance, optimize your financial operations, and ensure accurate reporting, allowing you to focus on core business growth
                    </p>
                </div>

                <div class="bkpsvc-regions">
                    <article class="bkpsvc-region">
                        <header class="bkpsvc-region__head">
                            <img
                                src="{{ $img('united-states-flag-icon.webp') }}"
                                alt=""
                                width="48"
                                height="48"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>US Bookkeeping Services</h3>
                        </header>
                        <p>
                            Our expert teams provide personalized
                            <a href="{{ route('page.show', ['slug' => 'bookkeeping-services-usa']) }}">outsourced bookkeeping services in USA</a>,
                            tailored to meet the unique regulatory and financial demands of businesses. We help you navigate complex compliance requirements, optimize financial operations, and ensure accurate reporting. With our support, you can focus on driving core business growth while we handle the numbers.
                        </p>
                        <div class="bkpsvc-region__features">
                            @foreach ($usFeatures as $index => $feature)
                                <div class="bkpsvc-region-feature{{ $index === 0 ? ' is-active' : '' }}">
                                    <span class="bkpsvc-region-feature__icon" aria-hidden="true">
                                        <i class="fa-solid {{ $feature['icon'] }}"></i>
                                    </span>
                                    <h4>{{ $feature['title'] }}</h4>
                                    <p>{{ $feature['text'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </article>

                    <article class="bkpsvc-region">
                        <header class="bkpsvc-region__head">
                            <img
                                src="{{ $img('united-kingdom-flag-icon.webp') }}"
                                alt=""
                                width="48"
                                height="48"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>UK Bookkeeping Services</h3>
                        </header>
                        <p>
                            With UK firms facing challenges in recruiting qualified accounting staff,
                            <a href="{{ route('page.show', ['slug' => 'bookeeping-for-uk']) }}">outsourced bookkeeping services in UK</a>
                            have become a strategic necessity. Our specialized services ensure full compliance with evolving regulations, including the expansion of Making Tax Digital (MTD) and changing HMRC requirements. We help your business thrive by removing compliance worries and streamlining operations.
                        </p>
                        <div class="bkpsvc-region__features">
                            @foreach ($ukFeatures as $index => $feature)
                                <div class="bkpsvc-region-feature{{ $index === 0 ? ' is-active' : '' }}">
                                    <span class="bkpsvc-region-feature__icon" aria-hidden="true">
                                        <i class="fa-solid {{ $feature['icon'] }}"></i>
                                    </span>
                                    <h4>{{ $feature['title'] }}</h4>
                                    <p>{{ $feature['text'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- 10. Software logos --}}
        <section class="bkpsvc-section bkpsvc-section--soft" aria-labelledby="bkpsvc-software-title">
            <div class="site-shell">
                <div class="bkpsvc-heading">
                    <h2 id="bkpsvc-software-title">Integrated Bookkeeping Software for Small Businesses</h2>
                </div>

                <div
                    class="bkpsvc-logos"
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
                    <button type="button" class="bkpsvc-logos__nav" @click="prev()" :disabled="index === 0" aria-label="Previous logos">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="bkpsvc-logos__viewport">
                        <div
                            class="bkpsvc-logos__track"
                            :style="`transform: translateX(calc(-${index} * (100% / ${perView}))); --per-view: ${perView}`"
                        >
                            @foreach ($softwareLogos as $logo)
                                <div class="bkpsvc-logos__item">
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

                    <button type="button" class="bkpsvc-logos__nav" @click="next()" :disabled="index >= maxIndex" aria-label="Next logos">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>

                    <div class="bkpsvc-logos__dots" aria-hidden="true">
                        <template x-for="i in pages" :key="i">
                            <button
                                type="button"
                                class="bkpsvc-logos__dot"
                                :class="{ 'is-active': index === i }"
                                @click="go(i)"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        {{-- 11. ERP/DMS --}}
        <section class="bkpsvc-section" aria-labelledby="bkpsvc-erp-title">
            <div class="site-shell">
                <div class="bkpsvc-heading bkpsvc-heading--narrow">
                    <h2 id="bkpsvc-erp-title">Outsourced Accounting: Simplified ERP and DMS Integration</h2>
                    <p>
                        Transform your business workflows with IBN Technologies’ bookkeeping services for small businesses. Experience end-to-end solutions and enhance operational efficiency with seamless integration of ERP and Document Management Systems (DMS).
                    </p>
                </div>
            </div>
        </section>

        {{-- 12. Implementation Process --}}
        <section class="bkpsvc-section bkpsvc-section--cream" aria-labelledby="bkpsvc-process-title">
            <div class="site-shell">
                <div class="bkpsvc-heading">
                    <h2 id="bkpsvc-process-title">Our Seamless Implementation Process</h2>
                    <p>
                        Experience a smooth transition and continuous improvement with our meticulously designed implementation process. We ensure hassle-free onboarding and ongoing optimization, allowing you to focus on your core business while we handle your financial complexities.
                    </p>
                </div>

                <div class="bkpsvc-process" role="list">
                    @foreach ($processSteps as $index => $step)
                        <article class="bkpsvc-process-card" role="listitem">
                            <span class="bkpsvc-process-card__num" aria-hidden="true">{{ $index + 1 }}</span>
                            <h3>{{ $step['title'] }}</h3>
                            <ol>
                                @foreach ($step['items'] as $itemIndex => $item)
                                    <li>
                                        <span class="bkpsvc-process-card__step">{{ $itemIndex + 1 }}.</span>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ol>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- 13. CTA band --}}
        <section class="bkpsvc-cta bkpsvc-cta--navy" aria-labelledby="bkpsvc-cta-books-title">
            <div class="site-shell bkpsvc-cta__inner">
                <h2 id="bkpsvc-cta-books-title">Books a mess? Let’s fix them today!</h2>
                <p>Get your records cleaned up, reconciled, and ready for tax season and business decision.</p>
                <a href="#" class="bkpsvc-btn bkpsvc-btn--light" data-contact-modal-trigger>
                    Start with a free consultation
                </a>
            </div>
        </section>

        {{-- 14. Industry-Specific Bookkeeping Services --}}
        <section class="bkpsvc-section" aria-labelledby="bkpsvc-industry-title">
            <div class="site-shell">
                <div class="bkpsvc-heading">
                    <h2 id="bkpsvc-industry-title">Industry-Specific Bookkeeping Services</h2>
                    <p>
                        We deliver industry-specific outsourced bookkeeping solutions designed to meet the distinct financial requirements of your business, enhancing operational efficiency, ensuring compliance, and supporting sustainable growth. Here’s how we add value:
                    </p>
                </div>

                <div class="bkpsvc-industry-grid" role="list">
                    @foreach ($industries as $industry)
                        @if ($industry['slug'])
                            <a
                                href="{{ route('page.show', ['slug' => $industry['slug']]) }}"
                                class="bkpsvc-industry-card bkpsvc-industry-card--link"
                                role="listitem"
                            >
                                <span
                                    class="bkpsvc-industry-card__icon"
                                    style="--bkpsvc-icon-bg: {{ $industry['color'] }}1a; --bkpsvc-icon-color: {{ $industry['color'] }}"
                                    aria-hidden="true"
                                >
                                    <i class="fa-solid {{ $industry['icon'] }}"></i>
                                </span>
                                <h3>{{ $industry['title'] }}</h3>
                                <p>{{ $industry['text'] }}</p>
                            </a>
                        @else
                            <article class="bkpsvc-industry-card" role="listitem">
                                <span
                                    class="bkpsvc-industry-card__icon"
                                    style="--bkpsvc-icon-bg: {{ $industry['color'] }}1a; --bkpsvc-icon-color: {{ $industry['color'] }}"
                                    aria-hidden="true"
                                >
                                    <i class="fa-solid {{ $industry['icon'] }}"></i>
                                </span>
                                <h3>{{ $industry['title'] }}</h3>
                                <p>{{ $industry['text'] }}</p>
                            </article>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        {{-- 15. Specialized Services --}}
        <section class="bkpsvc-section bkpsvc-section--soft" aria-labelledby="bkpsvc-special-title">
            <div class="site-shell">
                <div class="bkpsvc-heading">
                    <h2 id="bkpsvc-special-title">Specialized Services</h2>
                    <p>In addition to bookkeeping, we offer specialized services to support your business.</p>
                </div>

                <div class="bkpsvc-special-grid" role="list">
                    @foreach ($specializedServices as $service)
                        <article class="bkpsvc-special-card" role="listitem">
                            <div class="bkpsvc-special-card__head">
                                <span class="bkpsvc-special-card__icon" aria-hidden="true">
                                    @if (! empty($service['image']))
                                        <img
                                            src="{{ $img($service['image']) }}"
                                            alt=""
                                            width="52"
                                            height="52"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    @else
                                        <i class="fa-solid {{ $service['icon'] }}"></i>
                                    @endif
                                </span>
                                <h3>{{ $service['title'] }}</h3>
                            </div>
                            <ul>
                                @foreach ($service['items'] as $item)
                                    <li>
                                        <i class="fa-solid fa-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- 16. FAQ + Form --}}
        <section class="bkpsvc-section" id="bkpsvc-consult" aria-labelledby="bkpsvc-faq-title">
            <div class="site-shell bkpsvc-consult">
                <div class="bkpsvc-consult__faq">
                    <h2 id="bkpsvc-faq-title">Frequently Asked Questions</h2>

                    <div class="content-faq-list bkpsvc-faq">
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

                <aside class="bkpsvc-consult__card" aria-labelledby="bkpsvc-consult-title">
                    <h3 id="bkpsvc-consult-title">Simplify Your Finances with Bookkeeping</h3>
                    <p>Fill out the form, and we'll handle the rest.</p>

                    <livewire:forms.contact-form
                        form-name="bookkeeping-services"
                        id-prefix="bkpsvc"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell Us About Your Specific Bookkeeping Needs"
                        submit-label="BOOK FREE CONSULTATION"
                        layout="home"
                        thank-you-url="/thanks-you-for-bookkeeping/"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
