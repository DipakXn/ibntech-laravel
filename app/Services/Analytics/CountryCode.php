<?php

namespace App\Services\Analytics;

use Illuminate\Http\Request;

final class CountryCode
{
    /**
     * Cloudflare and CloudFront special codes that are not countries.
     *
     * @var list<string>
     */
    private const UNKNOWN = ['XX', 'T1'];

    public static function fromRequest(Request $request): ?string
    {
        if (! config('analytics.trust_country_headers')) {
            return null;
        }

        foreach (['CF-IPCountry', 'CloudFront-Viewer-Country'] as $header) {
            $value = strtoupper(trim((string) $request->headers->get($header, '')));

            if (preg_match('/^[A-Z]{2}$/', $value) !== 1 || in_array($value, self::UNKNOWN, true)) {
                continue;
            }

            return $value;
        }

        return null;
    }
}
