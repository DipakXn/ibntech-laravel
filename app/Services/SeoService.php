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

        if ($seoMeta) {
            $ogImageOverride = $this->resolveSeoMediaUrl($seoMeta, 'og_image');
            $twitterImageOverride = $this->resolveSeoMediaUrl($seoMeta, 'twitter_image');
            $ogImage = $ogImageOverride ?: $featuredImage;
            $twitterImage = $twitterImageOverride ?: $ogImageOverride ?: $featuredImage;

            $robotsParts = [];
            $robotsParts[] = $seoMeta->robots_index ?? 'index';
            $robotsParts[] = $seoMeta->robots_follow ?? 'follow';
            if (! empty($seoMeta->robots_max_snippet)) {
                $robotsParts[] = 'max-snippet:'.$seoMeta->robots_max_snippet;
            }
            if (! empty($seoMeta->robots_max_image_preview)) {
                $robotsParts[] = 'max-image-preview:'.$seoMeta->robots_max_image_preview;
            }

            $robots = implode(', ', $robotsParts);

            $this->current = [
                'meta_title' => $seoMeta->meta_title ?: ($model->title ?? config('app.name')),
                'meta_description' => $seoMeta->meta_description ?: null,
                'meta_keywords' => $seoMeta->meta_keywords ?? null,

                'og_title' => $seoMeta->og_title ?: ($seoMeta->meta_title ?: ($model->title ?? config('app.name'))),
                'og_description' => $seoMeta->og_description ?: ($seoMeta->meta_description ?? null),
                'og_image' => $ogImage,
                'og_image_alt' => $seoMeta->og_image_alt ?? null,
                'og_type' => $seoMeta->og_type ?: (($model instanceof \App\Models\Blog) ? 'article' : 'website'),
                'og_site_name' => $seoMeta->og_site_name ?: config('app.name'),
                'og_locale' => $seoMeta->og_locale ?: config('app.locale'),

                'twitter_card_type' => $seoMeta->twitter_card_type ?: 'summary_large_image',
                'twitter_title' => $seoMeta->twitter_title ?: ($seoMeta->meta_title ?: ($model->title ?? config('app.name'))),
                'twitter_description' => $seoMeta->twitter_description ?: ($seoMeta->meta_description ?? null),
                'twitter_image' => $twitterImage,
                'twitter_creator' => $seoMeta->twitter_creator ?? null,
                'twitter_site' => $seoMeta->twitter_site ?? null,

                'canonical_url' => $seoMeta->canonical_url ?: url()->current(),

                'robots' => $seoMeta->custom_meta_robots ?? $robots,

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
                'meta_title' => $model->title ?? config('app.name'),
                'meta_description' => null,
                'og_title' => $model->title ?? config('app.name'),
                'og_description' => null,
                'og_image' => $featuredImage,
                'twitter_image' => $featuredImage,
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
        return [
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

            'canonical_url' => url()->current(),
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
        ];
    }

    protected function generateJsonLdForModel(Model $model, $seoMeta): ?string
    {
        try {
            $featuredImage = $this->resolveFeaturedImage($model);
            $ogImage = $seoMeta
                ? ($this->resolveSeoMediaUrl($seoMeta, 'og_image') ?: $featuredImage)
                : $featuredImage;

            $data = [
                '@context' => 'https://schema.org',
                '@type' => 'BlogPosting',
                'headline' => $seoMeta->meta_title ?? ($model->title ?? config('app.name')),
                'description' => $seoMeta->meta_description ?? null,
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
                    'name' => config('app.name'),
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
