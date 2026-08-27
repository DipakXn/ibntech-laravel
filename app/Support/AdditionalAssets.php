<?php

namespace App\Support;

class AdditionalAssets
{
    public static function normalizeCss(?string $value): ?string
    {
        return self::unwrap($value, 'style');
    }

    public static function normalizeJs(?string $value): ?string
    {
        return self::unwrap($value, 'script');
    }

    public static function styleTag(?string $value): ?string
    {
        $css = self::normalizeCss($value);

        if ($css === null) {
            return null;
        }

        return '<style>'.self::escapeClosingTag($css, 'style').'</style>';
    }

    public static function scriptTag(?string $value): ?string
    {
        $js = self::normalizeJs($value);

        if ($js === null) {
            return null;
        }

        return '<script>'.self::escapeClosingTag($js, 'script').'</script>';
    }

    protected static function unwrap(?string $value, string $tag): ?string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        if (self::hasSingleWrapper($value, $tag)) {
            $value = trim((string) preg_replace(
                '/^<'.$tag.'\b[^>]*>(.*)<\/'.$tag.'>$/is',
                '$1',
                $value,
            ));
        }

        return $value === '' ? null : $value;
    }

    protected static function hasSingleWrapper(string $value, string $tag): bool
    {
        if (! preg_match('/^<'.$tag.'\b[^>]*>.*<\/'.$tag.'>$/is', $value)) {
            return false;
        }

        preg_match_all('/<'.$tag.'\b/i', $value, $opens);
        preg_match_all('/<\/'.$tag.'\b/i', $value, $closes);

        return count($opens[0] ?? []) === 1 && count($closes[0] ?? []) === 1;
    }

    protected static function escapeClosingTag(string $value, string $tag): string
    {
        return preg_replace('/<\/'.$tag.'/i', '<\\/'.$tag, $value) ?? $value;
    }
}
