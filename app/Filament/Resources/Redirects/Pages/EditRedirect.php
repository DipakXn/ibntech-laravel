<?php

namespace App\Filament\Resources\Redirects\Pages;

use App\Filament\Resources\Redirects\Concerns\SavesRedirectionSources;
use App\Filament\Resources\Redirects\RedirectResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditRedirect extends EditRecord
{
    use SavesRedirectionSources;

    protected static string $resource = RedirectResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Update Redirection';
    }

    public function getHeading(): string|Htmlable|null
    {
        return 'Update Redirection';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCancelFormAction()
                ->label('Cancel')
                ->color('danger')
                ->outlined(),
            $this->getSaveFormAction()
                ->label('Update Redirection')
                ->color('primary'),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $this->redirectionFormRecord($data);
    }

    protected function afterSave(): void
    {
        $this->storeAdditionalRedirections();
    }
}
