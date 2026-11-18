<?php

namespace App\Filament\Concerns;

use App\Services\ContentTemplateScaffold;
use App\Support\ContentTemplates\ContentTemplateKind;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Illuminate\Validation\ValidationException;

trait GuardsPublishedContentTemplate
{
    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $kind = $this->templateKind();
        $scaffold = app(ContentTemplateScaffold::class);
        $slug = (string) ($data['slug'] ?? '');
        $template = (string) $this->getRecord()->getAttribute('template');

        $scaffold->assertSlug($kind, $slug);
        $data['template'] = $template;

        if (($data['status'] ?? '') === 'published') {
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

        return $data;
    }

    protected function templateKind(): ContentTemplateKind
    {
        return static::getResource()::templateKind();
    }
}
