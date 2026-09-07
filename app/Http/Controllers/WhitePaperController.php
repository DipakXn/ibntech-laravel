<?php

namespace App\Http\Controllers;

use App\CmsPreview\CmsContentRenderer;
use App\Http\Controllers\Concerns\PaginatesWithPathPages;
use App\Services\SeoService;
use App\Services\WhitePaperService;
use App\Support\PathPageUrl;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WhitePaperController extends Controller
{
    use PaginatesWithPathPages;

    public function __construct(
        protected WhitePaperService $whitePaperService,
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
        $whitePaper = $this->whitePaperService->getPublishedBySlug($slug);

        abort_unless($whitePaper, 404);

        return $this->renderer->render($whitePaper);
    }

    protected function showIndex(Request $request, ?int $page): Response|RedirectResponse
    {
        $resolved = $this->listingPageOrRedirect(
            $request,
            $page,
            'white-papers.index',
            'white-papers.page'
        );

        if ($resolved instanceof RedirectResponse) {
            return $resolved;
        }

        $whitePapers = $this->whitePaperService->paginatePublished(
            page: $resolved,
            path: rtrim(PathPageUrl::forRoute('white-papers.index', 'white-papers.page'), '/')
        );
        $this->appendListingQuery($whitePapers, $request);
        $this->abortIfListingPageOutOfRange($whitePapers);
        $this->setPathPaginatedSeo(
            $whitePapers,
            $resolved,
            'White Papers',
            'Research-led white papers, reports, and strategic resources from the team.'
        );

        return response()->view('white-papers.index', compact('whitePapers'));
    }
}
