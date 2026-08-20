<?php

namespace App\Filament\Resources\Leads\Schemas;

use App\Models\Lead;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'lg' => 2,
            ])
            ->components([
                Section::make('Submission details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->maxLength(50),
                        TextInput::make('company')
                            ->maxLength(255),
                        Placeholder::make('service_display')
                            ->label('Service / Plan')
                            ->content(fn (?Lead $record): string => $record?->service ?: '—'),
                        Placeholder::make('job_title_display')
                            ->label('Job Title')
                            ->content(fn (?Lead $record): string => $record?->job_title ?: '—'),
                        Placeholder::make('asset_title_display')
                            ->label('Asset')
                            ->content(fn (?Lead $record): string => $record?->asset_title ?: '—'),
                        Select::make('form_name')
                            ->label('Form')
                            ->options(Lead::formOptions())
                            ->required(),
                        Textarea::make('message')
                            ->rows(4)
                            ->columnSpanFull(),
                        TextInput::make('page_url')
                            ->label('Page URL')
                            ->url()
                            ->columnSpanFull(),
                        TextInput::make('ip_address')
                            ->label('IP Address')
                            ->maxLength(45),
                        Textarea::make('user_agent')
                            ->label('User Agent')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
