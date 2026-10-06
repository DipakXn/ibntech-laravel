<?php

namespace App\Support\Cloudflare;

use RuntimeException;

final class CloudflareProxies
{
    /**
     * @return list<string>
     */
    public static function ranges(): array
    {
        $configured = config('cloudflare.proxies', []);

        if (! is_array($configured)) {
            throw new RuntimeException('Cloudflare proxy ranges must be an explicit list of CIDR blocks.');
        }

        $ranges = [];

        foreach ($configured as $range) {
            if (! is_string($range)) {
                throw new RuntimeException('Cloudflare proxy ranges must be CIDR strings.');
            }

            $range = trim($range);

            if ($range === '' || $range === '*' || $range === '**') {
                throw new RuntimeException('Cloudflare proxy trust cannot use a wildcard. Trust only official Cloudflare ranges.');
            }

            $ranges[] = $range;
        }

        return $ranges;
    }

    public static function enabled(): bool
    {
        return config('cloudflare.trust_proxies') === true && self::ranges() !== [];
    }
}
