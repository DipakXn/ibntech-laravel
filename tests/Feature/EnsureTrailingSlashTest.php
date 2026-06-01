<?php

namespace Tests\Feature;

use App\Http\Middleware\EnsureTrailingSlash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class EnsureTrailingSlashTest extends TestCase
{
    public function test_it_redirects_safe_requests_to_trailing_slash_urls(): void
    {
        $response = $this->get('/up?ref=seo');

        $response->assertStatus(301);
        $this->assertSame(url('/up').'/?ref=seo', $response->headers->get('Location'));
    }

    public function test_trailing_slash_urls_are_normalized_without_redirecting(): void
    {
        $middleware = new EnsureTrailingSlash();
        $request = Request::create('/up/', 'GET');

        $response = $middleware->handle($request, function (Request $request): Response {
            return response($request->getPathInfo());
        });

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('/up', $response->getContent());
    }

    public function test_asset_like_paths_are_excluded_from_redirects(): void
    {
        $middleware = new EnsureTrailingSlash();
        $request = Request::create('/assets/styles.css', 'GET');

        $response = $middleware->handle($request, function (Request $request): Response {
            return response($request->getPathInfo());
        });

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('/assets/styles.css', $response->getContent());
    }
}
