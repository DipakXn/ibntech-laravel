@extends('layouts.app')

@section('content')
    <section class="inner-hero">
        <div class="site-shell inner-hero__inner">
            <p class="inner-hero__eyebrow">Vision</p>
            <h1>{{ $page->title }}</h1>
            <p class="inner-hero__lede">
                A long-term direction shaped around disciplined delivery, sustainable systems, and clearer digital operations.
            </p>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell split-grid">
            <div class="section-surface section-pad">
                <p class="meta-chip">Vision Statement</p>
                <h2 class="article-title">Build business systems that stay dependable after launch.</h2>
                <p class="article-excerpt">
                    Our goal is not just to redesign pages. We aim to create operating systems for content,
                    publishing, and growth that remain understandable to both editors and engineers.
                </p>
            </div>
            <div class="stack-list">
                <article>
                    <h3>Clarity</h3>
                    <p>Every template, content type, and admin workflow should be explicit and easy to reason about.</p>
                </article>
                <article>
                    <h3>Durability</h3>
                    <p>Architecture decisions should reduce future maintenance rather than create hidden complexity.</p>
                </article>
                <article>
                    <h3>Shared Ownership</h3>
                    <p>Marketing, operations, and engineering should work from one coherent publishing model.</p>
                </article>
            </div>
        </div>
    </section>
@endsection
