<?php

namespace Tests\Feature;

use App\CmsPreview\CmsPreviewType;
use App\Filament\Actions\ForceDeleteContentAction;
use App\Filament\Actions\MoveToTrashAction;
use App\Filament\Actions\PreviewAction;
use App\Filament\Actions\RestoreContentAction;
use App\Filament\Resources\Articles\Pages\ListArticles;
use App\Filament\Resources\Blogs\Pages\ListBlogs;
use App\Filament\Resources\CaseStudies\Pages\ListCaseStudies;
use App\Filament\Resources\Ebooks\Pages\ListEbooks;
use App\Filament\Resources\Industries\Pages\ListIndustries;
use App\Filament\Resources\LandingPages\Pages\ListLandingPages;
use App\Filament\Resources\Newsletters\Pages\ListNewsletters;
use App\Filament\Resources\Pages\Pages\ListPages;
use App\Filament\Resources\PressReleases\Pages\ListPressReleases;
use App\Filament\Resources\WhitePapers\Pages\ListWhitePapers;
use App\Filament\Tables\ContentRecordActions;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\User;
use App\Models\WhitePaper;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ContentRecordActionsTest extends TestCase
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
    public function test_admin_listings_use_one_actions_dropdown(string $type): void
    {
        $previewType = CmsPreviewType::from($type);
        $record = $this->createRecord($previewType, 'Draft '.$previewType->name.' Actions');
        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $listPage = $this->listPage($previewType);
        $resource = $previewType->filamentResource();

        $this->actingAs($admin);

        $component = Livewire::test($listPage)
            ->assertCanSeeTableRecords([$record])
            ->assertTableFilterExists('status')
            ->assertTableBulkActionExists('trash')
            ->assertTableActionVisible('preview', $record)
            ->assertTableActionVisible('edit', $record)
            ->assertTableActionVisible('trash', $record)
            ->assertTableActionHasLabel('preview', 'Preview', $record)
            ->assertTableActionHasLabel('edit', 'Edit', $record)
            ->assertTableActionHasLabel('trash', 'Move to Trash', $record)
            ->assertTableActionHasIcon('preview', Heroicon::OutlinedEye, $record)
            ->assertTableActionHasIcon('edit', Heroicon::OutlinedPencil, $record)
            ->assertTableActionHasIcon('trash', Heroicon::OutlinedTrash, $record)
            ->assertTableActionHasColor('edit', 'gray', $record)
            ->assertTableActionHasColor('trash', 'danger', $record)
            ->assertTableActionHasUrl(
                'preview',
                route('filament.admin.content-preview', ['type' => $previewType->value, 'id' => $record->getKey()]),
                $record,
            )
            ->assertTableActionShouldOpenUrlInNewTab('preview', $record)
            ->assertTableActionHasUrl('edit', $resource::getUrl('edit', ['record' => $record]), $record)
            ->assertTableActionShouldNotOpenUrlInNewTab('edit', $record)
            ->assertTableActionExists(
                'trash',
                fn (MoveToTrashAction $action): bool => $action->isConfirmationRequired(),
                $record,
            )
            ->set('tableSearch', $record->slug)
            ->assertCanSeeTableRecords([$record])
            ->set('tableSearch', 'missing-record-'.uniqid())
            ->assertCanNotSeeTableRecords([$record])
            ->set('tableSearch', '')
            ->filterTable('status', 'draft')
            ->assertCanSeeTableRecords([$record])
            ->filterTable('status', 'published')
            ->assertCanNotSeeTableRecords([$record])
            ->removeTableFilters();

        $actions = $component->instance()->getTable()->getRecordActions();
        $this->assertCount(1, $actions);
        $this->assertInstanceOf(ActionGroup::class, $actions[0]);
        $this->assertTrue($actions[0]->isButton());
        $this->assertTrue($actions[0]->isOutlined());
        $this->assertSame('Actions', $actions[0]->getLabel());
        $this->assertSame(Heroicon::EllipsisVertical, $actions[0]->getIcon());
        $this->assertSame('Actions', $component->instance()->getTable()->getRecordActionsColumnLabel());
        $this->assertSame(['preview', 'edit', 'trash', 'restore', 'forceDelete'], array_keys($actions[0]->getFlatActions()));
        $this->assertInstanceOf(PreviewAction::class, $actions[0]->getFlatActions()['preview']);
        $this->assertInstanceOf(EditAction::class, $actions[0]->getFlatActions()['edit']);
        $this->assertInstanceOf(MoveToTrashAction::class, $actions[0]->getFlatActions()['trash']);
        $this->assertInstanceOf(RestoreContentAction::class, $actions[0]->getFlatActions()['restore']);
        $this->assertInstanceOf(ForceDeleteContentAction::class, $actions[0]->getFlatActions()['forceDelete']);

        $html = $component->html();
        $this->assertStringContainsString('ibn-content-actions', $html);
        $this->assertStringContainsString('fi-ac-btn-group', $html);
        $this->assertStringContainsString('fi-dropdown', $html);
        $this->assertMatchesRegularExpression('/fi-dropdown-list-item-label">\s*Preview\s*</', $html);
        $this->assertMatchesRegularExpression('/fi-dropdown-list-item-label">\s*Edit\s*</', $html);
        $this->assertMatchesRegularExpression('/fi-dropdown-list-item-label">\s*Move to Trash\s*</', $html);

        $component
            ->callTableAction('trash', $record)
            ->assertNotified();

        $this->assertSoftDeleted($record);
    }

    #[DataProvider('contentModules')]
    public function test_actions_follow_existing_module_permissions(string $type): void
    {
        $previewType = CmsPreviewType::from($type);
        $record = $this->createRecord($previewType, 'Auth '.$previewType->name.' Actions');
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $resource = $previewType->filamentResource();

        $this->actingAs($author);

        if (! $resource::canViewAny()) {
            $this->assertFalse($resource::canEdit($record));
            $this->assertFalse($resource::canDelete($record));
            $this->get($resource::getUrl('index'))->assertForbidden();

            return;
        }

        $this->assertTrue($resource::canEdit($record));
        $this->assertTrue($resource::canDelete($record));

        Livewire::test($this->listPage($previewType))
            ->assertTableActionVisible('preview', $record)
            ->assertTableActionVisible('edit', $record)
            ->assertTableActionVisible('trash', $record)
            ->assertTableActionHasUrl(
                'preview',
                route('filament.admin.content-preview', ['type' => $previewType->value, 'id' => $record->getKey()]),
                $record,
            )
            ->assertTableActionHasUrl('edit', $resource::getUrl('edit', ['record' => $record]), $record);
    }

    public function test_shared_dropdown_is_reused_by_every_content_table(): void
    {
        $group = ContentRecordActions::make();

        $this->assertSame(['preview', 'edit', 'trash', 'restore', 'forceDelete'], array_keys($group->getFlatActions()));
        $this->assertSame('Actions', $group->getLabel());
        $this->assertTrue($group->isButton());
    }

    protected function listPage(CmsPreviewType $type): string
    {
        return match ($type) {
            CmsPreviewType::Page => ListPages::class,
            CmsPreviewType::Blog => ListBlogs::class,
            CmsPreviewType::Article => ListArticles::class,
            CmsPreviewType::CaseStudy => ListCaseStudies::class,
            CmsPreviewType::PressRelease => ListPressReleases::class,
            CmsPreviewType::Ebook => ListEbooks::class,
            CmsPreviewType::WhitePaper => ListWhitePapers::class,
            CmsPreviewType::LandingPage => ListLandingPages::class,
            CmsPreviewType::Newsletter => ListNewsletters::class,
            CmsPreviewType::Industry => ListIndustries::class,
        };
    }

    protected function createRecord(CmsPreviewType $type, string $title): Model
    {
        $attributes = [
            'title' => $title,
            'slug' => str($title)->slug()->toString(),
            'status' => 'draft',
            'published_at' => null,
        ];
        $paragraph = [['type' => 'paragraph', 'data' => ['content' => '<p>'.$title.'</p>']]];

        return match ($type) {
            CmsPreviewType::Page => Page::query()->create($attributes + [
                'template' => 'about',
            ]),
            CmsPreviewType::Blog => Blog::query()->create($attributes + [
                'template' => 'default',
                'content' => $paragraph,
            ]),
            CmsPreviewType::Article => Article::query()->create($attributes + [
                'template' => 'default',
                'content' => $paragraph,
            ]),
            CmsPreviewType::CaseStudy => CaseStudy::query()->create($attributes + [
                'template' => 'default',
                'content' => $paragraph,
            ]),
            CmsPreviewType::PressRelease => PressRelease::query()->create($attributes + [
                'template' => 'default',
                'content' => $paragraph,
            ]),
            CmsPreviewType::Ebook => Ebook::query()->create($attributes + [
                'template' => 'default',
                'content' => $paragraph,
            ]),
            CmsPreviewType::WhitePaper => WhitePaper::query()->create($attributes + [
                'template' => 'default',
                'content' => $paragraph,
            ]),
            CmsPreviewType::LandingPage => LandingPage::query()->create($attributes + [
                'template' => 'vapt-audit-services',
            ]),
            CmsPreviewType::Newsletter => Newsletter::query()->create($attributes + [
                'template' => 'vciso-as-a-service',
            ]),
            CmsPreviewType::Industry => Industry::query()->create($attributes + [
                'template' => 'real-estate-and-construction',
            ]),
        };
    }
}
