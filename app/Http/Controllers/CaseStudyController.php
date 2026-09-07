<?php

namespace App\Http\Controllers;

use App\CmsPreview\CmsContentRenderer;
use App\Http\Controllers\Concerns\PaginatesWithPathPages;
use App\Services\CaseStudyService;
use App\Services\SeoService;
use App\Support\PathPageUrl;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CaseStudyController extends Controller
{
    use PaginatesWithPathPages;

    public function __construct(
        protected CaseStudyService $caseStudyService,
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
        $caseStudy = $this->caseStudyService->getPublishedBySlug($slug);

        abort_unless($caseStudy, 404);

        return $this->renderer->render($caseStudy);
    }

    public function download(Request $request, string $slug): RedirectResponse
    {
        abort_unless($request->hasValidSignature(), 403);

        $caseStudy = $this->caseStudyService->getPublishedBySlug($slug);

        abort_unless($caseStudy && $caseStudy->downloadPdfUrl(), 404);

        return redirect()->away($caseStudy->downloadPdfUrl());
    }

    protected function showIndex(Request $request, ?int $page): Response|RedirectResponse
    {
        $resolved = $this->listingPageOrRedirect(
            $request,
            $page,
            'case-studies.index',
            'case-studies.page'
        );

        if ($resolved instanceof RedirectResponse) {
            return $resolved;
        }

        $caseStudies = $this->caseStudyService->paginatePublished(
            page: $resolved,
            path: rtrim(PathPageUrl::forRoute('case-studies.index', 'case-studies.page'), '/')
        );
        $this->appendListingQuery($caseStudies, $request);
        $this->abortIfListingPageOutOfRange($caseStudies);
        $this->setPathPaginatedSeo(
            $caseStudies,
            $resolved,
            'Case Studies',
            'Delivery stories, migration outcomes, and platform transformation case studies.'
        );

        return response()->view('case-studies.index', compact('caseStudies'));
    }
}
