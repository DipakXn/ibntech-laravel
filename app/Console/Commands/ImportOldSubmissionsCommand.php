<?php

namespace App\Console\Commands;

use App\Services\OldSubmissions\OldSubmissionImporter;
use Illuminate\Console\Command;
use RuntimeException;

class ImportOldSubmissionsCommand extends Command
{
    protected $signature = 'old-submissions:import
                            {path? : Directory or CSV file. Defaults to storage/app/old-submissions}
                            {--dry-run : Report what would be imported without writing}';

    protected $description = 'Import historical Elementor form submissions from local CSV exports. Does not contact or modify the old site.';

    public function handle(OldSubmissionImporter $importer): int
    {
        $path = $this->argument('path') ?: storage_path('app/old-submissions');
        $dryRun = (bool) $this->option('dry-run');

        $this->info('Old submissions import');
        $this->line('Path: '.$path);
        $this->line('Mode: '.($dryRun ? 'dry-run (no writes)' : 'write'));
        $this->newLine();

        try {
            $report = $importer->import($path, $dryRun);
        } catch (RuntimeException $exception) {
            $this->error($exception->getMessage());

            return self::FAILURE;
        }

        $createdLabel = $dryRun ? 'Would create' : 'Created';

        $this->table(
            ['Metric', 'Count'],
            [
                ['CSV files', $report->files],
                ['Rows read', $report->rows],
                [$createdLabel, $report->created],
                ['Skipped (already imported)', $report->skipped],
                ['Failed', $report->failed],
            ],
        );

        foreach ($report->errors as $error) {
            $this->warn($error);
        }

        if ($report->failed > 0 && count($report->errors) < $report->failed) {
            $this->warn('Additional row errors were omitted from this output.');
        }

        return $report->failed > 0 ? self::FAILURE : self::SUCCESS;
    }
}
