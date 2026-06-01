@props(['latestPosts', 'search' => ''])

<aside class="blog-sidebar">
    <form class="blog-search" action="{{ route('blog.index') }}" method="GET">
        <label class="sr-only" for="blog-search">Search blog posts</label>
        <input id="blog-search" name="q" value="{{ $search }}" type="search" placeholder="Type to start searching...">
        <button type="submit">
            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
            Search
        </button>
    </form>

    <section class="blog-sidebar-panel">
        <h2>Latest Blog Posts</h2>
        <div class="blog-latest-list">
            @foreach($latestPosts as $post)
                <a class="blog-latest-card" href="{{ route('blog.show', $post->slug) }}">
                    @include('blog.partials.image', ['post' => $post])
                    <span>{{ $post->title }}</span>
                </a>
            @endforeach
        </div>
    </section>
</aside>
