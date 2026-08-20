@php
    $partners = [
        ['file' => 'aws-partner-advanced-tier.webp', 'label' => 'AWS Partner'],
        ['file' => 'MS-Gold-Partner.webp', 'label' => 'Microsoft Gold'],
        ['file' => 'DSCI-logo.webp', 'label' => 'DSCI Member'],
    ];
@endphp

<section class="home-section" aria-labelledby="home-partners-title">
    <div class="home-shell">
        <h2 id="home-partners-title" class="home-section-title home-partners__title">
            <span class="mark">Partnering</span> <span class="with">with</span> <span class="accent">Industry Leaders</span>
        </h2>
        <p class="home-section-lead mx-auto max-w-3xl text-center">
            We work with trusted partners worldwide to deliver robust, secure, and high-performing digital experiences.
        </p>

        <div class="home-partners__grid">
            @foreach ($partners as $partner)
                <article class="home-card home-partner-card">
                    <img
                        src="{{ asset('images/partners/'.$partner['file']) }}"
                        alt="{{ $partner['label'] }}"
                        width="220"
                        height="90"
                        loading="lazy"
                        decoding="async"
                    >
                    <span>{{ $partner['label'] }}</span>
                </article>
            @endforeach
        </div>
    </div>
</section>
