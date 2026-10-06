<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\OldSubmission;
use App\Services\OldSubmissions\OldSubmissionImporter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class OldSubmissionImportTest extends TestCase
{
    use RefreshDatabase;

    private string $directory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->directory = sys_get_temp_dir().DIRECTORY_SEPARATOR.'old-submissions-'.bin2hex(random_bytes(4));
        File::ensureDirectoryExists($this->directory);
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->directory);

        parent::tearDown();
    }

    public function test_import_is_idempotent_and_does_not_modify_csv_files_or_live_submissions(): void
    {
        $path = $this->directory.DIRECTORY_SEPARATOR.'contact.csv';
        $contents = "\xEF\xBB\xBF\"Full Name\",\"Business Email \",\"Sevices\",\"Message\",Form Name (ID),Submission ID,Created At,User ID,User Agent,User IP,Referrer\n"
            ."\"Ada\",\"ada@example.com\",\"AP\\/AR Automation\",\"Hello,\\r\\nPlease ignore\",\" Contact Form (abc)\",42,2024-05-01 09:30:00,0,Mozilla,127.0.0.1,https://www.ibntech.com/contact/\n";
        file_put_contents($path, $contents);
        $hash = hash_file('sha256', $path);

        $duplicate = $this->directory.DIRECTORY_SEPARATOR.'duplicate.csv';
        file_put_contents($duplicate, "name,email,Form Name (ID),Submission ID,Created At,User IP,Referrer\nSecond,second@example.com,Other,42,2024-06-01 00:00:00,1.1.1.1,https://www.ibntech.com/\n");

        $opaque = $this->directory.DIRECTORY_SEPARATOR.'opaque.csv';
        file_put_contents($opaque, "name,email,field_f5f1e1b,message,Form Name (ID),Submission ID,Created At,User IP,Referrer\nJessica,jessica@example.com,+19493552088,Need bookkeeping,(1c4caf4),389,2025-01-22 07:54:29,174.67.238.236,https://www.ibntech.com/finance/\n");

        $narrative = $this->directory.DIRECTORY_SEPARATOR.'narrative.csv';
        file_put_contents($narrative, "\"Full Name*\",\"Email Address*\",\"Tell us about your procurement challenges\",,false,Form Name (ID),Submission ID,Created At,User IP,Referrer\nTest,testing@test.com,This is a test message.,on,,404-Assistance-Form (1c9a5de),1469,2026-03-31 15:57:17,203.192.220.44,https://www.ibntech.com/fgfdg\n");

        $invalid = $this->directory.DIRECTORY_SEPARATOR.'invalid.csv';
        file_put_contents($invalid, "name,Form Name (ID),Submission ID,Created At,User IP,Referrer\nBad,Contact,,not-a-date,127.0.0.1,https://www.ibntech.com/\n");

        $this->assertSame(0, Lead::query()->count());

        $first = app(OldSubmissionImporter::class)->import($this->directory);
        $this->assertSame(5, $first->files);
        $this->assertSame(3, $first->created);
        $this->assertSame(1, $first->skipped);
        $this->assertSame(1, $first->failed);
        $this->assertSame(3, OldSubmission::query()->count());
        $this->assertSame(0, Lead::query()->count());
        $this->assertSame($hash, hash_file('sha256', $path));
        $this->assertSame($contents, file_get_contents($path));

        $ada = OldSubmission::query()->where('external_submission_id', '42')->first();
        $this->assertNotNull($ada);
        $this->assertSame('Ada', $ada->name);
        $this->assertSame('ada@example.com', $ada->email);
        $this->assertSame('AP/AR Automation', $ada->service);
        $this->assertSame("Hello,\nPlease ignore", $ada->message);
        $this->assertSame('Contact Form (abc)', $ada->form_name);
        $this->assertSame('https://www.ibntech.com/contact/', $ada->page_url);
        $this->assertSame('2024-05-01 09:30:00', $ada->submitted_at?->format('Y-m-d H:i:s'));

        $jessica = OldSubmission::query()->where('external_submission_id', '389')->first();
        $this->assertNotNull($jessica);
        $this->assertNull($jessica->phone);
        $this->assertSame('+19493552088', collect($jessica->fields)->firstWhere('label', 'field_f5f1e1b')['value']);

        $assistance = OldSubmission::query()->where('external_submission_id', '1469')->first();
        $this->assertNotNull($assistance);
        $this->assertSame('This is a test message.', $assistance->message);
        $this->assertSame('on', collect($assistance->fields)->firstWhere('label', '')['value']);

        $second = app(OldSubmissionImporter::class)->import($this->directory);
        $this->assertSame(0, $second->created);
        $this->assertSame(4, $second->skipped);
        $this->assertSame(3, OldSubmission::query()->count());
        $this->assertSame('Ada', OldSubmission::query()->where('external_submission_id', '42')->value('name'));
        $this->assertSame($hash, hash_file('sha256', $path));
    }

    public function test_dry_run_does_not_write_records(): void
    {
        $path = $this->directory.DIRECTORY_SEPARATOR.'email-only.csv';
        file_put_contents($path, "email,Form Name (ID),Submission ID,Created At,User IP,Referrer\nnews@example.com,(5ecdc9fb),2,2024-10-10 17:26:13,203.192.220.44,https://www.ibntech.com/\n");

        $report = app(OldSubmissionImporter::class)->import($path, true);

        $this->assertSame(1, $report->created);
        $this->assertSame(0, OldSubmission::query()->count());
    }

    public function test_artisan_command_imports_from_a_directory(): void
    {
        $path = $this->directory.DIRECTORY_SEPARATOR.'email-only.csv';
        file_put_contents($path, "email,Form Name (ID),Submission ID,Created At,User IP,Referrer\nnews@example.com,(5ecdc9fb),2,2024-10-10 17:26:13,203.192.220.44,https://www.ibntech.com/\n");

        $exit = Artisan::call('old-submissions:import', ['path' => $this->directory]);

        $this->assertSame(0, $exit);
        $this->assertDatabaseHas('old_submissions', [
            'external_submission_id' => '2',
            'email' => 'news@example.com',
            'name' => null,
            'form_name' => '(5ecdc9fb)',
        ]);
    }

    public function test_unknown_form_headers_are_preserved_when_elementor_id_and_date_exist(): void
    {
        $path = $this->directory.DIRECTORY_SEPARATOR.'future-form.csv';
        file_put_contents($path, "Brand New Question,Preferred Stack,Form Name (ID),Submission ID,Created At,User IP,Referrer\nNeed a custom dashboard,Laravel,Future Form (abc),9001,2026-10-01 13:12:03,127.0.0.1,https://www.ibntech.com/future/\n");

        $report = app(OldSubmissionImporter::class)->import($this->directory);

        $this->assertSame(1, $report->created);
        $this->assertSame(0, $report->failed);

        $record = OldSubmission::query()->where('external_submission_id', '9001')->first();
        $this->assertNotNull($record);
        $this->assertSame('Future Form (abc)', $record->form_name);
        $this->assertTrue(collect($record->fields)->contains(
            fn (array $field): bool => $field['label'] === 'Brand New Question' && $field['value'] === 'Need a custom dashboard',
        ));
        $this->assertTrue(collect($record->fields)->contains(
            fn (array $field): bool => $field['label'] === 'Preferred Stack' && $field['value'] === 'Laravel',
        ));
    }

    public function test_real_elementor_exports_import_once_without_changing_the_files(): void
    {
        $directory = storage_path('app/old-submissions');

        if (! is_dir($directory)) {
            $this->markTestSkipped('Historical CSV directory is not present.');
        }

        $files = collect(File::files($directory))
            ->filter(fn ($file): bool => strtolower($file->getExtension()) === 'csv')
            ->values();

        if ($files->isEmpty()) {
            $this->markTestSkipped('Historical CSV directory has no CSV files.');
        }

        $hashes = [];
        foreach ($files as $file) {
            $hashes[$file->getFilename()] = hash_file('sha256', $file->getPathname());
        }

        $first = app(OldSubmissionImporter::class)->import($directory);

        $this->assertSame($files->count(), $first->files);
        $this->assertSame(0, $first->failed);
        $this->assertSame($first->rows, $first->created);
        $this->assertSame(0, $first->skipped);
        $this->assertSame($first->created, OldSubmission::query()->count());
        $this->assertSame(0, Lead::query()->count());

        $sample = OldSubmission::query()->where('external_submission_id', '389')->first();
        $this->assertNotNull($sample);
        $this->assertSame('Jessica Monroe', $sample->name);
        $this->assertSame('monroelawcpa@gmail.com', $sample->email);
        $this->assertNull($sample->phone);
        $this->assertTrue(collect($sample->fields)->contains(fn (array $field): bool => $field['label'] === 'field_f5f1e1b' && $field['value'] === '+19493552088'));

        $second = app(OldSubmissionImporter::class)->import($directory);
        $this->assertSame(0, $second->created);
        $this->assertSame($first->created, $second->skipped);
        $this->assertSame($first->created, OldSubmission::query()->count());

        foreach ($files as $file) {
            $this->assertSame($hashes[$file->getFilename()], hash_file('sha256', $file->getPathname()));
        }
    }
}
