<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SeoService
{
    protected array $current = [];

    public function setCurrentForModel(Model $model): void
    {
        $seoMeta = $model->seoMeta;
        $featuredImage = $this->resolveFeaturedImage($model);
        $siteDefaults = $this->siteDefaults();
        $siteName = $siteDefaults['og_site_name'] ?? config('app.name');
        $defaultOgImage = $siteDefaults['og_image'] ?? null;
        $ogImageSource = $this->resolveOgImageSource($model, $seoMeta, $featuredImage, $defaultOgImage);

        if ($seoMeta) {
            $twitterImageSource = $this->resolveTwitterImageSource($model, $seoMeta, $ogImageSource);
            $ogImage = $ogImageSource['url'];
            $twitterImage = $twitterImageSource['url'];

            $robotsParts = [];
            $robotsParts[] = $seoMeta->robots_index ?? ($siteDefaults['robots_index'] ?? 'index');
            $robotsParts[] = $seoMeta->robots_follow ?? ($siteDefaults['robots_follow'] ?? 'follow');
            $maxSnippet = $seoMeta->robots_max_snippet ?? ($siteDefaults['robots_max_snippet'] ?? null);
            $maxImagePreview = $seoMeta->robots_max_image_preview ?? ($siteDefaults['robots_max_image_preview'] ?? null);
            if (! empty($maxSnippet) || $maxSnippet === '0' || $maxSnippet === 0) {
                $robotsParts[] = 'max-snippet:'.$maxSnippet;
            }
            if (! empty($maxImagePreview)) {
                $robotsParts[] = 'max-image-preview:'.$maxImagePreview;
            }

            $robots = implode(', ', $robotsParts);
            $ogImageAlt = $seoMeta->og_image_alt ?: ($siteDefaults['og_image_alt'] ?? null);

            $this->current = array_merge([
                'meta_title' => $seoMeta->meta_title ?: ($model->title ?? ($siteDefaults['meta_title'] ?? $siteName)),
                'meta_description' => $seoMeta->meta_description ?: ($siteDefaults['meta_description'] ?? null),
                'meta_keywords' => $seoMeta->meta_keywords ?: ($siteDefaults['meta_keywords'] ?? null),

                'og_title' => $seoMeta->og_title ?: ($seoMeta->meta_title ?: ($model->title ?? $siteName)),
                'og_description' => $seoMeta->og_description ?: ($seoMeta->meta_description ?: ($siteDefaults['og_description'] ?? null)),
                'og_image' => $ogImage,
                'og_image_alt' => $ogImageAlt,
                'og_type' => $seoMeta->og_type ?: (($model instanceof Blog) ? 'article' : ($siteDefaults['og_type'] ?? 'website')),
                'og_site_name' => $seoMeta->og_site_name ?: ($siteDefaults['og_site_name'] ?? $siteName),
                'og_locale' => $seoMeta->og_locale ?: ($siteDefaults['og_locale'] ?? config('app.locale')),

                'twitter_card_type' => $seoMeta->twitter_card_type ?: ($siteDefaults['twitter_card_type'] ?? 'summary_large_image'),
                'twitter_title' => $seoMeta->twitter_title ?: ($seoMeta->meta_title ?: ($model->title ?? $siteName)),
                'twitter_description' => $seoMeta->twitter_description ?: ($seoMeta->meta_description ?: ($siteDefaults['twitter_description'] ?? null)),
                'twitter_image' => $twitterImage,
                'twitter_creator' => $seoMeta->twitter_creator ?: ($siteDefaults['twitter_creator'] ?? null),
                'twitter_site' => $seoMeta->twitter_site ?: ($siteDefaults['twitter_site'] ?? null),

                'canonical_url' => $seoMeta->canonical_url ?: url()->current(),

                'robots' => $seoMeta->custom_meta_robots ?: $robots,

                'article_author' => $seoMeta->article_author ?? null,
                'published_at' => $seoMeta->published_at?->toIso8601String()
                    ?? $this->modelPublishedAt($model),
                'article_section' => $this->articleSection($model, $seoMeta),
                'article_tags' => $this->normalizeArticleTags($seoMeta->article_tags ?? null),
                'reading_time' => $this->readingTime($model, $seoMeta),

                'json_ld' => $seoMeta->json_ld ?: $this->generateJsonLdForModel($model, $seoMeta),

                'sitemap_include' => $seoMeta->sitemap_include ?? true,
                'redirect_url' => $seoMeta->redirect_url ?? null,
                'custom_head_code' => $seoMeta->custom_head_code ?? null,
            ], $this->modelDerivedMeta($model, $seoMeta, $ogImageSource, $ogImageAlt));
        } else {
            $ogImage = $ogImageSource['url'];
            $ogImageAlt = $siteDefaults['og_image_alt'] ?? null;

            $this->current = array_merge([
                'meta_title' => $model->title ?? ($siteDefaults['meta_title'] ?? $siteName),
                'meta_description' => $siteDefaults['meta_description'] ?? null,
                'meta_keywords' => $siteDefaults['meta_keywords'] ?? null,
                'og_title' => $model->title ?? ($siteDefaults['og_title'] ?? $siteName),
                'og_description' => $siteDefaults['og_description'] ?? null,
                'og_image' => $ogImage,
                'og_image_alt' => $ogImageAlt,
                'og_type' => ($model instanceof Blog) ? 'article' : ($siteDefaults['og_type'] ?? 'website'),
                'og_site_name' => $siteDefaults['og_site_name'] ?? $siteName,
                'og_locale' => $siteDefaults['og_locale'] ?? config('app.locale'),
                'twitter_card_type' => $siteDefaults['twitter_card_type'] ?? 'summary_large_image',
                'twitter_title' => $model->title ?? ($siteDefaults['twitter_title'] ?? $siteName),
                'twitter_description' => $siteDefaults['twitter_description'] ?? null,
                'twitter_image' => $ogImage,
                'twitter_site' => $siteDefaults['twitter_site'] ?? null,
                'twitter_creator' => $siteDefaults['twitter_creator'] ?? null,
                'robots' => $siteDefaults['robots'] ?? 'index, follow',
                'canonical_url' => url()->current(),
                'published_at' => $this->modelPublishedAt($model),
                'article_section' => $this->articleSection($model, null),
                'article_tags' => [],
                'reading_time' => $this->readingTime($model, null),
            ], $this->modelDerivedMeta($model, null, $ogImageSource, $ogImageAlt));
        }
    }

    public function setCurrent(array $meta): void
    {
        $this->current = array_merge($this->defaults(), $meta);
    }

    public function current(): array
    {
        $seo = array_merge($this->defaults(), $this->current, [
            'canonical_url' => $this->current['canonical_url'] ?? url()->current(),
        ]);

        $seo['og_locale'] = $this->normalizeOgLocale($seo['og_locale'] ?? null);
        $seo['article_tags'] = $this->normalizeArticleTags($seo['article_tags'] ?? null);

        return $seo;
    }

    protected function defaults(): array
    {
        $siteDefaults = $this->siteDefaults();

        return array_merge([
            'meta_title' => config('app.name'),
            'meta_description' => null,
            'meta_keywords' => null,

            'og_title' => config('app.name'),
            'og_description' => null,
            'og_image' => null,
            'og_image_alt' => null,
            'og_image_secure_url' => null,
            'og_image_width' => null,
            'og_image_height' => null,
            'og_image_type' => null,
            'og_type' => 'website',
            'og_site_name' => config('app.name'),
            'og_locale' => config('app.locale'),
            'og_updated_time' => null,

            'twitter_card_type' => 'summary_large_image',
            'twitter_title' => config('app.name'),
            'twitter_description' => null,
            'twitter_image' => null,
            'twitter_image_alt' => null,
            'twitter_site' => null,
            'twitter_creator' => null,
            'twitter_label1' => null,
            'twitter_data1' => null,

            'canonical_url' => url()->current(),
            'link_prev' => null,
            'link_next' => null,
            'robots' => 'index, follow',

            'article_publisher' => null,
            'article_author' => null,
            'published_at' => null,
            'modified_at' => null,
            'article_section' => null,
            'article_tags' => [],
            'reading_time' => null,

            'json_ld' => null,

            'sitemap_include' => true,
            'redirect_url' => null,
            'custom_head_code' => null,
        ], $siteDefaults);
    }

    /**
     * @return array<string, mixed>
     */
    protected function siteDefaults(): array
    {
        try {
            $settings = app(WebsiteSettingService::class)->get();
            $siteName = $settings->site_name ?: config('app.name');
            $ogImage = $settings->defaultOgImageUrl();

            return [
                'meta_title' => $settings->default_meta_title ?: $siteName,
                'meta_description' => $settings->default_meta_description,
                'meta_keywords' => $settings->default_meta_keywords,
                'og_title' => $settings->default_meta_title ?: $siteName,
                'og_description' => $settings->default_meta_description,
                'og_image' => $ogImage,
                'og_image_alt' => $settings->og_image_alt,
                'og_type' => $settings->og_type ?: 'website',
                'og_site_name' => $settings->og_site_name ?: $siteName,
                'og_locale' => $settings->og_locale ?: config('app.locale'),
                'twitter_card_type' => $settings->twitter_card_type ?: 'summary_large_image',
                'twitter_title' => $settings->default_meta_title ?: $siteName,
                'twitter_description' => $settings->default_meta_description,
                'twitter_image' => $ogImage,
                'twitter_site' => $settings->twitter_site,
                'twitter_creator' => $settings->twitter_creator,
                'robots' => $settings->robotsMetaString(),
                'robots_index' => $settings->robots_index ?: 'index',
                'robots_follow' => $settings->robots_follow ?: 'follow',
                'robots_max_snippet' => $settings->robots_max_snippet,
                'robots_max_image_preview' => $settings->robots_max_image_preview,
                'custom_meta_robots' => $settings->custom_meta_robots,
                'article_publisher' => $this->nonEmptyString($settings->social_facebook),
            ];
        } catch (\Throwable) {
            return [];
        }
    }

    protected function generateJsonLdForModel(Model $model, $seoMeta): ?string
    {
        try {
            $featuredImage = $this->resolveFeaturedImage($model);
            $siteDefaults = $this->siteDefaults();
            $ogImage = $seoMeta
                ? ($this->resolveSeoMediaUrl($seoMeta, 'og_image') ?: $featuredImage ?: ($siteDefaults['og_image'] ?? null))
                : ($featuredImage ?: ($siteDefaults['og_image'] ?? null));
            $organizationName = $siteDefaults['og_site_name'] ?? config('app.name');

            try {
                $organizationName = app(WebsiteSettingService::class)->get()->organization_name
                    ?: $organizationName;
            } catch (\Throwable) {
                // Keep fallback organization name.
            }

            $data = [
                '@context' => 'https://schema.org',
                '@type' => 'BlogPosting',
                'headline' => $seoMeta->meta_title ?? ($model->title ?? ($siteDefaults['meta_title'] ?? config('app.name'))),
                'description' => $seoMeta->meta_description ?? ($siteDefaults['meta_description'] ?? null),
                'url' => $seoMeta->canonical_url ?? url()->current(),
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id' => $seoMeta->canonical_url ?? url()->current(),
                ],
                'datePublished' => $seoMeta->published_at?->toIso8601String()
                    ?? $this->modelPublishedAt($model)
                    ?? ($model->created_at?->toIso8601String() ?? null),
                'dateModified' => $seoMeta->modified_at?->toIso8601String() ?? ($model->updated_at?->toIso8601String() ?? null),
                'author' => [
                    '@type' => 'Person',
                    'name' => $seoMeta->article_author ?? null,
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => $organizationName,
                ],
            ];

            if (! empty($ogImage)) {
                $data['image'] = [
                    '@type' => 'ImageObject',
                    'url' => $ogImage,
                ];
            }

            return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * @param  array{url: ?string, media: ?Media}  $ogImageSource
     * @return array<string, mixed>
     */
    protected function modelDerivedMeta(Model $model, $seoMeta, array $ogImageSource, ?string $ogImageAlt): array
    {
        $readingTime = $this->readingTime($model, $seoMeta);

        return array_merge(
            $this->imageMeta($ogImageSource['url'], $ogImageSource['media']),
            $this->twitterReadingTimeMeta($readingTime),
            [
                'og_updated_time' => $this->modelUpdatedAt($model),
                'modified_at' => $seoMeta?->modified_at?->toIso8601String() ?? $this->modelUpdatedAt($model),
                'twitter_image_alt' => $this->nonEmptyString($ogImageAlt),
                'reading_time' => $readingTime,
            ],
        );
    }

    /**
     * @return array{url: ?string, media: ?Media}
     */
    protected function resolveOgImageSource(Model $model, $seoMeta, ?string $featuredImage, ?string $defaultOgImage): array
    {
        if ($seoMeta) {
            $ogMedia = $this->firstMedia($seoMeta, 'og_image');
            if ($ogMedia) {
                return ['url' => $this->mediaUrl($ogMedia) ?: $this->resolveSeoMediaUrl($seoMeta, 'og_image'), 'media' => $ogMedia];
            }

            $ogImageOverride = $this->nonEmptyString($seoMeta->og_image ?? null);
            if ($ogImageOverride) {
                return ['url' => $ogImageOverride, 'media' => null];
            }
        }

        $featuredMedia = $this->firstMedia($model, 'featured_image');
        if ($featuredMedia) {
            return ['url' => $featuredImage ?: $this->mediaUrl($featuredMedia), 'media' => $featuredMedia];
        }

        if ($featuredImage) {
            return ['url' => $featuredImage, 'media' => null];
        }

        $defaultMedia = $this->defaultOgImageMedia();
        if ($defaultMedia) {
            return ['url' => $defaultOgImage ?: $this->mediaUrl($defaultMedia), 'media' => $defaultMedia];
        }

        return ['url' => $defaultOgImage, 'media' => null];
    }

    /**
     * @param  array{url: ?string, media: ?Media}  $ogImageSource
     * @return array{url: ?string, media: ?Media}
     */
    protected function resolveTwitterImageSource(Model $model, $seoMeta, array $ogImageSource): array
    {
        $twitterMedia = $this->firstMedia($seoMeta, 'twitter_image');
        if ($twitterMedia) {
            return ['url' => $this->mediaUrl($twitterMedia) ?: $this->resolveSeoMediaUrl($seoMeta, 'twitter_image'), 'media' => $twitterMedia];
        }

        $twitterImageOverride = $this->nonEmptyString($seoMeta->twitter_image ?? null);
        if ($twitterImageOverride) {
            return ['url' => $twitterImageOverride, 'media' => null];
        }

        return $ogImageSource;
    }

    /**
     * @return array<string, mixed>
     */
    protected function imageMeta(?string $url, ?Media $media): array
    {
        $fileMeta = $media ? $this->readImageFileMeta($media) : [];
        $width = $fileMeta['width'] ?? $this->positiveInt(data_get($media?->custom_properties, 'width'));
        $height = $fileMeta['height'] ?? $this->positiveInt(data_get($media?->custom_properties, 'height'));
        $type = $fileMeta['type'] ?? $this->nonEmptyString($media?->mime_type);

        return [
            'og_image_secure_url' => $this->httpsUrl($url),
            'og_image_width' => $width,
            'og_image_height' => $height,
            'og_image_type' => $type,
        ];
    }

    /**
     * @return array{width?: int, height?: int, type?: string}
     */
    protected function readImageFileMeta(Media $media): array
    {
        try {
            $path = $media->getPath();

            if ($path === '' || ! is_file($path)) {
                return [];
            }

            $size = @getimagesize($path);

            if ($size === false) {
                return [];
            }

            $meta = [];

            if (! empty($size[0])) {
                $meta['width'] = (int) $size[0];
            }

            if (! empty($size[1])) {
                $meta['height'] = (int) $size[1];
            }

            if (! empty($size['mime']) && is_string($size['mime'])) {
                $meta['type'] = $size['mime'];
            }

            return $meta;
        } catch (\Throwable) {
            return [];
        }
    }

    /**
     * @return array{twitter_label1: ?string, twitter_data1: ?string}
     */
    protected function twitterReadingTimeMeta(?int $minutes): array
    {
        if ($minutes === null || $minutes < 1) {
            return [
                'twitter_label1' => null,
                'twitter_data1' => null,
            ];
        }

        return [
            'twitter_label1' => 'Est. reading time',
            'twitter_data1' => $minutes.' '.($minutes === 1 ? 'minute' : 'minutes'),
        ];
    }

    protected function articleSection(Model $model, $seoMeta): ?string
    {
        $section = $this->nonEmptyString($seoMeta?->article_section ?? null);

        if ($section) {
            return $section;
        }

        if (method_exists($model, 'category')) {
            return $this->nonEmptyString($model->category?->name);
        }

        return null;
    }

    /**
     * @return list<string>
     */
    protected function normalizeArticleTags(mixed $tags): array
    {
        if (is_string($tags)) {
            $tags = preg_split('/\s*,\s*/', $tags) ?: [];
        }

        if (! is_array($tags)) {
            return [];
        }

        $normalized = [];

        foreach ($tags as $tag) {
            if (! is_string($tag) && ! is_numeric($tag)) {
                continue;
            }

            $tag = trim((string) $tag);

            if ($tag !== '') {
                $normalized[] = $tag;
            }
        }

        return array_values(array_unique($normalized));
    }

    protected function readingTime(Model $model, $seoMeta): ?int
    {
        $stored = $this->positiveInt($seoMeta?->reading_time ?? null);

        if ($stored) {
            return $stored;
        }

        if (method_exists($model, 'estimatedReadTime')) {
            return $this->positiveInt($model->estimatedReadTime());
        }

        return $this->estimateReadTimeFromPlainText($this->modelPlainText($model));
    }

    protected function modelPlainText(Model $model): string
    {
        $segments = [];

        foreach (['excerpt', 'summary', 'content'] as $attribute) {
            $value = $model->getAttribute($attribute);

            if (is_string($value) && trim($value) !== '') {
                $segments[] = html_entity_decode(strip_tags($value), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }
        }

        $templateText = $this->templatePlainText($model);

        if ($templateText !== '') {
            $segments[] = $templateText;
        }

        return trim(preg_replace('/\s+/', ' ', implode(' ', $segments)) ?? '');
    }

    protected function templatePlainText(Model $model): string
    {
        $viewName = $this->modelViewName($model);

        if ($viewName === null) {
            return '';
        }

        try {
            if (! view()->exists($viewName)) {
                return '';
            }

            $path = view()->getFinder()->find($viewName);
            $source = is_string($path) && is_file($path) ? (string) file_get_contents($path) : '';
        } catch (\Throwable) {
            return '';
        }

        $source = preg_replace('/\{\{--.*?--\}\}/s', ' ', $source) ?? $source;
        $source = preg_replace('/@\w+/', ' ', $source) ?? $source;
        $source = str_replace(['{{', '}}', '{!!', '!!}', '<?php', '<?=', '?>'], ' ', $source);

        return trim(html_entity_decode(strip_tags($source), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }

    protected function modelViewName(Model $model): ?string
    {
        $template = $this->nonEmptyString($model->getAttribute('template'));

        if ($template === null) {
            return null;
        }

        $prefix = match ($model::class) {
            Page::class => 'pages.',
            Industry::class => 'industries.',
            LandingPage::class => 'landing-pages.',
            Newsletter::class => 'newsletters.',
            default => null,
        };

        return $prefix ? $prefix.$template : null;
    }

    protected function estimateReadTimeFromPlainText(string $plainText): ?int
    {
        $wordCount = str_word_count($plainText);

        if ($wordCount < 1) {
            return null;
        }

        return max(1, (int) ceil($wordCount / 220));
    }

    protected function normalizeOgLocale(?string $locale): string
    {
        $value = str_replace('-', '_', trim((string) $locale));

        if ($value === '' || strcasecmp($value, 'en') === 0 || strcasecmp($value, 'en_us') === 0) {
            return 'en_US';
        }

        return $value;
    }

    protected function httpsUrl(?string $url): ?string
    {
        $url = $this->nonEmptyString($url);

        if (! $url) {
            return null;
        }

        if (str_starts_with($url, '//')) {
            $url = 'https:'.$url;
        } elseif (str_starts_with($url, '/')) {
            $url = url($url);
        }

        if (str_starts_with($url, 'http://')) {
            $url = 'https://'.substr($url, 7);
        }

        return str_starts_with($url, 'https://') ? $url : null;
    }

    protected function firstMedia(object $model, string $collection): ?Media
    {
        if (! method_exists($model, 'getFirstMedia')) {
            return null;
        }

        try {
            $media = $model->getFirstMedia($collection);
        } catch (\Throwable) {
            return null;
        }

        return $media instanceof Media ? $media : null;
    }

    protected function mediaUrl(Media $media): ?string
    {
        try {
            return $this->nonEmptyString($media->getUrl());
        } catch (\Throwable) {
            return null;
        }
    }

    protected function defaultOgImageMedia(): ?Media
    {
        try {
            return $this->firstMedia(app(WebsiteSettingService::class)->get(), 'default_og_image');
        } catch (\Throwable) {
            return null;
        }
    }

    protected function resolveFeaturedImage(Model $model): ?string
    {
        if (! method_exists($model, 'featuredImageUrl')) {
            return null;
        }

        try {
            return $this->nonEmptyString($model->featuredImageUrl());
        } catch (\Throwable) {
            return $this->nonEmptyString($model->getAttribute('featured_image'));
        }
    }

    protected function modelPublishedAt(Model $model): ?string
    {
        if (method_exists($model, 'publishedAt')) {
            return $model->publishedAt()?->toIso8601String();
        }

        $publishedAt = $model->getAttribute('published_at');

        return $publishedAt?->toIso8601String();
    }

    protected function modelUpdatedAt(Model $model): ?string
    {
        $updatedAt = $model->getAttribute('updated_at');

        return $updatedAt?->toIso8601String();
    }

    protected function resolveSeoMediaUrl(object $seoMeta, string $collection): ?string
    {
        $attribute = $collection;

        if (method_exists($seoMeta, 'getFirstMediaUrl')) {
            $mediaUrl = $seoMeta->getFirstMediaUrl($collection);

            if (! empty($mediaUrl)) {
                return $mediaUrl;
            }
        }

        return $seoMeta->{$attribute} ?? null;
    }

    protected function nonEmptyString(mixed $value): ?string
    {
        if (! is_string($value)) {
            return null;
        }

        $value = trim($value);

        return $value !== '' ? $value : null;
    }

    protected function positiveInt(mixed $value): ?int
    {
        if (! is_numeric($value)) {
            return null;
        }

        $value = (int) $value;

        return $value > 0 ? $value : null;
    }
}
