<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\PaginatesWithPathPages;
use App\Services\EbookService;
use App\Services\SeoService;
use App\Support\PathPageUrl;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EbookController extends Controller
{
    use PaginatesWithPathPages;

    public function __construct(
        protected EbookService $ebookService,
        protected SeoService $seoService,
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
        $ebook = $this->ebookService->getPublishedBySlug($slug);

        abort_unless($ebook, 404);

        return response()->view('ebooks.templates.'.$ebook->template, compact('ebook'));
    }

    public function download(Request $request, string $slug): RedirectResponse
    {
        abort_unless($request->hasValidSignature(), 403);

        $ebook = $this->ebookService->getPublishedBySlug($slug);

        abort_unless($ebook && $ebook->downloadPdfUrl(), 404);

        return redirect()->away($ebook->downloadPdfUrl());
    }

    protected function showIndex(Request $request, ?int $page): Response|RedirectResponse
    {
        $resolved = $this->listingPageOrRedirect(
            $request,
            $page,
            'ebooks.index',
            'ebooks.page'
        );

        if ($resolved instanceof RedirectResponse) {
            return $resolved;
        }

        $ebooks = $this->ebookService->paginatePublished(
            page: $resolved,
            path: rtrim(PathPageUrl::forRoute('ebooks.index', 'ebooks.page'), '/')
        );
        $this->appendListingQuery($ebooks, $request);
        $this->abortIfListingPageOutOfRange($ebooks);
        $this->setPathPaginatedSeo(
            $ebooks,
            $resolved,
            'eBooks',
            'Downloadable guides, migration playbooks, and gated content assets.'
        );

        return response()->view('ebooks.index', compact('ebooks'));
    }
}
