<x-filament-panels::page>
    <div class="ibn-user-guide">
        <aside class="ibn-widget-card ibn-user-guide__nav">
            <div class="ibn-widget-card__header">
                <div>
                    <p class="ibn-widget-card__eyebrow">Documentation</p>
                    <h3>
                        @if ($search !== '')
                            {{ number_format($matchCount) }} of {{ number_format($totalCount) }} topics
                        @else
                            {{ number_format($totalCount) }} topics
                        @endif
                    </h3>
                </div>
            </div>

            <label class="ibn-user-guide__field">
                <span>Search the guide</span>
                <input
                    type="search"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Features, modules, settings, workflows"
                    autocomplete="off"
                >
            </label>

            @if ($search !== '')
                <button type="button" class="ibn-user-guide__clear" wire:click="clearSearch">
                    Clear search
                </button>
            @endif

            <nav class="ibn-user-guide__groups" aria-label="User guide topics">
                @forelse ($groups as $group)
                    <section wire:key="guide-group-{{ \Illuminate\Support\Str::slug($group['label']) }}">
                        <h4>{{ $group['label'] }}</h4>
                        @foreach ($group['topics'] as $item)
                            <button
                                type="button"
                                wire:click="selectTopic('{{ $item->slug }}')"
                                wire:key="guide-topic-{{ $item->slug }}"
                                class="ibn-user-guide__topic {{ $document && $document->topic->slug === $item->slug ? 'is-selected' : '' }}"
                                @if ($document && $document->topic->slug === $item->slug) aria-current="page" @endif
                            >
                                <strong>{{ $item->title }}</strong>
                                <span>{{ $item->summary }}</span>
                            </button>
                        @endforeach
                    </section>
                @empty
                    <p class="ibn-empty-inline">No topics match this search.</p>
                @endforelse
            </nav>
        </aside>

        <article class="ibn-widget-card ibn-user-guide__article" id="user-guide-article" wire:key="guide-article-{{ $document->topic->slug ?? 'empty' }}">
            @if ($document)
                <header class="ibn-user-guide__article-header">
                    <p class="ibn-widget-card__eyebrow">{{ $document->topic->group }}</p>
                    <h2>{{ $document->topic->title }}</h2>
                    <p>{{ $document->topic->summary }}</p>
                </header>

                @if (count($document->headings) > 1)
                    <nav class="ibn-user-guide__toc" aria-label="On this page">
                        <p>On this page</p>
                        @foreach ($document->headings as $heading)
                            <a href="#{{ $heading['id'] }}" class="is-level-{{ $heading['level'] }}">{{ $heading['text'] }}</a>
                        @endforeach
                    </nav>
                @endif

                <div class="ibn-user-guide__prose">
                    {!! $document->html !!}
                </div>
            @else
                <header class="ibn-user-guide__article-header">
                    <p class="ibn-widget-card__eyebrow">Search</p>
                    <h2>No matching topics</h2>
                    <p>Try a module name, a public URL, or a setting such as sitemap, SMTP, or queue.</p>
                </header>
            @endif
        </article>
    </div>
</x-filament-panels::page>
