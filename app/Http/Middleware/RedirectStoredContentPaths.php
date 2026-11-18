<?php

namespace App\Http\Middleware;

use App\Services\ContentSlugRedirector;
use App\Support\PathPageUrl;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectStoredContentPaths
{
    public function __construct(
        private readonly ContentSlugRedirector $redirects,
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethodSafe()) {
            return $next($request);
        }

        $path = $this->redirects->normalize($request->getPathInfo());

        if ($path === null || $this->isIgnored($path)) {
            return $next($request);
        }

        $target = $this->redirects->targetFor($path);

        if ($target === null || $target === $path) {
            return $next($request);
        }

        $location = $target === '/'
            ? url('/')
            : PathPageUrl::withTrailingSlash(url($target));

        $query = $request->getQueryString();

        if ($query !== null && $query !== '') {
            $location .= '?'.$query;
        }

        return redirect()->to($location, 301);
    }

    private function isIgnored(string $path): bool
    {
        $first = strtolower(explode('/', trim($path, '/'))[0] ?? '');

        return in_array($first, ['admin', 'ibn-tech-cms-login', 'livewire', 'preview', 'storage', 'vendor'], true)
            || str_starts_with($first, 'livewire-');
    }
}
