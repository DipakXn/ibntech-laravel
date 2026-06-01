@php($buttons = collect($data['items'] ?? [])->filter(fn ($item) => filled($item['label'] ?? null) && filled($item['url'] ?? null)))

@if ($buttons->isNotEmpty())
    <section class="content-block content-block--buttons">
        @if (filled($data['title'] ?? null))
            <h3>{{ $data['title'] }}</h3>
        @endif

        <div class="content-button-row">
            @foreach ($buttons as $button)
                <a
                    href="{{ $button['url'] }}"
                    class="content-button content-button--{{ $button['style'] ?? 'primary' }}"
                    target="{{ $button['target'] ?? '_self' }}"
                    @if (($button['target'] ?? '_self') === '_blank') rel="noopener noreferrer" @endif
                >
                    {{ $button['label'] }}
                </a>
            @endforeach
        </div>
    </section>
@endif

