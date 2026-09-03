<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Throwable;

class PageFeaturedImageBackfillService
{
    /**
     * Run a dry-run audit across all pages without modifying the database.
     *
     * @return array{
     *     total_pages: int,
     *     already_has_featured: int,
     *     missing_featured: int,
     *     hero_identified: int,
     *     content_identified: int,
     *     no_suitable_image: int,
     *     skipped_existing: array<int, array{id: int, slug: string, title: string, image: string, media_id: int}>,
     *     hero_assignments: array<int, array{id: int, slug: string, title: string, template: string, type: string, image: string, filename: string, absolute_path: string, dimensions: string, source: string}>,
     *     content_assignments: array<int, array{id: int, slug: string, title: string, template: string, type: string, image: string, filename: string, absolute_path: string, dimensions: string, source: string}>,
     *     no_suitable: array<int, array{id: int, slug: string, title: string, template: string, reason: string}>,
     *     all_proposed: array<int, array{id: int, slug: string, title: string, template: string, type: string, image: string, filename: string, absolute_path: string, dimensions: string, source: string}>
     * }
     */
    public function audit(): array
    {
        $pages = Page::with('media')->orderBy('id')->get();

        $report = [
            'total_pages' => $pages->count(),
            'already_has_featured' => 0,
            'missing_featured' => 0,
            'hero_identified' => 0,
            'content_identified' => 0,
            'no_suitable_image' => 0,
            'skipped_existing' => [],
            'hero_assignments' => [],
            'content_assignments' => [],
            'no_suitable' => [],
            'all_proposed' => [],
        ];

        foreach ($pages as $page) {
            $existing = $page->getFirstMedia('featured_image');
            if ($existing) {
                $report['already_has_featured']++;
                $report['skipped_existing'][] = [
                    'id' => $page->id,
                    'slug' => $page->slug,
                    'title' => $page->title,
                    'image' => $existing->file_name,
                    'media_id' => $existing->id,
                ];
                continue;
            }

            $report['missing_featured']++;

            $candidate = $this->findBestFeaturedImage($page);

            if ($candidate && $candidate['is_hero']) {
                $report['hero_identified']++;
                $assignment = [
                    'id' => $page->id,
                    'slug' => $page->slug,
                    'title' => $page->title,
                    'template' => $page->template,
                    'type' => 'Hero image',
                    'image' => $candidate['relative_path'],
                    'filename' => $candidate['filename'],
                    'absolute_path' => $candidate['absolute_path'],
                    'dimensions' => "{$candidate['dimensions']['width']}x{$candidate['dimensions']['height']}",
                    'source' => $candidate['source_desc'],
                ];
                $report['hero_assignments'][] = $assignment;
                $report['all_proposed'][] = $assignment;
            } elseif ($candidate && ! $candidate['is_hero']) {
                $report['content_identified']++;
                $assignment = [
                    'id' => $page->id,
                    'slug' => $page->slug,
                    'title' => $page->title,
                    'template' => $page->template,
                    'type' => 'First content image',
                    'image' => $candidate['relative_path'],
                    'filename' => $candidate['filename'],
                    'absolute_path' => $candidate['absolute_path'],
                    'dimensions' => "{$candidate['dimensions']['width']}x{$candidate['dimensions']['height']}",
                    'source' => $candidate['source_desc'],
                ];
                $report['content_assignments'][] = $assignment;
                $report['all_proposed'][] = $assignment;
            } else {
                $report['no_suitable_image']++;
                $report['no_suitable'][] = [
                    'id' => $page->id,
                    'slug' => $page->slug,
                    'title' => $page->title,
                    'template' => $page->template,
                    'reason' => 'No suitable hero or content image found (only decorative icons/logos or empty)',
                ];
            }
        }

        // Sort all proposed by Page ID
        usort($report['all_proposed'], fn ($a, $b) => $a['id'] <=> $b['id']);

        return $report;
    }

