<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\BlogService;
use App\Services\SeoService;
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
        $categories = Category::query()
            ->forModule(Category::MODULE_BLOG)
            ->with(['blogs' => fn ($query) => $query->published()->latest()])
            ->withCount(['blogs' => fn ($query) => $query->published()])
            ->latest()
            ->get();
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

    public function category(string $slug): Response
    {
        $category = Category::query()
            ->forModule(Category::MODULE_BLOG)
            ->where('slug', $slug)
            ->firstOrFail();

        $blogs = $this->blogService->paginatePublishedForCategoryIds($category->selfAndDescendantIds());

        $this->seoService->setCurrent([
            'meta_title' => $category->name.' Blog | '.config('app.name'),
            'meta_description' => 'Latest '.$category->name.' articles and resources from our team.',
            'og_title' => $category->name,
            'og_description' => 'Latest '.$category->name.' articles and resources from our team.',
            'canonical_url' => route('blog.category', $category->slug),
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
