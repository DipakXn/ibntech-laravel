<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Category;
use App\Repositories\BlogRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BlogService
{
    /**
     * Display order for /blog parent category cards.
     *
     * @var list<string>
     */
    public const INDEX_CATEGORY_SLUGS = [
        'cybersecurity',
        'cloud',
        'finance-and-accounting',
        'civil-engineering',
        'back-office-services',
    ];

    public function __construct(
        protected BlogRepository $blogs,
        protected SeoService $seoService
    ) {}

    public function paginatePublished(?string $categorySlug = null, ?string $search = null): LengthAwarePaginator
    {
        return $this->blogs->paginatePublished($categorySlug, $search);
    }

    public function paginatePublishedForCategoryIds(
        array $categoryIds,
        int $perPage = 15,
        int $page = 1,
        ?string $path = null
    ): LengthAwarePaginator {
        return $this->blogs->paginatePublishedForCategoryIds($categoryIds, $perPage, $page, $path);
    }

    public function parentCategoriesForIndex(): Collection
    {
        $categories = Category::query()
            ->forModule(Category::MODULE_BLOG)
            ->roots()
            ->with('childrenRecursive')
            ->get();

        foreach ($categories as $category) {
            $categoryIds = $category->selfAndDescendantIds();

            $publishedBlogsQuery = Blog::query()
                ->published()
                ->whereIn('category_id', $categoryIds)
                ->latest();

            $category->setAttribute('blogs_count', (clone $publishedBlogsQuery)->count());
            $category->setRelation(
                'blogs',
                (clone $publishedBlogsQuery)->with(['category', 'media'])->limit(1)->get()
            );
        }

        return $categories
            ->sortBy(function (Category $category): int {
                $index = array_search($category->slug, self::INDEX_CATEGORY_SLUGS, true);

                return $index === false ? 1000 + (int) $category->id : $index;
            })
            ->values();
    }

    public function getPublishedBySlug(string $slug): ?Blog
    {
        $blog = $this->blogs->findPublishedBySlug($slug);

        if ($blog) {
            $this->seoService->setCurrentForModel($blog);
        }

        return $blog;
    }

    public function latestPublished(int $limit = 3): Collection
    {
        return $this->blogs->latestPublished($limit);
    }
}