    /**
     * Apply the proposed assignments safely using Spatie Media Library.
     *
     * @param  array<int, array{id: int, image: string, absolute_path: string, slug: string}>  $proposedAssignments
     * @return array{applied: int, failed: int, errors: array<int, string>}
     */
    public function apply(array $proposedAssignments): array
    {
        $applied = 0;
        $failed = 0;
        $errors = [];

        foreach ($proposedAssignments as $item) {
            $pageId = (int) $item['id'];
            $page = Page::find($pageId);

            if (! $page) {
                $failed++;
                $errors[] = "Page ID {$pageId} not found.";
                continue;
            }

            // Double check safety: do not overwrite existing featured image
            if ($page->getFirstMedia('featured_image')) {
                continue;
            }

            $sourcePath = $item['absolute_path'] ?? public_path($item['image']);

            if (! file_exists($sourcePath)) {
                $failed++;
                $errors[] = "Source image not found for Page ID {$pageId} ({$page->slug}): {$sourcePath}";
                continue;
            }

            try {
                DB::transaction(function () use ($page, $sourcePath) {
                    $page
                        ->addMedia($sourcePath)
                        ->preservingOriginal()
                        ->withCustomProperties([
                            'alt' => $page->title,
                            'backfilled' => true,
                            'backfilled_at' => now()->toIso8601String(),
                        ])
                        ->toMediaCollection('featured_image');
                });

                $applied++;
            } catch (Throwable $e) {
                $failed++;
                $errors[] = "Failed backfilling Page ID {$pageId} ({$page->slug}): {$e->getMessage()}";
            }
        }

        return [
            'applied' => $applied,
            'failed' => $failed,
            'errors' => $errors,
        ];
    }

    /**
     * Find the best featured image candidate for a given page.
     *
     * @return array{relative_path: string, absolute_path: string, is_hero: bool, source_desc: string, dimensions: array{width: int, height: int}, filename: string}|null
     */
    public function findBestFeaturedImage(Page $page): ?array
    {
        $candidates = $this->scanPageCandidates($page);

        // Priority 1: Clearly identifiable Hero Image / Hero Background Image
        foreach ($candidates as $candidate) {
            if ($candidate['is_hero'] && $this->isMeaningfulImage($candidate)) {
                return $candidate;
            }
        }

        // Priority 2: First meaningful image used in the page content
        foreach ($candidates as $candidate) {
            if (! $candidate['is_hero'] && $this->isMeaningfulImage($candidate)) {
                return $candidate;
            }
        }

        // Priority 4: No suitable image
        return null;
    }

