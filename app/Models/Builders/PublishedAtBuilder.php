<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PublishedAtBuilder extends Builder
{
    public function latest($column = null)
    {
        if ($column !== null) {
            return parent::latest($column);
        }

        $table = $this->getModel()->getTable();

        return $this->orderByDesc(DB::raw("COALESCE({$table}.published_at, {$table}.created_at)"));
    }
}
