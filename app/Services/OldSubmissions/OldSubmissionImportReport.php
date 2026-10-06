<?php

namespace App\Services\OldSubmissions;

class OldSubmissionImportReport
{
    public int $files = 0;

    public int $rows = 0;

    public int $created = 0;

    public int $skipped = 0;

    public int $failed = 0;

    /** @var list<string> */
    public array $errors = [];

    public function addError(string $message): void
    {
        $this->failed++;

        if (count($this->errors) < 50) {
            $this->errors[] = $message;
        }
    }
}
