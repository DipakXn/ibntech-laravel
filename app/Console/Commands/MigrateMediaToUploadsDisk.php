<?php

namespace App\Console\Commands;

use App\Support\MediaLibrary\MediaPathResolver;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Throwable;

class MigrateMediaToUploadsDisk extends Command
{
    protected $signature = 'media:migrate-to-uploads-disk
                            {--from=public : Source filesystem disk}
                            {--to= : Target filesystem disk (defaults to media-library.disk_name)}
                            {--dry-run : Show what would change without writing}
                            {--reorganize : Move files into the purpose-based folder structure}
                            {--copy-orphans : Also copy unmatched files from the source disk root}';

    protected $description = 'Copy Spatie media files from the legacy public disk to the dedicated media/uploads disk and update disk columns';

    public function handle(): int
    {
        $fromDisk = (string) $this->option('from');
        $toDisk = (string) ($this->option('to') ?: config('media-library.disk_name', 'media'));
        $dryRun = (bool) $this->option('dry-run');
        $reorganize = (bool) $this->option('reorganize');

        if ($fromDisk === $toDisk) {
            $this->error('Source and target disks must be different.');

            return self::FAILURE;
        }

        $from = Storage::disk($fromDisk);
        $to = Storage::disk($toDisk);

        $this->info("Migrating media: {$fromDisk} → {$toDisk}".($dryRun ? ' (dry run)' : ''));
        $this->info($reorganize
            ? 'Mode: reorganize into purpose-based folders'
            : 'Mode: preserve existing relative paths');

        $copied = 0;
        $skipped = 0;
        $missing = 0;
        $updated = 0;

        Media::query()->orderBy('id')->each(function (Media $media) use (
            $from,
            $to,
            $fromDisk,
            $toDisk,
            $dryRun,
            $reorganize,
            &$copied,
            &$skipped,
            &$missing,
            &$updated,
        ): void {
            $sourceFiles = $this->findSourceFiles($media, $from);

            if ($sourceFiles === []) {
                $this->warn("No source files found for media #{$media->id} ({$media->file_name})");
                $missing++;

                return;
            }

            $destinationBase = $reorganize
                ? MediaPathResolver::forMedia($media)
                : $this->detectExistingBasePath($media, $sourceFiles);

            foreach ($sourceFiles as $role => $sourcePath) {
                $destinationPath = $this->mapDestinationPath($role, $sourcePath, $destinationBase, $media);

                if ($to->exists($destinationPath)) {
                    $skipped++;

                    continue;
                }

                if ($dryRun) {
                    $this->line("Would copy [{$role}]: {$sourcePath} → {$destinationPath}");
                    $copied++;

                    continue;
                }

                try {
                    $to->put($destinationPath, $from->get($sourcePath));
                    $copied++;
                } catch (Throwable $exception) {
                    $this->error("Failed copying {$sourcePath}: {$exception->getMessage()}");

                    throw $exception;
                }
            }

            $needsUpdate = $media->disk === $fromDisk
                || ($media->conversions_disk ?: null) === $fromDisk
                || blank($media->conversions_disk);

            if (! $needsUpdate) {
                return;
            }

            if ($dryRun) {
                $this->line("Would update media #{$media->id} disk columns to {$toDisk}");
                $updated++;

                return;
            }

            $media->disk = $toDisk;
            $media->conversions_disk = $toDisk;
            $media->saveQuietly();
            $updated++;
        });

        if ($this->option('copy-orphans')) {
            $this->copyOrphanFiles($from, $to, $dryRun, $copied, $skipped);
        }

        $this->newLine();
        $this->table(
            ['Metric', 'Count'],
            [
                ['Files copied / would copy', $copied],
                ['Already present / skipped', $skipped],
                ['Media rows with missing files', $missing],
                ['DB rows updated / would update', $updated],
            ],
        );

        $this->info('Done.');
        $this->comment('URL prefix changes from /storage to /uploads. Optional Apache/Nginx rewrite:');
        $this->comment('  /storage/(.*)  →  /uploads/$1');

        return self::SUCCESS;
    }

    /**
     * @return array<string, string> role => relative path on source disk
     */
    protected function findSourceFiles(Media $media, Filesystem $from): array
    {
        $found = [];
        $datePath = $media->created_at?->format('Y/m');

        $originalCandidates = array_filter([
            $media->getPathRelativeToRoot(),
            $datePath ? "media/{$datePath}/{$media->file_name}" : null,
            "{$media->getKey()}/{$media->file_name}",
        ]);

        foreach ($originalCandidates as $candidate) {
            if ($from->exists($candidate)) {
                $found['original'] = $candidate;
                break;
            }
        }

        foreach ($media->getGeneratedConversions()->keys() as $conversion) {
            $conversionCandidates = array_filter([
                $media->getPathRelativeToRoot($conversion),
                $datePath ? "media/{$datePath}/conversions/{$media->file_nameWithoutExtension}-{$conversion}.{$media->extension}" : null,
                "{$media->getKey()}/conversions/{$media->file_nameWithoutExtension}-{$conversion}.{$media->extension}",
            ]);

            foreach ($conversionCandidates as $candidate) {
                if ($from->exists($candidate)) {
                    $found["conversion:{$conversion}"] = $candidate;
                    break;
                }
            }
        }

        $responsiveDirs = array_filter([
            isset($found['original']) ? trim(dirname($found['original']).'/responsive-images', '.') : null,
            $datePath ? "media/{$datePath}/responsive-images" : null,
            "{$media->getKey()}/responsive-images",
        ]);

        foreach ($responsiveDirs as $dir) {
            $dir = trim($dir, '/');
            if ($dir === '' || ! $from->exists($dir)) {
                continue;
            }

            foreach ($from->files($dir) as $file) {
                if (str_contains($file, (string) $media->file_nameWithoutExtension)) {
                    $found['responsive:'.basename($file)] = $file;
                }
            }
        }

        return $found;
    }

    /**
     * @param  array<string, string>  $sourceFiles
     */
    protected function detectExistingBasePath(Media $media, array $sourceFiles): string
    {
        if (isset($sourceFiles['original'])) {
            return trim(dirname($sourceFiles['original']), '.');
        }

        return MediaPathResolver::forMedia($media);
    }

    protected function mapDestinationPath(string $role, string $sourcePath, string $destinationBase, Media $media): string
    {
        $destinationBase = trim($destinationBase, '/');

        if ($role === 'original') {
            return "{$destinationBase}/{$media->file_name}";
        }

        if (str_starts_with($role, 'conversion:')) {
            return "{$destinationBase}/conversions/".basename($sourcePath);
        }

        if (str_starts_with($role, 'responsive:')) {
            return "{$destinationBase}/responsive-images/".basename($sourcePath);
        }

        return "{$destinationBase}/".basename($sourcePath);
    }

    protected function copyOrphanFiles(Filesystem $from, Filesystem $to, bool $dryRun, int &$copied, int &$skipped): void
    {
        $this->info('Scanning source disk for orphan files...');

        foreach ($from->allFiles() as $file) {
            if ($to->exists($file)) {
                $skipped++;

                continue;
            }

            if ($dryRun) {
                $this->line("Would copy orphan: {$file}");
                $copied++;

                continue;
            }

            $to->put($file, $from->get($file));
            $copied++;
        }
    }
}
