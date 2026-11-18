<?php

namespace App\Services;

use App\Support\ContentTemplates\ContentTemplateKind;
use App\Support\ContentTemplates\ScaffoldResult;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class ContentTemplateScaffold
{
    public const MAX_SLUG_LENGTH = 120;

    public function assertSlug(ContentTemplateKind $kind, string $slug): void
    {
        if (! preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)) {
            throw ValidationException::withMessages([
                'slug' => 'Use lowercase letters, numbers, and hyphens only.',
            ]);
        }

        if (strlen($slug) > self::MAX_SLUG_LENGTH) {
            throw ValidationException::withMessages([
                'slug' => 'Use a slug of '.self::MAX_SLUG_LENGTH.' characters or fewer so the Blade and CSS filenames stay portable.',
            ]);
        }

        if ($this->isDeviceName($slug) || str_contains($slug, '..') || str_contains($slug, '/') || str_contains($slug, '\\')) {
            throw ValidationException::withMessages([
                'slug' => 'That slug cannot be used as a filename.',
            ]);
        }

        if ($kind->isReserved($slug)) {
            throw ValidationException::withMessages([
                'slug' => 'That slug is reserved because a route or template already uses it.',
            ]);
        }
    }

    public function createMissing(ContentTemplateKind $kind, string $slug): ScaffoldResult
    {
        $this->assertSlug($kind, $slug);

        $bladePath = $this->absolutePath($this->viewsRoot(), $kind->viewDirectory(), $slug, 'blade.php');
        $cssPath = $this->absolutePath($this->cssRoot(), $kind->cssDirectory(), $slug, 'css');

        $bladeCreated = $this->writeIfMissing($bladePath, $this->bladeStub($kind, $slug));
        $cssCreated = $this->writeIfMissing($cssPath, $this->cssStub($kind, $slug));

        return new ScaffoldResult(
            bladeCreated: $bladeCreated,
            cssCreated: $cssCreated,
            bladePath: $this->displayPath($bladePath),
            cssPath: $this->displayPath($cssPath),
        );
    }

    public function assertAssetsExist(ContentTemplateKind $kind, string $template): void
    {
        $this->assertSlug($kind, $template);

        $missing = [];

        if (! $this->bladeExists($kind, $template)) {
            $missing[] = 'Blade file resources/views/'.$kind->viewDirectory().'/'.$template.'.blade.php';
        }

        if (! $this->cssExists($kind, $template)) {
            $missing[] = 'CSS file resources/css/'.$kind->cssDirectory().'/'.$template.'.css';
        }

        if ($missing === []) {
            return;
        }

        throw ValidationException::withMessages([
            'status' => 'Publish is blocked until these files exist: '.implode('; ', $missing).'.',
        ]);
    }

    public function bladeExists(ContentTemplateKind $kind, string $template): bool
    {
        return $template !== '' && is_file($this->existingPath($this->viewsRoot(), $kind->viewDirectory(), $template, 'blade.php'));
    }

    public function cssExists(ContentTemplateKind $kind, string $template): bool
    {
        return $template !== '' && is_file($this->existingPath($this->cssRoot(), $kind->cssDirectory(), $template, 'css'));
    }

    public function availabilityLabel(bool $exists): string
    {
        return $exists ? 'Available' : 'Missing';
    }

    private function writeIfMissing(string $path, string $contents): bool
    {
        if (is_file($path)) {
            return false;
        }

        File::ensureDirectoryExists(dirname($path));
        File::put($path, $contents);

        return true;
    }

    private function bladeStub(ContentTemplateKind $kind, string $slug): string
    {
        $class = $kind->viewDirectory().'-'.$slug;

        return match ($kind) {
            ContentTemplateKind::Page => <<<BLADE
                {{-- Starter page. Customize this file in Cursor. The CMS does not edit it. --}}
                @extends('layouts.app')

                @push('styles')
                    @vite(['resources/css/pages/{$slug}.css'])
                @endpush

                @section('content')
                    <article class="{$class}">
                        <section class="inner-hero">
                            <div class="site-shell inner-hero__inner">
                                <h1>{{ \$page->title }}</h1>
                            </div>
                        </section>
                    </article>
                @endsection

                BLADE,
            ContentTemplateKind::Industry => <<<BLADE
                {{-- Starter industry page. Customize this file in Cursor. The CMS does not edit it. --}}
                @extends('layouts.app')

                @push('styles')
                    @vite(['resources/css/industries/{$slug}.css'])
                @endpush

                @section('title', \$industry->title)

                @section('content')
                    <article class="{$class}">
                        <section class="inner-hero">
                            <div class="site-shell inner-hero__inner">
                                <h1>{{ \$industry->title }}</h1>
                            </div>
                        </section>
                    </article>
                @endsection

                BLADE,
            ContentTemplateKind::LandingPage => <<<BLADE
                {{-- Starter landing page. Customize this file in Cursor. The CMS does not edit it. --}}
                @extends('layouts.landing')

                @section('content')
                    <div class="{$class}">
                        @include('landing-pages.partials.campaign')
                    </div>
                @endsection

                BLADE,
            ContentTemplateKind::Newsletter => <<<BLADE
                {{-- Starter newsletter. Customize this file in Cursor. The CMS does not edit it. --}}
                @extends('layouts.newsletter')

                @push('styles')
                    @vite(['resources/css/newsletters/{$slug}.css'])
                @endpush

                @section('content')
                    <div class="{$class}">
                        @include('newsletters.partials.stage-1')
                    </div>
                @endsection

                BLADE,
        };
    }

    private function cssStub(ContentTemplateKind $kind, string $slug): string
    {
        $class = $kind->viewDirectory().'-'.$slug;

        return <<<CSS
            /* Starter styles for {$kind->label()} "{$slug}". Customize this file in Cursor. */

            .{$class} {
                --cms-navy: #2e2e80;
                --cms-green: #4caf50;
                --cms-ink: #1f1d1d;
                color: var(--cms-ink);
            }

            CSS;
    }

    private function absolutePath(string $root, string $directory, string $name, string $extension): string
    {
        $rootReal = realpath($root);

        if ($rootReal === false) {
            throw ValidationException::withMessages([
                'slug' => 'The template directory is not available.',
            ]);
        }

        $directoryPath = $rootReal.DIRECTORY_SEPARATOR.$directory;

        if (! is_dir($directoryPath) && ! mkdir($directoryPath, 0755, true) && ! is_dir($directoryPath)) {
            throw ValidationException::withMessages([
                'slug' => 'The template directory could not be created.',
            ]);
        }

        $directoryReal = realpath($directoryPath);

        if ($directoryReal === false || ! str_starts_with($directoryReal, $rootReal)) {
            throw ValidationException::withMessages([
                'slug' => 'That slug cannot be used as a filename.',
            ]);
        }

        $filename = $name.'.'.$extension;
        $path = $directoryReal.DIRECTORY_SEPARATOR.$filename;

        if (basename($path) !== $filename) {
            throw ValidationException::withMessages([
                'slug' => 'That slug cannot be used as a filename.',
            ]);
        }

        return $path;
    }

    private function existingPath(string $root, string $directory, string $name, string $extension): string
    {
        return $root.DIRECTORY_SEPARATOR.$directory.DIRECTORY_SEPARATOR.$name.'.'.$extension;
    }

    private function displayPath(string $absolute): string
    {
        $base = base_path().DIRECTORY_SEPARATOR;

        if (str_starts_with($absolute, $base)) {
            return str_replace('\\', '/', substr($absolute, strlen($base)));
        }

        return str_replace('\\', '/', $absolute);
    }

    private function viewsRoot(): string
    {
        $configured = config('cms.scaffold.views');

        return is_string($configured) && $configured !== '' ? $configured : resource_path('views');
    }

    private function cssRoot(): string
    {
        $configured = config('cms.scaffold.css');

        return is_string($configured) && $configured !== '' ? $configured : resource_path('css');
    }

    private function isDeviceName(string $slug): bool
    {
        $name = strtolower(strtok($slug, '.') ?: $slug);

        return in_array($name, ['con', 'prn', 'aux', 'nul', 'com1', 'com2', 'lpt1'], true);
    }
}
