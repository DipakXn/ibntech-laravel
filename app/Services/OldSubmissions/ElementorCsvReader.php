<?php

namespace App\Services\OldSubmissions;

use Generator;
use RuntimeException;

class ElementorCsvReader
{
    /**
     * Read an Elementor submissions export without writing to the file.
     * A leading UTF-8 BOM is skipped in memory so quoted headers parse normally.
     *
     * @return Generator<int, list<array{label: string, value: string}>>
     */
    public function rows(string $path): Generator
    {
        $handle = fopen($path, 'rb');

        if ($handle === false) {
            throw new RuntimeException("Unable to read CSV: {$path}");
        }

        try {
            $prefix = fread($handle, 3);

            if ($prefix !== "\xEF\xBB\xBF") {
                rewind($handle);
            }

            $header = fgetcsv($handle, 0, ',', '"', '\\');

            if (! is_array($header)) {
                return;
            }

            $labels = [];

            foreach ($header as $index => $label) {
                $labels[$index] = $this->cleanLabel(is_string($label) ? $label : '');
            }

            while (($row = fgetcsv($handle, 0, ',', '"', '\\')) !== false) {
                if ($this->isEmptyRow($row)) {
                    continue;
                }

                $width = max(count($labels), count($row));
                $fields = [];

                for ($index = 0; $index < $width; $index++) {
                    $raw = $row[$index] ?? '';
                    $value = is_string($raw) ? trim(OldSubmissionFieldMapper::decodeValue($raw)) : '';

                    $fields[] = [
                        'label' => $labels[$index] ?? '',
                        'value' => $value,
                    ];
                }

                yield $fields;
            }
        } finally {
            fclose($handle);
        }
    }

    private function cleanLabel(string $label): string
    {
        if (str_starts_with($label, "\xEF\xBB\xBF")) {
            $label = substr($label, 3);
        }
        $label = trim($label);

        if (strlen($label) >= 2 && str_starts_with($label, '"') && str_ends_with($label, '"')) {
            $label = substr($label, 1, -1);
        }

        return trim($label);
    }

    /**
     * @param  list<string|null>  $row
     */
    private function isEmptyRow(array $row): bool
    {
        foreach ($row as $cell) {
            if (is_string($cell) && trim($cell) !== '') {
                return false;
            }
        }

        return true;
    }
}
