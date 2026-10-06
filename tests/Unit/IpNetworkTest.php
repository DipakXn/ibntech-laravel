<?php

namespace Tests\Unit;

use App\Services\Analytics\IpNetwork;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class IpNetworkTest extends TestCase
{
    public function test_addresses_normalize_to_a_canonical_form(): void
    {
        $this->assertSame('203.0.113.10', IpNetwork::normalize(' 203.0.113.10 '));
        $this->assertSame('2001:db8::1', IpNetwork::normalize('2001:0db8:0000:0000:0000:0000:0000:0001'));
        $this->assertSame('203.0.113.10', IpNetwork::normalize('::ffff:203.0.113.10'));
        $this->assertSame('203.0.113.0/24', IpNetwork::normalize('203.0.113.10/24'));
        $this->assertSame('2001:db8::/32', IpNetwork::normalize('2001:0db8::1/32'));
        $this->assertSame('127.0.0.1', IpNetwork::normalize('127.0.0.1/32'));
    }

    #[DataProvider('networks')]
    public function test_rules_match_only_addresses_inside_the_network(string $rule, string $ip, bool $matches): void
    {
        $this->assertSame($matches, IpNetwork::contains($rule, $ip));
    }

    /**
     * @return array<string, array{0: string, 1: string, 2: bool}>
     */
    public static function networks(): array
    {
        return [
            'exact ipv4' => ['203.0.113.10', '203.0.113.10', true],
            'different ipv4' => ['203.0.113.10', '203.0.113.11', false],
            'exact ipv6' => ['2001:db8::1', '2001:0db8:0:0:0:0:0:1', true],
            'different ipv6' => ['2001:db8::1', '2001:db8::2', false],
            'ipv4 cidr inside' => ['203.0.113.0/24', '203.0.113.98', true],
            'ipv4 cidr boundary' => ['203.0.113.0/24', '203.0.113.255', true],
            'ipv4 cidr outside' => ['203.0.113.0/24', '203.0.114.1', false],
            'ipv6 cidr inside' => ['2001:db8::/32', '2001:db8:1::5', true],
            'ipv6 cidr outside' => ['2001:db8::/32', '2001:db9::1', false],
            'mapped ipv4 matches ipv4 rule' => ['114.143.174.98', '::ffff:114.143.174.98', true],
        ];
    }

    #[DataProvider('invalid')]
    public function test_invalid_addresses_and_ranges_are_rejected(string $value): void
    {
        $this->assertNull(IpNetwork::normalize($value));
    }

    /**
     * @return array<string, array{0: string}>
     */
    public static function invalid(): array
    {
        return [
            'empty' => [''],
            'hostname' => ['office.ibntech.com'],
            'octet' => ['999.1.1.1'],
            'incomplete' => ['203.0.113'],
            'ipv4 prefix' => ['203.0.113.0/33'],
            'ipv6 prefix' => ['2001:db8::/129'],
            'word prefix' => ['203.0.113.10/abc'],
            'extra slash' => ['203.0.113.10/24/1'],
            'spaces' => ['203.0.113.10 /24'],
            'wildcard' => ['203.0.113.*'],
        ];
    }
}
