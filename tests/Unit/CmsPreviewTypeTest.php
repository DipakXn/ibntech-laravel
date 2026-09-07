<?php

namespace Tests\Unit;

use App\CmsPreview\CmsPreviewType;
use App\Support\PathPageUrl;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CmsPreviewTypeTest extends TestCase
{
    #[Test]
    public function it_registers_all_ten_cms_content_types(): void
    {
        $this->assertSame([
            'page',
            'blog',
            'article',
            'case-study',
            'press-release',
            'ebook',
            'white-paper',
            'landing-page',
            'newsletter',
            'industry',
        ], CmsPreviewType::values());
    }

    #[Test]
    public function preview_paths_do_not_receive_trailing_slashes(): void
    {
        $this->assertFalse(PathPageUrl::shouldAppendTrailingSlash('/preview/blog/1'));
        $this->assertFalse(PathPageUrl::shouldAppendTrailingSlash('/preview/page/12'));
        $this->assertTrue(PathPageUrl::shouldAppendTrailingSlash('/blog/example-post'));
    }
}
