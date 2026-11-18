<?php

namespace App\Filament\Resources\Leads\Pages;

use App\Filament\Resources\Leads\LeadResource;
use App\Models\Lead;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;

class ViewLead extends ViewRecord
{
    protected static string $resource = LeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('markSpam')
                ->label('Mark as spam')
                ->icon(Heroicon::OutlinedNoSymbol)
                ->color('danger')
                ->visible(fn (Lead $record): bool => ! $record->isSpam())
                ->requiresConfirmation()
                ->action(function (Lead $record): void {
                    $record->update(['status' => Lead::STATUS_SPAM]);

                    Notification::make()
                        ->title('Submission marked as spam')
                        ->success()
                        ->send();

                    $this->refreshFormData(['status']);
                }),
            Action::make('markInbox')
                ->label('Restore to inbox')
                ->icon(Heroicon::OutlinedInbox)
                ->visible(fn (Lead $record): bool => $record->isSpam())
                ->requiresConfirmation()
                ->action(function (Lead $record): void {
                    $record->update(['status' => Lead::STATUS_NEW]);

                    Notification::make()
                        ->title('Submission restored to inbox')
                        ->success()
                        ->send();

                    $this->refreshFormData(['status']);
                }),
            EditAction::make(),
            DeleteAction::make(),
        ];
    }
}