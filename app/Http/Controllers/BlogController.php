<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\BlogService;
use App\Services\SeoService;
use App\Support\BlogCategoryUrl;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    public function __construct(
        protected BlogService $blogService,
        protected SeoService $seoService
    ) {}

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
        return $this->showCategory($request, $slug, null);
    }

    public function categoryPage(Request $request, string $slug, int $page): Response|RedirectResponse
    {
        return $this->showCategory($request, $slug, $page);
    }

    public function show(string $slug): Response
    {
        $blog = $this->blogService->getPublishedBySlug($slug);

        abort_unless($blog, 404);

        $latestPosts = $this->blogService->latestPublished(6);

        return response()->view('blog.templates.'.$blog->template, compact('blog', 'latestPosts'));
    }

    protected function showCategory(Request $request, string $slug, ?int $page): Response|RedirectResponse
    {
        $category = Category::query()
            ->forModule(Category::MODULE_BLOG)
            ->where('slug', $slug)
            ->firstOrFail();

        if ($request->query->has('page')) {
            return $this->redirectLegacyCategoryPage($request, $category->slug);
        }

        if ($page === 1) {
            return redirect()->to(BlogCategoryUrl::for($category->slug), 301);
        }

        $currentPage = $page ?? 1;

        $blogs = $this->blogService->paginatePublishedForCategoryIds(
            $category->selfAndDescendantIds(),
            15,
            $currentPage,
            rtrim(BlogCategoryUrl::for($category->slug), '/')
        );

        $extraQuery = collect($request->query())->except('page')->all();
        if ($extraQuery !== []) {
            $blogs->appends($extraQuery);
        }

        if ($blogs->currentPage() > max($blogs->lastPage(), 1)) {
            abort(404);
        }

        $isPaginated = $currentPage > 1;
        $titleBase = $category->name.' Blog';
        $metaTitle = $isPaginated
            ? $titleBase.' - Page '.$currentPage.' | '.config('app.name')
            : $titleBase.' | '.config('app.name');
        $metaDescription = $isPaginated
            ? 'Page '.$currentPage.' of latest '.$category->name.' articles and resources from our team.'
            : 'Latest '.$category->name.' articles and resources from our team.';

        $this->seoService->setCurrent([
            'meta_title' => $metaTitle,
            'meta_description' => $metaDescription,
            'og_title' => $isPaginated ? $category->name.' - Page '.$currentPage : $category->name,
            'og_description' => $metaDescription,
            'canonical_url' => $blogs->url($currentPage),
            'link_prev' => $blogs->previousPageUrl(),
            'link_next' => $blogs->nextPageUrl(),
        ]);

        return response()->view('blog.category', compact('blogs', 'category'));
    }

    protected function redirectLegacyCategoryPage(Request $request, string $slug): RedirectResponse
    {
        $legacyPage = (int) $request->query('page');
        $url = BlogCategoryUrl::for($slug, $legacyPage > 1 ? $legacyPage : 1);
        $extraQuery = collect($request->query())->except('page')->all();

        if ($extraQuery !== []) {
            $url .= (str_contains($url, '?') ? '&' : '?').http_build_query($extraQuery);
        }

        return redirect()->to($url, 301);
    }
}
