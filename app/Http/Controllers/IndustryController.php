<?php

namespace App\Http\Controllers;

use App\Services\IndustryService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class IndustryController extends Controller
{
    public function __construct(protected IndustryService $industryService)
    {
    }

    public function show(string $slug): Response
    {
        $industry = $this->industryService->getPublishedIndustryBySlug($slug);

        abort_unless($industry, 404);
        abort_unless(View::exists('industries.'.$industry->template), 404);

        return response()->view('industries.'.$industry->template, compact('industry'));
    }
}
