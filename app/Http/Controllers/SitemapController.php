<?php

namespace App\Http\Controllers;

use App\Services\Sitemap\SitemapService;
use App\Support\Sitemap\SitemapType;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __construct(protected SitemapService $sitemaps) {}

    public function index(): Response
    {
        $xml = $this->sitemaps->indexXml();

        abort_unless(is_string($xml), 404);

        return $this->xmlResponse($xml);
    }

    public function legacyIndex(): Response
    {
        return $this->index();
    }

    public function show(string $file): Response
    {
        $parsed = SitemapType::parseFileName($file);

        abort_unless(is_array($parsed), 404);

        [$type, $part] = $parsed;
        $xml = $this->sitemaps->typeXml($type, $part);

        abort_unless(is_string($xml), 404);

        return $this->xmlResponse($xml);
    }

    protected function xmlResponse(string $xml): Response
    {
        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'no-cache, must-revalidate',
            'Pragma' => 'no-cache',
        ]);
    }
}
