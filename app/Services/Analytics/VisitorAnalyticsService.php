<?php

namespace App\Services\Analytics;

use App\CmsPreview\CmsPreviewType;
use App\Models\Lead;
use App\Models\PageView;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;

class VisitorAnalyticsService
{
    /**
     * @var array<string, array<string, mixed>>
     */
    private array $conversionCache = [];

    public function __construct(
        private readonly SubmissionSourceResolver $sources,
        private readonly ExcludedIpMatcher $excludedIps,
    ) {}

    /**
     * @return array{
     *     total_visitors: int,
     *     visitors_today: int,
     *     visitors_yesterday: int,
     *     visitors_this_week: int,
     *     visitors_this_month: int,
     *     total_page_views: int,
     *     unique_visitors: int,
     *     page_views: int,
     *     enquiries: int,
     *     gated_downloads: int,
     *     unattributed: int,
     *     conversion_rate: ?float
     * }
     */
    public function kpis(VisitorAnalyticsRange $range): array
    {
        $now = CarbonImmutable::now();
        $uniqueVisitors = $this->uniqueVisitors($this->scoped($range));
        $conversions = $this->conversionSummary($range);

        return [
            'total_visitors' => $this->uniqueVisitors(PageView::query()),
            'visitors_today' => $this->uniqueVisitors($this->between($now->startOfDay(), $now->endOfDay())),
            'visitors_yesterday' => $this->uniqueVisitors($this->between($now->subDay()->startOfDay(), $now->subDay()->endOfDay())),
            'visitors_this_week' => $this->uniqueVisitors($this->between($now->startOfWeek(), $now->endOfWeek())),
            'visitors_this_month' => $this->uniqueVisitors($this->between($now->startOfMonth(), $now->endOfMonth())),
            'total_page_views' => (int) PageView::query()->count(),
            'unique_visitors' => $uniqueVisitors,
            'page_views' => (int) $this->scoped($range)->count(),
            'enquiries' => $conversions['enquiries'],
            'gated_downloads' => $conversions['downloads'],
            'unattributed' => $conversions['unattributed'],
            'conversion_rate' => $this->conversionRate($conversions['attributed_conversions'], $uniqueVisitors),
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
     *     rows: list<array<string, mixed>>,
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
        [$sort, $direction] = $this->contentOrder($sort, $direction);
        $sorted = $this->sortRows($this->performanceRows($range, $contentType), $sort, $direction);
        $total = count($sorted);
        $perPage = max(1, $perPage);
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = min(max(1, $page), $lastPage);

        return [
            'rows' => array_slice($sorted, ($page - 1) * $perPage, $perPage),
            'page' => $page,
            'last_page' => $total === 0 ? 1 : $lastPage,
            'total' => $total,
            'per_page' => $perPage,
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function topContent(VisitorAnalyticsRange $range, int $limit = 10): array
    {
        $rows = array_values(array_filter(
            $this->performanceRows($range, null),
            fn (array $row): bool => $row['page_views'] > 0,
        ));

        usort($rows, fn (array $left, array $right): int => [
            $right['page_views'],
            $right['unique_visitors'],
            $left['content_type'],
            $left['title'],
        ] <=> [
            $left['page_views'],
            $left['unique_visitors'],
            $right['content_type'],
            $right['title'],
        ]);

        return $this->rank(array_slice($rows, 0, max(1, $limit)));
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function topConversions(VisitorAnalyticsRange $range, int $limit = 10): array
    {
        $rows = array_values(array_filter(
            $this->performanceRows($range, null),
            fn (array $row): bool => $row['conversions'] > 0,
        ));

        usort($rows, fn (array $left, array $right): int => [
            $right['conversions'],
            $right['unique_visitors'],
            $left['content_type'],
            $left['title'],
        ] <=> [
            $left['conversions'],
            $left['unique_visitors'],
            $right['content_type'],
            $right['title'],
        ]);

        return $this->rank(array_slice($rows, 0, max(1, $limit)));
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function pageTypes(VisitorAnalyticsRange $range): array
    {
        $views = $this->scoped($range)
            ->whereNotNull('content_type')
            ->whereNotNull('content_id')
            ->selectRaw('content_type, COUNT(*) as page_views, COUNT(DISTINCT visitor_id) as unique_visitors')
            ->groupBy('content_type')
            ->get()
            ->keyBy(fn (PageView $row): string => (string) $row->content_type);

        $counts = [];

        foreach ($this->conversionSummary($range)['buckets'] as $bucket) {
            if ($bucket['kind'] !== SubmissionSource::CONTENT || ! is_string($bucket['content_type'])) {
                continue;
            }

            $type = $bucket['content_type'];
            $counts[$type]['enquiries'] = ($counts[$type]['enquiries'] ?? 0) + $bucket['enquiries'];
            $counts[$type]['downloads'] = ($counts[$type]['downloads'] ?? 0) + $bucket['downloads'];
        }

        $types = [];

        foreach (CmsPreviewType::cases() as $type) {
            $view = $views->get($type->value);
            $enquiries = (int) ($counts[$type->value]['enquiries'] ?? 0);
            $downloads = (int) ($counts[$type->value]['downloads'] ?? 0);
            $pageViews = (int) ($view?->getAttribute('page_views') ?? 0);
            $visitors = (int) ($view?->getAttribute('unique_visitors') ?? 0);

            if ($pageViews === 0 && $visitors === 0 && $enquiries === 0 && $downloads === 0) {
                continue;
            }

            $types[] = [
                'content_type' => $type->value,
                'content_label' => $this->contentLabel($type->value),
                'page_views' => $pageViews,
                'unique_visitors' => $visitors,
                'enquiries' => $enquiries,
                'downloads' => $downloads,
                'conversions' => $enquiries + $downloads,
                'conversion_rate' => $this->conversionRate($enquiries + $downloads, $visitors),
            ];
        }

        return $types;
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

    /**
     * @return array{0: string, 1: string}
     */
    private function contentOrder(string $sort, string $direction): array
    {
        $sort = in_array($sort, ['page_views', 'unique_visitors', 'last_viewed', 'enquiries', 'downloads', 'conversions', 'conversion_rate'], true)
            ? $sort
            : 'page_views';

        return [$sort, $direction === 'asc' ? 'asc' : 'desc'];
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function performanceRows(VisitorAnalyticsRange $range, ?string $contentType): array
    {
        $typeFilter = CmsPreviewType::tryFrom((string) $contentType)?->value;
        $rows = [];

        $stats = $this->scoped($range)
            ->whereNotNull('content_type')
            ->whereNotNull('content_id')
            ->when($typeFilter !== null, fn (Builder $query): Builder => $query->where('content_type', $typeFilter))
            ->selectRaw('content_type, content_id, COUNT(*) as page_views, COUNT(DISTINCT visitor_id) as unique_visitors, MAX(visited_at) as last_viewed, MIN(path) as path')
            ->groupBy('content_type', 'content_id')
            ->get();

        foreach ($stats as $stat) {
            $contentTypeValue = (string) $stat->content_type;
            $contentId = (int) $stat->content_id;
            $key = 'content:'.$contentTypeValue.':'.$contentId;
            $rows[$key] = $this->blankRow(
                $key,
                $contentTypeValue,
                $contentId,
                $this->displayPath($stat->getAttribute('path')),
                (int) $stat->getAttribute('page_views'),
                (int) $stat->getAttribute('unique_visitors'),
                $this->moment($stat->getAttribute('last_viewed')),
            );
        }

        if ($typeFilter === null) {
            $rows = $this->addPathRows($range, $rows);
        }

        foreach ($this->conversionSummary($range)['buckets'] as $key => $bucket) {
            $isContent = $bucket['kind'] === SubmissionSource::CONTENT;
            $bucketType = is_string($bucket['content_type']) ? $bucket['content_type'] : null;

            if ($typeFilter !== null && (! $isContent || $bucketType !== $typeFilter)) {
                continue;
            }

            if (! isset($rows[$key])) {
                $rows[$key] = $this->blankRow(
                    $key,
                    $isContent ? (string) $bucketType : 'path',
                    $isContent ? (int) $bucket['content_id'] : null,
                    is_string($bucket['path']) ? $bucket['path'] : null,
                    0,
                    0,
                    null,
                );
            } elseif (($rows[$key]['path'] ?? null) === null && is_string($bucket['path'])) {
                $rows[$key]['path'] = $bucket['path'];
            }

            $rows[$key]['enquiries'] += (int) $bucket['enquiries'];
            $rows[$key]['downloads'] += (int) $bucket['downloads'];
        }

        return $this->presentRows($rows);
    }

    /**
     * @param  array<string, array<string, mixed>>  $rows
     * @return array<string, array<string, mixed>>
     */
    private function addPathRows(VisitorAnalyticsRange $range, array $rows): array
    {
        $views = $this->scoped($range)
            ->where(function (Builder $query): void {
                $query->whereNull('content_type')->orWhereNull('content_id');
            })
            ->get(['path', 'visitor_id', 'visited_at']);

        $grouped = [];

        foreach ($views as $view) {
            $path = $this->displayPath($view->path) ?? '/';
            $key = 'path:'.$path;
            $grouped[$key] ??= [
                'path' => $path,
                'page_views' => 0,
                'visitors' => [],
                'last_viewed' => null,
            ];
            $grouped[$key]['page_views']++;
            $grouped[$key]['visitors'][(string) $view->visitor_id] = true;
            $visited = $view->visited_at;

            if ($visited instanceof CarbonInterface && ($grouped[$key]['last_viewed'] === null || $visited->greaterThan($grouped[$key]['last_viewed']))) {
                $grouped[$key]['last_viewed'] = CarbonImmutable::instance($visited);
            }
        }

        foreach ($grouped as $key => $group) {
            $rows[$key] = $this->blankRow(
                $key,
                'path',
                null,
                $group['path'],
                $group['page_views'],
                count($group['visitors']),
                $group['last_viewed'],
            );
        }

        return $rows;
    }

    /**
     * @param  array<string, array<string, mixed>>  $rows
     * @return list<array<string, mixed>>
     */
    private function presentRows(array $rows): array
    {
        $models = [];

        foreach ($rows as $row) {
            if ($row['content_type'] === 'path' || $row['content_id'] === null) {
                continue;
            }

            $models[] = new PageView([
                'content_type' => $row['content_type'],
                'content_id' => $row['content_id'],
            ]);
        }

        $titles = $this->titles($models);
        $presented = [];

        foreach ($rows as $row) {
            $enquiries = (int) $row['enquiries'];
            $downloads = (int) $row['downloads'];
            $conversions = $enquiries + $downloads;
            $row['content_label'] = $this->contentLabel((string) $row['content_type']);
            $row['title'] = $row['content_type'] === 'path'
                ? (string) ($row['path'] ?? 'Other paths')
                : ($titles[$row['content_type'].':'.$row['content_id']] ?? 'Removed record');
            $row['conversions'] = $conversions;
            $row['conversion_rate'] = $this->conversionRate($conversions, (int) $row['unique_visitors']);
            $presented[] = $row;
        }

        return $presented;
    }

    /**
     * @return array<string, mixed>
     */
    private function blankRow(
        string $key,
        string $contentType,
        ?int $contentId,
        ?string $path,
        int $pageViews,
        int $uniqueVisitors,
        ?CarbonImmutable $lastViewed,
    ): array {
        return [
            'key' => $key,
            'content_type' => $contentType,
            'content_id' => $contentId,
            'content_label' => $this->contentLabel($contentType),
            'title' => '',
            'path' => $path,
            'page_views' => $pageViews,
            'unique_visitors' => $uniqueVisitors,
            'enquiries' => 0,
            'downloads' => 0,
            'conversions' => 0,
            'conversion_rate' => null,
            'last_viewed' => $lastViewed,
        ];
    }

    /**
     * @param  list<array<string, mixed>>  $rows
     * @return list<array<string, mixed>>
     */
    private function sortRows(array $rows, string $sort, string $direction): array
    {
        usort($rows, function (array $left, array $right) use ($sort, $direction): int {
            $comparison = $this->compareRows($left, $right, $sort, $direction);

            if ($comparison !== 0) {
                return $comparison;
            }

            return [$left['content_type'], $left['title'], $left['content_id'] ?? 0] <=> [$right['content_type'], $right['title'], $right['content_id'] ?? 0];
        });

        return $rows;
    }

    /**
     * @param  array<string, mixed>  $left
     * @param  array<string, mixed>  $right
     */
    private function compareRows(array $left, array $right, string $sort, string $direction): int
    {
        if ($sort === 'conversion_rate') {
            return $this->compareOptionalNumber($left['conversion_rate'], $right['conversion_rate'], $direction);
        }

        if ($sort === 'last_viewed') {
            $leftTime = $left['last_viewed'] instanceof CarbonImmutable ? $left['last_viewed']->getTimestamp() : null;
            $rightTime = $right['last_viewed'] instanceof CarbonImmutable ? $right['last_viewed']->getTimestamp() : null;

            return $this->compareOptionalNumber($leftTime, $rightTime, $direction);
        }

        return ((int) $left[$sort] <=> (int) $right[$sort]) * ($direction === 'asc' ? 1 : -1);
    }

    private function compareOptionalNumber(int|float|null $left, int|float|null $right, string $direction): int
    {
        if ($left === null || $right === null) {
            return $left === $right ? 0 : ($left === null ? 1 : -1);
        }

        return ($left <=> $right) * ($direction === 'asc' ? 1 : -1);
    }

    /**
     * @param  list<array<string, mixed>>  $rows
     * @return list<array<string, mixed>>
     */
    private function rank(array $rows): array
    {
        $ranked = [];

        foreach ($rows as $index => $row) {
            $row['rank'] = $index + 1;
            $ranked[] = $row;
        }

        return $ranked;
    }

    private function displayPath(mixed $path): ?string
    {
        if (! is_string($path) || trim($path) === '') {
            return null;
        }

        return $this->sources->canonicalizePath($path);
    }

    private function moment(mixed $value): ?CarbonImmutable
    {
        if ($value === null || $value === '') {
            return null;
        }

        return CarbonImmutable::parse($value);
    }

    private function conversionRate(int $conversions, int $visitors): ?float
    {
        if ($visitors < 1) {
            return null;
        }

        return round(($conversions / $visitors) * 100, 1);
    }

    /**
     * @return array{enquiries: int, downloads: int, unattributed: int, attributed_conversions: int, buckets: array<string, array<string, mixed>>}
     */
    private function conversionSummary(VisitorAnalyticsRange $range): array
    {
        $cacheKey = $range->startsAt->toAtomString().'|'.$range->endsAt->toAtomString();

        if (isset($this->conversionCache[$cacheKey])) {
            return $this->conversionCache[$cacheKey];
        }

        $summary = [
            'enquiries' => 0,
            'downloads' => 0,
            'unattributed' => 0,
            'attributed_conversions' => 0,
            'buckets' => [],
        ];

        $leads = Lead::query()
            ->whereBetween('created_at', [$range->startsAt, $range->endsAt])
            ->where(function (Builder $query): void {
                $query->where('status', '!=', Lead::STATUS_SPAM)->orWhereNull('status');
            })
            ->get(['form_name', 'page_url', 'ip_address']);

        foreach ($leads as $lead) {
            if ($this->excludedIps->excludes($lead->ip_address)) {
                continue;
            }

            $download = $this->sources->isGatedDownload($lead->form_name);

            if ($download) {
                $summary['downloads']++;
            } else {
                $summary['enquiries']++;
            }

            $source = $this->sources->resolve($lead->page_url);
            $key = $source->key();

            if ($key === null) {
                $summary['unattributed']++;

                continue;
            }

            $summary['attributed_conversions']++;
            $summary['buckets'][$key] ??= [
                'kind' => $source->kind,
                'content_type' => $source->contentType,
                'content_id' => $source->contentId,
                'path' => $source->path,
                'enquiries' => 0,
                'downloads' => 0,
            ];
            $summary['buckets'][$key][$download ? 'downloads' : 'enquiries']++;
        }

        return $this->conversionCache[$cacheKey] = $summary;
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
            'path' => 'Other paths',
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
