@php
    $relativePath = trim((string) $media->getPathRelativeToRoot(), '/');
    $url = null;

    try {
        $url = $media->getUrl();
    } catch (Throwable $exception) {
        $url = null;
    }
@endphp

<div class="space-y-4 text-sm">
    @if (str_starts_with((string) $media->mime_type, 'image/') && filled($url))
        <img src="{{ $url }}" alt="" class="max-h-48 rounded-lg border border-gray-200">
    @endif

    <dl class="grid gap-3">
        <div>
            <dt class="font-medium text-gray-500">Path</dt>
            <dd class="break-all">{{ 'uploads/'.$relativePath }}</dd>
        </div>
        <div>
            <dt class="font-medium text-gray-500">URL</dt>
            <dd class="break-all">{{ $url ?: '—' }}</dd>
        </div>
        <div>
            <dt class="font-medium text-gray-500">Type</dt>
            <dd>{{ $media->mime_type ?: '—' }} · {{ $media->human_readable_size }}</dd>
        </div>
        <div>
            <dt class="font-medium text-gray-500">Collection</dt>
            <dd>{{ $media->collection_name }}</dd>
        </div>
        <div>
            <dt class="font-medium text-gray-500">Usage</dt>
            <dd class="space-y-2">{!! $usage->detailHtml($media) !!}</dd>
        </div>
    </dl>
</div>
