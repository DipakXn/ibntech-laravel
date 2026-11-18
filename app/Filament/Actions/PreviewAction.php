<?php

namespace App\Filament\Actions;

use App\CmsPreview\CmsPreviewType;
use App\Services\ContentTemplateScaffold;
use App\Support\ContentTemplates\ContentTemplateKind;
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
            ->disabled(fn (?Model $record): bool => self::bladeIsMissing($record))
            ->tooltip(fn (?Model $record): ?string => self::bladeIsMissing($record)
                ? 'The Blade file for this template is missing, so preview is unavailable.'
                : null)
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

    private static function bladeIsMissing(?Model $record): bool
    {
        if (! $record) {
            return false;
        }

        $kind = ContentTemplateKind::tryFromModel($record);

        if ($kind === null) {
            return false;
        }

        return ! app(ContentTemplateScaffold::class)->bladeExists(
            $kind,
            (string) $record->getAttribute('template'),
        );
    }
}
