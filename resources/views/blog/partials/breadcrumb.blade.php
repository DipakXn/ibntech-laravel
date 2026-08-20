@php
    /** @var array<int, array{label: string, url?: string|null}> $items */
    $items = collect($items ?? [])
        ->filter(fn (array $item) => filled($item['label'] ?? null))
        ->values();
@endphp

@if($items->isNotEmpty())
    <nav class="blog-breadcrumb" aria-label="Breadcrumb">
        <ol class="blog-breadcrumb__list">
            @foreach($items as $index => $item)
                @php
                    $isLast = $index === $items->count() - 1;
                    $url = $item['url'] ?? null;
                @endphp
                <li class="blog-breadcrumb__item">
                    @if(! $isLast && filled($url))
                        <a href="{{ $url }}">{{ $item['label'] }}</a>
                    @else
                        <span aria-current="page">{{ $item['label'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>

    @php
        $breadcrumbLd = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items->values()->map(function (array $item, int $index) {
                $element = [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $item['label'],
                ];

                if (! empty($item['url'])) {
                    $element['item'] = $item['url'];
                }

                return $element;
            })->all(),
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($breadcrumbLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
@endif
