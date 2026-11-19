<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\ContentRedirect;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\WhitePaper;
use App\Support\PathPageUrl;
use App\Support\Redirects\LegacyRouteRedirects;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SiteRedirects
{
    /**
     * @return array{id: int, status: int, target: ?string}|null
     */
    public function resolve(string $path): ?array
    {
        $source = $this->normalizeSource($path);

        if ($source === null) {
            return null;
        }

        $match = Cache::remember($this->cacheKey($source), 3600, function () use ($source): array|false {
            $row = $this->matchingRow($source);

            if (! $row instanceof ContentRedirect) {
                return false;
            }

            $status = (int) $row->status_code;

            if (ContentRedirect::hidesTarget($status)) {
                return [
                    'id' => (int) $row->getKey(),
                    'status' => $status,
                    'target' => null,
                ];
            }

            if (! in_array($status, ContentRedirect::REDIRECT_CODES, true)) {
                return false;
            }

            $target = (string) $row->target_path;

            if ($target === '' || $this->sameLocation($source, $target)) {
                return false;
            }

            return [
                'id' => (int) $row->getKey(),
                'status' => $status,
                'target' => $target,
            ];
        });

        return is_array($match) ? $match : null;
    }

    public function targetFor(string $path): ?string
    {
        $match = $this->resolve($path);

        if ($match === null || ! in_array($match['status'], ContentRedirect::REDIRECT_CODES, true)) {
            return null;
        }

        return $match['target'];
    }

    public function recordHit(int $id): void
    {
        ContentRedirect::query()->whereKey($id)->update([
            'hits' => DB::raw('hits + 1'),
            'last_accessed_at' => now(),
        ]);
    }

    public function forget(string $path): void
    {
        Cache::put('content-redirect:version', $this->cacheVersion() + 1, now()->addDays(30));
    }

    public function location(string $target, ?string $requestQuery): string
    {
        [$base, $targetQuery] = $this->splitTarget($target);
        $query = $this->mergeQuery($requestQuery, $targetQuery);

        if ($this->isExternal($base)) {
            return $base.($query !== '' ? '?'.$query : '');
        }

        $location = $base === '/'
            ? url('/')
            : PathPageUrl::withTrailingSlash(url($base));

        return $query !== '' ? $location.'?'.$query : $location;
    }

    public function assert(
        string $source,
        string $target,
        ?int $ignoreId = null,
        int $statusCode = ContentRedirect::STATUS_PERMANENT,
        string $matchType = ContentRedirect::MATCH_EXACT,
        bool $ignoreCase = false,
    ): void {
        $matchType = $this->validMatchType($matchType);
        $sourcePath = $this->normalizePattern($source, $matchType);

        if ($sourcePath === null) {
            throw ValidationException::withMessages([
                'source_path' => $matchType === ContentRedirect::MATCH_REGEX
                    ? 'Enter a valid regular expression, such as ^/old-page.'
                    : ($matchType === ContentRedirect::MATCH_EXACT
                        ? 'Enter a site path, such as /old-page or /industry/old-name.'
                        : 'Enter at least 3 characters for that match type.'),
            ]);
        }

        if ($matchType === ContentRedirect::MATCH_EXACT && $this->isProtectedSource($sourcePath)) {
            throw ValidationException::withMessages([
                'source_path' => 'That URL belongs to the admin, assets, or application routes and cannot be redirected.',
            ]);
        }

        if ($matchType !== ContentRedirect::MATCH_EXACT && $this->patternMatchesProtected($matchType, $sourcePath, $ignoreCase)) {
            throw ValidationException::withMessages([
                'source_path' => 'That pattern also matches an admin or system URL.',
            ]);
        }

        if ($this->duplicateSource($sourcePath, $ignoreId, $matchType)) {
            throw ValidationException::withMessages([
                'source_path' => 'A redirection for that source URL already exists. Check the Trash tab if it is not in the main list.',
            ]);
        }

        if ($matchType === ContentRedirect::MATCH_EXACT && $this->matchesLegacySource($sourcePath)) {
            throw ValidationException::withMessages([
                'source_path' => 'That source URL is already redirected by an application route.',
            ]);
        }

        if ($matchType === ContentRedirect::MATCH_EXACT && ($this->isLiveSection($sourcePath) || $this->isPublishedContent($sourcePath))) {
            throw ValidationException::withMessages([
                'source_path' => 'That URL is already a live page. Change the published slug in the content module so the old URL redirects, or unpublish the page first.',
            ]);
        }

        if (ContentRedirect::hidesTarget($statusCode)) {
            return;
        }

        $targetPath = $this->normalizeTarget($target);

        if ($targetPath === null) {
            throw ValidationException::withMessages([
                'target_path' => 'Enter a site path starting with /, or a full http(s) URL.',
            ]);
        }

        if ($matchType === ContentRedirect::MATCH_EXACT && $this->sameLocation($sourcePath, $targetPath)) {
            throw ValidationException::withMessages([
                'target_path' => 'The destination cannot be the same URL as the source.',
            ]);
        }

        if ($matchType !== ContentRedirect::MATCH_EXACT && $this->patternMatches($matchType, $sourcePath, $targetPath, $ignoreCase)) {
            throw ValidationException::withMessages([
                'target_path' => 'The destination matches this source pattern, which would loop.',
            ]);
        }

        if ($matchType === ContentRedirect::MATCH_EXACT && $this->createsLoop($sourcePath, $targetPath, $ignoreId)) {
            throw ValidationException::withMessages([
                'target_path' => 'That destination eventually redirects back to the source, which would loop.',
            ]);
        }
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function prepare(array $data): array
    {
        $data['match_type'] = $this->validMatchType((string) ($data['match_type'] ?? ContentRedirect::MATCH_EXACT));
        $data = $this->normalizeFields($data);
        $status = (int) ($data['status_code'] ?? ContentRedirect::STATUS_PERMANENT);

        if (! in_array($status, ContentRedirect::RESPONSE_CODES, true)) {
            $status = ContentRedirect::STATUS_PERMANENT;
        }

        $data['status_code'] = $status;

        if (ContentRedirect::hidesTarget($status)) {
            $data['target_path'] = '';
        }

        $data['is_active'] = in_array($data['is_active'] ?? true, [1, '1', true], true);
        $data['ignore_case'] = in_array($data['ignore_case'] ?? false, [1, '1', true], true);

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array{record: array<string, mixed>, additional: list<array<string, mixed>>}
     */
    public function splitForm(array $data): array
    {
        $sources = array_values(is_array($data['sources'] ?? null) ? $data['sources'] : []);
        $rows = [];

        foreach ($sources as $source) {
            if (! is_array($source)) {
                continue;
            }

            $rows[] = $this->prepare([
                'source_path' => $source['source_path'] ?? '',
                'target_path' => $data['target_path'] ?? '',
                'status_code' => $data['status_code'] ?? ContentRedirect::STATUS_PERMANENT,
                'is_active' => $data['is_active'] ?? true,
                'match_type' => $source['match_type'] ?? ContentRedirect::MATCH_EXACT,
                'ignore_case' => $source['ignore_case'] ?? false,
            ]);
        }

        if ($rows === []) {
            throw ValidationException::withMessages([
                'sources' => 'Add at least one source URL.',
            ]);
        }

        return [
            'record' => $rows[0],
            'additional' => array_values(array_slice($rows, 1)),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function normalizeFields(array $data): array
    {
        $source = $this->normalizePattern(
            (string) ($data['source_path'] ?? ''),
            $this->validMatchType((string) ($data['match_type'] ?? ContentRedirect::MATCH_EXACT)),
        );
        $target = $this->normalizeTarget((string) ($data['target_path'] ?? ''));

        if ($source !== null) {
            $data['source_path'] = $source;
        }

        if ($target !== null) {
            $data['target_path'] = $target;
        }

        return $data;
    }

    public function normalizePattern(string $value, string $matchType): ?string
    {
        $matchType = $this->validMatchType($matchType);

        if ($matchType === ContentRedirect::MATCH_EXACT) {
            return $this->normalizeSource($value);
        }

        if ($matchType === ContentRedirect::MATCH_REGEX) {
            $value = trim($value);

            if ($value === '' || strlen($value) > 500 || str_contains($value, "\0")) {
                return null;
            }

            return $this->compiledRegex($value, false) === null ? null : $value;
        }

        $value = trim($value);

        if ($this->isAbsoluteUrl($value)) {
            $parts = parse_url($value);

            if (! is_array($parts) || ! $this->isOwnHost($parts)) {
                return null;
            }

            $value = (string) ($parts['path'] ?? '');
        }

        $value = rtrim(trim($value), '/');

        if ($value === '' || mb_strlen($value) < 3 || mb_strlen($value) > 2048) {
            return null;
        }

        if (str_contains($value, '..') || preg_match('/[\s<>]/', $value) === 1) {
            return null;
        }

        return $value;
    }

    public function normalizeSource(string $value): ?string
    {
        $value = trim($value);

        if ($value === '') {
            return null;
        }

        if ($this->isAbsoluteUrl($value)) {
            $parts = parse_url($value);

            if (! is_array($parts) || ! $this->isOwnHost($parts)) {
                return null;
            }

            $value = $parts['path'] ?? '/';
        }

        return $this->normalizePath($value);
    }

    public function normalizeTarget(string $value): ?string
    {
        $value = trim($value);

        if ($value === '') {
            return null;
        }

        if ($this->isAbsoluteUrl($value)) {
            $parts = parse_url($value);

            if (! is_array($parts) || ! in_array(strtolower((string) ($parts['scheme'] ?? '')), ['http', 'https'], true)) {
                return null;
            }

            if (isset($parts['user']) || isset($parts['pass'])) {
                return null;
            }

            if ($this->isOwnHost($parts)) {
                $path = $this->normalizePath($parts['path'] ?? '/');
                $query = isset($parts['query']) && $parts['query'] !== '' ? '?'.$parts['query'] : '';

                return $path === null ? null : $path.$query;
            }

            $port = isset($parts['port']) ? ':'.$parts['port'] : '';
            $path = $parts['path'] ?? '/';
            $query = isset($parts['query']) && $parts['query'] !== '' ? '?'.$parts['query'] : '';

            return strtolower((string) $parts['scheme']).'://'.$parts['host'].$port.$path.$query;
        }

        $query = '';

        if (str_contains($value, '?')) {
            [$value, $queryString] = explode('?', $value, 2);
            $query = $queryString !== '' ? '?'.$queryString : '';
        }

        $path = $this->normalizePath($value);

        return $path === null ? null : $path.$query;
    }

    private function createsLoop(string $source, string $target, ?int $ignoreId): bool
    {
        $cursor = $this->pathFromTarget($target);

        if ($cursor === null) {
            return false;
        }

        $seen = [$source];

        for ($hop = 0; $hop < 20; $hop++) {
            if (in_array($cursor, $seen, true)) {
                return true;
            }

            $seen[] = $cursor;
            $next = $this->nextHop($cursor, $ignoreId);

            if ($next === null) {
                return false;
            }

            $cursor = $next;
        }

        return true;
    }

    private function nextHop(string $path, ?int $ignoreId): ?string
    {
        $query = ContentRedirect::query()
            ->where('source_path', $path)
            ->where('is_active', true);

        if ($ignoreId !== null) {
            $query->whereKeyNot($ignoreId);
        }

        $stored = $query->value('target_path');

        if (is_string($stored) && $stored !== '') {
            return $this->pathFromTarget($stored);
        }

        foreach (LegacyRouteRedirects::all() as $redirect) {
            $legacySource = $this->normalizeSource($redirect['source']);

            if ($legacySource === $path) {
                return $this->pathFromTarget($redirect['target']);
            }
        }

        return null;
    }

    private function pathFromTarget(string $target): ?string
    {
        if ($this->isExternal($target)) {
            return null;
        }

        $path = explode('?', $target, 2)[0];

        return $this->normalizePath($path);
    }

    private function duplicateSource(string $source, ?int $ignoreId, string $matchType = ContentRedirect::MATCH_EXACT): bool
    {
        $query = ContentRedirect::withTrashed()
            ->where('source_path', $source)
            ->where('match_type', $this->validMatchType($matchType));

        if ($ignoreId !== null) {
            $query->whereKeyNot($ignoreId);
        }

        return $query->exists();
    }

    private function matchesLegacySource(string $source): bool
    {
        foreach (LegacyRouteRedirects::all() as $redirect) {
            if ($this->normalizeSource($redirect['source']) === $source) {
                return true;
            }
        }

        return false;
    }

    private function isLiveSection(string $path): bool
    {
        return in_array($path, [
            '/blog',
            '/article',
            '/case-study',
            '/ebook',
            '/pressrelease',
            '/whitepapers',
            '/lp',
            '/newsletter',
            '/industry',
        ], true);
    }

    private function isPublishedContent(string $path): bool
    {
        if ($path === '/') {
            return Page::query()->where('status', 'published')->where('slug', 'home')->exists();
        }

        $segments = explode('/', trim($path, '/'));

        if (count($segments) === 1) {
            return Page::query()->where('status', 'published')->where('slug', $segments[0])->exists();
        }

        if (count($segments) !== 2) {
            return false;
        }

        [$prefix, $slug] = $segments;

        $model = match ($prefix) {
            'blog' => Blog::class,
            'article' => Article::class,
            'case-study' => CaseStudy::class,
            'ebook' => Ebook::class,
            'pressrelease' => PressRelease::class,
            'whitepapers' => WhitePaper::class,
            'industry' => Industry::class,
            'lp' => LandingPage::class,
            'newsletter' => Newsletter::class,
            default => null,
        };

        if ($model === null) {
            return false;
        }

        /** @var class-string<Model> $model */
        return $model::query()->where('status', 'published')->where('slug', $slug)->exists();
    }

    private function isProtectedSource(string $path): bool
    {
        $first = strtolower(explode('/', trim($path, '/'))[0] ?? '');

        return $path === '/'
            ? false
            : in_array($first, ['admin', 'ibn-tech-cms-login', 'livewire', 'preview', 'storage', 'vendor', 'up'], true)
                || str_starts_with($first, 'livewire-');
    }

    private function sameLocation(string $source, string $target): bool
    {
        $targetPath = $this->pathFromTarget($target);

        return $targetPath !== null && $targetPath === $source;
    }

    private function normalizePath(string $path): ?string
    {
        $path = '/'.trim(str_replace('\\', '/', $path), '/');

        if ($path === '/') {
            return '/';
        }

        if (str_contains($path, '..') || str_contains($path, '//') || preg_match('/[\s<>]/', $path)) {
            return null;
        }

        return $path;
    }

    /**
     * @return array{0: string, 1: string}
     */
    private function splitTarget(string $target): array
    {
        if ($this->isExternal($target)) {
            $parts = parse_url($target);
            $query = is_array($parts) ? (string) ($parts['query'] ?? '') : '';
            $base = $query === '' ? $target : strstr($target, '?', true);

            return [is_string($base) ? $base : $target, $query];
        }

        $path = explode('?', $target, 2)[0];
        $query = explode('?', $target, 2)[1] ?? '';

        return [$path, $query];
    }

    private function mergeQuery(?string $requestQuery, string $targetQuery): string
    {
        $incoming = [];
        $destination = [];

        if ($requestQuery !== null && $requestQuery !== '') {
            parse_str($requestQuery, $incoming);
        }

        if ($targetQuery !== '') {
            parse_str($targetQuery, $destination);
        }

        $merged = array_merge($incoming, $destination);

        return $merged === [] ? '' : http_build_query($merged);
    }

    private function isExternal(string $target): bool
    {
        return $this->isAbsoluteUrl($target) && ! $this->isOwnHost(parse_url($target) ?: []);
    }

    private function isAbsoluteUrl(string $value): bool
    {
        return (bool) preg_match('/^https?:\/\//i', $value);
    }

    /**
     * @param  array<string, mixed>  $parts
     */
    private function isOwnHost(array $parts): bool
    {
        $host = strtolower((string) ($parts['host'] ?? ''));

        if ($host === '') {
            return false;
        }

        $app = parse_url((string) config('app.url'));
        $appHost = strtolower((string) ($app['host'] ?? ''));

        return $host === $appHost;
    }

    private function matchingRow(string $source): ?ContentRedirect
    {
        $columns = ['id', 'status_code', 'target_path', 'source_path', 'match_type', 'ignore_case'];

        $exact = ContentRedirect::query()
            ->where('is_active', true)
            ->where('match_type', ContentRedirect::MATCH_EXACT)
            ->where(function ($query) use ($source): void {
                $query->where('source_path', $source)
                    ->orWhere(function ($query) use ($source): void {
                        $query->where('ignore_case', true)
                            ->whereRaw('LOWER(source_path) = ?', [mb_strtolower($source)]);
                    });
            })
            ->orderByRaw('CASE WHEN source_path = ? THEN 0 ELSE 1 END', [$source])
            ->first($columns);

        if ($exact instanceof ContentRedirect) {
            return $exact;
        }

        $patterns = Cache::remember($this->patternCacheKey(), 3600, function () use ($columns) {
            return ContentRedirect::query()
                ->where('is_active', true)
                ->where('match_type', '!=', ContentRedirect::MATCH_EXACT)
                ->orderByRaw("CASE match_type WHEN 'starts_with' THEN 1 WHEN 'ends_with' THEN 2 WHEN 'contains' THEN 3 ELSE 4 END")
                ->orderByRaw('LENGTH(source_path) DESC')
                ->get($columns);
        });

        foreach ($patterns as $pattern) {
            if ($this->patternMatches(
                (string) $pattern->match_type,
                (string) $pattern->source_path,
                $source,
                (bool) $pattern->ignore_case,
            )) {
                return $pattern;
            }
        }

        return null;
    }

    private function patternMatches(string $matchType, string $pattern, string $path, bool $ignoreCase): bool
    {
        if ($matchType === ContentRedirect::MATCH_REGEX) {
            $regex = $this->compiledRegex($pattern, $ignoreCase);

            if ($regex === null) {
                return false;
            }

            $backtrack = ini_get('pcre.backtrack_limit');
            $recursion = ini_get('pcre.recursion_limit');
            ini_set('pcre.backtrack_limit', '10000');
            ini_set('pcre.recursion_limit', '10000');

            try {
                return @preg_match($regex, $path) === 1;
            } finally {
                ini_set('pcre.backtrack_limit', (string) $backtrack);
                ini_set('pcre.recursion_limit', (string) $recursion);
            }
        }

        $subjects = [$path];
        $withoutSlash = ltrim($path, '/');

        if ($withoutSlash !== $path) {
            $subjects[] = $withoutSlash;
        }

        if ($ignoreCase) {
            $pattern = mb_strtolower($pattern);
            $subjects = array_map(mb_strtolower(...), $subjects);
        }

        foreach ($subjects as $subject) {
            $matched = match ($matchType) {
                ContentRedirect::MATCH_CONTAINS => $pattern !== '' && str_contains($subject, $pattern),
                ContentRedirect::MATCH_STARTS_WITH => $pattern !== '' && str_starts_with($subject, $pattern),
                ContentRedirect::MATCH_ENDS_WITH => $pattern !== '' && str_ends_with($subject, $pattern),
                default => false,
            };

            if ($matched) {
                return true;
            }
        }

        return false;
    }

    private function patternMatchesProtected(string $matchType, string $pattern, bool $ignoreCase): bool
    {
        foreach ([
            '/admin',
            '/admin/redirections',
            '/ibn-tech-cms-login',
            '/livewire/update',
            '/preview/page/1',
            '/storage/file',
            '/vendor/package',
            '/up',
        ] as $protected) {
            if ($this->patternMatches($matchType, $pattern, $protected, $ignoreCase)) {
                return true;
            }
        }

        return false;
    }

    private function compiledRegex(string $pattern, bool $ignoreCase): ?string
    {
        $pattern = trim($pattern);

        if ($pattern === '' || strlen($pattern) > 500 || str_contains($pattern, "\0")) {
            return null;
        }

        $body = str_replace('~', '\~', $pattern);
        $flags = $ignoreCase ? 'iu' : 'u';

        if (preg_match('/^(.)(.*)\\1([a-zA-Z]*)$/s', $pattern, $matches) === 1 && $matches[2] !== '') {
            $body = str_replace('~', '\~', $matches[2]);
            $flags = $matches[3].($ignoreCase && ! str_contains($matches[3], 'i') ? 'i' : '');
            $flags = implode('', array_unique(str_split(preg_replace('/[^imsxADSUXJu]/', '', $flags) ?? '')));
            $flags = str_contains($flags, 'u') ? $flags : $flags.'u';
        }

        $regex = '~'.$body.'~'.$flags;
        set_error_handler(static fn (): bool => true);

        try {
            $valid = @preg_match($regex, '') !== false;
        } finally {
            restore_error_handler();
        }

        return $valid ? $regex : null;
    }

    private function validMatchType(string $matchType): string
    {
        return in_array($matchType, ContentRedirect::MATCH_TYPES, true)
            ? $matchType
            : ContentRedirect::MATCH_EXACT;
    }

    private function cacheVersion(): int
    {
        return (int) Cache::get('content-redirect:version', 1);
    }

    private function patternCacheKey(): string
    {
        return 'content-redirect:patterns:v3:'.$this->cacheVersion();
    }

    private function cacheKey(string $path): string
    {
        return 'content-redirect:v3:'.$this->cacheVersion().':'.$path;
    }
}
