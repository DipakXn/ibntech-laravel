<?php

namespace App\Support\UserGuide;

use Illuminate\Support\Str;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use RuntimeException;

class UserGuideCatalog
{
    /**
     * Display order for the guide navigation. A topic's `group` must be one of these labels.
     *
     * @var list<string>
     */
    public const GROUPS = [
        'Getting started',
        'Content modules',
        'Workflows',
        'Configuration',
        'Administration',
    ];

    /**
     * @var list<UserGuideTopic>|null
     */
    private ?array $topics = null;

    public function __construct(
        private readonly ?string $directory = null,
    ) {}

    /**
     * @return list<UserGuideTopic>
     */
    public function topics(): array
    {
        if ($this->topics !== null) {
            return $this->topics;
        }

        $directory = $this->directory ?? resource_path('user-guide');

        if (! is_dir($directory)) {
            throw new RuntimeException("User guide directory [{$directory}] does not exist.");
        }

        $topics = [];

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS),
        );

        foreach ($iterator as $file) {
            if (! $file->isFile() || strtolower($file->getExtension()) !== 'md') {
                continue;
            }

            $topics[] = $this->parse($file->getPathname());
        }

        if ($topics === []) {
            throw new RuntimeException("User guide directory [{$directory}] does not contain any topics.");
        }

        $slugs = [];

        foreach ($topics as $topic) {
            if (isset($slugs[$topic->slug])) {
                throw new RuntimeException("Duplicate user guide slug [{$topic->slug}] in {$topic->path}.");
            }

            $slugs[$topic->slug] = true;
        }

        usort($topics, function (UserGuideTopic $left, UserGuideTopic $right): int {
            $group = array_search($left->group, self::GROUPS, true) <=> array_search($right->group, self::GROUPS, true);

            if ($group !== 0) {
                return $group;
            }

            return [$left->sort, $left->title] <=> [$right->sort, $right->title];
        });

        return $this->topics = $topics;
    }

    public function find(string $slug): ?UserGuideTopic
    {
        foreach ($this->topics() as $topic) {
            if ($topic->slug === $slug) {
                return $topic;
            }
        }

        return null;
    }

    /**
     * @return list<UserGuideTopic>
     */
    public function search(string $query): array
    {
        $terms = $this->terms($query);

        if ($terms === []) {
            return $this->topics();
        }

        return array_values(array_filter(
            $this->topics(),
            fn (UserGuideTopic $topic): bool => $this->matches($topic, $terms),
        ));
    }

    /**
     * @return list<array{label: string, topics: list<UserGuideTopic>}>
     */
    public function grouped(string $query = ''): array
    {
        $groups = [];

        foreach ($this->search($query) as $topic) {
            $groups[$topic->group][] = $topic;
        }

        $ordered = [];

        foreach (self::GROUPS as $label) {
            if (! isset($groups[$label])) {
                continue;
            }

            $ordered[] = [
                'label' => $label,
                'topics' => $groups[$label],
            ];
        }

        return $ordered;
    }

    public function render(UserGuideTopic $topic): UserGuideDocument
    {
        $markdown = preg_replace_callback(
            '/\]\(topic:([a-z0-9-]+)\)/',
            function (array $matches) use ($topic): string {
                $slug = $matches[1];

                if ($this->find($slug) === null) {
                    throw new RuntimeException("Unknown user guide topic link [{$slug}] in {$topic->path}.");
                }

                return ']('.$this->topicUrl($slug).')';
            },
            $topic->body,
        );

        $converter = new GithubFlavoredMarkdownConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        [$html, $headings] = $this->headingAnchors((string) $converter->convert((string) $markdown));

        return new UserGuideDocument($topic, $html, $headings);
    }

    public function topicUrl(string $slug): string
    {
        return '/admin/user-guide?topic='.rawurlencode($slug);
    }

    /**
     * @param  list<string>  $terms
     */
    private function matches(UserGuideTopic $topic, array $terms): bool
    {
        $haystack = Str::lower(implode("\n", [
            $topic->title,
            $topic->group,
            $topic->summary,
            $topic->keywords,
            $topic->body,
        ]));

        foreach ($terms as $term) {
            if (! str_contains($haystack, $term)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return list<string>
     */
    private function terms(string $query): array
    {
        $query = Str::lower(trim($query));

        if ($query === '') {
            return [];
        }

        return array_values(array_filter(preg_split('/\s+/', $query) ?: []));
    }

    private function parse(string $path): UserGuideTopic
    {
        $contents = file_get_contents($path);

        if ($contents === false) {
            throw new RuntimeException("Unable to read user guide topic [{$path}].");
        }

        $contents = preg_replace('/^\xEF\xBB\xBF/', '', $contents) ?? $contents;

        if (! preg_match('/\A---\R(.*?)\R---\R(.*)\z/s', $contents, $matches)) {
            throw new RuntimeException("User guide topic [{$path}] is missing front matter.");
        }

        $meta = $this->frontMatter($matches[1], $path);
        $body = trim($matches[2]);

        if ($body === '') {
            throw new RuntimeException("User guide topic [{$path}] has an empty body.");
        }

        $basename = pathinfo($path, PATHINFO_FILENAME);

        if (! preg_match('/^\d{2}-([a-z0-9]+(?:-[a-z0-9]+)*)$/', $basename, $slugMatch)) {
            throw new RuntimeException("User guide filename [{$basename}.md] must look like 01-topic-slug.md.");
        }

        $group = $meta['group'];

        if (! in_array($group, self::GROUPS, true)) {
            throw new RuntimeException("User guide topic [{$path}] uses unknown group [{$group}].");
        }

        if (! preg_match('/^\d+$/', $meta['sort'])) {
            throw new RuntimeException("User guide topic [{$path}] has a non-numeric sort value.");
        }

        return new UserGuideTopic(
            slug: $slugMatch[1],
            title: $meta['title'],
            group: $group,
            summary: $meta['summary'],
            sort: (int) $meta['sort'],
            keywords: $meta['keywords'] ?? '',
            body: $body,
            path: $path,
        );
    }

    /**
     * @return array<string, string>
     */
    private function frontMatter(string $block, string $path): array
    {
        $meta = [];

        foreach (preg_split('/\R/', trim($block)) ?: [] as $line) {
            if (! preg_match('/^([a-z_]+):\s*(.+)$/', trim($line), $matches)) {
                throw new RuntimeException("User guide topic [{$path}] has invalid front matter line [{$line}].");
            }

            $meta[$matches[1]] = trim($matches[2]);
        }

        foreach (['title', 'group', 'summary', 'sort'] as $key) {
            if (! isset($meta[$key]) || $meta[$key] === '') {
                throw new RuntimeException("User guide topic [{$path}] is missing [{$key}].");
            }
        }

        return $meta;
    }

    /**
     * @return array{0: string, 1: list<array{id: string, text: string, level: int}>}
     */
    private function headingAnchors(string $html): array
    {
        $headings = [];
        $used = [];

        $html = preg_replace_callback(
            '/<h([23])>(.*?)<\/h\1>/s',
            function (array $matches) use (&$headings, &$used): string {
                $level = (int) $matches[1];
                $text = trim(html_entity_decode(strip_tags($matches[2]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                $base = Str::slug($text) ?: 'section';
                $id = $base;
                $suffix = 2;

                while (isset($used[$id])) {
                    $id = $base.'-'.$suffix;
                    $suffix++;
                }

                $used[$id] = true;
                $headings[] = [
                    'id' => $id,
                    'text' => $text,
                    'level' => $level,
                ];

                return '<h'.$level.' id="'.e($id).'">'.$matches[2].'</h'.$level.'>';
            },
            $html,
        ) ?? $html;

        return [$html, $headings];
    }
}
