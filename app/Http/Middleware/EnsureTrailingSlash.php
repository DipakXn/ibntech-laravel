<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTrailingSlash
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethodSafe()) {
            return $next($request);
        }

        $path = $request->getPathInfo();

        if ($path === '/' || $this->isAssetRequest($path)) {
            return $next($request);
        }

        if (! str_ends_with($path, '/')) {
            $queryString = $request->getQueryString();
            $target = rtrim($request->getUriForPath($path), '/').'/';

            if ($queryString !== null && $queryString !== '') {
                $target .= '?'.$queryString;
            }

            return redirect()->to($target, 301);
        }

        return $next($this->normalizeRequestPath($request, $path));
    }

    protected function isAssetRequest(string $path): bool
    {
        $lastSegment = basename($path);

        return (bool) preg_match('/\.[A-Za-z0-9]{1,10}$/', $lastSegment);
    }

    protected function normalizeRequestPath(Request $request, string $path): Request
    {
        $normalizedPath = rtrim($path, '/');
        $queryString = $request->getQueryString();
        $server = $request->server->all();

        $server['REQUEST_URI'] = $normalizedPath;
        $server['PATH_INFO'] = $normalizedPath;

        if ($queryString !== null && $queryString !== '') {
            $server['REQUEST_URI'] .= '?'.$queryString;
            $server['QUERY_STRING'] = $queryString;
        }

        return $request->duplicate(
            server: $server,
        );
    }
}
