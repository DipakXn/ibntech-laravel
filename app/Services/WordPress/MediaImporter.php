<?php

namespace App\Services\WordPress;

use App\Models\Blog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Throwable;

class MediaImporter
{
    /**
     * @return 'downloaded'|'failed'|'missing'|'skipped'
     */
    public function attachFeaturedImage(Blog $blog, ?string $url, bool $replaceExisting = false): string
    {
        if (blank($url)) {
            return 'missing';
        }

        if (! $replaceExisting && $blog->getFirstMedia('featured_image')) {
            return 'skipped';
        }

        $path = $this->download($url);

        if ($path === null) {
            return 'failed';
        }

        try {
            $blog
                ->addMedia($path)
                ->usingFileName($this->fileNameFromUrl($url, $path))
                ->withCustomProperties([
                    'alt' => $blog->title,
                    'source_url' => $url,
                ])
                ->toMediaCollection('featured_image');
        } catch (Throwable) {
            return 'failed';
        } finally {
            @unlink($path);
        }

        return 'downloaded';
    }

    /**
     * @param  array<int, array{block_id: string, url: string, alt: ?string, caption: ?string}>  $images
     * @return array{downloaded: int, failed: int}
     */
    public function attachContentImages(Blog $blog, array $images): array
    {
        $downloaded = 0;
        $failed = 0;

        foreach ($images as $image) {
            $existing = $blog->getMedia('content_blocks')->first(function ($media) use ($image): bool {
                $blockId = (string) ($image['block_id'] ?? '');
                $url = (string) ($image['url'] ?? '');

                if ($blockId !== '' && data_get($media, 'custom_properties.block_id') === $blockId) {
                    return true;
                }

                return $url !== '' && data_get($media, 'custom_properties.source_url') === $url;
            });

            if ($existing) {
                continue;
            }

            $path = $this->download($image['url']);

            if ($path === null) {
                $failed++;

                continue;
            }

            try {
                $blog
                    ->addMedia($path)
                    ->usingFileName($this->fileNameFromUrl($image['url'], $path))
                    ->withCustomProperties([
                        'block_id' => $image['block_id'],
                        'alt' => $image['alt'],
                        'caption' => $image['caption'],
                        'source_url' => $image['url'],
                    ])
                    ->toMediaCollection('content_blocks');

                $downloaded++;
            } catch (Throwable) {
                $failed++;
            } finally {
                @unlink($path);
            }
        }

        return [
            'downloaded' => $downloaded,
            'failed' => $failed,
        ];
    }

    protected function download(string $url): ?string
    {
        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'User-Agent' => 'IBN-Laravel-Blog-Importer/1.0',
                    'Accept' => 'image/*,*/*',
                ])
                ->get($url);

            if (! $response->successful() || blank($response->body())) {
                return null;
            }

            $path = tempnam(sys_get_temp_dir(), 'wpimg');

            if ($path === false) {
                return null;
            }

            file_put_contents($path, $response->body());

            return $path;
        } catch (Throwable) {
            return null;
        }
    }

    protected function fileNameFromUrl(string $url, string $tempPath): string
    {
        $path = (string) parse_url($url, PHP_URL_PATH);
        $original = basename($path) ?: 'image';
        $baseName = pathinfo($original, PATHINFO_FILENAME);
        $extension = strtolower((string) pathinfo($original, PATHINFO_EXTENSION));

        $sanitized = Str::of($baseName)
            ->ascii()
            ->replaceMatches('/[^A-Za-z0-9]+/', '-')
            ->trim('-')
            ->lower()
            ->toString();

        if ($sanitized === '') {
            $sanitized = 'image';
        }

        if ($extension === '') {
            $extension = $this->guessExtension($tempPath) ?: 'jpg';
        }

        return $sanitized.'.'.$extension;
    }

    protected function guessExtension(string $path): ?string
    {
        $mime = @mime_content_type($path);

        return match ($mime) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/gif' => 'gif',
            'image/svg+xml' => 'svg',
            default => null,
        };
    }
}
