<?php

namespace App\Http\Controllers;

use App\CmsPreview\CmsContentRenderer;
use App\Services\IndustryService;
use Illuminate\Http\Response;

class IndustryController extends Controller
{
    public function __construct(
        protected IndustryService $industryService,
        protected CmsContentRenderer $renderer,
    ) {}

    public function show(string $slug): Response
    {
        $industry = $this->industryService->getPublishedIndustryBySlug($slug);

        abort_unless($industry, 404);

        return $this->renderer->render($industry);
    }
}
