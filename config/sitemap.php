<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Sitemap cache
    |--------------------------------------------------------------------------
    |
    | Keys are stored in the default cache store (CACHE_STORE). Prefix is
    | combined with Laravel's cache prefix so local/staging/production stay
    | isolated when they share a cache backend.
    |
    */

    'cache_prefix' => 'sitemap',

    'max_urls_per_file' => 50000,

    'changefreq_values' => [
        'always',
        'hourly',
        'daily',
        'weekly',
        'monthly',
        'yearly',
        'never',
    ],

    /*
    |--------------------------------------------------------------------------
    | Content-type registry
    |--------------------------------------------------------------------------
    |
    | Filenames follow Rank Math-style child sitemaps. Admin Website Settings
    | can override enabled/changefreq/priority per type. Adding a new CMS
    | type still requires a code change here and a collector branch.
    |
    */

    'types' => [
        'pages' => [
            'file' => 'page-sitemap',
            'label' => 'Pages',
            'enabled' => true,
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ],
        'blogs' => [
            'file' => 'post-sitemap',
            'label' => 'Blog posts',
            'enabled' => true,
            'changefreq' => 'weekly',
            'priority' => '0.7',
        ],
        'blog_categories' => [
            'file' => 'category-sitemap',
            'label' => 'Blog categories',
            'enabled' => true,
            'changefreq' => 'weekly',
            'priority' => '0.6',
        ],
        'articles' => [
            'file' => 'article-sitemap',
            'label' => 'Articles',
            'enabled' => true,
            'changefreq' => 'weekly',
            'priority' => '0.7',
        ],
        'case_studies' => [
            'file' => 'case-study-sitemap',
            'label' => 'Case studies',
            'enabled' => true,
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ],
        'ebooks' => [
            'file' => 'ebook-sitemap',
            'label' => 'eBooks',
            'enabled' => true,
            'changefreq' => 'monthly',
            'priority' => '0.6',
        ],
        'white_papers' => [
            'file' => 'white-paper-sitemap',
            'label' => 'White papers',
            'enabled' => true,
            'changefreq' => 'monthly',
            'priority' => '0.6',
        ],
        'press_releases' => [
            'file' => 'press-release-sitemap',
            'label' => 'Press releases',
            'enabled' => true,
            'changefreq' => 'weekly',
            'priority' => '0.6',
        ],
        'industries' => [
            'file' => 'industry-sitemap',
            'label' => 'Industries',
            'enabled' => true,
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ],
        'landing_pages' => [
            'file' => 'lp-sitemap',
            'label' => 'Landing pages',
            'enabled' => true,
            'changefreq' => 'monthly',
            'priority' => '0.6',
        ],
        'newsletters' => [
            'file' => 'newsletter-sitemap',
            'label' => 'Newsletters',
            'enabled' => true,
            'changefreq' => 'monthly',
            'priority' => '0.5',
        ],
        'custom' => [
            'file' => 'custom-sitemap',
            'label' => 'Custom URLs',
            'enabled' => true,
            'changefreq' => 'monthly',
            'priority' => '0.5',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Static listing hubs
    |--------------------------------------------------------------------------
    |
    | Included in page-sitemap.xml. Locations are resolved at runtime via
    | route() / url() so they follow APP_URL in each environment.
    | /newsletter/ is omitted because the listing is hard-coded noindex.
    |
    */

    'static_hubs' => [
        ['route' => 'home', 'priority' => '1.0'],
        ['route' => 'blog.index', 'priority' => '0.8'],
        ['route' => 'articles.index', 'priority' => '0.7'],
        ['route' => 'case-studies.index', 'priority' => '0.7'],
        ['route' => 'ebooks.index', 'priority' => '0.7'],
        ['route' => 'white-papers.index', 'priority' => '0.7'],
        ['route' => 'pressrelease.index', 'priority' => '0.7'],
    ],

];
