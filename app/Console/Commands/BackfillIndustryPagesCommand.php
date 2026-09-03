<?php

namespace App\Console\Commands;

use App\Services\IndustryBackfillService;
use Illuminate\Console\Command;

class BackfillIndustryPagesCommand extends Command
{
    protected $signature = 'industries:backfill-featured-seo
                            {--dry-run : Perform a dry-run audit without database changes (default)}
                            {--apply   : Apply the proposed featured image and SEO metadata updates to the database}
                            {--json    : Output the audit report strictly as JSON}';

    protected $description = 'Safe combined Featured Image + SEO metadata backfill for the 10 existing Industry Pages';

    public function handle(IndustryBackfillService $service): int
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
        $this->line('  industries:backfill-featured-seo');
        $this->line('========================================================================================');
        $this->newLine();
        $this->line('Mode : '.($isDryRun ? 'DRY RUN (No database modifications)' : 'APPLY (Writing to database)'));
        $this->newLine();

        $this->info('=== SUMMARY TOTALS ===');
        $this->table(
            ['Metric', 'Count'],
            [
                ['Total Industry Pages', $report['total_pages']],
                ['Existing featured images', $report['existing_featured_images']],
                ['Proposed featured-image assignments', $report['proposed_featured_assignments']],
                ['Pages with no suitable image', $report['pages_no_suitable_image']],
                ['SEO fields proposed for update', $report['seo_fields_proposed_for_update']],
                ['Existing SEO values preserved', $report['existing_seo_values_preserved']],
                ['Pages with missing Meta Description', $report['pages_missing_meta_description']],
                ['Pages with missing featured-image ALT text', $report['pages_missing_featured_alt']],
            ]
        );
        $this->newLine();

        $this->info('=== PAGE-BY-PAGE AUDIT REPORT ===');
        $rows = [];
        foreach ($report['pages'] as $p) {
            $f = $p['seo_fields'];
            $rows[] = [
                $p['id'],
                $p['slug'],
                $p['current_featured'] ?: '[None]',
                $p['proposed_featured'] ?: '[None]',
                $p['featured_source'],
                ($f['og_image_alt']['current'] ?: '[NULL]').' → '.($f['og_image_alt']['proposed'] ?: '[NULL]'),
                ($f['og_type']['current'] ?: '[NULL]').' → '.($f['og_type']['proposed'] ?: '[NULL]'),
                ($f['og_site_name']['current'] ?: '[NULL]').' → '.($f['og_site_name']['proposed'] ?: '[NULL]'),
                ($f['og_locale']['current'] ?: '[NULL]').' → '.($f['og_locale']['proposed'] ?: '[NULL]'),
                ($f['twitter_card_type']['current'] ?: '[NULL]').' → '.($f['twitter_card_type']['proposed'] ?: '[NULL]'),
                ($f['twitter_title']['current'] ?: '[NULL]').' → '.($f['twitter_title']['proposed'] ?: '[NULL]'),
                mb_strimwidth(($f['twitter_description']['current'] ?: '[NULL]').' → '.($f['twitter_description']['proposed'] ?: '[NULL]'), 0, 40, '...'),
                ($f['twitter_creator']['current'] ?: '[NULL]').' → '.($f['twitter_creator']['proposed'] ?: '[NULL]'),
                ($f['twitter_site']['current'] ?: '[NULL]').' → '.($f['twitter_site']['proposed'] ?: '[NULL]'),
            ];
        }

        $this->table(
            [
                'ID',
                'Slug',
                'Current Featured',
                'Proposed Featured',
                'Source',
                'OG Alt',
                'OG Type',
                'OG Site',
                'OG Locale',
                'Twitter Card',
                'Twitter Title',
                'Twitter Desc',
                'Twitter Creator',
                'Twitter Site',
            ],
            $rows
        );
        $this->newLine();

        if ($isDryRun) {
            $this->comment('DRY RUN COMPLETE — Zero database or media changes were made.');
            $this->line('Review the proposed updates above. Run with --apply once explicitly approved.');

            return self::SUCCESS;
        }

        $this->info('Applying Featured Image and SEO metadata updates to database...');
        $result = $service->apply($report['pages']);

        if ($result['failed'] > 0) {
            $this->error("Application completed with {$result['failed']} failures.");
            foreach ($result['errors'] as $error) {
                $this->error(" - {$error}");
            }

            return self::FAILURE;
        }

        $this->info("Application complete: {$result['featured_applied']} featured images assigned, {$result['seo_applied']} SEO metadata records updated, 0 failed.");

        return self::SUCCESS;
    }
}
