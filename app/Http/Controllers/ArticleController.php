<?php

namespace App\Http\Controllers;

use App\CmsPreview\CmsContentRenderer;
use App\Http\Controllers\Concerns\PaginatesWithPathPages;
use App\Services\ArticleService;
use App\Services\SeoService;
use App\Support\PathPageUrl;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    use PaginatesWithPathPages;

    public function __construct(
        protected ArticleService $articleService,
        protected SeoService $seoService,
        protected CmsContentRenderer $renderer,
    ) {}

    public function index(Request $request): Response|RedirectResponse
    {
        return $this->showIndex($request, null);
    }

    public function page(Request $request, int $page): Response|RedirectResponse
    {
        return $this->showIndex($request, $page);
    }

    public function show(string $slug): Response
    {
        $article = $this->articleService->getPublishedBySlug($slug);

        abort_unless($article, 404);

        return $this->renderer->render($article);
    }

    protected function showIndex(Request $request, ?int $page): Response|RedirectResponse
    {
        $resolved = $this->listingPageOrRedirect(
            $request,
            $page,
            'articles.index',
            'articles.page'
        );

        if ($resolved instanceof RedirectResponse) {
            return $resolved;
        }

        $articles = $this->articleService->paginatePublished(
            page: $resolved,
            path: rtrim(PathPageUrl::forRoute('articles.index', 'articles.page'), '/')
        );
        $this->appendListingQuery($articles, $request);
        $this->abortIfListingPageOutOfRange($articles);
        $this->setPathPaginatedSeo(
            $articles,
            $resolved,
            'Articles',
            'Browse expert articles, practical explainers, and editorial insights from the team.'
        );

        return response()->view('articles.index', compact('articles'));
    }
}
