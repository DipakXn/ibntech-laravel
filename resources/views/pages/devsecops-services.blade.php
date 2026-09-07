@php
    $img = fn (string $file): string => asset('images/devsecops-services/'.$file);
    $certImg = fn (string $file): string => asset('images/Certificates/'.$file);
    $clientImg = fn (string $file): string => asset('images/clients-logo/'.$file);

    $heroFeatures = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Shift-left security & devsecops automation',
            'text' => 'Automate SAST, SCA, DAST, and IaC scanning across CI/CD.',
        ],
        [
            'icon' => 'fa-cloud-arrow-up',
            'title' => 'Secure infrastructure-as-code',
            'text' => 'Harden Azure/AWS toolchains for Terraform, ARM, and CloudFormation.',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Developer-first enablement',
            'text' => 'Hands-on training, PR gating, and clear triage workflows.',
        ],
        [
            'icon' => 'fa-clipboard-check',
            'title' => 'Continuous compliance',
            'text' => 'Align to SOC 2, ISO 27001, GDPR, HIPAA with automated evidence.',
        ],
    ];

    $certificates = [
        'ms-azure-solutions-architech.webp',
        'ms-cybersecurity-architech.webp',
        'ms-enterprise-administrator.webp',
        'ms-identity-and-access-administrator.webp',
        'ms-azure-security-engineer.webp',
        'ms-security-operations-analyst.webp',
        'ms-azure-virtual-desktop.webp',
        'ms-azure-database-administrator.webp',
        'ms-azure-data-scientist.webp',
        'ms-azure-administrator.webp',
    ];

    $clientLogos = [
        'vsoftcorp.webp', 'askmia.webp', 'orowealth.webp', 'Ephlux.webp', 'abitach.webp',
        'Atlantic-data.webp', 'Azuga.webp', 'Cloud-Rewind.webp', 'Demand-media.webp', 'Digital-Zone.webp',
        'Docully.webp', 'DOD-Technologies.webp', 'EM6-Worldwide.webp', 'instem.webp', 'Lattice.webp',
        'Maximeyes.webp', 'MTX.webp', 'Tradesun.webp', 'Wassha.webp', 'Aurionpro.webp',
        'British-Orient.webp', 'Chemito.webp', 'Contata.webp', 'Isckon.webp', 'Lenden.webp',
        'Mapmyindia.webp', 'Routematic.webp', 'Wint.webp', 'LT.webp', 'bike-bazaar.webp',
    ];

    $whyChoose = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'MSSP Security + DevOps',
            'text' => 'Security alerts feed into your CI/CD pipeline and developer feedback loop, not held at arm\'s length.',
        ],
        [
            'icon' => 'fa-cloud-arrow-up',
            'title' => 'Cloud-native deployments',
            'text' => 'Azure DevOps and AWS CodePipeline with integrated security gates; centralized policy enforcement with partner support.',
        ],
        [
            'icon' => 'fa-desktop',
            'title' => 'Developer-centric',
            'text' => 'Training, tool embedding (scanning in PRs), and triage workflows that reduce noise and increase fix rate.',
        ],
        [
            'icon' => 'fa-globe',
            'title' => 'Global-ready',
            'text' => 'Pipelines customized for US, UK, and India, compliance-ready and latency-considered.',
        ],
        [
            'icon' => 'fa-magnifying-glass',
            'title' => 'Audit trail built-in',
            'text' => 'Automated compliance reporting, alert-to-fix dashboards, and a Kanban view of security tasks.',
        ],
    ];

    $services = [
        [
            'n' => '1',
            'title' => 'DevSecOps Assessment & Roadmap',
            'items' => [
                'Secure maturity scan (tooling, culture, pipeline gaps)',
                'Policy and threat model mapping',
                'Roadmap with quick-win integrations',
            ],
            'footer' => 'Ideal to define a focused devsecops solution path and prioritized investments.',
        ],
        [
            'n' => '2',
            'title' => 'Secure CI/CD Integration',
            'items' => [
                'Integrate SAST (SonarQube, Fortify), SCA (Snyk, OWASP), DAST tools',
                'IaC scanning for Terraform/ARM/CloudFormation',
                'Automated compliance gates (OWASP Top 10, CIS Benchmarks)',
            ],
            'footer' => 'Accelerate devsecops automation that blocks risky merges and enables safe releases.',
        ],
        [
            'n' => '3',
            'title' => 'Secure Code Practices & Developer Enablement',
            'items' => [
                'Secure coding standards, PR gating, pair reviews',
                'DevSecOps playbooks and shift-left training',
                'Just-in-time triage workflows with ticket triggers (Jira, Azure Boards)',
            ],
            'footer' => 'Developer-first culture where security is built in, not bolted on.',
        ],
        [
            'n' => '4',
            'title' => 'Secure Cloud DevOps Pipelines',
            'items' => [
                'Harden Azure Pipelines and AWS CodePipeline',
                'Policy as code, auto-remediation, drift detection',
                'Immutable build artifacts and pipeline provenance',
            ],
            'footer' => 'Accelerate devsecops automation that blocks risky merges and enables safe releases.',
        ],
        [
            'n' => '5',
            'title' => 'Governance, Compliance, & Reporting',
            'items' => [
                'Compliance dashboards tied to pull requests and QRCs',
                'Built-in evidence for SOC 2, ISO 27001, GDPR, HIPAA',
                'Actionable analytics: vulnerability counts, remediation times',
            ],
            'footer' => 'Turn audits into a byproduct of daily work with automated evidence capture.',
        ],
    ];

    $outcomes = [
        ['value' => '80%', 'text' => 'Reduction in time-to-fix for critical code vulnerabilities'],
        ['value' => '100%', 'text' => 'Pull requests scanned on merge'],
        ['value' => '60%', 'text' => 'Fewer manual QA security reviews'],
        ['value' => '0', 'text' => 'Manual hours for integrated compliance reporting'],
    ];

    $stack = [
        [
            'file' => 'Azure-Devops-1.webp',
            'title' => 'Azure DevOps',
            'text' => 'Policy as Code, SAST, IaC scanning',
        ],
        [
            'file' => 'AWS-Tooling.webp',
            'title' => 'AWS Tooling',
            'text' => 'CodePipeline, CodeBuild with security hooks',
        ],
        [
            'file' => 'open-Source.webp',
            'title' => 'Open-source & Commercial',
            'text' => 'SonarQube, Snyk, Trivy, GitGuardian',
        ],
        [
            'file' => 'Deep-integrations.webp',
            'title' => 'Deep Integrations',
            'text' => 'Partnering with Microsoft and AWS',
        ],
    ];

    $faqs = [
        [
            'q' => '1. What does a DevSecOps implementation look like?',
            'a' => 'It starts with scanning-enabled pipelines and pull request gating then expands to training and automated compliance tracking.',
        ],
        [
            'q' => '2. Which regulatory frameworks are supported?',
            'a' => 'SOC 2, ISO 27001, GDPR, HIPAA, aligned with automated evidence capture.',
        ],
        [
            'q' => '3. How quickly do we start seeing value?',
            'a' => 'Scanning can be live in days; governance and culture in weeks.',
        ],
        [
            'q' => '4. Can you modernize our existing CI/CD?',
            'a' => 'Yes, whether Jenkins, GitHub Actions, Azure Pipelines, or others.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/devsecops-services.css'])
