<?php

namespace App\Filament\Pages;

use App\Support\Queue\DatabaseQueueMonitor;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class QueueMonitor extends Page
{
    protected static ?string $title = 'Queue monitor';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedServerStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'Queue monitor';

    protected static ?int $navigationSort = 10;

    protected string $view = 'filament.pages.queue-monitor';

    protected ?string $subheading = 'Track database queue backlog, failed jobs, and the active monitoring threshold.';

    protected Width|string|null $maxContentWidth = 'full';

    public string $lastUpdatedAt = '';

    public ?string $expandedFailedJobUuid = null;

    public function mount(): void
    {
        $this->markUpdated();
    }

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
            Action::make('refresh')
                ->label('Refresh')
                ->icon(Heroicon::OutlinedArrowPath)
                ->color('gray')
                ->action(function (): void {
                    $this->expandedFailedJobUuid = null;
                    $this->markUpdated();
                }),
        ];
    }

    public function retryFailedJobAction(): Action
    {
        return Action::make('retryFailedJob')
            ->label('Retry')
            ->icon(Heroicon::OutlinedArrowUturnLeft)
            ->color('warning')
            ->requiresConfirmation()
            ->modalHeading('Retry failed job?')
            ->modalDescription('This job will be pushed back onto its original queue. Laravel then removes that single failed-job record. Other jobs, sessions, cache, and CMS data are not changed.')
            ->modalSubmitActionLabel('Retry job')
            ->action(function (array $arguments): void {
                $uuid = isset($arguments['uuid']) && is_string($arguments['uuid'])
                    ? $arguments['uuid']
                    : '';

                try {
                    $this->monitor()->retryFailedJob($uuid);

                    if ($this->expandedFailedJobUuid === $uuid) {
                        $this->expandedFailedJobUuid = null;
                    }

                    $this->markUpdated();

                    Notification::make()
                        ->success()
                        ->title('Failed job re-queued')
                        ->body('The job was pushed back onto its original queue.')
                        ->send();
                } catch (Throwable $exception) {
                    Log::error('Failed to retry a queue job from the Queue Monitor.', [
                        'uuid' => $uuid,
                        'exception' => $exception,
                    ]);

                    Notification::make()
                        ->danger()
                        ->title('Could not retry job')
                        ->body('The failed job could not be retried. Please try again or check the application logs.')
                        ->send();
                }
            });
    }

    public function toggleFailedJobException(string $uuid): void
    {
        $uuid = trim($uuid);

        if ($this->expandedFailedJobUuid === $uuid) {
            $this->expandedFailedJobUuid = null;

            return;
        }

        if (! $this->monitor()->hasFailedJob($uuid)) {
            return;
        }

        $this->expandedFailedJobUuid = $uuid;
    }

    protected function getViewData(): array
    {
        $snapshot = $this->monitor()->snapshot();

        $expandedException = $this->expandedFailedJobUuid
            ? $this->monitor()->failedJobException($this->expandedFailedJobUuid)
            : null;

        return [
            ...$snapshot,
            'expandedException' => $expandedException,
            'lastUpdatedLabel' => $this->lastUpdatedAt !== ''
                ? Carbon::parse($this->lastUpdatedAt)
                    ->timezone((string) config('app.timezone'))
                    ->format('M j, Y g:i:s A')
                : null,
        ];
    }

    protected function markUpdated(): void
    {
        $this->lastUpdatedAt = now()->toIso8601String();
    }

    protected function monitor(): DatabaseQueueMonitor
    {
        return app(DatabaseQueueMonitor::class);
    }
}
