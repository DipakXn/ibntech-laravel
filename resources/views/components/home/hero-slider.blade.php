@php
    $slides = [
        [
            'badge' => 'Unparalleled Digital Solutions for a Connected World',
            'title' => 'Setting the Standard for <span>Cybersecurity Excellence</span>',
            'tags' => 'Risk Assessment • Threat Detection • Compliance • Zero Trust • SOC',
            'description' => '24/7 Managed Cybersecurity: Anytime, Anywhere Protection for Your Digital Assets-Uniting Performance, Protection, and Leadership',
            'image' => asset('images/cyber-security-hero-banner.webp'),
            'alt' => 'Cybersecurity excellence hero banner',
        ],
        [
            'badge' => 'Accelerate Innovation with Cloud-First Agility',
            'title' => 'Cloud Services: Migration to Modernization, <span>With You at Every Step</span>',
            'tags' => 'Migration • Management • FinOps • DevSecOps • Kubernetes',
            'description' => 'We deliver scalable cloud solutions customized to your business goals. Experience agility, security,and performance powered by partnership.',
            'image' => asset('images/cloud-services-hero-banner.webp'),
            'alt' => 'Cloud services hero banner',
        ],
        [
            'badge' => 'Automate Intelligently, Operate Effortlessly',
            'title' => 'Robotic Process Automation for <span>Smarter Workflows</span>',
            'tags' => 'Automation • Integration • Efficiency • Accuracy • Scalability',
            'description' => 'Deploy intelligent automation with cognitive RPA and advanced analytics for real-time making. Streamline invoice management, align sales orders, and accelerate workflows for faster, accurate payment processing.',
            'image' => asset('images/robotic-process-automation-hero-banner.webp'),
            'alt' => 'Robotic process automation hero banner',
        ],
        [
            'badge' => 'Expert Accounting, Delivered Remotely',
            'title' => 'Lead with Confidence in <span>Outsource Accounting and Bookkeeping Services</span>',
            'tags' => 'Accounting • Bookkeeping • Compliance • Reporting • Insights',
            'description' => 'Global leader in remote bookkeeping and accounting, delivering 100% accuracy, efficiency, and growth focused.',
            'image' => asset('images/accounting-and-Bookkeeping-hero-banner.webp'),
            'alt' => 'Accounting and bookkeeping hero banner',
        ],
    ];
@endphp

<section class="home-hero" aria-roledescription="carousel" aria-label="IBN Technologies capabilities" data-home-hero>
    <div class="home-hero__viewport">
        @foreach ($slides as $index => $slide)
            <div
                class="home-hero__slide {{ $index === 0 ? 'is-active' : '' }}"
                data-home-hero-slide
                role="group"
                aria-roledescription="slide"
                aria-label="Slide {{ $index + 1 }} of {{ count($slides) }}"
                @if($index !== 0) aria-hidden="true" @endif
            >
                <div class="home-hero__media">
                    <img
                        src="{{ $slide['image'] }}"
                        alt="{{ $slide['alt'] }}"
                        width="1920"
                        height="900"
                        @if($index === 0) fetchpriority="high" @else loading="lazy" @endif
                        decoding="async"
                    >
                </div>
                <div class="home-hero__content">
                    <div class="home-shell">
                        <div class="home-hero__badge">
                            <i class="fa-solid fa-medal" aria-hidden="true"></i>
                            {{ $slide['badge'] }}
                        </div>
                        @if ($index === 0)
                            <h1>{!! $slide['title'] !!}</h1>
                        @else
                            <h2>{!! $slide['title'] !!}</h2>
                        @endif
                        <p class="home-hero__tags">{{ $slide['tags'] }}</p>
                        <p class="home-hero__description">{{ $slide['description'] }}</p>
                        <div class="home-hero__actions">
                            <a href="#" class="home-btn home-btn--green" data-contact-modal-trigger>
                                Contact Our Expert
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
