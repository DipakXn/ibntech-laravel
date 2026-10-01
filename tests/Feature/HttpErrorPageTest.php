<?php

namespace Tests\Feature;

use App\Support\HttpErrorPage;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class HttpErrorPageTest extends TestCase
{
    #[Test]
    public function public_error_pages_use_the_site_layout_and_status_copy(): void
    {
        $this->withoutVite();

        foreach (HttpErrorPage::definitions() as $status => $page) {
            $response = $this->renderError($status, '/missing-page/');
            $html = $response->getContent();

            $response->assertStatus($status);
            $this->assertSame(1, substr_count(strtolower($html), '<html'), 'Status '.$status.' rendered more than one document.');
            $response->assertSee('<title>'.$page['meta_title'].'</title>', false);
            $response->assertSee('noindex', false);
            $response->assertSee('class="site-ibn-header"', false);
            $response->assertSee('class="site-footer"', false);
            $response->assertSee('class="error-404"', false);
            $response->assertSee('aria-label="'.$page['code'].'"', false);
            $response->assertSee('<h1>'.$page['title'].'</h1>', false);
            $response->assertSee($page['message']);
            $response->assertSee('fa-solid '.$page['icon'], false);
            $response->assertSee('Back to Homepage', false);
            $response->assertSee('Empowering Business Growth', false);
            $response->assertSee('/images/404-ibn-vector.webp', false);
        }
    }

    #[Test]
    public function the_not_found_page_keeps_its_original_public_copy(): void
    {
        $page = HttpErrorPage::definition(404);

        $this->assertSame('Navigation Error', $page['eyebrow']);
        $this->assertSame('fa-compass-drafting', $page['icon']);
        $this->assertSame('Oops! Page Not Found', $page['title']);
        $this->assertSame(
            "The page you're trying to reach may have been moved, renamed, or no longer exists. Use the button below to head back to the homepage and continue browsing IBN Technologies.",
            $page['message'],
        );
        $this->assertSame('The page you requested could not be found.', $page['meta_description']);
        $this->assertSame('Illustration for page not found', $page['image_alt']);
        $this->assertSame('Page Not Found', $page['admin_title']);
        $this->assertSame('The requested admin page could not be found or is no longer available.', $page['admin_message']);
    }

    #[Test]
    public function admin_error_pages_render_a_single_admin_document(): void
    {
        $this->withoutVite();

        foreach (HttpErrorPage::definitions() as $status => $page) {
            $response = $this->renderError($status, '/admin/missing-page');
            $html = $response->getContent();

            $response->assertStatus($status);
            $this->assertSame(1, substr_count(strtolower($html), '<html'), 'Admin status '.$status.' rendered more than one document.');
            $response->assertSee('<title>'.$page['meta_title'].'</title>', false);
            $response->assertSee('Error '.$page['code'], false);
            $response->assertSee($page['admin_title'], false);
            $response->assertSee($page['admin_message'], false);
            $response->assertSee('Go Back', false);
            $response->assertSee('Admin Dashboard', false);
            $response->assertDontSee('Back to Homepage', false);
            $response->assertDontSee('class="error-404"', false);
        }
    }

    #[Test]
    public function unlisted_statuses_use_the_shared_fallback_pages(): void
    {
        $this->withoutVite();

        $client = $this->renderError(418, '/missing-page/');
        $client->assertStatus(418);
        $client->assertSee('<h1>Request Error</h1>', false);
        $client->assertSee('aria-label="418"', false);
        $client->assertSee('class="site-ibn-header"', false);

        $server = $this->renderError(502, '/missing-page/');
        $server->assertStatus(502);
        $server->assertSee('<h1>Server Error</h1>', false);
        $server->assertSee('aria-label="502"', false);
    }

    #[Test]
    public function json_requests_keep_the_standard_json_error_response(): void
    {
        $request = Request::create('/missing-page/', 'GET', server: [
            'HTTP_ACCEPT' => 'application/json',
        ]);

        $response = app(ExceptionHandler::class)->render($request, new NotFoundHttpException);

        $this->assertSame(404, $response->getStatusCode());
        $this->assertStringContainsString('application/json', (string) $response->headers->get('content-type'));
        $this->assertStringContainsString('"message"', $response->getContent());
    }

    private function renderError(int $status, string $path): TestResponse
    {
        $request = Request::create($path, 'GET');
        $this->app->instance('request', $request);
        app('url')->setRequest($request);

        $response = app(ExceptionHandler::class)->render($request, new HttpException($status));

        return TestResponse::fromBaseResponse($response);
    }
}