    /**
     * Scan and extract all image candidates from the page template and CSS.
     *
     * @return array<int, array{relative_path: string, absolute_path: string, is_hero: bool, source_desc: string, dimensions: array{width: int, height: int}, filename: string, order: int}>
     */
    public function scanPageCandidates(Page $page): array
    {
        $template = $page->template;
        $bladePath = $this->resolveBladePath($template);

        if (! $bladePath || ! file_exists($bladePath)) {
            return [];
        }

        $bladeContent = file_get_contents($bladePath);
        $cssContent = $this->resolveCssContent($bladeContent);

        // Helper prefix detection (e.g. $img = fn(string $file) => asset('images/about-ibn/'.$file))
        $imgHelperPrefix = null;
        if (preg_match('/\$img\s*=\s*fn\s*\([^)]*\)(?:\s*:\s*string)?\s*=>\s*asset\(\s*[\'"]([^\'"]+?)[\'"]\s*\.\s*\$file\s*\)/i', $bladeContent, $hm)) {
            $imgHelperPrefix = $hm[1];
        } elseif (preg_match('/\$img\s*=\s*fn\s*\([^)]*\)(?:\s*:\s*string)?\s*=>\s*asset\(\s*["\']images\/([^"\']+?)\/["\']\s*\.\s*\$file\s*\)/i', $bladeContent, $hm)) {
            $imgHelperPrefix = "images/{$hm[1]}/";
        } elseif (file_exists(public_path("images/{$template}"))) {
            $imgHelperPrefix = "images/{$template}/";
        } elseif (file_exists(public_path("images/{$page->slug}"))) {
            $imgHelperPrefix = "images/{$page->slug}/";
        }

        // Foreach singular => plural variable mapping
        $foreachMap = [];
        if (preg_match_all('/@foreach\s*\(\s*\$([a-zA-Z0-9_]+)\s+as\s+(?:\$([a-zA-Z0-9_]+)\s*=>\s*)?\$([a-zA-Z0-9_]+)\s*\)/i', $bladeContent, $fMatches, PREG_SET_ORDER)) {
            foreach ($fMatches as $fm) {
                $plural = $fm[1];
                $singular = ! empty($fm[3]) ? $fm[3] : $fm[2];
                $foreachMap[$singular] = $plural;
            }
        }

        $candidates = [];

        // 1. CSS Background Images
        if ($cssContent) {
            if (preg_match_all('/([^{}]+)\s*\{([^}]+)\}/s', $cssContent, $rules, PREG_SET_ORDER)) {
                foreach ($rules as $rule) {
                    $selector = trim($rule[1]);
                    $body = $rule[2];
                    if (preg_match('/background(?:-image)?\s*:\s*[^;]*url\(\s*[\'"]?([^\'")\s]+)[\'"]?\s*\)/i', $body, $bgMatch)) {
                        $rawUrl = $bgMatch[1];
                        $cleanPath = $this->normalizePath($rawUrl, $template, $page->slug, $imgHelperPrefix);
                        if ($cleanPath && file_exists(public_path($cleanPath))) {
                            $isHero = (bool) preg_match('/hero|banner|head/i', $selector);
                            $candidates[] = [
                                'relative_path' => $cleanPath,
                                'absolute_path' => public_path($cleanPath),
                                'is_hero' => $isHero,
                                'source_desc' => "CSS background: {$selector}",
                                'dimensions' => $this->getImageDimensions(public_path($cleanPath)),
                                'filename' => basename($cleanPath),
                                'order' => 10,
                            ];
                        }
                    }
                }
            }
        }

        // 2. Inline style url(...) or CSS vars in Blade
        if (preg_match_all('/url\(\s*(.*?)\s*\)/is', $bladeContent, $urlMatches, PREG_OFFSET_CAPTURE)) {
            foreach ($urlMatches[0] as $idx => $m) {
                $matchedCall = $m[0];
                $offset = $m[1];
                $inside = $urlMatches[1][$idx][0];

                $rawPath = null;
                if (preg_match("/\\\$img\(\s*['\"]([^'\"]+)['\"]/i", $inside, $imM)) {
                    $rawPath = ($imgHelperPrefix ?? "images/{$template}/").$imM[1];
                } elseif (preg_match("/asset\(\s*['\"]([^'\"]+)['\"]/i", $inside, $asM)) {
                    $rawPath = $asM[1];
                } elseif (preg_match("/['\"]?([a-zA-Z0-9_\-\.\/]+\.(?:png|jpe?g|webp|svg|gif))['\"]?/i", $inside, $fM)) {
                    $rawPath = $fM[1];
                }

                if ($rawPath) {
                    $cleanPath = $this->normalizePath($rawPath, $template, $page->slug, $imgHelperPrefix);
                    if ($cleanPath && file_exists(public_path($cleanPath))) {
                        $before = substr($bladeContent, max(0, $offset - 300), 300);
                        $isHero = (bool) preg_match('/hero|banner/i', $before)
                            || (bool) preg_match('/hero|banner/i', $matchedCall)
                            || (bool) preg_match('/hero|banner/i', basename($cleanPath));

                        $candidates[] = [
                            'relative_path' => $cleanPath,
                            'absolute_path' => public_path($cleanPath),
                            'is_hero' => $isHero,
                            'source_desc' => "Inline style url()",
                            'dimensions' => $this->getImageDimensions(public_path($cleanPath)),
                            'filename' => basename($cleanPath),
                            'order' => $offset,
                        ];
                    }
                }
            }
        }

        // 3. <img> tags in Blade
        if (preg_match_all('/<img\s+([^>]*?)>/is', $bladeContent, $imgMatches, PREG_OFFSET_CAPTURE)) {
            foreach ($imgMatches[0] as $idx => $match) {
                $offset = $match[1];
                $attrs = $imgMatches[1][$idx][0];

                $extractedPaths = [];

                if (preg_match("/\\\$img\(\s*['\"]([^'\"]+)['\"]\s*\)/i", $attrs, $imM)) {
                    $extractedPaths[] = ($imgHelperPrefix ?? "images/{$template}/").$imM[1];
                } elseif (preg_match("/\\\$img\(\s*\\\$([a-zA-Z0-9_]+)\[['\"]([a-zA-Z0-9_]+)['\"]\]\s*\)/i", $attrs, $dynM)) {
                    $varName = $dynM[1];
                    $prop = $dynM[2];
                    $arrayFiles = $this->resolveArrayPropValues($bladeContent, $varName, $prop, $foreachMap);
                    foreach ($arrayFiles as $af) {
                        $extractedPaths[] = ($imgHelperPrefix ?? "images/{$template}/").$af;
                    }
                } elseif (preg_match("/asset\(\s*['\"]([^'\"]+)['\"]\s*\)/i", $attrs, $asM)) {
                    $extractedPaths[] = $asM[1];
                } elseif (preg_match("/asset\(\s*['\"]([^'\"]+)['\"]\s*\.\s*\\$([a-zA-Z0-9_]+)\[['\"]([a-zA-Z0-9_]+)['\"]\]\s*\)/i", $attrs, $dynM)) {
                    $prefix = $dynM[1];
                    $varName = $dynM[2];
                    $prop = $dynM[3];
                    $arrayFiles = $this->resolveArrayPropValues($bladeContent, $varName, $prop, $foreachMap);
                    foreach ($arrayFiles as $af) {
                        $extractedPaths[] = rtrim($prefix, '/').'/'.ltrim($af, '/');
                    }
                } elseif (preg_match('/src\s*=\s*["\']([^"\']+)["\']/i', $attrs, $srcM)) {
                    $val = $srcM[1];
                    if (! str_contains($val, '{{')) {
                        $extractedPaths[] = $val;
                    }
                }

                foreach ($extractedPaths as $rawPath) {
                    $cleanPath = $this->normalizePath($rawPath, $template, $page->slug, $imgHelperPrefix);
                    if ($cleanPath && file_exists(public_path($cleanPath))) {
                        $before = substr($bladeContent, max(0, $offset - 400), 400);
                        $isHero = (bool) preg_match('/hero|banner/i', $before)
                            || (bool) preg_match('/hero|banner/i', $attrs)
                            || (bool) preg_match('/hero|banner/i', basename($cleanPath));

                        $candidates[] = [
                            'relative_path' => $cleanPath,
                            'absolute_path' => public_path($cleanPath),
                            'is_hero' => $isHero,
                            'source_desc' => '<img> tag',
                            'dimensions' => $this->getImageDimensions(public_path($cleanPath)),
                            'filename' => basename($cleanPath),
                            'order' => $offset,
                        ];
                    }
                }
            }
        }

        // 4. Dedicated image folder fallback
        if (empty($candidates)) {
            $folders = [
                public_path("images/{$template}"),
                public_path("images/{$page->slug}"),
            ];
            foreach ($folders as $f) {
                if (File::isDirectory($f)) {
                    $files = File::files($f);
                    foreach ($files as $file) {
                        $fn = $file->getFilename();
                        $rel = 'images/'.basename($f).'/'.$fn;
                        $isHero = (bool) preg_match('/hero|banner/i', $fn);
                        $candidates[] = [
                            'relative_path' => $rel,
                            'absolute_path' => $file->getRealPath(),
                            'is_hero' => $isHero,
                            'source_desc' => 'Images directory file',
                            'dimensions' => $this->getImageDimensions($file->getRealPath()),
                            'filename' => $fn,
                            'order' => 9999,
                        ];
                    }
                    break;
                }
            }
        }

        // Sort in appearance order
        usort($candidates, fn ($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));

        // Deduplicate
        $unique = [];
        $seen = [];
        foreach ($candidates as $c) {
            if (! isset($seen[$c['relative_path']])) {
                $seen[$c['relative_path']] = true;
                $unique[] = $c;
            }
        }

        return $unique;
    }

