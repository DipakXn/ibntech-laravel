@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/services.css'])
@endpush

@section('content')
    <section class="inner-hero">
        <div class="site-shell inner-hero__inner">
            <p class="inner-hero__eyebrow">Capabilities</p>
            <h1>{{ $page->title }}</h1>
            <p class="inner-hero__lede">
                Migration planning, Laravel implementation, content operations, and admin systems built for modern marketing teams.
            </p>
            <div class="inner-hero__actions">
                <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="button-primary">Request a Proposal</a>
                <a href="{{ route('ebooks.index') }}" class="button-secondary">View Resources</a>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell">
            <div class="feature-grid">
                <article class="card-panel">
                    <p class="meta-chip">Service 01</p>
                    <h3>Migration Strategy</h3>
                    <p>Content model mapping, URL strategy, redirect plans, and SEO-safe migration sequencing.</p>
                </article>
                <article class="card-panel">
                    <p class="meta-chip">Service 02</p>
                    <h3>Blade UI Engineering</h3>
                    <p>Reusable sections, maintainable templates, and cohesive visual systems without brittle page builders.</p>
                </article>
                <article class="card-panel">
                    <p class="meta-chip">Service 03</p>
                    <h3>CMS Operations</h3>
                    <p>Filament-based workflows for pages, blogs, case studies, press releases, eBooks, and metadata governance.</p>
                </article>
                <article class="card-panel">
                    <p class="meta-chip">Service 04</p>
                    <h3>Lead Capture Systems</h3>
                    <p>Livewire forms, conversion pathways, and admin visibility for inquiry and download funnels.</p>
                </article>
                <article class="card-panel">
                    <p class="meta-chip">Service 05</p>
                    <h3>SEO Enablement</h3>
                    <p>Structured metadata, canonical handling, and content publishing standards for search resilience.</p>
                </article>
                <article class="card-panel">
                    <p class="meta-chip">Service 06</p>
                    <h3>Performance Readiness</h3>
                    <p>Cache-aware repositories, deploy-friendly architecture, and a cleaner long-term operating model.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell split-grid">
            <div class="section-surface section-pad">
                <p class="meta-chip">How We Work</p>
                <h2 class="article-title">A structured delivery path from audit to launch.</h2>
                <div class="article-excerpt">
                    We begin with content and template discovery, move into route and metadata planning,
                    then rebuild reusable sections and editing workflows in Laravel.
                </div>
            </div>
            <div class="stack-list">
                <article>
                    <h3>Discover</h3>
                    <p>Audit URLs, templates, forms, taxonomies, and content dependencies.</p>
                </article>
                <article>
                    <h3>Rebuild</h3>
                    <p>Implement explicit Blade templates, component sections, and cleaner admin flows.</p>
                </article>
                <article>
                    <h3>Stabilize</h3>
                    <p>Validate SEO signals, content ownership, and long-term operating processes.</p>
                </article>
            </div>
        </div>
    </section>
@endsection
