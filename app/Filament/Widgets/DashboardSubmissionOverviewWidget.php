<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Leads\LeadResource;
use App\Services\Leads\SubmissionOverview;
use Filament\Widgets\Widget;

class DashboardSubmissionOverviewWidget extends Widget
{
    protected static bool $isDiscovered = false;

    protected static bool $isLazy = false;

    protected string $view = 'filament.widgets.dashboard-submission-overview';

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return LeadResource::canViewAny();
    }

    /**
     * @return array{
     *     cards: list<array{label: string, value: int, hint: string}>,
     *     forms: list<array{form_name: string, label: string, submissions: int}>,
     *     submissionsUrl: string
     * }
     */
    protected function getViewData(): array
    {
        $overview = app(SubmissionOverview::class);
        $counts = $overview->counts();

        return [
            'cards' => [
                [
                    'label' => 'Total Submissions',
                    'value' => $counts['total'],
                    'hint' => 'All form submissions',
                ],
                [
                    'label' => 'Today',
                    'value' => $counts['today'],
                    'hint' => 'Created today',
                ],
                [
                    'label' => 'This Week',
                    'value' => $counts['this_week'],
                    'hint' => 'Current week',
                ],
                [
                    'label' => 'This Month',
                    'value' => $counts['this_month'],
                    'hint' => 'Current month',
                ],
            ],
            'forms' => $overview->topForms(),
            'submissionsUrl' => LeadResource::getUrl(),
        ];
    }
}
