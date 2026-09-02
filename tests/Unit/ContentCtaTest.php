<?php

namespace Tests\Unit;

use App\Support\ContentCta;
use PHPUnit\Framework\TestCase;

class ContentCtaTest extends TestCase
{
    public function test_it_allows_configured_icons_and_rejects_arbitrary_classes(): void
    {
        $this->assertSame('fa-solid fa-comments', ContentCta::iconClass('comments'));
        $this->assertSame('fa-solid fa-shield-halved', ContentCta::iconClass('fa-solid fa-shield-halved'));
        $this->assertNull(ContentCta::iconClass('script'));
        $this->assertNull(ContentCta::iconClass('<svg>'));
    }

    public function test_it_falls_back_to_navy_for_unknown_themes(): void
    {
        $this->assertSame('green', ContentCta::theme('green'));
        $this->assertSame('navy', ContentCta::theme('magenta'));
        $this->assertSame('navy', ContentCta::theme(null));
    }
}
