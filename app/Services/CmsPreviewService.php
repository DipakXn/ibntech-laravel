<?php

namespace App\Services;

use App\CmsPreview\CmsContentRenderer;
use App\CmsPreview\CmsPreviewType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class CmsPreviewService
{
    public function __construct(
        protected CmsContentRenderer $renderer,
        protected SeoService $seoService,
    ) {}

    public function signedUrl(Model $model): string
    {
        $type = CmsPreviewType::fromModel($model);

        return URL::temporarySignedRoute(
            'cms.preview.show',
            now()->addHours((int) config('cms.preview_ttl_hours', 72)),
            [
                'type' => $type->value,
                'id' => $model->getKey(),
            ],
        );
    }

    public function find(CmsPreviewType $type, int|string $id): ?Model
    {
        $query = $type->modelClass()::query()->with($type->eagerLoad());

        if (in_array(SoftDeletes::class, class_uses_recursive($type->modelClass()), true)) {
            $query->withoutTrashed();
        }

        return $query->whereKey($id)->first();
    }

    public function authorizeGeneration(CmsPreviewType $type, Model $record): void
    {
        $resource = $type->filamentResource();

        abort_unless($resource::canViewAny(), 403);
        abort_unless($resource::canEdit($record), 403);
    }

    public function render(Model $model): Response
    {
        $type = CmsPreviewType::fromModel($model);

        $this->seoService->setCurrentForModel($model);
        $this->seoService->applyPreviewRestrictions($type->publicUrl($model));

        request()->attributes->set('cmsPreview', true);

        return $this->renderer->render($model)->withHeaders([
            'Cache-Control' => 'private, no-store, no-cache, must-revalidate',
            'Pragma' => 'no-cache',
            'X-Robots-Tag' => 'noindex, nofollow',
        ]);
    }
}
