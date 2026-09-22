<?php

namespace Tests\Unit\Sitemap;

use App\Support\Sitemap\RobotsTxtSitemapDirective;
use Tests\TestCase;

class RobotsTxtSitemapDirectiveTest extends TestCase
{
    public function test_it_appends_a_single_sitemap_line_without_changing_rules(): void
    {
        $source = "User-agent: *\nDisallow: /admin\nAllow: /\n";

        $result = RobotsTxtSitemapDirective::apply(
            $source,
            true,
            'http://localhost/sitemap.xml',
        );

        $this->assertStringContainsString("User-agent: *\nDisallow: /admin\nAllow: /", $result);
        $this->assertSame(1, substr_count(strtolower($result), 'sitemap:'));
        $this->assertStringContainsString('Sitemap: http://localhost/sitemap.xml', $result);
    }

    public function test_it_replaces_existing_sitemap_lines_instead_of_duplicating(): void
    {
        $source = "User-agent: *\nDisallow:\nSitemap: https://old.example/sitemap.xml\nSitemap: https://other.example/sitemap.xml\n";

        $result = RobotsTxtSitemapDirective::apply(
            $source,
            true,
            'https://staging.example.test/sitemap.xml',
        );

        $this->assertStringContainsString('User-agent: *', $result);
        $this->assertStringContainsString('Disallow:', $result);
        $this->assertStringNotContainsString('https://old.example/sitemap.xml', $result);
        $this->assertStringNotContainsString('https://other.example/sitemap.xml', $result);
        $this->assertSame(1, substr_count(strtolower($result), 'sitemap:'));
        $this->assertStringContainsString('Sitemap: https://staging.example.test/sitemap.xml', $result);
    }

    public function test_it_removes_sitemap_lines_when_disabled(): void
    {
        $source = "User-agent: googlebot\nDisallow: /\nSitemap: http://localhost/sitemap.xml\n";

        $result = RobotsTxtSitemapDirective::apply($source, false, null);

        $this->assertStringContainsString('User-agent: googlebot', $result);
        $this->assertStringContainsString('Disallow: /', $result);
        $this->assertStringNotContainsString('Sitemap:', $result);
    }
}
