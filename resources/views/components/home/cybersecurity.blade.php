@php
    $services = [
        [
            'title' => 'VAPT Services',
            'text' => 'Stay ahead of vulnerabilities with AI-enhanced penetration testing and quantum-resilient methodologies',
            'points' => ['Holistic Testing Approach', 'Compliance-Ready Reports', 'Expert Remediation Support'],
            'icon' => 'fa-bug-slash',
            'tone' => 'violet',
            'cta' => 'Explore VAPT',
            'href' => route('page.show', ['slug' => 'vapt-services']),
        ],
        [
            'title' => 'SOC & SIEM',
            'text' => 'Monitor, detect, and respond to threats in real time with our 24/7 AI-powered Security Operations Center.',
            'points' => ['Continuous Monitoring', 'Threat Intelligence', 'Incident Response', 'Audit-Ready Reporting'],
            'icon' => 'fa-satellite-dish',
            'tone' => 'green',
            'cta' => 'Explore SOC & SIEM',
        ],
        [
            'title' => 'MDR Services',
            'text' => 'Proactively hunt threats and orchestrate rapid response with machine learning-driven detection.',
            'points' => ['Behavioral Analytics', 'Automated Response', 'Deep Forensics', 'Threat Containment'],
            'icon' => 'fa-user-shield',
            'tone' => 'violet',
            'cta' => 'Explore MDR',
        ],
        [
            'title' => 'vCISO Services',
            'text' => 'Strategic cybersecurity leadership tailored to your business goals and regulatory landscape',
            'points' => ['Risk & Compliance Oversight', 'Board-Level Reporting', 'Security Roadmaps'],
            'icon' => 'fa-user-tie',
            'tone' => 'green',
            'cta' => 'Explore vCISO',
        ],
        [
            'title' => 'Microsoft Security',
            'text' => 'Secure your Microsoft ecosystem with expert management across Azure and M365 environments.',
            'points' => ['Identity & Access Control', 'Threat Protection', 'Cloud Compliance', 'Remediation Guidance'],
            'icon' => 'fa-microsoft',
            'tone' => 'violet',
            'cta' => 'Explore Microsoft Security',
        ],
        [
            'title' => 'Cyber Security Maturity Risk Assessment',
            'text' => 'Identify, evaluate, and strengthen your organization’s security posture with a comprehensive risk maturity assessment.',
            'points' => ['Risk Identification & Gap Analysis', 'Security Controls Evaluation', 'Compliance & Governance Insights'],
            'icon' => 'fa-chart-line',
            'tone' => 'green',
            'cta' => 'Explore Risk Assessment',
        ],
    ];
@endphp

<section class="home-section home-section--tint home-cyber" aria-labelledby="home-cyber-title">
    <div class="home-shell">
        <h2 id="home-cyber-title" class="home-section-title">
            Cybersecurity <span class="accent">Excellence</span>
        </h2>
        <p class="mt-2 text-lg italic text-[var(--home-muted)]">Built for Business. Backed by Trust.</p>
        <p class="home-section-lead mx-auto max-w-4xl">
            In a world where threats evolve by the second, your business deserves more than just protection—it needs a partner. Our cybersecurity solutions combine AI-driven intelligence with real-time defense to safeguard your digital assets, ensure compliance, and support uninterrupted growth.
        </p>

        <div class="home-service-grid">
            @foreach ($services as $service)
                <article class="home-card home-service-card">
                    <div class="home-service-card__icon home-service-card__icon--{{ $service['tone'] }}">
                        <i class="{{ $service['icon'] === 'fa-microsoft' ? 'fa-brands' : 'fa-solid' }} {{ $service['icon'] }}" aria-hidden="true"></i>
                    </div>
                    <h3>{{ $service['title'] }}</h3>
                    <p>{{ $service['text'] }}</p>
                    <ul>
                        @foreach ($service['points'] as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                    <a
                        href="{{ $service['href'] ?? '#' }}"
                        class="home-btn home-btn--grad"
                        @if(empty($service['href'])) data-contact-modal-trigger @endif
                    >
                        {{ $service['cta'] }} <span aria-hidden="true">→</span>
                    </a>
                </article>
            @endforeach
        </div>

        <div class="home-cta-bar">
            <div>
                <h3>Ready to Secure Your Future?</h3>
                <p>Get a comprehensive cybersecurity assessment and discover how our quantum-ready solutions can protect your organization against tomorrow’s threats.</p>
            </div>
            <a href="#" class="home-btn home-btn--light" data-contact-modal-trigger>Schedule Security Assessment</a>
        </div>
    </div>
</section>
