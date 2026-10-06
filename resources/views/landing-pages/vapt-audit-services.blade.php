@extends('layouts.landing')

@php
    $lpImg = fn (string $file): string => asset('images/landing-pages/'.$file);

    $heroItems = [
        ['icon' => 'fa-display', 'tone' => 'pink', 'label' => 'Web and Mobile Application Penetration Testing'],
        ['icon' => 'fa-cloud', 'tone' => 'blue', 'label' => 'Cloud Security Penetration Testing'],
        ['icon' => 'fa-mobile-screen-button', 'tone' => 'yellow', 'label' => 'IoT Devices Penetration Testing'],
        ['icon' => 'fa-cube', 'tone' => 'green', 'label' => 'API Penetration Testing'],
        ['icon' => 'fa-globe', 'tone' => 'purple', 'label' => 'Network Penetration Testing'],
        ['icon' => 'fa-code', 'tone' => 'orange', 'label' => 'Source Code Review'],
    ];

    $services = [
        [
            'icon' => 'Network-Infra-VAPT-ICON.webp',
            'title' => 'Network Infra VAPT',
            'text' => 'Your network is the backbone of your business, but is it secure? Our Network Infrastructure VAPT dives deep into your network, exposing weak links, identifying vulnerable devices, and neutralizing potential threats before they strike. Don’t let hackers exploit your network—let us help you stay safe!',
        ],
        [
            'icon' => 'Web-Mobile-VAPT-ICON.webp',
            'title' => 'Web & Mobile VAPT',
            'text' => 'Your web and mobile apps are prime targets for cybercriminals. IBN Tech expert-led VAPT services focus on OWASP Top 10 vulnerabilities, NIST-CWE standards,and PCI DSS compliance. Using advanced static, dynamic, and forensic tools, we ensure your apps are bulletproof. Because when it comes to app security, there’s no room for compromise.',
        ],
        [
            'icon' => 'Cloud-VAPT-ICON-icon.webp',
            'title' => 'Cloud VAPT',
            'text' => 'The cloud is powerful, but is it secure? Our Cloud Infrastructure VAPT leaves no stone unturned, examining your cloud architecture from the network layer to virtual data centers. We uncover attack vectors, patch vulnerabilities, and ensure your cloud remains a safe haven for your data and applications',
        ],
        [
            'icon' => 'IoT-Devices-ICON.webp',
            'title' => 'IoT Devices',
            'text' => 'Businesses can securely utilize linked devices by utilizing IBN Tech all-inclusive IoT services. IBN Tech guarantees the stability and scalability of IoT solutions, from design and development to deployment and management. We support businesses in innovating while preserving data integrity and operational efficiency in IoT security and architecture.',
        ],
        [
            'icon' => 'Network-Infra-VAPT-ICON.webp',
            'title' => 'API VAPT',
            'text' => 'Your APIs are the gatekeepers of your data, but are they strong enough to withstand an attack? IBN Tech API VAPT services are here to change the game. We identify weak spots, fortify defences, and ensure your data flows securely across systems. Don’t let your APIs be the weakest link—let’s make them your strongest shield.',
        ],
        [
            'icon' => '247-Managed-Security-Services-ICON.webp',
            'title' => '24/7 Managed Security Services',
            'text' => 'Cyber threats don’t take breaks, & neither do we. With IBN Tech 24/7 Managed Security Services, you can rest easy knowing your digital infrastructure is under constant surveillance. From risk assessments to compliance management (GDPR, HIPAA, you name it), we’ve got you covered. Your business is safe, secure, and always compliant.',
        ],
    ];

    $industriesLeft = [
        'BFSI (Banking, Financial Services & Insurance)',
        'Fintech',
        'Telecom',
        'Manufacturing',
        'Infrastructure',
        'Government',
        'Conglomerates',
        'Cloud Service Platforms',
        'Education & EdTech',
        'Energy & Utilities',
        'Media & Entertainment',
        'Legal Services',
        'Logistics & Supply Chain',
    ];

    $industriesRight = [
        'NBFC (Non-Banking Financial Companies)',
        'IT/Consulting',
        'Consumer Internet',
        'Healthcare',
        'Technology',
        'SaaS (Software as a Service)',
        'Human Resources',
        'E-commerce',
        'Retail',
        'Automotive',
        'Real Estate',
        'Aviation',
        'Travel & Hospitality',
    ];

    $expertise = [
        ['icon' => 'fa-laptop-code', 'value' => '10,000+', 'label' => 'Applications Tested'],
        ['icon' => 'fa-desktop', 'value' => '25,000+', 'label' => 'IT Infrastructure Devices Tested & Delivered'],
        ['icon' => 'fa-file-pen', 'value' => '3,100+', 'label' => 'Weeks of Testing Experience'],
        ['icon' => 'fa-code', 'value' => '2,000+', 'label' => 'Test Cases Across Mobile, Web, and IoT Devices'],
        ['icon' => 'fa-shield-halved', 'value' => '15,000+', 'label' => 'Vulnerabilities Detected'],
        ['icon' => 'fa-file-code', 'value' => '150 Million+', 'label' => 'Lines of Code Tested'],
    ];

    $faqs = [
        [
            'q' => 'What is VAPT testing, and why is it important for businesses in India?',
            'a' => 'VAPT (Vulnerability Assessment and Penetration Testing) is a crucial cybersecurity practice that helps identify and mitigate security vulnerabilities in networks, applications, and systems. Businesses in India need to conduct VAPT to protect their data and comply with regulatory requirements.',
        ],
        [
            'q' => 'How can VAPT services from IBN Tech benefit my business in India?',
            'a' => 'IBN Tech offers complete VAPT services tailored to the unique needs of businesses in India. Our services include vulnerability assessment, penetration testing, and compliance audits, ensuring robust security measures and regulatory compliance.',
        ],
        [
            'q' => 'What types of VAPT testing does IBN Tech provide?',
            'a' => 'IBN Tech specializes in various VAPT testing services, including network penetration testing, web application VAPT, mobile application security testing, and cloud penetration testing. These services help businesses identify and remediate vulnerabilities across their IT infrastructure.',
        ],
        [
            'q' => 'Why should my business choose IBN Tech as a VAPT service provider in India?',
            'a' => 'IBN Tech is a trusted name in the industry, known for delivering reliable VAPT services in India. Our team of cybersecurity experts conducts thorough assessments, provides actionable insights, and supports businesses in enhancing their overall security posture effectively.',
        ],
        [
            'q' => 'What is included in IBN Tech VAPT audit services?',
            'a' => 'IBN Tech VAPT audit services encompass comprehensive vulnerability scanning, penetration testing, risk assessment, and compliance audits. These services are designed to identify, prioritize, and address security gaps effectively.',
        ],
        [
            'q' => 'How does IBN Tech ensure confidentiality and data privacy during VAPT testing?',
            'a' => 'IBN Tech adheres to strict confidentiality agreements and data protection protocols throughout the VAPT testing process. Our approach ensures that sensitive information remains secure and always protected.',
        ],
        [
            'q' => 'What support does IBN Tech offer after completing VAPT testing?',
            'a' => 'After completing VAPT testing, IBN Tech provides detailed reports, actionable recommendations, and ongoing support to assist businesses in implementing remediation measures and maintaining a secure environment.',
        ],
        [
            'q' => 'What should I consider when choosing a VAPT service provider?',
            'a' => 'Look for expertise, certifications, experience in your industry, and a track record of delivering thorough assessments and actionable recommendations.',
        ],
        [
            'q' => 'How do VAPT vendors in India differ from global providers?',
            'a' => 'VAPT vendors in India like IBN Tech offer localized expertise and an understanding of regional cybersecurity challenges while adhering to global best practices and standards.',
        ],
    ];

    $reasons = [
        '27+ years of experience in Cyber Security, Hosting and Cloud Consulting Services.',
        'Certified team of lead auditors.',
        '1200+ satisfied clients in 10 + countries.',
        'ISO 9001:2015 & 27001:2022 Certified Company',
        'Dedicated Red Team & Ciso Services Provider.',
        'CIO 10 most promising cloud solutions provider',
        'SiliconIndia 25 most promising cloud computing companies',
        'Partnerships with Sophos, Crowdstrike, Fortinet, Sumo Logic and more.',
        '24 x 7, 365 days Dedicated support services',
        'Authorized solutions partners of AWS, Azure, Acronis, HPE Greenlake, Jio Cloud.',
    ];
