@php
    $services = [
        ['title' => 'Multi Cloud Consulting & Migration', 'icon' => 'fa-cloud-arrow-up', 'color' => '#2f6fd6', 'href' => route('page.show', ['slug' => 'cloud-consulting-and-migration-services']),],
        ['title' => 'Managed Cloud & Security Services', 'icon' => 'fa-shield-halved', 'color' => '#4caf50', 'href' => route('page.show', ['slug' => 'cloud-managed-services']),],
        ['title' => 'Business Continuity & Disaster Recovery', 'icon' => 'fa-layer-group', 'color' => '#6e65f2', 'href' => route('page.show', ['slug' => 'business-continuity-disaster-recovery-services']),],
        ['title' => 'DevSecOps Implementation Services', 'icon' => 'fa-gears', 'color' => '#f0a202', 'href' => route('page.show', ['slug' => 'devsecops-services']),],
        ['title' => 'Microsoft 365 / Office 365 Migration', 'icon' => 'fa-headset', 'color' => '#e85d75', 'href' => route('page.show', ['slug' => 'microsoft-office-365-migration-support-services']),],
    ];

    $software = [
        'amazonwebservices-original-wordmark.svg',
        'azure-original.svg',
        'googlecloud-original.svg',
        'kubernetes-plain.svg',
        'docker-original.svg',
        'terraform-original.svg',
        'ansible-original.svg',
        'jenkins-original.svg',
        'prometheus-original.svg',
        'linux-original.svg',
        'python-original.svg',
        'bash-original.svg',
    ];

    $partnerships = [
        ['src' => 'images/partners/aws-partner-advanced-tier.webp', 'alt' => 'AWS Partner Advanced Tier Services'],
        ['src' => 'images/partners/MS-Gold-Partner.webp', 'alt' => 'Microsoft Gold Partner'],
        ['src' => 'images/partners/DSCI-logo.webp', 'alt' => 'DSCI Promoting Data Protection'],
        ['src' => 'images/Certificates/ms-azure-security-engineer.webp', 'alt' => 'Microsoft Azure Security Engineer Associate'],
        ['src' => 'images/Certificates/ms-azure-solutions-architech.webp', 'alt' => 'Microsoft Azure Solutions Architect Expert'],
        ['src' => 'images/Certificates/ms-azure-administrator.webp', 'alt' => 'Microsoft Azure Administrator Associate'],
        ['src' => 'images/Certificates/ms-security-operations-analyst.webp', 'alt' => 'Microsoft Security Operations Analyst Associate'],
        ['src' => 'images/Certificates/ms-enterprise-administrator.webp', 'alt' => 'Microsoft 365 Enterprise Administrator Expert'],
    ];
@endphp

<section class="home-section" aria-labelledby="home-cloud-title" data-scroll-anchor="cloud-section">
    <div class="home-shell">
        <div class="text-center">
            <h2 class="home-section-title">
                Operational Excellence <span class="accent">Meets Scalable Innovation</span>
            </h2>
            <p class="home-section-lead mx-auto max-w-3xl">
                Achieve operational excellence and long-term scalability with AI-powered solutions that transform processes into growth accelerators
            </p>
        </div>

        <div class="home-cloud__panel">
            <div class="home-cloud__top">
                <div>
                    <div class="home-cloud__heading">
                        <span class="home-cloud__icon">
                            <i class="fa-solid fa-cloud" aria-hidden="true"></i>
                        </span>
                        <div>
                            <h2 id="home-cloud-title" class="home-cloud__title">Cloud Services</h2>
                            <p class="home-cloud__subtitle">Next-Gen Infrastructure for Scalable Growth</p>
                        </div>
                    </div>
                    <p class="home-cloud__intro">
                        Multi-cloud solutions built around your business goals — with 99.9% uptime, zero-trust security, and DevSecOps agility at every layer.
                    </p>
                </div>
                <div class="home-cloud__metrics" aria-label="Cloud Infrastructure Metrics">
                    <article><strong>99.9%</strong><span>Guaranteed Uptime</span></article>
                    <article><strong>100%</strong><span>Backup Success</span></article>
                    <article><strong>99.8%</strong><span>Threat Response</span></article>
                    <article><strong>85%</strong><span>Faster CI/CD</span></article>
                </div>
            </div>

            <div class="home-cloud__services">
                @foreach ($services as $service)
                    <article>
                        <a href="{{ $service['href'] }}">
                            <i class="fa-solid {{ $service['icon'] }}" style="background: {{ $service['color'] }}" aria-hidden="true"></i>
                            <h3>{{ $service['title'] }}</h3>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>

        <div class="home-cloud__logos">
            <article class="home-card">
                <h3 class="home-cloud__logos-title">
                    <i class="fa-solid fa-certificate" aria-hidden="true"></i>
                    Cloud Certifications &amp; Partnerships
                </h3>
                <div class="home-software-grid home-cloud__partners">
                    @foreach ($partnerships as $logo)
                        <div class="home-logo-chip">
                            <img src="{{ asset($logo['src']) }}" alt="{{ $logo['alt'] }}" width="120" height="80" loading="lazy" decoding="async">
                        </div>
                    @endforeach
                </div>
            </article>
            <article class="home-card">
                <h3 class="home-cloud__logos-title">Software expertise</h3>
                <div class="home-software-grid">
                    @foreach ($software as $logo)
                        <div class="home-logo-chip">
                            <img src="{{ asset('images/cloud-software-expertise-logos/'.$logo) }}" alt="{{ pathinfo($logo, PATHINFO_FILENAME) }}" width="110" height="40" loading="lazy" decoding="async">
                        </div>
                    @endforeach
                </div>
            </article>
        </div>

        <div class="home-cta-bar home-cta-bar--navy">
            <div>
                <h3>Secure Your Cloud Before It’s Too Late - Book a Consultation</h3>
                <p>Start your cloud transformation today with a proven plan that eliminates risks and ensures uninterrupted performance.</p>
            </div>
            <a href="javascript:void(0)" class="home-btn home-btn--white" data-scroll-target="home-form">Get Started Now →</a>
        </div>
    </div>
</section>
