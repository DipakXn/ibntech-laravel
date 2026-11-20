@php
    use App\Support\MediaLibrary\MediaLibraryCatalog;

    $media = $getRecord();
    $card = MediaLibraryCatalog::present($media);
@endphp

<div class="ibn-media-card">
    <button
        type="button"
        class="ibn-media-card-hit"
        wire:click="selectMedia({{ (int) $media->getKey() }})"
        aria-label="Select {{ $card['name'] }}"
    ></button>

    <div class="ibn-media-thumb">
        @if (filled($card['preview_url']))
            <img src="{{ $card['preview_url'] }}" alt="">
        @else
            <span class="ibn-media-type-label">{{ $card['extension'] }}</span>
        @endif
    </div>

    <div class="ibn-media-name" title="{{ $card['name'] }}">{{ $card['name'] }}</div>
    <div class="ibn-media-meta">
        <span>{{ $card['size'] }}</span>
        <span>{{ $card['extension'] }}</span>
    </div>
</div>
