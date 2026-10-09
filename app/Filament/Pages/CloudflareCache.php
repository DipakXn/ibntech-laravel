<?php

namespace App\Filament\Pages;

use App\Models\CloudflareSetting;
use App\Models\User;
use App\Services\CloudflareCacheService;
use App\Services\CloudflarePurgeResult;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;

/**
 * @property-read Schema $form
 */
class CloudflareCache extends Page
{
    protected static ?string $title = 'Cloudflare Cache';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedCloud;

    protected static string|\UnitEnum|null $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'Cloudflare Cache';

    protected static ?string $slug = 'cloudflare-cache';

    protected static ?int $navigationSort = 7;

    protected string $view = 'filament.pages.cloudflare-cache';

    protected ?string $subheading = 'Save Cloudflare credentials and purge the configured zone cache.';

    protected Width|string|null $maxContentWidth = 'full';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    /**
     * @var list<string>
     */
    public array $pendingPurgeUrls = [];

    public static function canAccess(): bool
    {
        $user = auth()->user();

        return $user instanceof User && $user->isAdministrator();
    }

    public function mount(): void
    {
        $this->form->fill($this->formData());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    Section::make('Cloudflare Configuration')
                        ->description('The API token is encrypted in the database and shown here so administrators can review and update it.')
                        ->columns([
                            'default' => 1,
                            'md' => 2,
                        ])
                        ->schema([
                            TextInput::make('api_token')
                                ->label('API Token')
                                ->required()
                                ->maxLength(4096)
                                ->autocomplete(false)
                                ->rules(['required', 'string', 'max:4096', 'regex:/^\S+$/'])
                                ->validationMessages([
                                    'regex' => 'The API token cannot contain spaces.',
                                ])
                                ->helperText('Stored encrypted. Visible on this administrator page only.'),
                            TextInput::make('zone_id')
                                ->label('Zone ID')
                                ->required()
                                ->minLength(32)
                                ->maxLength(32)
                                ->rules(['required', 'regex:/^[a-fA-F0-9]{32}$/'])
                                ->validationMessages([
                                    'regex' => 'Enter the 32-character Cloudflare Zone ID.',
                                ])
                                ->helperText('32-character hexadecimal Zone ID from the Cloudflare dashboard.'),
                        ]),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Save Settings')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
                Section::make('Cache Management')
                    ->description('Purge the entire zone or a list of URLs. A confirmation is required before Cloudflare is contacted.')
                    ->schema([
                        Placeholder::make('last_successful_purge')
                            ->label('Last successful purge')
                            ->content(fn (): string => $this->lastSuccessfulPurgeLabel())
                            ->dehydrated(false),
                        Actions::make([
                            $this->purgeEverythingAction(),
                            $this->customPurgeAction(),
                        ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $token = trim((string) ($data['api_token'] ?? ''));
        $zoneId = strtolower(trim((string) ($data['zone_id'] ?? '')));

        $record = $this->record() ?? new CloudflareSetting;
        $record->api_token = $token;
        $record->zone_id = $zoneId;
        $record->save();

        $this->form->fill($this->formData());

        Notification::make()
            ->success()
            ->title('Cloudflare settings saved')
            ->send();
    }

    public function purgeEverythingAction(): Action
    {
        return Action::make('purgeEverything')
            ->label('Purge Everything')
            ->button()
            ->icon(Heroicon::OutlinedTrash)
            ->color('danger')
            ->requiresConfirmation()
            ->modalHeading('Purge the entire Cloudflare cache?')
            ->modalDescription('This removes every cached file for the configured zone.')
            ->modalSubmitActionLabel('Purge Everything')
            ->action(function (): void {
                $result = app(CloudflareCacheService::class)->purgeEverything($this->actor());
                $this->notify($result);
            });
    }

    public function customPurgeAction(): Action
    {
        return Action::make('customPurge')
            ->label('Custom Purge')
            ->button()
            ->icon(Heroicon::OutlinedLink)
            ->modalHeading('Custom cache purge')
            ->modalDescription('Add one or more absolute URLs. Each URL is validated before the purge is confirmed.')
            ->modalSubmitActionLabel('Continue')
            ->schema([
                Repeater::make('urls')
                    ->label('URLs')
                    ->schema([
                        TextInput::make('url')
                            ->label('URL')
                            ->placeholder(rtrim((string) config('app.url'), '/').'/')
                            ->required()
                            ->maxLength(2048)
                            ->rules(['required', 'string', 'max:2048', 'url:http,https'])
                            ->validationMessages([
                                'url' => 'Enter an absolute http or https URL.',
                            ]),
                    ])
                    ->minItems(1)
                    ->maxItems(CloudflareCacheService::MAX_URLS)
                    ->defaultItems(1)
                    ->addActionLabel('Add URL')
                    ->deletable()
                    ->reorderable(false)
                    ->columnSpanFull(),
            ])
            ->action(function (array $data): void {
                $urls = $this->urlsFromActionData($data);

                if ($urls === []) {
                    Notification::make()
                        ->danger()
                        ->title('Custom purge failed')
                        ->body('Add at least one valid URL before purging.')
                        ->send();

                    return;
                }

                $this->pendingPurgeUrls = $urls;
                $this->replaceMountedAction('confirmCustomPurge');
            });
    }

    public function confirmCustomPurgeAction(): Action
    {
        return Action::make('confirmCustomPurge')
            ->label('Purge URLs')
            ->color('danger')
            ->requiresConfirmation()
            ->modalHeading('Purge these URLs?')
            ->modalDescription(fn (): Htmlable => $this->customPurgeConfirmation())
            ->modalSubmitActionLabel('Purge URLs')
            ->modalWidth(Width::TwoExtraLarge)
            ->action(function (): void {
                $urls = $this->pendingPurgeUrls;
                $this->pendingPurgeUrls = [];

                $result = app(CloudflareCacheService::class)->purgeUrls($urls, $this->actor());
                $this->notify($result);
            });
    }

    public function lastSuccessfulPurgeLabel(): string
    {
        $settings = $this->record();

        if (! $settings?->last_purged_at) {
            return 'No successful purge has been recorded yet.';
        }

        $type = match ($settings->last_purge_type) {
            CloudflareCacheService::CUSTOM_PURGE => 'Custom Purge',
            CloudflareCacheService::PURGE_EVERYTHING => 'Purge Everything',
            default => 'Purge',
        };

        if ($settings->last_purge_type === CloudflareCacheService::CUSTOM_PURGE && $settings->last_purge_url_count) {
            $type .= ' ('.$settings->last_purge_url_count.' URLs)';
        }

        return $type.' · '.$settings->last_purged_at->timezone(config('app.timezone'))->format('M j, Y g:i A');
    }

    /**
     * @return array{api_token: ?string, zone_id: ?string}
     */
    private function formData(): array
    {
        $record = $this->record();

        if (! $record) {
            return [
                'api_token' => null,
                'zone_id' => null,
            ];
        }

        return [
            'api_token' => $this->readableToken($record),
            'zone_id' => $record->zone_id,
        ];
    }

    private function readableToken(CloudflareSetting $record): ?string
    {
        try {
            $token = $record->api_token;
        } catch (DecryptException) {
            Log::warning('Cloudflare API token could not be decrypted.', [
                'user_id' => auth()->id(),
            ]);

            return null;
        }

        return is_string($token) && $token !== '' ? $token : null;
    }

    private function record(): ?CloudflareSetting
    {
        return CloudflareSetting::query()->orderBy('id')->first();
    }

    private function actor(): ?User
    {
        $user = auth()->user();

        return $user instanceof User ? $user : null;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return list<string>
     */
    private function urlsFromActionData(array $data): array
    {
        $rows = $data['urls'] ?? [];

        if (! is_array($rows)) {
            return [];
        }

        $urls = [];

        foreach ($rows as $row) {
            $url = is_array($row) ? ($row['url'] ?? null) : null;

            if (is_string($url) && trim($url) !== '') {
                $urls[] = trim($url);
            }
        }

        return array_values($urls);
    }

    private function customPurgeConfirmation(): HtmlString
    {
        $count = count($this->pendingPurgeUrls);
        $items = '';

        foreach ($this->pendingPurgeUrls as $url) {
            $items .= '<li>'.e($url).'</li>';
        }

        $label = $count === 1 ? 'URL' : 'URLs';

        return new HtmlString(
            '<p>Cloudflare will purge '.$count.' '.$label.'.</p>'
            .($items !== '' ? '<ul>'.$items.'</ul>' : '')
        );
    }

    private function notify(CloudflarePurgeResult $result): void
    {
        $message = $result->message;
        $token = $this->data['api_token'] ?? null;

        if (is_string($token) && $token !== '' && str_contains($message, $token)) {
            $message = 'Cloudflare could not purge the cache.';
        }

        $notification = Notification::make()->title(
            $result->successful ? 'Cloudflare cache purged' : 'Cloudflare cache purge failed'
        )->body($message);

        if ($result->successful) {
            $notification->success();
        } else {
            $notification->danger();
        }

        $notification->send();
    }
}
