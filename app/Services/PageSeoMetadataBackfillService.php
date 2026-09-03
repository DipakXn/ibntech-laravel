<?php

namespace App\Services;

use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Support\Facades\DB;
use Throwable;

class PageSeoMetadataBackfillService
{
    public const OG_TYPE = 'article';
    public const OG_SITE_NAME = 'IBN Technologies';
    public const OG_LOCALE = 'en_US';
    public const TWITTER_CARD_TYPE = 'summary_large_image';
    public const TWITTER_CREATOR = 'IBNTechnology';
    public const TWITTER_SITE = 'IBNTechnology';

    /**
     * Run a dry-run audit across all existing pages without modifying the database.
     *
     * @return array{
     *     total_pages: int,
     *     pages_with_seo_meta: int,
     *     pages_without_seo_meta: int,
     *     pages_fully_populated: int,
     *     pages_proposed_for_update: int,
     *     field_missing_counts: array<string, int>,
     *     field_populated_counts: array<string, int>,
     *     skipped_source_unavailable: array<string, int>,
     *     proposed_updates: array<int, array{id: int, slug: string, title: string, has_existing_seo: bool, changes: array<string, array{old: mixed, new: mixed, source: string}>, skipped: array<string, string>}>,
     *     fully_populated_pages: array<int, array{id: int, slug: string, title: string}>,
     *     skipped_details: array<int, array{id: int, slug: string, title: string, skipped: array<string, string>}>
     * }
     */
    public function audit(): array
    {
        $pages = Page::with(['seoMeta', 'media'])->orderBy('id')->get();

        $stats = [
            'total_pages' => $pages->count(),
            'pages_with_seo_meta' => 0,
            'pages_without_seo_meta' => 0,
            'pages_fully_populated' => 0,
            'pages_proposed_for_update' => 0,
            'field_missing_counts' => [
                'og_image_alt' => 0,
                'og_type' => 0,
                'og_site_name' => 0,
                'og_locale' => 0,
                'twitter_card_type' => 0,
                'twitter_title' => 0,
                'twitter_description' => 0,
                'twitter_creator' => 0,
                'twitter_site' => 0,
            ],
            'field_populated_counts' => [
                'og_image_alt' => 0,
                'og_type' => 0,
                'og_site_name' => 0,
                'og_locale' => 0,
                'twitter_card_type' => 0,
                'twitter_title' => 0,
                'twitter_description' => 0,
                'twitter_creator' => 0,
                'twitter_site' => 0,
            ],
            'skipped_source_unavailable' => [
                'og_image_alt' => 0,
                'twitter_description' => 0,
            ],
            'proposed_updates' => [],
            'fully_populated_pages' => [],
            'skipped_details' => [],
        ];

        foreach ($pages as $page) {
            $seo = $page->seoMeta;
            if ($seo) {
                $stats['pages_with_seo_meta']++;
            } else {
                $stats['pages_without_seo_meta']++;
            }

            $featured = $page->getFirstMedia('featured_image');
            $featuredAlt = $featured ? ($featured->getCustomProperty('alt') ?: ($featured->name ?: null)) : null;

            $metaDesc = $seo ? $seo->meta_description : null;

            $changes = [];
            $skippedReasons = [];

            // 1. OG Image Alt Text
            $currentAlt = $seo ? $seo->og_image_alt : null;
            if (empty(trim((string) $currentAlt))) {
                $stats['field_missing_counts']['og_image_alt']++;
                if (! empty($featuredAlt)) {
                    $changes['og_image_alt'] = [
                        'old' => $currentAlt,
                        'new' => $featuredAlt,
                        'source' => 'Featured image alt custom property / name',
                    ];
                } else {
                    $stats['skipped_source_unavailable']['og_image_alt']++;
                    $skippedReasons['og_image_alt'] = 'No specific featured image (uses default website logo fallback)';
                }
            } else {
                $stats['field_populated_counts']['og_image_alt']++;
            }

            // 2. OG Type
            $currentOgType = $seo ? $seo->og_type : null;
            if (empty(trim((string) $currentOgType))) {
                $stats['field_missing_counts']['og_type']++;
                $changes['og_type'] = [
                    'old' => $currentOgType,
                    'new' => self::OG_TYPE,
                    'source' => 'Fixed value',
                ];
            } else {
                $stats['field_populated_counts']['og_type']++;
            }

            // 3. OG Site Name
            $currentSiteName = $seo ? $seo->og_site_name : null;
            if (empty(trim((string) $currentSiteName))) {
                $stats['field_missing_counts']['og_site_name']++;
                $changes['og_site_name'] = [
                    'old' => $currentSiteName,
                    'new' => self::OG_SITE_NAME,
                    'source' => 'Fixed value',
                ];
            } else {
                $stats['field_populated_counts']['og_site_name']++;
            }

            // 4. OG Locale
            $currentLocale = $seo ? $seo->og_locale : null;
            if (empty(trim((string) $currentLocale))) {
                $stats['field_missing_counts']['og_locale']++;
                $changes['og_locale'] = [
                    'old' => $currentLocale,
                    'new' => self::OG_LOCALE,
                    'source' => 'Fixed value',
                ];
            } else {
                $stats['field_populated_counts']['og_locale']++;
            }

            // 5. Twitter Card Type
            $currentCardType = $seo ? $seo->twitter_card_type : null;
            if (empty(trim((string) $currentCardType))) {
                $stats['field_missing_counts']['twitter_card_type']++;
                $changes['twitter_card_type'] = [
                    'old' => $currentCardType,
                    'new' => self::TWITTER_CARD_TYPE,
                    'source' => 'Fixed value',
                ];
            } else {
                $stats['field_populated_counts']['twitter_card_type']++;
            }

            // 6. Twitter Title
            $currentTwTitle = $seo ? $seo->twitter_title : null;
            if (empty(trim((string) $currentTwTitle))) {
                $stats['field_missing_counts']['twitter_title']++;
                $changes['twitter_title'] = [
                    'old' => $currentTwTitle,
                    'new' => $page->title,
                    'source' => 'Page title',
                ];
            } else {
                $stats['field_populated_counts']['twitter_title']++;
            }

            // 7. Twitter Description
            $currentTwDesc = $seo ? $seo->twitter_description : null;
            if (empty(trim((string) $currentTwDesc))) {
                $stats['field_missing_counts']['twitter_description']++;
                if (! empty(trim((string) $metaDesc))) {
                    $changes['twitter_description'] = [
                        'old' => $currentTwDesc,
                        'new' => $metaDesc,
                        'source' => 'Page meta_description',
                    ];
                } else {
                    $stats['skipped_source_unavailable']['twitter_description']++;
                    $skippedReasons['twitter_description'] = 'No meta_description defined on Page';
                }
            } else {
                $stats['field_populated_counts']['twitter_description']++;
            }

            // 8. Twitter Creator
            $currentCreator = $seo ? $seo->twitter_creator : null;
            if (empty(trim((string) $currentCreator))) {
                $stats['field_missing_counts']['twitter_creator']++;
                $changes['twitter_creator'] = [
                    'old' => $currentCreator,
                    'new' => self::TWITTER_CREATOR,
                    'source' => 'Fixed value',
                ];
            } else {
                $stats['field_populated_counts']['twitter_creator']++;
            }

            // 9. Twitter Site
            $currentSite = $seo ? $seo->twitter_site : null;
            if (empty(trim((string) $currentSite))) {
                $stats['field_missing_counts']['twitter_site']++;
                $changes['twitter_site'] = [
                    'old' => $currentSite,
                    'new' => self::TWITTER_SITE,
                    'source' => 'Fixed value',
                ];
            } else {
                $stats['field_populated_counts']['twitter_site']++;
            }

            if (! empty($changes)) {
                $stats['pages_proposed_for_update']++;
                $stats['proposed_updates'][] = [
                    'id' => $page->id,
                    'slug' => $page->slug,
                    'title' => $page->title,
                    'has_existing_seo' => (bool) $seo,
                    'changes' => $changes,
                    'skipped' => $skippedReasons,
                ];
            } else {
                $stats['pages_fully_populated']++;
                $stats['fully_populated_pages'][] = [
                    'id' => $page->id,
                    'slug' => $page->slug,
                    'title' => $page->title,
                ];
            }

            if (! empty($skippedReasons)) {
                $stats['skipped_details'][] = [
                    'id' => $page->id,
                    'slug' => $page->slug,
                    'title' => $page->title,
                    'skipped' => $skippedReasons,
                ];
            }
        }

        return $stats;
    }

