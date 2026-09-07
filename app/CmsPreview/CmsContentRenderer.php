<?php

namespace App\CmsPreview;

use App\Services\BlogService;
use App\Services\NewsletterService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class CmsContentRenderer
{
    public function __construct(
        protected BlogService $blogService,
        protected NewsletterService $newsletterService,
    ) {}

    public function render(Model $model): Response
    {
        $type = CmsPreviewType::fromModel($model);
        $view = $type->viewName($model);

        if ($type->requiresViewExists()) {
            abort_unless(View::exists($view), 404);
        }

        return response()->view($view, $this->viewData($type, $model));
    }

    /**
     * @return array<string, mixed>
     */
    public function viewData(CmsPreviewType $type, Model $model): array
    {
        $data = [
            $type->viewVariable() => $model,
        ];

        if ($type === CmsPreviewType::Blog) {
            $data['latestPosts'] = $this->blogService->latestPublished(6);
        }

        if ($type === CmsPreviewType::Newsletter) {
            $data['latestNewsletters'] = $this->newsletterService->latestPublished();
        }

        return $data;
    }
}
