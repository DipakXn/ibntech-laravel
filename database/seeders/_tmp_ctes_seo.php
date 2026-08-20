<?php

use App\Models\Page;
use App\Models\SeoMeta;

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$page = Page::query()->where('slug', 'construction-takeoff-estimation-services')->first();

if (! $page) {
    fwrite(STDERR, "PAGE MISSING\n");
    exit(1);
}

SeoMeta::query()->updateOrCreate(
    [
        'metable_type' => Page::class,
        'metable_id' => $page->id,
    ],
    [
        'meta_title' => 'Construction Takeoff and Estimation Services in USA | IBN Technologies',
        'meta_description' => 'IBN Technologies provides accurate construction takeoff and cost estimation services with BIM expertise. Improve bidding, reduce errors, and streamline costs with precise material takeoff for projects in the US and UAE.',
        'og_title' => 'Construction Takeoff and Estimation Services in USA | IBN Technologies',
        'og_description' => 'IBN Technologies provides accurate construction takeoff and cost estimation services with BIM expertise. Improve bidding, reduce errors, and streamline costs with precise material takeoff for projects in the US and UAE.',
        'canonical_url' => 'https://www.ibntech.com/construction-takeoff-estimation-services/',
    ]
);

echo 'SEO OK for page '.$page->id.PHP_EOL;
