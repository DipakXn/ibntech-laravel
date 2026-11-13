<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Auth\Login;
use App\Models\User;
use App\Support\Users\PasswordPolicy;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'lg' => 2,
            ])
            ->components([
                Section::make('Account')
                    ->description('Name, email, and role. Authors manage content. Administrators also manage sales, settings, and users.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->autocomplete('name'),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->autocomplete('email')
                            ->helperText('Sign-in address. The login page is /'.Login::ROUTE_PATH.'.'),
                        Select::make('role')
                            ->options([
                                User::ROLE_ADMINISTRATOR => 'Administrator',
                                User::ROLE_AUTHOR => 'Author',
                            ])
                            ->default(User::ROLE_AUTHOR)
                            ->required()
                            ->native(false)
                            ->disabled(fn (?User $record): bool => $record instanceof User && auth()->id() === $record->getKey())
                            ->helperText('You cannot change your own role. Another administrator can. The last active administrator cannot be demoted.'),
                        Toggle::make('is_active')
                            ->label('Active account')
                            ->helperText('Inactive accounts cannot sign in. You cannot deactivate your own account, and the last active administrator stays active.')
                            ->default(true)
                            ->disabled(fn (?User $record): bool => $record instanceof User && auth()->id() === $record->getKey()),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Password')
                    ->description('Leave the password blank when editing to keep the current one.')
                    ->schema([
                        Toggle::make('send_invitation')
                            ->label('Email a password setup link')
                            ->helperText('Saves the account with a random password and emails a link so the person can choose their own. The password is not included in the email.')
                            ->default(false)
                            ->live()
                            ->visible(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(true),
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->rule(Password::default())
                            ->same('password_confirmation')
                            ->required(fn (string $operation, Get $get): bool => $operation === 'create' && ! $get('send_invitation'))
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->maxLength(255)
                            ->live(debounce: 500)
                            ->helperText(PasswordPolicy::HELPER)
                            ->autocomplete('new-password'),
                        TextInput::make('password_confirmation')
                            ->label('Confirm password')
                            ->password()
                            ->revealable()
                            ->dehydrated(false)
                            ->required(fn (Get $get): bool => filled($get('password')))
                            ->visible(fn (Get $get): bool => filled($get('password')))
                            ->autocomplete('new-password'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
