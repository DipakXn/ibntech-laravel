<?php

namespace App\Console\Commands;

use App\Services\WordPress\PressReleaseImporter;
use App\Services\WordPress\PressReleaseImportReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportPressReleasesCommand extends Command
{
    protected $signature = 'press-releases:import
                            {directory? : Path to the Press Release XML directory}
                            {--dry-run : Parse and report without writing to the database}
                            {--write : Write records (requires --only or --remaining)}
                            {--only= : Comma-separated slugs to import (required with --write unless --remaining)}
                            {--remaining : Write unimported posts only (skips protected and existing)}
                            {--date-file= : Path to pr-publish-date.xml}';

    protected $description = 'Import WordPress Press Release XML files (write requires --only or --remaining)';

    public function handle(PressReleaseImporter $importer): int
    {
        $write = (bool) $this->option('write');
        $dryRunFlag = (bool) $this->option('dry-run');
        $remaining = (bool) $this->option('remaining');
        $onlySlugs = $this->parseOnlySlugs((string) $this->option('only'));

        if ($write && $dryRunFlag) {
            $this->error('Use either --dry-run or --write, not both.');

            return self::FAILURE;
        }

        if ($write && $remaining && $onlySlugs !== []) {
            $this->error('Use either --only or --remaining, not both.');

            return self::FAILURE;
        }

        if ($write && $onlySlugs === [] && ! $remaining) {
            $this->error('Write mode requires --only or --remaining so Press Releases are not imported accidentally.');

            return self::FAILURE;
        }

        $dryRun = ! $write;
        $directory = $this->argument('directory') ?: storage_path('app/imports/pressreleases_xml_files');
        $dateFile = (string) $this->option('date-file') ?: storage_path('app/imports/pr-publish-date.xml');

        if (! is_dir($directory)) {
            $this->error("Press release XML directory not found: {$directory}");

            return self::FAILURE;
        }

        if (! is_file($dateFile)) {
            $this->error("Press release publish-date XML not found: {$dateFile}");

            return self::FAILURE;
        }

        @ini_set('memory_limit', '512M');
        @set_time_limit(0);

        $this->info('WordPress press release import (Stage 2)');
        $this->line('Directory: '.$directory);
        $this->line('Date file: '.$dateFile);
        $this->line('Mode: '.($dryRun ? 'dry-run (no writes)' : 'write'));
        $this->line('Only slugs: '.($onlySlugs !== [] ? implode(', ', $onlySlugs) : ($remaining ? 'remaining unimported' : 'all (dry-run)')));
        $this->newLine();

        $report = $dryRun
            ? $importer->dryRun($directory, $dateFile, $onlySlugs)
            : $importer->write($directory, $dateFile, $onlySlugs, $remaining);

        $this->printSummary($report, $dryRun);
        $this->writeReportFile($report, $dryRun);

        if ($report->failed > 0 || ! $report->dateCoverageComplete()) {
            return self::FAILURE;
        }

        if (! $dryRun && ($report->featuredFailed > 0 || $report->contentImagesFailed > 0)) {
            return self::FAILURE;
        }

        return self::SUCCESS;
    }

    /**
     * @return array<int, string>
     */
    protected function parseOnlySlugs(string $value): array
    {
        if (trim($value) === '') {
            return [];
        }

        return array_values(array_unique(array_filter(array_map(
            static fn (string $slug): string => trim($slug),
            explode(',', $value),
        ))));
    }

    protected function printSummary(PressReleaseImportReport $report, bool $dryRun): void
    {
        $this->table(
            ['Metric', 'Count'],
            [
                ['Scanned XML posts', $report->scanned],
                [$dryRun ? 'Would be created' : 'Created', $dryRun ? $report->wouldCreate : $report->created],
                ['Skipped protected #4', $report->skippedProtected],
                ['Skipped not in --only', $report->skippedNotInOnly],
                ['Skipped existing', $report->skippedExisting],
                ['Failed', $report->failed],
                ['Date mappings', $report->dateMappings],
                ['Missing dates', count($report->missingDates)],
                ['Extra dates', count($report->extraDates)],
                ['Duplicate dates', count($report->duplicateDates)],
                ['Invalid dates', count($report->invalidDates)],
                ['Date coverage complete', $report->dateCoverageComplete() ? 'yes' : 'no'],
                ['Leading featured images', $report->featuredImages],
                ['Featured images downloaded', $report->featuredDownloaded],
                ['Featured images failed', $report->featuredFailed],
                ['Additional content images', $report->contentImages],
                ['Content images downloaded', $report->contentImagesDownloaded],
                ['Content images failed', $report->contentImagesFailed],
            ],
        );

        $createdSlugs = $dryRun ? $report->wouldCreateSlugs : $report->createdSlugs;
        if ($createdSlugs !== []) {
            $this->newLine();
            $this->comment($dryRun ? 'Would create:' : 'Created:');
            foreach ($createdSlugs as $slug) {
                $this->line('  '.$slug);
            }
        }

        if ($report->skippedItems !== []) {
            $this->newLine();
            $this->comment('Skipped:');
            foreach ($report->skippedItems as $item) {
                $this->line("  {$item['slug']}: {$item['reason']}");
            }
        }

        if ($report->missingDates !== []) {
            $this->newLine();
            $this->warn('Missing publish dates:');
            foreach ($report->missingDates as $item) {
                $this->line("  {$item['slug']}: {$item['permalink']}");
            }
        }

        if ($report->extraDates !== []) {
            $this->newLine();
            $this->warn('Extra publish-date rows (no XML post):');
            foreach ($report->extraDates as $permalink) {
                $this->line('  '.$permalink);
            }
        }

        if ($report->duplicateDates !== []) {
            $this->newLine();
            $this->warn('Duplicate publish-date permalinks:');
            foreach ($report->duplicateDates as $permalink) {
                $this->line('  '.$permalink);
            }
        }

        if ($report->invalidDates !== []) {
            $this->newLine();
            $this->warn('Invalid publish dates:');
            foreach ($report->invalidDates as $item) {
                $this->line("  {$item['permalink']}: {$item['date']}");
            }
        }

        if ($report->failedItems !== []) {
            $this->newLine();
            $this->error('Failed:');
            foreach ($report->failedItems as $item) {
                $this->line("  {$item['file']} {$item['slug']}: {$item['error']}");
            }
        }
    }

    protected function writeReportFile(PressReleaseImportReport $report, bool $dryRun): void
    {
        $directory = storage_path('logs');
        File::ensureDirectoryExists($directory);

        $prefix = $dryRun ? 'press-release-import-dry-run-' : 'press-release-import-write-';
        $path = $directory.DIRECTORY_SEPARATOR.$prefix.now()->format('Ymd-His').'.json';
        File::put($path, json_encode($report->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

        $this->newLine();
        $this->line('Report: '.$path);
    }
}
