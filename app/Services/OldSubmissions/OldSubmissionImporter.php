<?php

namespace App\Services\OldSubmissions;

use App\Models\OldSubmission;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use RuntimeException;
use SplFileInfo;

class OldSubmissionImporter
{
    public function __construct(
        private readonly ElementorCsvReader $reader,
        private readonly OldSubmissionFieldMapper $mapper,
    ) {}

    public function import(string $path, bool $dryRun = false): OldSubmissionImportReport
    {
        $report = new OldSubmissionImportReport;
        $files = $this->csvFiles($path);

        /** @var array<string, true> $knownIds */
        $knownIds = OldSubmission::query()
            ->pluck('external_submission_id')
            ->mapWithKeys(fn (mixed $id): array => [(string) $id => true])
            ->all();

        foreach ($files as $file) {
            $report->files++;
            $this->importFile($file, $dryRun, $report, $knownIds);
        }

        return $report;
    }

    /**
     * @param  array<string, true>  $knownIds
     */
    private function importFile(SplFileInfo $file, bool $dryRun, OldSubmissionImportReport $report, array &$knownIds): void
    {
        $sourceFile = $file->getFilename();

        try {
            foreach ($this->reader->rows($file->getPathname()) as $index => $fields) {
                $report->rows++;
                $rowNumber = $index + 1;
                $mapped = $this->mapper->map($fields, $sourceFile);

                if (isset($mapped['error'])) {
                    $report->addError("{$sourceFile} row {$rowNumber}: {$mapped['error']}");

                    continue;
                }

                $attributes = $mapped['attributes'];
                $submissionId = (string) $attributes['external_submission_id'];

                if (isset($knownIds[$submissionId])) {
                    $report->skipped++;

                    continue;
                }

                if ($dryRun) {
                    $knownIds[$submissionId] = true;
                    $report->created++;

                    continue;
                }

                try {
                    OldSubmission::query()->create($attributes);
                    $knownIds[$submissionId] = true;
                    $report->created++;
                } catch (QueryException $exception) {
                    if ($this->isUniqueViolation($exception)) {
                        $knownIds[$submissionId] = true;
                        $report->skipped++;

                        continue;
                    }

                    $report->addError("{$sourceFile} row {$rowNumber}: database error while saving submission {$submissionId}");
                }
            }
        } catch (RuntimeException $exception) {
            $report->addError($sourceFile.': '.$exception->getMessage());
        }
    }

    /**
     * @return list<SplFileInfo>
     */
    private function csvFiles(string $path): array
    {
        if (is_file($path)) {
            return [new SplFileInfo($path)];
        }

        if (! is_dir($path)) {
            throw new RuntimeException("CSV path not found: {$path}");
        }

        return collect(File::files($path))
            ->filter(fn (SplFileInfo $file): bool => strtolower($file->getExtension()) === 'csv')
            ->sortBy(fn (SplFileInfo $file): string => $file->getFilename())
            ->values()
            ->all();
    }

    private function isUniqueViolation(QueryException $exception): bool
    {
        return ($exception->errorInfo[0] ?? null) === '23000';
    }
}
