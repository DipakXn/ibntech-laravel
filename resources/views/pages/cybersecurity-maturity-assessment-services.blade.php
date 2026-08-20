@php
    $img = fn (string $file): string => asset('images/cybersecurity-maturity-assessment-services/'.$file);
    $certImg = fn (string $file): string => asset('images/vapt-certs/'.$file);

    $certs = [
        ['file' => 'iso-certified.webp', 'alt' => 'ISO Certified'],
        ['file' => 'seceon-professional.png', 'alt' => 'Seceon Professional'],
        ['file' => 'ceh-ethical-hacker.webp', 'alt' => 'Certified Ethical Hacker'],
        ['file' => 'fortinet-certified-network-security-professional.webp', 'alt' => 'Fortinet Certified Network Security Professional'],
        ['file' => 'certified-payment.webp', 'alt' => 'Certified Payment Security Compliance Manager'],
        ['file' => 'cisa-certification-logo.webp', 'alt' => 'CISA Certification'],
    ];

    $goals = [
        [
            'icon' => 'fa-magnifying-glass',
            'title' => 'Identify Gaps in Defenses',
            'text' => 'Pinpoint weaknesses in your current security measures.',
        ],
        [
            'icon' => 'fa-triangle-exclamation',
            'title' => 'Clarify Risk Management & Readiness',
            'text' => 'Provide a comprehensive view of how your organization handles threats and vulnerabilities.',
        ],
        [
            'icon' => 'fa-chart-column',
            'title' => 'Compare Against Industry Standards',
            'text' => 'Measure your practices against established cybersecurity frameworks.',
        ],
        [
            'icon' => 'fa-bullseye',
            'title' => 'Outline a Focused Improvement Plan',
            'text' => 'Deliver a clear, prioritized roadmap for strengthening your security over time.',
        ],
    ];

    $frameworks = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'NIST Cybersecurity Framework',
            'text' => 'A risk-based model for identifying, protecting, detecting, responding to, and recovering from security incidents.',
        ],
        [
            'icon' => 'fa-circle-check',
            'title' => 'CIS Controls',
            'text' => 'A prioritized set of technical safeguards designed to defend against widespread threats.',
        ],
        [
            'icon' => 'fa-file-lines',
            'title' => 'ISO/IEC 27001',
            'text' => 'Standards for creating and maintaining an Information Security Management System (ISMS).',
        ],
        [
            'icon' => 'fa-gears',
            'title' => 'COBIT',
            'text' => 'Guidelines for IT governance and management to ensure alignment with business goals.',
        ],
    ];

    $standItems = [
        [
            'icon' => 'fa-users',
            'title' => 'Leadership & Governance',
            'text' => 'Establishing clear ownership, accountability, and policy frameworks that drive security from the top down.',
        ],
        [
            'icon' => 'fa-eye',
            'title' => 'Threat Identification & Monitoring',
            'text' => 'Implementing continuous surveillance and intelligence gathering to detect emerging risks before they escalate.',
        ],
        [
            'icon' => 'fa-screwdriver-wrench',
            'title' => 'Foundational Security Operations',
            'text' => 'Verifying that patching, endpoint defenses, access controls, and configuration management are rock-solid.',
        ],
        [
            'icon' => 'fa-rotate',
            'title' => 'Incident Management & Recovery',
            'text' => 'Testing procedures for rapid detection, containment, and restoration to minimize downtime and data loss.',
        ],
        [
            'icon' => 'fa-chart-column',
            'title' => 'Standards Alignment & Benchmarking',
            'text' => 'Mapping your controls against NIST, ISO, CIS, and IASME guidelines to meet industry expectations and best practices.',
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Ongoing Enhancement',
            'text' => 'Embedding a cycle of measurement, feedback, and refinement so security evolves as your business grows.',
        ],
    ];

    $advantages = [
        [
            'icon' => 'fa-eye',
            'title' => 'Holistic Insight',
            'text' => 'Understand every facet of your cybersecurity maturity.',
        ],
        [
            'icon' => 'fa-bullseye',
            'title' => 'Priority-Driven Actions',
            'text' => 'Allocate resources to the risks that threaten you most.',
        ],
        [
            'icon' => 'fa-circle-check',
            'title' => 'Compliance Confidence',
            'text' => 'Be audit-ready and aligned with regulatory mandates.',
        ],
        [
            'icon' => 'fa-screwdriver-wrench',
            'title' => 'Practical Guidance',
            'text' => 'Implement recommendations with in-house teams or our experts.',
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Tangible ROI',
            'text' => 'Mitigate expensive incidents and reinforce customer trust.',
        ],
    ];

    $faqs = [
        [
            'q' => 'How often should we conduct a Cybersecurity Maturity Risk Assessment?',
            'a' => 'Annually, with quarterly reviews for high-risk areas or after major changes.',
        ],
        [
            'q' => 'Who should be involved in the assessment process?',
            'a' => 'IT, compliance, risk teams, business leaders, and executive sponsors—plus external experts if needed.',
        ],
        [
            'q' => 'How do we measure ROI from security maturity improvements?',
            'a' => 'Track reduced incidents, faster response times, better compliance, and business benefits like trust and agility.',
        ],
        [
            'q' => 'Can small organizations benefit from maturity assessments?',
            'a' => 'Yes, scaled-down assessments help prioritize resources and avoid costly mistakes.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    {{-- Home component styles are required for the reused client-logos marquee. --}}
    @vite(['resources/css/pages/home.css', 'resources/css/pages/cybersecurity-maturity-assessment-services.css'])
@endpush

@section('content')
    <div class="cmas-page">
        {{-- Hero --}}
        <section class="cmas-hero" aria-labelledby="cmas-hero-title">
            <div class="site-shell cmas-hero__inner">
                <div class="cmas-hero__copy">
                    <p class="cmas-hero__badge">Trusted by SMBs, across U.S., UK &amp; India</p>
                    <h1 id="cmas-hero-title">
                        Cybersecurity <span class="cmas-accent">Maturity</span> Assessment Services
                    </h1>
                    <p class="cmas-hero__lede">
                        Gain a crystal-clear picture of your security strengths and gaps, then follow a laser-focused roadmap to elevate your cyber resilience and protect your bottom line.
                    </p>
                    <a href="#cmas-enquire" class="cmas-btn cmas-btn--green">
                        Start Free Assessment
                        <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
                <figure class="cmas-hero__media">
                    <img
                        src="{{ $img('cyber-security-maturity-assessment.jpg') }}"
                        alt="Cybersecurity maturity assessment showing a laptop with a digital lock and security nodes"
                        width="453"
                        height="321"
                        fetchpriority="high"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Certifications --}}
        <section class="cmas-certs-section" aria-labelledby="cmas-certs-title">
            <div class="site-shell">
                <div class="cmas-certs-panel">
                    <h2 id="cmas-certs-title">Industry Certifications &amp; Strategic Partnerships</h2>
                    <p>Professional skills validated by top industry certifications and technological alliances</p>
                    <div class="cmas-certs">
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

        {{-- Secure growth --}}
        <section class="cmas-section" aria-labelledby="cmas-growth-title">
            <div class="site-shell">
                <div class="cmas-heading">
                    <h2 id="cmas-growth-title">Secure Growth with Cybersecurity Maturity Assessment</h2>
                    <p>
                        A cybersecurity maturity assessment systematically examines an organization's security posture by evaluating its policies, procedures, technologies, governance structures, and workforce awareness. This process determines how well your business can prevent, detect, and respond to cyber threats.
                    </p>
                </div>

                <div class="cmas-goals">
                    <div class="cmas-goals__intro">
                        <h3 id="cmas-goals-title">Key Goals of Our Cyber Maturity Assessment</h3>
                        <p>Our comprehensive evaluation provides actionable insights to strengthen your cybersecurity posture level.</p>
                    </div>
                    <div class="cmas-goals__grid" role="list">
                        @foreach ($goals as $goal)
                            <article class="cmas-goal" role="listitem">
                                <span class="cmas-goal__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $goal['icon'] }}"></i>
                                </span>
                                <h3>{{ $goal['title'] }}</h3>
                                <p>{{ $goal['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Frameworks --}}
        <section class="cmas-section cmas-section--tight" aria-labelledby="cmas-frameworks-title">
            <div class="site-shell">
                <div class="cmas-heading">
                    <h2 id="cmas-frameworks-title">Frameworks We Align With</h2>
                    <p>Industry-standard frameworks ensuring comprehensive coverage and compliance.</p>
                </div>
                <div class="cmas-frameworks" role="list">
                    @foreach ($frameworks as $framework)
                        <article class="cmas-framework" role="listitem">
                            <span class="cmas-framework__icon" aria-hidden="true">
                                <i class="fa-solid {{ $framework['icon'] }}"></i>
                            </span>
                            <h3>{{ $framework['title'] }}</h3>
                            <p>{{ $framework['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Quote banner --}}
        <section class="cmas-quote" aria-label="Cyber security risk management">
            <div class="site-shell">
                <p>
                    Cyber Security Risk Management doesn't just identify vulnerabilities — it provides a strategic roadmap for continuous improvement and risk reduction across the entire security program.
                </p>
            </div>
        </section>

        {{-- Know where you stand --}}
        <section class="cmas-section" aria-labelledby="cmas-stand-title">
            <div class="site-shell">
                <div class="cmas-heading">
                    <h2 id="cmas-stand-title">Know Where You Stand in Cybersecurity</h2>
                    <p>IBN Tech's evaluation measures maturity across six essential areas, ensuring no weakness goes unnoticed:</p>
                </div>
                <div class="cmas-stand" role="list">
                    @foreach ($standItems as $item)
                        <article class="cmas-stand-card" role="listitem">
                            <span class="cmas-stand-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="cmas-cta" aria-labelledby="cmas-cta-title">
            <div class="site-shell cmas-cta__inner">
                <h2 id="cmas-cta-title">Ready to Strengthen Your Cyber Defenses?</h2>
                <p>Get started with a comprehensive cybersecurity maturity assessment tailored to your business needs.</p>
                <a href="#cmas-enquire" class="cmas-btn cmas-btn--green">Get Your Free Assessment</a>
            </div>
        </section>

        {{-- Methodology --}}
        <section class="cmas-section" aria-labelledby="cmas-method-title">
            <div class="site-shell">
                <div class="cmas-heading">
                    <h2 id="cmas-method-title">Our Step-by-Step Methodology</h2>
                    <p>A proven process that delivers actionable insights and practical recommendations</p>
                </div>
                <figure class="cmas-method">
                    <img
                        src="{{ $img('cyber-security-maturity-assessment-services-methodology.png') }}"
                        alt="Cybersecurity maturity assessment methodology: policy and documentation review, discussion and gap analysis, automated scans and benchmarking, risk rating and impact assessment, and customized roadmap delivery"
                        width="960"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- IBN Advantage --}}
        <section class="cmas-advantage" aria-labelledby="cmas-advantage-title">
            <div class="site-shell">
                <div class="cmas-heading cmas-heading--light">
                    <h2 id="cmas-advantage-title">The IBN Advantage</h2>
                    <p>As a security assessment company, IBN Tech helps you improve your cyber posture with real results.</p>
                </div>
                <div class="cmas-advantage__grid" role="list">
                    @foreach ($advantages as $item)
                        <article class="cmas-advantage-card" role="listitem">
                            <span class="cmas-advantage-card__icon" aria-hidden="true">
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
        <section class="cmas-section cmas-section--faq" aria-labelledby="cmas-faq-title">
            <div class="site-shell cmas-consult">
                <div class="cmas-consult__faq">
                    <h2 id="cmas-faq-title">Frequently Asked Questions</h2>
                    <div class="cmas-faq">
                        @foreach ($faqs as $index => $faq)
                            <details class="cmas-faq__item" @if ($index === 0) open @endif>
                                <summary>
                                    <span>{{ $index + 1 }}. {{ $faq['q'] }}</span>
                                    <span class="cmas-faq__toggle" aria-hidden="true">
                                        <i class="fa-solid fa-plus"></i>
                                        <i class="fa-solid fa-minus"></i>
                                    </span>
                                </summary>
                                <div class="cmas-faq__body">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <aside class="cmas-form" id="cmas-enquire" aria-labelledby="cmas-form-title">
                    <div class="cmas-form__head">
                        <h2 id="cmas-form-title">Request Your Cybersecurity Maturity Assessment</h2>
                        <p>Get expert insights into your organization's security posture and maturity level. Fill out the form below to connect with our team.</p>
                    </div>
                    <div class="cmas-form__body">
                        <livewire:forms.contact-form
                            form-name="cybersecurity-maturity-assessment-services"
                            id-prefix="cmas"
                            :show-company="false"
                            :show-service="false"
                            message-placeholder="Tell us about your requirements"
                            submit-label="GET MY SECURITY REPORT"
                            layout="modal"
                            :message-rows="3"
                        />
                    </div>
                </aside>
            </div>
        </section>
    </div>
@endsection
