<?php

namespace App\Support\MediaLibrary;

use App\Filament\Pages\WebsiteSettings;
use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Resources\Ebooks\EbookResource;
use App\Filament\Resources\Industries\IndustryResource;
use App\Filament\Resources\LandingPages\LandingPageResource;
use App\Filament\Resources\Newsletters\NewsletterResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\PressReleases\PressReleaseResource;
use App\Filament\Resources\Testimonials\TestimonialResource;
use App\Filament\Resources\WhitePapers\WhitePaperResource;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\MediaLibrary;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\SeoMeta;
use App\Models\Testimonial;
use App\Models\WebsiteSetting;
use App\Models\WhitePaper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use RuntimeException;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryUsage
{
    public const COPIED_FROM = 'copied_from_media_id';

    /**
     * @var array<class-string<Model>, class-string>
     */
    private const RESOURCES = [
        Article::class => ArticleResource::class,
        Blog::class => BlogResource::class,
        CaseStudy::class => CaseStudyResource::class,
        Ebook::class => EbookResource::class,
        Industry::class => IndustryResource::class,
        LandingPage::class => LandingPageResource::class,
        Newsletter::class => NewsletterResource::class,
        Page::class => PageResource::class,
        PressRelease::class => PressReleaseResource::class,
        Testimonial::class => TestimonialResource::class,
        WhitePaper::class => WhitePaperResource::class,
    ];

    /**
     * @var list<class-string<Model>>
     */
    private const CONTENT_MODELS = [
        Article::class,
        Blog::class,
        CaseStudy::class,
        Ebook::class,
        PressRelease::class,
        WhitePaper::class,
    ];

    public function listHtml(Media $media): HtmlString
    {
        $parts = [$this->linkHtml($this->describe($media->model))];

        if ($media->model_type === MediaLibrary::class) {
            $copies = $this->copies($media);

            if ($copies->isEmpty()) {
                $parts[] = '<span>Not used by content yet.</span>';
            }

            foreach ($copies as $copy) {
                $parts[] = '<span>Copied to '.$this->linkHtml($this->describe($copy->model)).'</span>';
            }
        }

        return new HtmlString(implode('<br>', $parts));
    }

    public function detailHtml(Media $media): HtmlString
    {
        $parts = [
            '<div><strong>Stored as</strong><br>'.$this->linkHtml($this->describe($media->model)).'</div>',
        ];

        foreach ($this->references($media) as $reference) {
            $parts[] = '<div><strong>'.$reference['reason'].'</strong><br>'.$this->linkHtml($reference).'</div>';
        }

        if ($media->model_type === MediaLibrary::class && $this->references($media) === []) {
            $parts[] = '<div>Not used by content yet.</div>';
        }

        return new HtmlString(implode('', $parts));
    }

    public function canDelete(Media $media): bool
    {
        return $this->deletionBlockReason($media) === null;
    }

    public function deletionBlockReason(Media $media): ?string
    {
        if ($media->model_type !== MediaLibrary::class) {
            return 'This file belongs to existing content. Remove it from that record instead of deleting it here.';
        }

        $references = $this->references($media);

        if ($references === []) {
            return null;
        }

        $labels = array_map(fn (array $reference): string => $reference['label'], $references);

        return 'This file is in use by '.implode(', ', $labels).'. Remove those uses before deleting it.';
    }

    public function delete(Media $media): void
    {
        $reason = $this->deletionBlockReason($media);

        if ($reason !== null) {
            throw new RuntimeException($reason);
        }

        $media->delete();
    }

    /**
     * @return Collection<int, Media>
     */
    public function copies(Media $media): Collection
    {
        return Media::query()
            ->whereKeyNot($media->getKey())
            ->where('custom_properties->'.self::COPIED_FROM, $media->getKey())
            ->with('model')
            ->get();
    }

    /**
     * @return list<array{label: string, url: ?string, reason: string}>
     */
    public function references(Media $media): array
    {
        $references = [];

        foreach ($this->copies($media) as $copy) {
            $described = $this->describe($copy->model);
            $described['reason'] = 'Copied to';
            $references[] = $described;
        }

        $needle = trim((string) $media->getPathRelativeToRoot(), '/');

        if ($needle === '') {
            return $references;
        }

        $like = '%'.addcslashes($needle, '%_\\').'%';

        foreach (self::CONTENT_MODELS as $class) {
            $query = $class::query();

            if (in_array(SoftDeletes::class, class_uses_recursive($class), true)) {
                $query->withTrashed();
            }

            foreach ($query->where('content', 'like', $like)->get() as $record) {
                $described = $this->describe($record);
                $described['reason'] = 'Referenced in';
                $references[] = $described;
            }
        }

        return $references;
    }

    /**
     * @return array{label: string, url: ?string}
     */
    private function describe(?Model $model): array
    {
        if (! $model) {
            return ['label' => 'Missing record', 'url' => null];
        }

        if ($model instanceof SeoMeta) {
            $parent = $model->metable;
            $described = $this->describe($parent instanceof Model ? $parent : null);
            $described['label'] = 'SEO on '.$described['label'];

            return $described;
        }

        return [
            'label' => $this->label($model),
            'url' => $this->editUrl($model),
        ];
    }

    private function label(Model $model): string
    {
        if ($model instanceof MediaLibrary) {
            return 'Media Library';
        }

        if ($model instanceof WebsiteSetting) {
            return 'Website settings';
        }

        $name = $model->getAttribute('title')
            ?? $model->getAttribute('customer_name')
            ?? $model->getAttribute('site_name')
            ?? $model->getAttribute('name');

        $label = Str::headline(class_basename($model));

        if (is_string($name) && trim($name) !== '') {
            $label .= ': '.trim($name);
        }

        if (method_exists($model, 'trashed') && $model->trashed()) {
            $label .= ' (trashed)';
        }

        return $label;
    }

    private function editUrl(Model $model): ?string
    {
        try {
            if ($model instanceof WebsiteSetting) {
                return WebsiteSettings::getUrl();
            }

            $resource = self::RESOURCES[$model::class] ?? null;

            if ($resource === null || ! $model->exists || ! $resource::canEdit($model)) {
                return null;
            }

            return $resource::getUrl('edit', ['record' => $model]);
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * @param  array{label: string, url: ?string}  $entry
     */
    private function linkHtml(array $entry): string
    {
        $label = e($entry['label']);

        if (blank($entry['url'])) {
            return $label;
        }

        return '<a href="'.e($entry['url']).'" class="text-primary-600 underline">'.$label.'</a>';
    }
}
