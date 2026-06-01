@extends('layouts.app')

@section('title', $industry->title)

@section('content')
    <section class="inner-hero">
        <div class="site-shell inner-hero__inner">
            <p class="inner-hero__eyebrow">Industry</p>
            <h1>{{ $industry->title }}</h1>
            @if($industry->featuredImageUrl())
                <div class="article-detail__hero" style="margin: 1.5rem 0 0;">
                    <img src="{{ $industry->featuredImageUrl() }}" alt="{{ $industry->title }}">
                </div>
            @endif
            <p class="inner-hero__lede">
                Dummy placeholder copy for the real estate and construction industry page. Replace this with your
                actual positioning, delivery strengths, and service messaging later.
            </p>
            <div class="inner-hero__actions">
                <a href="{{ route('page.show', ['slug' => 'contact']) }}" class="button-primary">Talk to Our Team</a>
                <a href="{{ route('case-studies.index') }}" class="button-secondary">View Case Studies</a>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell split-grid">
            <div class="section-surface section-pad">
                <p class="meta-chip">Overview</p>
                <h2 class="article-title">Short summary content block for this industry landing page.</h2>
                <p class="article-excerpt">
                    Use this section for a concise introduction about your real estate and construction solutions,
                    typical client challenges, and the value your team delivers across ongoing operations.
                </p>
            </div>
            <div class="stack-list">
                <article>
                    <h3>Operational Support</h3>
                    <p>Dummy text for accounting, reporting, project tracking, or back-office support services.</p>
                </article>
                <article>
                    <h3>Scalable Delivery</h3>
                    <p>Placeholder content for teams that need flexible support across multiple sites or entities.</p>
                </article>
                <article>
                    <h3>Process Visibility</h3>
                    <p>Short sample copy describing control, consistency, and better turnaround across workflows.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell">
            <div class="feature-grid">
                <article class="card-panel">
                    <p class="meta-chip">01</p>
                    <h3>Service Area One</h3>
                    <p>Replace this with a short explanation of a primary solution for this industry.</p>
                </article>
                <article class="card-panel">
                    <p class="meta-chip">02</p>
                    <h3>Service Area Two</h3>
                    <p>Use this card for another offer, capability, or engagement model relevant to the page.</p>
                </article>
                <article class="card-panel">
                    <p class="meta-chip">03</p>
                    <h3>Service Area Three</h3>
                    <p>Keep this as placeholder copy now, then swap in real messaging when content is ready.</p>
                </article>
            </div>
        </div>
    </section>
@endsection
