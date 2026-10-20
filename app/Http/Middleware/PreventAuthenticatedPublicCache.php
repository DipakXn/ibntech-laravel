<?php

namespace App\Http\Middleware;

use App\Support\AdminToolbar\AdminToolbar;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Authenticated public HTML includes the admin toolbar and the editor's name.
 * Cloudflare's default cache key ignores cookies, including the session cookie
 * and ibn_visitor, so cookies alone do not stop a shared cache. Symfony's
 * session responses already leave PHPUnit and the browser with
 * private, no-store, and max-age=0. Cloudflare's cache key ignores cookies,
 * including the session cookie and ibn_visitor, so this middleware still sets
 * private and no-store on authenticated public HTML. Symfony normalizes that
 * header and may add max-age=0. Guest responses are not modified.
 */
class PreventAuthenticatedPublicCache
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $this->shouldProtect($request, $response)) {
            return $response;
        }

        $cacheControl = strtolower((string) $response->headers->get('Cache-Control', ''));

        if (str_contains($cacheControl, 'no-store')) {
            return $response;
        }

        $response->headers->set('Cache-Control', 'private, no-store, no-cache, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');

        return $response;
    }

    private function shouldProtect(Request $request, Response $response): bool
    {
        if (! $request->isMethod('GET') || $response->getStatusCode() !== 200) {
            return false;
        }

        if ($request->is('admin') || $request->is('admin/*') || $request->is('ibn-tech-cms-login')) {
            return false;
        }

        if (str_contains(strtolower((string) $response->headers->get('Content-Disposition', '')), 'attachment')) {
            return false;
        }

        if (! $this->isHtml($response) || ! AdminToolbar::shouldRender()) {
            return false;
        }

        return true;
    }

    private function isHtml(Response $response): bool
    {
        $type = strtolower((string) $response->headers->get('Content-Type', ''));

        if (str_contains($type, 'text/html')) {
            return true;
        }

        if ($type !== '') {
            return false;
        }

        $content = $response->getContent();

        return is_string($content) && preg_match('/^\s*</', substr($content, 0, 512)) === 1;
    }
}
