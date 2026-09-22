<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\SeoMeta;
use App\Models\WebsiteSetting;
use App\Services\Sitemap\SitemapCacheService;
use App\Support\Sitemap\SitemapType;
use Illuminate\Database\Eloquent\Model;

class SitemapCacheObserver
{
    public function __construct(private readonly SitemapCacheService $cache) {}

    public function saved(Model $model): void
    {
        $this->invalidate($model);
    }

    public function deleted(Model $model): void
    {
        $this->invalidate($model);
    }

    private function invalidate(Model $model): void
    {
        if ($model instanceof WebsiteSetting) {
            $this->cache->forgetAll();

            return;
        }

        if ($model instanceof SeoMeta) {
            $metableType = is_string($model->metable_type) ? $model->metable_type : null;

            if ($metableType) {
                $this->cache->forgetTypes(SitemapType::relatedTypesForModelClass($metableType));
            } else {
                $this->cache->forgetAll();
            }

            return;
        }

        if ($model instanceof Category) {
            $this->cache->forgetTypes([SitemapType::Blogs, SitemapType::BlogCategories]);

            return;
        }

        $this->cache->forgetTypes(SitemapType::relatedTypesForModelClass($model::class));
    }
}
