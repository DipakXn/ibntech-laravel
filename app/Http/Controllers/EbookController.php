<?php

namespace App\Http\Controllers;

use App\Services\EbookService;
use App\Services\SeoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EbookController extends Controller
{
    public function __construct(
        protected EbookService $ebookService,
        protected SeoService $seoService,
    ) {
    }

    public function index(): Response
    {
        $ebooks = $this->ebookService->paginatePublished();

        $this->seoService->setCurrent([
            'meta_title' => 'eBooks | ' . config('app.name'),
            'meta_description' => 'Downloadable guides, migration playbooks, and gated content assets.',
            'og_title' => 'eBooks',
            'og_description' => 'Downloadable guides, migration playbooks, and gated content assets.',
            'canonical_url' => route('ebooks.index'),
        ]);

        return response()->view('ebooks.index', compact('ebooks'));
    }

    public function show(string $slug): Response
    {
        $ebook = $this->ebookService->getPublishedBySlug($slug);

        abort_unless($ebook, 404);

        return response()->view('ebooks.templates.' . $ebook->template, compact('ebook'));
    }

    public function download(Request $request, string $slug): RedirectResponse
    {
        abort_unless($request->hasValidSignature(), 403);

        $ebook = $this->ebookService->getPublishedBySlug($slug);

        abort_unless($ebook && $ebook->downloadPdfUrl(), 404);

        return redirect()->away($ebook->downloadPdfUrl());
    }
}