    /**
     * Apply proposed SEO metadata updates safely.
     *
     * @param  array<int, array{id: int, changes: array<string, array{new: mixed}>}>  $proposedUpdates
     * @return array{applied: int, failed: int, errors: array<int, string>}
     */
    public function apply(array $proposedUpdates): array
    {
        $applied = 0;
        $failed = 0;
        $errors = [];

        foreach ($proposedUpdates as $item) {
            $pageId = (int) $item['id'];
            $page = Page::find($pageId);

            if (! $page) {
                $failed++;
                $errors[] = "Page ID {$pageId} not found.";
                continue;
            }

            $updatePayload = [];
            foreach ($item['changes'] as $field => $change) {
                $updatePayload[$field] = $change['new'];
            }

            if (empty($updatePayload)) {
                continue;
            }

            try {
                DB::transaction(function () use ($page, $updatePayload) {
                    $seo = $page->seoMeta;
                    if ($seo) {
                        $seo->fill($updatePayload);
                        $seo->save();
                    } else {
                        $page->seoMeta()->create($updatePayload);
                    }
                });

                $applied++;
            } catch (Throwable $e) {
                $failed++;
                $errors[] = "Failed updating SEO for Page ID {$pageId} ({$page->slug}): {$e->getMessage()}";
            }
        }

        return [
            'applied' => $applied,
            'failed' => $failed,
            'errors' => $errors,
        ];
    }
}
