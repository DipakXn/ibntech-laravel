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
                            $kind = $get('kind');
                            $owner = $get('owner');
                            $page = (int) ($get('page') ?: 1);
                            $perPage = (int) ($get('per_page') ?: 10);
                            $paginator = MediaLibraryCatalog::browse(
                                $acceptedFileTypes,
                                is_string($query) ? $query : null,
                                is_string($kind) ? $kind : null,
                                is_string($owner) ? $owner : null,
                                $page,
                                $perPage,
                            );

                            return [
                                'paginator' => $paginator,
                                'cards' => array_values($paginator->items()),
                                'query' => is_string($query) ? $query : '',
                                'kind' => is_string($kind) ? $kind : '',
                                'owner' => is_string($owner) ? $owner : '',
                                'perPage' => in_array($perPage, MediaLibraryCatalog::PER_PAGE_OPTIONS, true) ? $perPage : 10,
                                'kindOptions' => MediaLibraryCatalog::kindOptions($acceptedFileTypes),
                                'ownerOptions' => MediaLibraryCatalog::ownerOptions(),
                            ];
                        }),
                    Hidden::make('query')->dehydrated(false)->default(''),
                    Hidden::make('kind')->dehydrated(false)->default(''),
                    Hidden::make('owner')->dehydrated(false)->default(''),
                    Hidden::make('page')->dehydrated(false)->default(1),
                    Hidden::make('per_page')->dehydrated(false)->default(10),
                ];
            })
            ->action(function (SpatieMediaLibraryFileUpload $component, array $data, MediaLibraryPicker $picker): void {
                $picker->attach($component, (int) $data['media_id']);
            });
    }
}
