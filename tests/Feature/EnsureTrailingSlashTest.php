<?php

namespace Tests\Feature;

use App\Http\Middleware\EnsureTrailingSlash;
use Illuminate\Http\Request;
use Livewire\Mechanisms\HandleRequests\EndpointResolver;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class EnsureTrailingSlashTest extends TestCase
{
    public function test_it_redirects_safe_requests_to_trailing_slash_urls(): void
    {
        $response = $this->get('/up?ref=seo');

        $response->assertStatus(301);
        $this->assertSame(rtrim(url('/up'), '/').'/?ref=seo', $response->headers->get('Location'));
    }

    public function test_trailing_slash_urls_are_normalized_without_redirecting(): void
    {
        $middleware = new EnsureTrailingSlash;
        $request = Request::create('/up/', 'GET');

        $response = $middleware->handle($request, function (Request $request): Response {
            return response($request->getPathInfo());
        });

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('/up', $response->getContent());
    }

    public function test_asset_like_paths_are_excluded_from_redirects(): void
    {
        $middleware = new EnsureTrailingSlash;
        $request = Request::create('/assets/styles.css', 'GET');

        $response = $middleware->handle($request, function (Request $request): Response {
            return response($request->getPathInfo());
        });

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('/assets/styles.css', $response->getContent());
    }

    public function test_hashed_livewire_endpoints_bypass_trailing_slash_redirects(): void
    {
        $paths = [
            EndpointResolver::scriptPath(false),
            EndpointResolver::scriptPath(true),
            EndpointResolver::updatePath(),
            EndpointResolver::updatePath().'/',
        ];

        foreach ($paths as $path) {
            $response = $this->call('GET', $path);

            $this->assertFalse(
                $response->isRedirection(),
                "{$path} should not receive a trailing-slash redirect (got {$response->getStatusCode()})"
            );
            $this->assertNotSame(301, $response->getStatusCode());
        }
    }

    public function test_hashed_livewire_paths_are_not_normalized(): void
    {
        $middleware = new EnsureTrailingSlash;
        $prefix = EndpointResolver::prefix();

        foreach ([
            $prefix.'/livewire.js',
            $prefix.'/livewire.min.js',
            $prefix.'/update',
            $prefix.'/update/',
        ] as $path) {
            $response = $middleware->handle(Request::create($path, 'GET'), function (Request $request): Response {
                return response($request->getPathInfo());
            });

            $this->assertSame(200, $response->getStatusCode());
            $this->assertSame($path, $response->getContent());
        }
    }
}
