<?php

namespace App\Services;

use App\Models\Industry;
use Illuminate\Support\Facades\DB;
use Throwable;

class IndustryBackfillService
{
    public const OG_TYPE = 'article';
    public const OG_SITE_NAME = 'IBN Technologies';
    public const OG_LOCALE = 'en_US';
    public const TWITTER_CARD_TYPE = 'summary_large_image';
    public const TWITTER_CREATOR = 'IBNTechnology';
    public const TWITTER_SITE = 'IBNTechnology';

    /**
     * Run a dry-run audit across all 10 existing Industry Pages.
     *
     * @return array{
     *     total_pages: int,
     *     existing_featured_images: int,
     *     proposed_featured_assignments: int,
     *     pages_no_suitable_image: int,
     *     seo_fields_proposed_for_update: int,
     *     existing_seo_values_preserved: int,
     *     pages_missing_meta_description: int,
     *     pages_missing_featured_alt: int,
     *     pages: array<int, array{
     *         id: int,
     *         slug: string,
     *         title: string,
     *         current_featured: ?string,
     *         proposed_featured: ?string,
     *         featured_source: string,
     *         candidate: ?array,
     *         seo_fields: array<string, array{current: ?string, proposed: ?string, action: string}>
     *     }>
     * }
     */
    public function audit(): array
    {
        $industries = Industry::with(['seoMeta', 'media'])->orderBy('id')->get();

        $report = [
            'total_pages' => $industries->count(),
            'existing_featured_images' => 0,
            'proposed_featured_assignments' => 0,
            'pages_no_suitable_image' => 0,
            'seo_fields_proposed_for_update' => 0,
            'existing_seo_values_preserved' => 0,
            'pages_missing_meta_description' => 0,
            'pages_missing_featured_alt' => 0,
            'pages' => [],
        ];

        foreach ($industries as $industry) {
            $seo = $industry->seoMeta;
            $currentFeatured = $industry->getFirstMedia('featured_image');

            if ($currentFeatured) {
                $report['existing_featured_images']++;
            }

            // PART 1: Featured Image Selection
            $imageCandidate = null;
            if (! $currentFeatured) {
                $imageCandidate = $this->findBestFeaturedImage($industry);
            }

            $proposedImageRel = $currentFeatured ? $currentFeatured->file_name : ($imageCandidate ? $imageCandidate['relative_path'] : null);
            $proposedImageSource = $currentFeatured ? 'Existing Featured Image' : ($imageCandidate ? $imageCandidate['source_type'] : 'None');

            if (! $currentFeatured && $imageCandidate) {
                $report['proposed_featured_assignments']++;
            } elseif (! $currentFeatured && ! $imageCandidate) {
                $report['pages_no_suitable_image']++;
            }

            // Featured ALT text determination
            $featuredAlt = null;
            if ($currentFeatured) {
                $featuredAlt = $currentFeatured->getCustomProperty('alt') ?: ($currentFeatured->name ?: null);
            } elseif ($imageCandidate) {
                $featuredAlt = $imageCandidate['alt'] ?: $industry->title;
            }

            if (empty($featuredAlt)) {
                $report['pages_missing_featured_alt']++;
            }

            // Meta description check
            $metaDesc = $seo ? $seo->meta_description : null;
            if (empty(trim((string) $metaDesc))) {
                $report['pages_missing_meta_description']++;
            }

            // PART 2: SEO Metadata Comparisons
            $seoFields = [
                'og_image_alt' => [
                    'current' => $seo?->og_image_alt,
                    'proposed' => $featuredAlt,
                ],
                'og_type' => [
                    'current' => $seo?->og_type,
                    'proposed' => self::OG_TYPE,
                ],
                'og_site_name' => [
                    'current' => $seo?->og_site_name,
                    'proposed' => self::OG_SITE_NAME,
                ],
                'og_locale' => [
                    'current' => $seo?->og_locale,
                    'proposed' => self::OG_LOCALE,
                ],
                'twitter_card_type' => [
                    'current' => $seo?->twitter_card_type,
                    'proposed' => self::TWITTER_CARD_TYPE,
                ],
                'twitter_title' => [
                    'current' => $seo?->twitter_title,
                    'proposed' => $industry->title,
                ],
                'twitter_description' => [
                    'current' => $seo?->twitter_description,
                    'proposed' => ! empty(trim((string) $metaDesc)) ? $metaDesc : null,
                ],
                'twitter_creator' => [
                    'current' => $seo?->twitter_creator,
                    'proposed' => self::TWITTER_CREATOR,
                ],
                'twitter_site' => [
                    'current' => $seo?->twitter_site,
                    'proposed' => self::TWITTER_SITE,
                ],
            ];

            $pageSeoUpdates = [];
            foreach ($seoFields as $fName => $fData) {
                $curr = $fData['current'];
                $prop = $fData['proposed'];

                if (! empty(trim((string) $curr))) {
                    $report['existing_seo_values_preserved']++;
                    $pageSeoUpdates[$fName] = [
                        'current' => $curr,
                        'proposed' => $curr,
                        'action' => 'PRESERVED',
                    ];
                } elseif (! empty(trim((string) $prop))) {
                    $report['seo_fields_proposed_for_update']++;
                    $pageSeoUpdates[$fName] = [
                        'current' => $curr,
                        'proposed' => $prop,
                        'action' => 'UPDATE',
                    ];
                } else {
                    $pageSeoUpdates[$fName] = [
                        'current' => $curr,
                        'proposed' => null,
                        'action' => 'SKIPPED (Unavailable)',
                    ];
                }
            }

            $report['pages'][] = [
                'id' => $industry->id,
                'slug' => $industry->slug,
                'title' => $industry->title,
                'current_featured' => $currentFeatured ? $currentFeatured->file_name : null,
                'proposed_featured' => $proposedImageRel,
                'featured_source' => $proposedImageSource,
                'candidate' => $imageCandidate,
                'seo_fields' => $pageSeoUpdates,
            ];
        }

        return $report;
    }

