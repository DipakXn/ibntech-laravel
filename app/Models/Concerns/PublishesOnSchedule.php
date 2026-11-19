<?php

namespace App\Models\Concerns;

use App\Support\EditorialPublication;
use Illuminate\Database\Eloquent\Builder;

trait PublishesOnSchedule
{
    public function scopePublished(Builder $query): Builder
    {
        $table = $query->getModel()->getTable();

        return $query
            ->where($table.'.status', EditorialPublication::PUBLISHED)
            ->where(function (Builder $query) use ($table): void {
                $query->whereNull($table.'.published_at')
                    ->orWhere($table.'.published_at', '<=', now());
            });
    }
}
