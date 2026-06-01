@extends('layouts.app')

@section('content')
    <article class="article-shell">
        <div class="site-shell">
            <div class="article-frame">
                <section class="case-study-detail__intro">
                    <div class="case-study-detail__intro-copy">
                        <a href="{{ route('case-studies.index') }}" class="article-back">&larr; Back to Case Studies</a>
                        <p class="meta-chip" style="margin-top: 1rem;">Case Study</p>
                        <h1 class="article-title">{{ $caseStudy->title }}</h1>
                        @if($caseStudy->excerpt)
                            <p class="article-excerpt">{{ $caseStudy->excerpt }}</p>
                        @endif
                    </div>
                    @if($caseStudy->featuredImageUrl())
                        <div class="case-study-detail__hero">
                            <img src="{{ $caseStudy->featuredImageUrl() }}" alt="{{ $caseStudy->title }}">
                        </div>
                    @endif
                </section>

                <section class="case-study-detail__body">
                    <div class="case-study-detail__content">
                        <x-content-blocks :blocks="$caseStudy->content" :model="$caseStudy" class="article-body" />
                    </div>

                    @if($caseStudy->downloadPdfUrl())
                        <aside class="case-study-detail__download">
                            <livewire:forms.case-study-download-form
                                :case-study-slug="$caseStudy->slug"
                                :case-study-title="$caseStudy->title"
                                :key="'case-study-detail-download-'.$caseStudy->id"
                            />
                        </aside>
                    @endif
                </section>
            </div>
        </div>
    </article>
@endsection
