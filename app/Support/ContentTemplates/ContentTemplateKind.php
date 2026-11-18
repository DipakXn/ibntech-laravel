<?php

namespace App\Support\ContentTemplates;

use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use Illuminate\Database\Eloquent\Model;

enum ContentTemplateKind: string
{
    case Page = 'page';
    case Industry = 'industry';
    case LandingPage = 'landing-page';
    case Newsletter = 'newsletter';

    public function viewDirectory(): string
    {
        return match ($this) {
            self::Page => 'pages',
            self::Industry => 'industries',
            self::LandingPage => 'landing-pages',
            self::Newsletter => 'newsletters',
        };
    }

    public function cssDirectory(): string
    {
        return $this->viewDirectory();
    }

    public function label(): string
    {
        return match ($this) {
            self::Page => 'page',
            self::Industry => 'industry',
            self::LandingPage => 'landing page',
            self::Newsletter => 'newsletter',
        };
    }

    /**
     * @return list<string>
     */
    public function reservedSlugs(): array
    {
        return match ($this) {
            self::Page => [
                'admin',
                'article',
                'blog',
                'case-study',
                'contact',
                'ebook',
                'ibn-tech-cms-login',
                'industry',
                'lp',
                'newsletter',
                'pressrelease',
                'press-releases',
                'preview',
                'whitepapers',
                'livewire',
                'storage',
                'up',
                'payroll-processing-old',
                'back-offices-services',
                'accounting-finannce-cpa-firm-case-study-2',
            ],
            self::LandingPage => ['index'],
            self::Newsletter => ['index', 'footer'],
            self::Industry => [],
        };
    }

    public function isReserved(string $slug): bool
    {
        if (in_array($slug, $this->reservedSlugs(), true)) {
            return true;
        }

        if ($this !== self::Page) {
            return false;
        }

        return (bool) preg_match(
            '/^(?:page|post|category|article|case-study|ebook|white-paper|press-release|industry|lp|newsletter|custom)-sitemap\d*$/',
            $slug,
        );
    }

    /**
     * Public paths that should resolve to this slug, without a trailing slash.
     * The homepage is both `/` and `/home`.
     *
     * @return list<string>
     */
    public function lookupPaths(string $slug): array
    {
        return match ($this) {
            self::Page => $slug === 'home' ? ['/', '/home'] : ['/'.$slug],
            self::Industry => ['/industry/'.$slug],
            self::LandingPage => ['/lp/'.$slug],
            self::Newsletter => ['/newsletter/'.$slug],
        };
    }

    public function canonicalPath(string $slug): string
    {
        if ($this === self::Page && $slug === 'home') {
            return '/';
        }

        return $this->lookupPaths($slug)[0];
    }

    public static function tryFromModel(Model $model): ?self
    {
        return match (true) {
            $model instanceof Page => self::Page,
            $model instanceof Industry => self::Industry,
            $model instanceof LandingPage => self::LandingPage,
            $model instanceof Newsletter => self::Newsletter,
            default => null,
        };
    }

    public static function fromModel(Model $model): self
    {
        return self::tryFromModel($model) ?? throw new \InvalidArgumentException('Unsupported content template model ['.$model::class.'].');
    }
}
