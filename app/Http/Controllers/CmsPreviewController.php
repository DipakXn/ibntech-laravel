<?php

namespace App\Http\Controllers;

use App\CmsPreview\CmsPreviewType;
use App\Services\CmsPreviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CmsPreviewController extends Controller
{
    public function __construct(protected CmsPreviewService $previews) {}

    public function show(Request $request, string $type, string $id): Response
    {
        abort_unless($request->hasValidSignature(), 404);

        $previewType = CmsPreviewType::tryFrom($type);
        abort_unless($previewType, 404);

        $record = $this->previews->find($previewType, $id);
        abort_unless($record, 404);

        return $this->previews->render($record);
    }

    public function redirect(string $type, string $id): RedirectResponse
    {
        $previewType = CmsPreviewType::tryFrom($type);
        abort_unless($previewType, 404);

        $record = $this->previews->find($previewType, $id);
        abort_unless($record, 404);

        $this->previews->authorizeGeneration($previewType, $record);

        return redirect()->away($this->previews->signedUrl($record));
    }
}
