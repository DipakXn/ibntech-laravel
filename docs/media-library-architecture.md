# Media Library Architecture

## Active setup

- Laravel `12.x`
- Filament `5.x`
- `filament/spatie-laravel-media-library-plugin` `5.x`
- `spatie/laravel-medialibrary` `11.x`
- Spatie media config: `config/media-library.php`

## Storage disk (no symlink)

Media uses a dedicated `media` filesystem disk:

| Env var | Local default | Purpose |
|---|---|---|
| `MEDIA_DISK` | `media` | Disk name used by Spatie |
| `MEDIA_ROOT` | `public/uploads` | Absolute or base-path-relative storage root |
| `MEDIA_URL` | `/uploads` | Public URL prefix |

Files are written directly under the web root uploads directory and served by Apache/Nginx. **`php artisan storage:link` is not required for media.**

To switch to S3/R2/Spaces later, point `MEDIA_DISK` at a cloud disk (for example `s3`) and configure that disk — no application code changes are required when collections use `config('media-library.disk_name')`.

## Folder layout

Purpose-based directories (configured in `config/media-library.php` → `path_map`):

```
uploads/
├── logos/website|branding
├── seo/og-images|social-share
├── pages/{slug}/
├── blogs/featured|blocks/{YYYY}/{MM}/
├── articles/...
├── case-studies/...
├── ebooks/...
├── media/downloads/...
└── media/miscellaneous/{YYYY}/{MM}/   ← fallback
```

- Branding/SEO/page assets: stable purpose folders
- High-volume content: purpose folder + year/month
- Filenames: original name, ASCII/slugified, `-01` suffix on collision

Legacy layouts still resolve if files remain at:

- `media/{YYYY}/{MM}/...`
- `{id}/...`

## Reference integration

`app/Models/Blog.php` remains the reference for conversions + responsive images.

All HasMedia models resolve the disk via:

```php
->useDisk((string) config('media-library.disk_name', 'media'))
```

Filament uploads use `App\Forms\Components\SpatieMediaLibraryFileUpload` (sanitized filenames + purpose-aware directories).

## Migration

```bash
php artisan media:migrate-to-uploads-disk --dry-run
php artisan media:migrate-to-uploads-disk
php artisan media:migrate-to-uploads-disk --reorganize   # optional purpose folders
```

## Queue recommendations

```bash
php artisan queue:work --queue=media,default --tries=1 --timeout=900
```

## URL compatibility

Old public URLs used `/storage/...`. New URLs use `/uploads/...`.

Optional web-server rewrite during transition:

```apache
RewriteRule ^storage/(.*)$ /uploads/$1 [L,R=301]
```

```nginx
rewrite ^/storage/(.*)$ /uploads/$1 permanent;
```
