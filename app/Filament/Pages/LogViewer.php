<?php

namespace App\Filament\Pages;

use App\Support\Logs\LaravelLogReader;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;

class LogViewer extends Page
{
    protected static ?string $title = 'Application logs';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|\UnitEnum|null $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'Application logs';

    protected static ?int $navigationSort = 11;

    protected string $view = 'filament.pages.log-viewer';

    protected ?string $subheading = 'Review rotated application logs stored locally in storage/logs.';

    protected Width|string|null $maxContentWidth = 'full';

    public ?string $selectedFile = null;

    public string $fileQuery = '';

    public ?string $dateFrom = null;

    public ?string $dateTo = null;

    public string $search = '';

    /**
     * @var array<int, string>
     */
    public array $levels = [];

    public string $viewMode = 'parsed';

    public int $entryPage = 1;

    public int $lineLimit = 200;

    public function mount(): void
    {
        $this->selectedFile ??= $this->availableFiles()->first()['name'] ?? null;
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    public function selectFile(string $fileName): void
    {
        if (! $this->reader()->resolvePath($fileName)) {
            return;
        }

        $this->selectedFile = $fileName;
        $this->entryPage = 1;
    }

    public function toggleLevel(string $level): void
    {
        $level = strtoupper($level);

        if (! in_array($level, LaravelLogReader::LEVELS, true)) {
            return;
        }

        if (in_array($level, $this->levels, true)) {
            $this->levels = array_values(array_filter(
                $this->levels,
                fn (string $selected): bool => $selected !== $level,
            ));
        } else {
            $this->levels[] = $level;
        }

        $this->entryPage = 1;
    }

    public function setViewMode(string $mode): void
    {
        if (! in_array($mode, ['parsed', 'raw'], true)) {
            return;
        }

        $this->viewMode = $mode;
    }

    public function previousPage(): void
    {
        $this->entryPage = max(1, $this->entryPage - 1);
    }

    public function nextPage(): void
    {
        $this->entryPage++;
    }

    public function clearFilters(): void
    {
        $this->search = '';
        $this->levels = [];
        $this->fileQuery = '';
        $this->dateFrom = null;
        $this->dateTo = null;
        $this->entryPage = 1;
    }

    public function updatedSearch(): void
    {
        $this->entryPage = 1;
    }

    public function updatedLevels(): void
    {
        $this->entryPage = 1;
    }

    public function updatedFileQuery(): void
    {
        $this->syncSelectedFile();
    }

    public function updatedDateFrom(): void
    {
        $this->syncSelectedFile();
    }

    public function updatedDateTo(): void
    {
        $this->syncSelectedFile();
    }

    protected function getViewData(): array
    {
        $this->lineLimit = min(500, max(50, $this->lineLimit));

        $files = $this->availableFiles();
        $this->syncSelectedFile($files);

        $inspection = $this->selectedFile
            ? $this->reader()->inspect(
                fileName: $this->selectedFile,
                search: $this->search,
                levels: $this->levels,
                page: $this->entryPage,
                perPage: LaravelLogReader::DEFAULT_PER_PAGE,
                rawLineLimit: $this->lineLimit,
                includeEntries: $this->viewMode === 'parsed',
            )
            : null;

        if ($inspection !== null) {
            $this->entryPage = $inspection['page'];
        }

        return [
            'files' => $files,
            'selectedFileDetails' => $inspection['file'] ?? $files->firstWhere('name', $this->selectedFile),
            'entries' => $inspection['entries'] ?? [],
            'stats' => $inspection === null ? null : [
                'total_entries' => $inspection['total_entries'],
                'level_counts' => $inspection['level_counts'],
                'matched_count' => $inspection['matched_count'],
                'kept_count' => $inspection['kept_count'],
                'truncated' => $inspection['truncated'],
                'scanned_size' => $this->reader()->formatBytes($inspection['scanned_bytes']),
            ],
            'page' => $inspection['page'] ?? 1,
            'lastPage' => $inspection['last_page'] ?? 1,
            'rawPreview' => $inspection['raw_preview'] ?? null,
            'lineLimit' => $this->lineLimit,
            'levels' => LaravelLogReader::LEVELS,
            'activeLevels' => $this->levels,
        ];
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    protected function availableFiles(): Collection
    {
        return $this->reader()->listFiles(
            nameQuery: $this->fileQuery !== '' ? $this->fileQuery : null,
            dateFrom: $this->dateFrom !== null && $this->dateFrom !== '' ? $this->dateFrom : null,
            dateTo: $this->dateTo !== null && $this->dateTo !== '' ? $this->dateTo : null,
        );
    }

    /**
     * @param  Collection<int, array<string, mixed>>|null  $files
     */
    protected function syncSelectedFile(?Collection $files = null): void
    {
        $files ??= $this->availableFiles();

        if ($this->selectedFile && $files->firstWhere('name', $this->selectedFile)) {
            return;
        }

        $this->selectedFile = $files->first()['name'] ?? null;
        $this->entryPage = 1;
    }

    protected function reader(): LaravelLogReader
    {
        return app(LaravelLogReader::class);
    }
}
