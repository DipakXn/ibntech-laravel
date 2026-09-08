<?php

namespace App\Filament\Clusters\SmtpSettings\Pages;

use App\Filament\Clusters\SmtpSettings\Concerns\HasSmtpSettingsPageHeading;
use App\Filament\Clusters\SmtpSettings\SmtpSettingsCluster;
use App\Filament\Schemas\SmtpSettingsSchema;
use App\Models\SmtpSetting;
use App\Services\SmtpSettingService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\Width;

/**
 * @property-read Schema $form
 */
class SmtpConfiguration extends Page
{
    use HasSmtpSettingsPageHeading;

    protected static ?string $cluster = SmtpSettingsCluster::class;

    protected static ?string $title = 'SMTP Settings';

    protected static string|\BackedEnum|null $navigationIcon = null;

    protected static ?string $navigationLabel = 'Configuration';

    protected static ?string $slug = 'configuration';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.clusters.smtp-settings.pages.smtp-configuration';

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
        $this->form->fill($this->formDataFromRecord($this->getRecord()));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    ...SmtpSettingsSchema::components(),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Save SMTP Settings')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ])->alignment(Alignment::Center),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        unset($data['has_password']);

        $record = $this->getRecord() ?? new SmtpSetting;

        if (! array_key_exists('password', $data) || ! filled($data['password'] ?? null)) {
            unset($data['password']);
        }

        $record->fill($data);
        $record->save();

        $service = app(SmtpSettingService::class);
        $service->applyToRuntimeConfig();

        $this->form->fill($this->formDataFromRecord($record->fresh()));

        Notification::make()
            ->success()
            ->title('SMTP settings saved')
            ->body($record->is_enabled
                ? 'Outgoing mail will use the saved SMTP configuration.'
                : 'SMTP settings are disabled. Laravel will use the environment mail fallback.')
            ->send();
    }

    public function getRecord(): ?SmtpSetting
    {
        return SmtpSetting::query()->first();
    }

    /**
     * @return array<string, mixed>
     */
    private function formDataFromRecord(?SmtpSetting $record): array
    {
        $defaults = app(SmtpSettingService::class)->defaultAttributes();

        if (! $record) {
            return [
                ...$defaults,
                'password' => null,
                'has_password' => false,
            ];
        }

        return [
            ...$defaults,
            'is_enabled' => $record->is_enabled,
            'host' => $record->host,
            'port' => $record->port,
            'encryption' => $record->encryption,
            'auth_mode' => $record->auth_mode,
            'username' => $record->username,
            'password' => $record->password,
            'from_email' => $record->from_email,
            'from_name' => $record->from_name,
            'lead_notification_to' => $record->lead_notification_to,
            'has_password' => $record->hasPassword(),
        ];
    }
}
