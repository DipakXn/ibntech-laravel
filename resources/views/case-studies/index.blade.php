@extends('layouts.app')

@section('content')
    <section class="inner-hero">
        <div class="site-shell inner-hero__inner">
            <p class="inner-hero__eyebrow">Case Studies</p>
            <h1>Proof of delivery, not brochure copy.</h1>
            <p class="inner-hero__lede">
                Migration outcomes, implementation decisions, and platform changes that produced measurable delivery improvements.
            </p>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell">
            <div class="listing-grid">
                @forelse($caseStudies as $caseStudy)
                    <article class="card-panel case-study-card">
                        @if($caseStudy->featuredImageUrl())
                            <a href="{{ route('case-studies.show', $caseStudy->slug) }}" class="case-study-card__image">
                                <img src="{{ $caseStudy->featuredImageUrl() }}" alt="{{ $caseStudy->title }}">
                            </a>
                        @endif
                        <p class="meta-chip">Case Study</p>
                        <h3><a href="{{ route('case-studies.show', $caseStudy->slug) }}">{{ $caseStudy->title }}</a></h3>
                        <p style="margin-top: 0.8rem;">{{ $caseStudy->excerpt ?: \App\Support\BlockContent::summary($caseStudy->content) }}</p>
                    </article>
                @empty
                    <p class="card-panel" style="grid-column: 1 / -1;">No published case studies found.</p>
                @endforelse
            </div>

            <div style="margin-top: 2rem;">
                {{ $caseStudies->links() }}
            </div>
        </div>
    </section>
@endsection
