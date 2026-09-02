<?php

namespace Tests\Unit;

use App\Helpers\TemplateHelper;
use Tests\TestCase;

class NewsletterTemplateHelperTest extends TestCase
{
    public function test_it_discovers_newsletter_templates_from_blade_files(): void
    {
        $options = TemplateHelper::newsletterTemplateOptions();

        $this->assertArrayHasKey('vciso-as-a-service', $options);
        $this->assertArrayHasKey('securing-enterprise-ai-data-protection-prompt-integrity-and-governance-at-scale', $options);
        $this->assertArrayHasKey('cloud-misconfiguration-insights-why-secure-architectures-still-fail-in-aws-azure', $options);
        $this->assertArrayNotHasKey('index', $options);
        $this->assertArrayNotHasKey('stage-1', $options);
        $this->assertArrayNotHasKey('sidebar', $options);
    }
}