    /**
     * Determine if a candidate image is meaningful or decorative.
     *
     * @param  array{relative_path: string, filename: string, dimensions: array{width: int, height: int}}  $candidate
     */
    public function isMeaningfulImage(array $candidate): bool
    {
        $path = str_replace('\\', '/', strtolower($candidate['relative_path']));
        $fn = strtolower($candidate['filename']);
        $ext = pathinfo($fn, PATHINFO_EXTENSION);
        $w = $candidate['dimensions']['width'] ?? 0;
        $h = $candidate['dimensions']['height'] ?? 0;

        // Ignore SVGs (predominantly UI icons and graphics)
        if ($ext === 'svg') {
            return false;
        }

        // Ignore known logo, cert, badge, and icon directory trees
        $ignoredFolders = [
            'client-logos',
            'client_logos',
            'accounting-certified-logos',
            'accounting-software-expertise-logos',
            'vapt-certs',
            'certificates',
            'partner-logos',
            'partners',
            'trust-badges',
            'favicon',
            'favicon_io',
            'icons',
            'tools',
            'tech-stack',
            'ms-certifications',
        ];
        foreach ($ignoredFolders as $dir) {
            if (str_contains($path, '/'.$dir.'/') || str_starts_with($path, $dir.'/') || str_contains($path, 'images/'.$dir)) {
                return false;
            }
        }

        // Ignore filenames matching logos, icons, badges, UI elements, ratings
        $ignoredFilePatterns = [
            'logo',
            '-icon',
            '_icon',
            'icon-',
            'icon.',
            'star',
            'rating',
            'clutch',
            'goodfirms',
            'badge',
            'award',
            'arrow',
            'check',
            'tick',
            'bullet',
            'close',
            'menu',
            'quote',
            'play-btn',
            'transparency',
            'reliability',
            'creativity',
            'customer-centricity',
            'call-icon',
            'email-icon',
            'location-icon',
            'phone',
            'mail',
            'user-icon',
            'green-icon',
            'pc-check-icon',
            'pc-cog-icon',
            'light-blub-icon',
            'doc-data-icon',
            'search-icon',
            'avatar',
            'flag-icon',
        ];
        foreach ($ignoredFilePatterns as $pattern) {
            if (str_contains($fn, $pattern)) {
                return false;
            }
        }

        // Exclude specific vendor/partner badges and logos
        $partnerNames = [
            'trimble', 'procore', 'stack', 'bluebeam', 'rib-costx', 'acronis', 'nutanix', 'spot',
            'amazon-web-services', 'google-cloud', 'microsoft-azure', 'jio-cloud', 'private-cloud',
            'microsoft-defender', 'fortinet', 'sophos', 'crowdstrike', 'paloalto', 'nessus',
            'burp-suite', 'nmap', 'owasp', 'metasploit', 'qualys', 'mobsf', 'nikto', 'cobalt-strike',
            'manage-engine', 'amazon-inspector', 'kali', 'aws', 'azure-arc', 'azure-devops',
            'aws-tooling', 'open-source', 'deep-integrations', 'ms-azure', 'ms-cybersecurity',
            'ms-enterprise', 'ms-identity', 'ms-security', 'vsoftcorp', 'askmia', 'orowealth',
            'ephlux', 'abitach', 'atlantic-data', 'azuga', 'cloud-rewind', 'demand-media',
            'digital-zone', 'docully', 'dod-technologies', 'em6-worldwide', 'instem', 'lattice',
            'maximeyes', 'mtx', 'tradesun', 'wassha', 'aurionpro', 'british-orient', 'chemito',
            'contata', 'isckon', 'lenden', 'mapmyindia', 'routematic', 'wint', 'lt', 'bike-bazaar',
            'aws-partner-logo', 'nvidia-logo-vert-blk_thmb',
        ];
        foreach ($partnerNames as $pName) {
            $base = pathinfo($fn, PATHINFO_FILENAME);
            if ($base === $pName || $base === $pName.'-1' || $base === $pName.'-2') {
                return false;
            }
        }

        // Dimension filters: ignore small icons and extreme aspect ratio lines
        if ($w > 0 && $h > 0) {
            if ($w <= 120 && $h <= 120) {
                return false;
            }
            $ratio = $w / $h;
            if ($ratio > 8 || $ratio < 0.125) {
                return false;
            }
        }

        return true;
    }

