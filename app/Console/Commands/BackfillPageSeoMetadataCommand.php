<?php

namespace App\Console\Commands;

use App\Services\PageSeoMetadataBackfillService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Backfill missing Open Graph and Twitter SEO metadata for existing Pages.
 *
 * Safety contract:
 *  - Fail-closed: dry-run by default unless --apply is explicitly passed.
 *  - Only touches existing Pages (never Blogs, Articles, Press Releases, Case Studies, etc.).
 *  - Only populates the 9 requested missing fields (never modifies og_image, twitter_image, schema, canonical, robots, etc.).
 *  - Never modifies Page title, slug, content, status, published_at, or featured images.
 *  - Uses existing SeoMeta model and seo_meta table.
 *  - No migrations, truncate, seeders, or destructive DB operations.
 */
class BackfillPageSeoMetadataCommand extends Command
{
    protected $signature = 'pages:backfill-seo-metadata
                            {--dry-run : Perform a dry run audit without database changes (default)}
                            {--apply   : Apply the proposed SEO metadata updates to the database}
                            {--json    : Output the audit report strictly as JSON}';

    protected $description = 'Backfill missing OG and Twitter metadata for existing Pages (dry-run by default; use --apply to write)';

    public function handle(PageSeoMetadataBackfillService $service): int
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
        $this->line('  pages:backfill-seo-metadata');
        $this->line('========================================================================================');
        $this->newLine();
        $this->line('Mode : '.($isDryRun ? 'DRY RUN (No database modifications)' : 'APPLY (Writing to database)'));
        $this->newLine();

        $this->info('=== SUMMARY STATISTICS ===');
        $this->table(
            ['Metric', 'Count', 'Description'],
            [
                ['Total Pages in database', $report['total_pages'], 'Total records in pages table'],
                ['Pages with existing SeoMeta row', $report['pages_with_seo_meta'], 'Pages with a related seo_meta record'],
                ['Pages without SeoMeta row', $report['pages_without_seo_meta'], 'Pages requiring new seo_meta record creation'],
                ['Pages already fully populated', $report['pages_fully_populated'], 'Pages having all 9 target fields populated'],
                ['Pages proposed for update', $report['pages_proposed_for_update'], 'Pages with one or more missing fields to backfill'],
            ]
        );
        $this->newLine();

        $this->info('=== FIELD POPULATION BREAKDOWN (TARGET: 9 FIELDS) ===');
        $fieldRows = [];
        foreach ($report['field_missing_counts'] as $field => $missingCount) {
            $presentCount = $report['field_populated_counts'][$field] ?? 0;
            $skippedCount = $report['skipped_source_unavailable'][$field] ?? 0;
            $toFillCount = $missingCount - $skippedCount;

            $fieldRows[] = [
                $field,
                $presentCount,
                $missingCount,
                $toFillCount,
                $skippedCount > 0 ? "{$skippedCount} skipped (source unavailable)" : '0',
            ];
        }
        $this->table(
            ['Field Name', 'Already Present', 'Missing / Empty', 'Will Backfill', 'Skipped (No Source)'],
            $fieldRows
        );
        $this->newLine();

        if (! empty($report['fully_populated_pages'])) {
            $this->info('=== PAGES ALREADY CORRECTLY POPULATED (' . count($report['fully_populated_pages']) . ') ===');
            $this->table(
                ['Page ID', 'Slug', 'Title'],
                array_map(fn ($p) => [$p['id'], $p['slug'], $p['title']], $report['fully_populated_pages'])
            );
            $this->newLine();
        }

        if (! empty($report['skipped_details'])) {
            $this->info('=== SKIPPED FIELDS DUE TO UNAVAILABLE SOURCE DATA (' . count($report['skipped_details']) . ' PAGES) ===');
            $skippedRows = [];
            foreach ($report['skipped_details'] as $sd) {
                foreach ($sd['skipped'] as $field => $reason) {
                    $skippedRows[] = [
                        $sd['id'],
                        $sd['slug'],
                        $field,
                        $reason,
                    ];
                }
            }
            $this->table(
                ['Page ID', 'Slug', 'Field Skipped', 'Reason'],
                $skippedRows
            );
            $this->newLine();
        }

        $this->info('=== PROPOSED METADATA UPDATES (' . count($report['proposed_updates']) . ' PAGES) ===');
        $updateRows = [];
        foreach ($report['proposed_updates'] as $pu) {
            foreach ($pu['changes'] as $field => $ch) {
                $oldStr = is_null($ch['old']) ? '[NULL]' : (string) $ch['old'];
                if (strlen($oldStr) > 40) {
                    $oldStr = substr($oldStr, 0, 37) . '...';
                }
                $newStr = is_null($ch['new']) ? '[NULL]' : (string) $ch['new'];
                if (strlen($newStr) > 40) {
                    $newStr = substr($newStr, 0, 37) . '...';
                }

                $updateRows[] = [
                    $pu['id'],
                    $pu['slug'],
                    $field,
                    $oldStr,
                    $newStr,
                ];
            }
        }
        $this->table(
            ['Page ID', 'Slug', 'Field', 'Old Value', 'New Value'],
            $updateRows
        );
        $this->newLine();

        // Save timestamped JSON audit log
        $logDir = storage_path('logs');
        if (! File::isDirectory($logDir)) {
            File::makeDirectory($logDir, 0755, true);
        }
        $timestamp = now()->format('Ymd_His');
        $jsonReportPath = "{$logDir}/seo-metadata-backfill-{$timestamp}.json";
        File::put($jsonReportPath, json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        $this->line("Audit report saved to: {$jsonReportPath}");
        $this->newLine();

        if ($isDryRun) {
            $this->warn('DRY RUN COMPLETE — Zero database changes were made.');
            $this->warn('Review the proposed updates above. Run with --apply once explicitly approved.');

            return self::SUCCESS;
        }

        // Apply mode
        $this->info('Applying SEO metadata updates to database...');
        $applyResult = $service->apply($report['proposed_updates']);

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
