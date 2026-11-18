<?php

namespace App\Services;

use App\Models\ContentRedirect;
use App\Support\ContentTemplates\ContentTemplateKind;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ContentSlugRedirector
{
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

            ContentRedirect::query()->updateOrCreate(
                ['source_path' => $source],
                ['target_path' => $target],
            );
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
        $source = $this->normalize($path);

        if ($source === null) {
            return null;
        }

        $target = Cache::remember($this->cacheKey($source), 3600, function () use ($source): string|false {
            return ContentRedirect::query()->where('source_path', $source)->value('target_path') ?? false;
        });

        if (! is_string($target) || $target === '' || $target === $source || $this->normalize($target) === null) {
            return null;
        }

        return $target;
    }

    public function normalize(string $path): ?string
    {
        $path = '/'.trim(str_replace('\\', '/', $path), '/');

        if ($path === '/') {
            return '/';
        }

        if (str_contains($path, '..') || str_contains($path, '//') || preg_match('/^[a-z]+:/i', ltrim($path, '/'))) {
            return null;
        }

        return $path;
    }

    private function forget(string $path): void
    {
        Cache::forget($this->cacheKey($path));
    }

    private function cacheKey(string $path): string
    {
        return 'content-redirect:'.$path;
    }
}
