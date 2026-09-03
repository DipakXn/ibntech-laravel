<?php

namespace App\Services;

use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Throwable;

class BlogSeoMetadataBackfillService
{
    public const OG_SITE_NAME = 'IBN Technologies';
    public const OG_LOCALE = 'en_US';
    public const TWITTER_CREATOR = 'IBNTechnology';
    public const TWITTER_SITE = 'IBNTechnology';

    /**
     * Strictly allowed write payload fields.
     */
    public const ALLOWED_FIELDS = [
        'og_image_alt',
        'og_site_name',
        'og_locale',
        'twitter_creator',
        'twitter_site',
    ];

    /**
     * Run a dry-run audit across all Blog records.
     *
     * @return array{
     *     total_blogs: int,
     *     blogs_with_featured_image: int,
     *     blogs_missing_featured_image: int,
     *     blogs_with_featured_image_alt: int,
     *     blogs_without_featured_image_alt: int,
     *     existing_seo_values_preserved: int,
     *     proposed_og_image_alt_updates: int,
     *     proposed_og_site_name_updates: int,
     *     proposed_og_locale_updates: int,
     *     proposed_twitter_creator_updates: int,
     *     proposed_twitter_site_updates: int,
     *     total_proposed_field_updates: int,
     *     samples: array<int, array>,
     *     blogs: array<int, array>
     * }
     */
    public function audit(): array
    {
        $blogs = Blog::with(['seoMeta', 'media'])->orderBy('id')->get();

        $report = [
            'total_blogs' => $blogs->count(),
            'blogs_with_featured_image' => 0,
            'blogs_missing_featured_image' => 0,
            'blogs_with_featured_image_alt' => 0,
            'blogs_without_featured_image_alt' => 0,
            'existing_seo_values_preserved' => 0,
            'proposed_og_image_alt_updates' => 0,
            'proposed_og_site_name_updates' => 0,
            'proposed_og_locale_updates' => 0,
            'proposed_twitter_creator_updates' => 0,
            'proposed_twitter_site_updates' => 0,
            'total_proposed_field_updates' => 0,
            'samples' => [],
            'blogs' => [],
        ];

        foreach ($blogs as $blog) {
            $media = $blog->getFirstMedia('featured_image');
            $seo = $blog->seoMeta;

            $hasFeatured = (bool) $media;
            $featuredAlt = null;

            if ($hasFeatured) {
                $report['blogs_with_featured_image']++;
                $rawAlt = $media->getCustomProperty('alt');
                if (! empty(trim((string) $rawAlt))) {
                    $featuredAlt = trim((string) $rawAlt);
                    $report['blogs_with_featured_image_alt']++;
                } else {
                    $report['blogs_without_featured_image_alt']++;
                }
            } else {
                $report['blogs_missing_featured_image']++;
                $report['blogs_without_featured_image_alt']++;
            }

            // Exactly the 5 target fields
            $targetValues = [
                'og_image_alt' => $featuredAlt,
                'og_site_name' => self::OG_SITE_NAME,
                'og_locale' => self::OG_LOCALE,
                'twitter_creator' => self::TWITTER_CREATOR,
                'twitter_site' => self::TWITTER_SITE,
            ];

            $blogUpdates = [];
            foreach ($targetValues as $field => $propVal) {
                $currentVal = $seo ? $seo->{$field} : null;

                if (! empty(trim((string) $currentVal))) {
                    $report['existing_seo_values_preserved']++;
                    $blogUpdates[$field] = [
                        'current' => $currentVal,
                        'proposed' => $currentVal,
                        'action' => 'PRESERVED',
                    ];
                } elseif (! empty(trim((string) $propVal))) {
                    $report['total_proposed_field_updates']++;
                    if ($field === 'og_image_alt') {
                        $report['proposed_og_image_alt_updates']++;
                    }
                    if ($field === 'og_site_name') {
                        $report['proposed_og_site_name_updates']++;
                    }
                    if ($field === 'og_locale') {
                        $report['proposed_og_locale_updates']++;
                    }
                    if ($field === 'twitter_creator') {
                        $report['proposed_twitter_creator_updates']++;
                    }
                    if ($field === 'twitter_site') {
                        $report['proposed_twitter_site_updates']++;
                    }

                    $blogUpdates[$field] = [
                        'current' => $currentVal,
                        'proposed' => $propVal,
                        'action' => 'UPDATE',
                    ];
                } else {
                    $blogUpdates[$field] = [
                        'current' => $currentVal,
                        'proposed' => null,
                        'action' => 'SKIPPED (Unavailable)',
                    ];
                }
            }

            $blogEntry = [
                'id' => $blog->id,
                'slug' => $blog->slug,
                'title' => $blog->title,
                'featured_image' => $media ? $media->file_name : null,
                'featured_image_alt' => $featuredAlt,
                'proposed_og_image_alt' => $featuredAlt,
                'fields' => $blogUpdates,
            ];

            $report['blogs'][] = $blogEntry;
        }

        // Prepare representative sample (first 10, middle 5, last 5, and samples missing featured image)
        $missingSamples = array_values(array_filter($report['blogs'], fn ($b) => empty($b['featured_image'])));
        $withImageSamples = array_values(array_filter($report['blogs'], fn ($b) => ! empty($b['featured_image'])));

        $report['samples'] = array_merge(
            array_slice($withImageSamples, 0, 10),
            array_slice($missingSamples, 0, 5),
            array_slice($withImageSamples, -5)
        );

        return $report;
    }

