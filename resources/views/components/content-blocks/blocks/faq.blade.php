@php($items = collect($data['items'] ?? [])->filter(fn ($item) => filled($item['question'] ?? null) && filled($item['answer'] ?? null)))

@if ($items->isNotEmpty())
    <section class="content-block content-block--faq">
        @if (filled($data['title'] ?? null))
            <h3>{{ $data['title'] }}</h3>
        @endif

        <div class="content-faq-list">
            @foreach ($items as $item)
                <details>
                    <summary>{{ $item['question'] }}</summary>
                    <div>{!! \App\Support\Html\SafeHtml::sanitizeForRender($item['answer'] ?? '') !!}</div>
                </details>
            @endforeach
        </div>
    </section>
@endif