@endphp

@section('content')
<div class="lvas-page">
    <section class="lvas-callbar" aria-label="Call now">
        <div class="lvas-shell lvas-callbar__inner">
            <p>Your Needs. Our Expertise. Call Now to Connect.</p>
            <a href="tel:020-711-79586">
                <i class="fa-solid fa-phone" aria-hidden="true"></i>
                020-711-79586
            </a>
        </div>
    </section>

    <section class="lvas-hero" aria-labelledby="lvas-hero-title">
        <img
            class="lvas-hero__bg"
            src="{{ $lpImg('vapt-lp-hero-img.webp') }}"
            alt=""
            aria-hidden="true"
            width="1920"
            height="900"
            fetchpriority="high"
            decoding="async"
        >
        <img
            class="lvas-hero__badge"
            src="{{ $lpImg('Microsoft-Logo-PNG-arrow.webp') }}"
            alt="Microsoft Solutions Partner"
            width="216"
            height="300"
        >
        <div class="lvas-shell lvas-hero__inner">
            <div class="lvas-hero__copy">
                <h1 id="lvas-hero-title">Vulnerability Assessment &amp; Penetration Testing Services!</h1>
                <p>
                    IBN Tech offers expert VAPT Security Testing Services with over 26 years of cybersecurity experience.
                    We conduct both manual and automated penetration testing to safeguard data, ensure compliance,
                    and streamline your security strategy.
                </p>
                <ul class="lvas-hero__items">
                    @foreach ($heroItems as $item)
                        <li>
                            <span class="lvas-hero__icon lvas-hero__icon--{{ $item['tone'] }}" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <span>{{ $item['label'] }}</span>
                        </li>
                    @endforeach
                </ul>
                <img
                    class="lvas-hero__awards"
                    src="{{ $lpImg('Logo-for-VAPT-Website.webp') }}"
                    alt="SiliconIndia 25 Most Promising Cloud Computing Companies and CIO Review 10 Most Promising Cloud Migration Solution Providers"
                    width="290"
                    height="50"
                >
            </div>

            <div class="lvas-hero__form" id="lvas-consult">
                <h2>Schedule A Free Consultation!</h2>
                <livewire:forms.landing-inquiry-form
                    :landing-page-slug="$landingPage->slug"
                    :landing-page-title="$landingPage->title"
                    id-prefix="lp-vapt-audit-services-hero"
                    phone-country="in"
                    thank-you-url="/lp/vapt-audit-services-thank-you/"
                    wire:key="landing-inquiry-vapt-audit-services-hero"
                />
            </div>
        </div>
    </section>

    <section class="lvas-certs" aria-label="Team certifications">
        <div class="lvas-shell">
            <img
                src="{{ $lpImg('Team-Certification-Logo.webp') }}"
                alt="Team certifications including CEH, ISO, and cybersecurity credentials"
                width="1920"
                height="600"
            >
        </div>
    </section>

    <section class="lvas-services" aria-labelledby="lvas-services-title">
        <div class="lvas-shell">
            <h2 id="lvas-services-title">COMPREHENSIVE VAPT SERVICES: SAFEGUARDING YOUR DIGITAL ASSETS</h2>
            <div class="lvas-services__grid">
                @foreach ($services as $service)
                    <article>
                        <span class="lvas-services__icon">
                            <img src="{{ $lpImg($service['icon']) }}" alt="" width="1080" height="1080">
                        </span>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lvas-why" aria-labelledby="lvas-why-title">
        <div class="lvas-shell">
            <h2 id="lvas-why-title">Why Entrust Us with Your Cybersecurity?</h2>
            <p class="lvas-why__lead">Did you know 95% of cybersecurity breaches are due to human error or system vulnerabilities?</p>
            <p>
                Don’t be part of the vulnerable majority. IBN Tech has 27+ years of industry expertise in providing VAPT Testing Services and is one of the leading Cybersecurity solutions provider companies and best VAPT services providers in India. We offer complete VAPT services that protect your network, apps, cloud, APIs &amp; more ensuring compliance with GDPR, HIPAA, &amp; PCI DSS. Proactive, scalable, reliable, and customized to your needs—your security is our priority, while you stay at peace.
            </p>
            <img
                class="lvas-why__diagram"
                src="{{ $lpImg('comprehensive-Cybersecurity-management-PNG.webp') }}"
                alt="Comprehensive Cybersecurity management"
                width="1080"
                height="1080"
            >
        </div>
    </section>

    <section class="lvas-industries" aria-labelledby="lvas-industries-title">
        <div class="lvas-shell lvas-industries__inner">
            <div>
                <h2 id="lvas-industries-title">Industries We Serve:</h2>
                <p>
                    We serve 400+ clients across India, the US, UK, and MENA, spanning diverse industries. Our tailored solutions cater to various sectors, ensuring optimal results and client satisfaction.
                </p>
                <div class="lvas-industries__lists">
                    <ul>
                        @foreach ($industriesLeft as $industry)
                            <li>{{ $industry }}</li>
                        @endforeach
                    </ul>
                    <ul>
                        @foreach ($industriesRight as $industry)
                            <li>{{ $industry }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="lvas-industries__media">
                <img
                    src="{{ $lpImg('cybersecurity-image.webp') }}"
                    alt="Cybersecurity protection across digital devices"
                    width="519"
                    height="325"
                >
            </div>
        </div>
    </section>

    <section class="lvas-expertise" aria-labelledby="lvas-expertise-title">
        <div class="lvas-shell">
            <h2 id="lvas-expertise-title">Our Expertise</h2>
            <div class="lvas-expertise__grid">
                @foreach ($expertise as $stat)
                    <article>
                        <i class="fa-solid {{ $stat['icon'] }}" aria-hidden="true"></i>
                        <h3>{{ $stat['value'] }}</h3>
                        <p>{{ $stat['label'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lvas-faq" aria-labelledby="lvas-faq-title">
        <div class="lvas-shell">
            <h2 id="lvas-faq-title">VAPT Services FAQs</h2>
            <div class="lvas-faq__list">
                @foreach ($faqs as $index => $faq)
                    <details @if ($index === 0) open @endif>
                        <summary>{{ $faq['q'] }}</summary>
                        <p>{{ $faq['a'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lvas-choose" aria-labelledby="lvas-choose-title">
        <div class="lvas-shell">
            <h2 id="lvas-choose-title">Why to choose us</h2>
            <ul class="lvas-choose__list">
                @foreach ($reasons as $reason)
                    <li>{{ $reason }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="lvas-sales" aria-labelledby="lvas-sales-title">
        <div class="lvas-shell">
            <div class="lvas-sales__panel">
                <div class="lvas-sales__head">
                    <h2 id="lvas-sales-title">Speak to Sales</h2>
                </div>
                <div class="lvas-sales__form">
                    <livewire:forms.landing-inquiry-form
                        :landing-page-slug="$landingPage->slug"
                        :landing-page-title="$landingPage->title"
                        id-prefix="lp-vapt-audit-services-sales"
                        phone-country="in"
                        thank-you-url="/lp/vapt-audit-services-thank-you/"
                        wire:key="landing-inquiry-vapt-audit-services-sales"
                    />
                </div>
            </div>
        </div>
    </section>

    <nav class="lvas-stickybar" aria-label="Quick contact">
        <a class="lvas-stickybar__call" href="tel:02071179586">
            <i class="fa-solid fa-phone" aria-hidden="true"></i>
            Call Now
        </a>
        <a class="lvas-stickybar__sales" href="#lvas-consult">
            <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
            Speak to Sales
        </a>
    </nav>
</div>
@endsection
