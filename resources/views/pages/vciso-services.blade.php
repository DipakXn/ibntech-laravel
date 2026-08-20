@php
    $img = fn (string $file): string => asset('images/vciso-services/'.$file);
    $certImg = fn (string $file): string => asset('images/vapt-certs/'.$file);

    $certs = [
        ['file' => 'iso-certified.webp', 'alt' => 'ISO Certified'],
        ['file' => 'seceon-professional.png', 'alt' => 'Seceon Professional'],
        ['file' => 'ceh-ethical-hacker.webp', 'alt' => 'Certified Ethical Hacker'],
        ['file' => 'fortinet-certified-network-security-professional.webp', 'alt' => 'Fortinet Certified Network Security Professional'],
        ['file' => 'certified-payment.webp', 'alt' => 'Certified Payment Security Compliance Manager'],
        ['file' => 'cisa-certification-logo.webp', 'alt' => 'CISA Certification'],
    ];

    $whyChoose = [
        [
            'icon' => 'fa-globe',
            'title' => 'Global Coverage with Local Expertise',
            'text' => '24/7 support from India for US & UK clients.',
        ],
        [
            'icon' => 'fa-bolt',
            'title' => 'Deep Technical Expertise',
            'text' => 'Strong expertise in Microsoft Security Stack, ISO 27001, and RBI guidelines',
        ],
        [
            'icon' => 'fa-star',
            'title' => 'Industry Experience',
            'text' => 'Proven success record in BFSI, Healthcare, and Tech industries',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Flexible Engagement Models',
            'text' => 'Choose from a Part-time virtual CISO, project-based advisory, or ongoing retainer options',
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Integrated Security Services',
            'text' => 'Seamless Integration with IBN Tech\'s MDR, SOC, and GRC services for end-to-end coverage',
        ],
        [
            'icon' => 'fa-gears',
            'title' => 'Business-Aligned Results',
            'text' => 'Unbiased, business-aligned, measurable results with clear ROI',
        ],
    ];

    $modules = [
        ['title' => 'Cybersecurity Strategy & Roadmap', 'text' => 'Define and implement cybersecurity roadmap aligned with business goals'],
        ['title' => 'Security Awareness Training', 'text' => 'Conduct phishing simulations, end-user awareness programs'],
        ['title' => 'Governance, Risk, and Compliance (GRC)', 'text' => 'Framework mapping (NIST, ISO 27001, PCI-DSS, HIPAA, GDPR)'],
        ['title' => 'Technology Stack Assessment', 'text' => 'Evaluate EDR, SIEM, IAM, firewall, email security tools'],
        ['title' => 'Cloud & Digital Transformation Security', 'text' => 'vCISO support for cloud adoption, SaaS migration, DevOps, and remote/hybrid teams'],
        ['title' => 'Third-Party Risk Management', 'text' => 'Define and implement cybersecurity roadmap aligned with business goals'],
        ['title' => 'Policy and Procedure Development', 'text' => 'Drafting and enforcing InfoSec, data privacy, access control policies'],
        ['title' => 'Incident Response Planning & Tabletop Exercises', 'text' => 'Develop IR playbooks, simulate breaches, test response effectiveness'],
        ['title' => 'Security Risk Assessment', 'text' => 'Define and implement cybersecurity roadmap aligned with business goals'],
        ['title' => 'Audit & Regulatory Readiness', 'text' => 'Assist in preparation for ISO 27001, SOC 2, HIPAA, RBI audits'],
        ['title' => 'Security Metrics & Reporting', 'text' => 'Monthly reporting to executive teams and board-level presentations'],
        ['title' => 'Breach Investigation Advisory', 'text' => 'Forensics support and RCA guidance during incident recovery'],
    ];

    $steps = [
        ['n' => '1', 'title' => 'Initial Assessment', 'text' => 'Evaluate current security posture, business goals, and compliance needs.'],
        ['n' => '2', 'title' => 'Strategic Planning', 'text' => 'Develop a tailored cybersecurity roadmap aligned with your objectives.'],
        ['n' => '3', 'title' => 'Implementation', 'text' => 'Implement policies, controls, and technologies to close security gaps.'],
        ['n' => '4', 'title' => 'Ongoing Management', 'text' => 'Provide ongoing oversight and adapt to evolving threats and business changes.'],
    ];

    $deliverables = [
        [
            'icon' => 'fa-file-lines',
            'title' => 'Security Strategy Document',
            'text' => 'Comprehensive roadmap aligned with business objectives',
        ],
        [
            'icon' => 'fa-chart-column',
            'title' => 'Executive Reports',
            'text' => 'Monthly dashboards and board-level presentations',
        ],
        [
            'icon' => 'fa-circle-check',
            'title' => 'Compliance Documentation',
            'text' => 'Audit-ready compliance and policy templates',
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Risk Assessments',
            'text' => 'Vendor and third-party risk evaluation reports',
        ],
        [
            'icon' => 'fa-user-check',
            'title' => 'Training Sessions',
            'text' => 'Board-level cyber awareness and staff training',
        ],
        [
            'icon' => 'fa-clipboard-list',
            'title' => 'Policy Templates',
            'text' => 'Customized security policies and procedures',
        ],
    ];

    $faqs = [
        [
            'q' => '1. What makes a vCISO different from a consultant or managed service?',
            'a' => [
                'A vCISO provides ongoing, strategic leadership and becomes part of your team unlike consultants (who provide short-term advice) or managed services (which are optional).',
                'A vCISO offers temporary advice or managed services, which are optional, and joins your team to offer continuous, strategic leadership.',
            ],
        ],
        [
            'q' => '2. How fast can vCISO support be deployed?',
            'a' => ['Deployment can start in days depending on onboarding readiness and the project’s scope.'],
        ],
        [
            'q' => '3. Which frameworks and regulations can your vCISO help me meet?',
            'a' => ['We cover ISO 27001, HIPAA, GDPR, NIST, RBI, SOC 2, and more.'],
        ],
        [
            'q' => '4. Will ibntech.com’s vCISO work with our in-house IT/security team?',
            'a' => ['Yes, our vCISOs work closely with your executive and technical teams.'],
        ],
        [
            'q' => '5. Can vCISO support multiple regions/branches with different compliance needs?',
            'a' => ['Yes. our specialty is developing compliance strategies that work in multiple US, UK, and Indian regions.'],
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    {{-- Home component styles are required for the reused client-logos marquee. --}}
    @vite(['resources/css/pages/home.css', 'resources/css/pages/vciso-services.css'])
@endpush

@section('content')
    <div class="vciso-page">
        {{-- Hero --}}
        <section class="vciso-hero" aria-labelledby="vciso-hero-title">
            <div class="site-shell vciso-hero__inner">
                <h1 id="vciso-hero-title">
                    Expert-Led <span class="vciso-accent">vCISO Services</span> for Scalable Cybersecurity Leadership
                </h1>
                <p class="vciso-hero__subtitle">Strategic Cybersecurity Oversight. On-Demand. Globally Aligned.</p>
                <p class="vciso-hero__lede">
                    Get strategic security leadership without the full-time cost schedule a consultation today to customize our vCISO services for your organization's unique needs!
                </p>
                <a href="#vciso-enquire" class="button-secondary vciso-hero__cta">Schedule Free Consultation</a>
            </div>
        </section>

        {{-- Certifications --}}
        <section class="vciso-certs-section" aria-labelledby="vciso-certs-title">
            <div class="site-shell">
                <div class="vciso-certs-panel">
                    <h2 id="vciso-certs-title">Certified and Trusted by Global Cybersecurity Accreditation Leaders</h2>
                    <div class="vciso-certs">
                        @foreach ($certs as $cert)
                            <img
                                src="{{ $certImg($cert['file']) }}"
                                alt="{{ $cert['alt'] }}"
                                width="140"
                                height="80"
                                loading="lazy"
                                decoding="async"
                            >
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <x-home.client-logos />

        {{-- Why choose --}}
        <section class="vciso-section vciso-section--soft" aria-labelledby="vciso-why-title">
            <div class="site-shell">
                <div class="vciso-heading">
                    <h2 id="vciso-why-title">Why Choose IBN Tech for vCISO Services?</h2>
                    <p>
                        IBN Tech brings strong technological experience and global availability to create quantifiable cybersecurity results. Our virtual CISO services are designed to work seamlessly with your team, providing strategic leadership and compliance-driven solutions.
                    </p>
                </div>
                <div class="vciso-why-grid" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="vciso-why-card" role="listitem">
                            <span class="vciso-why-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Navy CTA --}}
        <section class="vciso-cta vciso-cta--navy" aria-labelledby="vciso-cta1-title">
            <div class="site-shell vciso-cta__inner">
                <h2 id="vciso-cta1-title">Ready to Strengthen Your Cybersecurity Posture?</h2>
                <p>Get a personalized estimate based on your region, business size, and security needs. Our experts are standing by to help secure your digital future</p>
                <a href="#vciso-enquire" class="button-primary">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    Schedule a Free Consultation
                </a>
            </div>
        </section>

        {{-- Virtual CISO intro --}}
        <section class="vciso-section vciso-section--cream" aria-labelledby="vciso-intro-title">
            <div class="site-shell vciso-intro">
                <div class="vciso-intro__copy">
                    <h2 id="vciso-intro-title">
                        <span class="vciso-accent">Virtual CISO:</span> The Smarter Way to Lead Cybersecurity
                    </h2>
                    <p>
                        A Virtual Chief Information Security Officer provides expert cybersecurity management without the expense of hiring a full-time executive. They assist organizations in developing sustainable, efficient, and resilient cybersecurity and privacy strategies and frameworks. They work remotely, CISO as a service offer flexibility, cost effective, and industry-specific expertise customized to sectors like SaaS, finance, and healthcare.
                    </p>
                    <p>
                        The vCISOs fill the gap between technical teams and executive/leadership level, integrate into your organization to improve security posture and compliant practices. These CISO advisory services go beyond simple consulting by providing ongoing, strategic oversight as a dedicated member of your team.
                    </p>
                </div>
                <div class="vciso-intro__media">
                    <img
                        src="{{ $img('vCISO.png') }}"
                        alt="vCISO"
                        width="520"
                        height="410"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Service modules --}}
        <section class="vciso-section" aria-labelledby="vciso-modules-title">
            <div class="site-shell">
                <div class="vciso-heading">
                    <h2 id="vciso-modules-title">Specialized vCISO Service Modules</h2>
                    <p>Delivering executive-level cybersecurity expertise with flexible, scalable services customized to your organization's exact needs.</p>
                </div>
                <div class="vciso-modules" role="list">
                    @foreach ($modules as $module)
                        <article class="vciso-module" role="listitem">
                            <h3>{{ $module['title'] }}</h3>
                            <p>{{ $module['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Green CTA --}}
        <section class="vciso-cta vciso-cta--green" aria-labelledby="vciso-cta2-title">
            <div class="site-shell vciso-cta__inner">
                <h2 id="vciso-cta2-title">Get a Custom Cybersecurity Roadmap Today</h2>
                <p>Our experienced virtual CISOs will develop a custom plan to strengthen your security and guarantee compliance before a threat occurs.</p>
                <a href="#vciso-enquire" class="vciso-cta__ghost">Limited slots available this month. Don’t wait.</a>
            </div>
        </section>

        {{-- How it works --}}
        <section class="vciso-section" aria-labelledby="vciso-steps-title">
            <div class="site-shell">
                <div class="vciso-heading">
                    <h2 id="vciso-steps-title">How Our <span class="vciso-accent">vCISO Services</span> Work</h2>
                    <p>Our efficient integration process for fractional CISO services ensures a seamless onboarding experience and delivers immediate improvements to your organization's security posture.</p>
                </div>
                <ol class="vciso-steps">
                    @foreach ($steps as $step)
                        <li class="vciso-step">
                            <span class="vciso-step__num" aria-hidden="true">{{ $step['n'] }}</span>
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>

        {{-- Deliverables --}}
        <section class="vciso-section vciso-section--cream" aria-labelledby="vciso-deliver-title">
            <div class="site-shell">
                <div class="vciso-heading">
                    <h2 id="vciso-deliver-title">Key Deliverables &amp; Value</h2>
                    <p>Our virtual CISO services deliver strategic clarity and compliance-ready outputs that strengthen your security posture. From executive insights to customized documentation, we help drive measurable cybersecurity outcomes.</p>
                </div>
                <div class="vciso-why-grid" role="list">
                    @foreach ($deliverables as $item)
                        <article class="vciso-why-card vciso-why-card--navy" role="listitem">
                            <span class="vciso-why-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- FAQ + form --}}
        <section class="vciso-section vciso-section--faq" aria-labelledby="vciso-faq-title">
            <div class="site-shell vciso-faq-layout">
                <div>
                    <h2 id="vciso-faq-title">Frequently Asked Questions</h2>
                    <div class="vciso-faq">
                        @foreach ($faqs as $index => $faq)
                            <details class="vciso-faq__item" @if ($index === 0) open @endif>
                                <summary>
                                    <span>{{ $faq['q'] }}</span>
                                    <span class="vciso-faq__toggle" aria-hidden="true">
                                        <i class="fa-solid fa-plus"></i>
                                        <i class="fa-solid fa-minus"></i>
                                    </span>
                                </summary>
                                <div class="vciso-faq__body">
                                    @foreach ($faq['a'] as $paragraph)
                                        <p>{{ $paragraph }}</p>
                                    @endforeach
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <aside class="vciso-form" id="vciso-enquire" aria-labelledby="vciso-form-title">
                    <div class="vciso-form__head">
                        <h2 id="vciso-form-title">vCISO Services – Your Security Strategist On Demand</h2>
                        <p>Expert security leadership to assess risks, build strategy, and ensure compliance — without the full-time cost.</p>
                    </div>
                    <div class="vciso-form__body">
                        <livewire:forms.contact-form
                            form-name="vciso-services"
                            id-prefix="vciso"
                            :show-company="false"
                            :show-service="false"
                            message-placeholder="Where’s your biggest risk?"
                            submit-label="BOOK FREE CONSULTATION"
                            layout="modal"
                            :message-rows="2"
                        />
                    </div>
                </aside>
            </div>
        </section>
    </div>
@endsection
