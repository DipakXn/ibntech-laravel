<?php

namespace Tests\Feature;

use App\CmsPreview\CmsPreviewType;
use App\Filament\Resources\Blogs\Pages\ListBlogs;
use App\Models\Blog;
use App\Models\User;
use App\Repositories\BlogRepository;
use App\Services\CmsPreviewService;
use App\Services\Sitemap\SitemapService;
use App\Support\Sitemap\SitemapType;
use App\Support\Sitemap\SitemapUrlNormalizer;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ContentTrashTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        Filament::setCurrentPanel('admin');
    }

    /**
     * @return array<string, array{0: string}>
     */
    public static function contentModules(): array
    {
        $cases = [];

        foreach (CmsPreviewType::cases() as $type) {
            $cases[$type->value] = [$type->value];
        }

        return $cases;
    }

    #[DataProvider('contentModules')]
    public function test_trashed_records_are_hidden_from_all_tab_and_public_queries(string $type): void
    {
        $previewType = CmsPreviewType::from($type);
        $modelClass = $previewType->modelClass();

        $active = $modelClass::query()->create($this->attributes($previewType, 'Active '.$type));
        $trashed = $modelClass::query()->create($this->attributes($previewType, 'Trashed '.$type));
        $trashed->delete();

        $this->assertNull($modelClass::query()->whereKey($trashed->getKey())->first());
        $this->assertNotNull($modelClass::query()->whereKey($active->getKey())->first());
        $this->assertNotNull($modelClass::withTrashed()->whereKey($trashed->getKey())->first());

        $this->assertNull(app(CmsPreviewService::class)->find($previewType, $trashed->getKey()));
        $this->assertNotNull(app(CmsPreviewService::class)->find($previewType, $active->getKey()));
    }

    public function test_trash_tab_lists_only_trashed_records_and_supports_restore_and_permanent_delete(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $active = Blog::query()->create($this->attributes(CmsPreviewType::Blog, 'Active blog'));
        $trashed = Blog::query()->create($this->attributes(CmsPreviewType::Blog, 'Trashed blog'));
        $trashed->delete();

        $this->actingAs($admin);

        Livewire::test(ListBlogs::class)
            ->assertCanSeeTableRecords([$active])
            ->assertCanNotSeeTableRecords([$trashed])
            ->set('activeTab', 'trash')
            ->assertCanSeeTableRecords([$trashed])
            ->assertCanNotSeeTableRecords([$active])
            ->assertTableBulkActionVisible('restore')
            ->assertTableBulkActionVisible('forceDelete')
            ->assertTableBulkActionHidden('trash')
            ->callTableAction('restore', $trashed)
            ->assertNotified();

        $this->assertFalse($trashed->fresh()->trashed());

        $trashed->delete();

        Livewire::test(ListBlogs::class)
            ->set('activeTab', 'trash')
            ->callTableAction('forceDelete', $trashed)
            ->assertNotified();

        $this->assertModelMissing($trashed);
    }

    public function test_bulk_move_to_trash_soft_deletes_selected_records(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $first = Blog::query()->create($this->attributes(CmsPreviewType::Blog, 'Bulk trash one'));
        $second = Blog::query()->create($this->attributes(CmsPreviewType::Blog, 'Bulk trash two'));

        $this->actingAs($admin);

        Livewire::test(ListBlogs::class)
            ->callTableBulkAction('trash', [$first, $second])
            ->assertNotified();

        $this->assertSoftDeleted($first);
        $this->assertSoftDeleted($second);
    }

    public function test_trashed_blogs_are_excluded_from_repository_and_sitemap_collection(): void
    {
        $published = Blog::query()->create(array_merge($this->attributes(CmsPreviewType::Blog, 'Published blog'), [
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]));
        $trashed = Blog::query()->create(array_merge($this->attributes(CmsPreviewType::Blog, 'Trashed published blog'), [
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]));
        $trashed->delete();

        $repository = app(BlogRepository::class);

        $this->assertNotNull($repository->findPublishedBySlug($published->slug));
        $this->assertNull($repository->findPublishedBySlug($trashed->slug));
        $this->assertFalse(
            $repository->latestPublished(10)->pluck('slug')->contains($trashed->slug),
        );

        $sitemapLocs = collect(app(SitemapService::class)->entriesFor(SitemapType::Blogs))
            ->map(fn ($entry) => $entry->loc)
            ->all();

        $publishedUrl = CmsPreviewType::Blog->publicUrl($published);
        $trashedUrl = CmsPreviewType::Blog->publicUrl($trashed);

        $this->assertTrue(collect($sitemapLocs)->contains(
            fn (string $loc): bool => SitemapUrlNormalizer::cmsUrlsMatch($publishedUrl, $loc),
        ));
        $this->assertFalse(collect($sitemapLocs)->contains(
            fn (string $loc): bool => SitemapUrlNormalizer::cmsUrlsMatch($trashedUrl, $loc),
        ));
    }

    public function test_non_administrator_cannot_access_administrator_only_listing(): void
    {
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);

        $this->actingAs($author);

        $this->get(CmsPreviewType::Page->filamentResource()::getUrl('index'))->assertForbidden();
    }

    /**
     * @return array<string, mixed>
     */
    protected function attributes(CmsPreviewType $type, string $title): array
    {
        $attributes = [
            'title' => $title,
            'slug' => str($title)->slug()->toString(),
            'status' => 'draft',
            'published_at' => null,
        ];
        $paragraph = [['type' => 'paragraph', 'data' => ['content' => '<p>'.$title.'</p>']]];

        return match ($type) {
            CmsPreviewType::Page => $attributes + ['template' => 'about'],
            CmsPreviewType::Blog => $attributes + ['template' => 'default', 'content' => $paragraph],
            CmsPreviewType::Article => $attributes + ['template' => 'default', 'content' => $paragraph],
            CmsPreviewType::CaseStudy => $attributes + ['template' => 'default', 'content' => $paragraph],
            CmsPreviewType::PressRelease => $attributes + ['template' => 'default', 'content' => $paragraph],
            CmsPreviewType::Ebook => $attributes + ['template' => 'default', 'content' => $paragraph],
            CmsPreviewType::WhitePaper => $attributes + ['template' => 'default', 'content' => $paragraph],
            CmsPreviewType::LandingPage => $attributes + ['template' => 'vapt-audit-services'],
            CmsPreviewType::Newsletter => $attributes + ['template' => 'vciso-as-a-service'],
            CmsPreviewType::Industry => $attributes + ['template' => 'real-estate-and-construction'],
        };
    }
}