@endpush

@section('content')
    <div class="dso-page">
        {{-- Hero --}}
        <section class="dso-hero" aria-labelledby="dso-hero-title">
            <div class="site-shell dso-hero__inner">
                <h1 id="dso-hero-title">
                    DevSecOps Implementation &amp; <span class="dso-accent">Secure Code</span> Services
                </h1>
                <p class="dso-hero__kicker">Secure Your Software Pipeline with DevSecOps as a Service</p>
                <p class="dso-hero__lede">
                    Embedding security in your software pipeline - Azure &amp; AWS-powered, global support for US, UK, and Indian SMEs. IBN Tech delivers devsecops as a service with developer-first workflows and audit-ready reporting.
                </p>

                <div class="dso-hero__grid" role="list">
                    @foreach ($heroFeatures as $feature)
                        <article class="dso-hero__card" role="listitem">
                            <span class="dso-hero__icon" aria-hidden="true">
                                <i class="fa-solid {{ $feature['icon'] }}"></i>
                            </span>
                            <div>
                                <h2>{{ $feature['title'] }}</h2>
                                <p>{{ $feature['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <a href="#dso-consult" class="dso-btn dso-btn--green">Talk to an Architect</a>
            </div>
        </section>

        {{-- Certified Excellence --}}
        <section class="dso-section dso-section--tight" aria-labelledby="dso-certs-title">
            <div class="site-shell">
                <div class="dso-divider-label">
                    <span id="dso-certs-title">Certified Excellence</span>
                </div>

                <div
                    class="dso-certs"
                    x-data="{
                        index: 0,
                        perPage: 6,
                        total: {{ count($certificates) }},
                        get pages() { return Math.max(1, Math.ceil(this.total / this.perPage)); },
                        prev() { this.index = (this.index - 1 + this.pages) % this.pages; },
                        next() { this.index = (this.index + 1) % this.pages; },
                        setPage() {
                            this.perPage = window.innerWidth <= 640 ? 2 : (window.innerWidth <= 900 ? 3 : 6);
                            this.index = Math.min(this.index, this.pages - 1);
                        }
                    }"
                    x-init="setPage(); window.addEventListener('resize', () => setPage())"
                >
                    <button type="button" class="dso-certs__nav" @click="prev()" aria-label="Previous certifications">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="dso-certs__viewport">
                        <div
                            class="dso-certs__track"
                            role="list"
                            :style="`--dso-per-page: ${perPage}; transform: translateX(-${index * 100}%)`"
                        >
                            @foreach ($certificates as $certificate)
                                <div class="dso-certs__item" role="listitem">
                                    <img
                                        src="{{ $certImg($certificate) }}"
                                        alt="{{ pathinfo($certificate, PATHINFO_FILENAME) }} certification"
                                        width="110"
                                        height="110"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="button" class="dso-certs__nav" @click="next()" aria-label="Next certifications">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>

        {{-- Our Clients --}}
        <section class="dso-clients" aria-label="Our clients">
            <div class="site-shell">
                <div class="dso-divider-label dso-divider-label--green">
                    <span>Our Clients</span>
                </div>
            </div>
            <div class="dso-marquee">
                <div class="dso-marquee__track">
                    @foreach ([...$clientLogos, ...$clientLogos] as $logo)
                        <div class="dso-logo-chip">
                            <img
                                src="{{ $clientImg($logo) }}"
                                alt="{{ pathinfo($logo, PATHINFO_FILENAME) }} client logo"
                                width="140"
                                height="62"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Why Choose --}}
        <section class="dso-section dso-section--soft" aria-labelledby="dso-why-title">
            <div class="site-shell">
                <div class="dso-heading">
                    <h2 id="dso-why-title">Why Choose IBN Tech for DevSecOps?</h2>
                    <p>
                        Outcome-driven devsecops services integrate with your stack, delivered by pragmatic devsecops companies focused on developer experience and measurable time-to-value.
                    </p>
                </div>
                <div class="dso-why-grid" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="dso-why-card" role="listitem">
                            <span class="dso-why-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Services & Solutions --}}
        <section class="dso-section" aria-labelledby="dso-services-title">
            <div class="site-shell">
                <div class="dso-heading">
                    <h2 id="dso-services-title">DevSecOps Services &amp; Solutions</h2>
                    <p>
                        Engage via devsecops consulting for quick wins or adopt our devsecops managed services model for ongoing operations. Each devsecops service below scales from pilot to enterprise.
                    </p>
                </div>
                <div class="dso-services" role="list">
                    @foreach ($services as $service)
                        <article class="dso-service" role="listitem">
                            <span class="dso-service__num" aria-hidden="true">{{ $service['n'] }}</span>
                            <h3>{{ $service['title'] }}</h3>
                            <ul>
                                @foreach ($service['items'] as $item)
                                    <li>
                                        <i class="fa-solid fa-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <p>{{ $service['footer'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid-page CTA --}}
        <section class="dso-cta dso-cta--yellow" aria-labelledby="dso-cta-title">
            <div class="site-shell dso-cta__inner">
                <h2 id="dso-cta-title">Ready to launch your DevSecOps solution?</h2>
                <p>Talk to an expert about devsecops as a service, devsecops automation, and devsecops managed services tailored to your Azure or AWS pipelines.</p>
                <a href="#dso-consult" class="dso-btn dso-btn--green">Contact Our Experts</a>
            </div>
        </section>

        {{-- Typical Outcomes --}}
        <section class="dso-outcomes" aria-labelledby="dso-outcomes-title">
            <div class="site-shell">
                <div class="dso-heading dso-heading--light">
                    <h2 id="dso-outcomes-title">Typical Outcomes</h2>
                    <p>Teams adopting our devsecops solutions consistently report measurable improvements within weeks.</p>
                </div>
                <div class="dso-outcomes__grid" role="list">
                    @foreach ($outcomes as $outcome)
                        <article class="dso-outcome" role="listitem">
                            <p class="dso-outcome__value">{{ $outcome['value'] }}</p>
                            <p>{{ $outcome['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Tech Stack & Partnerships --}}
        <section class="dso-section" aria-labelledby="dso-stack-title">
            <div class="site-shell">
                <div class="dso-heading">
                    <h2 id="dso-stack-title">Tech Stack &amp; Partnerships</h2>
                    <p>We integrate open-source and commercial tools to create a cohesive devsecops solution across Azure and AWS.</p>
                </div>
                <div class="dso-stack" role="list">
                    @foreach ($stack as $item)
                        <article class="dso-stack-card" role="listitem">
                            <img
                                src="{{ $img($item['file']) }}"
                                alt="{{ $item['title'] }}"
                                width="35"
                                height="35"
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

        {{-- FAQ + Contact --}}
        <section class="dso-section dso-section--faq" id="dso-consult" aria-labelledby="dso-faq-title">
            <div class="site-shell dso-consult">
                <div class="dso-consult__faq">
                    <h2 id="dso-faq-title">Frequently Asked Questions</h2>
                    <div class="dso-faq">
                        @foreach ($faqs as $index => $faq)
                            <details class="dso-faq__item" @if ($index === 0) open @endif>
                                <summary>
                                    <span>{{ $faq['q'] }}</span>
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                </summary>
                                <div class="dso-faq__body">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <aside class="dso-consult__card" id="dso-consult-form" aria-labelledby="dso-consult-form-title">
                    <div class="dso-consult__card-head">
                        <h3 id="dso-consult-form-title">Speed Up Development with Built-In Security</h3>
                        <p>Secure every stage of your development process. Our DevSecOps experts help you deliver faster, safer software.</p>
                    </div>
                    <div class="dso-consult__card-body">
                        <livewire:forms.contact-form
                            form-name="devsecops-services"
                            id-prefix="dso"
                            :show-company="false"
                            :show-service="false"
                            message-placeholder="Message"
                            submit-label="Request a Consultation"
                            layout="default"
                            thank-you-url="/thanks-you-for-cloud/"
                        />
                    </div>
                </aside>
            </div>
        </section>
    </div>
@endsection
