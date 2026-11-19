<?php

namespace App\Http\Middleware;

use App\Services\SiteRedirects;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectStoredContentPaths
{
    public function __construct(
        private readonly SiteRedirects $redirects,
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethodSafe()) {
            return $next($request);
        }

        $path = $this->redirects->normalizeSource($request->getPathInfo());

        if ($path === null || $this->isIgnored($path)) {
            return $next($request);
        }

        $match = $this->redirects->resolve($path);

        if ($match === null) {
            return $next($request);
        }

        $this->redirects->recordHit($match['id']);

        if (in_array($match['status'], [410, 451], true)) {
            abort($match['status']);
        }

        if (! in_array($match['status'], [301, 302, 307], true)) {
            return $next($request);
        }

        if ($match['target'] === null || $match['target'] === $path) {
            return $next($request);
        }

        return redirect()->to(
            $this->redirects->location($match['target'], $request->getQueryString()),
            $match['status'],
        );
    }

    private function isIgnored(string $path): bool
    {
        $first = strtolower(explode('/', trim($path, '/'))[0] ?? '');

        return in_array($first, ['admin', 'ibn-tech-cms-login', 'livewire', 'preview', 'storage', 'vendor'], true)
            || str_starts_with($first, 'livewire-');
    }
}
