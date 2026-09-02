<?php

namespace App\Support\Html;

use Illuminate\Support\HtmlString;

class HtmlCodePreview
{
    public static function make(mixed $html): HtmlString
    {
        $sanitized = SafeHtml::sanitizeForRender(is_string($html) ? $html : '');

        if ($sanitized === '') {
            return new HtmlString(
                '<div class="fi-html-code-preview fi-html-code-preview--empty"><p>Paste HTML to see a sanitized preview.</p></div>'
            );
        }

        return new HtmlString(
            '<div class="fi-html-code-preview content-blocks article-body">'.$sanitized.'</div>'
        );
    }
}
