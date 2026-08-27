<?php

namespace App\Services\WordPress;

use App\Models\PressRelease;
use App\Models\PressReleaseImport;
use App\Models\SeoMeta;
use App\Support\BlockContent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class PressReleaseImporter
{
    public function __construct(
        protected PressReleaseXmlReader $reader,
        protected PressReleasePublishDateReader $dates,
        protected PressReleaseHtmlPreprocessor $preprocessor,
        protected HtmlToBlocksConverter $converter,
        protected PressReleaseMediaImporter $media,
    ) {}

    /**
     * @param  array<int, string>  $onlySlugs
     */
    public function dryRun(string $directory, string $dateFile, array $onlySlugs = []): PressReleaseImportReport
    {
        return $this->import($directory, $dateFile, dryRun: true, onlySlugs: $onlySlugs);
    }

    /**
     * @param  array<int, string>  $onlySlugs
     */
    public function write(string $directory, string $dateFile, array $onlySlugs = [], bool $allowRemaining = false): PressReleaseImportReport
    {
        if ($onlySlugs === [] && ! $allowRemaining) {
            throw new \RuntimeException('Write mode requires --only or --remaining so Press Releases are not imported accidentally.');
        }

        return $this->import($directory, $dateFile, dryRun: false, onlySlugs: $onlySlugs, allowRemaining: $allowRemaining);
    }

    /**
     * @param  array<int, string>  $onlySlugs
     */
    public function import(string $directory, string $dateFile, bool $dryRun = true, array $onlySlugs = [], bool $allowRemaining = false): PressReleaseImportReport
    {
        if (! $dryRun && $onlySlugs === [] && ! $allowRemaining) {
            throw new \RuntimeException('Write mode requires --only or --remaining so Press Releases are not imported accidentally.');
        }

        $report = new PressReleaseImportReport;
        $dateMap = $this->dates->mappings($dateFile);
        $report->dateMappings = count($dateMap['dates']);
        $report->duplicateDates = $dateMap['duplicates'];
        $report->invalidDates = $dateMap['invalid'];

        $onlySlugs = array_values(array_unique(array_filter($onlySlugs)));
        $seenKeys = [];
        $seenOnlySlugs = [];

        foreach ($this->reader->posts($directory) as $post) {
            $report->scanned++;
            $key = PressReleasePermalink::normalize($post->permalink);
            $seenKeys[] = $key;

            try {
                $this->recordPost(
                    $post,
                    $dateMap['dates'][$key] ?? null,
                    $report,
                    $dryRun,
                    $onlySlugs,
                    $seenOnlySlugs,
                );
            } catch (Throwable $exception) {
                $report->failed++;
                $report->failedItems[] = [
                    'slug' => $post->slug,
                    'file' => $post->sourceFile,
                    'error' => $exception->getMessage(),
                ];
            }
        }

        foreach ($dateMap['permalinks'] as $key => $permalink) {
            if (! in_array($key, $seenKeys, true)) {
                $report->extraDates[] = $permalink;
            }
        }

        foreach ($onlySlugs as $slug) {
            if (in_array($slug, $seenOnlySlugs, true)) {
                continue;
            }

            $report->failed++;
            $report->failedItems[] = [
                'slug' => $slug,
                'file' => '',
                'error' => 'slug not found in Press Release XML directory',
            ];
        }

        return $report;
    }

    /**
     * @param  array<int, string>  $onlySlugs
     * @param  array<int, string>  $seenOnlySlugs
     */
    protected function recordPost(
        PressReleasePost $post,
        ?Carbon $publishedAt,
        PressReleaseImportReport $report,
        bool $dryRun,
        array $onlySlugs,
        array &$seenOnlySlugs,
    ): void {
        if ($publishedAt === null) {
            $report->missingDates[] = [
                'slug' => $post->slug,
                'permalink' => $post->permalink,
            ];
        }

        if ($post->isProtected()) {
            $report->skippedProtected++;
            $report->skippedItems[] = [
                'slug' => $post->slug,
                'reason' => 'protected manually created Press Release #4',
            ];

            if (in_array($post->slug, $onlySlugs, true)) {
                $seenOnlySlugs[] = $post->slug;
            }

            return;
        }

        if ($onlySlugs !== [] && ! in_array($post->slug, $onlySlugs, true)) {
            $report->skippedNotInOnly++;

            return;
        }

        if (in_array($post->slug, $onlySlugs, true)) {
            $seenOnlySlugs[] = $post->slug;
        }

        $html = $this->preprocessor->process($post->content);
        $converted = $this->converter->convert($html);
        $blocks = $converted['blocks'];
        $images = $converted['images'];

        if ($blocks === []) {
            $blocks = [[
                'type' => 'paragraph',
                'data' => ['content' => '<p></p>'],
            ]];
        }

        $featured = $this->leadingFeaturedImage($blocks, $images);
        if ($featured !== null) {
            $report->featuredImages++;
            $images = array_values(array_filter(
                $images,
                fn (array $image): bool => ($image['block_id'] ?? '') !== $featured['block_id'],
            ));
            $blocks = $this->blocksWithoutLeadingFeatured($blocks, $featured);
        }

        $report->contentImages += count($images);

        if ($publishedAt === null) {
            $report->failed++;
            $report->failedItems[] = [
                'slug' => $post->slug,
                'file' => $post->sourceFile,
                'error' => 'publish date missing from pr-publish-date.xml',
            ];

            return;
        }

        $item = [
            'slug' => $post->slug,
            'title' => $post->title,
            'source_file' => $post->sourceFile,
            'permalink' => $post->permalink,
            'public_url' => PressReleasePermalink::publicPath($post->slug),
            'published_at' => $publishedAt->toDateString(),
            'block_count' => count($blocks),
            'block_types' => array_count_values(array_map(
                fn (array $block): string => (string) ($block['type'] ?? 'unknown'),
                $blocks,
            )),
            'featured_image' => $featured['url'] ?? null,
            'seo' => $this->plannedSeo($post, $blocks, $publishedAt),
        ];

        if ($dryRun) {
            $report->wouldCreate++;
            $report->wouldCreateSlugs[] = $post->slug;
            $report->wouldCreateItems[] = $item;

            return;
        }

        $existing = PressRelease::query()->where('slug', $post->slug)->first();
        $mapping = PressReleaseImport::query()
            ->where('source_key', PressReleasePermalink::normalize($post->permalink))
            ->first();

        if ($mapping || $existing) {
            $report->skippedExisting++;
            $report->skippedItems[] = [
                'slug' => $post->slug,
                'reason' => $mapping ? 'already imported' : 'existing Press Release slug collision',
            ];

            return;
        }

        $pressRelease = $this->writePost($post, $publishedAt, $blocks);

        $this->importMedia($pressRelease, $featured['url'] ?? null, $images, $report);

        Cache::forget("press-release:{$pressRelease->slug}");

        $report->created++;
        $report->createdSlugs[] = $pressRelease->slug;
        $report->createdItems[] = $item;
    }

    /**
     * @param  array<int, array<string, mixed>>  $blocks
     */
    protected function writePost(PressReleasePost $post, Carbon $publishedAt, array $blocks): PressRelease
    {
        return DB::transaction(function () use ($post, $publishedAt, $blocks): PressRelease {
            $pressRelease = new PressRelease;
            $pressRelease->fill([
                'title' => $post->title,
                'slug' => $post->slug,
                'template' => 'default',
                'excerpt' => null,
                'content' => $blocks,
                'category_id' => null,
                'status' => 'published',
                'published_at' => $publishedAt->copy()->startOfDay(),
            ]);
            $pressRelease->featured_image = null;
            $pressRelease->save();

            SeoMeta::query()->updateOrCreate(
                [
                    'metable_type' => PressRelease::class,
                    'metable_id' => $pressRelease->id,
                ],
                $this->plannedSeo($post, $blocks, $publishedAt),
            );

            PressReleaseImport::query()->create([
                'source_key' => PressReleasePermalink::normalize($post->permalink),
                'source_url' => $post->permalink,
                'press_release_id' => $pressRelease->id,
                'source_file' => $post->sourceFile,
                'checksum' => $post->checksum(),
                'imported_at' => now(),
            ]);

            return $pressRelease->fresh(['seoMeta', 'media']);
        });
    }

    /**
     * @param  array<int, array{block_id: string, url: string, alt: ?string, caption: ?string}>  $contentImages
     */
    protected function importMedia(
        PressRelease $pressRelease,
        ?string $featuredUrl,
        array $contentImages,
        PressReleaseImportReport $report,
    ): void {
        $featured = $this->media->attachFeaturedImage($pressRelease, $featuredUrl);

        match ($featured) {
            'downloaded' => $report->featuredDownloaded++,
            'failed' => $report->featuredFailed++,
            default => null,
        };

        $content = $this->media->attachContentImages($pressRelease, $contentImages);
        $report->contentImagesDownloaded += $content['downloaded'];
        $report->contentImagesFailed += $content['failed'];
    }

    /**
     * @param  array<int, array<string, mixed>>  $blocks
     * @param  array<int, array{block_id: string, url: string, alt: ?string, caption: ?string}>  $images
     * @return array{block_id: string, url: string, alt: ?string, caption: ?string}|null
     */
    protected function leadingFeaturedImage(array $blocks, array $images): ?array
    {
        $first = $blocks[0] ?? null;

        if (! is_array($first) || ($first['type'] ?? '') !== 'image') {
            return null;
        }

        $blockId = (string) ($first['data']['block_id'] ?? '');

        foreach ($images as $image) {
            if (($image['block_id'] ?? '') === $blockId) {
                return $image;
            }
        }

        return null;
    }

    /**
     * @param  array<int, array<string, mixed>>  $blocks
     * @param  array{block_id: string, url: string, alt: ?string, caption: ?string}  $featured
     * @return array<int, array<string, mixed>>
     */
    protected function blocksWithoutLeadingFeatured(array $blocks, array $featured): array
    {
        $first = $blocks[0] ?? null;

        if (! is_array($first) || ($first['type'] ?? '') !== 'image') {
            return $blocks;
        }

        if ((string) ($first['data']['block_id'] ?? '') !== $featured['block_id']) {
            return $blocks;
        }

        return array_values(array_slice($blocks, 1));
    }

    /**
     * @param  array<int, array<string, mixed>>  $blocks
     * @return array<string, mixed>
     */
    protected function plannedSeo(PressReleasePost $post, array $blocks, ?Carbon $publishedAt = null): array
    {
        $title = $post->rankMathTitle ?: $post->title;
        $description = $post->rankMathDescription ?: BlockContent::summary($blocks, 160);

        return [
            'meta_title' => Str::limit($title, 255, ''),
            'meta_description' => $description !== '' ? $description : null,
            'og_title' => Str::limit($title, 255, ''),
            'og_description' => $description !== '' ? $description : null,
            'og_type' => 'article',
            'og_site_name' => 'IBN Technologies',
            'twitter_title' => Str::limit($title, 255, ''),
            'twitter_description' => $description !== '' ? $description : null,
            'twitter_card_type' => 'summary_large_image',
            'robots_index' => 'index',
            'robots_follow' => 'follow',
            'sitemap_include' => true,
            'schema_generated' => false,
            'faq_schema' => false,
            'article_author' => null,
            'canonical_url' => null,
            'published_at' => $publishedAt?->copy()->startOfDay(),
        ];
    }
}
