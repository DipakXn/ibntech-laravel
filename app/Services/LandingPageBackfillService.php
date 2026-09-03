<?php

namespace App\Services;

use App\Models\LandingPage;
use Illuminate\Support\Facades\DB;
use Throwable;

class LandingPageBackfillService
{
    public const OG_TYPE = 'article';
    public const OG_SITE_NAME = 'IBN Technologies';
    public const OG_LOCALE = 'en_US';
    public const TWITTER_CARD_TYPE = 'summary_large_image';
    public const TWITTER_CREATOR = 'IBNTechnology';
    public const TWITTER_SITE = 'IBNTechnology';

    /**
     * Run a dry-run audit across all 14 existing Landing Pages.
     *
     * @return array{
     *     total_pages: int,
     *     pages_already_having_featured_image: int,
     *     proposed_featured_assignments: int,
     *     pages_no_suitable_image: int,
     *     thank_you_pages_no_suitable_image: int,
     *     seo_fields_proposed_for_update: int,
     *     existing_seo_values_preserved: int,
     *     pages_missing_meta_description: int,
     *     pages_missing_image_alt: int,
     *     pages: array<int, array>
     * }
     */
    public function audit(): array
    {
        $landingPages = LandingPage::with(['seoMeta', 'media'])->orderBy('id')->get();

        $report = [
            'total_pages' => $landingPages->count(),
            'pages_already_having_featured_image' => 0,
            'proposed_featured_assignments' => 0,
            'pages_no_suitable_image' => 0,
            'thank_you_pages_no_suitable_image' => 0,
            'seo_fields_proposed_for_update' => 0,
            'existing_seo_values_preserved' => 0,
            'pages_missing_meta_description' => 0,
            'pages_missing_image_alt' => 0,
            'pages' => [],
        ];

        foreach ($landingPages as $page) {
            $seo = $page->seoMeta;
            $currentFeatured = $page->getFirstMedia('featured_image');
            $isThankYou = $page->isThankYouPage();

            if ($currentFeatured) {
                $report['pages_already_having_featured_image']++;
            }

            // PART 1: Featured Image Candidate Selection
            $imageCandidate = null;
            if (! $currentFeatured && ! $isThankYou) {
                $imageCandidate = $this->findBestFeaturedImage($page);
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
                $proposedFeaturedAlt = $existingStaticAlt; // Per rules: use existing Blade ALT text, do not invent
            } else {
                $report['pages_no_suitable_image']++;
                if ($isThankYou) {
                    $report['thank_you_pages_no_suitable_image']++;
                }
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
                    'proposed' => $page->title,
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
                'id' => $page->id,
                'slug' => $page->slug,
                'title' => $page->title,
                'template' => $page->template,
                'is_thank_you' => $isThankYou,
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
     * Apply the backfill updates to LandingPage models safely.
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
            $pageId = (int) $item['id'];
            $page = LandingPage::find($pageId);

            if (! $page) {
                $failed++;
                $errors[] = "LandingPage ID {$pageId} not found.";
                continue;
            }

            try {
                DB::transaction(function () use ($page, $item, &$featuredApplied, &$seoApplied) {
                    // 1. Featured image backfill
                    if (empty($page->getFirstMedia('featured_image')) && ! empty($item['candidate'])) {
                        $sourcePath = $item['candidate']['absolute_path'];
                        if (file_exists($sourcePath)) {
                            $customProps = [
                                'backfilled' => true,
                                'backfilled_at' => now()->toIso8601String(),
                            ];
                            if (! empty($item['proposed_featured_alt'])) {
                                $customProps['alt'] = $item['proposed_featured_alt'];
                            }

                            $page
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
                        $seo = $page->seoMeta;
                        if ($seo) {
                            $seo->fill($seoUpdates);
                            $seo->save();
                        } else {
                            $page->seoMeta()->create($seoUpdates);
                        }
                        $seoApplied++;
                    }
                });
            } catch (Throwable $e) {
                $failed++;
                $errors[] = "Failed backfilling LandingPage ID {$pageId} ({$page->slug}): {$e->getMessage()}";
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
     * Inspect Blade template to find the most appropriate existing page image.
     *
     * @return array{filename: string, relative_path: string, absolute_path: string, source_type: string, static_alt: ?string, dimensions: string}|null
     */
    public function findBestFeaturedImage(LandingPage $page): ?array
    {
        $bladePath = resource_path("views/landing-pages/{$page->template}.blade.php");
        if (! file_exists($bladePath)) {
            $bladePath = resource_path("views/landing-pages/{$page->slug}.blade.php");
        }

        if (! file_exists($bladePath)) {
            return null;
        }

        $content = file_get_contents($bladePath);

        // Landing pages helper prefix
        $lpImgPrefix = 'images/landing-pages/';
        if (preg_match('/\$lpImg\s*=\s*fn\s*\([^)]*\)(?:\s*:\s*string)?\s*=>\s*asset\(\s*[\'"]([^\'"]+?)[\'"]\s*\.\s*\$file\s*\)/i', $content, $hm)) {
            $lpImgPrefix = $hm[1];
        }

        // Priority 1: Hero image / hero background image: e.g. <img class="...hero__bg" ...> or within <section class="...hero"...>
        if (preg_match_all('/<section[^>]*class=[\'"][^\'"]*(?:hero|banner)[^\'"]*[\'"][^>]*>(.*?)<\/section>/is', $content, $secMatches)) {
            foreach ($secMatches[1] as $heroHtml) {
                if (preg_match_all('/<img\s+([^>]*?)>/is', $heroHtml, $imgMatches)) {
                    foreach ($imgMatches[1] as $attrs) {
                        if (preg_match("/\\\$lpImg\(\s*['\"]([^'\"]+)['\"]\s*\)/i", $attrs, $fnM)) {
                            $fn = $fnM[1];
                            $rel = rtrim($lpImgPrefix, '/').'/'.$fn;
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
                if (preg_match("/\\\$lpImg\(\s*['\"]([^'\"]+)['\"]\s*\)/i", $attrs, $fnM)) {
                    $fn = $fnM[1];
                    $rel = rtrim($lpImgPrefix, '/').'/'.$fn;
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
