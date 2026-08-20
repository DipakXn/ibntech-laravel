<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

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

        if ($seoMeta) {
            $ogImageOverride = $this->resolveSeoMediaUrl($seoMeta, 'og_image');
            $twitterImageOverride = $this->resolveSeoMediaUrl($seoMeta, 'twitter_image');
            $ogImage = $ogImageOverride ?: $featuredImage ?: $defaultOgImage;
            $twitterImage = $twitterImageOverride ?: $ogImageOverride ?: $featuredImage ?: $defaultOgImage;

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

            $this->current = [
                'meta_title' => $seoMeta->meta_title ?: ($model->title ?? ($siteDefaults['meta_title'] ?? $siteName)),
                'meta_description' => $seoMeta->meta_description ?: ($siteDefaults['meta_description'] ?? null),
                'meta_keywords' => $seoMeta->meta_keywords ?: ($siteDefaults['meta_keywords'] ?? null),

                'og_title' => $seoMeta->og_title ?: ($seoMeta->meta_title ?: ($model->title ?? $siteName)),
                'og_description' => $seoMeta->og_description ?: ($seoMeta->meta_description ?: ($siteDefaults['og_description'] ?? null)),
                'og_image' => $ogImage,
                'og_image_alt' => $seoMeta->og_image_alt ?: ($siteDefaults['og_image_alt'] ?? null),
                'og_type' => $seoMeta->og_type ?: (($model instanceof \App\Models\Blog) ? 'article' : ($siteDefaults['og_type'] ?? 'website')),
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
                'published_at' => $seoMeta->published_at?->toIso8601String() ?? null,
                'modified_at' => $seoMeta->modified_at?->toIso8601String() ?? null,
                'article_section' => $seoMeta->article_section ?? null,
                'article_tags' => $seoMeta->article_tags ?? null,
                'reading_time' => $seoMeta->reading_time ?? null,

                'json_ld' => $seoMeta->json_ld ?: $this->generateJsonLdForModel($model, $seoMeta),

                'sitemap_include' => $seoMeta->sitemap_include ?? true,
                'redirect_url' => $seoMeta->redirect_url ?? null,
                'custom_head_code' => $seoMeta->custom_head_code ?? null,
            ];
        } else {
            $this->current = [
                'meta_title' => $model->title ?? ($siteDefaults['meta_title'] ?? $siteName),
                'meta_description' => $siteDefaults['meta_description'] ?? null,
                'meta_keywords' => $siteDefaults['meta_keywords'] ?? null,
                'og_title' => $model->title ?? ($siteDefaults['og_title'] ?? $siteName),
                'og_description' => $siteDefaults['og_description'] ?? null,
                'og_image' => $featuredImage ?: $defaultOgImage,
                'og_image_alt' => $siteDefaults['og_image_alt'] ?? null,
                'og_type' => ($model instanceof \App\Models\Blog) ? 'article' : ($siteDefaults['og_type'] ?? 'website'),
                'og_site_name' => $siteDefaults['og_site_name'] ?? $siteName,
                'og_locale' => $siteDefaults['og_locale'] ?? config('app.locale'),
                'twitter_card_type' => $siteDefaults['twitter_card_type'] ?? 'summary_large_image',
                'twitter_title' => $model->title ?? ($siteDefaults['twitter_title'] ?? $siteName),
                'twitter_description' => $siteDefaults['twitter_description'] ?? null,
                'twitter_image' => $featuredImage ?: $defaultOgImage,
                'twitter_site' => $siteDefaults['twitter_site'] ?? null,
                'twitter_creator' => $siteDefaults['twitter_creator'] ?? null,
                'robots' => $siteDefaults['robots'] ?? 'index, follow',
                'canonical_url' => url()->current(),
            ];
        }
    }

    public function setCurrent(array $meta): void
    {
        $this->current = array_merge($this->defaults(), $meta);
    }

    public function current(): array
    {
        return array_merge($this->defaults(), $this->current, [
            'canonical_url' => $this->current['canonical_url'] ?? url()->current(),
        ]);
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
            'og_type' => 'website',
            'og_site_name' => config('app.name'),
            'og_locale' => config('app.locale'),

            'twitter_card_type' => 'summary_large_image',
            'twitter_title' => config('app.name'),
            'twitter_description' => null,
            'twitter_image' => null,
            'twitter_site' => null,
            'twitter_creator' => null,

            'canonical_url' => url()->current(),
            'link_prev' => null,
            'link_next' => null,
            'robots' => 'index, follow',

            'article_author' => null,
            'published_at' => null,
            'modified_at' => null,
            'article_section' => null,
            'article_tags' => null,
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
                'datePublished' => $seoMeta->published_at?->toIso8601String() ?? ($model->created_at?->toIso8601String() ?? null),
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

    protected function resolveFeaturedImage(Model $model): ?string
    {
        return method_exists($model, 'featuredImageUrl') ? $model->featuredImageUrl() : null;
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
}
