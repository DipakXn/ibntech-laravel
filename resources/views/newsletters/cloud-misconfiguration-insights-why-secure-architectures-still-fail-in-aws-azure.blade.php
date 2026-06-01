@extends('layouts.app')

@section('title', $newsletter->title)

@section('content')
    <article class="newsletter-detail">
        <div class="site-shell newsletter-detail__layout">
            <div class="newsletter-detail__main">
                <div class="newsletter-detail__intro">
                    <p>
                        Cloud platforms such as AWS and Azure provide robust, secure-by-design infrastructure.
                    </p>
                    <p>
                        However, most real-world incidents are not caused by platform weaknesses but by
                        misconfigurations in identity, storage, and network controls. The challenge is not lack of
                        capability, it is consistent implementation at scale.
                    </p>
                </div>

                <section class="newsletter-section">
                    <header class="newsletter-section__header">
                        <span class="newsletter-section__accent" aria-hidden="true"></span>
                        <div>
                            <h2>Recent Real-World Signals</h2>
                            <p>Several well-documented incidents illustrate this pattern:</p>
                        </div>
                    </header>

                    <div class="newsletter-signal-list">
                        <article class="newsletter-signal-card newsletter-signal-card--alert">
                            <div class="newsletter-signal-card__icon" aria-hidden="true">⚠️</div>
                            <div>
                                <h3>The Capital One breach</h3>
                                <p>
                                    Demonstrated how a misconfigured web application firewall (WAF), combined with a
                                    server-side request forgery (SSRF) vulnerability and over-permissive IAM roles,
                                    enabled attackers to obtain cloud credentials and access sensitive data affecting
                                    over 100 million individuals.
                                </p>
                            </div>
                        </article>

                        <article class="newsletter-signal-card newsletter-signal-card--storage">
                            <div class="newsletter-signal-card__icon" aria-hidden="true">📦</div>
                            <div>
                                <h3>Repeated exposures of publicly accessible storage</h3>
                                <p>
                                    (e.g., S3 buckets, Azure Blob storage) continue across industries due to improper
                                    access configurations.
                                </p>
                            </div>
                        </article>

                        <article class="newsletter-signal-card newsletter-signal-card--target">
                            <div class="newsletter-signal-card__icon" aria-hidden="true">🎯</div>
                            <div>
                                <h3>Modern attack patterns</h3>
                                <p>
                                    increasingly focus on identity-based exploitation, including token misuse,
                                    privilege escalation, and service account compromise.
                                </p>
                            </div>
                        </article>
                    </div>

                    <div class="newsletter-highlight">
                        These incidents consistently point to:
                        <strong>configuration gaps and identity weaknesses</strong>
                        not platform failures.
                    </div>
                </section>

                <section class="newsletter-section newsletter-section--soft">
                    <header class="newsletter-section__header">
                        <span class="newsletter-section__accent" aria-hidden="true"></span>
                        <div>
                            <h2>Identity: The Primary Attack Surface</h2>
                        </div>
                    </header>
                </section>
            </div>

            <aside class="newsletter-sidebar">
                <section class="newsletter-inquiry">
                    <h2>Start with Us Today!</h2>
                    <livewire:forms.newsletter-inquiry-form />
                </section>

                <section class="newsletter-latest">
                    <h2>Explore Latest Newsletters</h2>
                    <div class="newsletter-latest__list">
                        @forelse($latestNewsletters as $latestNewsletter)
                            <a href="{{ route('newsletters.show', $latestNewsletter->slug) }}" class="newsletter-latest__item">
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
        </div>
    </article>
@endsection
