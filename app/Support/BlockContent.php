<?php

namespace App\Support;

use App\Support\Html\HtmlToBlocks;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class BlockContent
{
    public static function prepareForRender(mixed $content): array
    {
        $usedAnchors = [];
        $fallbackIndex = 1;
        $prepared = [];

        foreach (HtmlToBlocks::expandHtmlCodeWorkspaces(self::normalize($content)) as $block) {
            $type = $block['type'] ?? null;
            $data = $block['data'] ?? [];

            if ($type === 'heading') {
                $level = in_array($data['level'] ?? 'h2', ['h2', 'h3', 'h4'], true) ? $data['level'] : 'h2';
                $text = trim((string) ($data['text'] ?? ''));

                if ($text !== '') {
                    $data['anchor_id'] = self::uniqueAnchorId($text, $usedAnchors, $fallbackIndex);
                }
            }

            if ($type === 'paragraph' && filled($data['content'] ?? null)) {
                ['content' => $data['content'], 'toc_items' => $data['toc_items']] = self::prepareHtmlHeadings(
                    (string) $data['content'],
                    $usedAnchors,
                    $fallbackIndex,
                );
            }

            $block['data'] = $data;
            $prepared[] = $block;
        }

        return $prepared;
    }

    public static function headingAnchors(mixed $content, array $levels = ['h2', 'h3']): array
    {
        $anchors = [];
        $paragraphHeadingIndex = 0;

        foreach (self::prepareForRender($content) as $block) {
            if (($block['type'] ?? null) !== 'heading') {
                if (($block['type'] ?? null) === 'paragraph') {
                    foreach ($block['data']['toc_items'] ?? [] as $item) {
                        if (in_array($item['level'], $levels, true)) {
                            $anchors['paragraph-'.$paragraphHeadingIndex] = $item;
                            $paragraphHeadingIndex++;
                        }
                    }
                }

                continue;
            }

            $data = $block['data'] ?? [];
            $level = in_array($data['level'] ?? 'h2', ['h2', 'h3', 'h4'], true) ? $data['level'] : 'h2';

            if (! in_array($level, $levels, true) || blank($data['anchor_id'] ?? null) || blank($data['text'] ?? null)) {
                continue;
            }

            $blockKey = self::headingBlockKey($data);

            if ($blockKey !== null) {
                $anchors[$blockKey] = [
                    'id' => $data['anchor_id'],
                    'text' => trim((string) $data['text']),
                    'level' => $level,
                ];
            }
        }

        return $anchors;
    }

    public static function tableOfContents(mixed $content, array $levels = ['h2', 'h3']): array
    {
        return array_values(self::headingAnchors($content, $levels));
    }

    public static function normalize(mixed $content): array
    {
        if (blank($content)) {
            return [];
        }

        if (is_array($content)) {
            return self::looksLikeBlocks($content) ? array_values($content) : [];
        }

        if (! is_string($content)) {
            return [];
        }

        $decoded = json_decode($content, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && self::looksLikeBlocks($decoded)) {
            return array_values($decoded);
        }

        return [[
            'type' => 'paragraph',
            'data' => [
                'content' => self::legacyStringToHtml($content),
            ],
        ]];
    }

    public static function encode(mixed $content): ?string
    {
        if (blank($content)) {
            return json_encode([]);
        }

        if (is_string($content)) {
            return $content;
        }

        return json_encode(
            array_values(HtmlToBlocks::expandHtmlCodeWorkspaces($content)),
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
        );
    }

    public static function toPlainText(mixed $content): string
    {
        $segments = [];

        foreach (HtmlToBlocks::expandHtmlCodeWorkspaces(self::normalize($content)) as $block) {
            $type = $block['type'] ?? null;
            $data = $block['data'] ?? [];

            $segments[] = match ($type) {
                'heading' => $data['text'] ?? '',
                'image' => $data['caption'] ?? '',
                'gallery' => $data['caption'] ?? '',
                'quote' => trim(implode(' ', array_filter([
                    strip_tags((string) ($data['quote'] ?? '')),
                    $data['author'] ?? null,
                ]))),
                'buttons' => trim(implode(' ', array_filter([
                    $data['title'] ?? null,
                    implode(' ', array_filter(array_map(
                        fn (array $button): ?string => $button['label'] ?? null,
                        Arr::wrap($data['items'] ?? [])
                    ))),
                ]))),
                'embed' => trim(implode(' ', array_filter([
                    $data['title'] ?? null,
                    $data['url'] ?? null,
                ]))),
                'code' => trim(implode(' ', array_filter([
                    $data['filename'] ?? null,
                    $data['language'] ?? null,
                    $data['code'] ?? null,
                ]))),
                'table' => trim(implode(' ', array_filter([
                    $data['caption'] ?? null,
                    implode(' ', Arr::wrap($data['headers'] ?? [])),
                    implode(' ', array_map(
                        fn (array $row): string => implode(' ', Arr::wrap($row['columns'] ?? [])),
                        Arr::wrap($data['rows'] ?? [])
                    )),
                ]))),
                'faq' => trim(implode(' ', array_filter([
                    $data['title'] ?? null,
                    implode(' ', array_map(
                        fn (array $item): string => trim(implode(' ', array_filter([
                            $item['question'] ?? null,
                            strip_tags((string) ($item['answer'] ?? '')),
                        ]))),
                        Arr::wrap($data['items'] ?? [])
                    )),
                ]))),
                'callout' => trim(implode(' ', array_filter([
                    $data['title'] ?? null,
                    strip_tags((string) ($data['content'] ?? '')),
                ]))),
                'cta' => trim(implode(' ', array_filter([
                    $data['heading'] ?? null,
                    $data['description'] ?? null,
                    $data['button_label'] ?? null,
                ]))),
                default => strip_tags((string) ($data['content'] ?? '')),
            };
        }

        return trim(preg_replace('/\s+/', ' ', implode(' ', array_filter($segments))) ?? '');
    }

    public static function summary(mixed $content, int $limit = 160): string
    {
        return Str::of(self::toPlainText($content))->limit($limit)->toString();
    }

    public static function embedUrl(?string $url): ?string
    {
        if (blank($url)) {
            return null;
        }

        $url = trim($url);

        if (preg_match('~(?:youtube\.com/watch\?v=|youtu\.be/)([^&?/]+)~i', $url, $matches)) {
            return 'https://www.youtube.com/embed/'.$matches[1];
        }

        if (preg_match('~vimeo\.com/(\d+)~i', $url, $matches)) {
            return 'https://player.vimeo.com/video/'.$matches[1];
        }

        return null;
    }

    protected static function looksLikeBlocks(array $content): bool
    {
        if ($content === []) {
            return true;
        }

        return collect($content)->every(
            fn ($item): bool => is_array($item) && array_key_exists('type', $item) && array_key_exists('data', $item)
        );
    }

    protected static function legacyStringToHtml(string $content): string
    {
        $content = trim($content);

        if ($content === '') {
            return '';
        }

        if ($content !== strip_tags($content)) {
            return $content;
        }

        $paragraphs = preg_split('/\r\n\r\n|\n\n|\r\r/', $content) ?: [$content];

        return collect($paragraphs)
            ->map(fn (string $paragraph): string => '<p>'.nl2br(e(trim($paragraph))).'</p>')
            ->implode('');
    }

    protected static function headingBlockKey(array $data): ?string
    {
        $blockId = trim((string) ($data['block_id'] ?? ''));

        if ($blockId !== '') {
            return $blockId;
        }

        $text = trim((string) ($data['text'] ?? ''));
        $level = trim((string) ($data['level'] ?? 'h2'));

        if ($text === '') {
            return null;
        }

        return md5($level.'|'.$text);
    }

    protected static function uniqueAnchorId(string $text, array &$usedAnchors, int &$fallbackIndex): string
    {
        $baseSlug = Str::slug($text);
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'section-'.$fallbackIndex++;
        $anchor = $baseSlug;
        $suffix = 2;

        while (in_array($anchor, $usedAnchors, true)) {
            $anchor = $baseSlug.'-'.$suffix;
            $suffix++;
        }

        $usedAnchors[] = $anchor;

        return $anchor;
    }

    protected static function prepareHtmlHeadings(string $html, array &$usedAnchors, int &$fallbackIndex): array
    {
        $tocItems = [];

        $content = preg_replace_callback(
            '/<h([2-3])([^>]*)>(.*?)<\/h\1>/is',
            function (array $matches) use (&$tocItems, &$usedAnchors, &$fallbackIndex): string {
                $level = 'h'.$matches[1];
                $attributes = $matches[2] ?? '';
                $innerHtml = $matches[3] ?? '';
                $text = trim(strip_tags($innerHtml));

                if ($text === '') {
                    return $matches[0];
                }

                $anchorId = self::uniqueAnchorId($text, $usedAnchors, $fallbackIndex);
                $cleanAttributes = preg_replace('/\s+id=("|\').*?\1/i', '', $attributes) ?? $attributes;

                $tocItems[] = [
                    'id' => $anchorId,
                    'text' => $text,
                    'level' => $level,
                ];

                return sprintf('<%1$s%2$s id="%3$s">%4$s</%1$s>', $level, $cleanAttributes, $anchorId, $innerHtml);
            },
            $html,
        );

        return [
            'content' => $content ?? $html,
            'toc_items' => $tocItems,
        ];
    }
}
