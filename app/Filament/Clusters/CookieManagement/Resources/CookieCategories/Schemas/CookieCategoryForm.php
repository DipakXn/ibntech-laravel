<?php

namespace App\Filament\Clusters\CookieManagement\Resources\CookieCategories\Schemas;

use App\Models\CookieCategory;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CookieCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category')
                    ->description('Necessary cookies stay on. Optional categories can be hidden from the banner.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(120),
                        TextInput::make('sort_order')
                            ->label('Display order')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->maxValue(100),
                        Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        Textarea::make('details')
                            ->rows(3)
                            ->columnSpanFull(),
                        Toggle::make('is_enabled')
                            ->label('Show in the consent banner')
                            ->disabled(fn (?CookieCategory $record): bool => $record?->isNecessary() ?? false)
                            ->dehydrated(),
                        Toggle::make('is_mandatory')
                            ->label('Mandatory')
                            ->helperText('Necessary cookies are always mandatory. Optional categories stay optional.')
                            ->disabled()
                            ->dehydrated(),
                    ])
                    ->columns(2),
            ]);
    }
}
