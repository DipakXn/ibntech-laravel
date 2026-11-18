<?php

namespace App\Filament\Concerns;

use App\Services\ContentTemplateScaffold;
use App\Support\ContentTemplates\ContentTemplateKind;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Illuminate\Validation\ValidationException;

trait ScaffoldsContentTemplate
{
    protected ?string $scaffoldNotice = null;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $kind = $this->templateKind();
        $scaffold = app(ContentTemplateScaffold::class);
        $slug = (string) ($data['slug'] ?? '');

        $scaffold->assertSlug($kind, $slug);
        $data['template'] = $slug;

        $this->scaffoldNotice = $scaffold->createMissing($kind, $slug)->notice();

        if (($data['status'] ?? 'draft') === 'published') {
            $this->haltUnlessAssetsExist($scaffold, $kind, $slug);
        }

        return $data;
    }

    protected function getCreatedNotification(): ?Notification
    {
        $notification = parent::getCreatedNotification();

        if ($notification instanceof Notification && filled($this->scaffoldNotice)) {
            $notification->body($this->scaffoldNotice);
        }

        return $notification;
    }

    protected function templateKind(): ContentTemplateKind
    {
        return static::getResource()::templateKind();
    }

    private function haltUnlessAssetsExist(ContentTemplateScaffold $scaffold, ContentTemplateKind $kind, string $template): void
    {
        try {
            $scaffold->assertAssetsExist($kind, $template);
        } catch (ValidationException $exception) {
            Notification::make()
                ->danger()
                ->title('Cannot publish')
                ->body((string) collect($exception->errors())->flatten()->first())
                ->send();

            throw (new Halt)->rollBackDatabaseTransaction();
        }
    }
}
