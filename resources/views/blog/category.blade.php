@extends('layouts.app')

@section('content')
    <section class="blog-hero">
        <div class="site-shell blog-hero__inner">
            <h1>{{ $category->name }}</h1>
        </div>
    </section>

    <section class="blog-page blog-page--category">
        <div class="site-shell">
            <nav class="blog-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a> <span>&raquo;</span> <span>{{ $category->name }}</span>
            </nav>

            <div class="blog-post-grid">
                @forelse($blogs as $blog)
                    @include('blog.partials.post-card', ['post' => $blog])
                @empty
                    <p class="blog-empty">No blog posts are available in this category yet.</p>
                @endforelse
            </div>

            <div class="blog-pagination">{{ $blogs->links() }}</div>
        </div>
    </section>
@endsection
