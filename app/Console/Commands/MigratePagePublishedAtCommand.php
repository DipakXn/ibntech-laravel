<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Migrate WordPress original publish dates into the pages.published_at column.
 *
 * Safety contract:
 *  - Fail-closed: no --apply flag = DRY RUN, nothing is written.
 *  - Only touches pages.published_at. Never modifies any other column.
 *  - Never creates, deletes, or duplicates rows.
 *  - Uses a DB transaction; rolls back on any error.
 *  - Matches solely on normalised slug (WordPress permalink → pages.slug).
 *  - Parses each pubDate's actual timezone offset; never assumes UTC.
 *  - No migrate, truncate, seeder, or any destructive DB commands.
 */
class MigratePagePublishedAtCommand extends Command
{
    protected $signature = 'pages:migrate-published-at
                            {file?            : Path to the WordPress XML export (default: storage/app/imports/ibntechnologies-Pages-Link-PubDate.xml)}
                            {--dry-run        : Audit and report without writing to the database (also the default when --apply is absent)}
                            {--apply          : Actually write the verified published_at values to the database}';

    protected $description = 'Migrate WordPress original publish dates into pages.published_at (dry-run by default; use --apply to write)';

    // ------------------------------------------------------------------
    // Entry point
    // ------------------------------------------------------------------

    public function handle(): int
    {
        $file = $this->argument('file')
            ?: storage_path('app/imports/ibntechnologies-Pages-Link-PubDate.xml');

        if (! is_file($file)) {
            $this->error("XML file not found: {$file}");

            return self::FAILURE;
        }

        $apply = (bool) $this->option('apply');
        $isDry = ! $apply; // fail-closed: anything that is NOT --apply is a dry run

        @ini_set('memory_limit', '512M');
        @set_time_limit(0);

        $this->newLine();
        $this->line('============================================================');
        $this->line('  pages:migrate-published-at');
        $this->line('============================================================');
        $this->newLine();
        $this->line('File : '.$file);
        $this->line('Mode : '.($isDry ? 'DRY RUN  (no database writes)' : 'APPLY    (writing to database)'));
        $this->newLine();

        // Step 1 – parse XML
        $xmlEntries = $this->parseXml($file);
        $this->line('XML entries parsed      : '.$xmlEntries['totalItems']);

        // Step 2 – fetch all Laravel pages
        $laravelPages = $this->fetchPages();
        $this->line('Laravel Pages found     : '.count($laravelPages));
        $this->newLine();

        // Step 3 – classify every page
        $result = $this->classify($laravelPages, $xmlEntries);

        // Step 4 – print dry-run report
        $this->printReport($result, $xmlEntries, $laravelPages, $isDry);

        // Step 5 – write JSON report to storage/logs
        $reportPath = $this->writeJsonReport($result, $xmlEntries, $laravelPages, $isDry);
        $this->newLine();
        $this->line('JSON report saved: '.$reportPath);

        // Step 6 – apply if requested
        if ($isDry) {
            $this->newLine();
            $this->warn('DRY RUN complete — nothing written.');
            $this->warn('Run with --apply to persist the changes shown above.');

            return self::SUCCESS;
        }

        return $this->applyUpdates($result['would_update']);
    }

    // ------------------------------------------------------------------
    // XML parsing
    // ------------------------------------------------------------------

    /**
     * Parse the XML and return a map of normalised-slug => Carbon (UTC).
     * Duplicate slugs and invalid dates are tracked separately.
     *
     * @return array{bySlug:array<string,Carbon>,duplicates:array<string,list<string>>,invalid:array<string,string>,totalItems:int}
     */
    private function parseXml(string $file): array
    {
        $xml = simplexml_load_file($file, 'SimpleXMLElement', LIBXML_NOCDATA);

        if ($xml === false) {
            $this->error('Failed to parse XML file.');
            exit(self::FAILURE);
        }

        $bySlug     = [];
        $duplicates = [];
        $invalid    = [];
        $totalItems = 0;

        foreach ($xml->item as $item) {
            $totalItems++;
            $rawLink = trim((string) $item->link);
            $rawDate = trim((string) $item->pubDate);

            $slug = $this->normaliseSlug($rawLink);

            // Detect duplicate XML slugs — keep first, flag the rest
            if (isset($bySlug[$slug])) {
                if (! isset($duplicates[$slug])) {
                    $duplicates[$slug] = [];
                }
                $duplicates[$slug][] = $rawDate;
                continue;
            }

            // Skip if already flagged invalid
            if (isset($invalid[$slug])) {
                continue;
            }

            // Parse date using the actual RFC 2822 timezone from the string
            try {
                $carbon = Carbon::parse($rawDate)->utc();
                if (! $carbon->isValid()) {
                    throw new InvalidFormatException('Invalid date');
                }
                $bySlug[$slug] = $carbon;
            } catch (\Throwable) {
                $invalid[$slug] = $rawDate;
            }
        }

        return [
            'bySlug'     => $bySlug,
            'duplicates' => $duplicates,
            'invalid'    => $invalid,
            'totalItems' => $totalItems,
        ];
    }

