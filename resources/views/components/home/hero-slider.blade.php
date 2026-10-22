@php
    $slides = [
        [
            'badge' => 'Unparalleled Digital Solutions for a Connected World',
            'title' => 'Setting the Standard for <span>Cybersecurity Excellence</span>',
            'tags' => 'Risk Assessment • Threat Detection • Compliance • Zero Trust • SOC',
            'description' => '24/7 Managed Cybersecurity: Anytime, Anywhere Protection for Your Digital Assets-Uniting Performance, Protection, and Leadership',
            'image' => 'images/cyber-security-hero-banner.webp',
            'alt' => 'Cybersecurity excellence hero banner',
            'scroll_target' => 'home-form',
        ],
        [
            'badge' => 'Accelerate Innovation with Cloud-First Agility',
            'title' => 'Cloud Services: Migration to Modernization, <span>With You at Every Step</span>',
            'tags' => 'Migration • Management • FinOps • DevSecOps • Kubernetes',
            'description' => 'We deliver scalable cloud solutions customized to your business goals. Experience agility, security,and performance powered by partnership.',
            'image' => 'images/cloud-services-hero-banner.webp',
            'alt' => 'Cloud services hero banner',
            'scroll_target' => 'home-form',
        ],
        [
            'badge' => 'Automate Intelligently, Operate Effortlessly',
            'title' => 'Robotic Process Automation for <span>Smarter Workflows</span>',
            'tags' => 'Automation • Integration • Efficiency • Accuracy • Scalability',
            'description' => 'Deploy intelligent automation with cognitive RPA and advanced analytics for real-time making. Streamline invoice management, align sales orders, and accelerate workflows for faster, accurate payment processing.',
            'image' => 'images/robotic-process-automation-hero-banner.webp',
            'alt' => 'Robotic process automation hero banner',
            'scroll_target' => 'home-form',
        ],
        [
            'badge' => 'Expert Accounting, Delivered Remotely',
            'title' => 'Lead with Confidence in <span>Outsource Accounting and Bookkeeping Services</span>',
            'tags' => 'Accounting • Bookkeeping • Compliance • Reporting • Insights',
            'description' => 'Global leader in remote bookkeeping and accounting, delivering 100% accuracy, efficiency, and growth focused.',
            'image' => 'images/accounting-and-Bookkeeping-hero-banner.webp',
            'alt' => 'Accounting and bookkeeping hero banner',
            'scroll_target' => 'home-form',
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
                @if($index !== 0) aria-hidden="true" inert @endif
            >
                <div class="home-hero__media">
                    @php
                        $imageUrl = asset($slide['image']);
                        $imageSrcset = asset(preg_replace('/\.webp$/', '-800.webp', $slide['image'])).' 800w, '.$imageUrl.' 1400w';
                    @endphp
                    <img
                        @if ($index === 0)
                            src="{{ $imageUrl }}"
                            srcset="{{ $imageSrcset }}"
                            sizes="100vw"
                            fetchpriority="high"
                        @else
                            data-src="{{ $imageUrl }}"
                            data-srcset="{{ $imageSrcset }}"
                            data-sizes="100vw"
                            loading="lazy"
                            decoding="async"
                        @endif
                        alt="{{ $slide['alt'] }}"
                        width="1400"
                        height="700"
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
                            <a href="javascript:void(0)" class="home-btn home-btn--green" data-scroll-target="{{ $slide['scroll_target'] }}">
                                Contact Our Expert
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="home-hero__controls">
        <button type="button" class="home-hero__arrow" data-home-hero-prev aria-label="Previous slide">
            <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
        </button>

        <div class="home-hero__dots" role="group" aria-label="Choose slide">
            @foreach ($slides as $index => $slide)
                <button
                    type="button"
                    class="home-hero__dot{{ $index === 0 ? ' is-active' : '' }}"
                    data-home-hero-dot
                    aria-label="Go to slide {{ $index + 1 }}: {{ $slide['badge'] }}"
                    @if($index === 0) aria-current="true" @endif
                ></button>
            @endforeach
        </div>

        <button type="button" class="home-hero__arrow" data-home-hero-next aria-label="Next slide">
            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        </button>
    </div>
</section>
