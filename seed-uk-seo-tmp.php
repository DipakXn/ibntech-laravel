<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$page = App\Models\Page::where('slug', 'bookeeping-for-uk')->first();
if (! $page) {
    echo "NO PAGE\n";
    exit(1);
}

echo "page id={$page->id} status={$page->status}\n";

App\Models\SeoMeta::query()->updateOrCreate(
    [
        'metable_type' => App\Models\Page::class,
        'metable_id' => $page->id,
    ],
    [
        'meta_title' => 'Outsourced Bookkeeping Services for UK | Online Bookkeeper',
        'meta_description' => 'Bookkeeping services for UK businesses. IBN Technologies provides accurate, timely bookkeeping outsourced to experts.',
        'og_title' => 'Outsourced Bookkeeping Services for UK | Online Bookkeeper',
        'og_description' => 'Bookkeeping services for UK businesses. IBN Technologies provides accurate, timely bookkeeping outsourced to experts.',
        'canonical_url' => 'https://www.ibntech.com/bookeeping-for-uk/',
    ]
);

echo "SEO saved\n";
