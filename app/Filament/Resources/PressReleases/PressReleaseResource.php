<?php

namespace App\Filament\Resources\PressReleases;

use App\Filament\Resources\PressReleases\Pages\CreatePressRelease;
use App\Filament\Resources\PressReleases\Pages\EditPressRelease;
use App\Filament\Resources\PressReleases\Pages\ListPressReleases;
use App\Filament\Resources\PressReleases\Schemas\PressReleaseForm;
use App\Filament\Resources\PressReleases\Tables\PressReleasesTable;
use App\Models\PressRelease;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class PressReleaseResource extends Resource
{
    protected static ?string $model = PressRelease::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static ?string $navigationLabel = 'Press Releases';

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return PressReleaseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PressReleasesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPressReleases::route('/'),
            'create' => CreatePressRelease::route('/create'),
            'edit' => EditPressRelease::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user() instanceof User
            && in_array(auth()->user()->role, [User::ROLE_ADMINISTRATOR, User::ROLE_AUTHOR], true);
    }

    public static function canCreate(): bool
    {
        return static::canViewAny();
    }

    public static function canEdit(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete(Model $record): bool
    {
        return static::canViewAny();
    }
}
