<?php

namespace App\Filament\Actions;

use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;

class MoveToTrashAction extends DeleteAction
{
    public static function getDefaultName(): ?string
    {
        return 'trash';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Move to Trash');

        $this->modalHeading(fn (): string => 'Move to Trash');

        $this->modalDescription(fn (): string => 'The item will be moved to trash. You can restore it later from the Trash tab.');

        $this->modalSubmitActionLabel('Move to Trash');

        $this->successNotificationTitle('Moved to trash');

        $this->failureNotificationTitle('Could not move to trash');

        $this->icon(Heroicon::OutlinedTrash);

        $this->tableIcon(Heroicon::OutlinedTrash);

        $this->groupedIcon(Heroicon::OutlinedTrash);

        $this->modalIcon(Heroicon::OutlinedTrash);
    }
}
