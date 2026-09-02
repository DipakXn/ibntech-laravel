@php($tone = $data['tone'] ?? 'info')

@if (filled($data['title'] ?? null) || filled($data['content'] ?? null))
    <section class="content-block content-block--callout content-block--callout-{{ $tone }}">
        @if (filled($data['title'] ?? null))
            <h3>{{ $data['title'] }}</h3>
        @endif

        @if (filled($data['content'] ?? null))
            <div>{!! \App\Support\Html\SafeHtml::sanitizeForRender($data['content'] ?? '') !!}</div>
        @endif
    </section>
@endif

