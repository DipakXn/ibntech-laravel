<?php

namespace App\Filament\Clusters\CookieManagement\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;

class CookieConsentSettingsSchema
{
    /**
     * @return array<int, Section>
     */
    public static function components(): array
    {
        return [
            Section::make('Banner')
                ->schema([
                    Toggle::make('banner_enabled')
                        ->label('Show the cookie banner')
                        ->helperText('Visitors can still reopen settings from Manage Cookies when the banner is hidden.'),
                    TextInput::make('banner_position')
                        ->label('Position')
                        ->default('bottom')
                        ->disabled()
                        ->dehydrated()
                        ->helperText('The banner is fixed to the bottom so it does not shift the page.'),
                    TextInput::make('consent_lifetime_days')
                        ->label('Consent lifetime (days)')
                        ->numeric()
                        ->required()
                        ->minValue(1)
                        ->maxValue(730),
                    TextInput::make('policy_version')
                        ->label('Consent policy version')
                        ->required()
                        ->maxLength(40)
                        ->helperText('Changing this asks every visitor to choose again.'),
                    TextInput::make('privacy_policy_url')
                        ->label('Privacy policy URL')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('cookie_policy_url')
                        ->label('Cookie policy URL')
                        ->required()
                        ->maxLength(255),
                ])
                ->columns(2),
            Section::make('Wording')
                ->schema([
                    TextInput::make('banner_title')
                        ->required()
                        ->maxLength(160),
                    TextInput::make('accept_label')
                        ->required()
                        ->maxLength(80),
                    TextInput::make('reject_label')
                        ->required()
                        ->maxLength(80),
                    TextInput::make('settings_label')
                        ->required()
                        ->maxLength(80),
                    TextInput::make('save_label')
                        ->required()
                        ->maxLength(80),
                    TextInput::make('modal_title')
                        ->required()
                        ->maxLength(160),
                    Textarea::make('banner_text')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull(),
                    Textarea::make('modal_text')
                        ->required()
                        ->rows(3)
                        ->columnSpanFull(),
                ])
                ->columns(2),
            Section::make('Jurisdiction')
                ->description('The public site asks every visitor for opt-in consent. Saved rules are kept for a future release and are not applied, so an unknown location cannot skip consent.')
                ->schema([
                    TextInput::make('jurisdiction_mode')
                        ->label('Public mode')
                        ->default('opt_in')
                        ->disabled()
                        ->dehydrated(),
                    Repeater::make('jurisdiction_rules')
                        ->label('Saved rules')
                        ->schema([
                            TextInput::make('countries')
                                ->label('Country codes')
                                ->helperText('ISO codes separated by commas, for example DE, FR, GB.')
                                ->maxLength(255),
                            Select::make('mode')
                                ->options([
                                    'opt_in' => 'Opt in',
                                    'notice' => 'Notice',
                                ])
                                ->default('opt_in')
                                ->native(false),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->columnSpanFull(),
                ]),
        ];
    }
}
