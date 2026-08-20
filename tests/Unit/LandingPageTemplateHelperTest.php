<?php

namespace Tests\Unit;

use App\Helpers\TemplateHelper;
use Tests\TestCase;

class LandingPageTemplateHelperTest extends TestCase
{
    public function test_it_discovers_landing_page_templates_from_blade_files(): void
    {
        $options = TemplateHelper::landingPageTemplateOptions();

        $this->assertArrayHasKey('vapt-audit-services', $options);
        $this->assertSame('Vapt Audit Services', $options['vapt-audit-services']);
        $this->assertArrayHasKey('cloud-consulting-services', $options);
        $this->assertArrayHasKey('construction-engineering-services', $options);
        $this->assertArrayHasKey('cyber-security-services-india', $options);
        $this->assertArrayHasKey('cybersecurity-services', $options);
        $this->assertArrayHasKey('managed-soc-services', $options);
        $this->assertArrayHasKey('office-365-migration-consulting', $options);
        $this->assertArrayHasKey('soc-calculator', $options);
        $this->assertArrayHasKey('thank-you', $options);
        $this->assertArrayHasKey('cybersecurity-thank-you', $options);
        $this->assertArrayNotHasKey('campaign', $options);
    }
}
