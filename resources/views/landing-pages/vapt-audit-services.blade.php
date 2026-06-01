@extends('layouts.app')

@section('title', $landingPage->title)

@section('content')
    <section class="inner-hero">
        <div class="site-shell inner-hero__inner">
            <p class="inner-hero__eyebrow">Landing Page</p>
            <h1>{{ $landingPage->title }}</h1>
            <p class="inner-hero__lede">
                Placeholder copy for the VAPT audit services landing page. Replace this later with campaign-specific
                messaging, offers, trust elements, and conversion-focused copy.
            </p>
            <div class="inner-hero__actions">
                <a href="{{ route('page.show', ['slug' => 'contact']) }}" class="button-primary">Request a Consultation</a>
                <a href="{{ route('page.show', ['slug' => 'about']) }}" class="button-secondary">Learn About Us</a>
            </div>
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
            <div class="stack-list">
                <article>
                    <h3>Clear Scope</h3>
                    <p>Dummy copy describing the scope of the assessment, review, or implementation effort.</p>
                </article>
                <article>
                    <h3>Fast Turnaround</h3>
                    <p>Placeholder text for service timelines, delivery responsiveness, or reporting speed.</p>
                </article>
                <article>
                    <h3>Actionable Output</h3>
                    <p>Use this space for the final value statement and outcome-focused summary.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell">
            <div class="feature-grid">
                <article class="card-panel">
                    <p class="meta-chip">01</p>
                    <h3>Offer Highlight</h3>
                    <p>Replace this with a short description of the first offer or conversion angle.</p>
                </article>
                <article class="card-panel">
                    <p class="meta-chip">02</p>
                    <h3>Trust Point</h3>
                    <p>Use this card for certifications, experience, process depth, or compliance alignment.</p>
                </article>
                <article class="card-panel">
                    <p class="meta-chip">03</p>
                    <h3>Call to Action</h3>
                    <p>Keep this as temporary text now, then switch it to your campaign CTA or next-step content.</p>
                </article>
            </div>
        </div>
    </section>
@endsection
