<?php

namespace App\Filament\Schemas;

use App\Models\SmtpSetting;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;

class SmtpSettingsSchema
{
    /**
     * @return array<int, Section>
     */
    public static function components(): array
    {
        return [
            Section::make('SMTP Connection')
                ->description('When disabled, Laravel continues to use the existing .env mail configuration.')
                ->columns([
                    'default' => 1,
                    'md' => 2,
                ])
                ->schema([
                    Toggle::make('is_enabled')
                        ->label('Enable SMTP')
                        ->helperText('Use this configuration for outgoing mail. Disable to fall back to the environment mailer.')
                        ->inline(false)
                        ->live()
                        ->columnSpanFull(),
                    TextInput::make('host')
                        ->label('SMTP Host')
                        ->required(fn (Get $get): bool => (bool) $get('is_enabled'))
                        ->maxLength(255)
                        ->rule('string'),
                    TextInput::make('port')
                        ->label('SMTP Port')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(65535)
                        ->required(fn (Get $get): bool => (bool) $get('is_enabled')),
                    Select::make('encryption')
                        ->label('Encryption')
                        ->options(SmtpSetting::encryptionOptions())
                        ->required()
                        ->native(false)
                        ->helperText('None disables STARTTLS. TLS upgrades after connect. SSL uses implicit TLS.'),
                    Select::make('auth_mode')
                        ->label('Authentication')
                        ->options(SmtpSetting::authModeOptions())
                        ->required()
                        ->live()
                        ->native(false)
                        ->helperText('Auto uses server-advertised mechanisms. Explicit modes set one authenticator.'),
                    TextInput::make('username')
                        ->label('Username')
                        ->maxLength(255)
                        ->autocomplete(false)
                        ->required(fn (Get $get): bool => (bool) $get('is_enabled') && $get('auth_mode') !== SmtpSetting::AUTH_NONE),
                    TextInput::make('password')
                        ->label('Password')
                        ->password()
                        ->revealable()
                        ->autocomplete(false)
                        ->required(fn (Get $get): bool => (bool) $get('is_enabled') && $get('auth_mode') !== SmtpSetting::AUTH_NONE)
                        ->helperText('Stored encrypted. These credentials stay filled after saving so you can confirm them.'),
                    Toggle::make('has_password')
                        ->hidden()
                        ->dehydrated(false),
                ]),
            Section::make('Message Defaults')
                ->columns([
                    'default' => 1,
                    'md' => 2,
                ])
                ->schema([
                    TextInput::make('from_email')
                        ->label('From Email')
                        ->email()
                        ->maxLength(255)
                        ->required(fn (Get $get): bool => (bool) $get('is_enabled')),
                    TextInput::make('from_name')
                        ->label('From Name')
                        ->maxLength(255)
                        ->required(fn (Get $get): bool => (bool) $get('is_enabled')),
                    TextInput::make('lead_notification_to')
                        ->label('Lead Notification To (legacy fallback)')
                        ->email()
                        ->maxLength(255)
                        ->helperText('Not the primary form recipient. Used only when Website Settings has no default and no form override. Prefer Website Settings → Form notifications.')
                        ->columnSpanFull(),
                ]),
        ];
    }
}
