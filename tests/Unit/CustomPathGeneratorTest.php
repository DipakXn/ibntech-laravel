<?php

namespace Tests\Unit;

use App\Models\Blog;
use App\Models\WebsiteSetting;
use App\Support\MediaLibrary\CustomPathGenerator;
use App\Support\MediaLibrary\MediaPathResolver;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class CustomPathGeneratorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('media-library.disk_name', 'media');
        config()->set('filesystems.disks.media', [
            'driver' => 'local',
            'root' => storage_path('framework/testing/disks/media'),
            'url' => '/uploads',
            'visibility' => 'public',
        ]);

        Storage::fake('media');
    }

    public function test_it_builds_purpose_based_paths_for_new_media(): void
    {
        $media = new Media();
        $media->id = 999;
        $media->disk = 'media';
        $media->collection_name = 'featured_image';
        $media->model_type = Blog::class;
        $media->file_name = 'banner.jpg';
        $media->created_at = CarbonImmutable::create(2026, 5, 7, 10, 30, 0);

        $generator = new CustomPathGenerator();

        $this->assertSame('blogs/featured/2026/05/', $generator->getPath($media));
        $this->assertSame('blogs/featured/2026/05/conversions/', $generator->getPathForConversions($media));
        $this->assertSame('blogs/featured/2026/05/responsive-images/', $generator->getPathForResponsiveImages($media));
    }

    public function test_it_maps_website_logos_without_date_segments(): void
    {
        $path = MediaPathResolver::resolve(
            modelType: WebsiteSetting::class,
            collection: 'site_logo',
        );

        $this->assertSame('logos/website', $path);
    }

    public function test_it_keeps_legacy_year_month_paths_when_files_still_exist_there(): void
    {
        Storage::disk('media')->put('media/2026/05/banner.jpg', 'existing');

        $media = new Media();
        $media->id = 845;
        $media->disk = 'media';
        $media->collection_name = 'featured_image';
        $media->model_type = Blog::class;
        $media->file_name = 'banner.jpg';
        $media->created_at = CarbonImmutable::create(2026, 5, 7, 10, 30, 0);
        $media->exists = true;

        $generator = new CustomPathGenerator();

        $this->assertSame('media/2026/05/', $generator->getPath($media));
    }
}
