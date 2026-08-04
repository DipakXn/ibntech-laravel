# Media Uploads Deployment Guide

This project stores Spatie Media Library files on a dedicated `media` disk that points at a real directory inside the web root. No `storage:link` symlink is required for media.

## Environment variables

```env
MEDIA_DISK=media
MEDIA_ROOT=public/uploads
MEDIA_URL=/uploads
```

| Environment | `MEDIA_ROOT` example | `MEDIA_URL` |
|---|---|---|
| Local | `public/uploads` | `/uploads` |
| cPanel Staging | `/home/USER/public_html/stg/uploads` | `/uploads` |
| cPanel Production | `/home/USER/public_html/uploads` | `/uploads` |

`MEDIA_ROOT` may be:

- **Relative** to the Laravel base path (`public/uploads`)
- **Absolute** on the server (recommended on cPanel when the document root is not the Laravel `public/` folder)

Do not hardcode server paths in PHP — only in `.env` per environment.

---

## Local

1. Ensure `.env` contains the `MEDIA_*` variables above.
2. Create the uploads directory if needed (git keeps `public/uploads/.gitignore`).
3. Clear config cache after changing env vars:

```bash
php artisan config:clear
php artisan storage:unlink   # optional; media no longer needs the symlink
```

4. Upload a test image in Filament and confirm the file appears under `public/uploads/...` and is reachable at `http://localhost/uploads/...`.

5. If migrating existing media from `storage/app/public`:

```bash
php artisan media:migrate-to-uploads-disk --dry-run
php artisan media:migrate-to-uploads-disk
# optional: move into purpose-based folders
php artisan media:migrate-to-uploads-disk --reorganize
```

6. Keep a queue worker running for Blog conversions:

```bash
php artisan queue:work --queue=media,default --tries=1 --timeout=900
```

---

## Staging (cPanel)

Typical layout:

```
/home/USER/
  laravel-stg/          ← application code (outside or beside web root)
  public_html/stg/      ← document root
    index.php
    uploads/            ← MEDIA_ROOT target
    ...
```

1. Deploy application files (FTP/File Manager/Git — no SSH required for media setup).
2. Point the staging document root at the Laravel public entry (or copy/sync `public/` contents into `public_html/stg`).
3. Set staging `.env`:

```env
MEDIA_DISK=media
MEDIA_ROOT=/home/USER/public_html/stg/uploads
MEDIA_URL=/uploads
```

4. Ensure `public_html/stg/uploads` exists and is writable by PHP (`0755` or `0775` as appropriate).
5. Run (once, via cPanel Terminal / cron / locally against staging DB if available):

```bash
php artisan media:migrate-to-uploads-disk
php artisan config:cache
```

6. Confirm `https://staging-host/uploads/...` serves files directly (not through Laravel).
7. **Do not** rely on `php artisan storage:link` for media.

Optional Apache rewrite for old `/storage/...` bookmarks:

```apache
RewriteEngine On
RewriteRule ^storage/(.*)$ /uploads/$1 [L,R=301]
```

---

## Production (cPanel)

Typical layout:

```
/home/USER/
  laravel/                 ← application code
  public_html/             ← document root
    index.php
    uploads/
    ...
```

1. Deploy code and set production `.env`:

```env
MEDIA_DISK=media
MEDIA_ROOT=/home/USER/public_html/uploads
MEDIA_URL=/uploads
APP_URL=https://www.example.com
```

2. Ensure `public_html/uploads` exists, is writable, and is **not** wiped by deploys (exclude from cleanup / keep outside the release directory if you use releases).
3. Migrate existing media once:

```bash
php artisan media:migrate-to-uploads-disk --dry-run
php artisan media:migrate-to-uploads-disk
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

4. Verify:
   - Filament upload/preview/delete
   - Frontend featured images, logos, OG images
   - PDF downloads (case studies / ebooks)
   - Blog conversions after queue processing

5. Schedule or keep a worker for the `media` queue (cron `queue:work` / Supervisor if available).

---

## Switching to cloud storage later

1. Configure the `s3` disk (or add an `r2` / `spaces` disk) in `config/filesystems.php`.
2. Set:

```env
MEDIA_DISK=s3
# plus AWS_* / endpoint variables
```

3. Sync existing files to the bucket and update `media.disk` / `media.conversions_disk` if needed.
4. No model/Filament code changes are required when disks are resolved through `config('media-library.disk_name')`.

---

## Checklist

- [ ] `MEDIA_DISK`, `MEDIA_ROOT`, `MEDIA_URL` set per environment
- [ ] Uploads directory exists and is writable
- [ ] Existing media migrated with `media:migrate-to-uploads-disk`
- [ ] Config cache rebuilt after env changes
- [ ] Media URLs load as `/uploads/...` without Laravel routing
- [ ] Queue worker handles conversion jobs
- [ ] Optional `/storage` → `/uploads` rewrite enabled during transition
