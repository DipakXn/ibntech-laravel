<?php

namespace App\Filament\Clusters\CookieManagement\Pages;

use App\Filament\Clusters\CookieManagement\CookieManagementCluster;
use App\Filament\Clusters\CookieManagement\Schemas\CookieConsentSettingsSchema;
use App\Models\CookieConsentSetting;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;

/**
 * @property-read Schema $form
 */
class CookieConsentSettings extends Page
{
    protected static ?string $cluster = CookieManagementCluster::class;

    protected static ?string $title = 'Consent settings';

    protected static ?string $navigationLabel = 'Consent settings';

    protected static ?string $slug = 'settings';

    protected static ?int $navigationSort = 4;

    protected string $view = 'filament.clusters.cookie-management.pages.settings';

    protected Width|string|null $maxContentWidth = 'full';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    public function mount(): void
    {
        $this->form->fill($this->formData($this->record()));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    ...CookieConsentSettingsSchema::components(),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Save consent settings')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $record = $this->record();
        $record->fill($data);
        $record->save();

        $this->form->fill($this->formData($record->fresh() ?? $record));

        Notification::make()
            ->success()
            ->title('Consent settings saved')
            ->send();
    }

    private function record(): CookieConsentSetting
    {
        return CookieConsentSetting::query()->first() ?? new CookieConsentSetting;
    }

    /**
     * @return array<string, mixed>
     */
    private function formData(CookieConsentSetting $record): array
    {
        $data = $record->attributesToArray();
        $rules = [];

        foreach ((array) ($record->jurisdiction_rules ?? []) as $rule) {
            if (! is_array($rule)) {
                continue;
            }

            $rules[] = [
                'countries' => implode(', ', (array) ($rule['countries'] ?? [])),
                'mode' => $rule['mode'] ?? 'opt_in',
            ];
        }

        $data['jurisdiction_rules'] = $rules;
        $data['jurisdiction_mode'] = 'opt_in';
        $data['banner_position'] = 'bottom';

        return $data;
    }
}
