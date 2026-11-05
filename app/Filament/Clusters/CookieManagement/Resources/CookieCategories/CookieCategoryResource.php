<?php

namespace App\Filament\Clusters\CookieManagement\Resources\CookieCategories;

use App\Filament\Clusters\CookieManagement\CookieManagementCluster;
use App\Filament\Clusters\CookieManagement\Resources\CookieCategories\Pages\EditCookieCategory;
use App\Filament\Clusters\CookieManagement\Resources\CookieCategories\Pages\ListCookieCategories;
use App\Filament\Clusters\CookieManagement\Resources\CookieCategories\Schemas\CookieCategoryForm;
use App\Filament\Clusters\CookieManagement\Resources\CookieCategories\Tables\CookieCategoriesTable;
use App\Models\CookieCategory;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CookieCategoryResource extends Resource
{
    protected static ?string $model = CookieCategory::class;

    protected static ?string $cluster = CookieManagementCluster::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQueueList;

    protected static ?string $navigationLabel = 'Categories';

    protected static ?string $modelLabel = 'Cookie category';

    protected static ?string $pluralModelLabel = 'Cookie categories';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'categories';

    public static function form(Schema $schema): Schema
    {
        return CookieCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CookieCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCookieCategories::route('/'),
            'edit' => EditCookieCategory::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user() instanceof User && auth()->user()->isAdministrator();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
