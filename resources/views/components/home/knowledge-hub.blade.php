@props([
    'latestCaseStudy' => null,
    'latestWhitePaper' => null,
    'latestEbook' => null,
])

@php
    $latestCaseStudy = $latestCaseStudy ?? app(\App\Repositories\CaseStudyRepository::class)->latestPublished(1)->first();
    $latestWhitePaper = $latestWhitePaper ?? app(\App\Repositories\WhitePaperRepository::class)->latestPublished(1)->first();
    $latestEbook = $latestEbook ?? app(\App\Repositories\EbookRepository::class)->latestPublished(1)->first();

    $toLatest = static function (?object $item, string $type, string $icon, string $cta, string $routeName): ?array {
        if (! $item) {
            return null;
        }

        return [
            'type' => $type,
            'title' => $item->title,
            'text' => $item->excerpt ?: \App\Support\BlockContent::summary($item->content, 120),
            'image' => $item->featuredImageUrl(),
            'icon' => $icon,
            'cta' => $cta,
            'route' => route($routeName, $item->slug),
        ];
    };

    $rows = [
        [
            'resource' => [
                'title' => 'Case Studies',
                'text' => 'Proven success stories from industry leaders',
                'featured' => 'Featured: Digital Transformation for modern enterprises',
                'route' => route('case-studies.index'),
                'tone' => 'violet',
                'icon' => 'fa-briefcase',
                'cta' => 'Explore Case Studies',
            ],
            'latest' => $toLatest($latestCaseStudy, 'Case Study', 'fa-briefcase', 'Read Case Study →', 'case-studies.show'),
        ],
        [
            'resource' => [
                'title' => 'Whitepapers',
                'text' => 'Deep dives into emerging tech and strategy',
                'featured' => 'Featured: In-depth research and industry insights',
                'route' => route('white-papers.index'),
                'tone' => 'green',
                'icon' => 'fa-file-lines',
                'cta' => 'Explore Whitepapers',
            ],
            'latest' => $toLatest($latestWhitePaper, 'Whitepaper', 'fa-file-lines', 'Read Whitepaper →', 'white-papers.show'),
        ],
        [
            'resource' => [
                'title' => 'eBooks',
                'text' => 'Practical guides for real-world execution',
                'featured' => 'Featured: Zero Trust Architecture Made Simple',
                'route' => route('ebooks.index'),
                'tone' => 'green',
                'icon' => 'fa-book-open',
                'cta' => 'Explore eBooks',
            ],
            'latest' => $toLatest($latestEbook, 'eBook', 'fa-book-open', 'Read eBook →', 'ebooks.show'),
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

        <div class="home-knowledge__rows">
            @foreach ($rows as $row)
                <div class="home-knowledge__row">
                    <article class="home-card home-resource-card">
                        <div class="home-resource-card__head home-resource-card__head--{{ $row['resource']['tone'] }}">
                            <i class="fa-solid {{ $row['resource']['icon'] }}" aria-hidden="true"></i>
                            {{ $row['resource']['title'] }}
                        </div>
                        <div class="home-resource-card__body">
                            <p>{{ $row['resource']['text'] }}</p>
                            <p class="mt-2 text-sm font-semibold text-[var(--home-navy)]">{{ $row['resource']['featured'] }}</p>
                            <a href="{{ $row['resource']['route'] }}" class="home-btn home-btn--grad">{{ $row['resource']['cta'] }} →</a>
                        </div>
                    </article>

                    @if ($row['latest'])
                        <article class="home-card home-featured-card">
                            <a href="{{ $row['latest']['route'] }}" class="home-featured-card__media" aria-label="{{ $row['latest']['title'] }}">
                                @if (! empty($row['latest']['image']))
                                    <img
                                        src="{{ $row['latest']['image'] }}"
                                        alt="{{ $row['latest']['title'] }}"
                                        width="280"
                                        height="180"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                @else
                                    <div class="home-featured-card__placeholder">
                                        <i class="fa-solid {{ $row['latest']['icon'] }}" aria-hidden="true"></i>
                                    </div>
                                @endif
                            </a>
                            <div class="home-featured-card__body">
                                <h4>{{ $row['latest']['title'] }}</h4>
                                <p>{{ $row['latest']['text'] }}</p>
                                <a href="{{ $row['latest']['route'] }}" class="home-btn home-btn--outline-green !inline-flex !w-auto">{{ $row['latest']['cta'] }}</a>
                            </div>
                        </article>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
