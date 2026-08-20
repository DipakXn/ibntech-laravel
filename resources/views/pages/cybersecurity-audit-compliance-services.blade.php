@php
    $img = fn (string $file): string => asset('images/cybersecurity-audit-compliance-services/'.$file);
    $certImg = fn (string $file): string => asset('images/vapt-certs/'.$file);

    $certs = [
        ['file' => 'iso-certified.webp', 'alt' => 'ISO Certified'],
        ['file' => 'seceon-professional.png', 'alt' => 'Seceon Professional'],
        ['file' => 'ceh-ethical-hacker.webp', 'alt' => 'Certified Ethical Hacker'],
        ['file' => 'fortinet-certified-network-security-professional.webp', 'alt' => 'Fortinet Certified Network Security Professional'],
        ['file' => 'certified-payment.webp', 'alt' => 'Certified Payment Security Compliance Manager'],
        ['file' => 'cisa-certification-logo.webp', 'alt' => 'CISA Certification'],
    ];

    $risks = [
        'Heavy financial penalties',
        'Loss of customer trust',
        'Operational disruption and reputational damage',
    ];

    $services = [
        [
            'icon' => 'fa-file-lines',
            'title' => 'Comprehensive Security Audits',
            'text' => 'Thorough evaluation of your policies, controls, data protection, and incident response—mapped to standards like ISO 27001, GDPR compliance services, SOC2 and HIPAA compliance services, DPDPA and more.',
        ],
        [
            'icon' => 'fa-eye',
            'title' => 'Continuous Compliance Monitoring',
            'text' => 'Real-time threat detection and centralized log management powered by advanced SIEM and automation tools.',
        ],
        [
            'icon' => 'fa-circle-check',
            'title' => 'Regulatory Certification Support',
            'text' => 'Expert guidance for achieving and maintaining compliance with ISO, PCI DSS, GDPR, SOC 2, HIPAA, RBI, SEBI, IRDAI, and DPDPA.',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'SMB-Focused Engagement Models',
            'text' => 'Flexible, cost-effective solutions with actionable roadmaps and audit-ready documentation tailored to your business size and sector.',
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Gap & Risk Analysis',
            'text' => 'Identify vulnerabilities, assess risks, and implement remediation strategies to strengthen your security posture.',
        ],
        [
            'icon' => 'fa-file-invoice',
            'title' => 'Audit-Ready Reporting',
            'text' => 'Automated, standards-aligned documentation for internal reviews and external audits—ensuring you\'re always prepared.',
        ],
    ];

    $benefits = [
        [
            'icon' => 'fa-circle-check',
            'title' => 'Always Audit-Ready',
            'text' => 'Stay prepared year-round with proactive compliance, no last-minute stress or surprises.',
        ],
        [
            'icon' => 'fa-globe',
            'title' => 'Scalable & Budget-Friendly',
            'text' => 'Flexible packages designed to grow with your business, without breaking the bank.',
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Streamlined Operations',
            'text' => 'Automated compliance processes free up your team and reduce manual overhead.',
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Minimized Risk, Maximized Trust',
            'text' => 'Reduce the chances of breaches and build stronger confidence with clients, partners, and regulators.',
        ],
        [
            'icon' => 'fa-lock',
            'title' => 'Confidence Through Control',
            'text' => 'Expert oversight, strong security controls, and rapid response capabilities give you peace of mind.',
        ],
    ];

    $faqs = [
        [
            'q' => 'Why is compliance auditing critical for risk mitigation?',
            'a' => 'Compliance auditing is a proactive way to spot vulnerabilities before they become costly breaches or violations. It ensures your organization meets regulatory standards, reduces risk exposure, and builds a defensible record of due diligence.',
        ],
        [
            'q' => 'How often should we conduct compliance audits?',
            'a' => 'The frequency of compliance audits depends on your industry, risk level, and regulatory demands. Most businesses benefit from annual audits, with additional reviews triggered by major changes or emerging risks.',
        ],
        [
            'q' => 'What\'s the difference between compliance management and audit services?',
            'a' => 'Compliance management ensures your organization follows regulations through ongoing policies and procedures. Audits independently verify and improve those efforts, making both essential for reducing risk and maintaining trust.',
        ],
        [
            'q' => 'How do you minimize business disruption during compliance audits?',
            'a' => 'Plan audits carefully, use automation, and involve only essential staff to minimize disruption while maintaining operational continuity.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    {{-- Home component styles are required for the reused client-logos marquee. --}}
    @vite(['resources/css/pages/home.css', 'resources/css/pages/cybersecurity-audit-compliance-services.css'])
@endpush

@section('content')
    <div class="cacs-page">
        {{-- Hero --}}
        <section class="cacs-hero" aria-labelledby="cacs-hero-title">
            <div class="site-shell cacs-hero__inner">
                <div class="cacs-hero__copy">
                    <p class="cacs-hero__badge">Stay Secure. Stay Compliant. Stay Trusted</p>
                    <h1 id="cacs-hero-title">
                        Expert Cybersecurity
                        <span>Audit and Compliance Management Services</span>
                    </h1>
                    <p class="cacs-hero__lede">
                        IBN Tech offers cybersecurity compliance services to businesses in the US, UK, and India, providing expert-led programs customized to each client's industry, risk profile, and regulatory needs.
                    </p>
                    <a href="#cacs-consult" class="cacs-btn cacs-btn--light">Schedule Your Consultation Today</a>
                </div>

                <figure class="cacs-hero__media">
                    <img
                        src="{{ $img('expert-cybersecurity-audit-and-compliance-management-services.png') }}"
                        alt="Expert cybersecurity audit and compliance management services"
                        width="472"
                        height="472"
                        fetchpriority="high"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Certifications --}}
        <section class="cacs-certs-section" aria-labelledby="cacs-certs-title">
            <div class="site-shell">
                <div class="cacs-certs-panel">
                    <h2 id="cacs-certs-title">Industry Certifications &amp; Strategic Partnerships</h2>
                    <p>Professional skills validated by top industry certifications and technological alliances</p>
                    <div class="cacs-certs">
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

        {{-- Protect your business --}}
        <section class="cacs-section" aria-labelledby="cacs-protect-title">
            <div class="site-shell cacs-protect">
                <div class="cacs-protect__copy">
                    <h2 id="cacs-protect-title">
                        Protect Your Business with a <span class="cacs-accent">Cyber Security Audit</span>
                    </h2>
                    <p>Cyber threats are evolving fast, don't let outdated systems leave your business exposed. Our Cyber Security Audit delivers a deep dive into your IT environment, identifying vulnerabilities across infrastructure, Microsoft 365, dark web Monitoring, and compliance gaps.</p>
                    <p>Get expert insights, a personalized security roadmap, and actionable steps to strengthen your defenses, before attackers strike.</p>
                    <a href="#cacs-consult" class="cacs-btn cacs-btn--green">Speak to an expert</a>
                </div>
                <div class="cacs-protect__art" aria-hidden="true">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </section>

        {{-- Compliance for SMBs --}}
        <section class="cacs-section cacs-section--mist" aria-labelledby="cacs-compliance-title">
            <div class="site-shell cacs-compliance">
                <figure class="cacs-compliance__media">
                    <img
                        src="{{ $img('cybersecurity-compliance.png') }}"
                        alt="Cybersecurity compliance for SMBs"
                        width="363"
                        height="242"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
                <div class="cacs-compliance__copy">
                    <h2 id="cacs-compliance-title">Cybersecurity Compliance: A Must-Have for SMBs</h2>
                    <p>Compliance isn’t just a checkbox- it’s a strategic requirement. Global and regional standards like GDPR, ISO 27001, PCI DSS, SOC2 &amp; HIPAA (US), Cyber Essentials &amp; IASME (UK), and RBI/SEBI/IRDAI &amp; DPDPA (India) demand ongoing vigilance and proactive risk management. Falling short can lead to:</p>
                    <ul>
                        @foreach ($risks as $risk)
                            <li>
                                <span class="cacs-warning" aria-hidden="true">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </span>
                                <span>{{ $risk }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <p>Staying compliant means staying competitive. It’s your shield against evolving threats and your foundation for long-term resilience.</p>
                </div>
            </div>
        </section>

        {{-- Services grid --}}
        <section class="cacs-section" aria-labelledby="cacs-services-title">
            <div class="site-shell">
                <div class="cacs-heading">
                    <h2 id="cacs-services-title">IBN Tech's Compliance Management &amp; Audit Services</h2>
                    <p>We help SMBs in the US, UK, and India stay ahead of cyber threats and regulatory demands with customized, audit-ready cybersecurity compliance services.</p>
                </div>
                <div class="cacs-services" role="list">
                    @foreach ($services as $service)
                        <article class="cacs-service-card" role="listitem">
                            <div class="cacs-service-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $service['icon'] }}"></i>
                            </div>
                            <h3>{{ $service['title'] }}</h3>
                            <p>{{ $service['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="cacs-journey" aria-labelledby="cacs-journey-title">
            <div class="site-shell cacs-journey__inner">
                <h2 id="cacs-journey-title">Let's Start your Cyber Security Audit Journey</h2>
                <p>Schedule a consultation with our cybersecurity specialists and discover how our audit services can safeguard your IT environment.</p>
                <a href="#cacs-consult" class="cacs-btn cacs-btn--green">Speak to our experts about a Cyber Security Audit</a>
            </div>
        </section>

        {{-- Key benefits --}}
        <section class="cacs-benefits-section" aria-labelledby="cacs-benefits-title">
            <div class="site-shell">
                <div class="cacs-heading cacs-heading--light">
                    <h2 id="cacs-benefits-title">Key Benefits of IBN Tech's Compliance &amp; Audit Services</h2>
                </div>
                <div class="cacs-benefits" role="list">
                    @foreach ($benefits as $benefit)
                        <article class="cacs-benefit" role="listitem">
                            <div class="cacs-benefit__icon" aria-hidden="true">
                                <i class="fa-solid {{ $benefit['icon'] }}"></i>
                            </div>
                            <h3>{{ $benefit['title'] }}</h3>
                            <p>{{ $benefit['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- FAQ + consultation form --}}
        <section class="cacs-section cacs-section--soft" aria-labelledby="cacs-faq-title">
            <div class="site-shell cacs-consult">
                <div class="cacs-consult__faq">
                    <h2 id="cacs-faq-title">Frequently Asked Questions</h2>
                    <div class="cacs-faq">
                        @foreach ($faqs as $index => $faq)
                            <details class="cacs-faq__item" @if ($index === 0) open @endif>
                                <summary>
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                    <span>{{ $index + 1 }}. {{ $faq['q'] }}</span>
                                </summary>
                                <div class="cacs-faq__body">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <aside class="cacs-consult__card" id="cacs-consult" aria-labelledby="cacs-consult-title">
                    <h3 id="cacs-consult-title">Request Your Cybersecurity Audit &amp; Compliance Consultation</h3>
                    <p>Get expert advice to boost compliance and reduce risks. Fill out the form to contact us.</p>
                    <livewire:forms.contact-form
                        form-name="cybersecurity-audit-compliance-services"
                        id-prefix="cacs"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="How can we help you?"
                        submit-label="Request Free Consultation"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
