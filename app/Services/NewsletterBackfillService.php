<?php

namespace App\Services;

use App\Models\Newsletter;
use Illuminate\Support\Facades\DB;
use Throwable;

class NewsletterBackfillService
{
    public const OG_TYPE = 'article';
    public const OG_SITE_NAME = 'IBN Technologies';
    public const OG_LOCALE = 'en_US';
    public const TWITTER_CARD_TYPE = 'summary_large_image';
    public const TWITTER_CREATOR = 'IBNTechnology';
    public const TWITTER_SITE = 'IBNTechnology';

    /**
     * Run a dry-run audit across all existing Newsletter Pages.
     *
     * @return array{
     *     total_pages: int,
     *     existing_featured_images: int,
     *     proposed_featured_assignments: int,
     *     pages_no_suitable_image: int,
     *     seo_fields_proposed_for_update: int,
     *     existing_seo_values_preserved: int,
     *     pages_missing_meta_description: int,
     *     pages_missing_image_alt: int,
     *     pages: array<int, array>
     * }
     */
    public function audit(): array
    {
        $newsletters = Newsletter::with(['seoMeta', 'media'])->orderBy('id')->get();

        $report = [
            'total_pages' => $newsletters->count(),
            'existing_featured_images' => 0,
            'proposed_featured_assignments' => 0,
            'pages_no_suitable_image' => 0,
            'seo_fields_proposed_for_update' => 0,
            'existing_seo_values_preserved' => 0,
            'pages_missing_meta_description' => 0,
            'pages_missing_image_alt' => 0,
            'pages' => [],
        ];

        foreach ($newsletters as $newsletter) {
            $seo = $newsletter->seoMeta;
            $currentFeatured = $newsletter->getFirstMedia('featured_image');

            if ($currentFeatured) {
                $report['existing_featured_images']++;
            }

            // PART 1: Featured Image Candidate Selection
            $imageCandidate = null;
            if (! $currentFeatured) {
                $imageCandidate = $this->findBestFeaturedImage($newsletter);
            }

            if ($currentFeatured) {
                $proposedImageRel = $currentFeatured->file_name;
                $proposedImageSource = 'Existing Featured Image';
                $existingStaticAlt = $currentFeatured->getCustomProperty('alt') ?: null;
                $proposedFeaturedAlt = $existingStaticAlt;
            } elseif ($imageCandidate) {
                $report['proposed_featured_assignments']++;
                $proposedImageRel = $imageCandidate['relative_path'];
                $proposedImageSource = $imageCandidate['source_type'];
                $existingStaticAlt = ! empty(trim((string) $imageCandidate['static_alt'])) ? trim($imageCandidate['static_alt']) : null;
                $proposedFeaturedAlt = $existingStaticAlt; // Per rules: use existing template ALT text, do not invent
            } else {
                $report['pages_no_suitable_image']++;
                $proposedImageRel = null;
                $proposedImageSource = 'None';
                $existingStaticAlt = null;
                $proposedFeaturedAlt = null;
            }

            if (empty($proposedFeaturedAlt)) {
                $report['pages_missing_image_alt']++;
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
                    'proposed' => $proposedFeaturedAlt, // empty if no alt / no featured image
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
                    'proposed' => $newsletter->title,
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
                'id' => $newsletter->id,
                'slug' => $newsletter->slug,
                'title' => $newsletter->title,
                'template' => $newsletter->template,
                'current_featured' => $currentFeatured ? $currentFeatured->file_name : null,
                'proposed_featured' => $proposedImageRel,
                'featured_source' => $proposedImageSource,
                'existing_static_alt' => $existingStaticAlt,
                'proposed_featured_alt' => $proposedFeaturedAlt,
                'candidate' => $imageCandidate,
                'seo_fields' => $pageSeoUpdates,
            ];
        }

        return $report;
    }

