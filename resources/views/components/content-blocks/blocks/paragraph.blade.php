@php($content = \App\Support\Html\SafeHtml::sanitizeForRender($data['content'] ?? ''))

@if (filled((string) $content))
    <section class="content-block content-block--paragraph">
        {!! $content !!}
    </section>
@endif

