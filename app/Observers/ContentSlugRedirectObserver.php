<?php

namespace App\Observers;

use App\Services\ContentSlugRedirector;
use Illuminate\Database\Eloquent\Model;

class ContentSlugRedirectObserver
{
    /**
     * Previous public slug, keyed by the model instance.
     * The event dispatcher resolves a new observer for every event, so this
     * cannot live on the instance.
     *
     * @var array<int, string>
     */
    private static array $publishedSlugBeforeChange = [];

    public function updating(Model $model): void
    {
        $key = spl_object_id($model);

        unset(self::$publishedSlugBeforeChange[$key]);

        if (! $model->isDirty('slug') || $model->getOriginal('status') !== 'published') {
            return;
        }

        $original = $model->getOriginal('slug');

        if (! is_string($original) || $original === '') {
            return;
        }

        self::$publishedSlugBeforeChange[$key] = $original;
    }

    public function updated(Model $model): void
    {
        $key = spl_object_id($model);
        $from = self::$publishedSlugBeforeChange[$key] ?? null;
        unset(self::$publishedSlugBeforeChange[$key]);

        if ($from === null || ! $model->wasChanged('slug')) {
            return;
        }

        app(ContentSlugRedirector::class)->record($model, $from, (string) $model->getAttribute('slug'));
    }
}
