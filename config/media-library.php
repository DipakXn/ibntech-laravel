<?php

use App\Support\MediaLibrary\CustomPathGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\ResponsiveImages\TinyPlaceholderGenerator\Blurred;
use Spatie\MediaLibrary\ResponsiveImages\WidthCalculator\FileSizeOptimizedWidthCalculator;
use Spatie\MediaLibrary\Support\FileNamer\DefaultFileNamer;
use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;

return [

    /*
     * Keep all media on the public disk unless a collection overrides it.
     */
    'disk_name' => env('MEDIA_DISK', 'public'),

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
     * This project uses isolated media folders under the media/ prefix.
     */
    'prefix' => env('MEDIA_PREFIX', 'media'),

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
