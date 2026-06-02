<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use SplFileObject;

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

    public int $lineLimit = 200;

    public function mount(): void
    {
        $this->selectedFile ??= $this->getAvailableLogFiles()->first()['name'] ?? null;
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    public function selectFile(string $fileName): void
    {
        if (! $this->getAvailableLogFiles()->firstWhere('name', $fileName)) {
            return;
        }

        $this->selectedFile = $fileName;
    }

    protected function getViewData(): array
    {
        $files = $this->getAvailableLogFiles();
        $selectedFile = $files->firstWhere('name', $this->selectedFile) ?? $files->first();

        if ($selectedFile) {
            $this->selectedFile = $selectedFile['name'];
        }

        return [
            'files' => $files,
            'selectedFileDetails' => $selectedFile,
            'logPreview' => $selectedFile ? $this->readTail($selectedFile['path'], $this->lineLimit) : null,
            'lineLimit' => $this->lineLimit,
        ];
    }

    /**
     * @return Collection<int, array{name: string, path: string, size: string, modified_at: string}>
     */
    protected function getAvailableLogFiles(): Collection
    {
        $logDirectory = storage_path('logs');

        if (! File::isDirectory($logDirectory)) {
            return collect();
        }

        return collect(File::files($logDirectory))
            ->filter(fn (\SplFileInfo $file): bool => $file->getExtension() === 'log')
            ->sortByDesc(fn (\SplFileInfo $file): int => $file->getMTime())
            ->values()
            ->map(fn (\SplFileInfo $file): array => [
                'name' => $file->getFilename(),
                'path' => $file->getPathname(),
                'size' => $this->formatBytes($file->getSize()),
                'modified_at' => Carbon::createFromTimestamp($file->getMTime())->diffForHumans(),
            ]);
    }

    protected function readTail(string $path, int $lines): string
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

        return implode(PHP_EOL, $buffer);
    }

    protected function formatBytes(int $bytes): string
    {
        if ($bytes < 1024) {
            return $bytes . ' B';
        }

        if ($bytes < 1048576) {
            return number_format($bytes / 1024, 1) . ' KB';
        }

        return number_format($bytes / 1048576, 1) . ' MB';
    }
}
