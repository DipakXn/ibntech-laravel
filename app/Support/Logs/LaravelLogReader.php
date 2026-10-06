<?php

namespace App\Support\Logs;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use SplFileObject;

class LaravelLogReader
{
    public const LEVELS = [
        'EMERGENCY',
        'ALERT',
        'CRITICAL',
        'ERROR',
        'WARNING',
        'NOTICE',
        'INFO',
        'DEBUG',
    ];

    public const DEFAULT_PER_PAGE = 25;

    public const MAX_KEPT_ENTRIES = 500;

    public const MAX_SCAN_BYTES = 8_388_608;

    public const MAX_CONTEXT_CHARS = 200_000;

    public const HEADER_PATTERN = '/^\[(\d{4}-\d{2}-\d{2}[ T]\d{2}:\d{2}:\d{2}(?:[.,]\d+)?)\](?:\s+([\w.-]+)\.)?(\w+):\s?(.*)$/';

    public function __construct(
        private readonly ?string $logDirectory = null,
        private readonly int $maxScanBytes = self::MAX_SCAN_BYTES,
        private readonly int $maxKeptEntries = self::MAX_KEPT_ENTRIES,
    ) {}

    public function directory(): string
    {
        return $this->logDirectory ?? storage_path('logs');
    }

    /**
     * @return Collection<int, array{
     *     name: string,
     *     path: string,
     *     size: string,
     *     size_bytes: int,
     *     modified_at: string,
     *     date: string|null
     * }>
     */
    public function listFiles(?string $nameQuery = null, ?string $dateFrom = null, ?string $dateTo = null): Collection
    {
        $logDirectory = $this->directory();

        if (! is_dir($logDirectory)) {
            return collect();
        }

        $files = collect(scandir($logDirectory, SCANDIR_SORT_NONE) ?: [])
            ->filter(fn (string $name): bool => str_ends_with(strtolower($name), '.log'))
            ->map(function (string $name) use ($logDirectory): ?array {
                $path = $logDirectory.DIRECTORY_SEPARATOR.$name;

                if (! is_file($path)) {
                    return null;
                }

                $mtime = (int) filemtime($path);
                $size = (int) filesize($path);
                $date = $this->dateFromFileName($name) ?? Carbon::createFromTimestamp($mtime)->toDateString();

                return [
                    'name' => $name,
                    'path' => $path,
                    'size' => $this->formatBytes($size),
                    'size_bytes' => $size,
                    'modified_at' => Carbon::createFromTimestamp($mtime)->diffForHumans(),
                    'modified_timestamp' => $mtime,
                    'date' => $date,
                ];
            })
            ->filter()
            ->sortByDesc('modified_timestamp')
            ->values();

        return $files
            ->when($nameQuery !== null && trim($nameQuery) !== '', function (Collection $files) use ($nameQuery): Collection {
                $needle = Str::lower(trim($nameQuery));

                return $files->filter(fn (array $file): bool => str_contains(Str::lower($file['name']), $needle))->values();
            })
            ->when($dateFrom, function (Collection $files) use ($dateFrom): Collection {
                return $files->filter(fn (array $file): bool => ($file['date'] ?? '') >= $dateFrom)->values();
            })
            ->when($dateTo, function (Collection $files) use ($dateTo): Collection {
                return $files->filter(fn (array $file): bool => ($file['date'] ?? '') <= $dateTo)->values();
            });
    }

    public function resolvePath(string $fileName): ?string
    {
        $safeName = basename($fileName);

        if ($safeName !== $fileName || ! str_ends_with(strtolower($safeName), '.log')) {
            return null;
        }

        $directory = realpath($this->directory());

        if ($directory === false) {
            return null;
        }

        $path = $directory.DIRECTORY_SEPARATOR.$safeName;
        $realPath = realpath($path);

        if ($realPath === false || ! is_file($realPath)) {
            return null;
        }

        $directoryPrefix = strtolower(rtrim(str_replace('\\', '/', $directory), '/')).'/';
        $normalizedFile = strtolower(str_replace('\\', '/', $realPath));

        if (! str_starts_with($normalizedFile, $directoryPrefix)) {
            return null;
        }

        return $realPath;
    }

