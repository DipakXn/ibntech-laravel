<?php

namespace App\Services\Leads;

use App\Models\LandingPage;
use App\Models\Lead;
use App\Services\Overview\PeriodCounts;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class SubmissionOverview
{
    public const TREND_DAYS = 30;

    public const TOP_FORMS_LIMIT = 5;

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

    /**
     * Daily submission counts for the rolling window ending today.
     *
     * Days use the application timezone. Missing days are returned as zero.
     *
     * @return array{labels: list<string>, counts: list<int>, has_data: bool}
     */
    public function dailyTrend(?Carbon $now = null, int $days = self::TREND_DAYS): array
    {
        $now = $this->moment($now);
        $days = max(1, $days);
        $start = $now->copy()->startOfDay()->subDays($days - 1);
        $end = $now->copy()->endOfDay();

        $rows = Lead::query()
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw('date(created_at) as day, COUNT(*) as total')
            ->groupByRaw('date(created_at)')
            ->get()
            ->keyBy(fn (Lead $row): string => (string) $row->getAttribute('day'));

        $labels = [];
        $counts = [];
        $hasData = false;
        $cursor = $start->copy();

        while ($cursor->lessThanOrEqualTo($end)) {
            $total = (int) ($rows->get($cursor->toDateString())?->getAttribute('total') ?? 0);
            $hasData = $hasData || $total > 0;
            $labels[] = $cursor->format('M j');
            $counts[] = $total;
            $cursor->addDay();
        }

        return [
            'labels' => $labels,
            'counts' => $counts,
            'has_data' => $hasData,
        ];
    }

    /**
     * Highest-volume forms, aggregated from form_submissions.
     *
     * @return list<array{form_name: string, label: string, submissions: int}>
     */
    public function topForms(int $limit = self::TOP_FORMS_LIMIT): array
    {
        $limit = max(1, $limit);

        $rows = Lead::query()
            ->selectRaw('form_name, COUNT(*) as submissions')
            ->groupBy('form_name')
            ->orderByDesc('submissions')
            ->orderBy('form_name')
            ->limit($limit)
            ->get();

        $slugs = [];

        foreach ($rows as $row) {
            $formName = (string) ($row->form_name ?? '');

            if (str_starts_with($formName, 'lp-')) {
                $slugs[] = substr($formName, 3);
            }
        }

        $landingTitles = $slugs === []
            ? collect()
            : LandingPage::query()->whereIn('slug', array_values(array_unique($slugs)))->pluck('title', 'slug');

        $forms = [];

        foreach ($rows as $row) {
            $formName = (string) ($row->form_name ?? '');

            $forms[] = [
                'form_name' => $formName,
                'label' => $this->formLabel($formName, $landingTitles),
                'submissions' => (int) $row->getAttribute('submissions'),
            ];
        }

        return $forms;
    }

    private function moment(?Carbon $now): Carbon
    {
        return ($now ?? now())->copy()->timezone((string) config('app.timezone'));
    }

    /**
     * @param  Collection<string, string>  $landingTitles
     */
    private function formLabel(string $formName, Collection $landingTitles): string
    {
        if ($formName === '') {
            return 'Unknown';
        }

        if (isset(Lead::FORM_OPTIONS[$formName])) {
            return Lead::FORM_OPTIONS[$formName];
        }

        if (str_starts_with($formName, 'lp-')) {
            $title = $landingTitles->get(substr($formName, 3));

            if (is_string($title) && $title !== '') {
                return $title;
            }

            return str(substr($formName, 3))->replace('-', ' ')->title()->toString();
        }

        return str($formName)->replace('_', ' ')->title()->toString();
    }
}
