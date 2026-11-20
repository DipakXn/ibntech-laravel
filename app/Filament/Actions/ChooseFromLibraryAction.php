<?php

namespace App\Filament\Actions;

use App\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Support\MediaLibrary\MediaLibraryCatalog;
use App\Support\MediaLibrary\MediaLibraryPicker;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;

class ChooseFromLibraryAction
{
    public static function make(): Action
    {
        return Action::make('chooseFromLibrary')
            ->label('Choose from library')
            ->icon(Heroicon::OutlinedPhoto)
            ->color('primary')
            ->modalHeading('Choose from library')
            ->modalWidth(Width::FiveExtraLarge)
            ->modalSubmitActionLabel('Select file')
            ->visible(fn (SpatieMediaLibraryFileUpload $component): bool => $component->getCollection() !== 'library')
            ->schema(function (SpatieMediaLibraryFileUpload $component): array {
                $acceptedFileTypes = $component->getAcceptedFileTypes();

                return [
                    ViewField::make('media_id')
                        ->hiddenLabel()
                        ->required()
                        ->validationAttribute('file')
                        ->view('filament.media-library.picker', function (Get $get) use ($acceptedFileTypes): array {
                            $query = $get('query');

                            return [
                                'cards' => MediaLibraryCatalog::cards($acceptedFileTypes, is_string($query) ? $query : null),
                                'query' => is_string($query) ? $query : '',
                            ];
                        }),
                    Hidden::make('query')
                        ->dehydrated(false)
                        ->default(''),
                ];
            })
            ->action(function (SpatieMediaLibraryFileUpload $component, array $data, MediaLibraryPicker $picker): void {
                $picker->attach($component, (int) $data['media_id']);
            });
    }
}
