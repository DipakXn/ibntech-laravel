<?php

namespace App\Services\WordPress;

class ImportReport
{
    public int $scanned = 0;

    public int $published = 0;

    public int $draftsSkipped = 0;

    public int $created = 0;

    public int $updated = 0;

    public int $skipped = 0;

    public int $failed = 0;

    public int $featuredDownloaded = 0;

    public int $featuredFailed = 0;

    public int $featuredMissing = 0;

    public int $contentImagesDownloaded = 0;

    public int $contentImagesFailed = 0;

    /**
     * @var array<int, array{id: int, slug: string, reason: string}>
     */
    public array $skippedItems = [];

    /**
     * @var array<int, array{id: int, slug: string, error: string}>
     */
    public array $failedItems = [];

    /**
     * @var array<int, string>
     */
    public array $unmappedCategories = [];

    /**
     * @var array<int, string>
     */
    public array $createdSlugs = [];

    public function skip(WordpressPost $post, string $reason): void
    {
        $this->skipped++;
        $this->skippedItems[] = [
            'id' => $post->wordpressId,
            'slug' => $post->slug,
            'reason' => $reason,
        ];
    }

    public function fail(WordpressPost $post, string $error): void
    {
        $this->failed++;
        $this->failedItems[] = [
            'id' => $post->wordpressId,
            'slug' => $post->slug,
            'error' => $error,
        ];
    }

    public function addUnmappedCategories(array $paths): void
    {
        foreach ($paths as $path) {
            if ($path !== '' && ! in_array($path, $this->unmappedCategories, true)) {
                $this->unmappedCategories[] = $path;
            }
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'scanned' => $this->scanned,
            'published' => $this->published,
            'drafts_skipped' => $this->draftsSkipped,
            'created' => $this->created,
            'updated' => $this->updated,
            'skipped' => $this->skipped,
            'failed' => $this->failed,
            'featured_downloaded' => $this->featuredDownloaded,
            'featured_failed' => $this->featuredFailed,
            'featured_missing' => $this->featuredMissing,
            'content_images_downloaded' => $this->contentImagesDownloaded,
            'content_images_failed' => $this->contentImagesFailed,
            'unmapped_categories' => $this->unmappedCategories,
            'created_slugs' => $this->createdSlugs,
            'skipped_items' => $this->skippedItems,
            'failed_items' => $this->failedItems,
        ];
    }
}
