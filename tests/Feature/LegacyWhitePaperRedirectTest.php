<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LegacyWhitePaperRedirectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{0: string, 1: string}>
     */
    public static function legacyWhitePaperRedirects(): array
    {
        return [
            'white paper 2' => [
                '/white-paper-2/',
                '/whitepapers/how-cfos-benefit-from-profitcents/',
            ],
            'white paper 3' => [
                '/white-paper-3/',
                '/whitepapers/how-ibn-helping-cfos-by-combining-efforts-with-profitcents/',
            ],
        ];
    }

    #[Test]
    #[DataProvider('legacyWhitePaperRedirects')]
    public function slashed_legacy_urls_redirect_permanently_on_http_and_https(string $from, string $to): void
    {
        $this->assertPermanentRedirectTo('http://localhost'.$from, 'http://localhost'.$to);
        $this->assertPermanentRedirectTo('https://localhost'.$from, 'https://localhost'.$to);
    }

    #[Test]
    #[DataProvider('legacyWhitePaperRedirects')]
    public function destinations_do_not_redirect_back_to_the_legacy_urls(string $from, string $to): void
    {
        $httpDestination = $this->get('http://localhost'.$to);
        $httpsDestination = $this->get('https://localhost'.$to);

        $this->assertDoesNotRedirectTo($httpDestination, $from);
        $this->assertDoesNotRedirectTo($httpsDestination, $from);
    }

    #[Test]
    #[DataProvider('legacyWhitePaperRedirects')]
    public function unslashed_legacy_urls_only_gain_a_trailing_slash(string $from, string $to): void
    {
        $unslashed = rtrim($from, '/');

        $this->assertPermanentRedirectTo('http://localhost'.$unslashed, 'http://localhost'.$from);
        $this->assertPermanentRedirectTo('https://localhost'.$unslashed, 'https://localhost'.$from);
    }

    #[Test]
    public function similar_paths_are_not_redirected_to_the_new_white_papers(): void
    {
        $nearMisses = [
            '/white-paper-20/',
            '/white-paper-30/',
            '/white-paper-2/extra/',
            '/white-paper-3/extra/',
        ];

        foreach ($nearMisses as $path) {
            $response = $this->get($path);

            $this->assertNotSame(301, $response->getStatusCode(), $path);
            $location = (string) $response->headers->get('Location');
            $this->assertStringNotContainsString('/whitepapers/how-cfos-benefit-from-profitcents', $location);
            $this->assertStringNotContainsString('/whitepapers/how-ibn-helping-cfos-by-combining-efforts-with-profitcents', $location);
        }
    }

    private function assertPermanentRedirectTo(string $requestUrl, string $expectedUrl): void
    {
        $response = $this->get($requestUrl);

        $response->assertStatus(301);

        $location = (string) $response->headers->get('Location');
        $locationParts = parse_url($location);
        $expectedParts = parse_url($expectedUrl);
        $requestParts = parse_url($requestUrl);

        $this->assertSame($expectedParts['path'], $locationParts['path'] ?? null);
        $this->assertStringEndsWith('/', (string) ($locationParts['path'] ?? ''));

        if (isset($locationParts['scheme'])) {
            $this->assertSame($requestParts['scheme'], $locationParts['scheme']);
            $this->assertSame($requestParts['host'], $locationParts['host']);
            $this->assertSame($expectedUrl, $location);
        } else {
            $this->assertSame($expectedParts['path'], $location);
        }
    }

    private function assertDoesNotRedirectTo(TestResponse $response, string $legacyPath): void
    {
        if (! $response->isRedirect()) {
            $this->assertNotSame(301, $response->getStatusCode());

            return;
        }

        $location = (string) $response->headers->get('Location');
        $path = parse_url($location, PHP_URL_PATH);

        $this->assertNotSame(rtrim($legacyPath, '/'), rtrim((string) $path, '/'));
    }
}
