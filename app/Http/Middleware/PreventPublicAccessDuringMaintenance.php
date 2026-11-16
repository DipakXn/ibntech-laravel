<?php

namespace App\Http\Middleware;

use App\Filament\Auth\Login;
use App\Models\User;
use App\Services\MaintenanceMode;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Livewire\Mechanisms\HandleRequests\EndpointResolver;
use Symfony\Component\HttpFoundation\Response;

class PreventPublicAccessDuringMaintenance
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! app(MaintenanceMode::class)->enabled() || $this->allows($request)) {
            return $next($request);
        }

        return response()
            ->view('maintenance')
            ->setStatusCode(503)
            ->header('Retry-After', (string) MaintenanceMode::RETRY_AFTER)
            ->header('Cache-Control', 'private, no-store')
            ->header('X-Robots-Tag', 'noindex');
    }

    private function allows(Request $request): bool
    {
        $user = $request->user();

        if ($user instanceof User && $user->isAdministrator()) {
            return true;
        }

        if ($this->isExcludedPath($request)) {
            return true;
        }

        return $this->isLivewireEndpoint($request) && $this->allowsLivewire($request, $user);
    }

    private function allowsLivewire(Request $request, mixed $user): bool
    {
        if ($user instanceof User && $user->canAccessPanel(Filament::getPanel('admin'))) {
            return true;
        }

        return $this->isAuthenticationReferer($request);
    }

    private function isExcludedPath(Request $request): bool
    {
        if ($request->is('up') || $request->is('api') || $request->is('api/*')) {
            return true;
        }

        $path = $this->normalizedPath($request->getPathInfo());

        if ($path === '/'.Login::ROUTE_PATH) {
            return true;
        }

        return str_contains($path, '/password-reset');
    }

    private function isLivewireEndpoint(Request $request): bool
    {
        $path = $request->getPathInfo();
        $prefix = EndpointResolver::prefix();

        if ($path === $prefix || str_starts_with($path, $prefix.'/')) {
            return true;
        }

        return $path === '/livewire' || str_starts_with($path, '/livewire/');
    }

    private function isAuthenticationReferer(Request $request): bool
    {
        $referer = $request->headers->get('referer');

        if (! is_string($referer) || trim($referer) === '') {
            return false;
        }

        $path = parse_url($referer, PHP_URL_PATH);

        if (! is_string($path) || $path === '') {
            return false;
        }

        $path = $this->normalizedPath($path);

        if ($path === '/'.Login::ROUTE_PATH) {
            return true;
        }

        return str_contains($path, '/password-reset');
    }

    private function normalizedPath(string $path): string
    {
        return '/'.trim($path, '/');
    }
}
