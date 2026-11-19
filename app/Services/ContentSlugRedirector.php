<?php

namespace App\Services;

use App\Models\ContentRedirect;
use App\Support\ContentTemplates\ContentTemplateKind;
use Illuminate\Database\Eloquent\Model;

class ContentSlugRedirector
{
    /**
     * A new record owns these public paths. Drop stale redirects that still point away from them.
     */
    public function claimPaths(Model $record): void
    {
        $paths = $this->pathsFor($record);

        if ($paths === []) {
            return;
        }

        ContentRedirect::withTrashed()->whereIn('source_path', $paths)->get()->each->forceDelete();

        foreach ($paths as $path) {
            $this->forget($path);
        }
    }

    /**
     * Remove redirects tied to this record's URLs when the record is trashed or deleted.
     */
    public function releasePaths(Model $record): void
    {
        $paths = $this->pathsFor($record);

        if ($paths === []) {
            return;
        }

        ContentRedirect::withTrashed()
            ->where(function ($query) use ($paths): void {
                $query
                    ->whereIn('source_path', $paths)
                    ->orWhereIn('target_path', $paths);
            })
            ->get()
            ->each(function (ContentRedirect $redirect): void {
                $this->forget($redirect->source_path);
                $redirect->forceDelete();
            });

        foreach ($paths as $path) {
            $this->forget($path);
        }
    }

    public function record(Model $record, string $fromSlug, string $toSlug): void
    {
        $kind = ContentTemplateKind::tryFromModel($record);

        if ($kind === null || $fromSlug === '' || $toSlug === '' || $fromSlug === $toSlug) {
            return;
        }

        $target = $kind->canonicalPath($toSlug);
        $oldPaths = $kind->lookupPaths($fromSlug);
        $newPaths = $kind->lookupPaths($toSlug);

        ContentRedirect::query()->whereIn('source_path', $newPaths)->delete();

        foreach ($newPaths as $path) {
            $this->forget($path);
        }

        ContentRedirect::query()
            ->whereIn('target_path', $oldPaths)
            ->get()
            ->each(function (ContentRedirect $redirect) use ($target): void {
                if ($redirect->source_path === $target) {
                    $redirect->delete();
                } else {
                    $redirect->target_path = $target;
                    $redirect->status_code = 301;
                    $redirect->is_active = true;
                    $redirect->origin = ContentRedirect::ORIGIN_SLUG;
                    $redirect->save();
                }

                $this->forget($redirect->source_path);
            });

        foreach ($oldPaths as $source) {
            if ($source === $target) {
                ContentRedirect::query()->where('source_path', $source)->delete();
                $this->forget($source);

                continue;
            }

            $existing = ContentRedirect::withTrashed()->where('source_path', $source)->first();

            if ($existing instanceof ContentRedirect) {
                if ($existing->trashed()) {
                    $existing->restore();
                }

                $existing->fill([
                    'target_path' => $target,
                    'status_code' => 301,
                    'is_active' => true,
                    'origin' => ContentRedirect::ORIGIN_SLUG,
                ])->save();
            } else {
                ContentRedirect::query()->create([
                    'source_path' => $source,
                    'target_path' => $target,
                    'status_code' => 301,
                    'is_active' => true,
                    'origin' => ContentRedirect::ORIGIN_SLUG,
                ]);
            }
            $this->forget($source);
        }

        ContentRedirect::query()
            ->whereColumn('source_path', 'target_path')
            ->get()
            ->each(function (ContentRedirect $redirect): void {
                $this->forget($redirect->source_path);
                $redirect->delete();
            });
    }

    public function targetFor(string $path): ?string
    {
        return app(SiteRedirects::class)->targetFor($path);
    }

    public function normalize(string $path): ?string
    {
        return app(SiteRedirects::class)->normalizeSource($path);
    }

    private function forget(string $path): void
    {
        app(SiteRedirects::class)->forget($path);
    }

    /**
     * @return list<string>
     */
    private function pathsFor(Model $record): array
    {
        $kind = ContentTemplateKind::tryFromModel($record);

        if ($kind === null) {
            return [];
        }

        $slug = (string) $record->getAttribute('slug');

        if ($slug === '') {
            return [];
        }

        return $kind->lookupPaths($slug);
    }
}
