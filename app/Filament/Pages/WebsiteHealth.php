<?php

namespace App\Filament\Pages;

use App\Models\HealthCheckRun;
use App\Support\Health\WebsiteHealthRecorder;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Log;
use Throwable;

class WebsiteHealth extends Page
{
    protected static ?string $title = 'Website health';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedHeart;

    protected static string|\UnitEnum|null $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'Website health';

    protected static ?string $slug = 'website-health';

    protected static ?int $navigationSort = 9;

    protected string $view = 'filament.pages.website-health';

    protected ?string $subheading = 'Read-only status for the public site, database, storage, scheduler, queue, and certificate. Nothing here changes the server.';

    protected Width|string|null $maxContentWidth = 'full';

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('runCheck')
                ->label('Run check')
                ->icon(Heroicon::OutlinedArrowPath)
                ->color('gray')
                ->extraAttributes([
                    'wire:loading.attr' => 'disabled',
                    'wire:target' => 'mountAction',
                ])
                ->action(function (): void {
                    $this->runCheck();
                }),
        ];
    }

    public function runCheck(): void
    {
        abort_unless(static::canAccess(), 403);

        $lastRunAt = (int) session('website_health.last_manual_check', 0);

        if ($lastRunAt > 0 && (time() - $lastRunAt) < 30) {
            Notification::make()
                ->warning()
                ->title('Please wait before running another check')
                ->body('A health check was recorded less than 30 seconds ago.')
                ->send();

            return;
        }

        try {
            $run = app(WebsiteHealthRecorder::class)->record('manual');
        } catch (Throwable $exception) {
            Log::error('Website health snapshot could not be saved.', [
                'exception' => $exception::class,
            ]);

            Notification::make()
                ->danger()
                ->title('Health check could not be saved')
                ->body('The checks were attempted, but the snapshot was not recorded.')
                ->send();

            return;
        }

        if (! $run instanceof HealthCheckRun) {
            Notification::make()
                ->warning()
                ->title('A health check is already running')
                ->send();

            return;
        }

        session(['website_health.last_manual_check' => time()]);

        Notification::make()
            ->success()
            ->title('Health check completed')
            ->send();
    }

    protected function getViewData(): array
    {
        $latest = HealthCheckRun::query()->orderByDesc('checked_at')->orderByDesc('id')->first();
        $history = HealthCheckRun::query()->orderByDesc('checked_at')->orderByDesc('id')->limit(20)->get();

        return [
            'latest' => $latest,
            'history' => $history,
            'stale' => $latest !== null && $latest->checked_at !== null && $latest->checked_at->lt(now()->subMinutes(15)),
            'checkedAtLabel' => $latest?->checked_at
                ?->timezone((string) config('app.timezone'))
                ->format('M j, Y g:i:s A'),
            'links' => [
                'queue' => QueueMonitor::getUrl(),
                'recent_errors' => LogViewer::getUrl(),
                'environment' => MaintenanceMode::getUrl(),
            ],
            'linkLabels' => [
                'queue' => 'Queue monitor',
                'recent_errors' => 'Application logs',
                'environment' => 'Maintenance Mode',
            ],
        ];
    }

    public static function statusLabel(string $status): string
    {
        return match ($status) {
            'healthy' => 'Healthy',
            'warning' => 'Warning',
            'critical' => 'Critical',
            'not_applicable' => 'Not applicable',
            default => 'Unknown',
        };
    }

    /**
     * @param  array<int, array<string, mixed>>  $checks
     */
    public static function attentionSummary(array $checks): string
    {
        $names = [];

        foreach ($checks as $check) {
            $status = (string) ($check['status'] ?? '');

            if (in_array($status, ['warning', 'critical'], true)) {
                $names[] = (string) ($check['label'] ?? 'Check');
            }
        }

        return $names === [] ? 'None' : implode(', ', $names);
    }
}
