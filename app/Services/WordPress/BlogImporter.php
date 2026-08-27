<?php

namespace App\Services\WordPress;

use App\Models\Blog;
use App\Models\BlogImport;
use App\Models\SeoMeta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class BlogImporter
{
    public function __construct(
        protected WordpressXmlReader $reader,
        protected HtmlToBlocksConverter $converter,
        protected CategoryImporter $categories,
        protected MediaImporter $media,
        protected SeoMapper $seo,
        protected LinkRewriter $links,
    ) {}

    /**
     * @param  array<int, int>  $onlyWordpressIds
     */
    public function import(string $file, bool $dryRun = false, int $limit = 0, bool $update = false, array $onlyWordpressIds = []): ImportReport
    {
        $report = new ImportReport;
        $onlyWordpressIds = array_values(array_unique(array_filter($onlyWordpressIds)));

        foreach ($this->reader->posts($file) as $post) {
            if (! $post->isPublished()) {
                $report->scanned++;
                $report->draftsSkipped++;

                continue;
            }

            if ($onlyWordpressIds !== [] && ! in_array($post->wordpressId, $onlyWordpressIds, true)) {
                continue;
            }

            if ($limit > 0 && ($report->created + $report->updated + $report->skipped + $report->failed) >= $limit) {
                break;
            }

            $report->scanned++;
            $report->published++;

            try {
                $this->importPost($post, $report, $dryRun, $update, $onlyWordpressIds !== []);
            } catch (Throwable $exception) {
                $report->fail($post, $exception->getMessage());
            }
        }

        return $report;
    }

    /**
     * @param  bool  $onlyMode  When true, never create blogs; update mapped imports even if the XML checksum is unchanged.
     */
    protected function importPost(WordpressPost $post, ImportReport $report, bool $dryRun, bool $update, bool $onlyMode = false): void
    {
        $mapping = BlogImport::query()->where('wordpress_id', $post->wordpressId)->first();

        if ($onlyMode && ! $mapping) {
            $report->skip($post, 'not imported; --only updates mapped WordPress blogs only');

            return;
        }

        if ($mapping && ! $update) {
            $report->skip($post, 'already imported');

            return;
        }

        if ($mapping && $update && ! $onlyMode && $mapping->checksum === $post->checksum()) {
            $report->skip($post, 'unchanged');

            return;
        }

        $existingBySlug = Blog::query()->where('slug', $post->slug)->first();

        if (! $mapping && $existingBySlug && ! $existingBySlug->isImportedFromWordPress()) {
            $report->skip($post, 'native Laravel blog slug collision');

            return;
        }

        if ($dryRun) {
            if ($mapping) {
                $report->updated++;
            } else {
                $report->created++;
                $report->createdSlugs[] = $post->slug;
            }

            $this->recordDryRunMedia($post, $report);

            return;
        }

        $converted = $this->converter->convert($post->content);

        if ($mapping) {
            $existingBlog = $mapping->blog()->first();

            if ($existingBlog instanceof Blog) {
                $this->reuseContentImageBlockIds($existingBlog, $converted);
            }
        }

        $blocks = $this->links->rewriteBlocks($converted['blocks']);

        if ($blocks === []) {
            $blocks = [[
                'type' => 'paragraph',
                'data' => ['content' => '<p></p>'],
            ]];
        }

        $blog = DB::transaction(function () use ($post, $mapping, $existingBySlug, $blocks, $report): Blog {
            $resolved = $this->categories->resolve($post->categoryPaths);
            $report->addUnmappedCategories($resolved['unmapped']);

            $slug = $this->resolveSlug($post, $mapping, $existingBySlug);
            $publishedAt = $this->publishedAt($post);

            if ($mapping) {
                $blog = $mapping->blog()->firstOrFail();
                $blog->fill([
                    'title' => $post->title,
                    'slug' => $slug,
                    'template' => 'default',
                    'content' => $blocks,
                    'category_id' => $resolved['category']?->id,
                    'status' => 'published',
                    'published_at' => $publishedAt,
                ]);
                $blog->save();
            } else {
                $blog = new Blog;
                $blog->fill([
                    'title' => $post->title,
                    'slug' => $slug,
                    'template' => 'default',
                    'content' => $blocks,
                    'category_id' => $resolved['category']?->id,
                    'status' => 'published',
                    'published_at' => $publishedAt,
                ]);
                $blog->featured_image = null;
                $blog->save();
            }

            $blog->load('category');

            SeoMeta::query()->updateOrCreate(
                [
                    'metable_type' => Blog::class,
                    'metable_id' => $blog->id,
                ],
                $this->seo->forPost($post, $blog, $blocks, $post->tags),
            );

            BlogImport::query()->updateOrCreate(
                ['wordpress_id' => $post->wordpressId],
                [
                    'wordpress_guid' => $post->permalink,
                    'blog_id' => $blog->id,
                    'source_file' => 'wordpress-blogs.xml',
                    'source_url' => $post->permalink,
                    'checksum' => $post->checksum(),
                    'unmapped_categories' => $resolved['unmapped'] !== [] ? $resolved['unmapped'] : null,
                    'imported_at' => now(),
                ],
            );

            return $blog->fresh(['category', 'media']);
        });

        $this->importMedia($blog, $post, $converted['images'], $report, isUpdate: (bool) $mapping);

        if ($mapping) {
            $report->updated++;
        } else {
            $report->created++;
            $report->createdSlugs[] = $blog->slug;
        }
    }

    /**
     * @param  array<int, array{block_id: string, url: string, alt: ?string, caption: ?string}>  $contentImages
     */
    protected function importMedia(Blog $blog, WordpressPost $post, array $contentImages, ImportReport $report, bool $isUpdate): void
    {
        $featured = $this->media->attachFeaturedImage(
            $blog,
            $post->featuredImageUrl,
            replaceExisting: false,
        );

        match ($featured) {
            'downloaded' => $report->featuredDownloaded++,
            'failed' => $report->featuredFailed++,
            'missing' => $report->featuredMissing++,
            default => null,
        };

        $content = $this->media->attachContentImages($blog, $contentImages);
        $report->contentImagesDownloaded += $content['downloaded'];
        $report->contentImagesFailed += $content['failed'];
    }

    protected function recordDryRunMedia(WordpressPost $post, ImportReport $report): void
    {
        if (blank($post->featuredImageUrl)) {
            $report->featuredMissing++;
        } else {
            $report->featuredDownloaded++;
        }

        $converted = $this->converter->convert($post->content);
        $this->recordUnmapped($post, $report);

        $report->contentImagesDownloaded += count($converted['images']);
    }

    protected function recordUnmapped(WordpressPost $post, ImportReport $report): void
    {
        $paths = $post->categoryPaths;
        array_shift($paths);

        $report->addUnmappedCategories(array_map(
            fn (array $path): string => implode(' > ', $path),
            $paths,
        ));
    }

    protected function resolveSlug(WordpressPost $post, ?BlogImport $mapping, ?Blog $existingBySlug): string
    {
        if ($mapping) {
            return $mapping->blog?->slug ?: $post->slug;
        }

        if (! $existingBySlug) {
            return $post->slug;
        }

        if ($existingBySlug->isImportedFromWordPress()) {
            return $this->uniqueSlug($post->slug);
        }

        return $post->slug;
    }

    protected function uniqueSlug(string $base): string
    {
        $suffix = 2;

        do {
            $candidate = $base.'-'.$suffix;
            $suffix++;
        } while (Blog::query()->where('slug', $candidate)->exists());

        return $candidate;
    }

    protected function publishedAt(WordpressPost $post): ?Carbon
    {
        if (blank($post->publishedDate)) {
            return now();
        }

        return Carbon::parse($post->publishedDate)->startOfDay();
    }

    /**
     * Keep existing Spatie content_blocks media across --update by reusing block_id when the source URL matches.
     *
     * @param  array{blocks: array<int, array<string, mixed>>, images: array<int, array{block_id: string, url: string, alt: ?string, caption: ?string}>}  $converted
     */
    protected function reuseContentImageBlockIds(Blog $blog, array &$converted): void
    {
        $media = $blog->getMedia('content_blocks');

        if ($media->isEmpty() || $converted['images'] === []) {
            return;
        }

        foreach ($converted['images'] as $index => $image) {
            $url = (string) ($image['url'] ?? '');
            $basename = strtolower((string) basename((string) parse_url($url, PHP_URL_PATH)));
            $match = $media->first(function ($item) use ($url, $basename): bool {
                $source = (string) data_get($item, 'custom_properties.source_url', '');

                if ($source !== '' && $source === $url) {
                    return true;
                }

                return $basename !== '' && str_contains(strtolower((string) $item->file_name), $basename);
            });

            if ($match === null) {
                continue;
            }

            $existingId = (string) data_get($match, 'custom_properties.block_id', '');

            if ($existingId === '') {
                continue;
            }

            $previousId = $image['block_id'];
            $converted['images'][$index]['block_id'] = $existingId;

            foreach ($converted['blocks'] as $blockIndex => $block) {
                if (($block['type'] ?? '') === 'image' && ($block['data']['block_id'] ?? '') === $previousId) {
                    $converted['blocks'][$blockIndex]['data']['block_id'] = $existingId;
                }
            }
        }
    }
}
