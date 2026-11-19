<?php

namespace App\Observers;

use App\Support\EditorialPublication;
use Illuminate\Database\Eloquent\Model;

class EditorialPublicationObserver
{
    public function saving(Model $model): void
    {
        if (! EditorialPublication::appliesTo($model)) {
            return;
        }

        $model->setAttribute('status', EditorialPublication::normalizeStatus(
            $model->getAttribute('status'),
            $model->getAttribute('published_at'),
        ));
    }
}
