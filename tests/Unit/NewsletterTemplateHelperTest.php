<?php

namespace Tests\Unit;

use App\Helpers\TemplateHelper;
use Tests\TestCase;

class NewsletterTemplateHelperTest extends TestCase
{
    public function test_it_discovers_newsletter_templates_from_blade_files(): void
    {
        $options = TemplateHelper::newsletterTemplateOptions();

        $this->assertArrayHasKey('cloud-misconfiguration-insights-why-secure-architectures-still-fail-in-aws-azure', $options);
    }
}
