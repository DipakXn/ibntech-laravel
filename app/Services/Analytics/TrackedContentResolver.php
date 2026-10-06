<?php

namespace App\Services\Analytics;

use App\CmsPreview\CmsPreviewType;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\WhitePaper;
use Illuminate\Database\Eloquent\Model;

final class TrackedContentResolver
{
    /**
     * @var array<string, array{model: class-string<Model>, type: CmsPreviewType, slug?: string}>
     */
    private const ROUTES = [
        'home' => ['model' => Page::class, 'type' => CmsPreviewType::Page, 'slug' => 'home'],
        'page.show' => ['model' => Page::class, 'type' => CmsPreviewType::Page],
        'blog.show' => ['model' => Blog::class, 'type' => CmsPreviewType::Blog],
        'articles.show' => ['model' => Article::class, 'type' => CmsPreviewType::Article],
        'case-studies.show' => ['model' => CaseStudy::class, 'type' => CmsPreviewType::CaseStudy],
        'ebooks.show' => ['model' => Ebook::class, 'type' => CmsPreviewType::Ebook],
        'pressrelease.show' => ['model' => PressRelease::class, 'type' => CmsPreviewType::PressRelease],
        'white-papers.show' => ['model' => WhitePaper::class, 'type' => CmsPreviewType::WhitePaper],
        'industries.show' => ['model' => Industry::class, 'type' => CmsPreviewType::Industry],
        'landing-pages.show' => ['model' => LandingPage::class, 'type' => CmsPreviewType::LandingPage],
        'newsletters.show' => ['model' => Newsletter::class, 'type' => CmsPreviewType::Newsletter],
    ];

    /**
     * @param  array<string, int|string>  $parameters
     * @return array{content_type: ?string, content_id: ?int}
     */
    public function resolve(?string $routeName, array $parameters): array
    {
        $empty = ['content_type' => null, 'content_id' => null];

        if ($routeName === null || ! isset(self::ROUTES[$routeName])) {
            return $empty;
        }

        $definition = self::ROUTES[$routeName];
        $slug = $definition['slug'] ?? ($parameters['slug'] ?? null);

        if (! is_string($slug) || $slug === '') {
            return $empty;
        }

        $id = $definition['model']::query()
            ->published()
            ->where('slug', $slug)
            ->value('id');

        if ($id === null) {
            return $empty;
        }

        return [
            'content_type' => $definition['type']->value,
            'content_id' => (int) $id,
        ];
    }
}
