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
    }
}
