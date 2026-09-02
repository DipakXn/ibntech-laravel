<?php

namespace Tests\Unit;

use App\Support\Html\SafeHtml;
use Tests\TestCase;

class SafeHtmlTest extends TestCase
{
    public function test_it_sanitizes_without_dropping_children_of_unknown_wrappers(): void
    {
        $html = '<span134233117><p>Keep this article body.</p><a href="https://www.ibntech.com/civil-engineering-services/">link</a></span134233117>';

        $sanitized = SafeHtml::sanitizeForRender($html);

        $this->assertStringContainsString('Keep this article body.', $sanitized);
        $this->assertStringContainsString('civil-engineering-services', $sanitized);
        $this->assertStringNotContainsString('span134233117', $sanitized);
    }

    public function test_it_strips_scripts_event_handlers_and_javascript_urls(): void
    {
        $html = '<p>Keep</p><script>alert(1)</script><img src="https://example.com/a.jpg" onerror="alert(1)"><a href="javascript:alert(1)">x</a>';

        $sanitized = strtolower(SafeHtml::sanitizeForRender($html));

        $this->assertStringContainsString('keep', $sanitized);
        $this->assertStringNotContainsString('<script', $sanitized);
        $this->assertStringNotContainsString('onerror', $sanitized);
        $this->assertStringNotContainsString('javascript:', $sanitized);
    }
}
