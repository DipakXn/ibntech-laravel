# Media Library Architecture

## Active setup

- Laravel `12.x`
- Filament `4.10`
- `filament/spatie-laravel-media-library-plugin` `4.10`
- `spatie/laravel-medialibrary` `11.x`
- Spatie media config is now published at `config/media-library.php`

## Storage layout

The custom path generator now stores original media in a WordPress-style layout:

- `media/{YYYY}/{MM}/{filename}`

Conversions and responsive images remain grouped by the same month bucket, but
inside dedicated subdirectories:

- `media/{YYYY}/{MM}/conversions/`
- `media/{YYYY}/{MM}/responsive-images/`

## Reference integration pattern

`app/Models/Blog.php` is the reference implementation:

- enables responsive images on collections
- generates queued WebP conversions
- keeps Filament upload compatibility unchanged

Apply the same pattern to other Spatie-enabled models as you expand media usage.

## Queue recommendations

- Set `QUEUE_CONNECTION=database` or `redis`
- Set `MEDIA_QUEUE_CONNECTION=${QUEUE_CONNECTION}`
- Set `MEDIA_QUEUE=media`
- Run dedicated workers for media-heavy workloads:

```bash
php artisan queue:work --queue=media,default --tries=1 --timeout=900
```

## Filament notes

- Keep `SpatieMediaLibraryFileUpload` on the same collection names used in the models
- This project uses `App\Forms\Components\SpatieMediaLibraryFileUpload` for sanitized original filenames
- Duplicate names in the same `media/{YYYY}/{MM}` directory receive `-01`, `-02`, ... suffixes
- Prefer `maxSize()`, image-only validation, and image editor constraints per field
- Use smaller admin previews than public conversions to reduce panel payload

## Cleanup guidance

- Keep filenames unique within each `media/{YYYY}/{MM}` directory
- Use Spatie's cleanup commands only after confirming orphaned data rules
- Do not manually rename conversion or responsive image files
- Schedule cleanup in maintenance windows for very large libraries
