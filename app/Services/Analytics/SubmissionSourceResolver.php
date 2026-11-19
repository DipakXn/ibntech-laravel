<?php

namespace App\Services\Analytics;

use App\CmsPreview\CmsPreviewType;
use App\Support\FormSubmissionPageUrl;

final class SubmissionSourceResolver
{
    /**
     * @var list<string>
     */
    private const DOWNLOAD_FORMS = [
        'ebook_download',
        'case_study_download',
    ];

    /**
     * Single-segment slugs that are not CMS pages. Matches the public page route.
     *
     * @var list<string>
     */
    private const RESERVED_PAGE_SLUGS = [
        'admin',
        'article',
        'blog',
        'case-study',
        'ebook',
        'ibn-tech-cms-login',
        'industry',
        'lp',
        'newsletter',
        'pressrelease',
        'press-releases',
        'preview',
        'whitepapers',
        'livewire',
        'storage',
        'up',
    ];

    /**
     * @var array<string, array<string, int>>|null
     */
    private ?array $publishedIds = null;

    public function isGatedDownload(?string $formName): bool
    {
        return in_array($formName, self::DOWNLOAD_FORMS, true);
    }

    public function resolve(?string $url): SubmissionSource
    {
        $path = $this->pathFromUrl($url);

        if ($path === null) {
            return SubmissionSource::unavailable();
        }

        $match = $this->match($path);

        if ($match === null) {
            return SubmissionSource::unavailable();
        }

        if ($match['type'] === null || $match['slug'] === null) {
            return SubmissionSource::path($path);
        }

        $id = $this->publishedId($match['type'], $match['slug']);

        if ($id === null) {
            return SubmissionSource::path($path);
        }

        return SubmissionSource::content($match['type']->value, $id, $path);
    }

    public function canonicalizePath(string $path): string
    {
        $path = trim(explode('#', explode('?', $path, 2)[0], 2)[0]);
        $path = rawurldecode($path);
        $path = '/'.trim($path, '/');
        $path = preg_replace('#/+#', '/', $path) ?? '/';

        return $path === '' ? '/' : $path;
    }

    private function pathFromUrl(?string $url): ?string
    {
        if (! is_string($url)) {
            return null;
        }

        $url = trim($url);

        if ($url === '' || FormSubmissionPageUrl::isLivewireEndpoint($url)) {
            return null;
        }

        if (str_starts_with($url, '/')) {
            return $this->canonicalizePath($url);
        }

        $parts = parse_url($url);

        if (! is_array($parts)) {
            return null;
        }

        $scheme = strtolower((string) ($parts['scheme'] ?? ''));

        if ($scheme !== '' && ! in_array($scheme, ['http', 'https'], true)) {
            return null;
        }

        if ($scheme === '' && ! isset($parts['host'])) {
            return null;
        }

        $path = $parts['path'] ?? '/';

        return $this->canonicalizePath(is_string($path) ? $path : '/');
    }