    /**
     * @param  array<int, string>  $levels
     * @return array{
     *     file: array{name: string, path: string, size: string, size_bytes: int, modified_at: string, date: string|null}|null,
     *     entries: list<LaravelLogEntry>,
     *     page: int,
     *     per_page: int,
     *     last_page: int,
     *     matched_count: int,
     *     kept_count: int,
     *     total_entries: int,
     *     level_counts: array<string, int>,
     *     truncated: bool,
     *     scanned_bytes: int,
     *     raw_preview: string
     * }
     */
    public function inspect(
        string $fileName,
        string $search = '',
        array $levels = [],
        int $page = 1,
        int $perPage = self::DEFAULT_PER_PAGE,
        int $rawLineLimit = 200,
        bool $includeEntries = true,
    ): array {
        $emptyCounts = array_fill_keys(self::LEVELS, 0);
        $resolved = $this->resolvePath($fileName);

        if ($resolved === null) {
            return [
                'file' => null,
                'entries' => [],
                'page' => 1,
                'per_page' => $perPage,
                'last_page' => 1,
                'matched_count' => 0,
                'kept_count' => 0,
                'total_entries' => 0,
                'level_counts' => $emptyCounts,
                'truncated' => false,
                'scanned_bytes' => 0,
                'raw_preview' => '',
            ];
        }

        $size = (int) filesize($resolved);
        $mtime = (int) filemtime($resolved);
        $name = basename($resolved);

        $file = [
            'name' => $name,
            'path' => $resolved,
            'size' => $this->formatBytes($size),
            'size_bytes' => $size,
            'modified_at' => Carbon::createFromTimestamp($mtime)->diffForHumans(),
            'date' => $this->dateFromFileName($name) ?? Carbon::createFromTimestamp($mtime)->toDateString(),
        ];

        $parsed = $this->parseFile($resolved, $search, $levels, $includeEntries);

        $kept = $parsed['entries'];
        $matchedCount = $parsed['matched_count'];
        $keptCount = $includeEntries
            ? count($kept)
            : min($matchedCount, $this->maxKeptEntries);
        $perPage = max(1, $perPage);
        $lastPage = max(1, (int) ceil($keptCount / $perPage));
        $page = min(max(1, $page), $lastPage);
        $entries = array_slice(array_reverse($kept), ($page - 1) * $perPage, $perPage);

        return [
            'file' => $file,
            'entries' => $entries,
            'page' => $page,
            'per_page' => $perPage,
            'last_page' => $lastPage,
            'matched_count' => $matchedCount,
            'kept_count' => $keptCount,
            'total_entries' => $parsed['total_entries'],
            'level_counts' => $parsed['level_counts'],
            'truncated' => $parsed['truncated'],
            'scanned_bytes' => $parsed['scanned_bytes'],
            'raw_preview' => $this->readTail($resolved, $rawLineLimit),
        ];
    }

    public function formatBytes(int $bytes): string
    {
        if ($bytes < 1024) {
            return $bytes.' B';
        }

        if ($bytes < 1048576) {
            return number_format($bytes / 1024, 1).' KB';
        }

        return number_format($bytes / 1048576, 1).' MB';
    }

