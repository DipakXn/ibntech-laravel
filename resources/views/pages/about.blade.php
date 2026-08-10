@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/about.css'])
@endpush

@section('content')
    <section class="inner-hero">
        <div class="site-shell inner-hero__inner">
            <p class="inner-hero__eyebrow">Company</p>
            <h1>{{ $page->title }}</h1>
            <p class="inner-hero__lede">
                We build maintainable delivery systems for growth-focused businesses that need clear execution,
                structured publishing, and dependable operations.
            </p>
            <div class="inner-hero__actions">
                <a href="{{ route('page.show', ['slug' => 'contact']) }}" class="button-primary">Talk to Our Team</a>
                <a href="{{ route('case-studies.index') }}" class="button-secondary">See Delivery Proof</a>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell split-grid">
            <div class="section-surface section-pad">
                <p class="meta-chip">What We Build</p>
                <h2 class="article-title">Operational clarity across templates, workflows, and delivery teams.</h2>
                <p class="article-excerpt">
                    This demo reflects a practical WordPress-to-Laravel migration pattern: templates are explicit Blade files,
                    sections are reusable components, and business logic stays isolated inside services and repositories.
                </p>
            </div>
            <div class="stack-list">
                <article>
                    <h3>Architecture first</h3>
                    <p>Reusable Blade sections, predictable routes, and structured admin resources keep large sites stable.</p>
                </article>
                <article>
                    <h3>Editorial discipline</h3>
                    <p>Pages, blogs, case studies, press releases, and eBooks follow clear patterns so content teams can work without guesswork.</p>
                </article>
                <article>
                    <h3>SEO-safe operations</h3>
                    <p>Metadata is managed per record, making handoff between marketing and engineering more reliable.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell">
            <div class="feature-grid">
                <article class="card-panel">
                    <p class="meta-chip">01</p>
                    <h3>Migration Strategy</h3>
                    <p>URL planning, content mapping, template audits, and launch sequencing.</p>
                </article>
                <article class="card-panel">
                    <p class="meta-chip">02</p>
                    <h3>Engineering Delivery</h3>
                    <p>Thin controllers, service layers, and Filament resources designed for long-term maintainability.</p>
                </article>
                <article class="card-panel">
                    <p class="meta-chip">03</p>
                    <h3>Operational Support</h3>
                    <p>Lead capture, publishing workflows, and reusable page systems for commercial teams.</p>
                </article>
            </div>
        </div>
    </section>
@endsection
