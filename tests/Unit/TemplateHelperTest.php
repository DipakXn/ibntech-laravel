<?php

namespace Tests\Unit;

use App\Helpers\TemplateHelper;
use Tests\TestCase;

class TemplateHelperTest extends TestCase
{
    public function test_it_discovers_industry_templates_from_blade_files(): void
    {
        $options = TemplateHelper::industryTemplateOptions();

        $this->assertArrayHasKey('real-estate-and-construction', $options);
        $this->assertSame('Real Estate And Construction', $options['real-estate-and-construction']);
        $this->assertArrayHasKey('information-and-communication-technology', $options);
        $this->assertArrayHasKey('travel-and-hospitality', $options);
        $this->assertArrayHasKey('ecommerce-and-retail', $options);
        $this->assertArrayHasKey('legal-firm', $options);
        $this->assertArrayHasKey('manufacturing', $options);
        $this->assertArrayHasKey('chemical-and-energy', $options);
        $this->assertArrayHasKey('healthcare-and-pharma', $options);
        $this->assertArrayHasKey('bfsi', $options);
        $this->assertArrayHasKey('logistics-and-transportation', $options);
    }
}