    /**
     * Apply the backfill updates to Industry models safely.
     *
     * @param  array<int, array>  $pages
     * @return array{featured_applied: int, seo_applied: int, failed: int, errors: array<int, string>}
     */
    public function apply(array $pages): array
    {
        $featuredApplied = 0;
        $seoApplied = 0;
        $failed = 0;
        $errors = [];

        foreach ($pages as $item) {
            $industryId = (int) $item['id'];
            $industry = Industry::find($industryId);

            if (! $industry) {
                $failed++;
                $errors[] = "Industry ID {$industryId} not found.";
                continue;
            }

            try {
                DB::transaction(function () use ($industry, $item, &$featuredApplied, &$seoApplied) {
                    // 1. Featured image backfill
                    if (empty($industry->getFirstMedia('featured_image')) && ! empty($item['candidate'])) {
                        $sourcePath = $item['candidate']['absolute_path'];
                        if (file_exists($sourcePath)) {
                            $alt = $item['candidate']['alt'] ?: $industry->title;
                            $industry
                                ->addMedia($sourcePath)
                                ->preservingOriginal()
                                ->withCustomProperties([
                                    'alt' => $alt,
                                    'backfilled' => true,
                                    'backfilled_at' => now()->toIso8601String(),
                                ])
                                ->toMediaCollection('featured_image');

                            $featuredApplied++;
                        }
                    }

                    // 2. SEO metadata backfill
                    $seoUpdates = [];
                    foreach ($item['seo_fields'] as $field => $data) {
                        if ($data['action'] === 'UPDATE' && ! empty($data['proposed'])) {
                            $seoUpdates[$field] = $data['proposed'];
                        }
                    }

                    if (! empty($seoUpdates)) {
                        $seo = $industry->seoMeta;
                        if ($seo) {
                            $seo->fill($seoUpdates);
                            $seo->save();
                        } else {
                            $industry->seoMeta()->create($seoUpdates);
                        }
                        $seoApplied++;
                    }
                });
            } catch (Throwable $e) {
                $failed++;
                $errors[] = "Failed backfilling Industry ID {$industryId} ({$industry->slug}): {$e->getMessage()}";
            }
        }

        return [
            'featured_applied' => $featuredApplied,
            'seo_applied' => $seoApplied,
            'failed' => $failed,
            'errors' => $errors,
        ];
    }

