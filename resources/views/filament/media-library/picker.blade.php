@php
    $mediaPath = $getStatePath();
    $dataPath = (string) str($mediaPath)->beforeLast('.');
    $last = $paginator->lastPage();
    $current = $paginator->currentPage();
@endphp

<div
    class="ibn-media-library ibn-media-picker"
    x-data="{
        search: @js($query),
        kind: @js($kind),
        owner: @js($owner),
        perPage: @js((string) $perPage),
        selected: $wire.entangle(@js($mediaPath)),
        go(page = 1) {
            const current = JSON.parse(JSON.stringify($wire.get(@js($dataPath)) || {}))
            current.query = this.search || ''
            current.kind = this.kind || ''
            current.owner = this.owner || ''
            current.per_page = Number(this.perPage) || 10
            current.page = page
            current.media_id = this.selected
            $wire.set(@js($dataPath), current)
        },
    }"
>
    <input
        type="search"
        class="ibn-media-search"
        placeholder="Search file names"
        aria-label="Search file names"
        x-model="search"
        x-on:input.debounce.400ms="go(1)"
    >

    <div class="ibn-media-picker-filters">
        @if ($kindOptions !== [])
            <label>
                <span>Type</span>
                <select x-model="kind" x-on:change="go(1)" aria-label="Type">
                    <option value="">All types</option>
                    @foreach ($kindOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </label>
        @endif

        <label>
            <span>Owner</span>
            <select x-model="owner" x-on:change="go(1)" aria-label="Owner">
                <option value="">All owners</option>
                @foreach ($ownerOptions as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        </label>
    </div>

    @if ($cards === [])
        <p class="ibn-media-picker-empty">No matching files.</p>
    @else
        <div class="ibn-media-picker-grid" role="listbox" aria-label="Library files">
            @foreach ($cards as $card)
                <button
                    type="button"
                    class="ibn-media-picker-card"
                    role="option"
                    x-bind:class="{ 'is-selected': String(selected) === '{{ $card['id'] }}' }"
                    x-bind:aria-selected="String(selected) === '{{ $card['id'] }}'"
                    x-on:click="selected = '{{ $card['id'] }}'"
                >
                    <span class="ibn-media-thumb">
                        @if (filled($card['preview_url']))
                            <img src="{{ $card['preview_url'] }}" alt="">
                        @else
                            <span class="ibn-media-type-label">{{ $card['extension'] }}</span>
                        @endif
                    </span>
                    <span class="ibn-media-name" title="{{ $card['name'] }}">{{ $card['name'] }}</span>
                    <span class="ibn-media-meta">
                        <span>{{ $card['size'] }}</span>
                        <span>{{ $card['extension'] }}</span>
                    </span>
                </button>
            @endforeach
        </div>
    @endif

    @if ($paginator->total() > 0)
        <nav class="ibn-media-pager" aria-label="Pagination">
            <p class="ibn-media-pager-count">
                Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
            </p>

            <label class="ibn-media-pager-per-page">
                <span>Per page</span>
                <select x-model="perPage" x-on:change="go(1)" aria-label="Per page">
                    @foreach (\App\Support\MediaLibrary\MediaLibraryCatalog::PER_PAGE_OPTIONS as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </label>

            <div class="ibn-media-pager-pages">
                @if ($current > 1)
                    <button type="button" x-on:click="go(1)" aria-label="First page">«</button>
                    <button type="button" x-on:click="go({{ $current - 1 }})" aria-label="Previous page">‹</button>
                @endif

                @for ($page = max(1, $current - 2); $page <= min($last, max($current + 2, 3)); $page++)
                    <button
                        type="button"
                        x-on:click="go({{ $page }})"
                        @class(['is-active' => $page === $current])
                        @if ($page === $current) aria-current="page" @endif
                    >{{ $page }}</button>
                @endfor

                @if ($current < $last)
                    <button type="button" x-on:click="go({{ $current + 1 }})" aria-label="Next page">›</button>
                    <button type="button" x-on:click="go({{ $last }})" aria-label="Last page">»</button>
                @endif
            </div>
        </nav>
    @endif
</div>
