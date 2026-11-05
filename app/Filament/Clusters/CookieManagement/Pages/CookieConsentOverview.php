<?php

namespace App\Filament\Clusters\CookieManagement\Pages;

use App\Filament\Clusters\CookieManagement\CookieManagementCluster;
use App\Models\CookieConsentMetric;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;

class CookieConsentOverview extends Page
{
    protected static ?string $cluster = CookieManagementCluster::class;

    protected static ?string $title = 'Consent overview';

    protected static ?string $navigationLabel = 'Overview';

    protected static ?string $slug = 'overview';

    protected static ?int $navigationSort = 5;

    protected string $view = 'filament.clusters.cookie-management.pages.overview';

    protected Width|string|null $maxContentWidth = 'full';

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    /**
     * @return array{accept_all: int, reject_all: int, custom: int, withdrawal: int, total: int}
     */
    public function stats(): array
    {
        $metric = CookieConsentMetric::query()->first();
        $accept = (int) ($metric->accept_all_count ?? 0);
        $reject = (int) ($metric->reject_all_count ?? 0);
        $custom = (int) ($metric->custom_count ?? 0);
        $withdrawal = (int) ($metric->withdrawal_count ?? 0);

        return [
            'accept_all' => $accept,
            'reject_all' => $reject,
            'custom' => $custom,
            'withdrawal' => $withdrawal,
            'total' => $accept + $reject + $custom + $withdrawal,
        ];
    }
}