    /**
     * Find best featured image candidate for an industry page.
     *
     * @return array{filename: string, relative_path: string, absolute_path: string, source_type: string, alt: string, dimensions: string}|null
     */
    public function findBestFeaturedImage(Industry $industry): ?array
    {
        $bladePath = resource_path("views/industries/{$industry->template}.blade.php");
        if (! file_exists($bladePath)) {
            $bladePath = resource_path("views/industries/{$industry->slug}.blade.php");
        }

        if (! file_exists($bladePath)) {
            return null;
        }

        $content = file_get_contents($bladePath);

        // Img helper prefix (defaults to 'images/industries/')
        $imgHelperPrefix = 'images/industries/';
        if (preg_match('/\$img\s*=\s*fn\s*\([^)]*\)(?:\s*:\s*string)?\s*=>\s*asset\(\s*[\'"]([^\'"]+?)[\'"]\s*\.\s*\$file\s*\)/i', $content, $hm)) {
            $imgHelperPrefix = $hm[1];
        }

        // Priority 1A: Prominent hero media image: <div class="...hero__media">...<img src="{{ $img('...') }}">
        if (preg_match('/<div[^>]*class=[\'"][^\'"]*hero__media[^\'"]*[\'"][^>]*>.*?<img\s+([^>]*?)>/is', $content, $hmM)) {
            $attrs = $hmM[1];
            if (preg_match("/\\\$img\(\s*['\"]([^'\"]+)['\"]\s*\)/i", $attrs, $fnM)) {
                $fn = $fnM[1];
                $rel = rtrim($imgHelperPrefix, '/').'/'.$fn;
                $abs = public_path($rel);
                if (file_exists($abs) && $this->isMeaningfulImage($abs, $fn)) {
                    $alt = '';
                    if (preg_match('/alt=[\'"]([^\'"]*)[\'"]/i', $attrs, $altM)) {
                        $alt = trim($altM[1]);
                    }
                    $info = @getimagesize($abs);

                    return [
                        'filename' => $fn,
                        'relative_path' => $rel,
                        'absolute_path' => $abs,
                        'source_type' => 'Hero image',
                        'alt' => $alt ?: $industry->title,
                        'dimensions' => $info ? "{$info[0]}x{$info[1]}" : 'unknown',
                    ];
                }
            }
        }

        // Priority 1B: Other <img> tags in hero section
        if (preg_match_all('/<img\s+([^>]*?)>/is', $content, $imgMatches)) {
            foreach ($imgMatches[1] as $attrs) {
                if (preg_match("/\\\$img\(\s*['\"]([^'\"]+)['\"]\s*\)/i", $attrs, $fnM)) {
                    $fn = $fnM[1];
                    $rel = rtrim($imgHelperPrefix, '/').'/'.$fn;
                    $abs = public_path($rel);
                    if (file_exists($abs) && $this->isMeaningfulImage($abs, $fn)) {
                        $alt = '';
                        if (preg_match('/alt=[\'"]([^\'"]*)[\'"]/i', $attrs, $altM)) {
                            $alt = trim($altM[1]);
                        }
                        $info = @getimagesize($abs);

                        return [
                            'filename' => $fn,
                            'relative_path' => $rel,
                            'absolute_path' => $abs,
                            'source_type' => 'Hero image',
                            'alt' => $alt ?: $industry->title,
                            'dimensions' => $info ? "{$info[0]}x{$info[1]}" : 'unknown',
                        ];
                    }
                }
            }
        }

        // Priority 1C: Hero background image in inline style / CSS var
        if (preg_match_all('/url\(\s*[\'"]?\{\{\s*\$img\(\s*[\'"]([^\'"]+)[\'"]\s*\)\s*\}\}[\'"]?\s*\)/i', $content, $bgMatches)) {
            foreach ($bgMatches[1] as $fn) {
                $rel = rtrim($imgHelperPrefix, '/').'/'.$fn;
                $abs = public_path($rel);
                if (file_exists($abs) && $this->isMeaningfulImage($abs, $fn)) {
                    $info = @getimagesize($abs);

                    return [
                        'filename' => $fn,
                        'relative_path' => $rel,
                        'absolute_path' => $abs,
                        'source_type' => 'Hero background image',
                        'alt' => $industry->title,
                        'dimensions' => $info ? "{$info[0]}x{$info[1]}" : 'unknown',
                    ];
                }
            }
        }

        return null;
    }

    protected function isMeaningfulImage(string $absPath, string $filename): bool
    {
        $fn = strtolower($filename);
        $ext = pathinfo($fn, PATHINFO_EXTENSION);
        if ($ext === 'svg') {
            return false;
        }

        $ignoredPatterns = [
            'logo', 'partner', 'badge', 'cert', 'icon', 'arrow', 'star', 'tier',
        ];
        foreach ($ignoredPatterns as $p) {
            if (str_contains($fn, $p)) {
                return false;
            }
        }

        $info = @getimagesize($absPath);
        if ($info) {
            $w = $info[0];
            $h = $info[1];
            if ($w <= 120 && $h <= 120) {
                return false;
            }
        }

        return true;
    }
}
