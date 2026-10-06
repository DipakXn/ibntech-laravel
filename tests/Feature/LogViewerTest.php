<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Pages\LogViewer;
use App\Models\User;
use App\Support\Logs\LaravelLogReader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LogViewerTest extends TestCase
{
    use RefreshDatabase;

    private string $directory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();

        $this->directory = sys_get_temp_dir().DIRECTORY_SEPARATOR.'ibn-log-viewer-'.bin2hex(random_bytes(8));
        mkdir($this->directory);
        $this->app->instance(LaravelLogReader::class, new LaravelLogReader($this->directory, maxScanBytes: 8192));
    }

    protected function tearDown(): void
    {
        foreach (glob($this->directory.DIRECTORY_SEPARATOR.'*') ?: [] as $file) {
            unlink($file);
        }

        if (is_dir($this->directory)) {
            rmdir($this->directory);
        }

        parent::tearDown();
    }

    public function test_guests_cannot_access_the_log_viewer(): void
    {
        $this->get('/admin/log-viewer')
            ->assertRedirect('/'.Login::ROUTE_PATH);
    }

    public function test_authors_cannot_access_the_log_viewer(): void
    {
        $author = User::factory()->create([
            'role' => User::ROLE_AUTHOR,
        ]);

        $this->actingAs($author)
            ->get('/admin/log-viewer')
            ->assertForbidden();
    }

    public function test_administrators_can_open_existing_log_files_and_use_filters(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        file_put_contents($this->directory.DIRECTORY_SEPARATOR.'laravel-2026-09-07.log', <<<'LOG'
[2026-09-07 09:00:00] testing.INFO: Newsletter sent for /newsletters/september
[2026-09-07 09:05:00] testing.ERROR: App\Exceptions\PaymentFailedException: card declined
[stacktrace]
#0 /app/Services/LeadService.php(88): charge()
[2026-09-07 09:10:00] testing.WARNING: Retry scheduled
LOG);

        $this->actingAs($admin);

        Livewire::test(LogViewer::class)
            ->assertOk()
            ->assertSee('laravel-2026-09-07.log')
            ->assertSee('Parsed')
            ->assertSee('Raw log')
            ->assertSee('PaymentFailedException')
            ->assertSee('Newsletter sent')
            ->set('search', 'PaymentFailedException')
            ->assertSee('PaymentFailedException')
            ->assertDontSee('Newsletter sent')
            ->call('clearFilters')
            ->call('toggleLevel', 'WARNING')
            ->assertSee('Retry scheduled')
            ->assertDontSee('PaymentFailedException')
            ->call('setViewMode', 'raw')
            ->assertSee('Showing the last')
            ->assertSee('[2026-09-07 09:00:00] testing.INFO: Newsletter sent');
    }

    public function test_large_log_responses_do_not_include_the_unscanned_portion(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $old = "[2020-01-01 00:00:00] testing.ERROR: ancient-browser-marker\n";
        $padding = str_repeat("padding-line-should-not-flood-the-browser\n", 250);
        $recent = "[2026-09-07 12:00:00] testing.ERROR: recent-browser-marker\n";
        file_put_contents($this->directory.DIRECTORY_SEPARATOR.'laravel-large.log', $old.$padding.$recent);

        $this->actingAs($admin);

        Livewire::test(LogViewer::class)
            ->assertOk()
            ->call('selectFile', 'laravel-large.log')
            ->assertSee('recent-browser-marker')
            ->assertDontSee('ancient-browser-marker')
            ->call('setViewMode', 'raw')
            ->assertSee('recent-browser-marker');
    }
}
