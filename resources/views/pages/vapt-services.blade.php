@php
    $vaptServiceOptions = [
        'Web, API & Mobile Penetration Testing',
        'Network Penetration Testing',
        'Wireless Penetration Testing',
        'IoT Pen Testing',
        'Social Engineering & Phishing Simulation',
        'Cloud Security Testing (Azure / AWS)',
        'OWASP Top 10 & SANS Controls Mapping',
        'Red Team Penetration Testing',
    ];

    $needCards = [
        ['icon' => 'fa-magnifying-glass', 'title' => 'Identification of Vulnerabilities', 'text' => 'Detect vulnerabilities before they can be used against you.'],
        ['icon' => 'fa-shield-halved', 'title' => 'Verify Security Measures', 'text' => 'Determine whether current security measures can withstand an attack.'],
        ['icon' => 'fa-file-lines', 'title' => 'Comply with Regulations', 'text' => 'Comply with standards such as PCI DSS, GDPR, and ISO 27001.'],
        ['icon' => 'fa-chart-line', 'title' => 'Manage Risk', 'text' => 'Manage risks before they become problems.'],
    ];

    $offerings = [
        [
            'icon' => 'fa-globe',
            'title' => 'Web, API & Mobile Penetration Testing',
            'text' => 'Identify and fix vulnerabilities with our web application penetration testing aligned with OWASP Top 10 standards, industry best practices and secure coding guidelines.',
            'points' => ['SQL Injection, XSS, CSRF detection', 'Simulated attack scenarios', 'Secure source code review', 'Risk reporting with remediation guidance', 'Retesting to verify fixes'],
        ],
        [
            'icon' => 'fa-network-wired',
            'title' => 'Network Penetration Testing',
            'text' => 'Internal and External Network Penetration Testing simulates real-world attacks to uncover and remediate vulnerabilities in your public-facing infrastructure.',
            'points' => ['ACLs, routing, and authentication flaws', 'Privilege escalation and lateral movement risks', 'Insecure or deprecated protocols', 'Firewall and router misconfigurations', 'Overprivileged accounts and default credentials'],
        ],
        [
            'icon' => 'fa-wifi',
            'title' => 'Wireless Penetration Testing',
            'text' => 'Wireless vulnerability assessment to secure your wireless environment from unauthorized access, data leakage, signal interception, rogue devices, and protocol weaknesses.',
            'points' => ['Rogue access points detection', 'Weak encryption protocols', 'Wireless client vulnerabilities', 'Role-Based Access Control (RBAC)'],
        ],
        [
            'icon' => 'fa-microchip',
            'title' => 'IoT Pen Testing',
            'text' => 'IoT Vulnerabilities Assessment helps secure smart ecosystems by identifying and addressing risks across firmware, communication protocols, mobile apps, and cloud platforms.',
            'points' => ['Firmware & Embedded Systems', 'Mobile Applications', 'Cloud Infrastructure & APIs', 'Communication Protocols'],
        ],
        [
            'icon' => 'fa-user-secret',
            'title' => 'Social Engineering & Phishing Simulation',
            'text' => 'Assess employee awareness and email security response to attacker deception tactics, impersonation techniques, malicious payloads and behavioral manipulation.',
            'points' => ['Targeted Phishing Campaigns', 'Awareness & Training Evaluation', 'Email Security Assessment'],
        ],
        [
            'icon' => 'fa-cloud',
            'title' => 'Cloud Penetration Testing (Azure / AWS)',
            'text' => 'Cloud Penetration Testing identifies vulnerabilities and ensures your cloud deployments are secure and compliant.',
            'points' => ['Misconfiguration Detection', 'Serverless and Container Security', 'Data Protection and Privacy Validation', 'Regulatory Compliance Gap Analysis'],
        ],
        [
            'icon' => 'fa-list-check',
            'title' => 'OWASP Top 10 & SANS Controls Mapping',
            'text' => 'Align your security strategy with globally recognized standards for robust protection and compliance.',
            'points' => ['OWASP Top 10 application security risks', 'SANS Critical Security Controls', 'Industry compliance - ISO 27001, PCI-DSS, HIPAA, and SOC2'],
        ],
        [
            'icon' => 'fa-crosshairs',
            'title' => 'Red Team Penetration Testing',
            'text' => 'Red Teaming tests your organization’s defenses through stealthy, goal-driven simulations mimicking adversarial tactics.',
            'points' => ['Detection and response capabilities', 'Physical and digital security layers', 'Incident response effectiveness', 'Access control and privilege management', 'Data protection and encryption practices'],
        ],
    ];

    $processSteps = [
        ['icon' => 'search-icon.webp', 'title' => 'Discovery & Scoping', 'text' => 'Asset inventory & regulatory mapping (e.g. HIPAA / CERT-In)'],
        ['icon' => 'pc-check-icon.webp', 'title' => 'Automated Scanning', 'text' => 'Tools like Nessus, Burp, Nmap'],
        ['icon' => 'pc-cog-icon.webp', 'title' => 'Manual Penetration Testing', 'text' => 'Exploits validated by analysts'],
        ['icon' => 'light-blub-icon.webp', 'title' => 'Risk Reporting & Prioritization', 'text' => 'CVSS-based ranking, executive overview, compliance mapping'],
        ['icon' => 'doc-data-icon.webp', 'title' => 'Remediation Support & Retesting', 'text' => 'Fix validation, on-demand retests, consultative support'],
        ['icon' => 'pc-cog-icon.webp', 'title' => 'Continuous PTaaS Option', 'text' => 'Recurring scans, dashboards, SOC integration, live issue tracking, monthly review, subscription savings.'],
    ];

    $whyChoose = [
        ['icon' => 'fa-certificate', 'title' => 'Certified Security Experts', 'text' => 'OSCP, CEH, CISSP, CREST, and CERT-IN accredited professionals.'],
        ['icon' => 'fa-flask', 'title' => 'Hybrid Testing Approach', 'text' => 'Combines manual penetration testing with automated vulnerability assessment for comprehensive coverage.'],
        ['icon' => 'fa-clipboard-check', 'title' => 'Compliance-Focused Assessments', 'text' => 'Aligned with ISO 27001, PCI DSS, HIPAA, GDPR, NIST, SOC 2, CERT-IN, RBI, SEBI, IRDAI, and DPDP requirements.'],
        ['icon' => 'fa-gauge-high', 'title' => 'PTaaS-Enabled Testing', 'text' => 'Real-time dashboards, issue tracking, remediation workflows, retesting, and SLA-based support.'],
        ['icon' => 'fa-route', 'title' => 'End-to-End Engagements', 'text' => 'From asset discovery and risk identification to remediation planning and validation.'],
        ['icon' => 'fa-sliders', 'title' => 'Flexible Service Models', 'text' => 'One-time assessments, retainer engagements, customized SLAs, and on-demand testing options.'],
        ['icon' => 'fa-building', 'title' => 'SMB & Enterprise Ready', 'text' => 'Cost-effective solutions customized to growing businesses and mid-market organizations preparing for third-party audits.'],
        ['icon' => 'fa-trophy', 'title' => 'Proven Track Record', 'text' => '1,000+ VAPT engagements delivered across 50+ industries in India and globally.'],
        ['icon' => 'fa-brain', 'title' => 'Threat Intelligence-Driven Testing', 'text' => 'Updated with the latest CVEs, zero-day vulnerabilities, exploit techniques, and attacker TTPs.'],
        ['icon' => 'fa-lock', 'title' => 'ISO 27001:2022 Certified Organization', 'text' => 'Committed to maintaining the highest standards of information security and data protection.'],
    ];

    $benefits = [
        ['title' => 'Rapid Risk Visibility', 'text' => 'Critical vulnerabilities identified within days'],
        ['title' => 'Compliance-Ready Deliverables', 'text' => 'Audit-ready for HIPAA, ISO 27001, SOC 2, GDPR, CERT‑IN'],
        ['title' => 'High Risk Remediation', 'text' => 'Achieve up to 85‑95% risk reduction postfix.'],
        ['title' => 'Scalable Pricing', 'text' => 'Enterprise-grade testing without the high cost'],
        ['title' => 'Long-Term Security Strategy', 'text' => 'PTaaS builds long-term resilience and maturity'],
    ];

    $tools = [
        'Nessus.webp', 'Burp-Suite-Pro.webp', 'Nmap.webp', 'OWASP-ZAP.webp', 'Metasploit.webp', 'Qualys.webp',
        'MobSF.webp', 'Nikto.webp', 'Cobalt-Strike.webp', 'Manage-Engine.webp', 'amazon-inspector.webp', 'kali-logo.webp',
    ];

    $vaptTestimonials = [
        [
            'name' => 'Raj Soni',
            'role' => 'Senior Compliance Officer, IMRIEL',
            'quote' => 'As one of our valued vendors, we would like to take this opportunity to thank you for your efforts and collaboration with us over the past year. We have conducted a thorough evaluation of your performance and are pleased to inform you that based on our assessment, your overall performance has been good. We have assigned a rating of Grade A to your company. We value our partnership with you, and we believe that by working together, we can continue to achieve mutually beneficial results. We appreciate your attention to this matter and look forward to your continued support. Thank you for your cooperation.',
        ],
        [
            'name' => 'Syed Muhammad Umair',
            'role' => 'Senior Technical Manager, Ephlux',
            'quote' => 'I wanted to take a moment to express my gratitude for the outstanding support and completion of the VAPT process by you and your team. Your dedication and hard work are truly appreciated. I am looking forward to a smooth closure and continuing our successful collaboration. Thanks for the prompt VA/PT testing, and in the call today we witnessed some good findings. We really appreciate the efforts made by the Cloud IBN team. Keep the pace up guys!',
        ],
        [
            'name' => 'Vishal Tompe',
            'role' => 'Senior IT Associate, Digitalzone',
            'quote' => "You're very welcome and thank you for completing the VAPT project! I'm glad to hear that the project went smoothly and that the team worked together effectively. It's important to acknowledge all team members' hard work and dedication, and I'm sure your leadership played a significant role in the project's success.",
        ],
        [
            'name' => 'Meera',
            'role' => 'Technologist, Metamorphtech',
            'quote' => 'Appreciate the efforts taken by you and your team for completing the VAPT of our applications. Based on your reports, we have applied fixes and submitted the applications for VAPT at the customer end.',
        ],
        [
            'name' => 'Kailas Kadam',
            'role' => 'Project Manager, Asset Analytix',
            'quote' => 'Thank you for the service. I wanted to extend my heartfelt appreciation to help me complete the test and provide me with the VAPT test report and update it when needed. I also definitely would like to extend my gratitude the all the other people involved in this project. I\'ll be sure to reach out to you if I require any assistance soon. Thank you once again.',
        ],
        [
            'name' => 'Arun Seby',
            'role' => 'CSA, Aurionpro Solutions Ltd.',
            'quote' => 'Thank you for confirming the completion of the VAPT project. I appreciate the effort your team put into this engagement. It was great working with you; all the communication was smooth, and the findings were clear and helpful. Please pass on my thanks to your security team for their hard work and support throughout the process. Looking forward to working with you again in the future.',
        ],
        [
            'name' => 'Ardhendu Rout',
            'role' => 'Lead DBA - IT, Innofin Solutions Pvt Ltd.',
            'quote' => 'We at Lendenclub sincerely appreciate your team\'s outstanding efforts and dedication in successfully completing the Vulnerability Assessment and Penetration Testing (VAPT) project. The results of the VAPT process have provided us with invaluable insights and actionable recommendations that will significantly strengthen our overall security posture. The smooth and timely completion of this crucial task would not have been possible without your diligence and expertise. Once again, thank you for your exceptional efforts. We look forward to continuing to work with you and the team on future projects with the same level of enthusiasm and excellence. Wishing you continued success.',
        ],
        [
            'name' => 'Syam Srinivas',
            'role' => 'Co-Founder & CTO, MicroGrid Technologies Pvt Ltd.',
            'quote' => 'Dear IBN Team, On behalf of our team, I would like to extend our sincere gratitude and appreciation for the exceptional support and collaboration you provided throughout the VAPT and Source Code Review for CTA Harbour Project. Your team’s dedication to identifying vulnerabilities, thoroughly reviewing the source code, and providing valuable insights has been immensely helpful. We truly value the professionalism and expertise you brought to the table. A special thank you for going above and beyond, especially in assisting us to close this engagement outside of the initially agreed timeline. Your flexibility and extended support were critical in ensuring we could address all necessary areas and complete the project successfully. We look forward to continuing our partnership on future projects and are grateful for your ongoing commitment to excellence. Once again, thank you for your hard work and support.',
        ],
        [
            'name' => 'Varun Joneja',
            'role' => 'Senior Custom Software Development, ISC IT Services Pvt Ltd.',
            'quote' => 'Thank you for the prompt responses yesterday for the final report and certificate, they both are in order. Appreciate it. Thank you very much for your support during this process. You and your team conducted the testing successfully and promptly. Thanks to Piyush for his assistance in setting this up.',
        ],
        [
            'name' => 'Sambhav Jain',
            'role' => 'Cybersecurity Analyst, SparxIT Solutions Pvt Ltd.',
            'quote' => 'I wanted to take a moment to share our feedback regarding the recent work delivered by your team. We are pleased with the outcome; the deliverables met all expectations. Your team demonstrated strong professionalism, clear communication, and timely execution throughout the engagement. We especially appreciate the prompt responses and the smooth coordination during the process. Thank you for the great work, support and being a reliable partner. We look forward to continuing this collaboration.',
        ],
        [
            'name' => 'Laveena Khushalani',
            'role' => 'Founder\'s Office, Enbraun Technologies Pvt Ltd.',
            'quote' => 'Thank you for your cooperation and for all the support your team has provided throughout this process.',
        ],
    ];

    $indiaLocations = [
        ['title' => 'VAPT Services in Bangalore', 'text' => "India's Silicon Valley - Helping Bangalore's SaaS and technology innovators stay secure with expert-led VAPT assessments"],
        ['title' => 'VAPT Services in Mumbai', 'text' => "India's Financial Capital - Supporting BFSI and FinTech organizations with security testing aligned to regulatory needs."],
        ['title' => 'VAPT Services in Hyderabad', 'text' => "India's Pharma & Tech Hub - Protecting healthcare, pharma, and technology businesses through comprehensive security assessments."],
        ['title' => 'VAPT Services in Chennai', 'text' => "India's Automotive & Manufacturing Hub - Helping manufacturing and enterprise organizations strengthen their cybersecurity posture."],
        ['title' => 'VAPT Services in Pune', 'text' => "India's Fast-Growing IT & Startup Ecosystem - Partnering with Pune's startups and IT companies to identify and remediate security risks."],
        ['title' => 'VAPT Services in Kolkata', 'text' => "Eastern India's Commercial Gateway - Assisting enterprises and public sector organizations in Kolkata with actionable vulnerability assessments."],
        ['title' => 'VAPT Services in Ahmedabad', 'text' => "India's Industrial & Business Growth Hub - Helping businesses secure applications, networks, and cloud environments as they scale."],
        ['title' => 'VAPT Services in Delhi', 'text' => "Home to India's Leading GCCs & Enterprise Headquarters – Supporting GCCs, MNCs, and enterprises with enterprise-grade VAPT expertise."],
    ];

    $globalLocations = [
        ['title' => 'USA', 'text' => 'VAPT for SaaS, healthcare, cloud, and FinTech organizations.'],
        ['title' => 'United Kingdom', 'text' => 'Penetration testing aligned with regulatory and compliance requirements.'],
        ['title' => 'UAE', 'text' => 'Cybersecurity assessments for financial, technology, and enterprise sectors.'],
        ['title' => 'Australia', 'text' => 'Security testing for applications, infrastructure, and cloud environments.'],
        ['title' => 'Singapore', 'text' => 'VAPT audit services for regulated businesses and technology companies.'],
    ];

    $deliverables = [
        ['icon' => 'fa-file-lines', 'title' => 'Executive Risk Summary', 'text' => 'Business-focused overview of key findings from your VAPT assessment.'],
        ['icon' => 'fa-book', 'title' => 'Detailed VAPT Report', 'text' => 'Comprehensive vulnerability assessment and penetration testing report with evidence.'],
        ['icon' => 'fa-bug', 'title' => 'Penetration Testing Findings', 'text' => 'Validated security vulnerabilities with proof of exploitation and impact.'],
        ['icon' => 'fa-chart-column', 'title' => 'CVSS Risk Ratings', 'text' => 'Industry-standard risk scoring to prioritize remediation efforts.'],
        ['icon' => 'fa-sitemap', 'title' => 'Compliance Mapping', 'text' => 'Findings mapped to ISO 27001, SOC 2, PCI DSS, HIPAA, and CERT-IN requirements.'],
        ['icon' => 'fa-wrench', 'title' => 'Remediation Recommendations', 'text' => 'Actionable guidance to address vulnerabilities and strengthen cybersecurity.'],
        ['icon' => 'fa-rotate', 'title' => 'Retesting & Validation Report', 'text' => 'Verification that identified vulnerabilities have been successfully remediated.'],
        ['icon' => 'fa-stamp', 'title' => 'Attestation & Closure Letter', 'text' => 'Audit-ready documentation for compliance, regulatory, and customer requirements.'],
    ];

    $industries = [
        ['icon' => 'fa-cubes', 'title' => 'SaaS & Product Companies', 'text' => 'Securing applications, APIs, and cloud platforms.'],
        ['icon' => 'fa-building-columns', 'title' => 'FinTech & BFSI', 'text' => 'Protecting financial systems and digital transactions.'],
        ['icon' => 'fa-heart-pulse', 'title' => 'Healthcare & Pharma', 'text' => 'Safeguarding sensitive patient and research data.'],
        ['icon' => 'fa-cart-shopping', 'title' => 'E-commerce Platforms', 'text' => 'Securing online stores and customer information.'],
        ['icon' => 'fa-cloud', 'title' => 'Cloud Providers & MSPs', 'text' => 'Assessing cloud and managed environments.'],
        ['icon' => 'fa-industry', 'title' => 'Manufacturing & Industrial', 'text' => 'Protecting IT, OT, and SCADA systems.'],
        ['icon' => 'fa-rocket', 'title' => 'Startups', 'text' => 'Building security readiness for growth and compliance.'],
        ['icon' => 'fa-city', 'title' => 'GCCs & Enterprises', 'text' => 'Delivering enterprise-grade security assessments.'],
        ['icon' => 'fa-landmark', 'title' => 'Government & PSUs', 'text' => 'Supporting CERT-In-aligned cybersecurity initiatives.'],
        ['icon' => 'fa-graduation-cap', 'title' => 'EdTech & Digital Platforms', 'text' => 'Protecting user data and online learning ecosystems.'],
    ];

    $pricingRows = [
        ['category' => 'Vulnerability Assessment & Penetration Testing (VAPT)', 'silver' => 'Annual testing of 1 app/network', 'gold' => 'Bi-annual testing for up to 3 apps/networks', 'platinum' => 'Quarterly testing for all critical infra (Web, API, Mobile, Network)'],
        ['category' => 'Source Code Review', 'silver' => '1 application (manual + automated)', 'gold' => 'Up to 3 applications', 'platinum' => 'Unlimited business-critical apps with secure SDLC integration'],
        ['category' => 'Phishing Simulation & User Awareness', 'silver' => '1 simulation/year', 'gold' => 'Quarterly simulations', 'platinum' => 'Monthly simulations'],
        ['category' => 'IT / IS Audit', 'silver' => 'Annual audit for core IT infrastructure', 'gold' => 'Half-yearly audits', 'platinum' => 'Quarterly audits'],
        ['category' => 'Red Teaming / Adversary Simulation', 'silver' => 'Not Included', 'gold' => 'Annual exercise on key assets', 'platinum' => 'Bi-annual full-spectrum Red Teaming (physical, digital, social)'],
        ['category' => 'Cloud Security Review', 'silver' => '1-time config review (AWS/Azure/GCP)', 'gold' => 'Bi-annual cloud infra assessment', 'platinum' => 'Quarterly cloud infra assessment'],
        ['category' => 'Revalidation Testing', 'silver' => '1 round after fixes', 'gold' => '2 rounds with fix validation', 'platinum' => 'Unlimited within 30 days of each test'],
        ['category' => 'Support SLA', 'silver' => 'Email support (TAT 72 hrs)', 'gold' => 'Email + Phone (TAT 24 hrs)', 'platinum' => 'Dedicated account manager + Priority support (TAT 4–8 hrs)'],
        ['category' => 'Pricing', 'silver' => 'Cost-effective', 'gold' => 'Balanced', 'platinum' => 'Premium'],
    ];

    $caseStudies = [
        [
            'title' => 'A Pioneer In Medical Practice Solutions Achieves HIPAA Compliance And Enhanced Security With VAPT',
            'image' => 'medical-practice-hipaa-vapt.png',
        ],
        [
            'title' => 'An Innovative Digital Transformation Firm Enhances Security & Trust With Comprehensive VAPT For Swift Applications',
            'image' => 'digital-transformation-vapt.png',
        ],
        [
            'title' => 'US-Based Salesforce-Powered B2B Applications Solution Provider',
            'image' => 'salesforce-b2b-vapt.png',
        ],
    ];

    $faqs = [
        ['q' => 'What types of VAPT does IBN Technologies offer?', 'a' => 'We provide Web Application, Mobile Application, API, Network, Cloud, Wireless, Infrastructure, and External/Internal Penetration Testing services.'],
        ['q' => 'Is VAPT a recurring process or a one-time activity?', 'a' => 'VAPT is expected to be a recurring process, where you have the testing conducted recurrently to handle threats and risks as well as maintaining security continuously.'],
        ['q' => 'How frequent is VAPT recommended for businesses?', 'a' => 'VAPT is advisable to conduct at intervals depending on the changes that occur in your infrastructure or applications, and in case of security breaches.'],
        ['q' => 'How long does a VAPT exercise with IBN Technologies take?', 'a' => 'The time it takes for a VAPT exercise with IBN Technologies to be completed varies based on the number of tests to be done.'],
        ['q' => 'In what ways will VAPT support compliance management?', 'a' => 'Our VAPT audit services help ensure that your infrastructure meets the standards of GDPR, HIPAA, PCI DSS, and others while avoiding fines because of compliance failures.'],
        ['q' => 'Can IBN Technologies VAPT help protect against cyberattacks?', 'a' => 'Yes. IBN Technologies VAPT services identify and fix security vulnerabilities before attackers can exploit them, helping reduce the risk of cyberattacks, data breaches, and business disruptions.'],
        ['q' => 'How is VAPT conducted using IBN Technologies?', 'a' => 'IBN Technologies conducts VAPT using automated scanning methods combined with testing processes to find weaknesses and mimic possible attacks.'],
        ['q' => 'How does IBN Technologies prioritize the vulnerabilities discovered during VAPT?', 'a' => 'IBN Technologies prioritizes the most threatening vulnerabilities found using VAPT to mitigate serious risks first.'],
        ['q' => 'How do I get started with IBN Technologies VAPT services?', 'a' => 'You can request a consultation with IBN Technologies experts who will customize a VAPT solution for your business after assessing your specific needs.'],
        ['q' => 'Does IBN Technologies provide VAPT services outside India?', 'a' => 'Yes. We deliver remote and on-site VAPT services for organizations across the USA, UK, UAE, Australia, Singapore, and other global regions.'],
        ['q' => 'What frameworks and standards does IBN Technologies follow for VAPT?', 'a' => 'Our assessments align with OWASP, PTES, NIST, OSSTMM, CERT-In guidelines, ISO 27001, PCI DSS, SOC 2, and other industry standards.'],
        ['q' => 'How much Does VAPT cost in India?', 'a' => 'Every environment is different, so VAPT costs depend on the size, complexity, and scope of your assessment. We provide transparent, customized pricing with no hidden fees, ensuring you get the right level of security testing for your business and budget.'],
        ['q' => 'Why is VAPT important for organizations in India?', 'a' => 'VAPT helps organizations identify and remediate security vulnerabilities before attackers can exploit them. It strengthens cybersecurity resilience, supports compliance with Indian regulatory requirements such as CERT-In, RBI, SEBI, IRDAI, UIDAI, and NPCI, protects sensitive business and customer data, and demonstrates a strong security posture to customers, partners, and auditors.'],
    ];

    $certs = [
        ['file' => 'iso-certified.webp', 'alt' => 'ISO Certified'],
        ['file' => 'seceon-professional.png', 'alt' => 'Seceon Professional'],
        ['file' => 'ceh-ethical-hacker.webp', 'alt' => 'Certified Ethical Hacker'],
        ['file' => 'fortinet-certified-network-security-professional.webp', 'alt' => 'Fortinet Certified Network Security Professional'],
        ['file' => 'certified-payment.webp', 'alt' => 'Certified Payment Security Compliance Manager'],
        ['file' => 'ejpt-certification.webp', 'alt' => 'eJPT Certification'],
        ['file' => 'cisa-certification-logo.webp', 'alt' => 'CISA Certification'],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    {{-- Home component styles are required for reused client-logos / testimonials sections. --}}
    @vite(['resources/css/pages/home.css', 'resources/css/pages/vapt-services.css'])
@endpush

@section('content')
    <div class="vapt-page">
        {{-- Hero --}}
        <section class="vapt-hero" aria-labelledby="vapt-hero-title">
            <img
                class="vapt-hero__bg"
                src="{{ asset('images/vapt-hero-img.webp') }}"
                alt=""
                aria-hidden="true"
                width="1536"
                height="1024"
                fetchpriority="high"
                decoding="async"
            >
            <div class="site-shell vapt-hero__inner">
                <div class="vapt-hero__copy">
                    <h1 id="vapt-hero-title">
                        Vulnerability Assessment and
                        <span class="vapt-accent">Penetration Testing (VAPT)</span>
                        Services
                    </h1>
                    <p class="vapt-hero__lede">
                        Leading manual and automated full-stack
                        <span class="vapt-accent">VAPT services in India</span>
                        and global markets, including the USA, UK, UAE, Australia, and Singapore, helping SMBs and mid-market enterprises identify vulnerabilities, pass VAPT audit & strengthen cyber resilience.
                    </p>
                    <div class="vapt-hero__actions">
                        <a href="#vapt-process" class="button-primary">View Our Process</a>
                    </div>
                    <div class="vapt-hero__stats" role="list">
                        <div class="vapt-hero__stat" role="listitem">
                            <strong>99%</strong>
                            <span>Accuracy - near-zero false positives</span>
                        </div>
                        <div class="vapt-hero__stat" role="listitem">
                            <strong>100%</strong>
                            <span>Compliance-ready reports</span>
                        </div>
                        <div class="vapt-hero__stat" role="listitem">
                            <strong>24/7</strong>
                            <span>Expert access &amp; retainer support</span>
                        </div>
                    </div>
                </div>

                <div class="vapt-hero__form" id="vapt-quote">
                    <h2>Get Your VAPT Quote</h2>
                    <livewire:forms.contact-form
                        form-name="vapt-services-quote"
                        id-prefix="vapt-hero"
                        :show-service="true"
                        :service-options="$vaptServiceOptions"
                        service-placeholder="Pick Your Service Type"
                        message-placeholder="Describe your security testing requirements"
                        submit-label="BOOK A CONSULTATION"
                        layout="vapt"
                    />
                </div>
            </div>
        </section>

        {{-- Certifications --}}
        <section class="vapt-certs-section" aria-labelledby="vapt-certs-title">
            <div class="site-shell">
                <div class="vapt-certs-panel">
                    <h2 id="vapt-certs-title">
                        Certified and Trusted by Global Cybersecurity Accreditation Leaders
                    </h2>
                    <div class="vapt-certs">
                        @foreach ($certs as $cert)
                            <img
                                src="{{ asset('images/vapt-certs/'.$cert['file']) }}"
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

        {{-- What is VAPT --}}
        <section class="section-block section-block--soft" aria-labelledby="vapt-what-title">
            <div class="site-shell">
                <div class="vapt-what-card">
                    <div class="vapt-what-card__copy">
                        <h2 id="vapt-what-title">What is VAPT? Security Insights for Indian &amp; Global Businesses</h2>
                       <p>Vulnerability Assessment and Penetration Testing (VAPT) is a structured cybersecurity approach that combines automated vulnerability identification with real-world attack simulation to assess and validate security risks.  </p>
                       <p>By utilizing comprehensive VAPT audit services, organizations can strengthen their security posture, remediate exploitable weaknesses, and achieve seamless compliance with CERT-In, RBI, SEBI, IRDAI, UIDAI, ISO 27001, SOC 2, PCI DSS, HIPAA, and DPDP Act standards. </p>
                        <div class="vapt-keywords" aria-label="VAPT strengths">
                            <span>Visibility</span>
                            <span>Precision</span>
                            <span>Risk Insight</span>
                            <span>Compliance Ready</span>
                        </div>
                    </div>
                    <div class="vapt-what-card__aside">
                        <article>
                            <div class="vapt-what-card__icon" aria-hidden="true"><i class="fa-solid fa-shield-halved"></i></div>
                            <div>
                                <h3>Vulnerability Assessment (VA)</h3>
                                <p>Structured vulnerability identification across systems, networks, and applications to uncover security weaknesses, assess exposure levels, and support effective risk remediation.</p>
                            </div>
                        </article>
                        <article>
                            <div class="vapt-what-card__icon" aria-hidden="true"><i class="fa-solid fa-bullseye"></i></div>
                            <div>
                                <h3>Penetration Testing (PT)</h3>
                                <p>Involves exploiting vulnerabilities. To build a strong security posture, pen testing should be integrated with vulnerability assessments and supported by a well-defined incident response plan.</p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        {{-- Why need VAPT --}}
        <section class="section-block" aria-labelledby="vapt-need-title">
            <div class="site-shell">
                <div class="vapt-need-panel">
                    <div class="vapt-need-panel__head">
                        <h2 id="vapt-need-title">Why Does Your Business Need VAPT Security Services?</h2>
                        <p>We help you proactively detect vulnerabilities, secure critical assets, and build a more resilient cybersecurity environment</p>
                    </div>
                    <div class="vapt-need-grid">
                        @foreach ($needCards as $card)
                            <article class="vapt-need-card">
                                <div class="vapt-need-card__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $card['icon'] }}"></i>
                                </div>
                                <h3>{{ $card['title'] }}</h3>
                                <p>{{ $card['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Offerings --}}
        <section class="section-block section-block--soft" aria-labelledby="vapt-offerings-title">
            <div class="site-shell">
                <div class="section-heading">
                    <h2 id="vapt-offerings-title">Our Vulnerability Assessment and Penetration Testing Services</h2>
                </div>
                <div class="vapt-service-grid">
                    @foreach ($offerings as $offering)
                        <article class="vapt-service-card">
                            <div class="vapt-service-card__top">
                                <div class="vapt-service-card__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $offering['icon'] }}"></i>
                                </div>
                                <h3>{{ $offering['title'] }}</h3>
                            </div>
                            <p>{{ $offering['text'] }}</p>
                            <ul>
                                @foreach ($offering['points'] as $point)
                                    <li>{{ $point }}</li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>

                <div class="vapt-cta-bar" style="margin-top: 2rem;">
                    <div>
                        <p>Tell us about your environment and we’ll scope the right combination of testing services for your risk profile and budget.</p>
                    </div>
                    <a href="#" class="button-primary" data-contact-modal-trigger>Request a Consultation</a>
                </div>
            </div>
        </section>

        {{-- Process --}}
        <section class="section-block" id="vapt-process" aria-labelledby="vapt-process-title">
            <div class="site-shell">
                <div class="section-heading">
                    <h2 id="vapt-process-title">How the VAPT Process Works?</h2>
                </div>
                <div class="vapt-process">
                    @foreach ($processSteps as $step)
                        <article>
                            <div class="vapt-process__icon" aria-hidden="true">
                                <img
                                    src="{{ asset('images/vapt-icons/'.$step['icon']) }}"
                                    alt=""
                                    width="48"
                                    height="48"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <div>
                                <h3>{{ $step['title'] }}</h3>
                                <p>{{ $step['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Why Choose --}}
        <section class="section-block section-block--tint" aria-labelledby="vapt-why-title">
            <div class="site-shell">
                <div class="section-heading">
                    <h2 id="vapt-why-title">Why Choose IBN Technologies for Penetration Testing and VAPT Services?</h2>
                    <p>
                    Partner with IBN Technologies, a trusted VAPT service provider powered by CEH and OSCP-certified experts who keep your infrastructure secure. We go beyond basic vulnerability assessment services by conducting deep manual exploitation and delivering robust risk mitigation strategies.  
                    </p>
                </div>
                <div class="vapt-why-grid">
                    @foreach ($whyChoose as $item)
                        <article class="vapt-why-card">
                            <i class="fa-solid {{ $item['icon'] }}" aria-hidden="true"></i>
                            <div>
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="vapt-cta-bar" style="margin-top: 2rem;">
                    <div>
                        <h3>Stronger Security. Lower Risk. Greater Confidence.</h3>
                        <p>VAPT helps you stay secure, compliant, and ahead of threats.</p>
                    </div>
                    <a href="#vapt-quote" class="button-primary">Get Started Today</a>
                </div>
            </div>
        </section>

        {{-- Benefits --}}
        <section class="section-block" aria-labelledby="vapt-benefits-title">
            <div class="site-shell vapt-benefits">
                <div class="vapt-benefits__media">
                    <img
                        src="{{ asset('images/Benefits-of-VAPT.webp') }}"
                        alt="Key benefits of VAPT and penetration testing"
                        width="640"
                        height="420"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div>
                    <div class="section-heading section-heading--left" style="margin-bottom: 0;">
                        <h2 id="vapt-benefits-title">Key benefits of a VAPT &amp; Penetration Testing by IBN Technologies</h2>
                        <p>Combining assessment and exploitation for comprehensive risk management and long-term security resilience.</p>
                    </div>
                    <ul class="vapt-benefits__list">
                        @foreach ($benefits as $benefit)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <div>
                                    <strong>{{ $benefit['title'] }}</strong>
                                    <span>{{ $benefit['text'] }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        {{-- Tools --}}
        <section class="section-block section-block--soft" aria-labelledby="vapt-tools-title">
            <div class="site-shell">
                <div class="section-heading">
                    <h2 id="vapt-tools-title">Pen Testing Methodology &amp; Tools</h2>
                    <p>Industry-proven scanners, frameworks, and offensive security platforms used across our engagements.</p>
                </div>
                <div class="vapt-methodology">
                    <img
                        src="{{ asset('images/VAPT-Pen-Testing-Methodology.webp') }}"
                        alt="VAPT pen testing methodology process"
                        width="1100"
                        height="420"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="vapt-tools">
                    @foreach ($tools as $tool)
                        <article>
                            <img
                                src="{{ asset('images/vapt-tools/'.$tool) }}"
                                alt="{{ pathinfo($tool, PATHINFO_FILENAME) }} tool"
                                width="120"
                                height="60"
                                loading="lazy"
                                decoding="async"
                            >
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Delivery locations --}}
        <section
            class="section-block"
            aria-labelledby="vapt-delivery-title"
            x-data="{ tab: 'india' }"
        >
            <div class="site-shell">
                <div class="section-heading">
                    <h2 id="vapt-delivery-title">Where We Deliver VAPT Services</h2>
                    <p>
                        From India’s leading tech hubs to global business centers, IBN Technologies delivers scalable VAPT and Penetration Testing Services through on-site and remote engagements customized to your industry and compliance needs.
                    </p>
                </div>

                <div class="vapt-tabs" role="tablist" aria-label="Delivery coverage">
                    <button type="button" role="tab" :class="{ 'is-active': tab === 'india' }" :aria-selected="tab === 'india'" @click="tab = 'india'">India Coverage</button>
                    <button type="button" role="tab" :class="{ 'is-active': tab === 'global' }" :aria-selected="tab === 'global'" @click="tab = 'global'">Global Delivery</button>
                </div>

                <div x-show="tab === 'india'" x-cloak>
                    <p class="article-excerpt" style="margin-bottom: 1.25rem;">Security testing serving organizations across India with remote and on-site VAPT expertise.</p>
                    <div class="vapt-location-grid">
                        @foreach ($indiaLocations as $location)
                            <article class="vapt-location-card">
                                <h3>{{ $location['title'] }}</h3>
                                <p>{{ $location['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div x-show="tab === 'global'" x-cloak>
                    <p class="article-excerpt" style="margin-bottom: 1.25rem;">Remote-first VAPT services supporting organizations across multiple regions and time zones.</p>
                    <div class="vapt-location-grid">
                        @foreach ($globalLocations as $location)
                            <article class="vapt-location-card">
                                <h3>{{ $location['title'] }}</h3>
                                <p>{{ $location['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Deliverables --}}
        <section class="section-block section-block--tint" aria-labelledby="vapt-reports-title">
            <div class="site-shell">
                <div class="section-heading">
                    <h2 id="vapt-reports-title">Your Trusted Partner for Fast VAPT Reports &amp; Certification</h2>
                    <p>A compliance-ready deliverable set, timed against a predictable engagement schedule.</p>
                </div>
                <div class="vapt-icon-grid">
                    @foreach ($deliverables as $item)
                        <article class="vapt-icon-card">
                            <i class="fa-solid {{ $item['icon'] }}" aria-hidden="true"></i>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Industries --}}
        <section class="section-block" aria-labelledby="vapt-industries-title">
            <div class="site-shell">
                <div class="section-heading">
                    <h2 id="vapt-industries-title">Industries- Who We Serve</h2>
                </div>
                <div class="vapt-icon-grid">
                    @foreach ($industries as $industry)
                        <article class="vapt-icon-card">
                            <i class="fa-solid {{ $industry['icon'] }}" aria-hidden="true"></i>
                            <h3>{{ $industry['title'] }}</h3>
                            <p>{{ $industry['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="vapt-cta-bar" style="margin-top: 2rem;">
                    <div>
                        <h3>Protect your digital assets now — get fast, compliance-ready testing today!</h3>
                        <p>Our comprehensive Vulnerability Assessment and Penetration Testing services help identify and address security weaknesses before they can be exploited.</p>
                    </div>
                    <a href="#" class="button-primary" data-contact-modal-trigger>Request a Consultation</a>
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <x-home.testimonials
            :items="$vaptTestimonials"
            title="Client Testimonial"
            subtitle="We redefine possibilities, helping you gain fresh perspectives, uncover new opportunities, and achieve remarkable results that transform aspirations into reality."
        />

        {{-- Pricing tiers --}}
        <section class="section-block section-block--soft" aria-labelledby="vapt-pricing-title">
            <div class="site-shell">
                <div class="section-heading">
                    <h2 id="vapt-pricing-title">Choose Your Testing Tier</h2>
                    <p>Security that fits your budget and your timeline. Get started before threats strike.</p>
                </div>

                <div class="vapt-pricing-wrap">
                    <table class="vapt-pricing">
                        <thead>
                            <tr>
                                <th scope="col">Category</th>
                                <th scope="col">
                                    <span class="tier-name">Silver</span>
                                    <span class="tier-price">Cost-effective</span>
                                </th>
                                <th scope="col">
                                    <span class="tier-name">Gold</span>
                                    <span class="tier-price">Balanced</span>
                                </th>
                                <th scope="col">
                                    <span class="tier-name">Platinum</span>
                                    <span class="tier-price">Premium</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pricingRows as $row)
                                <tr>
                                    <th scope="row">{{ $row['category'] }}</th>
                                    <td>{{ $row['silver'] }}</td>
                                    <td>{{ $row['gold'] }}</td>
                                    <td>{{ $row['platinum'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="vapt-pricing__actions">
                    <a
                        href="#"
                        class="button-primary"
                        data-contact-modal-trigger
                        data-contact-variant="vapt-quote"
                        data-contact-service="Silver"
                    >Get Silver Package Quote</a>
                    <a
                        href="#"
                        class="button-primary"
                        data-contact-modal-trigger
                        data-contact-variant="vapt-quote"
                        data-contact-service="Gold"
                    >Get Gold Package Quote</a>
                    <a
                        href="#"
                        class="button-primary"
                        data-contact-modal-trigger
                        data-contact-variant="vapt-quote"
                        data-contact-service="Platinum"
                    >Get Platinum Package Quote</a>
                </div>
            </div>
        </section>

        {{-- Case studies --}}
        <section class="section-block" aria-labelledby="vapt-cases-title">
            <div class="site-shell">
                <div class="section-heading">
                    <h2 id="vapt-cases-title">Case Studies</h2>
                </div>
                <div class="vapt-cases">
                    @foreach ($caseStudies as $case)
                        <a href="{{ route('case-studies.index') }}" class="vapt-case-card">
                            <div class="vapt-case-card__image">
                                <img
                                    src="{{ asset('images/vapt-case-studies/'.$case['image']) }}"
                                    alt="{{ $case['title'] }}"
                                    width="480"
                                    height="300"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <div class="vapt-case-card__body">
                                <h3>{{ $case['title'] }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="section-block section-block--tint" aria-labelledby="vapt-faq-title">
            <div class="site-shell">
                <div class="section-heading">
                    <h2 id="vapt-faq-title">Frequently Asked Questions</h2>
                </div>
                <div class="content-faq-list vapt-faq">
                    @foreach ($faqs as $index => $faq)
                        <details @if($index === 0) open @endif>
                            <summary>Q.{{ $index + 1 }} {{ $faq['q'] }}</summary>
                            <div>{{ $faq['a'] }}</div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Closing CTA --}}
        <section class="section-block">
            <div class="site-shell">
                <div class="vapt-cta-bar">
                    <div>
                        <h3>Protect Your Applications from Emerging Threats</h3>
                        <p>Our expert team conducts comprehensive Web &amp; Mobile Application Penetration Testing to identify vulnerabilities before attackers exploit them.</p>
                    </div>
                    <a href="#" class="button-primary" data-contact-modal-trigger>Request a Consultation</a>
                </div>
            </div>
        </section>
    </div>
@endsection
