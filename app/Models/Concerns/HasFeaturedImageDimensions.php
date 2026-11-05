<?php

namespace App\Models\Concerns;

use App\Support\Media\FeaturedImageDimensionResolver;

trait HasFeaturedImageDimensions
{
    /**
     * @return array{width: int, height: int}|null
     */
    public function featuredImageDimensions(?string $conversion = null): ?array
    {
        return app(FeaturedImageDimensionResolver::class)->resolve($this, 'featured_image', $conversion);
    }
}
