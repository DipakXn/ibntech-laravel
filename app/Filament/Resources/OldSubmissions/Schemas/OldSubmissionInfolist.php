<?php

namespace App\Filament\Resources\OldSubmissions\Schemas;

use App\Models\OldSubmission;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OldSubmissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Contact')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')->placeholder('—'),
                        TextEntry::make('email')->placeholder('—'),
                        TextEntry::make('phone')->placeholder('—'),
                        TextEntry::make('company')->placeholder('—'),
                        TextEntry::make('job_title')->label('Job title')->placeholder('—'),
                        TextEntry::make('service')->label('Service')->placeholder('—'),
                        TextEntry::make('city')->placeholder('—'),
                        TextEntry::make('country')->placeholder('—'),
                    ]),
                Section::make('Submission')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('form_name')->label('Form')->badge(),
                        TextEntry::make('submitted_at')->label('Submitted')->dateTime(),
                        TextEntry::make('external_submission_id')->label('Submission ID'),
                        TextEntry::make('source_file')->label('Source file'),
                        TextEntry::make('lead_source')->label('Lead source')->placeholder('—'),
                        TextEntry::make('utm_source')->label('UTM source')->placeholder('—'),
                    ]),
                Section::make('Page')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('page_url')
                            ->label('Page URL')
                            ->placeholder('—')
                            ->columnSpanFull()
                            ->url(fn (?string $state): ?string => filled($state) ? $state : null)
                            ->openUrlInNewTab(),
                        TextEntry::make('page_name')->label('Page name')->placeholder('—'),
                        TextEntry::make('page_id')->label('Page ID')->placeholder('—'),
                    ]),
                Section::make('Request')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('ip_address')->label('IP address')->placeholder('—'),
                        TextEntry::make('external_user_id')->label('User ID')->placeholder('—'),
                        TextEntry::make('user_agent')
                            ->label('User agent')
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ]),
                Section::make('Message')
                    ->schema([
                        TextEntry::make('message')
                            ->hiddenLabel()
                            ->html()
                            ->formatStateUsing(fn (?string $state): string => nl2br(e((string) $state)))
                            ->placeholder('No message was captured.'),
                    ])
                    ->visible(fn (OldSubmission $record): bool => filled($record->message)),
                Section::make('Exported fields')
                    ->schema([
                        TextEntry::make('exported_fields')
                            ->hiddenLabel()
                            ->html()
                            ->state(function (OldSubmission $record): ?string {
                                $html = self::renderExportedFields($record);

                                return $html === '' ? null : $html;
                            })
                            ->placeholder('No additional form fields were exported.'),
                    ]),
            ]);
    }

    public static function renderExportedFields(OldSubmission $record): string
    {
        $pairs = $record->exportedFieldPairs();

        if ($pairs === []) {
            return '';
        }

        $html = '';
        $seen = [];

        foreach ($pairs as $pair) {
            $label = $pair['label'];
            $seen[$label] = ($seen[$label] ?? 0) + 1;

            if ($seen[$label] > 1) {
                $label .= ' ('.$seen[$label].')';
            }

            $html .= '<div style="margin-bottom:0.75rem">';
            $html .= '<div style="font-size:0.75rem;font-weight:600;color:#64748b">'.e($label).'</div>';
            $html .= '<div style="white-space:pre-wrap">'.nl2br(e($pair['value']), false).'</div>';
            $html .= '</div>';
        }

        return $html;
    }
}