    protected function resolveArrayPropValues(string $bladeContent, string $varName, string $prop, array $foreachMap = []): array
    {
        $values = [];
        $namesToTry = [$varName];
        if (isset($foreachMap[$varName])) {
            $namesToTry[] = $foreachMap[$varName];
        }
        $namesToTry[] = $varName.'s';
        $namesToTry[] = rtrim($varName, 's');

        foreach ($namesToTry as $name) {
            if (preg_match('/\$'.preg_quote($name, '/').'\s*=\s*\[(.*?)\];/s', $bladeContent, $arrMatch)) {
                $body = $arrMatch[1];
                if (preg_match_all("/['\"]".preg_quote($prop, '/')."['\"]\s*=>\s*['\"]([^'\"]+)['\"]/i", $body, $m)) {
                    $values = array_merge($values, $m[1]);
                }
            }
        }

        return array_unique($values);
    }

    protected function resolveBladePath(string $template): ?string
    {
        $p1 = resource_path("views/pages/{$template}.blade.php");
        if (file_exists($p1)) {
            return $p1;
        }
        $p2 = resource_path("views/{$template}.blade.php");
        if (file_exists($p2)) {
            return $p2;
        }

        return null;
    }

    protected function resolveCssContent(string $bladeContent): string
    {
        if (preg_match("/@vite\(\[?['\"]([^'\"]+\.css)['\"]\]?\)/i", $bladeContent, $m)) {
            $cssPath = resource_path(str_replace('resources/', '', $m[1]));
            if (file_exists($cssPath)) {
                return file_get_contents($cssPath);
            }
        }

        return '';
    }

    protected function normalizePath(string $path, string $template, string $slug, ?string $imgHelperPrefix = null): ?string
    {
        $path = trim($path);
        $path = preg_replace('/^(\.\.\/)+/', '', $path);
        $path = ltrim($path, '/');

        if (str_starts_with($path, 'public/')) {
            $path = substr($path, 7);
        }

        if (file_exists(public_path($path))) {
            return $path;
        }

        if ($imgHelperPrefix && file_exists(public_path(rtrim($imgHelperPrefix, '/').'/'.basename($path)))) {
            return rtrim($imgHelperPrefix, '/').'/'.basename($path);
        }

        if (file_exists(public_path("images/{$template}/".basename($path)))) {
            return "images/{$template}/".basename($path);
        }

        if (file_exists(public_path("images/{$slug}/".basename($path)))) {
            return "images/{$slug}/".basename($path);
        }

        return null;
    }

    protected function getImageDimensions(string $absolutePath): array
    {
        if (! file_exists($absolutePath)) {
            return ['width' => 0, 'height' => 0];
        }
        $info = @getimagesize($absolutePath);
        if ($info) {
            return ['width' => $info[0], 'height' => $info[1]];
        }

        return ['width' => 0, 'height' => 0];
    }
}
