<?php

namespace App\Forms\Components;

use App\Support\MediaLibrary\CustomPathGenerator;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload as BaseSpatieMediaLibraryFileUpload;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class SpatieMediaLibraryFileUpload extends BaseSpatieMediaLibraryFileUpload
{
    /**
     * Tracks names reserved during the current request so parallel uploads into
     * the same year/month bucket receive deterministic suffixes.
     *
     * @var array<string, array<int, string>>
     */
    protected static array $reservedNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->getUploadedFileNameForStorageUsing(
            fn (TemporaryUploadedFile $file): string => $this->resolveStoredFileName($file),
        );
    }

    protected function resolveStoredFileName(TemporaryUploadedFile $file): string
    {
        $baseName = $this->sanitizeBaseName(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = $this->sanitizeExtension($file->getClientOriginalExtension());
        $candidate = $this->appendExtension($baseName, $extension);
        $directory = $this->resolveStorageDirectory();
        $disk = $this->getDiskName();
        $reservedScope = implode('|', [$disk, $directory]);
        $reservedNames = static::$reservedNames[$reservedScope] ?? [];

        if (! $this->fileExistsInTargetDirectory($disk, $directory, $candidate) && ! in_array(Str::lower($candidate), $reservedNames, true)) {
            static::$reservedNames[$reservedScope][] = Str::lower($candidate);

            return $candidate;
        }

        $sequence = 1;

        do {
            $resolved = $this->appendSequenceSuffix($baseName, $sequence, $extension);
            $sequence++;
        } while (
            $this->fileExistsInTargetDirectory($disk, $directory, $resolved) ||
            in_array(Str::lower($resolved), static::$reservedNames[$reservedScope] ?? [], true)
        );

        static::$reservedNames[$reservedScope][] = Str::lower($resolved);

        return $resolved;
    }

    protected function resolveStorageDirectory(): string
    {
        $prefix = trim((string) config('media-library.prefix', 'media'), '/');
        $segments = CustomPathGenerator::resolveDatePathSegments(Carbon::now());
        $path = implode('/', $segments);

        return $prefix !== '' ? "{$prefix}/{$path}" : $path;
    }

    protected function fileExistsInTargetDirectory(string $disk, string $directory, string $fileName): bool
    {
        return Storage::disk($disk)->exists(trim("{$directory}/{$fileName}", '/'));
    }

    protected function sanitizeBaseName(string $baseName): string
    {
        $sanitized = Str::of($baseName)
            ->ascii()
            ->replaceMatches('/[^A-Za-z0-9]+/', '-')
            ->trim('-')
            ->lower()
            ->toString();

        return $sanitized !== '' ? $sanitized : 'file';
    }

    protected function sanitizeExtension(string $extension): string
    {
        return Str::of($extension)
            ->replaceMatches('/[^A-Za-z0-9]+/', '')
            ->lower()
            ->toString();
    }

    protected function appendSequenceSuffix(string $baseName, int $sequence, string $extension): string
    {
        return $this->appendExtension(sprintf('%s-%02d', $baseName, $sequence), $extension);
    }

    protected function appendExtension(string $fileName, string $extension): string
    {
        return $extension !== '' ? "{$fileName}.{$extension}" : $fileName;
    }
}
