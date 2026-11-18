<?php

namespace App\Filament\Tables;

use App\Services\ContentTemplateScaffold;
use App\Support\ContentTemplates\ContentTemplateKind;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class ContentTemplateColumns
{
    /**
     * @return list<TextColumn>
     */
    public static function availability(): array
    {
        return [
            TextColumn::make('blade_availability')
                ->label('Blade')
                ->badge()
                ->state(fn (Model $record): string => self::label($record, 'blade'))
                ->color(fn (string $state): string => $state === 'Available' ? 'success' : 'danger'),
            TextColumn::make('css_availability')
                ->label('CSS')
                ->badge()
                ->state(fn (Model $record): string => self::label($record, 'css'))
                ->color(fn (string $state): string => $state === 'Available' ? 'success' : 'danger'),
        ];
    }

    private static function label(Model $record, string $asset): string
    {
        $kind = ContentTemplateKind::tryFromModel($record);
        $scaffold = app(ContentTemplateScaffold::class);
        $template = (string) $record->getAttribute('template');

        if ($kind === null) {
            return 'Missing';
        }

        $exists = $asset === 'blade'
            ? $scaffold->bladeExists($kind, $template)
            : $scaffold->cssExists($kind, $template);

        return $scaffold->availabilityLabel($exists);
    }
}
