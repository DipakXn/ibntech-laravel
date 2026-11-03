<?php

namespace App\Filament\Clusters\CookieManagement\Resources\CookieRegistryEntries\Schemas;

use App\Models\CookieCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CookieRegistryEntryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Cookie')
                    ->description('Describe a confirmed cookie. This registry does not run scripts.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Cookie name')
                            ->required()
                            ->maxLength(120),
                        TextInput::make('provider')
                            ->required()
                            ->maxLength(120),
                        Select::make('cookie_category_id')
                            ->label('Category')
                            ->options(fn (): array => CookieCategory::query()->orderBy('sort_order')->pluck('name', 'id')->all())
                            ->required()
                            ->native(false),
                        TextInput::make('duration')
                            ->maxLength(120),
                        TextInput::make('domain')
                            ->maxLength(120),
                        TextInput::make('privacy_policy_url')
                            ->label('Privacy policy URL')
                            ->maxLength(255)
                            ->helperText('A site path such as /privacy-policy/ or an https URL.'),
                        TextInput::make('integration_key')
                            ->label('Integration key')
                            ->maxLength(40)
                            ->helperText('Leave empty to always publish this confirmed cookie. Set ga4, gtm, google_ads, or linkedin to publish it only while that integration is active in this environment.'),
                        TextInput::make('sort_order')
                            ->label('Display order')
                            ->numeric()
                            ->required()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                        Textarea::make('purpose')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
