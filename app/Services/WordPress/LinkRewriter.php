<?php

namespace App\Services\WordPress;

class LinkRewriter
{
    public function rewrite(string $html): string
    {
        return preg_replace_callback(
            '#https?://(?:www\.)?ibntech\.com(/blog/[^"\'\s<]+)#i',
            function (array $matches): string {
                $path = '/'.ltrim($matches[1], '/');

                if (! str_ends_with($path, '/')) {
                    $path .= '/';
                }

                return $path;
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
            $type = $block['type'] ?? null;
            $data = $block['data'] ?? [];

            if ($type === 'paragraph' && isset($data['content'])) {
                $data['content'] = $this->rewrite((string) $data['content']);
            }

            if ($type === 'buttons') {
                foreach ($data['items'] ?? [] as $index => $button) {
                    if (! empty($button['url'])) {
                        $data['items'][$index]['url'] = $this->rewrite((string) $button['url']);
                    }
                }
            }

            $block['data'] = $data;
        }

        return $blocks;
    }
}
