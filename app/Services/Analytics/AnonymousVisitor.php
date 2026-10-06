<?php

namespace App\Services\Analytics;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Cookie;

final class AnonymousVisitor
{
    public function id(Request $request): string
    {
        $existing = $request->cookies->get($this->cookieName());

        if (is_string($existing) && Str::isUuid($existing)) {
            return $existing;
        }

        return (string) Str::uuid();
    }

    public function cookie(Request $request, string $visitorId): Cookie
    {
        return cookie(
            $this->cookieName(),
            $visitorId,
            (int) config('analytics.visitor_cookie_minutes'),
            '/',
            null,
            $request->isSecure(),
            true,
            false,
            'lax',
        );
    }

    public function cookieName(): string
    {
        return (string) config('analytics.visitor_cookie');
    }
}
