<?php

namespace App\Services\WordPress;

class PressReleaseImportReport
{
    public int $scanned = 0;

    public int $wouldCreate = 0;

    public int $created = 0;

    public int $skippedProtected = 0;

    public int $skippedNotInOnly = 0;

    public int $skippedExisting = 0;

    public int $failed = 0;

    public int $featuredDownloaded = 0;

    public int $featuredFailed = 0;

    public int $contentImagesDownloaded = 0;

    public int $contentImagesFailed = 0;

    public int $featuredImages = 0;

    public int $contentImages = 0;

    public int $dateMappings = 0;

    /**
     * @var array<int, string>
     */
    public array $wouldCreateSlugs = [];

    /**
     * @var array<int, string>
     */
    public array $createdSlugs = [];

    /**
     * @var array<int, array<string, mixed>>
     */
    public array $createdItems = [];

    /**
     * @var array<int, array<string, mixed>>
     */
    public array $wouldCreateItems = [];

    /**
     * @var array<int, array{slug: string, reason: string}>
     */
    public array $skippedItems = [];

    /**
     * @var array<int, array{slug: string, file: string, error: string}>
     */
    public array $failedItems = [];

    /**
     * @var array<int, array{slug: string, permalink: string}>
     */
    public array $missingDates = [];

    /**
     * @var array<int, string>
     */
    public array $extraDates = [];

    /**
     * @var array<int, string>
     */
    public array $duplicateDates = [];

    /**
     * @var array<int, array{permalink: string, date: string}>
     */
    public array $invalidDates = [];

    public function dateCoverageComplete(): bool
    {
        return $this->missingDates === []
            && $this->extraDates === []
            && $this->duplicateDates === []
            && $this->invalidDates === [];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'scanned' => $this->scanned,
            'would_create' => $this->wouldCreate,
            'created' => $this->created,
            'skipped_protected' => $this->skippedProtected,
            'skipped_not_in_only' => $this->skippedNotInOnly,
            'skipped_existing' => $this->skippedExisting,
            'failed' => $this->failed,
            'featured_images' => $this->featuredImages,
            'featured_downloaded' => $this->featuredDownloaded,
            'featured_failed' => $this->featuredFailed,
            'content_images' => $this->contentImages,
            'content_images_downloaded' => $this->contentImagesDownloaded,
            'content_images_failed' => $this->contentImagesFailed,
            'date_mappings' => $this->dateMappings,
            'date_coverage_complete' => $this->dateCoverageComplete(),
            'would_create_slugs' => $this->wouldCreateSlugs,
            'would_create_items' => $this->wouldCreateItems,
            'created_slugs' => $this->createdSlugs,
            'created_items' => $this->createdItems,
            'skipped_items' => $this->skippedItems,
            'failed_items' => $this->failedItems,
            'missing_dates' => $this->missingDates,
            'extra_dates' => $this->extraDates,
            'duplicate_dates' => $this->duplicateDates,
            'invalid_dates' => $this->invalidDates,
        ];
    }
}
