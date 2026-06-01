<?php

namespace Tests\Unit;

use App\Support\MediaLibrary\CustomPathGenerator;
use Carbon\CarbonImmutable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class CustomPathGeneratorTest extends TestCase
{
    public function test_it_builds_year_and_month_based_paths(): void
    {
        config()->set('media-library.prefix', 'media');

        $media = new Media();
        $media->id = 999;
        $media->collection_name = 'featured_image';
        $media->created_at = CarbonImmutable::create(2026, 5, 7, 10, 30, 0);

        $generator = new CustomPathGenerator();

        $this->assertSame('media/2026/05/', $generator->getPath($media));
        $this->assertSame('media/2026/05/conversions/', $generator->getPathForConversions($media));
        $this->assertSame('media/2026/05/responsive-images/', $generator->getPathForResponsiveImages($media));
    }

    public function test_it_uses_the_same_date_path_for_gallery_media(): void
    {
        config()->set('media-library.prefix', 'media');

        $media = new Media();
        $media->id = 845;
        $media->collection_name = 'gallery';
        $media->created_at = CarbonImmutable::create(2026, 5, 7, 10, 30, 0);

        $generator = new CustomPathGenerator();

        $this->assertSame('media/2026/05/', $generator->getPath($media));
    }
}
