@php
    $tag = in_array($data['level'] ?? 'h2', ['h2', 'h3', 'h4'], true) ? $data['level'] : 'h2';
    $alignmentClass = ($data['alignment'] ?? 'left') === 'center' ? 'is-centered' : null;
    $headingId = $data['anchor_id'] ?? null;
@endphp

@if (filled($data['text'] ?? null))
    <section class="content-block content-block--heading {{ $alignmentClass }}">
        @if ($tag === 'h3')
            <h3 @if($headingId) id="{{ $headingId }}" @endif>{{ $data['text'] }}</h3>
        @elseif ($tag === 'h4')
            <h4 @if($headingId) id="{{ $headingId }}" @endif>{{ $data['text'] }}</h4>
        @else
            <h2 @if($headingId) id="{{ $headingId }}" @endif>{{ $data['text'] }}</h2>
        @endif
    </section>
@endif
