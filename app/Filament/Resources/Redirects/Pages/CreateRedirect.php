<?php

namespace App\Filament\Resources\Redirects\Pages;

use App\Filament\Resources\Redirects\Concerns\SavesRedirectionSources;
use App\Filament\Resources\Redirects\RedirectResource;
use App\Models\ContentRedirect;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateRedirect extends CreateRecord
{
    use SavesRedirectionSources;

    protected static string $resource = RedirectResource::class;

    protected static bool $canCreateAnother = false;

    public function getTitle(): string|Htmlable
    {
        return 'Add Redirection';
    }

    public function getHeading(): string|Htmlable|null
    {
        return 'Add Redirection';
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCancelFormAction()
                ->label('Cancel')
                ->color('danger')
                ->outlined(),
            $this->getCreateFormAction()
                ->label('Add Redirection')
                ->color('primary'),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data = $this->redirectionFormRecord($data);
        $data['origin'] = ContentRedirect::ORIGIN_MANUAL;

        return $data;
    }

    protected function afterCreate(): void
    {
        $this->storeAdditionalRedirections();
    }
}
