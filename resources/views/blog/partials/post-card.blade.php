@props(['post'])

<article class="blog-post-card">
    <a class="blog-post-card__image" href="{{ route('blog.show', $post->slug) }}" aria-label="{{ $post->title }}">
        @include('blog.partials.image', ['post' => $post])
    </a>
    <div class="blog-post-card__body">
        <p class="blog-post-card__category">{{ $post->category?->name ?? 'General' }}</p>
        <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
    </div>
</article>
