<?php

namespace App\Support\Sitemap;

class RobotsTxtSitemapDirective
{
    /**
     * Keep every existing robots.txt directive intact and only manage the
     * Sitemap line. Duplicate Sitemap lines are removed. The URL must be
     * supplied by the caller from the current environment's APP_URL.
     */
    public static function apply(string $contents, bool $addDirective, ?string $sitemapUrl): string
    {
        $contents = str_replace(["\r\n", "\r"], "\n", $contents);
        $lines = explode("\n", $contents);
        $kept = [];

        foreach ($lines as $line) {
            if (preg_match('/^\s*sitemap\s*:/i', $line) === 1) {
                continue;
            }

            $kept[] = $line;
        }

        while ($kept !== [] && trim((string) end($kept)) === '') {
            array_pop($kept);
        }

        if ($addDirective && is_string($sitemapUrl) && trim($sitemapUrl) !== '') {
            if ($kept !== []) {
                $kept[] = '';
            }

            $kept[] = 'Sitemap: '.trim($sitemapUrl);
        }

        return implode("\n", $kept)."\n";
    }
}
