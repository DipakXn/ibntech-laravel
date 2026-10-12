<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;

class ForceDeleteContentAction extends Action
{
    use CanCustomizeProcess;
    public static function getDefaultName(): ?string
    {
        return 'forceDelete';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Delete Permanently');

        $this->icon(Heroicon::OutlinedTrash);

        $this->color('danger');

        $this->requiresConfirmation();

        $this->modalHeading(fn (): string => 'Delete permanently');

        $this->modalDescription(fn (): string => 'This action cannot be undone. The item and its related cleanup rules will be applied permanently.');

        $this->modalSubmitActionLabel('Delete permanently');

        $this->successNotificationTitle('Deleted permanently');

        $this->failureNotificationTitle('Could not delete permanently');

        $this->modalIcon(Heroicon::OutlinedTrash);

        $this->visible(static function (?Model $record): bool {
            if (! $record || ! method_exists($record, 'trashed')) {
                return false;
            }

            return $record->trashed();
        });

        $this->action(function (): void {
            $result = $this->process(static fn (Model $record): ?bool => method_exists($record, 'forceDelete') ? $record->forceDelete() : null);

            if (! $result) {
                $this->failure();

                return;
            }

            $this->success();
        });
    }
}
