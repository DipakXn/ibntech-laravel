<?php

namespace Tests\Feature;

use App\Filament\Resources\Blogs\Pages\EditBlog;
use App\Filament\Resources\MediaLibrary\Pages\ListMediaLibrary;
use App\Filament\Resources\Pages\Pages\EditPage;
use App\Models\Blog;
use App\Models\MediaLibrary;
use App\Models\Page;
use App\Models\User;
use App\Support\MediaLibrary\MediaLibraryCatalog;
use App\Support\MediaLibrary\MediaLibraryCopier;
use App\Support\MediaLibrary\MediaLibraryFileValidator;
use App\Support\MediaLibrary\MediaLibraryUploader;
use App\Support\MediaLibrary\MediaLibraryUsage;
use Filament\Actions\Testing\TestAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class MediaLibraryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        Storage::fake('media');
        config(['cms.legacy_super_admin_emails' => []]);
        Filament::setCurrentPanel('admin');
    }

    public function test_existing_media_is_listed_without_moving_the_file(): void
    {
        $this->actingAs($this->administrator());
        $blog = $this->blog();
        $media = $blog
            ->addMedia(UploadedFile::fake()->image('banner.jpg'))
            ->toMediaCollection('featured_image');
        $path = $media->getPathRelativeToRoot();

        Livewire::test(ListMediaLibrary::class)
            ->assertSee('Media Library')
            ->assertSee('banner.jpg')
            ->assertSee('JPG')
            ->assertSee('ibn-media-card')
            ->assertSee('Details')
            ->assertSee('Public URL')
            ->assertSee('Showing 1 to 1 of 1 results')
            ->assertSee('Per page')
            ->assertSee('Blog: Launch post')
            ->assertSee('/admin/blogs/'.$blog->getKey().'/edit');

        $media->refresh();

        $this->assertSame($path, $media->getPathRelativeToRoot());
        $this->assertStringStartsWith('blogs/featured/', $path);
        $this->assertTrue(Storage::disk('media')->exists($path));
        $this->assertSame(Blog::class, $media->model_type);
    }

    public function test_library_upload_uses_the_library_folder_and_rejects_invalid_files(): void
    {
        $this->actingAs($this->administrator());
        $uploader = app(MediaLibraryUploader::class);
        $media = $uploader->store(UploadedFile::fake()->image('library-photo.jpg'));

        $this->assertSame(MediaLibrary::class, $media->model_type);
        $this->assertSame('library', $media->collection_name);
        $this->assertStringStartsWith('media/library/'.now()->format('Y/m').'/', $media->getPathRelativeToRoot());
        $this->assertTrue(Storage::disk('media')->exists($media->getPathRelativeToRoot()));

        Livewire::test(ListMediaLibrary::class)
            ->assertSee('library-photo.jpg')
            ->assertSee('Not used by content yet.');

        try {
            $uploader->store(UploadedFile::fake()->create('notes.txt', 20, 'text/plain'));
            $this->fail('A text file was stored.');
        } catch (ValidationException $exception) {
            $this->assertStringContainsString('JPG, PNG, GIF, WebP, or PDF', $exception->validator->errors()->first());
        }

        try {
            $uploader->store(UploadedFile::fake()->create('photo.jpg', 20, 'text/plain'));
            $this->fail('A mismatched JPEG was stored.');
        } catch (ValidationException $exception) {
            $this->assertStringContainsString('do not match', $exception->validator->errors()->first());
        }

        try {
            $uploader->store(UploadedFile::fake()->image('big.jpg')->size(MediaLibraryFileValidator::IMAGE_MAX_KILOBYTES + 1));
            $this->fail('An oversized image was stored.');
        } catch (ValidationException $exception) {
            $this->assertStringContainsString('larger than', $exception->validator->errors()->first());
        }

        $this->assertSame(1, Media::query()->where('model_type', MediaLibrary::class)->count());
    }

    public function test_duplicate_library_file_names_do_not_overwrite_the_original(): void
    {
        $uploader = app(MediaLibraryUploader::class);
        $first = $uploader->store(UploadedFile::fake()->image('banner.jpg', 40, 40));
        $original = Storage::disk('media')->get($first->getPathRelativeToRoot());
        $second = $uploader->store(UploadedFile::fake()->image('banner.jpg', 80, 80));

        $this->assertSame('banner.jpg', $first->file_name);
        $this->assertSame('banner-01.jpg', $second->file_name);
        $this->assertSame($original, Storage::disk('media')->get($first->fresh()->getPathRelativeToRoot()));
        $this->assertTrue(Storage::disk('media')->exists($second->getPathRelativeToRoot()));
    }

    public function test_choosing_a_file_copies_it_into_the_record_collection_and_keeps_the_original(): void
    {
        $this->actingAs($this->administrator());
        $source = app(MediaLibraryUploader::class)->store(UploadedFile::fake()->image('shared.jpg'));
        $originalPath = $source->getPathRelativeToRoot();
        $original = Storage::disk('media')->get($originalPath);
        $page = Page::query()->create([
            'title' => 'Payroll tools',
            'slug' => 'payroll-tools',
            'template' => 'default',
            'status' => 'draft',
        ]);

        $copy = app(MediaLibraryCopier::class)->copy($source, $page, 'featured_image', acceptedFileTypes: ['image/*'], maxKilobytes: 4096);

        $this->assertSame($originalPath, $source->fresh()->getPathRelativeToRoot());
        $this->assertSame($original, Storage::disk('media')->get($originalPath));
        $this->assertStringStartsWith('pages/payroll-tools/', $copy->getPathRelativeToRoot());
        $this->assertSame($source->getKey(), $copy->getCustomProperty(MediaLibraryUsage::COPIED_FROM));
        $this->assertSame(Page::class, $copy->model_type);
        $this->assertTrue(Storage::disk('media')->exists($copy->getPathRelativeToRoot()));

        Livewire::test(EditPage::class, ['record' => $page->getKey()])
            ->assertSee('Choose from library');

        $this->assertFalse(app(MediaLibraryUsage::class)->canDelete($source->fresh()));
        Livewire::test(ListMediaLibrary::class)
            ->call('selectMedia', $source->getKey())
            ->assertSee('Copied to')
            ->assertSee('Page: Payroll tools')
            ->assertTableActionHidden('deleteFile', $source);
    }

    public function test_a_pdf_copies_onto_a_pdf_field_and_is_rejected_for_an_image_field(): void
    {
        $source = app(MediaLibraryUploader::class)->store(UploadedFile::fake()->createWithContent(
            'guide.pdf',
            "%PDF-1.4\n1 0 obj<<>>endobj\ntrailer<<>>\n%%EOF\n",
        ));
        $page = Page::query()->create([
            'title' => 'Guides',
            'slug' => 'guides',
            'template' => 'default',
            'status' => 'draft',
        ]);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Choose an image');

        app(MediaLibraryCopier::class)->copy($source, $page, 'featured_image', acceptedFileTypes: ['image/*'], maxKilobytes: 4096);
    }

    public function test_content_block_copy_keeps_the_block_id_and_the_original_file(): void
    {
        $source = app(MediaLibraryUploader::class)->store(UploadedFile::fake()->image('inline.jpg'));
        $originalPath = $source->getPathRelativeToRoot();
        $blog = $this->blog();
        $blockId = 'block-image-1';

        $copy = app(MediaLibraryCopier::class)->copy(
            $source,
            $blog,
            'content_blocks',
            ['block_id' => $blockId],
            ['image/*'],
            4096,
        );

        $blog->update([
            'content' => [
                ['type' => 'image', 'data' => ['block_id' => $blockId, 'alt' => 'Inline']],
            ],
        ]);

        $this->assertNotNull($copy->fresh());
        $this->assertSame($blockId, $copy->fresh()->getCustomProperty('block_id'));
        $this->assertTrue(Storage::disk('media')->exists($originalPath));
        $this->assertStringStartsWith('blogs/blocks/', $copy->getPathRelativeToRoot());

        $blog->update([
            'content' => [
                ['type' => 'paragraph', 'data' => ['content' => '<p>No image</p>']],
            ],
        ]);

        $this->assertSame('paragraph', $blog->fresh()->content[0]['type'] ?? null);
        $this->assertNull($copy->fresh());
        $this->assertTrue(Storage::disk('media')->exists($originalPath));
    }

    public function test_unused_library_files_can_be_deleted_and_content_files_cannot(): void
    {
        $this->actingAs($this->administrator());
        $libraryFile = app(MediaLibraryUploader::class)->store(UploadedFile::fake()->image('unused.jpg'));
        $blog = $this->blog();
        $contentFile = $blog
            ->addMedia(UploadedFile::fake()->image('owned.jpg'))
            ->toMediaCollection('featured_image');

        $usage = app(MediaLibraryUsage::class);

        $this->assertTrue($usage->canDelete($libraryFile));
        $this->assertFalse($usage->canDelete($contentFile));

        Livewire::test(ListMediaLibrary::class)
            ->assertTableActionVisible('deleteFile', $libraryFile)
            ->assertTableActionHidden('deleteFile', $contentFile)
            ->callTableAction('deleteFile', $libraryFile);

        $this->assertNull($libraryFile->fresh());
        $this->assertNotNull($contentFile->fresh());
        $this->assertTrue(Storage::disk('media')->exists($contentFile->getPathRelativeToRoot()));
    }

    public function test_a_library_file_referenced_in_content_cannot_be_deleted(): void
    {
        $source = app(MediaLibraryUploader::class)->store(UploadedFile::fake()->image('cited.jpg'));
        $relative = $source->getPathRelativeToRoot();
        $this->blog()->update([
            'content' => [
                ['type' => 'image', 'data' => ['url' => '/uploads/'.$relative, 'alt' => 'Cited']],
            ],
        ]);

        $reason = app(MediaLibraryUsage::class)->deletionBlockReason($source->fresh());

        $this->assertNotNull($reason);
        $this->assertStringContainsString('Launch post', $reason);
        $this->assertNotNull($source->fresh());
    }

    public function test_blade_files_are_not_imported(): void
    {
        $this->actingAs($this->administrator());
        Storage::disk('media')->put('images/manual-blade.webp', 'blade-only');

        Livewire::test(ListMediaLibrary::class)
            ->assertDontSee('manual-blade.webp');

        $this->assertDatabaseMissing('media', [
            'file_name' => 'manual-blade.webp',
        ]);
    }

    public function test_authors_can_open_the_library_and_guests_cannot(): void
    {
        $this->actingAs($this->author())
            ->get('/admin/media-library')
            ->assertOk();

        auth()->logout();

        $this->get('/admin/media-library')
            ->assertRedirect();
    }

    public function test_authors_can_delete_an_unused_library_file_but_not_a_content_file(): void
    {
        $this->actingAs($this->author());
        $libraryFile = app(MediaLibraryUploader::class)->store(UploadedFile::fake()->image('author-file.jpg'));
        $contentFile = $this->blog()
            ->addMedia(UploadedFile::fake()->image('author-owned.jpg'))
            ->toMediaCollection('featured_image');

        Livewire::test(ListMediaLibrary::class)
            ->assertTableActionVisible('deleteFile', $libraryFile)
            ->assertTableActionHidden('deleteFile', $contentFile);

        Livewire::test(EditBlog::class, ['record' => $contentFile->model_id])
            ->assertSee('Choose from library');
    }

    public function test_the_library_picker_grid_submits_the_selected_media_id(): void
    {
        $this->actingAs($this->administrator());
        $source = app(MediaLibraryUploader::class)->store(UploadedFile::fake()->image('picker-choice.jpg'));
        $page = Page::query()->create([
            'title' => 'Picker page',
            'slug' => 'picker-page',
            'template' => 'default',
            'status' => 'draft',
        ]);

        Livewire::test(EditPage::class, ['record' => $page->getKey()])
            ->assertSee('Choose from library')
            ->mountAction(
                TestAction::make('chooseFromLibrary')->schemaComponent('featured_image'),
            )
            ->assertMountedActionModalSee('picker-choice.jpg')
            ->assertMountedActionModalSee('Search file names')
            ->assertMountedActionModalSee('Type')
            ->assertMountedActionModalSee('Owner')
            ->assertMountedActionModalSee('Per page')
            ->assertMountedActionModalSee('Showing 1 to 1 of 1 results')
            ->set('mountedActions.0.data.media_id', $source->getKey())
            ->callMountedAction();

        $copy = $page->fresh()->getFirstMedia('featured_image');

        $this->assertNotNull($copy);
        $this->assertSame($source->getKey(), $copy->getCustomProperty(MediaLibraryUsage::COPIED_FROM));
        $this->assertSame($source->getPathRelativeToRoot(), $source->fresh()->getPathRelativeToRoot());
        $this->assertTrue(Storage::disk('media')->exists($source->getPathRelativeToRoot()));
    }

    public function test_the_library_picker_paginates_and_filters_by_owner_and_type(): void
    {
        $this->actingAs($this->administrator());
        $uploader = app(MediaLibraryUploader::class);
        $uploader->store(UploadedFile::fake()->image('older-library-file.jpg'));

        foreach (range(2, 11) as $index) {
            $uploader->store(UploadedFile::fake()->image(sprintf('newer-library-file-%02d.jpg', $index)));
        }

        $this->blog()
            ->addMedia(UploadedFile::fake()->image('blog-owned-photo.jpg'))
            ->toMediaCollection('featured_image');

        $pdf = $uploader->store(UploadedFile::fake()->create('kind-doc.pdf', 40, 'application/pdf'));
        $pdf->forceFill(['mime_type' => 'application/pdf'])->save();

        $page = Page::query()->create([
            'title' => 'Filtered picker page',
            'slug' => 'filtered-picker-page',
            'template' => 'default',
            'status' => 'draft',
        ]);

        Livewire::test(EditPage::class, ['record' => $page->getKey()])
            ->mountAction(TestAction::make('chooseFromLibrary')->schemaComponent('featured_image'))
            ->assertMountedActionModalDontSee('older-library-file.jpg')
            ->assertMountedActionModalSee('Showing 1 to 10 of 12 results')
            ->set('mountedActions.0.data.page', 2)
            ->assertMountedActionModalSee('older-library-file.jpg')
            ->assertMountedActionModalSee('Showing 11 to 12 of 12 results')
            ->set('mountedActions.0.data.owner', Blog::class)
            ->set('mountedActions.0.data.page', 1)
            ->assertMountedActionModalSee('blog-owned-photo.jpg')
            ->assertMountedActionModalDontSee('older-library-file.jpg')
            ->set('mountedActions.0.data.owner', '')
            ->set('mountedActions.0.data.kind', 'png')
            ->assertMountedActionModalSee('No matching files')
            ->assertMountedActionModalDontSee('older-library-file.jpg');

        $images = array_column(
            MediaLibraryCatalog::browse(['image/*', 'application/pdf'], search: 'kind-doc', kind: 'image')->items(),
            'name',
        );
        $pdfs = array_column(
            MediaLibraryCatalog::browse(['image/*', 'application/pdf'], search: 'kind-doc', kind: 'pdf')->items(),
            'name',
        );

        $this->assertNotContains('kind-doc.pdf', $images);
        $this->assertContains('kind-doc.pdf', $pdfs);
    }

    private function administrator(): User
    {
        return User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
    }

    private function author(): User
    {
        return User::factory()->create(['role' => User::ROLE_AUTHOR]);
    }

    private function blog(): Blog
    {
        return Blog::query()->create([
            'title' => 'Launch post',
            'slug' => 'launch-post',
            'template' => 'default',
            'content' => [],
            'status' => 'draft',
        ]);
    }
}
