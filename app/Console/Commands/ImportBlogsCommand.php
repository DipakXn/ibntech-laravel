<?php

namespace App\Console\Commands;

use App\Services\WordPress\BlogImporter;
use App\Services\WordPress\ImportReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportBlogsCommand extends Command
{
    protected $signature = 'blogs:import
                            {file? : Path to the WordPress XML export}
                            {--dry-run : Parse and report without writing to the database}
                            {--limit=0 : Maximum published posts to process (0 = all)}
                            {--update : Update posts that were previously imported}
                            {--only= : Comma-separated WordPress IDs to process (mapped imports only)}';

    protected $description = 'Import published WordPress blog posts into the Laravel Blog model';

    public function handle(BlogImporter $importer): int
    {
        $file = $this->argument('file') ?: storage_path('app/imports/wordpress-blogs.xml');

        if (! is_file($file)) {
            $this->error("WordPress XML file not found: {$file}");

            return self::FAILURE;
        }

        @ini_set('memory_limit', '512M');
        @set_time_limit(0);

        $dryRun = (bool) $this->option('dry-run');
        $limit = max(0, (int) $this->option('limit'));
        $update = (bool) $this->option('update');
        $only = $this->parseOnlyIds((string) $this->option('only'));

        if ($only !== [] && ! $update) {
            $this->error('--only requires --update so native/unmapped blogs are never created.');

            return self::FAILURE;
        }

        $this->info('WordPress blog import');
        $this->line('File: '.$file);
        $this->line('Mode: '.($dryRun ? 'dry-run (no writes)' : 'write'));
        $this->line('Limit: '.($limit > 0 ? $limit.' published posts' : 'all published posts'));
        $this->line('Update existing imports: '.($update ? 'yes' : 'no'));
        $this->line('Only WordPress IDs: '.($only !== [] ? implode(', ', $only) : 'all'));
        $this->newLine();

        $report = $importer->import($file, $dryRun, $limit, $update, $only);

        $this->printSummary($report, $dryRun);
        $this->writeReportFile($report);

        return $report->failed > 0 ? self::FAILURE : self::SUCCESS;
    }

    protected function printSummary(ImportReport $report, bool $dryRun): void
    {
        $prefix = $dryRun ? 'Would be ' : '';

        $this->table(
            ['Metric', 'Count'],
            [
                ['Scanned XML posts', $report->scanned],
                ['Published posts', $report->published],
                ['Drafts skipped', $report->draftsSkipped],
                [$prefix.'created', $report->created],
                [$prefix.'updated', $report->updated],
                ['Skipped', $report->skipped],
                ['Failed', $report->failed],
                ['Featured images downloaded', $report->featuredDownloaded],
                ['Featured images failed', $report->featuredFailed],
                ['Featured images missing', $report->featuredMissing],
                ['Content images '.($dryRun ? 'found' : 'downloaded'), $report->contentImagesDownloaded],
                ['Content images failed', $report->contentImagesFailed],
                ['Unmapped extra categories', count($report->unmappedCategories)],
            ],
        );

        if ($report->unmappedCategories !== []) {
            $this->newLine();
            $this->warn('Additional WordPress categories were not applied as tags. Review:');
            foreach ($report->unmappedCategories as $path) {
                $this->line('  - '.$path);
            }
        }

        if ($report->skippedItems !== []) {
            $this->newLine();
            $this->comment('Skipped (first 20):');
            foreach (array_slice($report->skippedItems, 0, 20) as $item) {
                $this->line("  #{$item['id']} {$item['slug']}: {$item['reason']}");
            }
        }

        if ($report->failedItems !== []) {
            $this->newLine();
            $this->error('Failed:');
            foreach ($report->failedItems as $item) {
                $this->line("  #{$item['id']} {$item['slug']}: {$item['error']}");
            }
        }
    }

    protected function writeReportFile(ImportReport $report): void
    {
        $directory = storage_path('logs');
        File::ensureDirectoryExists($directory);

        $path = $directory.DIRECTORY_SEPARATOR.'blog-import-'.now()->format('Ymd-His').'.json';
        File::put($path, json_encode($report->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

        $this->newLine();
        $this->line('Report: '.$path);
    }

    /**
     * @return array<int, int>
     */
    protected function parseOnlyIds(string $value): array
    {
        if (trim($value) === '') {
            return [];
        }

        return array_values(array_unique(array_filter(array_map(
            static fn (string $id): int => (int) trim($id),
            explode(',', $value),
        ), static fn (int $id): bool => $id > 0)));
    }
}
