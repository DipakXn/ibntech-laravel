<?php

namespace App\Filament\Clusters\CookieManagement\Resources\CookieIntegrations\Schemas;

use App\Models\CookieIntegration;
use App\Services\WebsiteSettingService;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CookieIntegrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Integration')
                    ->description('Predefined services only. Measurement IDs are not written into other environments unless that environment is explicitly enabled.')
                    ->schema([
                        Placeholder::make('key_label')
                            ->label('Key')
                            ->content(fn (?CookieIntegration $record): string => (string) $record?->key),
                        TextInput::make('name')
                            ->required()
                            ->maxLength(120),
                        Toggle::make('is_enabled')
                            ->label('Enabled')
                            ->helperText('An enabled integration still runs only in the environments selected below, and only after the matching consent.'),
                        CheckboxList::make('environments')
                            ->options([
                                'local' => 'Local',
                                'staging' => 'Staging',
                                'production' => 'Production',
                            ])
                            ->columns(3)
                            ->helperText('Production IDs stay in this database. Leave staging and local unchecked unless this environment should send its own tracking.'),
                        Select::make('category_key')
                            ->label('Consent category')
                            ->options([
                                'analytics' => 'Analytics',
                                'marketing' => 'Marketing',
                                'functional' => 'Functional',
                            ])
                            ->native(false)
                            ->visible(fn (?CookieIntegration $record): bool => ! in_array($record?->key, ['gtm', 'recaptcha'], true))
                            ->required(fn (?CookieIntegration $record): bool => ! in_array($record?->key, ['gtm', 'recaptcha'], true)),
                        CheckboxList::make('consent_categories')
                            ->label('GTM consent categories')
                            ->options([
                                'analytics' => 'Analytics',
                                'marketing' => 'Marketing',
                                'functional' => 'Functional',
                            ])
                            ->visible(fn (?CookieIntegration $record): bool => $record?->key === 'gtm')
                            ->helperText('The container loads only after one of these categories is allowed. Google Consent Mode is set first. Analytics consent does not grant advertising storage.'),
                        Placeholder::make('recaptcha_category')
                            ->label('Consent category')
                            ->content('Necessary')
                            ->visible(fn (?CookieIntegration $record): bool => $record?->key === 'recaptcha'),
                        Placeholder::make('website_measurement_id')
                            ->label('Measurement ID')
                            ->content(function (?CookieIntegration $record): string {
                                $settings = app(WebsiteSettingService::class)->get();
                                $id = $record?->key === 'ga4'
                                    ? $settings->google_analytics_id
                                    : $settings->google_tag_manager_id;

                                return filled($id)
                                    ? (string) $id
                                    : 'Not set. Add it in Website Settings for this environment.';
                            })
                            ->visible(fn (?CookieIntegration $record): bool => in_array($record?->key, ['ga4', 'gtm'], true)),
                        TextInput::make('measurement_id')
                            ->label('Measurement ID')
                            ->maxLength(40)
                            ->visible(fn (?CookieIntegration $record): bool => in_array($record?->key, ['google_ads', 'linkedin'], true))
                            ->helperText('Stored for this environment only. Do not paste a production ID into staging.'),
                        Textarea::make('description')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
