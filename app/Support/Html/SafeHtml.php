<?php

namespace App\Support\Html;

class SafeHtml
{
    public static function sanitizeForRender(?string $html): string
    {
        $html = trim((string) $html);

        if ($html === '') {
            return '';
        }

        $unwrapped = (new UnknownElementUnwrapper)->unwrap($html);

        return (string) str($unwrapped)->sanitizeHtml();
    }
}
