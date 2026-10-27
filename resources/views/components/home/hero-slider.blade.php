<section class="home-hero" aria-labelledby="home-hero-title">
    <div class="home-hero__media">
        <img
            src="{{ asset('images/Futuristic-Cybersecurity-Shield-Network.webp') }}"
            alt=""
            width="1983"
            height="793"
            fetchpriority="high"
        >
    </div>

    <div class="home-hero__layout">
        <div class="home-shell">
            <div class="home-hero__copy">
                <div class="home-hero__badge">
                    <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
                    Unparalleled Digital Solutions for a Connected World
                </div>
                <h1 id="home-hero-title">Setting the Standard for <span>Cybersecurity Excellence</span></h1>
                <p class="home-hero__tags">
                    @foreach (['Risk Assessment', 'Threat Detection', 'Compliance', 'Zero Trust', 'SOC'] as $tag)
                        <span>{{ $tag }}</span>
                    @endforeach
                </p>
                <p class="home-hero__description">24/7 Managed Cybersecurity: Anytime, Anywhere Protection for Your Digital Assets-Uniting Performance, Protection, and Leadership</p>
                <div class="home-hero__actions">
                    <a href="javascript:void(0)" class="home-btn home-btn--green" data-scroll-target="home-form">
                        Contact Our Expert
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>

        <x-home.core-strengths />
    </div>
</section>
