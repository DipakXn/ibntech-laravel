<?php

namespace App\Models\Concerns;

use App\Models\Builders\PublishedAtBuilder;
use Carbon\CarbonInterface;

trait HasPublishedAt
{
    public function publishedAt(): ?CarbonInterface
    {
        return $this->published_at ?? $this->created_at;
    }

    public function newEloquentBuilder($query): PublishedAtBuilder
    {
        return new PublishedAtBuilder($query);
    }
}
