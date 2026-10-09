<?php

namespace App\Services\WordPress;

use App\Support\ApplicationUrl;
use App\Support\PathPageUrl;

class LinkRewriter
{
    /**
     * Turn same-site absolute URLs into root-relative paths so rendered HTML
     * follows whichever host is serving the page.
     */
    public function rewrite(string $html): string
    {
        return preg_replace_callback(
            '#https?://(?:(?:[a-z0-9-]+\.)?ibntech\.com|localhost|127\.0\.0\.1)(?::\d+)?(?![A-Za-z0-9.-])(?:/[^\s"\'<>]*)?#i',
            function (array $matches): string {
                return $this->toRootRelative($matches[0]);
            },
            $html,
        ) ?? $html;
    }

    /**
     * @param  array<int, array<string, mixed>>  $blocks
     * @return array<int, array<string, mixed>>
     */
    public function rewriteBlocks(array $blocks): array
    {
        foreach ($blocks as &$block) {
            $data = $block['data'] ?? [];
            $block['data'] = is_array($data) ? $this->rewriteData($data) : $data;
        }

        return $blocks;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function rewriteData(array $data): array
    {
        foreach ($data as $key => $value) {
            $data[$key] = $this->rewriteValue($value);
        }

        return $data;
    }

    private function rewriteValue(mixed $value): mixed
    {
        if (is_string($value)) {
            return $this->rewrite($value);
        }

        if (! is_array($value)) {
            return $value;
        }

        foreach ($value as $key => $item) {
            $value[$key] = $this->rewriteValue($item);
        }

        return $value;
    }

    private function toRootRelative(string $url): string
    {
        if (! ApplicationUrl::isSameSiteUrl($url)) {
            return $url;
        }

        $parts = parse_url($url);

        if (! is_array($parts)) {
            return $url;
        }

        $path = (string) ($parts['path'] ?? '/');

        if ($path === '') {
            $path = '/';
        }

        if (! str_starts_with($path, '/')) {
            $path = '/'.$path;
        }

        if (PathPageUrl::shouldAppendTrailingSlash($path)) {
            $path = str_ends_with($path, '/') ? $path : $path.'/';
        }

        $query = isset($parts['query']) && $parts['query'] !== '' ? '?'.$parts['query'] : '';
        $fragment = isset($parts['fragment']) && $parts['fragment'] !== '' ? '#'.$parts['fragment'] : '';

        return $path.$query.$fragment;
    }
}
