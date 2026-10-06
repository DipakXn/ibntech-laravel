<?php

namespace App\Services\Analytics;

use Illuminate\Http\Request;
use Livewire\Mechanisms\HandleRequests\EndpointResolver;

final class PublicPageViewGate
{
    /**
     * @var list<string>
     */
    private const PATH_PREFIXES = [
        '/admin',
        '/ibn-tech-cms-login',
        '/preview',
        '/api',
        '/storage',
        '/build',
        '/vendor',
        '/telescope',
        '/horizon',
        '/images',
        '/css',
        '/js',
        '/fonts',
    ];

    public function allows(Request $request): bool
    {
        if (! $request->isMethod('GET') || ! $request->acceptsHtml()) {
            return false;
        }

        if ($request->attributes->get('cmsPreview') === true) {
            return false;
        }

        if ($request->ajax() || $request->headers->has('X-Livewire')) {
            return false;
        }

        if ($this->isPrefetch($request) || ! $this->isDocumentNavigation($request)) {
            return false;
        }

        $path = $this->path($request);

        if ($path === '/up' || $this->hasFileExtension($path) || $this->isExcludedPath($path) || $this->isLivewire($path)) {
            return false;
        }

        if (UserAgentSummary::from($request->userAgent())->isBot) {
            return false;
        }

        $routeName = $request->route()?->getName();

        if (is_string($routeName) && $this->isExcludedRoute($routeName)) {
            return false;
        }

        return true;
    }

    private function path(Request $request): string
    {
        $path = $request->getPathInfo();

        return $path === '' ? '/' : $path;
    }

    private function isExcludedPath(string $path): bool
    {
        foreach (self::PATH_PREFIXES as $prefix) {
            if ($path === $prefix || str_starts_with($path, $prefix.'/')) {
                return true;
            }
        }

        return (bool) preg_match('#/(?:sitemap(?:_index)?\.xml|.+-sitemap\d*\.xml)$#i', $path);
    }

    private function isLivewire(string $path): bool
    {
        if ($path === '/livewire' || str_starts_with($path, '/livewire/') || str_starts_with($path, '/livewire-')) {
            return true;
        }

        $prefix = EndpointResolver::prefix();

        return $path === $prefix || str_starts_with($path, $prefix.'/');
    }

    private function hasFileExtension(string $path): bool
    {
        return (bool) preg_match('/\.[A-Za-z0-9]{1,10}$/', basename($path));
    }

    private function isExcludedRoute(string $routeName): bool
    {
        return str_starts_with($routeName, 'filament.')
            || str_starts_with($routeName, 'livewire.')
            || str_starts_with($routeName, 'sitemap.')
            || str_ends_with($routeName, '.download')
            || in_array($routeName, ['robots', 'cms.preview.show'], true);
    }

    private function isPrefetch(Request $request): bool
    {
        foreach (['Purpose', 'Sec-Purpose', 'X-Purpose', 'X-Moz'] as $header) {
            $value = strtolower((string) $request->headers->get($header, ''));

            if ($value !== '' && (str_contains($value, 'prefetch') || str_contains($value, 'preview'))) {
                return true;
            }
        }

        return false;
    }

    private function isDocumentNavigation(Request $request): bool
    {
        $destination = strtolower((string) $request->headers->get('Sec-Fetch-Dest', ''));

        if ($destination !== '' && $destination !== 'document') {
            return false;
        }

        $mode = strtolower((string) $request->headers->get('Sec-Fetch-Mode', ''));

        return $mode === '' || $mode === 'navigate' || $mode === 'nested-navigate';
    }
}
