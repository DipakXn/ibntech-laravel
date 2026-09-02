<?php

namespace App\Support\Html;

use App\Services\WordPress\HtmlToBlocksConverter;
use App\Support\BlockContent;
use Illuminate\Support\Str;

class HtmlToBlocks
{
    public const WORKSPACE_TYPE = 'html_code';

    /**
     * Convert pasted HTML into native content blocks for the admin builder.
     *
     * Uses HtmlToBlocksConverter in admin mode so WordPress import mapping stays
     * unchanged. Images, buttons, tables, and FAQ markup become native blocks.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function convert(string $html): array
    {
        $result = (new HtmlToBlocksConverter)->convert($html, forAdmin: true);

        return self::sanitizeNativeBlocks($result['blocks']);
    }

    /**
     * Replace every html_code workspace with converted native blocks.
     *
     * @param  array<int|string, mixed>  $items
     * @return array<int|string, array<string, mixed>>
     */
    public static function expandHtmlCodeWorkspaces(array $items): array
    {
        $expanded = [];
        $isList = array_is_list($items);

        foreach ($items as $key => $item) {
            if (! self::isWorkspace($item)) {
                if ($isList) {
                    $expanded[] = $item;
                } else {
                    $expanded[$key] = $item;
                }

                continue;
            }

            foreach (self::convert((string) data_get($item, 'data.html', '')) as $block) {
                if ($isList) {
                    $expanded[] = $block;
                } else {
                    $expanded[(string) Str::uuid()] = $block;
                }
            }
        }

        return $expanded;
    }

    /**
     * Convert one html_code workspace in builder state into native blocks.
     *
     * @param  array<int|string, mixed>  $items
     * @return array<int|string, mixed>
     */
    public static function convertWorkspaceInState(array $items, string $itemKey, ?string $html = null, ?callable $nextKey = null): array
    {
        $item = $items[$itemKey] ?? null;

        if (! self::isWorkspace($item)) {
            return $items;
        }

        $html ??= (string) data_get($item, 'data.html', '');
        $converted = self::convert($html);

        if ($converted === []) {
            return $items;
        }

        return self::replaceItemWithBlocks($items, $itemKey, $converted, $nextKey);
    }

    /**
     * @param  array<int|string, mixed>  $items
     * @param  array<int, array<string, mixed>>  $blocks
     * @return array<int|string, mixed>
     */
    public static function replaceItemWithBlocks(array $items, string $itemKey, array $blocks, ?callable $nextKey = null): array
    {
        $replaced = [];
        $isList = array_is_list($items);

        foreach ($items as $key => $item) {
            if ((string) $key !== $itemKey) {
                if ($isList) {
                    $replaced[] = $item;
                } else {
                    $replaced[$key] = $item;
                }

                continue;
            }

            foreach ($blocks as $block) {
                if ($isList) {
                    $replaced[] = $block;

                    continue;
                }

                $newKey = $nextKey ? $nextKey() : (string) Str::uuid();
                $replaced[$newKey ?: (string) Str::uuid()] = $block;
            }
        }

        return $replaced;
    }

    public static function isWorkspace(mixed $item): bool
    {
        return is_array($item) && ($item['type'] ?? null) === self::WORKSPACE_TYPE;
    }

    public static function isSafeContentUrl(string $url, bool $allowHash = false): bool
    {
        $url = trim($url);

        if ($url === '') {
            return false;
        }

        if ($allowHash && ($url === '#' || (str_starts_with($url, '#') && ! str_contains($url, ':')))) {
            return true;
        }

        $lower = strtolower($url);

        if (
            str_starts_with($lower, 'javascript:')
            || str_starts_with($lower, 'data:')
            || str_starts_with($lower, 'vbscript:')
        ) {
            return false;
        }

        if (str_starts_with($url, '/') && ! str_starts_with($url, '//')) {
            return true;
        }

        if (str_starts_with($url, '//')) {
            return self::isSafeHttpUrl('https:'.$url);
        }

        return self::isSafeHttpUrl($url);
    }

