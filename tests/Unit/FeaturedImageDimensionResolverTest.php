<?php

namespace Tests\Unit;

use App\Support\Media\FeaturedImageDimensionResolver;
use Tests\TestCase;

class FeaturedImageDimensionResolverTest extends TestCase
{
    public function test_it_reads_intrinsic_dimensions_from_public_uploads_path(): void
    {
        $logoPath = public_path('uploads/web-img/ibn-logo.webp');

        if (! is_file($logoPath)) {
            $this->markTestSkipped('ibn-logo.webp is not present in this environment.');
        }

        $dimensions = app(FeaturedImageDimensionResolver::class)->fromPublicPath('/uploads/web-img/ibn-logo.webp');

        $this->assertNotNull($dimensions);
        $this->assertSame(512, $dimensions['width']);
        $this->assertSame(182, $dimensions['height']);
    }
}
