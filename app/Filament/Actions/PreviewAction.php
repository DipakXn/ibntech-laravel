<?php

namespace App\Filament\Actions;

use App\CmsPreview\CmsPreviewType;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;

class PreviewAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'preview';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Preview')
            ->icon(Heroicon::OutlinedEye)
            ->color('gray')
            ->openUrlInNewTab()
            ->url(function (Model $record): ?string {
                $type = CmsPreviewType::tryFromModel($record);

                if ($type === null) {
                    return null;
                }

                return route('filament.admin.content-preview', [
                    'type' => $type->value,
                    'id' => $record->getKey(),
                ]);
            })
            ->visible(function (?Model $record): bool {
                if (! $record) {
                    return false;
                }

                $type = CmsPreviewType::tryFromModel($record);

                if ($type === null) {
                    return false;
                }

                $resource = $type->filamentResource();

                return $resource::canViewAny() && $resource::canEdit($record);
            });
    }
}
