<?php

namespace Tests\Unit;

use App\Services\Analytics\AnonymousVisitor;
use App\Services\Analytics\CountryCode;
use App\Services\Analytics\PublicPageViewGate;
use App\Services\Analytics\ReferrerHost;
use App\Services\Analytics\UserAgentSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublicPageViewSignalsTest extends TestCase
{
    private const CHROME = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36';

    public function test_user_agent_summary_classifies_common_clients(): void
    {
        $chrome = UserAgentSummary::from(self::CHROME);
        $this->assertFalse($chrome->isBot);
        $this->assertSame('desktop', $chrome->device);
        $this->assertSame('Chrome', $chrome->browser);
        $this->assertSame('Windows', $chrome->operatingSystem);

        $edge = UserAgentSummary::from(self::CHROME.' Edg/120.0.0.0');
        $this->assertSame('Edge', $edge->browser);

        $iphone = UserAgentSummary::from('Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1');
        $this->assertSame('mobile', $iphone->device);
        $this->assertSame('Safari', $iphone->browser);
        $this->assertSame('iOS', $iphone->operatingSystem);

        $ipad = UserAgentSummary::from('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1');
        $this->assertSame('tablet', $ipad->device);
        $this->assertSame('iOS', $ipad->operatingSystem);

        $android = UserAgentSummary::from('Mozilla/5.0 (Linux; Android 13; Pixel 7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36');
        $this->assertSame('mobile', $android->device);
        $this->assertSame('Chrome', $android->browser);
        $this->assertSame('Android', $android->operatingSystem);

        $cubot = UserAgentSummary::from('Mozilla/5.0 (Linux; Android 10; CUBOT KINGKONG 7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36');
        $this->assertFalse($cubot->isBot);
        $this->assertSame('mobile', $cubot->device);

        $firefox = UserAgentSummary::from('Mozilla/5.0 (X11; Linux x86_64; rv:121.0) Gecko/20100101 Firefox/121.0');
        $this->assertSame('Firefox', $firefox->browser);
        $this->assertSame('Linux', $firefox->operatingSystem);

        $chromeOs = UserAgentSummary::from('Mozilla/5.0 (X11; CrOS x86_64 14541.0.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
        $this->assertSame('ChromeOS', $chromeOs->operatingSystem);
    }

    #[DataProvider('bots')]
    public function test_crawlers_are_detected(string $userAgent): void
    {
        $this->assertTrue(UserAgentSummary::from($userAgent)->isBot);
    }

    /**
     * @return array<string, array{0: string}>
     */
    public static function bots(): array
    {
        return [
            'empty' => [''],
            'googlebot' => ['Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)'],
            'curl' => ['curl/8.0.0'],
            'headless' => ['Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/120.0.0.0 Safari/537.36'],
            'ahrefs' => ['Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)'],
        ];
    }

    public function test_visitor_id_is_a_uuid_and_is_not_derived_from_a_supplied_token(): void
    {
        $request = Request::create('/about-us', 'GET');
        $request->cookies->set('ibn_visitor', 'not-a-uuid');

        $generated = app(AnonymousVisitor::class)->id($request);

        $this->assertTrue(Str::isUuid($generated));
        $this->assertNotSame('not-a-uuid', $generated);

        $request->cookies->set('ibn_visitor', $generated);

        $this->assertSame($generated, app(AnonymousVisitor::class)->id($request));
    }

    public function test_referrer_keeps_only_the_host(): void
    {
        $this->assertSame('www.google.com', ReferrerHost::from('https://www.google.com/search?q=secret'));
        $this->assertSame('example.com', ReferrerHost::from('https://Example.COM:443/path'));
        $this->assertNull(ReferrerHost::from('android-app://com.google.android'));
        $this->assertNull(ReferrerHost::from('not a url'));
        $this->assertNull(ReferrerHost::from(null));
    }

    public function test_country_is_stored_only_from_a_trusted_edge_header(): void
    {
        $request = Request::create('/', 'GET');
        $request->headers->set('CF-IPCountry', 'US');

        config(['analytics.trust_country_headers' => false]);
        $this->assertNull(CountryCode::fromRequest($request));

        config(['analytics.trust_country_headers' => true]);
        $this->assertSame('US', CountryCode::fromRequest($request));

        $request->headers->set('CF-IPCountry', 'XX');
        $request->headers->set('CloudFront-Viewer-Country', 'de');
        $this->assertSame('DE', CountryCode::fromRequest($request));

        $request->headers->set('CloudFront-Viewer-Country', 'T1');
        $this->assertNull(CountryCode::fromRequest($request));

        $request->headers->set('CF-IPCountry', 'USA');
        $request->headers->remove('CloudFront-Viewer-Country');
        $this->assertNull(CountryCode::fromRequest($request));
    }

    #[DataProvider('gateRequests')]
    public function test_gate_allows_only_public_document_navigations(string $path, string $method, array $headers, bool $allowed): void
    {
        $request = Request::create($path, $method);
        $request->headers->set('User-Agent', self::CHROME);

        foreach ($headers as $name => $value) {
            $request->headers->set($name, $value);
        }

        $this->assertSame($allowed, app(PublicPageViewGate::class)->allows($request));
    }

    /**
     * @return array<string, array{0: string, 1: string, 2: array<string, string>, 3: bool}>
     */
    public static function gateRequests(): array
    {
        return [
            'public page' => ['/about-us', 'GET', [], true],
            'page slug that starts like admin' => ['/administration', 'GET', [], true],
            'page slug that starts like preview' => ['/preview-services', 'GET', [], true],
            'admin' => ['/admin', 'GET', [], false],
            'admin section' => ['/admin/users', 'GET', [], false],
            'login' => ['/ibn-tech-cms-login', 'GET', [], false],
            'preview' => ['/preview/page/1', 'GET', [], false],
            'livewire' => ['/livewire/update', 'GET', [], false],
            'hashed livewire' => ['/livewire-abc/update', 'GET', [], false],
            'api' => ['/api/leads', 'GET', [], false],
            'asset directory' => ['/images/logo.webp', 'GET', [], false],
            'javascript' => ['/build/assets/app.js', 'GET', [], false],
            'health' => ['/up', 'GET', [], false],
            'sitemap' => ['/sitemap.xml', 'GET', [], false],
            'post' => ['/about-us', 'POST', [], false],
            'prefetch' => ['/about-us', 'GET', ['Sec-Purpose' => 'prefetch'], false],
            'script destination' => ['/about-us', 'GET', ['Sec-Fetch-Dest' => 'script'], false],
            'ajax' => ['/about-us', 'GET', ['X-Requested-With' => 'XMLHttpRequest'], false],
            'bot' => ['/about-us', 'GET', ['User-Agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1)'], false],
            'json only' => ['/about-us', 'GET', ['Accept' => 'application/json'], false],
        ];
    }
}
