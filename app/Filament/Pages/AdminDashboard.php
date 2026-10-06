<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AdminQuickActionsWidget;
use App\Filament\Widgets\ContentOverviewWidget;
use App\Filament\Widgets\DashboardContentOverviewWidget;
use App\Filament\Widgets\DashboardSubmissionOverviewWidget;
use App\Filament\Widgets\DashboardVisitorPreviewWidget;
use App\Filament\Widgets\RecentActivityWidget;
use App\Filament\Widgets\RecentLeadsWidget;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Lead;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\WhitePaper;
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
        $published = Blog::published()->count()
            + CaseStudy::published()->count()
            + Ebook::published()->count()
            + PressRelease::published()->count()
            + WhitePaper::published()->count()
            + Page::published()->count();

        $drafts = Blog::query()->where('status', 'draft')->count()
            + CaseStudy::query()->where('status', 'draft')->count()
            + Ebook::query()->where('status', 'draft')->count()
            + PressRelease::query()->where('status', 'draft')->count()
            + WhitePaper::query()->where('status', 'draft')->count()
            + Page::query()->where('status', 'draft')->count();

        return view('filament.dashboard.hero', [
            'published' => $published,
            'drafts' => $drafts,
            'leadCount' => Lead::query()->count(),
        ]);
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
