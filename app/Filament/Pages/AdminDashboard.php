<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AdminQuickActionsWidget;
use App\Filament\Widgets\ContentOverviewWidget;
use App\Filament\Widgets\DashboardContentOverviewWidget;
use App\Filament\Widgets\DashboardSubmissionOverviewWidget;
use App\Filament\Widgets\DashboardVisitorPreviewWidget;
use App\Filament\Widgets\RecentActivityWidget;
use App\Filament\Widgets\RecentLeadsWidget;
use Carbon\CarbonInterface;
use Filament\Pages\Dashboard;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\View\View;

class AdminDashboard extends Dashboard
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?string $title = 'Control center';

    protected static string|\UnitEnum|null $navigationGroup = 'Workspace';

    public function getHeader(): ?View
    {
        $now = now()->timezone((string) config('app.timezone'));
        $name = trim((string) auth()->user()?->name);

        $greeting = $this->greeting($now);

        return view('filament.dashboard.hero', [
            'headline' => $name !== '' ? $greeting.', '.$name.'!' : $greeting.'!',
            'date' => $now->format('l, F j, Y'),
            'dateIso' => $now->toDateString(),
        ]);
    }

    private function greeting(CarbonInterface $now): string
    {
        $hour = (int) $now->format('G');

        if ($hour >= 5 && $hour < 12) {
            return 'Good morning';
        }

        if ($hour >= 12 && $hour < 17) {
            return 'Good afternoon';
        }

        return 'Good evening';
    }

    public function getWidgets(): array
    {
        return [
            DashboardContentOverviewWidget::class,
            DashboardSubmissionOverviewWidget::class,
            DashboardVisitorPreviewWidget::class,
            ContentOverviewWidget::class,
            AdminQuickActionsWidget::class,
            RecentActivityWidget::class,
            RecentLeadsWidget::class,
        ];
    }

    public function getColumns(): int|array
    {
        return [
            'md' => 2,
            'xl' => 2,
        ];
    }
}
