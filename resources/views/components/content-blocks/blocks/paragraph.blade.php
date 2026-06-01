@php($content = str($data['content'] ?? '')->sanitizeHtml())

@if (filled((string) $content))
    <section class="content-block content-block--paragraph">
        {!! $content !!}
    </section>
@endif

