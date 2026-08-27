<?php

namespace App\Services\WordPress;

class PressReleaseHtmlPreprocessor
{
    public function process(string $html): string
    {
        $html = $this->convertCaptions($html);
        $html = $this->unwrapEmptyAnchors($html);
        $html = $this->stripPresentationalClasses($html);
        $html = $this->promoteAboutHeading($html);
        $html = $this->promoteContactHeading($html);

        return trim($html);
    }

    protected function convertCaptions(string $html): string
    {
        return preg_replace_callback(
            '/\[caption\b[^\]]*\](.*?)\[\/caption\]/is',
            function (array $matches): string {
                $inner = $matches[1];

                if (! preg_match('/<img\b[^>]*>/i', $inner, $imgMatch)) {
                    return trim(strip_tags($inner));
                }

                $img = $imgMatch[0];
                $caption = trim(html_entity_decode(strip_tags(str_replace($img, '', $inner)), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                $figcaption = $caption !== '' ? '<figcaption>'.e($caption).'</figcaption>' : '';

                return '<figure>'.$img.$figcaption.'</figure>';
            },
            $html,
        ) ?? $html;
    }

    protected function unwrapEmptyAnchors(string $html): string
    {
        return preg_replace_callback(
            '/<a(\s[^>]*)?>(.*?)<\/a>/is',
            function (array $matches): string {
                $attributes = $matches[1] ?? '';
                $inner = $matches[2] ?? '';

                if (preg_match('/\bhref\s*=\s*(["\'])(.*?)\1/i', $attributes, $href) && trim($href[2]) !== '') {
                    return $matches[0];
                }

                return $inner;
            },
            $html,
        ) ?? $html;
    }

    protected function stripPresentationalClasses(string $html): string
    {
        return preg_replace(
            '/<(small|span)(\s[^>]*)?\sclass="[^"]*"([^>]*)>/i',
            '<$1$2$3>',
            $html,
        ) ?? $html;
    }

    protected function promoteAboutHeading(string $html): string
    {
        if (preg_match('/<h[2-4][^>]*>\s*(?:<(?:b|strong)>)?\s*About IBN Technologies\s*(?:<\/(?:b|strong)>)?\s*<\/h[2-4]>/i', $html)) {
            return $html;
        }

        return preg_replace(
            '/<(p|div)>\s*(?:<(?:b|strong)>)?\s*About IBN Technologies\s*(?:<\/(?:b|strong)>)?\s*<\/\1>/i',
            '<h3>About IBN Technologies</h3>',
            $html,
            1,
        ) ?? $html;
    }

    protected function promoteContactHeading(string $html): string
    {
        if (preg_match('/<h4[^>]*>\s*Contact Details:?\s*<\/h4>/i', $html)) {
            return $html;
        }

        return preg_replace(
            '/<(p|div)>\s*(?:<(?:b|strong)>)?\s*Contact Details:?\s*(?:<\/(?:b|strong)>)?\s*<\/\1>/i',
            '<h4>Contact Details:</h4>',
            $html,
            1,
        ) ?? $html;
    }
}
