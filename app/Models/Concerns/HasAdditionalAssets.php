<?php

namespace App\Models\Concerns;

use App\Support\AdditionalAssets;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasAdditionalAssets
{
    protected function additionalCss(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): ?string => AdditionalAssets::normalizeCss($value),
            set: fn (?string $value): ?string => AdditionalAssets::normalizeCss($value),
        );
    }

    protected function additionalJs(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): ?string => AdditionalAssets::normalizeJs($value),
            set: fn (?string $value): ?string => AdditionalAssets::normalizeJs($value),
        );
    }
}