    /**
     * @return array{type: ?CmsPreviewType, slug: ?string}|null
     */
    private function match(string $path): ?array
    {
        $segments = $path === '/' ? [] : explode('/', trim($path, '/'));
        $count = count($segments);
        $last = $segments[$count - 1] ?? '';

        if ($last !== '' && preg_match('/\.[A-Za-z0-9]{1,10}$/', $last) === 1) {
            return null;
        }

        if ($count === 0) {
            return ['type' => CmsPreviewType::Page, 'slug' => 'home'];
        }

        $first = $segments[0];

        if ($count === 1 && in_array($first, ['blog', 'article', 'case-study', 'ebook', 'pressrelease', 'whitepapers', 'lp', 'newsletter'], true)) {
            return ['type' => null, 'slug' => null];
        }

        if ($first === 'blog' && $count === 3 && $segments[1] === 'category') {
            return ['type' => null, 'slug' => null];
        }

        if ($first === 'blog' && $count === 5 && $segments[1] === 'category' && $segments[3] === 'page' && $this->isPageNumber($segments[4])) {
            return ['type' => null, 'slug' => null];
        }

        if ($first === 'blog' && $count === 2 && $segments[1] !== 'category') {
            return ['type' => CmsPreviewType::Blog, 'slug' => $segments[1]];
        }

        if ($this->isPagedIndex($segments, 'article')) {
            return ['type' => null, 'slug' => null];
        }

        if ($first === 'article' && $count === 2 && $segments[1] !== 'page') {
            return ['type' => CmsPreviewType::Article, 'slug' => $segments[1]];
        }

        if ($this->isPagedIndex($segments, 'case-study')) {
            return ['type' => null, 'slug' => null];
        }

        if ($first === 'case-study' && $count === 3 && $segments[2] === 'download' && $segments[1] !== 'page') {
            return ['type' => CmsPreviewType::CaseStudy, 'slug' => $segments[1]];
        }

        if ($first === 'case-study' && $count === 2 && $segments[1] !== 'page') {
            return ['type' => CmsPreviewType::CaseStudy, 'slug' => $segments[1]];
        }

        if ($this->isPagedIndex($segments, 'ebook')) {
            return ['type' => null, 'slug' => null];
        }

        if ($first === 'ebook' && $count === 3 && $segments[2] === 'download' && $segments[1] !== 'page') {
            return ['type' => CmsPreviewType::Ebook, 'slug' => $segments[1]];
        }

        if ($first === 'ebook' && $count === 2 && $segments[1] !== 'page') {
            return ['type' => CmsPreviewType::Ebook, 'slug' => $segments[1]];
        }

        if ($this->isPagedIndex($segments, 'pressrelease')) {
            return ['type' => null, 'slug' => null];
        }

        if ($first === 'pressrelease' && $count === 2 && $segments[1] !== 'page') {
            return ['type' => CmsPreviewType::PressRelease, 'slug' => $segments[1]];
        }

        if ($this->isPagedIndex($segments, 'whitepapers')) {
            return ['type' => null, 'slug' => null];
        }

        if ($first === 'whitepapers' && $count === 2 && $segments[1] !== 'page') {
            return ['type' => CmsPreviewType::WhitePaper, 'slug' => $segments[1]];
        }

        if ($first === 'industry' && $count === 2) {
            return ['type' => CmsPreviewType::Industry, 'slug' => $segments[1]];
        }

        if ($first === 'lp' && $count === 2) {
            return ['type' => CmsPreviewType::LandingPage, 'slug' => $segments[1]];
        }

        if ($first === 'newsletter' && $count === 2) {
            return ['type' => CmsPreviewType::Newsletter, 'slug' => $segments[1]];
        }

        if ($count === 1 && ! in_array($first, self::RESERVED_PAGE_SLUGS, true)) {
            return ['type' => CmsPreviewType::Page, 'slug' => $first];
        }

        return null;
    }

    /**
     * @param  list<string>  $segments
     */
    private function isPagedIndex(array $segments, string $prefix): bool
    {
        return count($segments) === 3
            && $segments[0] === $prefix
            && $segments[1] === 'page'
            && $this->isPageNumber($segments[2]);
    }

    private function isPageNumber(string $value): bool
    {
        return preg_match('/^[1-9][0-9]*$/', $value) === 1;
    }

    private function publishedId(CmsPreviewType $type, string $slug): ?int
    {
        $this->publishedIds ??= $this->loadPublishedIds();
        $id = $this->publishedIds[$type->value][$slug] ?? null;

        return $id === null ? null : (int) $id;
    }

    /**
     * @return array<string, array<string, int>>
     */
    private function loadPublishedIds(): array
    {
        $ids = [];

        foreach (CmsPreviewType::cases() as $type) {
            $ids[$type->value] = [];

            foreach ($type->modelClass()::query()->published()->pluck('id', 'slug') as $slug => $id) {
                if (is_string($slug) && $slug !== '') {
                    $ids[$type->value][$slug] = (int) $id;
                }
            }
        }

        return $ids;
    }
}
