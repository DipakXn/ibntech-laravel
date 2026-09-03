<?php

namespace App\Console\Commands;

use App\Services\PageFeaturedImageBackfillService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Backfill Featured Images for existing Pages.
 *
 * Safety contract:
 *  - Fail-closed: dry-run by default unless --apply is explicitly passed.
 *  - Never modifies any page fields (title, slug, template, status, published_at, SEO).
 *  - Never overwrites pages that already have a featured image.
 *  - Preserves Spatie Media Library structure and featured_image collection.
 *  - No migrations, truncate, seeders, or destructive DB operations.
 */
class BackfillPageFeaturedImagesCommand extends Command
{
    protected $signature = 'pages:backfill-featured-images
                            {--dry-run : Perform a dry run audit without database changes (default)}
                            {--apply   : Apply the proposed featured image assignments to the database}
                            {--json    : Output the audit report strictly as JSON}';

    protected $description = 'Backfill featured images for existing Pages (dry-run by default; use --apply to write)';

    public function handle(PageFeaturedImageBackfillService $service): int
    {
        $isApply = (bool) $this->option('apply');
        $isDryRun = ! $isApply; // fail-closed: anything other than --apply is dry-run

        @ini_set('memory_limit', '512M');
        @set_time_limit(0);

        $report = $service->audit();

        if ($this->option('json')) {
            $this->line(json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

            return self::SUCCESS;
        }

        $this->newLine();
        $this->line('========================================================================================');
        $this->line('  pages:backfill-featured-images');
        $this->line('========================================================================================');
        $this->newLine();
        $this->line('Mode : '.($isDryRun ? 'DRY RUN (No database modifications)' : 'APPLY (Writing to database)'));
        $this->newLine();

        $this->info('=== SUMMARY STATISTICS ===');
        $this->table(
            ['Metric', 'Count'],
            [
                ['Total Pages in database', $report['total_pages']],
                ['Pages already having featured images', $report['already_has_featured']],
                ['Pages missing featured images', $report['missing_featured']],
                ['Pages where a hero image was identified (Priority 1)', $report['hero_identified']],
                ['Pages where first meaningful content image was identified (Priority 2)', $report['content_identified']],
                ['Pages with no suitable image (Fallback to website logo)', $report['no_suitable_image']],
                ['Total proposed assignments', count($report['all_proposed'])],
            ]
        );
        $this->newLine();

        if (! empty($report['skipped_existing'])) {
            $this->info('=== PAGES ALREADY HAVING FEATURED IMAGES (SKIPPED) ===');
            $this->table(
                ['Page ID', 'Slug', 'Title', 'Existing Featured Image'],
                array_map(fn ($item) => [
                    $item['id'],
                    $item['slug'],
                    $item['title'],
                    $item['image'],
                ], $report['skipped_existing'])
            );
            $this->newLine();
        }

        if (! empty($report['hero_assignments'])) {
            $this->info('=== HERO IMAGE ASSIGNMENTS (PRIORITY 1: ' . count($report['hero_assignments']) . ') ===');
            $this->table(
                ['Page ID', 'Slug', 'Dimensions', 'Selected Image', 'Source'],
                array_map(fn ($item) => [
                    $item['id'],
                    $item['slug'],
                    $item['dimensions'],
                    $item['image'],
                    $item['source'],
                ], $report['hero_assignments'])
            );
            $this->newLine();
        }

        if (! empty($report['content_assignments'])) {
            $this->info('=== CONTENT IMAGE ASSIGNMENTS (PRIORITY 2: ' . count($report['content_assignments']) . ') ===');
            $this->table(
                ['Page ID', 'Slug', 'Dimensions', 'Selected Image', 'Source'],
                array_map(fn ($item) => [
                    $item['id'],
                    $item['slug'],
                    $item['dimensions'],
                    $item['image'],
                    $item['source'],
                ], $report['content_assignments'])
            );
            $this->newLine();
        }

        if (! empty($report['no_suitable'])) {
            $this->info('=== PAGES WITH NO SUITABLE IMAGE (PRIORITY 4 FALLBACK: ' . count($report['no_suitable']) . ') ===');
            $this->table(
                ['Page ID', 'Slug', 'Template', 'Reason / Fallback'],
                array_map(fn ($item) => [
                    $item['id'],
                    $item['slug'],
                    $item['template'],
                    'Left empty; uses default website logo fallback',
                ], $report['no_suitable'])
            );
            $this->newLine();
        }

        // Save timestamped JSON report
        $logDir = storage_path('logs');
        if (! File::isDirectory($logDir)) {
            File::makeDirectory($logDir, 0755, true);
        }
        $timestamp = now()->format('Ymd_His');
        $jsonReportPath = "{$logDir}/featured-image-backfill-{$timestamp}.json";
        File::put($jsonReportPath, json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        $this->line("Audit report saved to: {$jsonReportPath}");
        $this->newLine();

        if ($isDryRun) {
            $this->warn('DRY RUN COMPLETE — Zero database changes were made.');
            $this->warn('Review the proposed assignments above. Run with --apply once explicitly approved.');

            return self::SUCCESS;
        }

        // Apply mode
        $this->info('Applying featured image assignments to database...');
        $applyResult = $service->apply($report['all_proposed']);

        $this->newLine();
        $this->info("Application complete: {$applyResult['applied']} applied, {$applyResult['failed']} failed.");

        if (! empty($applyResult['errors'])) {
            $this->error('Errors encountered during application:');
            foreach ($applyResult['errors'] as $err) {
                $this->line(" - {$err}");
            }
        }

        return $applyResult['failed'] > 0 ? self::FAILURE : self::SUCCESS;
    }
}
