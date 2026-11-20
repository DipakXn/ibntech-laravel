@php
    $mediaPath = $getStatePath();
    $queryPath = (string) str($mediaPath)->beforeLast('.')->append('.query');
@endphp

<div
    class="ibn-media-library ibn-media-picker"
    x-data="{
        search: @js($query),
        selected: $wire.entangle(@js($mediaPath)),
    }"
>
    <input
        type="search"
        class="ibn-media-search"
        placeholder="Search file names"
        aria-label="Search file names"
        x-model="search"
        x-on:input.debounce.400ms="$wire.set(@js($queryPath), search)"
    >

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
</div>
