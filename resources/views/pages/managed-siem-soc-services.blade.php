@php
    $img = fn (string $file): string => asset('images/managed-siem-soc-services/'.$file);
    $certImg = fn (string $file): string => asset('images/vapt-certs/'.$file);
    $flagImg = fn (string $file): string => asset('images/icons/'.$file);

    $heroStats = [
        ['icon' => 'fa-clock', 'text' => '24/7 Threat Detection & Response'],
        ['icon' => 'fa-chart-line', 'text' => 'Proactive Risk Management'],
        ['icon' => 'fa-shield-halved', 'text' => '99.9% Uptime SLA'],
        ['icon' => 'fa-arrows-rotate', 'text' => '2.3 Min Average Response Time'],
        ['icon' => 'fa-crosshairs', 'text' => '98.7% Threat Detection Rate'],
        ['icon' => 'fa-hand-holding-dollar', 'text' => '$2.1M Average Cost Savings'],
    ];

    $certs = [
        ['file' => 'iso-certified.webp', 'alt' => 'ISO Certified'],
        ['file' => 'seceon-professional.png', 'alt' => 'Seceon Professional'],
        ['file' => 'ceh-ethical-hacker.webp', 'alt' => 'Certified Ethical Hacker'],
        ['file' => 'fortinet-certified-network-security-professional.webp', 'alt' => 'Fortinet Certified Network Security Professional'],
        ['file' => 'certified-payment.webp', 'alt' => 'Certified Payment Security Compliance Manager'],
        ['file' => 'cisa-certification-logo.webp', 'alt' => 'CISA Certification'],
    ];

    $landscapeStats = [
        ['value' => '11 Seconds', 'title' => 'Ransomware Attack Frequency', 'source' => 'managed security services', 'tone' => 'green'],
        ['value' => '$4.45M', 'title' => 'Average Data Breach Cost', 'source' => 'Security Report', 'tone' => 'green'],
        ['value' => '277 Days', 'title' => 'Average Detection time', 'source' => 'Time to identify and contain Breach', 'tone' => 'navy'],
        ['value' => '93%', 'title' => 'Network Penetration Rate', 'source' => 'Network penetration within 72 hours', 'tone' => 'green'],
    ];

    $siemFunctions = [
        ['label' => 'Collection:', 'text' => 'Aggregates logs from firewalls, endpoints, applications, and cloud services'],
        ['label' => 'Correlation', 'text' => 'Connects events across systems to identify attack patterns'],
        ['label' => 'Detection:', 'text' => 'Automated threat identification using behavioral analytics'],
        ['label' => 'Compliance', 'text' => 'Audit-ready reporting for regulatory frameworks'],
    ];

    $socCapabilities = [
        ['label' => 'Monitoring:', 'text' => 'Continuous monitoring for anomalous behavior and attack patterns'],
        ['label' => 'Analysis:', 'text' => 'Expert review of security events and threat assessment'],
        ['label' => 'Response:', 'text' => 'Immediate containment and remediation of identified threats'],
        ['label' => 'Reporting:', 'text' => 'Compliance-ready documentation and forensic analysis'],
    ];

    $offerings = [
        [
            'icon' => 'fa-layer-group',
            'title' => 'SIEM as a Service',
            'text' => 'Cloud-based log management and real-time threat correlation. Built for GDPR, HIPAA, and PCI-DSS compliance.',
            'theme' => 'navy',
        ],
        [
            'icon' => 'fa-clock',
            'title' => 'SOC as a Service',
            'text' => '24/7 expert monitoring with rapid incident response. No in-house team required, we cover it all.',
            'theme' => 'green',
        ],
        [
            'icon' => 'fa-file-shield',
            'title' => 'Managed Detection & Response',
            'text' => 'AI-assisted threat hunting combined with real-time containment and remediation by human security experts.',
            'theme' => 'purple',
        ],
    ];

    $specialized = [
        ['icon' => 'fa-magnifying-glass', 'title' => 'Threat hunting & intelligence', 'text' => 'Proactive detection of hidden and dormant threats using global behavioral analytics and threat intel feeds.'],
        ['icon' => 'fa-desktop', 'title' => 'Security device monitoring', 'text' => 'Real-time integrity and health checks across firewalls, endpoints, cloud assets, and network devices.'],
        ['icon' => 'fa-file-lines', 'title' => 'Compliance-driven monitoring', 'text' => 'Automated audit-ready reporting aligned to GDPR, HIPAA, PCI-DSS, and ISO 27001 frameworks.'],
        ['icon' => 'fa-triangle-exclamation', 'title' => 'Incident response & forensics', 'text' => 'Expert-led investigation, containment, and root cause analysis to recover rapidly when breaches occur.'],
        ['icon' => 'fa-shield-halved', 'title' => 'Vulnerability management', 'text' => 'Continuous scanning and patch management integrated into daily SOC operations to shrink your attack surface.'],
        ['icon' => 'fa-globe', 'title' => 'Dark web & insider threat monitoring', 'text' => 'Early breach detection via behavioral analytics, credential leak alerts, and real-time threat intelligence.'],
        ['icon' => 'fa-lock', 'title' => 'Policy & compliance monitoring', 'text' => 'Real-time enforcement of internal security policies and external compliance mandates with violation tracking.'],
        ['icon' => 'fa-chart-column', 'title' => 'Custom dashboards & reporting', 'text' => 'Role-based executive dashboards with compliance-ready KPIs and strategic security insights in real time.'],
        ['icon' => 'fa-users', 'title' => 'User behavior analytics (UBA)', 'text' => 'AI-based behavior modeling to detect insider threats, anomalies, and compromised accounts before damage is done.'],
    ];

    $whyChoose = [
        ['icon' => 'fa-dollar-sign', 'title' => 'Cost Effectiveness', 'text' => 'Scalable cost model without the need for any infrastructure or staff – India-based SOC delivering affordable, global security coverage.'],
        ['icon' => 'fa-bell', 'title' => 'Threat Detection & Intelligent Alerting', 'text' => 'AI-based threat detection, which continuously evolves along with new attacks - reducing false alerts through immediate action.'],
        ['icon' => 'fa-user-tie', 'title' => 'Expert Cybersecurity Professionals', 'text' => 'Licensed cyber professionals available instantly - with absolutely zero hiring costs and comprehensive incident and compliance management.'],
        ['icon' => 'fa-globe', 'title' => 'Global Reach', 'text' => 'Complete visibility from end to end covering all environments - standardized, centrally managed, and globally oriented.'],
        ['icon' => 'fa-clock', 'title' => '24x7 Global SOC Monitoring', 'text' => '24x7 support with SOC monitoring across the world, being aware of time zones and responding immediately.'],
        ['icon' => 'fa-file-lines', 'title' => 'Compliance-Ready Reports', 'text' => 'Cross-compliance with various standards including GDPR, HIPAA, PCI-DSS, ISO 27001, SOX and even RBI and SEBI sector regulations.'],
    ];

    $metrics = [
        [
            'icon' => 'fa-shield-halved',
            'items' => [
                'Reduce breach risk & business disruption',
                'Certified SOC expertise without hiring overhead',
                'Scalable, compliance-ready security',
            ],
        ],
        [
            'icon' => 'fa-globe',
            'items' => [
                'Full visibility across US, UK & India assets',
                'Cost-effective SOC provider in India',
                'Backed by Microsoft & Seceon Technologies',
            ],
        ],
        [
            'icon' => 'fa-bolt',
            'items' => [
                'Smart alerting with expert playbooks',
                'Timezone-aligned support (US/UK)',
                'Flexible pricing & engagement models',
            ],
        ],
    ];

    $stack = [
        ['file' => 'Microsoft-Sentine-1.webp', 'alt' => 'Microsoft Sentinel'],
        ['file' => 'WAZUH.webp', 'alt' => 'Wazuh'],
        ['file' => 'ibm.webp', 'alt' => 'IBM'],
        ['file' => 'Radar.webp', 'alt' => 'QRadar'],
        ['file' => 'seceon.webp', 'alt' => 'Seceon'],
    ];

    $regulations = [
        ['flag' => 'united-states-flag-icon.webp', 'title' => 'US Regulations', 'text' => 'HIPAA, PCI-DSS, SOX, GLBA, FISMA, NIST, CCPA'],
        ['flag' => 'united-kingdom-flag-icon.webp', 'title' => 'UK Regulations', 'text' => 'GDPR, Cyber Essentials, FCA'],
        ['flag' => 'india-flag-icon.webp', 'title' => 'India Regulations', 'text' => 'CERT-In, RBI, SEBI, ISO 27001'],
    ];

    $calculator = [
        100 => ['tools' => 275000, 'fte' => 500000, 'impl' => 60000, 'ibn' => 42000, 'percent' => '95%'],
        200 => ['tools' => 300000, 'fte' => 600000, 'impl' => 60000, 'ibn' => 48000, 'percent' => '95%'],
        300 => ['tools' => 325000, 'fte' => 600000, 'impl' => 60000, 'ibn' => 54000, 'percent' => '94%'],
        400 => ['tools' => 350000, 'fte' => 600000, 'impl' => 60000, 'ibn' => 60000, 'percent' => '94%'],
        500 => ['tools' => 375000, 'fte' => 800000, 'impl' => 60000, 'ibn' => 66000, 'percent' => '94%'],
        600 => ['tools' => 400000, 'fte' => 800000, 'impl' => 90000, 'ibn' => 72000, 'percent' => '94%'],
        700 => ['tools' => 425000, 'fte' => 900000, 'impl' => 90000, 'ibn' => 78000, 'percent' => '94%'],
        800 => ['tools' => 450000, 'fte' => 1000000, 'impl' => 90000, 'ibn' => 84000, 'percent' => '94%'],
        900 => ['tools' => 475000, 'fte' => 1200000, 'impl' => 100000, 'ibn' => 90000, 'percent' => '95%'],
        1000 => ['tools' => 500000, 'fte' => 1400000, 'impl' => 100000, 'ibn' => 96000, 'percent' => '95%'],
    ];

    $faqsLeft = [
        [
            'q' => 'Why should I choose IBN Technologies for SOC services?',
            'a' => 'IBN Technologies offers comprehensive SOC services with 24/7 expert monitoring, advanced threat detection, scalability, and cost-effective solutions tailored to your business needs.',
        ],
        [
            'q' => 'What threats does IBN Technologies SIEM detect?',
            'a' => 'IBN Technologies protects your company by detecting potential threats, such as malware, phishing, insider threats, and even sophisticated cyberattacks.',
        ],
        [
            'q' => 'How do SOC services by IBN Technologies assist in compliance?',
            'a' => 'The SOC services by IBN Technologies make sure your business remains compliant with the regulations like GDPR, HIPPA, PCI DSS) due to continuous monitoring.',
        ],
        [
            'q' => 'How can I start working with SOC services at IBN Technologies?',
                            'a' => 'You can contact IBN Technologies for a consultation, where you want to get assistance from their security experts who will provide you with a customized SOC strategy.',
        ],
        [
            'q' => 'How does IBN Technologies SOC services help with compliance?',
            'a' => 'IBN Technologies SOC services ensure your business meets regulatory compliance standards by providing ongoing monitoring and support to address compliance requirements like GDPR, HIPAA, and PCI DSS.',
        ],
    ];

    $faqsRight = [
        [
            'q' => 'What makes up IBN Technologies SIEM services?',
            'a' => 'The SIEM services provided by IBN Technologies include collecting, analyzing, and responding to security data to identify potential threats and respond to incidents while ensuring regulatory compliance.',
        ],
        [
            'q' => 'Is IBN Technologies SIEM compatible with existing security solutions?',
            'a' => 'Yes, IBN Technologies SIEM can be used with a variety of security products for enhanced threat detection and automated response capabilities.',
        ],
        [
            'q' => 'Does IBN Technologies provide SIEM services for cloud environments?',
            'a' => 'Yes, IBN Technologies SIEM service offers cloud and on-premise security management options.',
        ],
        [
            'q' => 'How does IBN Technologies SIEM service handle data privacy?',
            'a' => 'The SIEM system at IBN Technologies ensures compliance with privacy laws through safeguarding sensitive data during gathering, analysis, and storage. This is achieved following industry standards by IBN Technologies regarding data privacy and confidentiality.',
        ],
        [
            'q' => 'How frequently is data updated in IBN Technologies SIEM?',
            'a' => 'Data within IBN Technologies SIEM system is always available on an ongoing basis. This means that the data is updated instantly and provides security teams with the ability to respond to any security incidents in real-time.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    {{-- Home component styles are required for the reused client-logos marquee. --}}
    @vite(['resources/css/pages/home.css', 'resources/css/pages/managed-siem-soc-services.css'])
@endpush

@section('content')
    <div class="mss-page">
        {{-- Hero --}}
        <section class="mss-hero" aria-labelledby="mss-hero-title">
            <div class="site-shell mss-hero__inner">
                <div class="mss-hero__copy">
                    <p class="mss-hero__badge">Global Protection with Local Expertise</p>
                    <h1 id="mss-hero-title">
                        Managed <span class="mss-accent">SOC and SIEM</span> Services
                    </h1>
                    <p class="mss-hero__lede">
                        Secure your organizations with IBN Technologies round-the-clock Managed SOC and SIEM designed for real-time threat detection, rapid incident response, and compliance across global regulations.
                    </p>
                    <ul class="mss-hero__stats">
                        @foreach ($heroStats as $stat)
                            <li>
                                <span class="mss-hero__stat-icon" aria-hidden="true">
                                    <i class="fa-solid {{ $stat['icon'] }}"></i>
                                </span>
                                <span>{{ $stat['text'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="mss-hero__form" id="mss-quote" aria-labelledby="mss-form-title">
                    <h2 id="mss-form-title">Get Your SOC and SIEM Consultation</h2>
                    <livewire:forms.contact-form
                        form-name="managed-siem-soc-services"
                        id-prefix="mss"
                        :show-company="true"
                        :show-service="false"
                        message-placeholder="Where do you need the most protection?"
                        submit-label="BOOK A CONSULTATION"
                        layout="vapt"
                    />
                </aside>
            </div>
        </section>

        {{-- Certifications --}}
        <section class="mss-certs-section" aria-labelledby="mss-certs-title">
            <div class="site-shell">
                <div class="mss-certs-panel">
                    <h2 id="mss-certs-title">Industry Certifications and Strategic Partnerships</h2>
                    <p>Professional skills validated by top industry certifications and technological alliances</p>
                    <div class="mss-certs">
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

        {{-- Why businesses need --}}
        <section class="mss-section" aria-labelledby="mss-need-title">
            <div class="site-shell">
                <div class="mss-heading">
                    <h2 id="mss-need-title">
                        Why Businesses Need a <span class="mss-accent">Managed SIEM</span> and <span class="mss-accent">Managed SOC</span> Provider
                    </h2>
                    <p>
                        Latest cybersecurity statistics reveal the urgent need for professional managed security services. The numbers explain why outsourcing to a managed SOC and SIEM provider has become the default.
                    </p>
                    <span class="mss-landscape-pill">Cybersecurity Threat Landscape</span>
                    <p class="mss-landscape-note">Real world data showing the escalating cyber threat environment</p>
                </div>

                <div class="mss-stat-grid" role="list">
                    @foreach ($landscapeStats as $stat)
                        <article class="mss-stat-card" role="listitem">
                            <p class="mss-stat-card__value mss-stat-card__value--{{ $stat['tone'] }}">{{ $stat['value'] }}</p>
                            <h3>{{ $stat['title'] }}</h3>
                            <p>{{ $stat['source'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- SOC vs SIEM --}}
        <section class="mss-section mss-section--soft" aria-labelledby="mss-compare-title">
            <div class="site-shell">
                <div class="mss-heading">
                    <h2 id="mss-compare-title">Managed SOC vs Managed SIEM: Know the Difference</h2>
                </div>

                <div class="mss-compare">
                    <article class="mss-compare-card mss-compare-card--siem">
                        <div class="mss-compare-card__icon" aria-hidden="true">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <h3>What is Managed SIEM?</h3>
                        <p>
                            Managed SIEM services (Security Information and Event Management) involve collecting, centralizing, and analyzing security logs and events from all your IT infrastructure in real-time to detect suspicious activity.
                        </p>
                        <h4>
                            <i class="fa-solid fa-gears" aria-hidden="true"></i>
                            Core SIEM Functions
                        </h4>
                        <ul>
                            @foreach ($siemFunctions as $item)
                                <li>
                                    <span class="mss-bullet" aria-hidden="true"></span>
                                    <div>
                                        <strong>{{ $item['label'] }}</strong>
                                        <span>{{ $item['text'] }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </article>

                    <article class="mss-compare-card mss-compare-card--soc">
                        <div class="mss-compare-card__icon" aria-hidden="true">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <h3>What is Managed SOC?</h3>
                        <p>
                            A managed SOC offers 24/7/365 Security Operations Center (SOC) services, with certified cybersecurity experts continuously monitoring your IT infrastructure to detect and respond to security threats.
                        </p>
                        <h4>
                            <i class="fa-solid fa-gears" aria-hidden="true"></i>
                            Core SOC Capabilities
                        </h4>
                        <ul>
                            @foreach ($socCapabilities as $item)
                                <li>
                                    <span class="mss-check" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
                                    <div>
                                        <strong>{{ $item['label'] }}</strong>
                                        <span>{{ $item['text'] }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        {{-- Service offerings --}}
        <section class="mss-section" aria-labelledby="mss-offer-title">
            <div class="site-shell">
                <div class="mss-heading">
                    <h2 id="mss-offer-title">Our Managed SOC &amp; SIEM Service Offerings</h2>
                    <p>As a leading provider of SIEM and managed SOC services in India, we deliver comprehensive end-to-end cybersecurity services.</p>
                </div>

                <div class="mss-offer-grid" role="list">
                    @foreach ($offerings as $offer)
                        <article class="mss-offer-card mss-offer-card--{{ $offer['theme'] }}" role="listitem">
                            <div class="mss-offer-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $offer['icon'] }}"></i>
                            </div>
                            <h3>{{ $offer['title'] }}</h3>
                            <p>{{ $offer['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="mss-heading mss-heading--tight">
                    <h2 id="mss-special-title">Specialized Security Services</h2>
                </div>

                <div class="mss-special-grid" role="list">
                    @foreach ($specialized as $item)
                        <article class="mss-special-card" role="listitem">
                            <div class="mss-special-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="mss-cta" aria-labelledby="mss-cta-title">
            <div class="site-shell mss-cta__inner">
                <h2 id="mss-cta-title">Get Expert Security Protection Now</h2>
                <p>Using a combined SIEM and SOC service is a powerful protection against today's advanced threats. Schedule a consultation to see how we can help.</p>
                <a href="#mss-quote" class="button-primary">Schedule Security Consultation</a>
            </div>
        </section>

        {{-- Why choose --}}
        <section class="mss-section" aria-labelledby="mss-why-title">
            <div class="site-shell">
                <div class="mss-heading">
                    <h2 id="mss-why-title">Why Choose IBN Technologies Managed SOC and SIEM?</h2>
                    <p>
                        IBN Technologies is well-known as SIEM and managed SOC service provider, offering round-the-clock threat monitoring with compliance-ready security throughout USA, UK, and India.
                    </p>
                </div>

                <div class="mss-why-grid" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="mss-why-card" role="listitem">
                            <div class="mss-why-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </div>
                            <div>
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Performance metrics --}}
        <section class="mss-section mss-section--soft" aria-labelledby="mss-metrics-title">
            <div class="site-shell">
                <div class="mss-heading">
                    <h2 id="mss-metrics-title">SOC &amp; SIEM Services Performance Metrics &amp; Business Benefits</h2>
                    <p>Trusted SIEM &amp; Managed SOC Service Provider in India with Proven Security Expertise</p>
                </div>

                <div class="mss-metrics" role="list">
                    @foreach ($metrics as $column)
                        <article class="mss-metrics-card" role="listitem">
                            <div class="mss-metrics-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $column['icon'] }}"></i>
                            </div>
                            <ul>
                                @foreach ($column['items'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Closing CTA --}}
        <section class="mss-cta" aria-labelledby="mss-cta2-title">
            <div class="site-shell mss-cta__inner">
                <h2 id="mss-cta2-title">Ready to Strengthen Your Security Posture?</h2>
                <p>Using a combined SIEM and SOC service is a powerful protection against today's advanced threats. Schedule a consultation to see how we can help.</p>
                <a href="#mss-quote" class="button-primary">Schedule Security Consultation</a>
            </div>
        </section>

        {{-- Security operations stack --}}
        <section class="mss-stack" aria-labelledby="mss-stack-title">
            <div class="site-shell">
                <div class="mss-heading">
                    <h2 id="mss-stack-title">Security Operations Stack Expertise</h2>
                </div>
                <div class="mss-stack-grid" role="list">
                    @foreach ($stack as $logo)
                        <article class="mss-stack-card" role="listitem">
                            <img
                                src="{{ $img($logo['file']) }}"
                                alt="{{ $logo['alt'] }}"
                                width="211"
                                height="141"
                                loading="lazy"
                                decoding="async"
                            >
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Regulatory compliance --}}
        <section class="mss-section" aria-labelledby="mss-reg-title">
            <div class="site-shell">
                <div class="mss-heading">
                    <h2 id="mss-reg-title">Regulatory Compliance &amp; Global Coverage</h2>
                    <p>Comprehensive compliance coverage across major international regulations with automated reporting and audit support</p>
                </div>

                <div class="mss-reg-grid" role="list">
                    @foreach ($regulations as $region)
                        <article class="mss-reg-card" role="listitem">
                            <img
                                src="{{ $flagImg($region['flag']) }}"
                                alt="{{ $region['title'] }} flag"
                                width="72"
                                height="72"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $region['title'] }}</h3>
                            <p>{{ $region['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- SOC calculator --}}
        <section class="mss-section mss-section--soft" aria-labelledby="mss-calc-title">
            <div class="site-shell">
                <div class="mss-heading">
                    <h2 id="mss-calc-title">SOC-as-a-Service Calculator</h2>
                </div>

                <div
                    class="mss-calc"
                    data-costs='@json($calculator)'
                    x-data="{
                        users: '100',
                        costs: JSON.parse($el.dataset.costs),
                        money(n) { return '$' + Number(n).toLocaleString('en-IN'); },
                        get row() { return this.costs[this.users]; },
                        get inHouse() { return this.row.tools + this.row.fte + this.row.impl; },
                        get savings() { return this.inHouse - this.row.ibn; }
                    }"
                >
                    <label class="mss-calc__label" for="mss-users">Select Number of Users</label>
                    <select id="mss-users" name="users" class="mss-calc__select" x-model="users">
                        @foreach (array_keys($calculator) as $count)
                            <option value="{{ $count }}">{{ $count }} Users</option>
                        @endforeach
                    </select>

                    @php
                        $base = $calculator[100];
                        $baseInHouse = $base['tools'] + $base['fte'] + $base['impl'];
                        $baseSavings = $baseInHouse - $base['ibn'];
                        $usd = function (int $n): string {
                            $value = (string) abs($n);
                            $last3 = substr($value, -3);
                            $rest = substr($value, 0, -3);

                            if ($rest === '') {
                                return '$'.$last3;
                            }

                            return '$'.strrev(implode(',', str_split(strrev($rest), 2))).','.$last3;
                        };
                    @endphp
                    <div class="mss-calc__table" role="table" aria-label="SOC cost comparison">
                        <div class="mss-calc__row" role="row">
                            <div role="rowheader">
                                <strong>IN-HOUSE SOC EXPENSES</strong>
                                <span>SIEM Platform, SOAR Platform, Endpoint Detection &amp; Response (EDR) Platforms, etc.</span>
                            </div>
                            <div role="cell" x-text="money(row.tools)">{{ $usd($base['tools']) }}</div>
                        </div>
                        <div class="mss-calc__row" role="row">
                            <div role="rowheader">
                                <strong>FULL TIME EMPLOYEE COMPENSATION 24×7</strong>
                                <span>Security Analysts, SOC Manager, Incident Response Team, etc.</span>
                            </div>
                            <div role="cell" x-text="money(row.fte)">{{ $usd($base['fte']) }}</div>
                        </div>
                        <div class="mss-calc__row" role="row">
                            <div role="rowheader">
                                <strong>Product Implementation &amp; Maintenance</strong>
                                <span>Deployment, configuration, integrations, upgrades, and ongoing maintenance.</span>
                            </div>
                            <div role="cell" x-text="money(row.impl)">{{ $usd($base['impl']) }}</div>
                        </div>
                        <div class="mss-calc__row mss-calc__row--total" role="row">
                            <div role="rowheader">
                                <strong>Total In-House Cost</strong>
                                <span>Estimated annual operational cost for maintaining your own SOC infrastructure.</span>
                            </div>
                            <div role="cell" x-text="money(inHouse)">{{ $usd($baseInHouse) }}</div>
                        </div>
                        <div class="mss-calc__row mss-calc__row--ibn" role="row">
                            <div role="rowheader">
                                <strong>Our Estimated Cost Annually</strong>
                                <span>Managed SOC services with 24×7 monitoring and proactive threat response.</span>
                            </div>
                            <div role="cell" x-text="money(row.ibn)">{{ $usd($base['ibn']) }}</div>
                        </div>
                        <div class="mss-calc__row mss-calc__row--save" role="row">
                            <div role="rowheader">
                                <strong>Total Saving</strong>
                                <span>Estimated annual savings achieved with IBN Tech managed SOC services.</span>
                            </div>
                            <div role="cell" x-text="money(savings)">{{ $usd($baseSavings) }}</div>
                        </div>
                        <div class="mss-calc__row mss-calc__row--pct" role="row">
                            <div role="rowheader">
                                <strong>Savings Percentage</strong>
                                <span>Overall reduction in SOC operational expenses.</span>
                            </div>
                            <div role="cell" x-text="row.percent">{{ $base['percent'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="mss-section" aria-labelledby="mss-faq-title">
            <div class="site-shell">
                <div class="mss-heading">
                    <h2 id="mss-faq-title">Frequently Asked Questions</h2>
                </div>

                <div class="mss-faq-grid">
                    <div class="mss-faq">
                        @foreach ($faqsLeft as $index => $faq)
                            <details class="mss-faq__item" @if ($index === 0) open @endif>
                                <summary>
                                    <span>Q.{{ $index + 1 }} {{ $faq['q'] }}</span>
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                </summary>
                                <div class="mss-faq__body">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                    <div class="mss-faq">
                        @foreach ($faqsRight as $index => $faq)
                            <details class="mss-faq__item">
                                <summary>
                                    <span>Q.{{ $index + 6 }} {{ $faq['q'] }}</span>
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                </summary>
                                <div class="mss-faq__body">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
