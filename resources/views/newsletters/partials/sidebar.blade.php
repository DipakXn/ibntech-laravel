<aside class="newsletter-sidebar">
    <section class="newsletter-inquiry">
        <h2>Start with Us Today!</h2>
        <livewire:forms.newsletter-inquiry-form :wire:key="'newsletter-inquiry-'.$newsletter->slug" />
    </section>

    <section class="newsletter-latest">
        <h2>Explore Latest Newsletters</h2>
        <div class="newsletter-latest__list">
            @forelse($latestNewsletters as $latestNewsletter)
                <a href="{{ $latestNewsletter->publicUrl() }}" class="newsletter-latest__item">
                    @if($latestNewsletter->featuredImageUrl())
                        <img src="{{ $latestNewsletter->featuredImageUrl() }}" alt="{{ $latestNewsletter->title }}">
                    @else
                        <div class="blog-image-placeholder newsletter-latest__placeholder">
                            <span>Newsletter</span>
                        </div>
                    @endif
                    <span>{{ $latestNewsletter->title }}</span>
                </a>
            @empty
                <p class="blog-sidebar-empty">No newsletters available.</p>
            @endforelse
        </div>
    </section>
</aside>
