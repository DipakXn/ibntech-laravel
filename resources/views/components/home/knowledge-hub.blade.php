@php
    $resources = [
        [
            'title' => 'Case Studies',
            'text' => 'Proven success stories from industry leaders',
            'featured' => 'Featured: Digital Transformation for modern enterprises',
            'route' => route('case-studies.index'),
            'tone' => 'violet',
            'icon' => 'fa-briefcase',
            'cta' => 'Explore Case Studies',
        ],
        [
            'title' => 'Whitepapers',
            'text' => 'Deep dives into emerging tech and strategy',
            'featured' => 'Featured: In-depth research and industry insights',
            'route' => route('white-papers.index'),
            'tone' => 'green',
            'icon' => 'fa-file-lines',
            'cta' => 'Explore Whitepapers',
        ],
        [
            'title' => 'eBooks',
            'text' => 'Practical guides for real-world execution',
            'featured' => 'Featured: Zero Trust Architecture Made Simple',
            'route' => route('ebooks.index'),
            'tone' => 'green',
            'icon' => 'fa-book-open',
            'cta' => 'Explore eBooks',
        ],
    ];

    $featured = [
        [
            'title' => 'Cloud Optimization & Database Modernization with AWS RDS',
            'text' => 'A leading AI-driven software corps connected with IBN Technologies to build its cloud infrastructure using AWS RDS.',
            'cta' => 'Read Case Study →',
            'route' => route('case-studies.index'),
        ],
        [
            'title' => 'How ProfitCents Adds Value to CFOs',
            'text' => 'In todays cut throat competition it’s very important for the companies…',
            'cta' => 'Read Article →',
            'route' => route('articles.index'),
        ],
        [
            'title' => 'Step-by-Step Approach to Year-End Bookkeeping and Tax Preparation',
            'text' => 'Prepare for tax season with confidence by transforming disorganized financial…',
            'cta' => 'Read Guide →',
            'route' => route('blog.index'),
        ],
    ];
@endphp

<section class="home-section home-section--lavender" aria-labelledby="home-knowledge-title">
    <div class="home-shell">
        <div class="text-center">
            <h2 id="home-knowledge-title" class="home-section-title">
                Knowledge <span class="accent">Hub</span>
            </h2>
            <p class="mt-2 text-lg italic text-[var(--home-green-dark)]">Insights &amp; Resources That Drive Innovation</p>
            <p class="home-section-lead mx-auto max-w-3xl">
                Stay future-ready with our expertly curated library of industry reports, strategic frameworks, and hands-on guides designed to accelerate your digital transformation journey.
            </p>
        </div>

        <div class="home-knowledge__grid">
            <div>
                <h3 class="mb-3 text-xl font-bold text-[var(--home-navy)]">Resource Library</h3>
                <div class="home-knowledge__stack">
                    @foreach ($resources as $resource)
                        <article class="home-card home-resource-card">
                            <div class="home-resource-card__head home-resource-card__head--{{ $resource['tone'] }}">
                                <i class="fa-solid {{ $resource['icon'] }}" aria-hidden="true"></i>
                                {{ $resource['title'] }}
                            </div>
                            <div class="home-resource-card__body">
                                <p>{{ $resource['text'] }}</p>
                                <p class="mt-2 text-sm font-semibold text-[var(--home-navy)]">{{ $resource['featured'] }}</p>
                                <a href="{{ $resource['route'] }}" class="home-btn home-btn--grad">{{ $resource['cta'] }} →</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <div>
                <h3 class="mb-3 text-xl font-bold text-[var(--home-navy)]">Featured Content</h3>
                <div class="home-knowledge__stack">
                    @foreach ($featured as $item)
                        <article class="home-card home-featured-card">
                            <h4>{{ $item['title'] }}</h4>
                            <p>{{ $item['text'] }}</p>
                            <a href="{{ $item['route'] }}" class="home-btn home-btn--outline-green !inline-flex !w-auto">{{ $item['cta'] }}</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
