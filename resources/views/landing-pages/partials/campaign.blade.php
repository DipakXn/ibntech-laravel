<section class="inner-hero">
    <div class="site-shell inner-hero__inner">
        <p class="inner-hero__eyebrow">Landing Page</p>
        <h1>{{ $landingPage->title }}</h1>
        <p class="inner-hero__lede">
            Placeholder copy for this campaign landing page. Replace this later with campaign-specific
            messaging, offers, trust elements, and conversion-focused copy.
        </p>
    </div>
</section>

<section class="section-block">
    <div class="site-shell split-grid">
        <div class="section-surface section-pad">
            <p class="meta-chip">Summary</p>
            <h2 class="article-title">Short placeholder content block for a focused conversion page.</h2>
            <p class="article-excerpt">
                Use this section to explain the core service, the target audience, and the immediate business value.
                Keep the message specific to the campaign or offer behind this landing page.
            </p>
        </div>
        <div class="form-card">
            <p class="meta-chip">Schedule A Free Consultation!</p>
            <livewire:forms.landing-inquiry-form
                :landing-page-slug="$landingPage->slug"
                :landing-page-title="$landingPage->title"
                :id-prefix="'lp-'.$landingPage->slug"
                :wire:key="'landing-inquiry-'.$landingPage->slug"
            />
        </div>
    </div>
</section>
