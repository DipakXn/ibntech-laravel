<?php

namespace App\Support\Sitemap;

use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\WhitePaper;

enum SitemapType: string
{
    case Pages = 'pages';
    case Blogs = 'blogs';
    case BlogCategories = 'blog_categories';
    case Articles = 'articles';
    case CaseStudies = 'case_studies';
    case Ebooks = 'ebooks';
    case WhitePapers = 'white_papers';
    case PressReleases = 'press_releases';
    case Industries = 'industries';
    case LandingPages = 'landing_pages';
    case Newsletters = 'newsletters';
    case Custom = 'custom';

    public function label(): string
    {
        return (string) (config('sitemap.types.'.$this->value.'.label') ?? $this->value);
    }

    public function filePrefix(): string
    {
        return (string) (config('sitemap.types.'.$this->value.'.file') ?? $this->value.'-sitemap');
    }

    public function fileName(int $part = 1): string
    {
        $prefix = $this->filePrefix();

        return $part <= 1 ? $prefix.'.xml' : $prefix.$part.'.xml';
    }

    /**
     * @return array{enabled: bool, changefreq: string, priority: string}
     */
    public function defaults(): array
    {
        $config = config('sitemap.types.'.$this->value, []);

        return [
            'enabled' => (bool) ($config['enabled'] ?? true),
            'changefreq' => (string) ($config['changefreq'] ?? 'weekly'),
            'priority' => (string) ($config['priority'] ?? '0.5'),
        ];
    }

    /**
     * @return array{0: self, 1: int}|null
     */
    public static function parseFileName(string $file): ?array
    {
        $file = basename($file);

        foreach (self::cases() as $type) {
            $prefix = $type->filePrefix();

            if ($file === $prefix.'.xml') {
                return [$type, 1];
            }

            $quoted = preg_quote($prefix, '/');

            if (preg_match('/^'.$quoted.'([2-9]|[1-9]\d+)\.xml$/', $file, $matches) === 1) {
                return [$type, (int) $matches[1]];
            }
        }

        return null;
    }

    public static function fromModelClass(string $class): ?self
    {
        return match ($class) {
            Page::class => self::Pages,
            Blog::class => self::Blogs,
            Category::class => self::BlogCategories,
            Article::class => self::Articles,
            CaseStudy::class => self::CaseStudies,
            Ebook::class => self::Ebooks,
            WhitePaper::class => self::WhitePapers,
            PressRelease::class => self::PressReleases,
            Industry::class => self::Industries,
            LandingPage::class => self::LandingPages,
            Newsletter::class => self::Newsletters,
            default => null,
        };
    }

    /**
     * @return list<self>
     */
    public static function relatedTypesForModelClass(string $class): array
    {
        $type = self::fromModelClass($class);

        if ($type === null) {
            return [];
        }

        if ($type === self::Blogs || $type === self::BlogCategories) {
            return [self::Blogs, self::BlogCategories];
        }

        return [$type];
    }

    /**
     * @param  array<string, mixed>|null  $stored
     * @return list<array<string, mixed>>
     */
    public static function formState(?array $stored): array
    {
        $rows = [];

        foreach (self::cases() as $type) {
            $defaults = $type->defaults();
            $override = is_array($stored[$type->value] ?? null) ? $stored[$type->value] : [];

            $rows[] = [
                'key' => $type->value,
                'label' => $type->label(),
                'enabled' => array_key_exists('enabled', $override)
                    ? (bool) $override['enabled']
                    : $defaults['enabled'],
                'changefreq' => is_string($override['changefreq'] ?? null) && $override['changefreq'] !== ''
                    ? $override['changefreq']
                    : $defaults['changefreq'],
                'priority' => self::normalizePriority($override['priority'] ?? $defaults['priority'])
                    ?? $defaults['priority'],
            ];
        }

        return $rows;
    }

    /**
     * @param  list<array<string, mixed>>  $rows
     * @return array<string, array{enabled: bool, changefreq: string, priority: string}>
     */
    public static function storedState(array $rows): array
    {
        $stored = [];

        foreach ($rows as $row) {
            if (! is_array($row)) {
                continue;
            }

            $key = $row['key'] ?? null;
            $type = is_string($key) ? self::tryFrom($key) : null;

            if (! $type instanceof self) {
                continue;
            }

            $defaults = $type->defaults();
            $changefreq = is_string($row['changefreq'] ?? null) ? strtolower($row['changefreq']) : $defaults['changefreq'];

            if (! in_array($changefreq, config('sitemap.changefreq_values', []), true)) {
                $changefreq = $defaults['changefreq'];
            }

            $stored[$type->value] = [
                'enabled' => (bool) ($row['enabled'] ?? $defaults['enabled']),
                'changefreq' => $changefreq,
                'priority' => self::normalizePriority($row['priority'] ?? $defaults['priority']) ?? $defaults['priority'],
            ];
        }

        return $stored;
    }

    public static function normalizePriority(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (! is_numeric($value)) {
            return null;
        }

        $number = (float) $value;

        if ($number < 0 || $number > 1) {
            return null;
        }

        return number_format($number, 1, '.', '');
    }

    public static function filePattern(): string
    {
        $prefixes = array_map(
            fn (self $type): string => preg_quote($type->filePrefix(), '/'),
            self::cases(),
        );

        return '('.implode('|', $prefixes).')(\d+)?\.xml';
    }
}
