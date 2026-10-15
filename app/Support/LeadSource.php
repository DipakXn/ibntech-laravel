<?php

namespace App\Support;

final class LeadSource
{
    public const ORGANIC_SEO = 'Organic / SEO';

    public static function displayLabel(?string $leadSource): string
    {
        if (! is_string($leadSource)) {
            return '—';
        }

        $leadSource = trim($leadSource);

        return $leadSource === '' ? '—' : $leadSource;
    }

    public static function emailLabel(?string $leadSource): string
    {
        if (! is_string($leadSource)) {
            return 'Not recorded';
        }

        $leadSource = trim($leadSource);

        return $leadSource === '' ? 'Not recorded' : $leadSource;
    }
}
