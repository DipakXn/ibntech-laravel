<?php

namespace App\Console\Commands;

use App\Services\BlogSeoMetadataBackfillService;
use Illuminate\Console\Command;

class BackfillBlogSeoMetadataCommand extends Command
{
    protected $signature = 'blogs:backfill-seo-metadata
                            {--dry-run : Perform a dry-run audit without database changes (default)}
                            {--apply   : Apply the proposed SEO metadata updates to the database}
                            {--all     : Print all 522 blogs instead of a representative sample}
                            {--json    : Output the audit report strictly as JSON}';

    protected $description = 'Safe SEO metadata backfill for existing Blog records';

    public function handle(BlogSeoMetadataBackfillService $service): int
    {
        $isApply = (bool) $this->option('apply');
        $isDryRun = ! $isApply; // fail-closed: anything other than --apply is dry-run

        $report = $service->audit();

        if ($this->option('json')) {
            $this->line(json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

            return self::SUCCESS;
        }

        $this->newLine();
        $this->line('========================================================================================');
        $this->line('  blogs:backfill-seo-metadata');
        $this->line('========================================================================================');
        $this->newLine();
        $this->line('Mode : '.($isDryRun ? 'DRY RUN (No database modifications)' : 'APPLY (Writing to database)'));
        $this->newLine();

        $this->info('=== SUMMARY TOTALS ===');
        $this->table(
            ['Metric', 'Count'],
            [
                ['Total Blogs found', $report['total_blogs']],
                ['Blogs with existing Featured Image', $report['blogs_with_featured_image']],
                ['Blogs missing Featured Image', $report['blogs_missing_featured_image']],
                ['Blogs with Featured Image ALT', $report['blogs_with_featured_image_alt']],
                ['Blogs without Featured Image ALT', $report['blogs_without_featured_image_alt']],
                ['Existing SEO values preserved', $report['existing_seo_values_preserved']],
                ['Proposed OG Image Alt Text updates', $report['proposed_og_image_alt_updates']],
                ['Proposed OG Site Name updates', $report['proposed_og_site_name_updates']],
                ['Proposed OG Locale updates', $report['proposed_og_locale_updates']],
                ['Proposed Twitter Creator updates', $report['proposed_twitter_creator_updates']],
                ['Proposed Twitter Site updates', $report['proposed_twitter_site_updates']],
                ['Total proposed field updates', $report['total_proposed_field_updates']],
            ]
        );
        $this->newLine();

        $this->info('=== WRITE PAYLOAD RESTRICTION VERIFICATION ===');
        $this->line('The write payload is strictly locked to ONLY these 5 approved fields:');
        foreach (BlogSeoMetadataBackfillService::ALLOWED_FIELDS as $allowedField) {
            $this->line("  ✓ {$allowedField}");
        }
        $this->newLine();

        $itemsToShow = $this->option('all') ? $report['blogs'] : $report['samples'];
        $titlePrefix = $this->option('all') ? 'ALL 522 BLOGS' : 'REPRESENTATIVE SAMPLE MAPPING (First 10, Missing 5, Last 5)';

        $this->info("=== BLOG MAPPING: ID → SLUG → FEATURED IMAGE → ALT → PROPOSED OG ALT ({$titlePrefix}) ===");
        $rows = [];
        foreach ($itemsToShow as $b) {
            $rows[] = [
                $b['id'],
                mb_strimwidth($b['slug'], 0, 45, '...'),
                $b['featured_image'] ? mb_strimwidth($b['featured_image'], 0, 35, '...') : '[None]',
                $b['featured_image_alt'] ? mb_strimwidth($b['featured_image_alt'], 0, 40, '...') : '[None]',
                $b['proposed_og_image_alt'] ? mb_strimwidth($b['proposed_og_image_alt'], 0, 40, '...') : '[NULL]',
            ];
        }

        $this->table(
            ['Blog ID', 'Slug', 'Featured Image', 'Featured Image ALT', 'Proposed OG Image Alt Text'],
            $rows
        );
        $this->newLine();

        if ($isDryRun) {
            $this->comment('DRY RUN COMPLETE — Zero database or media changes were made.');
            $this->line('Review the proposed updates above. Run with --apply once explicitly approved.');

            return self::SUCCESS;
        }

        $this->info('Applying SEO metadata updates to database...');
        $result = $service->apply($report['blogs']);

        if ($result['failed'] > 0) {
            $this->error("Application completed with {$result['failed']} failures.");
            foreach ($result['errors'] as $error) {
                $this->error(" - {$error}");
            }

            return self::FAILURE;
        }

        $this->info("Application complete: {$result['blogs_updated']} blogs updated ({$result['fields_updated']} total SEO fields populated), 0 failed.");

        return self::SUCCESS;
    }
}
