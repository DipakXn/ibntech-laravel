<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TemplateHelper
{
    public static function pageTemplateOptions(): array
    {
        return self::templateOptionsForDirectory('pages');
    }

    public static function industryTemplateOptions(): array
    {
        return self::templateOptionsForDirectory('industries');
    }

    public static function landingPageTemplateOptions(): array
    {
        return self::templateOptionsForDirectory('landing-pages');
    }

    public static function newsletterTemplateOptions(): array
    {
        return self::templateOptionsForDirectory('newsletters');
    }

    public static function blogTemplateOptions(): array
    {
        return [
            'default' => 'Default Blog Template',
        ];
    }

    public static function caseStudyTemplateOptions(): array
    {
        return [
            'default' => 'Default Case Study Template',
        ];
    }

    public static function ebookTemplateOptions(): array
    {
        return [
            'default' => 'Default eBook Template',
        ];
    }

    public static function pressReleaseTemplateOptions(): array
    {
        return [
            'default' => 'Default Press Release Template',
        ];
    }

    public static function whitePaperTemplateOptions(): array
    {
        return [
            'default' => 'Default White Paper Template',
        ];
    }

    public static function articleTemplateOptions(): array
    {
        return [
            'default' => 'Default Article Template',
        ];
    }

    protected static function templateOptionsForDirectory(string $directory): array
    {
        $path = resource_path("views/{$directory}");

        if (! File::isDirectory($path)) {
            return [];
        }

        return collect(File::files($path))
            ->filter(fn ($file) => $file->getExtension() === 'php' && str_ends_with($file->getFilename(), '.blade.php'))
            ->sortBy(fn ($file) => $file->getFilename())
            ->mapWithKeys(function ($file): array {
                $template = str_replace('.blade.php', '', $file->getFilename());

                return [$template => Str::headline($template)];
            })
            ->all();
    }
}
