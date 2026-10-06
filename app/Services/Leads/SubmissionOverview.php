<?php

namespace App\Services\Leads;

use App\Models\Lead;
use App\Services\Overview\PeriodCounts;
use Illuminate\Support\Carbon;

class SubmissionOverview
{
    /**
     * Count form submissions in one query.
     *
     * Today, this week, and this month use the application timezone.
     * The week follows Carbon's configured week start.
     *
     * @return array{total: int, today: int, this_week: int, this_month: int}
     */
    public function counts(?Carbon $now = null): array
    {
        return app(PeriodCounts::class)->forModel(Lead::class, $now);
    }
}
