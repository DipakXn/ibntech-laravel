<?php

namespace App\Filament\Resources\MediaLibrary;

use App\Filament\Resources\MediaLibrary\Pages\ListMediaLibrary;
use App\Filament\Resources\MediaLibrary\Tables\MediaLibraryTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use UnitEnum;

class MediaLibraryResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Media Library';

    protected static ?string $modelLabel = 'file';

    protected static ?string $pluralModelLabel = 'Media Library';

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 8;

    protected static ?string $slug = 'media-library';

    protected static ?string $recordTitleAttribute = 'file_name';

    public static function table(Table $table): Table
    {
        return MediaLibraryTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMediaLibrary::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('model');
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();

        return $user instanceof User
            && in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_AUTHOR], true);
    }

    public static function canView(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
