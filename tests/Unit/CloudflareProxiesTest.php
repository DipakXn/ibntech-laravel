<?php

namespace Tests\Unit;

use App\Services\Analytics\IpNetwork;
use App\Support\Cloudflare\CloudflareProxies;
use RuntimeException;
use Tests\TestCase;

class CloudflareProxiesTest extends TestCase
{
    public function test_only_explicit_cloudflare_ranges_are_trusted(): void
    {
        $ranges = CloudflareProxies::ranges();

        $this->assertTrue(CloudflareProxies::enabled());
        $this->assertNotContains('*', $ranges);
        $this->assertNotContains('**', $ranges);
        $this->assertTrue($this->rangeCovers($ranges, '173.245.48.1'));
        $this->assertTrue($this->rangeCovers($ranges, '104.16.1.1'));
        $this->assertTrue($this->rangeCovers($ranges, '2606:4700::1'));
        $this->assertFalse($this->rangeCovers($ranges, '192.0.2.10'));
        $this->assertFalse($this->rangeCovers($ranges, '114.143.174.98'));
        $this->assertFalse($this->rangeCovers($ranges, '127.0.0.1'));
    }

    public function test_a_wildcard_proxy_list_is_rejected(): void
    {
        config(['cloudflare.proxies' => ['*']]);

        $this->expectException(RuntimeException::class);

        CloudflareProxies::ranges();
    }

    /**
     * @param  list<string>  $ranges
     */
    private function rangeCovers(array $ranges, string $ip): bool
    {
        foreach ($ranges as $range) {
            if (IpNetwork::contains($range, $ip)) {
                return true;
            }
        }

        return false;
    }
}