    /**
     * @param  array<int, string>  $levels
     * @return array{
     *     entries: list<LaravelLogEntry>,
     *     matched_count: int,
     *     total_entries: int,
     *     level_counts: array<string, int>,
     *     truncated: bool,
     *     scanned_bytes: int
     * }
     */
    private function parseFile(string $path, string $search, array $levels, bool $includeEntries): array
    {
        $levelCounts = array_fill_keys(self::LEVELS, 0);
        $normalizedLevels = array_values(array_intersect(
            self::LEVELS,
            array_map(static fn (string $level): string => strtoupper($level), $levels),
        ));
        $searchNeedle = Str::lower(trim($search));
        $size = (int) filesize($path);
        $truncated = $size > $this->maxScanBytes;
        $start = $truncated ? $size - $this->maxScanBytes : 0;

        $handle = fopen($path, 'rb');

        if ($handle === false) {
            return [
                'entries' => [],
                'matched_count' => 0,
                'total_entries' => 0,
                'level_counts' => $levelCounts,
                'truncated' => $truncated,
                'scanned_bytes' => 0,
            ];
        }

        if ($start > 0) {
            fseek($handle, $start);
            fgets($handle);
        }

        $currentHeader = null;
        $currentLines = [];
        $contextChars = 0;
        $skippingUntilHeader = $truncated;
        $entries = [];
        $matchedCount = 0;
        $totalEntries = 0;
        $compactAfter = $this->maxKeptEntries * 2;
        $maxKeptEntries = $this->maxKeptEntries;

        $flush = function () use (
            &$currentHeader,
            &$currentLines,
            &$contextChars,
            &$entries,
            &$matchedCount,
            &$totalEntries,
            &$levelCounts,
            $normalizedLevels,
            $searchNeedle,
            $includeEntries,
            $compactAfter,
            $maxKeptEntries,
        ): void {
            if ($currentHeader === null) {
                return;
            }

            $level = $currentHeader['level'];
            $totalEntries++;

            if (isset($levelCounts[$level])) {
                $levelCounts[$level]++;
            }

            $raw = implode("\n", $currentLines);
            $matchesLevel = $normalizedLevels === [] || in_array($level, $normalizedLevels, true);
            $matchesSearch = $searchNeedle === '' || str_contains(Str::lower($raw), $searchNeedle);

            if ($matchesLevel && $matchesSearch) {
                $matchedCount++;

                if ($includeEntries) {
                    $message = $currentHeader['message'];
                    $contextLines = array_slice($currentLines, 1);

                    $entries[] = new LaravelLogEntry(
                        timestamp: $currentHeader['timestamp'],
                        environment: $currentHeader['environment'],
                        level: $level,
                        message: $message,
                        contextLines: $contextLines,
                        raw: $raw,
                    );

                    if (count($entries) > $compactAfter) {
                        $entries = array_slice($entries, -$maxKeptEntries);
                    }
                }
            }

            $currentHeader = null;
            $currentLines = [];
            $contextChars = 0;
        };

        while (($line = fgets($handle)) !== false) {
            $line = rtrim($line, "\r\n");

            if (preg_match(self::HEADER_PATTERN, $line, $matches) === 1) {
                $skippingUntilHeader = false;
                $flush();

                $level = strtoupper($matches[3]);

                if (! in_array($level, self::LEVELS, true)) {
                    $level = 'INFO';
                }

                $currentHeader = [
                    'timestamp' => $matches[1],
                    'environment' => $matches[2] !== '' ? $matches[2] : 'local',
                    'level' => $level,
                    'message' => $matches[4],
                ];
                $currentLines = [$line];
                $contextChars = 0;

                continue;
            }

            if ($skippingUntilHeader || $currentHeader === null) {
                continue;
            }

            if ($contextChars >= self::MAX_CONTEXT_CHARS) {
                continue;
            }

            $currentLines[] = $line;
            $contextChars += strlen($line) + 1;
        }

        $flush();
        fclose($handle);

        if (count($entries) > $this->maxKeptEntries) {
            $entries = array_slice($entries, -$this->maxKeptEntries);
        }

        return [
            'entries' => $entries,
            'matched_count' => $matchedCount,
            'total_entries' => $totalEntries,
            'level_counts' => $levelCounts,
            'truncated' => $truncated,
            'scanned_bytes' => min($size, $this->maxScanBytes),
        ];
    }

    private function readTail(string $path, int $lines): string
    {
        $file = new SplFileObject($path, 'r');
        $file->seek(PHP_INT_MAX);

        $lastLineNumber = $file->key();
        $startLine = max(0, $lastLineNumber - ($lines - 1));
        $buffer = [];

        $file->seek($startLine);

        while (! $file->eof()) {
            $buffer[] = rtrim((string) $file->current(), "\r\n");
            $file->next();
        }

        return implode("\n", $buffer);
    }

    private function dateFromFileName(string $fileName): ?string
    {
        if (preg_match('/(\d{4}-\d{2}-\d{2})/', $fileName, $matches) !== 1) {
            return null;
        }

        return $matches[1];
    }
}
