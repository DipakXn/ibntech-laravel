<?php

namespace App\Support\Redirects;

use Illuminate\Support\Facades\Route;

class LegacyRouteRedirects
{
    /**
     * Permanent redirects still declared with Route::redirect.
     * The former WordPress rules now live in content_redirects.
     * This only catches a Route::redirect that is still registered, so the
     * manager does not create a second rule for the same source.
     *
     * @return list<array{source: string, target: string, status: int}>
     */
    public static function all(): array
    {
        $redirects = [];

        foreach (Route::getRoutes() as $route) {
            $uses = $route->getAction('uses') ?? $route->getAction('controller');

            if (! is_string($uses) || ! str_contains($uses, 'RedirectController')) {
                continue;
            }

            $destination = $route->defaults['destination'] ?? null;

            if (! is_string($destination) || $destination === '') {
                continue;
            }

            $redirects[] = [
                'source' => '/'.ltrim($route->uri(), '/'),
                'target' => $destination,
                'status' => (int) ($route->defaults['status'] ?? 301),
            ];
        }

        return $redirects;
    }
}