    /**
     * Strip domain + trailing slash from a WordPress permalink to produce a plain slug.
     *
     * Examples:
     *   https://www.ibntech.com/it-services/                        -> it-services
     *   https://www.ibntech.com/bookkeeping-services/payroll/       -> bookkeeping-services/payroll
     */
    private function normaliseSlug(string $url): string
    {
        // Remove scheme + host (any variant)
        $path = preg_replace('#^https?://[^/]+/#', '', $url) ?? $url;

        // Remove trailing slash
        return rtrim($path, '/');
    }

    // ------------------------------------------------------------------
    // Database helpers
    // ------------------------------------------------------------------

    /**
     * Fetch all pages rows — only id, slug, published_at. No other data loaded.
     *
     * @return list<object>
     */
    private function fetchPages(): array
    {
        return DB::table('pages')
            ->select('id', 'slug', 'published_at')
            ->orderBy('id')
            ->get()
            ->all();
    }

    // ------------------------------------------------------------------
    // Classification
    // ------------------------------------------------------------------

    /**
     * Classify each Laravel page into one of five buckets.
     *
     * @param  list<object> $laravelPages
     * @param  array        $xmlEntries   Result of parseXml()
     * @return array{would_update:list<array>,already_correct:list<array>,not_in_xml:list<array>,duplicate_xml:list<array>,invalid_date:list<array>}
     */
    private function classify(array $laravelPages, array $xmlEntries): array
    {
        $bySlug     = $xmlEntries['bySlug'];
        $duplicates = $xmlEntries['duplicates'];
        $invalid    = $xmlEntries['invalid'];

        $wouldUpdate    = [];
        $alreadyCorrect = [];
        $notInXml       = [];
        $duplicateXml   = [];
        $invalidDate    = [];

        foreach ($laravelPages as $page) {
            $slug = $page->slug;

            // 1 – duplicate slug in XML → flag for manual review, do not update
            if (isset($duplicates[$slug])) {
                $duplicateXml[] = [
                    'id'         => $page->id,
                    'slug'       => $slug,
                    'duplicates' => $duplicates[$slug],
                ];
                continue;
            }

            // 2 – XML had an unparseable date for this slug
            if (isset($invalid[$slug])) {
                $invalidDate[] = [
                    'id'   => $page->id,
                    'slug' => $slug,
                    'raw'  => $invalid[$slug],
                ];
                continue;
            }

            // 3 – slug not found in XML at all
            if (! isset($bySlug[$slug])) {
                $notInXml[] = [
                    'id'      => $page->id,
                    'slug'    => $slug,
                    'current' => $page->published_at,
                ];
                continue;
            }

            // 4 – matched — compare timestamps (both normalised to UTC Y-m-d H:i:s)
            $wpCarbon    = $bySlug[$slug]; // already UTC Carbon
            $wpFormatted = $wpCarbon->format('Y-m-d H:i:s');

            $currentFormatted = $page->published_at
                ? Carbon::parse($page->published_at)->utc()->format('Y-m-d H:i:s')
                : null;

            if ($currentFormatted === $wpFormatted) {
                $alreadyCorrect[] = [
                    'id'           => $page->id,
                    'slug'         => $slug,
                    'published_at' => $wpFormatted,
                ];
            } else {
                $wouldUpdate[] = [
                    'id'      => $page->id,
                    'slug'    => $slug,
                    'current' => $currentFormatted,
                    'new'     => $wpFormatted,
                ];
            }
        }

        return [
            'would_update'    => $wouldUpdate,
            'already_correct' => $alreadyCorrect,
            'not_in_xml'      => $notInXml,
            'duplicate_xml'   => $duplicateXml,
            'invalid_date'    => $invalidDate,
        ];
    }

    // ------------------------------------------------------------------
    // Reporting
    // ------------------------------------------------------------------