    /**
     * Apply the backfill updates to Blog SeoMeta records safely.
     *
     * @param  array<int, array>  $blogs
     * @return array{blogs_updated: int, fields_updated: int, failed: int, errors: array<int, string>}
     */
    public function apply(array $blogs): array
    {
        $blogsUpdated = 0;
        $fieldsUpdated = 0;
        $failed = 0;
        $errors = [];

        foreach ($blogs as $item) {
            $blogId = (int) $item['id'];
            $blog = Blog::find($blogId);

            if (! $blog) {
                $failed++;
                $errors[] = "Blog ID {$blogId} not found.";
                continue;
            }

            // Build write payload strictly restricted to ALLOWED_FIELDS
            $payload = [];
            foreach ($item['fields'] as $field => $data) {
                if ($data['action'] === 'UPDATE' && ! empty($data['proposed'])) {
                    if (! in_array($field, self::ALLOWED_FIELDS, true)) {
                        throw new InvalidArgumentException("Unauthorized field attempt: {$field}");
                    }
                    $payload[$field] = $data['proposed'];
                }
            }

            if (empty($payload)) {
                continue;
            }

            // Extra safety guard: ensure payload contains ONLY allowed fields
            $unauthorized = array_diff(array_keys($payload), self::ALLOWED_FIELDS);
            if (! empty($unauthorized)) {
                throw new InvalidArgumentException('Unauthorized fields in payload: '.implode(', ', $unauthorized));
            }

            try {
                DB::transaction(function () use ($blog, $payload, &$blogsUpdated, &$fieldsUpdated) {
                    $seo = $blog->seoMeta;
                    if ($seo) {
                        $seo->fill($payload);
                        $seo->save();
                    } else {
                        $blog->seoMeta()->create($payload);
                    }

                    $blogsUpdated++;
                    $fieldsUpdated += count($payload);
                });
            } catch (Throwable $e) {
                $failed++;
                $errors[] = "Failed updating Blog ID {$blogId} ({$blog->slug}): {$e->getMessage()}";
            }
        }

        return [
            'blogs_updated' => $blogsUpdated,
            'fields_updated' => $fieldsUpdated,
            'failed' => $failed,
            'errors' => $errors,
        ];
    }
}
