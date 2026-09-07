<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class SmoothScrollToSectionAssetTest extends TestCase
{
    protected function projectPath(string $relative): string
    {
        return dirname(__DIR__, 2).DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $relative);
    }

    public function test_global_app_bundle_imports_the_opt_in_scroll_utility(): void
    {
        $appJs = file_get_contents($this->projectPath('resources/js/app.js'));
        $utilityJs = file_get_contents($this->projectPath('resources/js/smooth-scroll-to-section.js'));

        $this->assertIsString($appJs);
        $this->assertIsString($utilityJs);
        $this->assertStringContainsString("import './smooth-scroll-to-section';", $appJs);
        $this->assertStringContainsString('[data-scroll-target]', $utilityJs);
        $this->assertStringContainsString('[data-scroll-anchor=', $utilityJs);
        $this->assertStringContainsString('prefers-reduced-motion', $utilityJs);
        $this->assertStringContainsString('addEventListener(\'click\'', $utilityJs);
        $this->assertStringNotContainsString('a[href^="#"]', $utilityJs);
        $this->assertStringNotContainsString('a[href*="#"]', $utilityJs);
        $this->assertStringNotContainsString('hashchange', $utilityJs);
        $this->assertStringNotContainsString('location.hash', $utilityJs);
    }

    public function test_site_layouts_load_the_global_javascript_bundle(): void
    {
        $appLayout = file_get_contents($this->projectPath('resources/views/layouts/app.blade.php'));
        $landingLayout = file_get_contents($this->projectPath('resources/views/layouts/landing.blade.php'));

        $this->assertIsString($appLayout);
        $this->assertIsString($landingLayout);
        $this->assertStringContainsString('resources/js/app.js', $appLayout);
        $this->assertStringContainsString('resources/js/app.js', $landingLayout);
    }
}
