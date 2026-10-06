<?php

namespace App\Services\Overview;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use InvalidArgumentException;

class PeriodCounts
{
    /**
     * Count records in one query.
     *
     * Today, this week, and this month use the application timezone.
     * The week follows Carbon's configured week start.
     *
     * @param  class-string<Model>  $model
     * @return array{total: int, today: int, this_week: int, this_month: int}
     */
    public function forModel(string $model, ?Carbon $now = null): array
    {
        if (! is_subclass_of($model, Model::class)) {
            throw new InvalidArgumentException($model.' is not an Eloquent model.');
        }

        $now = ($now ?? now())->copy()->timezone((string) config('app.timezone'));

        $todayStart = $now->copy()->startOfDay();
        $todayEnd = $now->copy()->endOfDay();
        $weekStart = $now->copy()->startOfWeek();
        $weekEnd = $now->copy()->endOfWeek();
        $monthStart = $now->copy()->startOfMonth();
        $monthEnd = $now->copy()->endOfMonth();

        $row = $model::query()
            ->toBase()
            ->selectRaw(
                'COUNT(*) as total,
                COALESCE(SUM(CASE WHEN created_at >= ? AND created_at <= ? THEN 1 ELSE 0 END), 0) as today_count,
                COALESCE(SUM(CASE WHEN created_at >= ? AND created_at <= ? THEN 1 ELSE 0 END), 0) as week_count,
                COALESCE(SUM(CASE WHEN created_at >= ? AND created_at <= ? THEN 1 ELSE 0 END), 0) as month_count',
                [
                    $todayStart,
                    $todayEnd,
                    $weekStart,
                    $weekEnd,
                    $monthStart,
                    $monthEnd,
                ],
            )
            ->first();

        return [
            'total' => (int) ($row->total ?? 0),
            'today' => (int) ($row->today_count ?? 0),
            'this_week' => (int) ($row->week_count ?? 0),
            'this_month' => (int) ($row->month_count ?? 0),
        ];
    }
}
