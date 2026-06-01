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
    }
}
