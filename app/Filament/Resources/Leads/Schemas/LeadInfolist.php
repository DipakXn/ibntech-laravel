<?php

namespace App\Filament\Resources\Leads\Schemas;

use App\Models\Lead;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeadInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Contact')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                        TextEntry::make('phone')->placeholder('—'),
                        TextEntry::make('company')->placeholder('—'),
                        TextEntry::make('job_title')
                            ->label('Job Title')
                            ->placeholder('—')
                            ->visible(fn (Lead $record): bool => filled($record->job_title)),
                        TextEntry::make('lead_source_label')
                            ->label('Lead Source')
                            ->placeholder('—')
                            ->visible(fn (Lead $record): bool => filled($record->lead_source)),
                    ]),
                Section::make('Submission')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('form_label')->label('Form')->badge(),
                        TextEntry::make('status')
                            ->formatStateUsing(fn (string $state, Lead $record): string => $record->statusLabel())
                            ->badge()
                            ->color(fn (Lead $record): string => $record->isSpam() ? 'danger' : 'success'),
                        TextEntry::make('created_at')
                            ->label('Submitted')
                            ->dateTime(),
                    ]),
                Section::make('Page')
                    ->schema([
                        TextEntry::make('page_url')
                            ->label('Page URL')
                            ->placeholder('—')
                            ->url(fn (?string $state): ?string => filled($state) ? $state : null)
                            ->openUrlInNewTab()
                            ->columnSpanFull(),
                    ]),
                Section::make('Request')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('ip_address')->label('IP address')->placeholder('—'),
                        TextEntry::make('user_agent')
                            ->label('User agent')
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ]),
                Section::make('Service & asset')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('service')->label('Service / plan')->placeholder('—'),
                        TextEntry::make('package_selected')->label('Selected plan')->placeholder('—')
                            ->visible(fn (Lead $record): bool => filled($record->package_selected)),
                        TextEntry::make('asset_title')->label('Asset')->placeholder('—')
                            ->visible(fn (Lead $record): bool => filled($record->asset_title)),
                    ])
                    ->visible(fn (Lead $record): bool => filled($record->service) || filled($record->package_selected) || filled($record->asset_title)),
                Section::make('Message')
                    ->schema([
                        TextEntry::make('message')
                            ->hiddenLabel()
                            ->html()
                            ->formatStateUsing(fn (?string $state): string => nl2br(e((string) $state)))
                            ->placeholder('No message was captured.'),
                    ])
                    ->visible(fn (Lead $record): bool => filled($record->message)),
                Section::make('Form answers')
                    ->schema([
                        TextEntry::make('form_answers_html')
                            ->hiddenLabel()
                            ->html()
                            ->state(function (Lead $record): ?string {
                                $html = self::renderFormAnswers($record);

                                return $html === '' ? null : $html;
                            })
                            ->placeholder('No additional form answers were stored.'),
                    ]),
            ]);
    }

    public static function renderFormAnswers(Lead $record): string
    {
        $pairs = $record->formAnswerPairs();

        if ($pairs === []) {
            return '';
        }

        $html = '';

        foreach ($pairs as $pair) {
            $html .= '<div style="margin-bottom:0.75rem">';
            $html .= '<div style="font-size:0.75rem;font-weight:600;color:#64748b">'.e($pair['label']).'</div>';
            $html .= '<div style="white-space:pre-wrap">'.nl2br(e($pair['value']), false).'</div>';
            $html .= '</div>';
        }

        return $html;
    }
}