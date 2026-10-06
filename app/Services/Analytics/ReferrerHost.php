<?php

namespace App\Services\Analytics;

final class ReferrerHost
{
    public static function from(?string $referrer): ?string
    {
        if (! is_string($referrer)) {
            return null;
        }

        $referrer = trim($referrer);

        if ($referrer === '') {
            return null;
        }

        $parts = parse_url($referrer);

        if (! is_array($parts)) {
            return null;
        }

        $scheme = strtolower((string) ($parts['scheme'] ?? ''));

        if (! in_array($scheme, ['http', 'https'], true)) {
            return null;
        }

        $host = strtolower(rtrim((string) ($parts['host'] ?? ''), '.'));

        if ($host === '' || preg_match('/^[a-z0-9.-]+$/', $host) !== 1) {
            return null;
        }

        return substr($host, 0, 255);
    }
}
