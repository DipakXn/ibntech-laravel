@props([
    'blocks' => [],
    'model' => null,
    'class' => null,
])

@php($preparedBlocks = \App\Support\BlockContent::prepareForRender($blocks))
@php($headingAnchors = \App\Support\BlockContent::headingAnchors($blocks, ['h2', 'h3', 'h4']))

<div {{ $attributes->class(['content-blocks', $class]) }}>
    @foreach ($preparedBlocks as $block)
        @includeIf('components.content-blocks.blocks.'.($block['type'] ?? 'paragraph'), [
            'data' => $block['data'] ?? [],
            'model' => $model,
            'headingAnchors' => $headingAnchors,
        ])
    @endforeach
</div>
