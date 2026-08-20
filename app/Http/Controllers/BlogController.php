<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\BlogService;
use App\Services\SeoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    public function __construct(
        protected BlogService $blogService,
        protected SeoService $seoService
    ) {
    }

    public function index(Request $request): Response
    {
        $search = trim($request->string('q')->toString());
        $blogs = $this->blogService->paginatePublished(search: $search ?: null);
        $categories = $this->blogService->parentCategoriesForIndex();
        $latestPosts = $this->blogService->latestPublished(6);

        $this->seoService->setCurrent([
            'meta_title' => 'Blog | '.config('app.name'),
            'meta_description' => 'Latest articles and resources from our team.',
            'og_title' => 'Blog',
            'og_description' => 'Latest articles and resources from our team.',
            'canonical_url' => route('blog.index'),
        ]);

        return response()->view('blog.index', compact('blogs', 'categories', 'latestPosts', 'search'));
    }

    public function category(Request $request, string $slug): Response|RedirectResponse
    {
        $category = Category::query()
            ->forModule(Category::MODULE_BLOG)
            ->where('slug', $slug)
            ->firstOrFail();

        // Avoid duplicate URLs for page 1 (?page=1 vs clean category URL).
        if ($request->query('page') === '1') {
            return redirect()->route('blog.category', ['slug' => $category->slug], 301);
        }

        $blogs = $this->blogService->paginatePublishedForCategoryIds(
            $category->selfAndDescendantIds(),
            15
        );

        if ($blogs->currentPage() > max($blogs->lastPage(), 1)) {
            abort(404);
        }

        $page = $blogs->currentPage();
        $isPaginated = $page > 1;
        $titleBase = $category->name.' Blog';
        $metaTitle = $isPaginated
            ? $titleBase.' - Page '.$page.' | '.config('app.name')
            : $titleBase.' | '.config('app.name');
        $metaDescription = $isPaginated
            ? 'Page '.$page.' of latest '.$category->name.' articles and resources from our team.'
            : 'Latest '.$category->name.' articles and resources from our team.';
        $canonicalUrl = $isPaginated
            ? $blogs->url($page)
            : route('blog.category', $category->slug);

        $this->seoService->setCurrent([
            'meta_title' => $metaTitle,
            'meta_description' => $metaDescription,
            'og_title' => $isPaginated ? $category->name.' - Page '.$page : $category->name,
            'og_description' => $metaDescription,
            'canonical_url' => $canonicalUrl,
            'link_prev' => $blogs->previousPageUrl(),
            'link_next' => $blogs->nextPageUrl(),
        ]);

        return response()->view('blog.category', compact('blogs', 'category'));
    }

    public function show(string $slug): Response
    {
        $blog = $this->blogService->getPublishedBySlug($slug);

        abort_unless($blog, 404);

        $latestPosts = $this->blogService->latestPublished(6);

        return response()->view('blog.templates.'.$blog->template, compact('blog', 'latestPosts'));
    }
}
