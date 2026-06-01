<?php

namespace App\Services;

use App\Support\BlockContent;

class AiService
{
    public function generateSeo(string $title, array | string | null $content): array
    {
        $plainText = BlockContent::toPlainText($content);

        return [
            'meta_title' => "{$title} | ".config('app.name'),
            'meta_description' => str($plainText)->limit(160)->toString(),
            'og_title' => $title,
            'og_description' => str($plainText)->limit(200)->toString(),
        ];
    }

    public function suggestKeywords(array | string | null $content): array
    {
        return collect(explode(' ', strtolower(BlockContent::toPlainText($content))))
            ->filter(fn (string $word) => mb_strlen($word) > 4)
            ->countBy()
            ->sortDesc()
            ->keys()
            ->take(10)
            ->values()
            ->all();
    }

    public function contentOptimization(array | string | null $content): array
    {
        $plainText = BlockContent::toPlainText($content);

        return [
            'word_count' => str_word_count($plainText),
            'readability_hint' => 'Use shorter paragraphs and descriptive subheadings.',
            'cta_hint' => 'Include one clear CTA near the top and one near the end.',
        ];
    }
}