    /**
     * Apply the backfill updates to Newsletter models safely.
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
            $newsletterId = (int) $item['id'];
            $newsletter = Newsletter::find($newsletterId);

            if (! $newsletter) {
                $failed++;
                $errors[] = "Newsletter ID {$newsletterId} not found.";
                continue;
            }

            try {
                DB::transaction(function () use ($newsletter, $item, &$featuredApplied, &$seoApplied) {
                    // 1. Featured image backfill
                    if (empty($newsletter->getFirstMedia('featured_image')) && ! empty($item['candidate'])) {
                        $sourcePath = $item['candidate']['absolute_path'];
                        if (file_exists($sourcePath)) {
                            $customProps = [
                                'backfilled' => true,
                                'backfilled_at' => now()->toIso8601String(),
                            ];
                            if (! empty($item['proposed_featured_alt'])) {
                                $customProps['alt'] = $item['proposed_featured_alt'];
                            }

                            $newsletter
                                ->addMedia($sourcePath)
                                ->preservingOriginal()
                                ->withCustomProperties($customProps)
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
                        $seo = $newsletter->seoMeta;
                        if ($seo) {
                            $seo->fill($seoUpdates);
                            $seo->save();
                        } else {
                            $newsletter->seoMeta()->create($seoUpdates);
                        }
                        $seoApplied++;
                    }
                });
            } catch (Throwable $e) {
                $failed++;
                $errors[] = "Failed backfilling Newsletter ID {$newsletterId} ({$newsletter->slug}): {$e->getMessage()}";
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
     * Inspect Blade template to find the most appropriate existing newsletter image.
     *
     * @return array{filename: string, relative_path: string, absolute_path: string, source_type: string, static_alt: ?string, dimensions: string}|null
     */
    public function findBestFeaturedImage(Newsletter $newsletter): ?array
    {
        $bladePath = resource_path("views/newsletters/{$newsletter->template}.blade.php");
        if (! file_exists($bladePath)) {
            $bladePath = resource_path("views/newsletters/{$newsletter->slug}.blade.php");
        }

        if (! file_exists($bladePath)) {
            return null;
        }

        $content = file_get_contents($bladePath);

        // Newsletter helper prefix (defaults to 'images/newsletter/')
        $nlImgPrefix = 'images/newsletter/';
        if (preg_match('/\$nlImg\s*=\s*fn\s*\([^)]*\)(?:\s*:\s*string)?\s*=>\s*asset\(\s*[\'"]([^\'"]+?)[\'"]\s*\.\s*\$file\s*\)/i', $content, $hm)) {
            $nlImgPrefix = $hm[1];
        }

        // Priority 1: Hero image / hero background image: e.g. style="...url('...')" in hero section
        if (preg_match_all('/<section[^>]*class=[\'"][^\'"]*hero[^\'"]*[\'"][^>]*>(.*?)<\/section>/is', $content, $secMatches)) {
            foreach ($secMatches[0] as $heroHtml) {
                // Check inline style url(...)
                if (preg_match("/url\(\s*['\"]?\{\{\s*\\\$nlImg\(\s*['\"]([^'\"]+)['\"]\s*\)\s*\}\}['\"]?\s*\)/i", $heroHtml, $urlM)) {
                    $fn = $urlM[1];
                    $rel = rtrim($nlImgPrefix, '/').'/'.$fn;
                    $abs = public_path($rel);
                    if (file_exists($abs) && $this->isMeaningfulImage($abs, $fn)) {
                        $info = @getimagesize($abs);

                        return [
                            'filename' => $fn,
                            'relative_path' => $rel,
                            'absolute_path' => $abs,
                            'source_type' => 'Hero Background',
                            'static_alt' => null,
                            'dimensions' => $info ? "{$info[0]}x{$info[1]}" : 'unknown',
                        ];
                    }
                }

                // Check <img> in hero
                if (preg_match_all('/<img\s+([^>]*?)>/is', $heroHtml, $imgMatches)) {
                    foreach ($imgMatches[1] as $attrs) {
                        if (preg_match("/\\\$nlImg\(\s*['\"]([^'\"]+)['\"]\s*\)/i", $attrs, $fnM)) {
                            $fn = $fnM[1];
                            $rel = rtrim($nlImgPrefix, '/').'/'.$fn;
                            $abs = public_path($rel);
                            if (file_exists($abs) && $this->isMeaningfulImage($abs, $fn)) {
                                $alt = null;
                                if (preg_match('/alt=[\'"]([^\'"]*)[\'"]/i', $attrs, $altM)) {
                                    $alt = trim($altM[1]) !== '' ? trim($altM[1]) : null;
                                }
                                $info = @getimagesize($abs);

                                return [
                                    'filename' => $fn,
                                    'relative_path' => $rel,
                                    'absolute_path' => $abs,
                                    'source_type' => 'Hero image',
                                    'static_alt' => $alt,
                                    'dimensions' => $info ? "{$info[0]}x{$info[1]}" : 'unknown',
                                ];
                            }
                        }
                    }
                }
            }
        }

        // Priority 2: First meaningful content image
        if (preg_match_all('/<img\s+([^>]*?)>/is', $content, $imgMatches)) {
            foreach ($imgMatches[1] as $attrs) {
                if (preg_match("/\\\$nlImg\(\s*['\"]([^'\"]+)['\"]\s*\)/i", $attrs, $fnM)) {
                    $fn = $fnM[1];
                    $rel = rtrim($nlImgPrefix, '/').'/'.$fn;
                    $abs = public_path($rel);
                    if (file_exists($abs) && $this->isMeaningfulImage($abs, $fn)) {
                        $alt = null;
                        if (preg_match('/alt=[\'"]([^\'"]*)[\'"]/i', $attrs, $altM)) {
                            $alt = trim($altM[1]) !== '' ? trim($altM[1]) : null;
                        }
                        $info = @getimagesize($abs);

                        return [
                            'filename' => $fn,
                            'relative_path' => $rel,
                            'absolute_path' => $abs,
                            'source_type' => 'Content image',
                            'static_alt' => $alt,
                            'dimensions' => $info ? "{$info[0]}x{$info[1]}" : 'unknown',
                        ];
                    }
                }
            }
        }

        return null;
    }

    protected function isMeaningfulImage(string $absPath, string $filename): bool
    {
        $fn = strtolower($filename);
        $ext = pathinfo($fn, PATHINFO_EXTENSION);
        if ($ext === 'svg' || $ext === 'mp4') {
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
