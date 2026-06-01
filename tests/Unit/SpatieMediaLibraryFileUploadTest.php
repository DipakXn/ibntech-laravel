<?php

namespace Tests\Unit;

use App\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Mockery;
use Tests\TestCase;

class SpatieMediaLibraryFileUploadTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('filesystems.disks.public', [
            'driver' => 'local',
            'root' => storage_path('framework/testing/disks/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ]);

        $reflection = new \ReflectionClass(SpatieMediaLibraryFileUpload::class);
        $property = $reflection->getProperty('reservedNames');
        $property->setAccessible(true);
        $property->setValue([]);

        Storage::fake('public');
    }

    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }

    public function test_it_sanitizes_original_file_names(): void
    {
        $component = new class ('featured_image') extends SpatieMediaLibraryFileUpload
        {
            public function publicResolveStoredFileName(TemporaryUploadedFile $file): string
            {
                return $this->resolveStoredFileName($file);
            }

            public function getDiskName(): string
            {
                return 'public';
            }
        };

        $file = Mockery::mock(TemporaryUploadedFile::class);
        $file->shouldReceive('getClientOriginalName')->andReturn('My Banner Image.JPG');
        $file->shouldReceive('getClientOriginalExtension')->andReturn('JPG');

        $this->assertSame('my-banner-image.jpg', $component->publicResolveStoredFileName($file));
    }

    public function test_it_appends_a_suffix_when_the_target_month_directory_already_has_the_same_file_name(): void
    {
        Storage::disk('public')->put('media/'.now()->format('Y/m').'/banner.jpg', 'existing');

        $component = new class ('featured_image') extends SpatieMediaLibraryFileUpload
        {
            public function publicResolveStoredFileName(TemporaryUploadedFile $file): string
            {
                return $this->resolveStoredFileName($file);
            }

            public function getDiskName(): string
            {
                return 'public';
            }
        };

        $file = Mockery::mock(TemporaryUploadedFile::class);
        $file->shouldReceive('getClientOriginalName')->andReturn('Banner.jpg');
        $file->shouldReceive('getClientOriginalExtension')->andReturn('jpg');

        $this->assertSame('banner-01.jpg', $component->publicResolveStoredFileName($file));
    }
}
