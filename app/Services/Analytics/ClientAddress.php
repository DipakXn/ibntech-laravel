<?php

namespace App\Services\Analytics;

use Illuminate\Http\Request;

/**
 * The visitor address used only to decide whether tracking should be skipped.
 * Laravel trusts a forwarding header only when the connection comes from a
 * configured Cloudflare range. This class does not read X-Forwarded-For itself.
 */
final class ClientAddress
{
    public static function from(Request $request): ?string
    {
        $ip = $request->ip();

        return is_string($ip) && $ip !== '' ? $ip : null;
    }
}
