<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\CaseStudyService;
use App\Services\SeoService;
use Illuminate\Http\Response;

class CaseStudyController extends Controller
{
    public function __construct(
        protected CaseStudyService $caseStudyService,
        protected SeoService $seoService,
    ) {
    }

    public function index(): Response
    {
        $caseStudies = $this->caseStudyService->paginatePublished();

        $this->seoService->setCurrent([
            'meta_title' => 'Case Studies | ' . config('app.name'),
            'meta_description' => 'Delivery stories, migration outcomes, and platform transformation case studies.',
            'og_title' => 'Case Studies',
            'og_description' => 'Delivery stories, migration outcomes, and platform transformation case studies.',
            'canonical_url' => route('case-studies.index'),
        ]);

        return response()->view('case-studies.index', compact('caseStudies'));
    }

    public function show(string $slug): Response
    {
        $caseStudy = $this->caseStudyService->getPublishedBySlug($slug);

        abort_unless($caseStudy, 404);

        return response()->view('case-studies.templates.' . $caseStudy->template, compact('caseStudy'));
    }

    public function download(Request $request, string $slug): RedirectResponse
    {
        abort_unless($request->hasValidSignature(), 403);

        $caseStudy = $this->caseStudyService->getPublishedBySlug($slug);

        abort_unless($caseStudy && $caseStudy->downloadPdfUrl(), 404);

        return redirect()->away($caseStudy->downloadPdfUrl());
    }
}
