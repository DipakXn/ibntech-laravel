@php
    use App\Support\MediaLibrary\MediaLibraryCatalog;
    use App\Support\MediaLibrary\MediaLibraryUsage;
    use Illuminate\Support\Js;

    $usage = app(MediaLibraryUsage::class);
    $card = $media ? MediaLibraryCatalog::present($media) : null;
    $url = null;

    if ($media) {
        try {
            $url = $media->getUrl();
        } catch (Throwable $exception) {
            $url = null;
        }
    }
@endphp

<aside class="ibn-media-library ibn-media-panel">
    <h2 class="ibn-media-panel-title">Details</h2>

    @if (! $media || ! $card)
        <p class="ibn-media-panel-empty">Select a file to see its details.</p>
    @else
        <div class="ibn-media-panel-preview">
            @if (filled($card['preview_url']))
                <img src="{{ $card['preview_url'] }}" alt="">
            @else
                <span class="ibn-media-type-label">{{ $card['extension'] }}</span>
            @endif
        </div>

        <p class="ibn-media-panel-name" title="{{ $card['name'] }}">{{ $card['name'] }}</p>

        <dl class="ibn-media-panel-facts">
            <div>
                <dt>Size</dt>
                <dd>{{ $card['size'] }}</dd>
            </div>
            <div>
                <dt>Type</dt>
                <dd><span class="ibn-media-panel-pill">{{ $media->mime_type ?: $card['extension'] }}</span></dd>
            </div>
        </dl>

        <div class="ibn-media-panel-block">
            <div class="ibn-media-panel-label">Public URL</div>
            <div class="ibn-media-panel-value" title="{{ $url ?: '' }}">{{ $url ?: '—' }}</div>
        </div>

        <div class="ibn-media-panel-block">
            <div class="ibn-media-panel-label">Uploaded</div>
            <div class="ibn-media-panel-value">{{ $media->created_at?->diffForHumans() ?: '—' }}</div>
        </div>

        <div class="ibn-media-panel-block">
            <div class="ibn-media-panel-label">Usage</div>
            <div class="ibn-media-panel-value ibn-media-panel-usage">{!! $usage->detailHtml($media) !!}</div>
        </div>

        @if ($usage->canDelete($media))
            <button
                type="button"
                class="ibn-media-panel-delete"
                wire:click="mountAction('deleteFile', {}, {{ Js::from(['table' => true, 'recordKey' => (string) $media->getKey()]) }})"
            >
                Delete
            </button>
        @endif
    @endif
</aside>
