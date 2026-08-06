@php
    $certificates = [
        'ms-azure-administrator.webp',
        'ms-azure-data-scientist.webp',
        'ms-azure-database-administrator.webp',
        'ms-azure-security-engineer.webp',
        'ms-azure-solutions-architech.webp',
        'ms-azure-virtual-desktop.webp',
        'ms-cybersecurity-architech.webp',
        'ms-enterprise-administrator.webp',
        'ms-identity-and-access-administrator.webp',
        'ms-security-operations-analyst.webp',
    ];

    $securityExperts = [
        'ms-security.webp',
        'ms-infrastructure-azure.webp',
        'ms-data-and-ai-azure.webp',
        'ms-digital-and-app-innovation-azure.webp',
        'ms-modern-work.webp',
    ];
@endphp

<section class="home-section home-section--lavender" aria-labelledby="home-certifications-title">
    <div class="home-shell">
        <div class="text-center">
            <h2 id="home-certifications-title" class="home-section-title">
                <span class="accent">Certified for Excellence,</span> Committed to Compliance
            </h2>
            <p class="home-section-lead mx-auto max-w-3xl">
                From ISO to PCI DSS, our credentials reflect our dedication to secure, scalable, and compliant service delivery.
            </p>
        </div>

        <div class="home-certs__badges">
            @foreach ($certificates as $certificate)
                <img
                    src="{{ asset('images/Certificates/'.$certificate) }}"
                    alt="{{ pathinfo($certificate, PATHINFO_FILENAME) }} badge"
                    width="120"
                    height="120"
                    loading="lazy"
                    decoding="async"
                >
            @endforeach
        </div>

        <div class="home-certs__divider">
            <span class="home-pill home-pill--grad">Certified Security Experts</span>
        </div>

        <div class="home-security-certs">
            @foreach ($securityExperts as $logo)
                <article class="home-card home-cert-card">
                    <img
                        src="{{ asset('images/certified-security-experts/'.$logo) }}"
                        alt="{{ pathinfo($logo, PATHINFO_FILENAME) }} certification"
                        width="180"
                        height="90"
                        loading="lazy"
                        decoding="async"
                    >
                </article>
            @endforeach
        </div>
    </div>
</section>
