<?php

namespace Tests\Feature;

use App\Models\AnalyticsExcludedIp;
use App\Models\Page;
use App\Models\PageView;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ExcludedIpTrackingTest extends TestCase
{
    use RefreshDatabase;

    private const CHROME = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36';

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();

        Page::query()->create([
            'title' => 'About us',
            'slug' => 'about-us',
            'template' => 'about',
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    public function test_an_exact_ipv4_address_is_not_tracked_and_does_not_receive_a_visitor_cookie(): void
    {
        $this->exclude('203.0.113.10', 'Example address');

        $response = $this->fromAddress('203.0.113.10')->get('/about-us/');

        $response->assertOk();
        $response->assertCookieMissing('ibn_visitor');
        $this->assertSame(0, PageView::query()->count());
    }

    public function test_an_exact_ipv6_address_is_not_tracked(): void
    {
        $this->exclude('2001:db8::1', 'Example IPv6');

        $this->fromAddress('2001:0db8:0000:0000:0000:0000:0000:0001')
            ->get('/about-us/')
            ->assertOk()
            ->assertCookieMissing('ibn_visitor');

        $this->assertSame(0, PageView::query()->count());
    }

    public function test_a_cidr_range_excludes_only_addresses_inside_it(): void
    {
        $this->exclude('203.0.113.0/24', 'Example range');

        $this->fromAddress('203.0.113.98')->get('/about-us/')->assertCookieMissing('ibn_visitor');
        $this->assertSame(0, PageView::query()->count());

        $tracked = $this->fromAddress('203.0.114.10')->get('/about-us/');
        $tracked->assertOk();
        $tracked->assertCookie('ibn_visitor');

        $view = PageView::query()->first();
        $this->assertNotNull($view);
        $stored = json_encode($view->getAttributes());
        $this->assertIsString($stored);
        $this->assertStringNotContainsString('203.0.114.10', $stored);
        $this->assertStringNotContainsString('203.0.113.98', $stored);
    }

    public function test_a_disabled_exclusion_does_not_stop_tracking(): void
    {
        $this->exclude('198.51.100.20', 'Paused office', false);

        $response = $this->fromAddress('198.51.100.20')->get('/about-us/');

        $response->assertOk();
        $response->assertCookie('ibn_visitor');
        $this->assertTrue(Str::isUuid((string) $response->getCookie('ibn_visitor')?->getValue()));
        $this->assertSame(1, PageView::query()->count());
    }

    public function test_multiple_exclusions_match_only_the_enabled_rules(): void
    {
        $this->exclude('114.143.174.98', 'Current office');
        $this->exclude('127.0.0.1', 'Localhost');
        $this->exclude('203.0.113.0/24', 'Example range', false);

        $this->fromAddress('114.143.174.98')->get('/about-us/')->assertCookieMissing('ibn_visitor');
        $this->fromAddress('127.0.0.1')->get('/about-us/')->assertCookieMissing('ibn_visitor');
        $this->fromAddress('203.0.113.10')->get('/about-us/')->assertCookie('ibn_visitor');

        $this->assertSame(1, PageView::query()->count());
    }

    public function test_an_excluded_request_does_not_refresh_an_existing_visitor_cookie(): void
    {
        $this->exclude('114.143.174.98', 'Current office');
        $visitor = (string) Str::uuid();

        $response = $this->fromAddress('114.143.174.98')
            ->withCookie('ibn_visitor', $visitor)
            ->get('/about-us/');

        $response->assertOk();
        $response->assertCookieMissing('ibn_visitor');
        $this->assertSame(0, PageView::query()->count());
    }

    public function test_a_direct_client_ip_is_used_and_a_spoofed_forwarded_header_is_ignored(): void
    {
        $this->exclude('114.143.174.98', 'Current office');

        $response = $this->fromAddress('198.51.100.8')
            ->withHeaders(['X-Forwarded-For' => '114.143.174.98'])
            ->get('/about-us/');

        $response->assertOk();
        $response->assertCookie('ibn_visitor');
        $this->assertSame(1, PageView::query()->count());
        $this->assertVisitorRowDoesNotContain(['198.51.100.8', '114.143.174.98']);
    }

    public function test_cloudflare_traffic_uses_the_real_client_ip_for_exclusion(): void
    {
        $this->exclude('114.143.174.98', 'Current office');

        $publicVisitor = $this->throughCloudflare('203.0.113.50')->get('/about-us/');
        $publicVisitor->assertOk();
        $publicVisitor->assertCookie('ibn_visitor');
        $this->assertSame(1, PageView::query()->count());
        $this->assertVisitorRowDoesNotContain(['203.0.113.50', '173.245.48.1', '114.143.174.98']);

        $officeVisitor = $this->throughCloudflare('114.143.174.98')->get('/about-us/');
        $officeVisitor->assertOk();
        $officeVisitor->assertCookieMissing('ibn_visitor');
        $this->assertSame(1, PageView::query()->count());
    }

    public function test_cloudflare_ignores_a_spoofed_address_prepended_to_the_real_client(): void
    {
        $this->exclude('114.143.174.98', 'Current office');

        $response = $this->throughCloudflare('114.143.174.98, 203.0.113.77')->get('/about-us/');

        $response->assertOk();
        $response->assertCookie('ibn_visitor');
        $this->assertSame(1, PageView::query()->count());
    }

    public function test_an_excluded_client_behind_cloudflare_is_not_tracked_on_ipv6(): void
    {
        $this->exclude('2001:db8::5', 'Example IPv6 client');

        $response = $this->throughCloudflare('2001:db8::5', '2606:4700::1')->get('/about-us/');

        $response->assertOk();
        $response->assertCookieMissing('ibn_visitor');
        $this->assertSame(0, PageView::query()->count());
    }

    public function test_a_non_cloudflare_proxy_cannot_supply_the_client_ip(): void
    {
        $this->exclude('114.143.174.98', 'Current office');

        $response = $this->fromAddress('192.0.2.10')
            ->withHeaders(['X-Forwarded-For' => '114.143.174.98'])
            ->get('/about-us/');

        $response->assertOk();
        $response->assertCookie('ibn_visitor');
        $this->assertSame(1, PageView::query()->count());
        $this->assertVisitorRowDoesNotContain(['192.0.2.10', '114.143.174.98']);
    }

    public function test_a_newly_saved_exclusion_replaces_the_cached_rule_list(): void
    {
        $this->fromAddress('114.143.174.98')->get('/about-us/')->assertCookie('ibn_visitor');
        $this->assertSame(1, PageView::query()->count());

        $this->exclude('114.143.174.98', 'Current office');

        $this->fromAddress('114.143.174.98')->get('/about-us/')->assertCookieMissing('ibn_visitor');
        $this->assertSame(1, PageView::query()->count());
    }

    private function exclude(string $ipAddress, string $description, bool $enabled = true): AnalyticsExcludedIp
    {
        return AnalyticsExcludedIp::query()->create([
            'ip_address' => $ipAddress,
            'description' => $description,
            'is_enabled' => $enabled,
        ]);
    }

    private function fromAddress(string $ipAddress): static
    {
        return $this->withHeaders([
            'User-Agent' => self::CHROME,
        ])->withServerVariables([
            'REMOTE_ADDR' => $ipAddress,
        ]);
    }

    private function throughCloudflare(string $clientIp, string $edgeIp = '173.245.48.1'): static
    {
        return $this->withHeaders([
            'User-Agent' => self::CHROME,
            'X-Forwarded-For' => $clientIp,
        ])->withServerVariables([
            'REMOTE_ADDR' => $edgeIp,
        ]);
    }

    /**
     * @param  list<string>  $addresses
     */
    private function assertVisitorRowDoesNotContain(array $addresses): void
    {
        $stored = json_encode(PageView::query()->first()?->getAttributes());
        $this->assertIsString($stored);

        foreach ($addresses as $address) {
            $this->assertStringNotContainsString($address, $stored);
        }
    }
}
