<?php

namespace App\Filament\Resources\PressReleases;

use App\Filament\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Categories\Tables\CategoriesTable;
use App\Filament\Resources\PressReleases\Pages\CreatePressReleaseCategory;
use App\Filament\Resources\PressReleases\Pages\EditPressReleaseCategory;
use App\Filament\Resources\PressReleases\Pages\ListPressReleaseCategories;
use App\Models\Category;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class PressReleaseCategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $navigationLabel = 'Categories';

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?string $navigationParentItem = 'Press Releases';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema, Category::MODULE_PRESS_RELEASE);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->forModule(Category::MODULE_PRESS_RELEASE);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPressReleaseCategories::route('/'),
            'create' => CreatePressReleaseCategory::route('/create'),
            'edit' => EditPressReleaseCategory::route('/{record}/edit'),
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
