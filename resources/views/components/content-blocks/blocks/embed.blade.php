@php($embedUrl = \App\Support\BlockContent::embedUrl($data['url'] ?? null))

@if ($embedUrl)
    <section class="content-block content-block--embed">
        @if (filled($data['title'] ?? null))
            <h3>{{ $data['title'] }}</h3>
        @endif

        <div class="content-embed-frame">
            <iframe
                src="{{ $embedUrl }}"
                title="{{ $data['title'] ?? 'Embedded media' }}"
                loading="lazy"
                allowfullscreen
            ></iframe>
        </div>

        @if (filled($data['caption'] ?? null))
            <p class="content-embed__caption">{{ $data['caption'] }}</p>
        @endif
    </section>
@elseif (filled($data['url'] ?? null))
    <section class="content-block content-block--embed">
        <p><a href="{{ $data['url'] }}" target="_blank" rel="noopener noreferrer">{{ $data['title'] ?? $data['url'] }}</a></p>
    </section>
@endif

