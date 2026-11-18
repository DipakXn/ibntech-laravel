<?php

namespace App\Filament\Support;

use App\Filament\Resources\Industries\IndustryResource;
use App\Filament\Resources\LandingPages\LandingPageResource;
use App\Filament\Resources\Newsletters\NewsletterResource;
use App\Filament\Resources\Pages\PageResource;
use App\Support\ContentTemplates\ContentTemplateKind;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;

class ContentTemplateDeleteCopy
{
    public const TEMPLATE_FILES_NOTE = 'The CMS record will be removed, but its Blade and CSS files stay in the project. Delete those files manually in Cursor if you no longer need them. The CMS does not remove them automatically.';

    public const TEMPLATE_RESTORE_NOTE = 'Restoring only brings the CMS record back. The Blade and CSS files were not changed while the item was in trash.';

    public static function appliesTo(?Model $record): bool
    {
        return $record instanceof Model && ContentTemplateKind::tryFromModel($record) !== null;
    }

    public static function livewireManagesTemplateFiles(HasTable $livewire): bool
    {
        if (! $livewire instanceof ListRecords) {
            return false;
        }

        return in_array($livewire->getResource(), [
            PageResource::class,
            IndustryResource::class,
            LandingPageResource::class,
            NewsletterResource::class,
        ], true);
    }

    public static function trashDescription(?Model $record = null, bool $forTemplateModule = false): string
    {
        $bulk = $forTemplateModule && $record === null;

        $base = $bulk
            ? 'Selected items will be moved to trash. You can restore them later from the Trash tab.'
            : 'The item will be moved to trash. You can restore it later from the Trash tab.';

        if ($forTemplateModule || self::appliesTo($record)) {
            return $base.' '.self::TEMPLATE_FILES_NOTE;
        }

        return $base;
    }

    public static function forceDeleteDescription(?Model $record = null, bool $forTemplateModule = false): string
    {
        $bulk = $forTemplateModule && $record === null;

        $base = $bulk
            ? 'This action cannot be undone. Selected items and their related cleanup rules will be applied permanently.'
            : 'This action cannot be undone. The item and its related cleanup rules will be applied permanently.';

        if ($forTemplateModule || self::appliesTo($record)) {
            return $base.' '.self::TEMPLATE_FILES_NOTE;
        }

        return $base;
    }

    public static function restoreDescription(?Model $record = null, bool $forTemplateModule = false): string
    {
        $bulk = $forTemplateModule && $record === null;

        $base = $bulk
            ? 'Selected items will be restored and appear in the All listing again.'
            : 'This item will be restored and appear in the All listing again.';

        if ($forTemplateModule || self::appliesTo($record)) {
            return $base.' '.self::TEMPLATE_RESTORE_NOTE;
        }

        return $base;
    }
}
