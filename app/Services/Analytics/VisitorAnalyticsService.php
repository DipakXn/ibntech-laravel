<?php

namespace App\Services\Analytics;

use App\CmsPreview\CmsPreviewType;
use App\Models\PageView;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class VisitorAnalyticsService
{
    /**
     * @return array{
     *     total_visitors: int,
     *     visitors_today: int,
     *     visitors_yesterday: int,
     *     visitors_this_week: int,
     *     visitors_this_month: int,
     *     total_page_views: int,
     *     unique_visitors: int,
     *     page_views: int
     * }
     */
    public function kpis(VisitorAnalyticsRange $range): array
    {
        $now = CarbonImmutable::now();

        return [
            'total_visitors' => $this->uniqueVisitors(PageView::query()),
            'visitors_today' => $this->uniqueVisitors($this->between($now->startOfDay(), $now->endOfDay())),
            'visitors_yesterday' => $this->uniqueVisitors($this->between($now->subDay()->startOfDay(), $now->subDay()->endOfDay())),
            'visitors_this_week' => $this->uniqueVisitors($this->between($now->startOfWeek(), $now->endOfWeek())),
            'visitors_this_month' => $this->uniqueVisitors($this->between($now->startOfMonth(), $now->endOfMonth())),
            'total_page_views' => (int) PageView::query()->count(),
            'unique_visitors' => $this->uniqueVisitors($this->scoped($range)),
            'page_views' => (int) $this->scoped($range)->count(),
        ];
    }

    /**
     * @return array{labels: list<string>, visitors: list<int>, page_views: list<int>, has_data: bool}
     */
    public function dailyTrend(VisitorAnalyticsRange $range): array
    {
        $rows = $this->scoped($range)
            ->selectRaw('date(visited_at) as day, COUNT(*) as page_views, COUNT(DISTINCT visitor_id) as unique_visitors')
            ->groupByRaw('date(visited_at)')
            ->get()
            ->keyBy(fn (PageView $row): string => (string) $row->getAttribute('day'));

        $labels = [];
        $visitors = [];
        $pageViews = [];
        $hasData = false;
        $cursor = $range->startsAt->startOfDay();
        $end = $range->endsAt->startOfDay();

        while ($cursor->lessThanOrEqualTo($end)) {
            $row = $rows->get($cursor->toDateString());
            $dayVisitors = (int) ($row?->getAttribute('unique_visitors') ?? 0);
            $dayViews = (int) ($row?->getAttribute('page_views') ?? 0);
            $hasData = $hasData || $dayViews > 0;
            $labels[] = $cursor->format('M j');
            $visitors[] = $dayVisitors;
            $pageViews[] = $dayViews;
            $cursor = $cursor->addDay();
        }

        return [
            'labels' => $labels,
            'visitors' => $visitors,
            'page_views' => $pageViews,
            'has_data' => $hasData,
        ];
    }

    /**
     * @return array{
     *     rows: list<array{content_type: string, content_label: string, title: string, page_views: int, unique_visitors: int, last_viewed: ?CarbonImmutable}>,
     *     page: int,
     *     last_page: int,
     *     total: int,
     *     per_page: int
     * }
     */
    public function contentPerformance(
        VisitorAnalyticsRange $range,
        ?string $contentType,
        string $sort,
        string $direction,
        int $perPage = 10,
        int $page = 1,
    ): array {
        $stats = $this->contentStats($range, $contentType);
        $total = (int) DB::query()->fromSub($stats->clone()->toBase(), 'content_stats')->count();
        $perPage = max(1, $perPage);
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = min(max(1, $page), $lastPage);
        [$sort, $direction] = $this->contentOrder($sort, $direction);

        $rows = $stats->clone()
            ->orderBy($sort, $direction)
            ->orderBy('content_type')
            ->orderBy('content_id')
            ->forPage($page, $perPage)
            ->get();

        return [
            'rows' => $this->presentContent($rows),
            'page' => $page,
            'last_page' => $total === 0 ? 1 : $lastPage,
            'total' => $total,
            'per_page' => $perPage,
        ];
    }

    /**
     * @return list<array{rank: int, content_type: string, content_label: string, title: string, page_views: int, unique_visitors: int}>
     */
    public function topContent(VisitorAnalyticsRange $range, int $limit = 10): array
    {
        $rows = $this->contentStats($range, null)
            ->orderByDesc('page_views')
            ->orderByDesc('unique_visitors')
            ->orderBy('content_type')
            ->orderBy('content_id')
            ->limit(max(1, $limit))
            ->get();

        $presented = $this->presentContent($rows);
        $ranked = [];

        foreach ($presented as $index => $row) {
            $ranked[] = [
                'rank' => $index + 1,
                'content_type' => $row['content_type'],
                'content_label' => $row['content_label'],
                'title' => $row['title'],
                'page_views' => $row['page_views'],
                'unique_visitors' => $row['unique_visitors'],
            ];
        }

        return $ranked;
    }

    /**
     * @return list<array{referrer_host: string, page_views: int, unique_visitors: int}>
     */
    public function referrers(VisitorAnalyticsRange $range, int $limit = 10): array
    {
        return $this->scoped($range)
            ->whereNotNull('referrer_host')
            ->where('referrer_host', '!=', '')
            ->selectRaw('referrer_host, COUNT(*) as page_views, COUNT(DISTINCT visitor_id) as unique_visitors')
            ->groupBy('referrer_host')
            ->orderByDesc('page_views')
            ->orderBy('referrer_host')
            ->limit(max(1, $limit))
            ->get()
            ->map(fn (PageView $row): array => [
                'referrer_host' => (string) $row->referrer_host,
                'page_views' => (int) $row->getAttribute('page_views'),
                'unique_visitors' => (int) $row->getAttribute('unique_visitors'),
            ])
            ->all();
    }

    /**
     * @return list<array{country: string, label: string, page_views: int, unique_visitors: int}>
     */
    public function countries(VisitorAnalyticsRange $range, int $limit = 10): array
    {
        return $this->scoped($range)
            ->whereNotNull('country')
            ->where('country', '!=', '')
            ->selectRaw('country, COUNT(*) as page_views, COUNT(DISTINCT visitor_id) as unique_visitors')
            ->groupBy('country')
            ->orderByDesc('page_views')
            ->orderBy('country')
            ->limit(max(1, $limit))
            ->get()
            ->map(function (PageView $row): array {
                $code = strtoupper((string) $row->country);

                return [
                    'country' => $code,
                    'label' => $this->countryLabel($code),
                    'page_views' => (int) $row->getAttribute('page_views'),
                    'unique_visitors' => (int) $row->getAttribute('unique_visitors'),
                ];
            })
            ->all();
    }

    /**
     * @return list<array{device: string, label: string, page_views: int, unique_visitors: int}>
     */
    public function devices(VisitorAnalyticsRange $range): array
    {
        $bucket = "case when device in ('desktop', 'mobile', 'tablet') then device else 'unknown' end";
        $counts = $this->scoped($range)
            ->selectRaw($bucket.' as bucket, COUNT(*) as page_views, COUNT(DISTINCT visitor_id) as unique_visitors')
            ->groupByRaw($bucket)
            ->get()
            ->keyBy(fn (PageView $row): string => (string) $row->getAttribute('bucket'));

        $devices = [];

        foreach (['desktop' => 'Desktop', 'mobile' => 'Mobile', 'tablet' => 'Tablet', 'unknown' => 'Unknown'] as $device => $label) {
            $row = $counts->get($device);
            $devices[] = [
                'device' => $device,
                'label' => $label,
                'page_views' => (int) ($row?->getAttribute('page_views') ?? 0),
                'unique_visitors' => (int) ($row?->getAttribute('unique_visitors') ?? 0),
            ];
        }

        return $devices;
    }

    /**
     * @return list<array{browser: string, page_views: int, unique_visitors: int}>
     */
    public function browsers(VisitorAnalyticsRange $range, int $limit = 10): array
    {
        return $this->labeledBreakdown($range, 'browser', $limit);
    }

    /**
     * @return list<array{operating_system: string, page_views: int, unique_visitors: int}>
     */
    public function operatingSystems(VisitorAnalyticsRange $range, int $limit = 10): array
    {
        return $this->labeledBreakdown($range, 'operating_system', $limit);
    }

    /**
     * @return array<string, string>
     */
    public function contentTypeOptions(): array
    {
        $options = [];

        foreach (CmsPreviewType::cases() as $type) {
            $options[$type->value] = $this->contentLabel($type->value);
        }

        return $options;
    }

    private function scoped(VisitorAnalyticsRange $range): Builder
    {
        return $this->between($range->startsAt, $range->endsAt);
    }

    private function between(CarbonImmutable $start, CarbonImmutable $end): Builder
    {
        return PageView::query()->whereBetween('visited_at', [$start, $end]);
    }

    private function uniqueVisitors(Builder $query): int
    {
        return (int) $query->clone()->distinct()->count('visitor_id');
    }

    private function contentStats(VisitorAnalyticsRange $range, ?string $contentType): Builder
    {
        $type = CmsPreviewType::tryFrom((string) $contentType)?->value;

        return $this->scoped($range)
            ->whereNotNull('content_type')
            ->whereNotNull('content_id')
            ->when($type !== null, fn (Builder $query): Builder => $query->where('content_type', $type))
            ->selectRaw('content_type, content_id, COUNT(*) as page_views, COUNT(DISTINCT visitor_id) as unique_visitors, MAX(visited_at) as last_viewed')
            ->groupBy('content_type', 'content_id');
    }

    /**
     * @return array{0: string, 1: string}
     */
    private function contentOrder(string $sort, string $direction): array
    {
        $sort = in_array($sort, ['page_views', 'unique_visitors', 'last_viewed'], true)
            ? $sort
            : 'page_views';

        return [$sort, $direction === 'asc' ? 'asc' : 'desc'];
    }

    /**
     * @param  iterable<int, PageView>  $rows
     * @return list<array{content_type: string, content_label: string, title: string, page_views: int, unique_visitors: int, last_viewed: ?CarbonImmutable}>
     */
    private function presentContent(iterable $rows): array
    {
        $rows = collect($rows);
        $titles = $this->titles($rows);
        $presented = [];

        foreach ($rows as $row) {
            $type = (string) $row->content_type;
            $id = (int) $row->content_id;
            $lastViewed = $row->getAttribute('last_viewed');

            $presented[] = [
                'content_type' => $type,
                'content_label' => $this->contentLabel($type),
                'title' => $titles[$type.':'.$id] ?? 'Removed record',
                'page_views' => (int) $row->getAttribute('page_views'),
                'unique_visitors' => (int) $row->getAttribute('unique_visitors'),
                'last_viewed' => $lastViewed === null ? null : CarbonImmutable::parse($lastViewed),
            ];
        }

        return $presented;
    }

    /**
     * @param  iterable<int, PageView>  $rows
     * @return array<string, string>
     */
    private function titles(iterable $rows): array
    {
        $idsByType = [];

        foreach ($rows as $row) {
            $idsByType[(string) $row->content_type][] = (int) $row->content_id;
        }

        $union = null;

        foreach ($idsByType as $type => $ids) {
            $enum = CmsPreviewType::tryFrom($type);

            if ($enum === null || $ids === []) {
                continue;
            }

            $query = $enum->modelClass()::query()
                ->selectRaw('? as content_type, id, title', [$type])
                ->whereIn('id', array_values(array_unique($ids)));

            $union = $union === null ? $query : $union->unionAll($query);
        }

        if ($union === null) {
            return [];
        }

        $titles = [];

        foreach ($union->get() as $record) {
            $titles[$record->getAttribute('content_type').':'.(int) $record->getAttribute('id')] = (string) $record->getAttribute('title');
        }

        return $titles;
    }

    private function contentLabel(string $type): string
    {
        return match ($type) {
            CmsPreviewType::Page->value => 'Pages',
            CmsPreviewType::Blog->value => 'Blogs',
            CmsPreviewType::Industry->value => 'Industries',
            CmsPreviewType::CaseStudy->value => 'Case Studies',
            CmsPreviewType::LandingPage->value => 'Landing Pages',
            CmsPreviewType::Newsletter->value => 'Newsletters',
            CmsPreviewType::PressRelease->value => 'Press Releases',
            CmsPreviewType::Ebook->value => 'eBooks',
            CmsPreviewType::WhitePaper->value => 'White Papers',
            CmsPreviewType::Article->value => 'Articles',
            default => $type,
        };
    }

    /**
     * @return list<array<string, int|string>>
     */
    private function labeledBreakdown(VisitorAnalyticsRange $range, string $column, int $limit): array
    {
        if (! in_array($column, ['browser', 'operating_system'], true)) {
            return [];
        }

        $label = "case when {$column} is null or {$column} = '' then 'Unknown' else {$column} end";

        // Group and sort by the select alias. Repeating the CASE in GROUP BY, or
        // quoting the alias, makes MySQL ONLY_FULL_GROUP_BY reject the browser column.
        return $this->scoped($range)
            ->selectRaw($label.' as label, COUNT(*) as page_views, COUNT(DISTINCT visitor_id) as unique_visitors')
            ->groupByRaw('label')
            ->orderByRaw('page_views desc')
            ->orderByRaw('label asc')
            ->limit(max(1, $limit))
            ->get()
            ->map(fn (PageView $row): array => [
                $column => (string) $row->getAttribute('label'),
                'page_views' => (int) $row->getAttribute('page_views'),
                'unique_visitors' => (int) $row->getAttribute('unique_visitors'),
            ])
            ->all();
    }

    private function countryLabel(string $code): string
    {
        if (function_exists('locale_get_display_region')) {
            $name = locale_get_display_region('-'.$code, 'en');

            if (is_string($name) && $name !== '' && strtoupper($name) !== $code) {
                return $name;
            }
        }

        return $code;
    }
}
