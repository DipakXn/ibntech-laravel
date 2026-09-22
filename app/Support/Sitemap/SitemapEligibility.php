<?php

namespace App\Support\Sitemap;

use App\Models\LandingPage;
use App\Models\SeoMeta;
use Illuminate\Database\Eloquent\Model;

class SitemapEligibility
{
    public static function allows(Model $model, string $publicUrl): bool
    {
        $status = $model->getAttribute('status');

        if ($status !== null && $status !== 'published') {
            return false;
        }

        if ($model instanceof LandingPage && $model->isThankYouPage()) {
            return false;
        }

        $seoMeta = $model->relationLoaded('seoMeta') ? $model->seoMeta : (method_exists($model, 'seoMeta') ? $model->seoMeta : null);

        if (! $seoMeta instanceof SeoMeta) {
            return SitemapUrlNormalizer::cmsLoc($publicUrl) !== null;
        }

        if ($seoMeta->sitemap_include === false) {
            return false;
        }

        if (is_string($seoMeta->robots_index) && strcasecmp($seoMeta->robots_index, 'noindex') === 0) {
            return false;
        }

        if (is_string($seoMeta->custom_meta_robots) && preg_match('/\bnoindex\b/i', $seoMeta->custom_meta_robots) === 1) {
            return false;
        }

        $redirectUrl = is_string($seoMeta->redirect_url) ? trim($seoMeta->redirect_url) : '';

        if ($redirectUrl !== '') {
            return false;
        }

        $canonical = is_string($seoMeta->canonical_url) ? trim($seoMeta->canonical_url) : '';

        if ($canonical !== '' && ! SitemapUrlNormalizer::cmsCanonicalMatchesPublicUrl($publicUrl, $canonical)) {
            return false;
        }

        return SitemapUrlNormalizer::cmsLoc($publicUrl) !== null;
    }
}
