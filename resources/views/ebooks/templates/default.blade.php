@extends('layouts.app')

@section('content')
    <article class="article-shell">
        <div class="site-shell">
            <div class="article-frame">
                <section class="case-study-detail__intro">
                    <div class="case-study-detail__intro-copy">
                        <a href="{{ route('ebooks.index') }}" class="article-back">&larr; Back to eBooks</a>
                        <p class="meta-chip" style="margin-top: 1rem;">eBook</p>
                        <h1 class="article-title">{{ $ebook->title }}</h1>
                        @if($ebook->excerpt)
                            <p class="article-excerpt">{{ $ebook->excerpt }}</p>
                        @endif
                    </div>
                    @if($ebook->featuredImageUrl())
                        <div class="case-study-detail__hero">
                            <img src="{{ $ebook->featuredImageUrl() }}" alt="{{ $ebook->title }}">
                        </div>
                    @endif
                </section>

                <section class="case-study-detail__body">
                    <div class="case-study-detail__content">
                        <x-content-blocks :blocks="$ebook->content" :model="$ebook" class="article-body" />
                    </div>

                    @if($ebook->downloadPdfUrl())
                        <aside class="case-study-detail__download">
                            <livewire:forms.ebook-download-form
                                :ebook-slug="$ebook->slug"
                                :ebook-title="$ebook->title"
                                :key="'ebook-detail-download-'.$ebook->id"
                            />
                        </aside>
                    @endif
                </section>
            </div>
        </div>
    </article>
@endsection
