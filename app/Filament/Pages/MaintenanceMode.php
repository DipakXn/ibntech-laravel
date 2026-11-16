<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Services\MaintenanceMode as MaintenanceModeService;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;

/**
 * @property-read Schema $form
 */
class MaintenanceMode extends Page
{
    protected static ?string $title = 'Maintenance Mode';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedPower;

    protected static string|\UnitEnum|null $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'Maintenance Mode';

    protected static ?string $slug = 'maintenance-mode';

    protected static ?int $navigationSort = 6;

    protected string $view = 'filament.pages.maintenance-mode';

    protected ?string $subheading = 'Take the public website offline while signed-in administrators keep working.';

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
        $this->fillForm();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    Section::make('Public website')
                        ->description('Visitors see a maintenance page. Administrators can still browse the website and this panel.')
                        ->schema([
                            Placeholder::make('maintenance_status')
                                ->label('Current status')
                                ->dehydrated(false)
                                ->content(fn (): string => app(MaintenanceModeService::class)->enabled() ? 'Enabled' : 'Disabled'),
                            Toggle::make('maintenance_enabled')
                                ->label('Maintenance mode')
                                ->helperText('Turn this on to show the maintenance page to public visitors.'),
                        ]),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Save')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $enabled = (bool) ($this->form->getState()['maintenance_enabled'] ?? false);

        if ($enabled && ! app(MaintenanceModeService::class)->enabled()) {
            $this->mountAction('confirmEnable');

            return;
        }

        $this->store($enabled);
    }

    public function confirmEnableAction(): Action
    {
        return Action::make('confirmEnable')
            ->requiresConfirmation()
            ->modalHeading('Enable maintenance mode?')
            ->modalDescription('Public visitors will see the maintenance page until you turn this off. Signed-in administrators can still browse the website and this panel.')
            ->modalSubmitActionLabel('Enable maintenance mode')
            ->action(function (): void {
                $this->store(true);
            });
    }

    private function store(bool $enabled): void
    {
        $actor = auth()->user();

        app(MaintenanceModeService::class)->set(
            $enabled,
            $actor instanceof User ? $actor : null,
        );

        $this->fillForm();

        Notification::make()
            ->success()
            ->title($enabled ? 'Maintenance mode enabled' : 'Maintenance mode disabled')
            ->send();
    }

    private function fillForm(): void
    {
        $this->form->fill([
            'maintenance_enabled' => app(MaintenanceModeService::class)->enabled(),
        ]);
    }
}
