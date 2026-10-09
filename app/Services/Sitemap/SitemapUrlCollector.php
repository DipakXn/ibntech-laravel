<?php

namespace App\Services\Sitemap;

use App\CmsPreview\CmsPreviewType;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\WhitePaper;
use App\Support\BlogCategoryUrl;
use App\Support\PathPageUrl;
use App\Support\Sitemap\SitemapCustomUrls;
use App\Support\Sitemap\SitemapEligibility;
use App\Support\Sitemap\SitemapType;
use App\Support\Sitemap\SitemapUrlEntry;
use App\Support\Sitemap\SitemapUrlNormalizer;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SitemapUrlCollector
{
    /**
     * Catch-all page slugs that are not served as CMS pages.
     *
     * @var list<string>
     */
    private const RESERVED_PAGE_SLUGS = [
        'admin',
        'article',
        'blog',
        'case-study',
        'ebook',
        'ibn-tech-cms-login',
        'industry',
        'lp',
        'newsletter',
        'pressrelease',
        'press-releases',
        'preview',
        'whitepapers',
        'livewire',
        'storage',
        'up',
    ];

    public function __construct(private readonly SitemapSettings $settings) {}

    /**
     * @return list<SitemapUrlEntry>
     */
    public function collect(SitemapType $type): array
    {
        if (! $this->settings->typeEnabled($type)) {
            return [];
        }

        return match ($type) {
            SitemapType::Pages => $this->collectPages(),
            SitemapType::Blogs => $this->collectPreviewType(CmsPreviewType::Blog, Blog::query(), $type),
            SitemapType::BlogCategories => $this->collectBlogCategories(),
            SitemapType::Articles => $this->collectPreviewType(CmsPreviewType::Article, Article::query(), $type),
            SitemapType::CaseStudies => $this->collectPreviewType(CmsPreviewType::CaseStudy, CaseStudy::query(), $type),
            SitemapType::Ebooks => $this->collectPreviewType(CmsPreviewType::Ebook, Ebook::query(), $type),
            SitemapType::WhitePapers => $this->collectPreviewType(CmsPreviewType::WhitePaper, WhitePaper::query(), $type),
            SitemapType::PressReleases => $this->collectPreviewType(CmsPreviewType::PressRelease, PressRelease::query(), $type),
            SitemapType::Industries => $this->collectPreviewType(CmsPreviewType::Industry, Industry::query(), $type),
            SitemapType::LandingPages => $this->collectPreviewType(CmsPreviewType::LandingPage, LandingPage::query(), $type),
            SitemapType::Newsletters => $this->collectPreviewType(CmsPreviewType::Newsletter, Newsletter::query(), $type),
            SitemapType::Custom => $this->collectCustomUrls(),
        };
    }

    /**
     * @return list<SitemapUrlEntry>
     */
    private function collectPages(): array
    {
        $entries = $this->collectStaticHubs();

        Page::query()
            ->published()
            ->with('seoMeta')
            ->orderBy('id')
            ->chunkById(500, function ($pages) use (&$entries): void {
                foreach ($pages as $page) {
                    $slug = (string) $page->slug;

                    if ($slug === 'home' || in_array($slug, self::RESERVED_PAGE_SLUGS, true)) {
                        continue;
                    }

                    $entry = $this->entryForPreviewModel(CmsPreviewType::Page, $page, SitemapType::Pages);

                    if ($entry instanceof SitemapUrlEntry) {
                        $entries[] = $entry;
                    }
                }
            });

        return $this->uniqueByLoc($entries);
    }

    /**
     * @return list<SitemapUrlEntry>
     */
    private function collectStaticHubs(): array
    {
        $entries = [];
        $hubs = config('sitemap.static_hubs', []);

        foreach ($hubs as $hub) {
            if (! is_array($hub) || ! is_string($hub['route'] ?? null)) {
                continue;
            }

            $routeName = $hub['route'];

            if ($routeName === 'home') {
                $home = Page::query()->published()->with('seoMeta')->where('slug', 'home')->first();

                if ($home instanceof Page) {
                    $entry = $this->entryForPreviewModel(CmsPreviewType::Page, $home, SitemapType::Pages, $this->hubPriority($hub));

                    if ($entry instanceof SitemapUrlEntry) {
                        $entries[] = $entry;
                    }

                    continue;
                }
            }

            $loc = SitemapUrlNormalizer::cmsLoc(
                $routeName === 'home'
                    ? url('/')
                    : PathPageUrl::withTrailingSlash(route($routeName))
            );

            if ($loc === null) {
                continue;
            }

            $entries[] = $this->settings->applyToggles(
                new SitemapUrlEntry(
                    loc: $loc,
                    lastmod: null,
                    changefreq: $this->settings->typeChangefreq(SitemapType::Pages),
                    priority: $this->hubPriority($hub) ?? $this->settings->typePriority(SitemapType::Pages),
                ),
                SitemapType::Pages,
            );
        }

        return $entries;
    }

    /**
     * @param  Builder<Model>  $query
     * @return list<SitemapUrlEntry>
     */
    private function collectPreviewType(CmsPreviewType $previewType, Builder $query, SitemapType $type): array
    {
        $entries = [];

        $query
            ->published()
            ->with('seoMeta')
            ->chunkById(500, function ($models) use (&$entries, $previewType, $type): void {
                foreach ($models as $model) {
                    $entry = $this->entryForPreviewModel($previewType, $model, $type);

                    if ($entry instanceof SitemapUrlEntry) {
                        $entries[] = $entry;
                    }
                }
            });

        return $entries;
    }

    /**
     * @return list<SitemapUrlEntry>
     */
    private function collectBlogCategories(): array
    {
        $entries = [];

        Category::query()
            ->forModule(Category::MODULE_BLOG)
            ->orderBy('id')
            ->chunkById(500, function ($categories) use (&$entries): void {
                foreach ($categories as $category) {
                    $categoryIds = $category->selfAndDescendantIds();

                    if (! $this->categoryHasEligiblePublishedPosts($categoryIds)) {
                        continue;
                    }

                    $loc = SitemapUrlNormalizer::cmsLoc(BlogCategoryUrl::for((string) $category->slug));

                    if ($loc === null) {
                        continue;
                    }

                    $entries[] = $this->settings->applyToggles(
                        new SitemapUrlEntry(
                            loc: $loc,
                            lastmod: $category->updated_at,
                            changefreq: $this->settings->typeChangefreq(SitemapType::BlogCategories),
                            priority: $this->settings->typePriority(SitemapType::BlogCategories),
                        ),
                        SitemapType::BlogCategories,
                    );
                }
            });

        return $entries;
    }

    /**
     * @return list<SitemapUrlEntry>
     */
    private function collectCustomUrls(): array
    {
        $entries = [];

        foreach ($this->settings->customUrls() as $row) {
            if (! is_array($row)) {
                continue;
            }

            $entry = SitemapCustomUrls::toEntry($row);

            if (! $entry instanceof SitemapUrlEntry || $this->matchesPublishedPage($entry->loc)) {
                continue;
            }

            $entries[] = $this->settings->applyToggles($entry, SitemapType::Custom);
        }

        return $entries;
    }

    private function entryForPreviewModel(
        CmsPreviewType $previewType,
        Model $model,
        SitemapType $type,
        ?string $priorityOverride = null,
    ): ?SitemapUrlEntry {
        $publicUrl = $previewType->publicUrl($model);

        if (! SitemapEligibility::allows($model, $publicUrl)) {
            return null;
        }

        $loc = SitemapUrlNormalizer::cmsLoc($publicUrl);

        if ($loc === null) {
            return null;
        }

        [$changefreq, $priority] = $this->sitemapHints($model, $type, $priorityOverride);

        return $this->settings->applyToggles(
            new SitemapUrlEntry(
                loc: $loc,
                lastmod: $this->lastmodFor($model),
                changefreq: $changefreq,
                priority: $priority,
            ),
            $type,
        );
    }

    /**
     * @return array{0: ?string, 1: ?string}
     */
    private function sitemapHints(Model $model, SitemapType $type, ?string $priorityOverride): array
    {
        $changefreq = $this->settings->typeChangefreq($type);
        $priority = $priorityOverride ?? $this->settings->typePriority($type);

        if ($type !== SitemapType::Pages) {
            return [$changefreq, $priority];
        }

        $seoMeta = $model->relationLoaded('seoMeta') ? $model->seoMeta : null;
        $overrideFrequency = is_string($seoMeta?->sitemap_changefreq)
            ? strtolower(trim($seoMeta->sitemap_changefreq))
            : '';

        if ($overrideFrequency !== '' && in_array($overrideFrequency, config('sitemap.changefreq_values', []), true)) {
            $changefreq = $overrideFrequency;
        }

        $overridePriority = SitemapType::normalizePriority($seoMeta?->sitemap_priority);

        if ($overridePriority !== null) {
            $priority = $overridePriority;
        }

        return [$changefreq, $priority];
    }

    /**
     * @param  list<SitemapUrlEntry>  $entries
     * @return list<SitemapUrlEntry>
     */
    private function uniqueByLoc(array $entries): array
    {
        $seen = [];
        $unique = [];

        foreach ($entries as $entry) {
            if (isset($seen[$entry->loc])) {
                continue;
            }

            $seen[$entry->loc] = true;
            $unique[] = $entry;
        }

        return $unique;
    }

    private function matchesPublishedPage(string $loc): bool
    {
        $candidate = SitemapUrlNormalizer::cmsLoc($loc);

        if ($candidate === null) {
            return false;
        }

        foreach ($this->publishedPageLocs() as $pageLoc) {
            if ($pageLoc === $candidate) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return list<string>
     */
    private function publishedPageLocs(): array
    {
        $locs = [];

        Page::query()
            ->published()
            ->orderBy('id')
            ->select(['id', 'slug', 'status'])
            ->chunkById(500, function ($pages) use (&$locs): void {
                foreach ($pages as $page) {
                    $loc = SitemapUrlNormalizer::cmsLoc(CmsPreviewType::Page->publicUrl($page));

                    if ($loc !== null) {
                        $locs[] = $loc;
                    }
                }
            });

        return $locs;
    }

    private function lastmodFor(Model $model): ?DateTimeInterface
    {
        $seoMeta = $model->relationLoaded('seoMeta') ? $model->seoMeta : null;
        $modifiedAt = $seoMeta?->modified_at;

        if ($modifiedAt instanceof DateTimeInterface) {
            return $modifiedAt;
        }

        $updatedAt = $model->getAttribute('updated_at');

        if ($updatedAt instanceof DateTimeInterface) {
            return $updatedAt;
        }

        if (method_exists($model, 'publishedAt')) {
            $publishedAt = $model->publishedAt();

            if ($publishedAt instanceof DateTimeInterface) {
                return $publishedAt;
            }
        }

        $publishedAt = $model->getAttribute('published_at');

        return $publishedAt instanceof DateTimeInterface ? $publishedAt : null;
    }

    /**
     * @param  array<string, mixed>  $hub
     */
    private function hubPriority(array $hub): ?string
    {
        return SitemapType::normalizePriority($hub['priority'] ?? null);
    }

    /**
     * Blog categories have no SeoMeta; eligibility follows their published posts.
     *
     * @param  list<int>  $categoryIds
     */
    private function categoryHasEligiblePublishedPosts(array $categoryIds): bool
    {
        $previewType = CmsPreviewType::Blog;
        $hasEligible = false;

        Blog::query()
            ->published()
            ->with('seoMeta')
            ->whereIn('category_id', $categoryIds)
            ->orderBy('id')
            ->chunkById(100, function ($blogs) use ($previewType, &$hasEligible): void {
                if ($hasEligible) {
                    return;
                }

                foreach ($blogs as $blog) {
                    $publicUrl = $previewType->publicUrl($blog);

                    if (SitemapEligibility::allows($blog, $publicUrl)) {
                        $hasEligible = true;

                        return;
                    }
                }
            });

        return $hasEligible;
    }
}
