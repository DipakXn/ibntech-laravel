<?php

namespace Tests\Unit;

use App\Support\Logs\LaravelLogReader;
use Tests\TestCase;

class LaravelLogReaderTest extends TestCase
{
    private string $directory;

    private LaravelLogReader $reader;

    protected function setUp(): void
    {
        parent::setUp();

        $this->directory = sys_get_temp_dir().DIRECTORY_SEPARATOR.'ibn-logs-'.bin2hex(random_bytes(8));
        mkdir($this->directory);
        $this->reader = new LaravelLogReader($this->directory, maxScanBytes: 8192);
    }

    protected function tearDown(): void
    {
        foreach (glob($this->directory.DIRECTORY_SEPARATOR.'*') ?: [] as $file) {
            unlink($file);
        }

        rmdir($this->directory);

        parent::tearDown();
    }

    public function test_it_lists_log_files_newest_first(): void
    {
        $older = $this->directory.DIRECTORY_SEPARATOR.'laravel-2026-09-01.log';
        $newer = $this->directory.DIRECTORY_SEPARATOR.'laravel-2026-09-07.log';

        file_put_contents($older, "[2026-09-01 08:00:00] testing.INFO: older file\n");
        file_put_contents($newer, "[2026-09-07 08:00:00] testing.INFO: newer file\n");
        touch($older, strtotime('2026-09-01 08:00:00'));
        touch($newer, strtotime('2026-09-07 08:00:00'));

        $files = $this->reader->listFiles();

        $this->assertSame(['laravel-2026-09-07.log', 'laravel-2026-09-01.log'], $files->pluck('name')->all());
    }

    public function test_it_filters_files_by_name_and_date(): void
    {
        file_put_contents($this->directory.DIRECTORY_SEPARATOR.'laravel-2026-09-01.log', "a\n");
        file_put_contents($this->directory.DIRECTORY_SEPARATOR.'laravel-2026-09-07.log', "b\n");
        file_put_contents($this->directory.DIRECTORY_SEPARATOR.'worker.log', "c\n");

        $filtered = $this->reader->listFiles('laravel', '2026-09-05', '2026-09-07');

        $this->assertSame(['laravel-2026-09-07.log'], $filtered->pluck('name')->all());
    }

    public function test_it_parses_entries_with_stack_traces_and_newest_first(): void
    {
        $path = $this->directory.DIRECTORY_SEPARATOR.'laravel-2026-09-07.log';
        file_put_contents($path, <<<'LOG'
[2026-09-07 10:00:00] testing.INFO: Started request {"url":"https://www.ibntech.com/contact"}
[2026-09-07 10:01:00] testing.ERROR: Unable to process lead
[stacktrace]
#0 /app/Services/LeadService.php(12): App\Services\LeadService->store()
#1 {main}
[2026-09-07 10:02:00] testing.WARNING: Slow query
LOG);

        $inspection = $this->reader->inspect('laravel-2026-09-07.log');

        $this->assertSame(3, $inspection['total_entries']);
        $this->assertSame(1, $inspection['level_counts']['ERROR']);
        $this->assertSame(1, $inspection['level_counts']['WARNING']);
        $this->assertSame(1, $inspection['level_counts']['INFO']);
        $this->assertSame('WARNING', $inspection['entries'][0]->level);
        $this->assertSame('ERROR', $inspection['entries'][1]->level);
        $this->assertTrue($inspection['entries'][1]->hasContext());
        $this->assertStringContainsString('LeadService', $inspection['entries'][1]->context());
        $this->assertSame('INFO', $inspection['entries'][2]->level);
    }

    public function test_it_searches_message_exception_url_and_class(): void
    {
        $path = $this->directory.DIRECTORY_SEPARATOR.'laravel.log';
        file_put_contents($path, <<<'LOG'
[2026-09-07 10:00:00] testing.INFO: harmless
[2026-09-07 10:01:00] testing.ERROR: App\Exceptions\LeadFailedException: boom
[stacktrace]
#0 /app/Http/Controllers/LeadController.php(40): handle()
url: https://www.ibntech.com/ebooks/cloud-guide
LOG);

        $byException = $this->reader->inspect('laravel.log', search: 'LeadFailedException');
        $byUrl = $this->reader->inspect('laravel.log', search: '/ebooks/cloud-guide');
        $byClass = $this->reader->inspect('laravel.log', search: 'LeadController');
        $byLevel = $this->reader->inspect('laravel.log', levels: ['ERROR']);

        $this->assertSame(1, $byException['matched_count']);
        $this->assertSame(1, $byUrl['matched_count']);
        $this->assertSame(1, $byClass['matched_count']);
        $this->assertSame(1, $byLevel['matched_count']);
        $this->assertSame('ERROR', $byLevel['entries'][0]->level);
    }

    public function test_it_does_not_modify_existing_log_files(): void
    {
        $path = $this->directory.DIRECTORY_SEPARATOR.'laravel.log';
        $contents = "[2026-09-07 10:00:00] testing.ERROR: keep me\n";
        file_put_contents($path, $contents);
        $hash = hash_file('sha256', $path);

        $this->reader->inspect('laravel.log', search: 'keep me');

        $this->assertSame($contents, file_get_contents($path));
        $this->assertSame($hash, hash_file('sha256', $path));
    }

    public function test_it_rejects_path_traversal_and_non_log_files(): void
    {
        $this->assertNull($this->reader->resolvePath('../laravel.log'));
        $this->assertNull($this->reader->resolvePath('..\\..\\windows\\system.ini'));
        $this->assertNull($this->reader->resolvePath('.env'));
        $this->assertNull($this->reader->resolvePath('laravel.txt'));
    }

    public function test_it_scans_only_the_latest_portion_of_a_large_file(): void
    {
        $path = $this->directory.DIRECTORY_SEPARATOR.'laravel-large.log';
        $old = "[2020-01-01 00:00:00] testing.ERROR: ancient-unique-marker\n";
        $padding = str_repeat("ignored padding line\n", 500);
        $recent = "[2026-09-07 12:00:00] testing.ERROR: recent-unique-marker\n";
        file_put_contents($path, $old.$padding.$recent);

        $this->assertGreaterThan(8192, filesize($path));

        $inspection = $this->reader->inspect('laravel-large.log');
        $messages = collect($inspection['entries'])->map(fn ($entry) => $entry->message)->implode("\n");

        $this->assertTrue($inspection['truncated']);
        $this->assertStringContainsString('recent-unique-marker', $messages);
        $this->assertStringNotContainsString('ancient-unique-marker', $messages);
        $this->assertSame($old.$padding.$recent, file_get_contents($path));
    }

    public function test_raw_preview_returns_the_original_tail_without_parsing(): void
    {
        $path = $this->directory.DIRECTORY_SEPARATOR.'laravel.log';
        $contents = "[2026-09-07 10:00:00] testing.INFO: first\nnot-a-header continuation\n[2026-09-07 10:01:00] testing.ERROR: second\n";
        file_put_contents($path, $contents);

        $inspection = $this->reader->inspect('laravel.log', rawLineLimit: 50, includeEntries: false);

        $this->assertStringContainsString('testing.INFO: first', $inspection['raw_preview']);
        $this->assertStringContainsString('not-a-header continuation', $inspection['raw_preview']);
        $this->assertStringContainsString('testing.ERROR: second', $inspection['raw_preview']);
        $this->assertSame(2, $inspection['total_entries']);
        $this->assertSame([], $inspection['entries']);
    }
}
