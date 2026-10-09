<?php

namespace App\CmsPreview;

use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Resources\Ebooks\EbookResource;
use App\Filament\Resources\Industries\IndustryResource;
use App\Filament\Resources\LandingPages\LandingPageResource;
use App\Filament\Resources\Newsletters\NewsletterResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\PressReleases\PressReleaseResource;
use App\Filament\Resources\WhitePapers\WhitePaperResource;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\WhitePaper;
use App\Support\PathPageUrl;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

enum CmsPreviewType: string
{
    case Page = 'page';
    case Blog = 'blog';
    case Article = 'article';
    case CaseStudy = 'case-study';
    case PressRelease = 'press-release';
    case Ebook = 'ebook';
    case WhitePaper = 'white-paper';
    case LandingPage = 'landing-page';
    case Newsletter = 'newsletter';
    case Industry = 'industry';

    /**
     * @return class-string<Model>
     */
    public function modelClass(): string
    {
        return match ($this) {
            self::Page => Page::class,
            self::Blog => Blog::class,
            self::Article => Article::class,
            self::CaseStudy => CaseStudy::class,
            self::PressRelease => PressRelease::class,
            self::Ebook => Ebook::class,
            self::WhitePaper => WhitePaper::class,
            self::LandingPage => LandingPage::class,
            self::Newsletter => Newsletter::class,
            self::Industry => Industry::class,
        };
    }

    /**
     * @return class-string
     */
    public function filamentResource(): string
    {
        return match ($this) {
            self::Page => PageResource::class,
            self::Blog => BlogResource::class,
            self::Article => ArticleResource::class,
            self::CaseStudy => CaseStudyResource::class,
            self::PressRelease => PressReleaseResource::class,
            self::Ebook => EbookResource::class,
            self::WhitePaper => WhitePaperResource::class,
            self::LandingPage => LandingPageResource::class,
            self::Newsletter => NewsletterResource::class,
            self::Industry => IndustryResource::class,
        };
    }

    public function viewVariable(): string
    {
        return match ($this) {
            self::Page => 'page',
            self::Blog => 'blog',
            self::Article => 'article',
            self::CaseStudy => 'caseStudy',
            self::PressRelease => 'pressRelease',
            self::Ebook => 'ebook',
            self::WhitePaper => 'whitePaper',
            self::LandingPage => 'landingPage',
            self::Newsletter => 'newsletter',
            self::Industry => 'industry',
        };
    }

    public function viewName(Model $model): string
    {
        $template = (string) $model->getAttribute('template');

        return match ($this) {
            self::Page => 'pages.'.$template,
            self::Blog => 'blog.templates.'.$template,
            self::Article => 'articles.templates.'.$template,
            self::CaseStudy => 'case-studies.templates.'.$template,
            self::PressRelease => 'press-releases.templates.'.$template,
            self::Ebook => 'ebooks.templates.'.$template,
            self::WhitePaper => 'white-papers.templates.'.$template,
            self::LandingPage => 'landing-pages.'.$template,
            self::Newsletter => 'newsletters.'.$template,
            self::Industry => 'industries.'.$template,
        };
    }

    public function requiresViewExists(): bool
    {
        return match ($this) {
            self::Page, self::LandingPage, self::Newsletter, self::Industry => true,
            default => false,
        };
    }

    /**
     * @return list<string>
     */
    public function eagerLoad(): array
    {
        return match ($this) {
            self::Blog => ['category.parent', 'seoMeta', 'media'],
            self::Article, self::CaseStudy, self::PressRelease, self::Ebook, self::WhitePaper => ['category', 'seoMeta', 'media'],
            default => ['seoMeta', 'media'],
        };
    }

    public function publicUrl(Model $model): string
    {
        $slug = (string) $model->getAttribute('slug');

        return match ($this) {
            self::Page => $slug === 'home'
                ? url('/')
                : PathPageUrl::withTrailingSlash(url('/'.$slug)),
            self::Blog => PathPageUrl::withTrailingSlash(url('/blog/'.$slug)),
            self::Article => PathPageUrl::withTrailingSlash(route('articles.show', ['slug' => $slug])),
            self::CaseStudy => PathPageUrl::withTrailingSlash(route('case-studies.show', ['slug' => $slug])),
            self::PressRelease => PathPageUrl::withTrailingSlash(url('/pressrelease/'.$slug)),
            self::Ebook => PathPageUrl::withTrailingSlash(route('ebooks.show', ['slug' => $slug])),
            self::WhitePaper => PathPageUrl::withTrailingSlash(route('white-papers.show', ['slug' => $slug])),
            self::LandingPage => $model instanceof LandingPage
                ? $model->publicUrl()
                : PathPageUrl::withTrailingSlash(url('/lp/'.$slug)),
            self::Newsletter => $model instanceof Newsletter
                ? $model->publicUrl()
                : PathPageUrl::withTrailingSlash(url('/newsletter/'.$slug)),
            self::Industry => PathPageUrl::withTrailingSlash(url('/industry/'.$slug)),
        };
    }

    public static function fromModel(Model $model): self
    {
        foreach (self::cases() as $type) {
            if ($model instanceof ($type->modelClass())) {
                return $type;
            }
        }

        throw new InvalidArgumentException('Unsupported CMS preview model: '.$model::class);
    }

    public static function tryFromModel(Model $model): ?self
    {
        foreach (self::cases() as $type) {
            if ($model instanceof ($type->modelClass())) {
                return $type;
            }
        }

        return null;
    }

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_map(fn (self $type): string => $type->value, self::cases());
    }
}
