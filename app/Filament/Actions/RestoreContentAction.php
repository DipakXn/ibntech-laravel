<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;

class RestoreContentAction extends Action
{
    use CanCustomizeProcess;
    public static function getDefaultName(): ?string
    {
        return 'restore';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Restore');

        $this->icon(Heroicon::OutlinedArrowUturnLeft);

        $this->color('success');

        $this->requiresConfirmation();

        $this->modalHeading(fn (): string => 'Restore item');

        $this->modalDescription(fn (): string => 'This item will be restored and appear in the All listing again.');

        $this->modalSubmitActionLabel('Restore');

        $this->successNotificationTitle('Restored');

        $this->failureNotificationTitle('Could not restore item');

        $this->visible(static function (?Model $record): bool {
            if (! $record || ! method_exists($record, 'trashed')) {
                return false;
            }

            return $record->trashed();
        });

        $this->action(function (): void {
            $result = $this->process(static fn (Model $record): ?bool => method_exists($record, 'restore') ? $record->restore() : null);

            if (! $result) {
                $this->failure();

                return;
            }

            $this->success();
        });
    }
}
