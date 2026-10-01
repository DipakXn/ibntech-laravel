@php
    $img = fn (string $file): string => asset('images/aws-partner/'.$file);

    $heroStats = [
        [
            'value' => '99.9%',
            'label' => 'Uptime SLA',
            'svg' => '<path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99z"/>',
        ],
        [
            'value' => '25-40%',
            'label' => 'Cost Savings',
            'svg' => '<path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>',
        ],
        [
            'value' => '10+',
            'label' => 'AWS certifications',
            'svg' => '<path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>',
        ],
        [
            'value' => '24x7',
            'label' => 'NOC/SOC Monitoring',
            'svg' => '<path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>',
        ],
    ];

    $certifications = [
        ['file' => 'aws-solution-architect-professional.webp', 'alt' => 'AWS Solution Architect Professional'],
        ['file' => 'aws-solution-architech-associate.webp', 'alt' => 'AWS Solution Architect Associate'],
        ['file' => 'aws-cloud-practitioner-foundational.webp', 'alt' => 'AWS Cloud Practitioner Foundational'],
    ];

    $caseStudies = $caseStudies ?? app(\App\Repositories\CaseStudyRepository::class)->getPublishedByCategorySlug('aws', limit: 2, childOnly: true);

    $consultingServices = [
        [
            'icon' => 'fa-cloud-arrow-up',
            'title' => 'AWS Cloud Migration Services',
            'text' => 'Seamless transition to the cloud with proven migration strategies led by experts—ensuring minimal disruption, enhanced performance, and long-term operational excellence.',
            'points' => [],
        ],
        [
            'icon' => 'fa-gears',
            'title' => '24×7 Managed AWS Services',
            'text' => 'IBN Tech ensures uninterrupted cloud operations with proactive monitoring, automated optimization, and built-in security—powered by dedicated NOC/SOC teams.',
            'points' => [],
        ],
        [
            'icon' => 'fa-chart-column',
            'title' => 'AWS Cost Optimization & FinOps',
            'text' => 'Gain full visibility and control over your AWS spend with smart financial operations and real-time insights.',
            'points' => [
                'Track and manage costs via dynamic dashboards and rightsizing.',
                'Implement FinOps practices to boost transparency, accountability, and efficiency across teams.',
            ],
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Security & Compliance Management',
            'text' => 'Protect your cloud environment with end-to-end security aligned to global standards like GDPR, HIPAA, ISO 27001, and RBI/SEBI.',
            'points' => [
                '24×7 SOC operations for real-time threat detection and rapid response.',
                'Built-in compliance controls across all workloads.',
            ],
        ],
        [
            'icon' => 'fa-diagram-project',
            'title' => 'DevOps & Automation',
            'text' => 'Boost agility and reliability with AWS-native tools and intelligent automation.',
            'points' => [
                'Speed up delivery with CI/CD, IaC, and self-healing systems.',
                'Reduce manual effort through automated deployment and monitoring.',
            ],
        ],
    ];

    $whyChoose = [
        [
            'icon' => 'fa-clock',
            'title' => '24×7 AWS Management',
            'text' => 'Continuous support ensures uptime, stability, and fast issue resolution.',
        ],
        [
            'icon' => 'fa-certificate',
            'title' => 'AWS-Certified Engineers',
            'text' => 'Solutions built by certified experts following best practices.',
        ],
        [
            'icon' => 'fa-shuffle',
            'title' => 'Migration Expertise',
            'text' => 'Secure, disruption-free migration across diverse workloads.',
        ],
        [
            'icon' => 'fa-eye',
            'title' => 'Integrated SOC & NOC',
            'text' => 'Unified security and performance monitoring for full visibility and control.',
        ],
        [
            'icon' => 'fa-dollar-sign',
            'title' => 'Cost Optimization',
            'text' => 'FinOps-driven strategies to reduce AWS spending while maintaining performance.',
        ],
    ];

    $industries = [
        ['file' => 'IT-Business.webp', 'label' => 'IT Business'],
        ['file' => 'Retail.webp', 'label' => 'Retail'],
        ['file' => 'Healthcare.webp', 'label' => 'Pharma'],
        ['file' => 'Manufacturing.webp', 'label' => 'Manufacturing'],
        ['file' => 'Travel.webp', 'label' => 'Travel'],
    ];

    $testimonials = [
        [
            'quote' => 'IBN Technologies made our transition to AWS absolutely seamless. Their team carefully assessed our infrastructure and executed a smooth migration with zero downtime. We’ve seen a remarkable boost in performance and cost optimization since moving to AWS with IBN’s support.',
            'cite' => 'CTO, FinTech Company, Mumbai',
        ],
        [
            'quote' => 'The IBN Technologies AWS team is exceptional in managing our cloud environment. Their proactive monitoring, automation, and quick response times ensure our systems run efficiently around the clock. We finally have peace of mind knowing our AWS infrastructure is in expert hands.',
            'cite' => 'Head of IT, E-commerce Firm, Pune',
        ],
        [
            'quote' => 'What sets IBN Technologies apart is their commitment to customer success. Their AWS-certified engineers are always available and take ownership of every challenge. We consider them a true extension of our IT team.',
            'cite' => 'VP Operations, Manufacturing Firm, Delhi',
        ],
        [
            'quote' => 'IBN Technologies helped us design a scalable and secure AWS architecture that supports our rapid growth. Their cloud experts provided clear guidance, excellent implementation, and ongoing support. We couldn’t have asked for a better partner.',
            'cite' => 'Founder & CEO, SaaS Startup, Pune',
        ],
    ];

    $apartItems = [
        ['title' => '27+ Years of Experience:', 'text' => 'Proven IT and cloud transformation success'],
        ['title' => 'High Availability:', 'text' => 'Reliable, scalable cloud environments'],
        ['title' => 'Real-Time Monitoring:', 'text' => 'Proactive issue detection and resolution'],
        ['title' => 'Expert Remediation:', 'text' => 'Seamless performance across AWS workloads'],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/aws-partner.css'])
@endpush

@section('content')
    <div class="awsp-page">
        {{-- Hero --}}
        <section class="awsp-hero" aria-labelledby="awsp-hero-title">
            <div class="site-shell awsp-hero__inner">
                <div class="awsp-hero__copy">
                    <h1 id="awsp-hero-title">
                        <span class="awsp-hero__accent">AWS</span> Cloud Services
                    </h1>
                    <p class="awsp-hero__lede">
                        End-to-end AWS cloud services for top performance, low costs, and zero downtime.
                    </p>

                    <div class="awsp-hero__stats" role="list">
                        @foreach ($heroStats as $stat)
                            <article class="awsp-stat" role="listitem">
                                <span class="awsp-stat__icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" width="18" height="18" focusable="false">
                                        {!! $stat['svg'] !!}
                                    </svg>
                                </span>
                                <div class="awsp-stat__text">
                                    <strong>{{ $stat['value'] }}</strong>
                                    <span>{{ $stat['label'] }}</span>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="awsp-hero__actions">
                        <a href="#awsp-consult" class="awsp-btn awsp-btn--green">
                            Speak with an AWS Cloud Expert
                            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <div class="awsp-hero__media">
                    <img
                        src="{{ $img('AWS-Cloud-Partnership.webp') }}"
                        alt="AWS Cloud Partnership"
                        width="800"
                        height="800"
                        loading="eager"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Strategic Partnership --}}
        <section class="awsp-section" aria-labelledby="awsp-partnership-title">
            <div class="site-shell">
                <div class="awsp-heading">
                    <h2 id="awsp-partnership-title">
                        Our Strategic <span class="awsp-accent">Partnership</span>
                    </h2>
                </div>

                <div class="awsp-partnership">
                    <div class="awsp-partnership__copy">
                        <p>
                            IBN Technologies is excited to partner with AWS to deliver unique cloud solutions that support business success. We have worked extensively in areas of digital transformation and along with AWS that offers a strong cloud infrastructure, we are able to develop customized solutions to achieve our client's desired outcomes. This collaboration brings together innovation and agility, offering scalable, reliable, and cost-efficient strategies that help businesses adapt, grow, and lead in a rapidly evolving marketplace.
                        </p>
                    </div>
                    <div class="awsp-partnership__badge">
                        <img
                            src="{{ $img('aws-partner-advanced-tier-services.webp') }}"
                            alt="AWS Partner Advanced Tier Services"
                            width="420"
                            height="349"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Certifications --}}
        <section class="awsp-section awsp-section--mint" aria-labelledby="awsp-cert-title">
            <div class="site-shell">
                <div class="awsp-heading">
                    <h2 id="awsp-cert-title">
                        Our AWS <span class="awsp-accent">Certification</span>
                    </h2>
                </div>

                <div class="awsp-certs" role="list">
                    @foreach ($certifications as $cert)
                        <figure class="awsp-certs__item" role="listitem">
                            <img
                                src="{{ $img($cert['file']) }}"
                                alt="{{ $cert['alt'] }}"
                                width="220"
                                height="220"
                                loading="lazy"
                                decoding="async"
                            >
                        </figure>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Case Studies --}}
        @if ($caseStudies->isNotEmpty())
            <section class="awsp-section awsp-section--cream" aria-labelledby="awsp-cases-title">
                <div class="site-shell">
                    <div class="awsp-heading">
                        <h2 id="awsp-cases-title">Case Studies</h2>
                    </div>

                    <div class="awsp-cases" role="list">
                        @foreach ($caseStudies as $case)
                            <article class="awsp-case-card" role="listitem">
                                @php
                                    $caseImageUrl = $case->featuredImageUrl();
                                    if (! $caseImageUrl && $case->featured_image) {
                                        if (file_exists(public_path('images/aws-partner/' . $case->featured_image))) {
                                            $caseImageUrl = asset('images/aws-partner/' . $case->featured_image);
                                        } elseif (file_exists(public_path($case->featured_image))) {
                                            $caseImageUrl = asset($case->featured_image);
                                        }
                                    }
                                @endphp
                                @if ($caseImageUrl)
                                    <div class="awsp-case-card__media">
                                        <img
                                            src="{{ $caseImageUrl }}"
                                            alt="{{ $case->title }}"
                                            width="768"
                                            height="432"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    </div>
                                @endif
                                <div class="awsp-case-card__body">
                                    <h3>{{ $case->title }}</h3>
                                    <a href="{{ route('case-studies.show', $case->slug) }}" class="awsp-case-card__link">
                                        View Case Study »
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="awsp-cases__cta">
                        <a href="{{ route('case-studies.index') }}" class="awsp-btn awsp-btn--green">
                            Open More Case Studies →
                        </a>
                    </div>
                </div>
            </section>
        @endif

        {{-- Consulting Services --}}
        <section class="awsp-section awsp-section--cream awsp-section--tight-top" aria-labelledby="awsp-services-title">
            <div class="site-shell">
                <div class="awsp-heading">
                    <h2 id="awsp-services-title">
                        <span class="awsp-accent">AWS</span> Consulting Services
                    </h2>
                    <p>End-to-End Cloud Excellence. Zero Interruptions. Maximum Efficiency.</p>
                </div>

                <div class="awsp-services" role="list">
                    @foreach ($consultingServices as $service)
                        <article class="awsp-service-card" role="listitem">
                            <span class="awsp-service-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $service['icon'] }}"></i>
                            </span>
                            <h3>{{ $service['title'] }}</h3>
                            <p>{{ $service['text'] }}</p>
                            @if (! empty($service['points']))
                                <ul>
                                    @foreach ($service['points'] as $point)
                                        <li>
                                            <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                            <span>{{ $point }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="awsp-cta-banner" aria-labelledby="awsp-cta-title">
            <div class="site-shell awsp-cta-banner__inner">
                <h2 id="awsp-cta-title">Let's Build Your AWS Success Story</h2>
                <p>Partner with IBN Tech to design a cloud strategy that delivers performance, security, and cost-efficiency.</p>
                <a href="#awsp-consult" class="awsp-btn awsp-btn--light">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    Schedule a Free Strategy Session Today
                </a>
            </div>
        </section>

        {{-- Why Enterprises Choose --}}
        <section class="awsp-section awsp-section--soft" aria-labelledby="awsp-why-title">
            <div class="site-shell">
                <div class="awsp-heading">
                    <h2 id="awsp-why-title">
                        Why Enterprises Choose <span class="awsp-accent">IBN Tech for AWS</span>
                    </h2>
                    <p>IBN Tech is a trusted AWS partner, delivering enterprise-grade solutions with measurable impact:</p>
                </div>

                <div class="awsp-why" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="awsp-why-card" role="listitem">
                            <span class="awsp-why-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Operations Framework --}}
        <section class="awsp-section" aria-labelledby="awsp-framework-title">
            <div class="site-shell">
                <div class="awsp-heading">
                    <h2 id="awsp-framework-title">
                        From Visibility to Value: <span class="awsp-accent">The AWS Operations Framework</span>
                    </h2>
                </div>

                <div class="awsp-framework">
                    <img
                        src="{{ $img('AWS-Partner-From-Visibility-to-Value.webp') }}"
                        alt="AWS Partner From Visibility to Value operations framework: Monitor, Manage, Secure, Optimize"
                        width="944"
                        height="367"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Industry Network --}}
        <section class="awsp-section awsp-section--soft" aria-labelledby="awsp-industry-title">
            <div class="site-shell awsp-industry">
                <div class="awsp-industry__copy">
                    <h2 id="awsp-industry-title">Our Industry Network</h2>
                    <p>
                        From IT to Retail, Pharma to Manufacturing, and even Travel- we deliver customized solutions that fit your unique needs. No matter your industry, we help you operate smarter, faster, and more efficiently.
                    </p>
                    <p>
                        Don’t see your sector? We’re ready to craft solutions just for you because your business deserves more than one-size-fits-all.
                    </p>
                </div>

                <div class="awsp-industry__grid" role="list">
                    @foreach ($industries as $industry)
                        <article class="awsp-industry-card" role="listitem">
                            <img
                                src="{{ $img($industry['file']) }}"
                                alt="{{ $industry['label'] }}"
                                width="75"
                                height="75"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $industry['label'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="awsp-section awsp-section--soft" aria-labelledby="awsp-testimonials-title">
            <div class="site-shell">
                <div class="awsp-heading">
                    <h2 id="awsp-testimonials-title">Customer Testimonials</h2>
                    <p>Trusted by industry leaders</p>
                </div>

                <div
                    class="awsp-testimonials"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; },
                        go(i) { this.index = i; }
                    }"
                >
                    <button type="button" class="awsp-testimonials__nav awsp-testimonials__nav--prev" @click="prev()" aria-label="Previous testimonial">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="awsp-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="awsp-testimonial{{ $i === 0 ? ' is-active' : '' }}"
                                :class="{ 'is-active': index === {{ $i }} }"
                                :aria-hidden="index !== {{ $i }}"
                            >
                                <p>{{ $item['quote'] }}</p>
                                <footer>
                                    <img
                                        src="{{ $img('user-icon.webp') }}"
                                        alt=""
                                        width="48"
                                        height="48"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                    <cite>{{ $item['cite'] }}</cite>
                                </footer>
                            </blockquote>
                        @endforeach
                    </div>

                    <button type="button" class="awsp-testimonials__nav awsp-testimonials__nav--next" @click="next()" aria-label="Next testimonial">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>

                    <div class="awsp-testimonials__dots" role="tablist" aria-label="Testimonial slides">
                        @foreach ($testimonials as $i => $item)
                            <button
                                type="button"
                                class="awsp-testimonials__dot"
                                :class="{ 'is-active': index === {{ $i }} }"
                                @click="go({{ $i }})"
                                aria-label="Show testimonial {{ $i + 1 }}"
                            ></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- What Sets IBN Apart + form --}}
        <section class="awsp-section" id="awsp-consult" aria-labelledby="awsp-apart-title">
            <div class="site-shell awsp-consult">
                <div class="awsp-consult__copy">
                    <h2 id="awsp-apart-title">What Sets IBN Apart in AWS Cloud Services</h2>
                    <p class="awsp-consult__lede">
                        Comprehensive AWS Expertise: Strategy, migration, management, security &amp; optimization
                    </p>

                    <ul class="awsp-apart-list">
                        @foreach ($apartItems as $item)
                            <li>
                                <span class="awsp-apart-list__icon" aria-hidden="true">
                                    <i class="fa-solid fa-circle-check"></i>
                                </span>
                                <span>
                                    <strong>{{ $item['title'] }}</strong> {{ $item['text'] }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="awsp-consult__card" aria-labelledby="awsp-form-title">
                    <h3 id="awsp-form-title">Looking to partner for AWS cloud success?</h3>
                    <p>Share your AWS requirements and let our certified experts craft a tailored strategy that aligns with your business goals.</p>

                    <livewire:forms.contact-form
                        form-name="aws-partner"
                        id-prefix="awsp"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your AWS needs and let’s explore a strategic partnership"
                        submit-label="BOOK FREE CONSULTATION"
                        layout="home"
                        thank-you-url="/thanks-you-for-cloud/"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
