<?php

use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\SeoMeta;
use App\Models\WebsiteSetting;
use App\Models\WhitePaper;
use App\Support\MediaLibrary\CustomPathGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\ResponsiveImages\TinyPlaceholderGenerator\Blurred;
use Spatie\MediaLibrary\ResponsiveImages\WidthCalculator\FileSizeOptimizedWidthCalculator;
use Spatie\MediaLibrary\Support\FileNamer\DefaultFileNamer;
use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;

return [

    /*
     * Dedicated media disk (public/uploads by default). Set MEDIA_DISK=s3 to
     * switch to cloud storage without code changes.
     */
    'disk_name' => env('MEDIA_DISK', 'media'),

    /*
     * Use a dedicated queue lane for conversions in production. Default to the
     * main queue connection when a media-specific connection is not defined.
     */
    'queue_connection_name' => env('MEDIA_QUEUE_CONNECTION', env('QUEUE_CONNECTION', 'database')),
    'queue_name' => env('MEDIA_QUEUE', 'media'),
    'queue_conversions_by_default' => env('QUEUE_CONVERSIONS_BY_DEFAULT', true),
    'queue_conversions_after_database_commit' => env('QUEUE_CONVERSIONS_AFTER_DB_COMMIT', true),

    /*
     * Be explicit about the model in this project because there is also a
     * legacy App\Models\Media model in the codebase.
     */
    'media_model' => Media::class,

    'file_namer' => DefaultFileNamer::class,
    'path_generator' => CustomPathGenerator::class,
    'url_generator' => DefaultUrlGenerator::class,

    /*
     * Stable paths plus versioned URLs work well with CDN caching.
     */
    'version_urls' => env('MEDIA_VERSION_URLS', true),

    /*
     * Optional global prefix under the media disk root. Leave empty when using
     * purpose-based folders at the disk root (recommended).
     */
    'prefix' => env('MEDIA_PREFIX', ''),

    /*
     * Fallback directory template when a model/collection is not mapped.
     * Tokens: {YYYY}, {MM}, {slug}, {model}
     */
    'fallback_path' => env('MEDIA_FALLBACK_PATH', 'media/miscellaneous/{YYYY}/{MM}'),

    /*
     * Purpose-based path map. Tokens: {YYYY}, {MM}, {slug}, {model}
     * Chronological segments are used only where upload volume grows over time.
     */
    'path_map' => [
        WebsiteSetting::class => [
            'site_logo' => 'logos/website',
            'site_logo_dark' => 'logos/website',
            'favicon' => 'logos/branding',
            'apple_touch_icon' => 'logos/branding',
            'default_og_image' => 'seo/og-images',
        ],
        SeoMeta::class => [
            'og_image' => 'seo/og-images',
            'twitter_image' => 'seo/social-share',
        ],
        Page::class => [
            'featured_image' => 'pages/{slug}',
        ],
        LandingPage::class => [
            'featured_image' => 'pages/{slug}',
        ],
        Industry::class => [
            'featured_image' => 'pages/{slug}',
        ],
        Newsletter::class => [
            'featured_image' => 'media/documents/{YYYY}/{MM}',
        ],
        Blog::class => [
            'featured_image' => 'blogs/featured/{YYYY}/{MM}',
            'content_blocks' => 'blogs/blocks/{YYYY}/{MM}',
        ],
        Article::class => [
            'featured_image' => 'articles/featured/{YYYY}/{MM}',
            'content_blocks' => 'articles/blocks/{YYYY}/{MM}',
        ],
        CaseStudy::class => [
            'featured_image' => 'case-studies/featured/{YYYY}/{MM}',
            'download_pdf' => 'media/downloads/case-studies/{YYYY}/{MM}',
            'content_blocks' => 'case-studies/blocks/{YYYY}/{MM}',
        ],
        Ebook::class => [
            'featured_image' => 'ebooks/featured/{YYYY}/{MM}',
            'download_pdf' => 'media/downloads/ebooks/{YYYY}/{MM}',
            'content_blocks' => 'ebooks/blocks/{YYYY}/{MM}',
        ],
        PressRelease::class => [
            'featured_image' => 'press-releases/featured/{YYYY}/{MM}',
            'content_blocks' => 'press-releases/blocks/{YYYY}/{MM}',
        ],
        WhitePaper::class => [
            'featured_image' => 'white-papers/featured/{YYYY}/{MM}',
            'content_blocks' => 'white-papers/blocks/{YYYY}/{MM}',
        ],
    ],

    /*
     * Set a sensible default for frontend rendering. Filament previews are not
     * affected by this HTML attribute configuration.
     */
    'default_loading_attribute_value' => env('MEDIA_LOADING_ATTRIBUTE', 'lazy'),

    'image_driver' => env('IMAGE_DRIVER', 'gd'),

    'remote' => [
        'extra_headers' => [
            'CacheControl' => 'public, max-age=31536000, immutable',
        ],
    ],

    'responsive_images' => [
        'width_calculator' => FileSizeOptimizedWidthCalculator::class,
        'use_tiny_placeholders' => true,
        'tiny_placeholder_generator' => Blurred::class,
    ],
];