    /**
     * @param  array<int, array<string, mixed>>  $blocks
     * @return array<int, array<string, mixed>>
     */
    protected static function sanitizeNativeBlocks(array $blocks): array
    {
        $sanitized = [];

        foreach ($blocks as $block) {
            if (! is_array($block) || ! isset($block['type'], $block['data']) || ! is_array($block['data'])) {
                continue;
            }

            $type = $block['type'];
            $data = $block['data'];

            if ($type === self::WORKSPACE_TYPE) {
                continue;
            }

            if ($type === 'paragraph') {
                $data['content'] = SafeHtml::sanitizeForRender((string) ($data['content'] ?? ''));

                if (! self::paragraphHasVisibleContent((string) $data['content'])) {
                    continue;
                }
            }

            if ($type === 'heading') {
                $data['text'] = trim(strip_tags((string) ($data['text'] ?? '')));
                $data['level'] = in_array($data['level'] ?? 'h2', ['h2', 'h3', 'h4'], true)
                    ? $data['level']
                    : 'h2';

                if ($data['text'] === '') {
                    continue;
                }
            }

            if ($type === 'image') {
                $url = trim((string) ($data['url'] ?? ''));

                if (! self::isSafeContentUrl($url)) {
                    continue;
                }

                $data['url'] = $url;
                $data['alt'] = trim((string) ($data['alt'] ?? '')) ?: null;
                $data['caption'] = trim((string) ($data['caption'] ?? '')) ?: null;
            }

            if ($type === 'buttons') {
                $items = [];

                foreach ($data['items'] ?? [] as $item) {
                    if (! is_array($item)) {
                        continue;
                    }

                    $label = trim((string) ($item['label'] ?? ''));
                    $url = trim((string) ($item['url'] ?? ''));

                    if ($label === '' || ! self::isSafeContentUrl($url, allowHash: true)) {
                        continue;
                    }

                    $items[] = [
                        'label' => Str::limit($label, 100, ''),
                        'url' => $url,
                        'style' => in_array($item['style'] ?? 'primary', ['primary', 'secondary', 'dark'], true)
                            ? $item['style']
                            : 'primary',
                        'target' => ($item['target'] ?? '_self') === '_blank' ? '_blank' : '_self',
                    ];
                }

                if ($items === []) {
                    continue;
                }

                $data['items'] = array_slice($items, 0, 3);
            }

            if ($type === 'faq') {
                $items = [];

                foreach ($data['items'] ?? [] as $item) {
                    if (! is_array($item)) {
                        continue;
                    }

                    $question = trim(strip_tags((string) ($item['question'] ?? '')));
                    $answer = SafeHtml::sanitizeForRender((string) ($item['answer'] ?? ''));

                    if ($question === '' || trim(html_entity_decode(strip_tags($answer), ENT_QUOTES | ENT_HTML5, 'UTF-8')) === '') {
                        continue;
                    }

                    $items[] = [
                        'question' => Str::limit($question, 255, ''),
                        'answer' => $answer,
                    ];
                }

                if ($items === []) {
                    continue;
                }

                $data['items'] = $items;
            }

            if ($type === 'embed') {
                $url = trim((string) ($data['url'] ?? ''));
                $safeUrl = BlockContent::embedUrl($url) ?: $url;

                if (! self::isSafeHttpUrl($safeUrl)) {
                    continue;
                }

                $data['url'] = $safeUrl;
            }

            $block['data'] = $data;
            $sanitized[] = $block;
        }

        return $sanitized;
    }

    protected static function paragraphHasVisibleContent(string $html): bool
    {
        $text = trim(html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8'));

        return $text !== '' || preg_match('/<img\b/i', $html) === 1;
    }

    protected static function isSafeHttpUrl(string $url): bool
    {
        $parts = parse_url($url);
        $scheme = strtolower((string) ($parts['scheme'] ?? ''));

        return in_array($scheme, ['http', 'https'], true);
    }
}
