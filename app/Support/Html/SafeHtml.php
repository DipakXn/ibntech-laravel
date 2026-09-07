<?php

namespace App\Support\Html;

use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

class SafeHtml
{
    public static function sanitizeForRender(?string $html): string
    {
        $html = trim((string) $html);

        if ($html === '') {
            return '';
        }

        $unwrapped = (new UnknownElementUnwrapper)->unwrap($html);

        $config = app(HtmlSanitizerConfig::class)
            ->allowAttribute('data-scroll-target', allowedElements: '*')
            ->allowAttribute('data-scroll-anchor', allowedElements: '*');

        return (new HtmlSanitizer($config))->sanitize($unwrapped);
    }
}