    private function printReport(array $result, array $xmlEntries, array $laravelPages, bool $isDry): void
    {
        $totalXml       = $xmlEntries['totalItems'];
        $totalPages     = count($laravelPages);
        $matched        = count($result['would_update']) + count($result['already_correct']);
        $wouldUpdate    = count($result['would_update']);
        $alreadyCorrect = count($result['already_correct']);
        $notInXml       = count($result['not_in_xml']);
        $duplicateXml   = count($result['duplicate_xml']);
        $invalidDate    = count($result['invalid_date']);

        // Unmatched XML entries: XML slugs that do not correspond to any pages row
        $unmatchedXml = count($xmlEntries['bySlug']) - $matched;

        $this->line('============================================================');
        $this->line($isDry ? 'DRY-RUN AUDIT REPORT' : 'UPDATE REPORT');
        $this->line('============================================================');
        $this->newLine();

        $this->table(
            ['Metric', 'Count'],
            [
                ['Total XML entries',             $totalXml],
                ['Total Laravel Pages',           $totalPages],
                ['Matched (slug found in XML)',   $matched],
                ['  Would update',                $wouldUpdate],
                ['  Already correct',             $alreadyCorrect],
                ['Not in XML (no slug match)',    $notInXml],
                ['Duplicate XML slugs',           $duplicateXml],
                ['Invalid / missing dates',       $invalidDate],
                ['Unmatched XML entries',         $unmatchedXml],
            ]
        );

        // ── Would update ──────────────────────────────────────────────
        if ($result['would_update'] !== []) {
            $this->newLine();
            $label = $isDry ? 'Pages that WOULD BE updated' : 'Pages UPDATED';
            $this->line("--- {$label} (".count($result['would_update']).") ---");
            $rows = [];
            foreach ($result['would_update'] as $item) {
                $rows[] = [
                    $item['id'],
                    $item['slug'],
                    $item['current'] ?? '(null)',
                    $item['new'],
                ];
            }
            $this->table(['ID', 'Slug', 'Current published_at (UTC)', 'New published_at (UTC)'], $rows);
        }

        // ── Already correct ───────────────────────────────────────────
        if ($result['already_correct'] !== []) {
            $this->newLine();
            $this->line('--- Already correct ('.count($result['already_correct']).') ---');
            $rows = [];
            foreach ($result['already_correct'] as $item) {
                $rows[] = [$item['id'], $item['slug'], $item['published_at']];
            }
            $this->table(['ID', 'Slug', 'published_at (UTC)'], $rows);
        }

        // ── Not in XML ────────────────────────────────────────────────
        if ($result['not_in_xml'] !== []) {
            $this->newLine();
            $this->warn('--- Pages NOT found in XML — manual review required ('.count($result['not_in_xml']).') ---');
            $rows = [];
            foreach ($result['not_in_xml'] as $item) {
                $rows[] = [$item['id'], $item['slug'], $item['current'] ?? '(null)'];
            }
            $this->table(['ID', 'Slug', 'Current published_at'], $rows);
        }

        // ── Duplicate XML slugs ───────────────────────────────────────
        if ($result['duplicate_xml'] !== []) {
            $this->newLine();
            $this->warn('--- Duplicate XML slugs — manual review required ('.count($result['duplicate_xml']).') ---');
            foreach ($result['duplicate_xml'] as $item) {
                $this->line("  Page #{$item['id']} slug={$item['slug']}");
                $this->line('    Extra XML pubDates: '.implode(' | ', $item['duplicates']));
            }
        }

        // ── Invalid dates ─────────────────────────────────────────────
        if ($result['invalid_date'] !== []) {
            $this->newLine();
            $this->error('--- Invalid / missing dates — manual review required ('.count($result['invalid_date']).') ---');
            foreach ($result['invalid_date'] as $item) {
                $this->line("  Page #{$item['id']} slug={$item['slug']}  raw=\"{$item['raw']}\"");
            }
        }
    }

    // ------------------------------------------------------------------
    // Database update (--apply only)
    // ------------------------------------------------------------------

    /**
     * @param  list<array{id:int,slug:string,current:string|null,new:string}> $updates
     */
    private function applyUpdates(array $updates): int
    {
        if ($updates === []) {
            $this->info('Nothing to update — all pages already have the correct published_at.');

            return self::SUCCESS;
        }

        $this->newLine();
        $this->line('Applying '.count($updates).' updates inside a DB transaction…');

        try {
            DB::transaction(function () use ($updates): void {
                foreach ($updates as $item) {
                    // Update ONLY published_at, matched by verified page ID
                    DB::table('pages')
                        ->where('id', $item['id'])
                        ->update(['published_at' => $item['new']]);
                }
            });
        } catch (\Throwable $e) {
            $this->error('Transaction failed and was rolled back: '.$e->getMessage());

            return self::FAILURE;
        }

        $this->info(count($updates).' pages updated successfully.');

        return self::SUCCESS;
    }

    // ------------------------------------------------------------------
    // JSON report
    // ------------------------------------------------------------------

    private function writeJsonReport(array $result, array $xmlEntries, array $laravelPages, bool $isDry): string
    {
        $directory = storage_path('logs');
        File::ensureDirectoryExists($directory);

        $path = $directory.DIRECTORY_SEPARATOR.'page-published-at-'.now()->format('Ymd-His').'.json';

        $payload = [
            'mode'         => $isDry ? 'dry-run' : 'apply',
            'generated_at' => now()->toIso8601String(),
            'summary'      => [
                'total_xml_entries'   => $xmlEntries['totalItems'],
                'total_laravel_pages' => count($laravelPages),
                'would_update'        => count($result['would_update']),
                'already_correct'     => count($result['already_correct']),
                'not_in_xml'          => count($result['not_in_xml']),
                'duplicate_xml_slugs' => count($result['duplicate_xml']),
                'invalid_dates'       => count($result['invalid_date']),
            ],
            'would_update'    => $result['would_update'],
            'already_correct' => $result['already_correct'],
            'not_in_xml'      => $result['not_in_xml'],
            'duplicate_xml'   => $result['duplicate_xml'],
            'invalid_date'    => $result['invalid_date'],
        ];

        File::put($path, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

        return $path;
    }
}
