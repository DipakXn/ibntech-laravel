<?php

namespace Tests\Feature;

use App\Filament\Schemas\ContentBuilder;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\PressRelease;
use App\Models\User;
use App\Models\WhitePaper;
use App\Support\AdditionalAssets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\Attributes\DataProvider;
use ReflectionMethod;
use Tests\TestCase;

class ContentAdditionalAssetsTest extends TestCase
{
    /**
     * @return array<string, array{0: class-string<Model>, 1: string}>
     */
    public static function contentTypes(): array
    {
        return [
            'blog' => [Blog::class, 'blog'],
            'article' => [Article::class, 'articles'],
            'case-study' => [CaseStudy::class, 'case-studies'],
            'ebook' => [Ebook::class, 'ebooks'],
            'press-release' => [PressRelease::class, 'press-releases'],
            'white-paper' => [WhitePaper::class, 'white-papers'],
        ];
    }

    #[DataProvider('contentTypes')]
    public function test_existing_records_keep_content_and_publish_data_when_assets_are_empty(
        string $modelClass,
    ): void {
        $item = $this->makeItem($modelClass);
        $original = $this->snapshotRecord($item);

        $this->assertNull($item->additional_css);
        $this->assertNull($item->additional_js);
        $this->assertSame($original, $this->snapshotRecord($item));
    }

    #[DataProvider('contentTypes')]
    public function test_saving_additional_assets_does_not_rewrite_existing_content(
        string $modelClass,
    ): void {
        $item = $this->makeItem($modelClass);
        $original = $this->snapshotRecord($item);

        $item->additional_css = '<style>.ibn-additional-css { color: red; }</style>';
        $item->additional_js = '<script>window.ibnAdditionalJs = true;</script>';

        $this->assertSame('.ibn-additional-css { color: red; }', $item->additional_css);
        $this->assertSame('window.ibnAdditionalJs = true;', $item->additional_js);
        $this->assertSame($original['content'], $item->getAttributes()['content'] ?? $item->content);
        $this->assertSame($original['published_at'], $item->getAttributes()['published_at'] ?? $item->published_at);
        $this->assertSame($original['title'], $item->title);
        $this->assertSame($original['slug'], $item->slug);
        $this->assertSame($original['status'], $item->status);
    }

    #[DataProvider('contentTypes')]
    public function test_css_and_js_render_only_on_the_matching_detail_page(
        string $modelClass,
        string $viewDirectory,
    ): void {
        $item = $this->makeItem($modelClass);
        $item->additional_css = '<style>.ibn-additional-css { color: navy; }</style>';
        $item->additional_js = '<script>window.ibnAdditionalJs = true;</script>';

        $style = AdditionalAssets::styleTag($item->additional_css);
        $script = AdditionalAssets::scriptTag($item->additional_js);

        $this->assertSame('<style>.ibn-additional-css { color: navy; }</style>', $style);
        $this->assertSame('<script>window.ibnAdditionalJs = true;</script>', $script);

        $layout = File::get(resource_path('views/layouts/app.blade.php'));
        $this->assertStringContainsString("@stack('styles')", $layout);
        $this->assertStringContainsString("@stack('scripts')", $layout);
        $this->assertTrue(
            strpos($layout, '@livewireScripts') < strpos($layout, "@stack('scripts')"),
            'Page-specific JS must load after Livewire.'
        );
        $this->assertTrue(
            strpos($layout, "@stack('scripts')") < strpos($layout, 'custom_body_end_code'),
            'Page-specific JS must load before site-wide body-end code.'
        );

        $this->assertStringContainsString(
            '<x-content-additional-assets',
            File::get(resource_path('views/'.$viewDirectory.'/templates/default.blade.php')),
        );

        foreach ($this->listingTemplatePaths($viewDirectory) as $path) {
            $this->assertStringNotContainsString(
                '<x-content-additional-assets',
                File::get(resource_path('views/'.$path)),
                $path.' must not render additional CSS/JS.'
            );
        }
    }

    public function test_additional_js_is_not_editable_outside_authorized_filament_users(): void
    {
        $canEdit = new ReflectionMethod(ContentBuilder::class, 'canEditAdditionalAssets');
        $canEdit->setAccessible(true);

        $this->assertFalse($canEdit->invoke(null));

        $this->actingAs(new User(['role' => User::ROLE_ADMINISTRATOR]));
        $this->assertTrue($canEdit->invoke(null));

        $this->actingAs(new User(['role' => User::ROLE_AUTHOR]));
        $this->assertTrue($canEdit->invoke(null));

        $this->actingAs(new User(['role' => 'viewer']));
        $this->assertFalse($canEdit->invoke(null));
    }

    /**
     * @param  class-string<Model>  $modelClass
     */
    protected function makeItem(string $modelClass): Model
    {
        $item = new $modelClass([
            'title' => 'Published item',
            'slug' => 'published-item',
            'template' => 'default',
            'content' => [
                [
                    'type' => 'paragraph',
                    'data' => ['content' => '<p>Existing body copy.</p>'],
                ],
            ],
            'status' => 'published',
            'published_at' => '2024-06-15 09:30:00',
        ]);

        $item->syncOriginal();

        return $item;
    }

    /**
     * @return array{title: mixed, slug: mixed, status: mixed, content: mixed, published_at: mixed}
     */
    protected function snapshotRecord(Model $item): array
    {
        return [
            'title' => $item->title,
            'slug' => $item->slug,
            'status' => $item->status,
            'content' => $item->getAttributes()['content'] ?? $item->content,
            'published_at' => $item->getAttributes()['published_at'] ?? $item->published_at,
        ];
    }

    /**
     * @return list<string>
     */
    protected function listingTemplatePaths(string $viewDirectory): array
    {
        $paths = [$viewDirectory.'/index.blade.php'];

        if ($viewDirectory === 'blog') {
            $paths[] = 'blog/category.blade.php';
        }

        return $paths;
    }
}
