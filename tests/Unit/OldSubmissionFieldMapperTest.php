<?php

namespace Tests\Unit;

use App\Services\OldSubmissions\ElementorCsvReader;
use App\Services\OldSubmissions\OldSubmissionFieldMapper;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OldSubmissionFieldMapperTest extends TestCase
{
    #[Test]
    public function it_normalizes_elementor_header_variants(): void
    {
        $mapper = new OldSubmissionFieldMapper;

        $this->assertSame('full name', OldSubmissionFieldMapper::normalizeLabel("\xEF\xBB\xBF\"Full Name\""));
        $this->assertSame('business email', OldSubmissionFieldMapper::normalizeLabel('Business Email :'));
        $this->assertSame('email address', OldSubmissionFieldMapper::normalizeLabel('Email Address*'));
        $this->assertSame('name', OldSubmissionFieldMapper::normalizeLabel('Name :'));
        $this->assertSame('how can we help', OldSubmissionFieldMapper::normalizeLabel('How can we help?'));

        $mapped = $mapper->map([
            ['label' => 'Full Name*', 'value' => 'Ada Lovelace'],
            ['label' => 'Email Address*', 'value' => 'ada@example.com'],
            ['label' => 'Tell us about your procurement challenges', 'value' => 'Need AP support'],
            ['label' => '', 'value' => 'on'],
            ['label' => 'false', 'value' => ''],
            ['label' => 'Form Name (ID)', 'value' => ' 404-Assistance-Form (1c9a5de)'],
            ['label' => 'Submission ID', 'value' => '1469'],
            ['label' => 'Created At', 'value' => '2026-03-31 15:57:17'],
            ['label' => 'User ID', 'value' => '1'],
            ['label' => 'User Agent', 'value' => 'Mozilla'],
            ['label' => 'User IP', 'value' => '203.192.220.44'],
            ['label' => 'Referrer', 'value' => 'https://www.ibntech.com/contact'],
        ], 'assistance.csv');

        $this->assertArrayNotHasKey('error', $mapped);
        $this->assertSame('Ada Lovelace', $mapped['attributes']['name']);
        $this->assertSame('ada@example.com', $mapped['attributes']['email']);
        $this->assertSame('Need AP support', $mapped['attributes']['message']);
        $this->assertSame('404-Assistance-Form (1c9a5de)', $mapped['attributes']['form_name']);
        $this->assertNull($mapped['attributes']['phone']);
    }

    #[Test]
    public function it_decodes_elementor_export_escapes_without_guessing_field_ids(): void
    {
        $this->assertSame("Hello,\nAP/AR", OldSubmissionFieldMapper::decodeValue('Hello,\\r\\nAP\\/AR'));

        $mapped = (new OldSubmissionFieldMapper)->map([
            ['label' => 'name', 'value' => 'Jessica'],
            ['label' => 'email', 'value' => 'jessica@example.com'],
            ['label' => 'field_f5f1e1b', 'value' => '+19493552088'],
            ['label' => 'message', 'value' => 'Need bookkeeping'],
            ['label' => 'Form Name (ID)', 'value' => '(1c4caf4)'],
            ['label' => 'Submission ID', 'value' => '389'],
            ['label' => 'Created At', 'value' => '2025-01-22 07:54:29'],
            ['label' => 'User IP', 'value' => '174.67.238.236'],
            ['label' => 'Referrer', 'value' => 'https://www.ibntech.com/finance-and-accounting-services/'],
        ], 'opaque.csv');

        $this->assertNull($mapped['attributes']['phone']);
        $this->assertSame('+19493552088', $mapped['attributes']['fields'][2]['value']);
        $this->assertSame('Need bookkeeping', $mapped['attributes']['message']);
    }

    #[Test]
    public function it_rejects_invalid_dates_and_missing_submission_ids(): void
    {
        $mapper = new OldSubmissionFieldMapper;
        $base = [
            ['label' => 'name', 'value' => 'Ada'],
            ['label' => 'Form Name (ID)', 'value' => 'Contact'],
            ['label' => 'User IP', 'value' => '127.0.0.1'],
        ];

        $missingId = $mapper->map([
            ...$base,
            ['label' => 'Created At', 'value' => '2024-01-02 03:04:05'],
        ], 'missing.csv');
        $this->assertSame('missing submission id', $missingId['error']);

        $badDate = $mapper->map([
            ...$base,
            ['label' => 'Submission ID', 'value' => '9'],
            ['label' => 'Created At', 'value' => '03/31/2026'],
        ], 'date.csv');
        $this->assertStringContainsString('invalid submission date', $badDate['error']);
    }

    #[Test]
    public function it_reads_a_bom_prefixed_csv_without_writing_the_file(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'old-sub');
        $this->assertNotFalse($path);

        $before = hash('sha256', "\xEF\xBB\xBF\"Full Name\",\"Message\",Form Name (ID),Submission ID,Created At,User IP,Referrer\n\"Ada\",\"Hello,\\r\\nAP\\/AR\",Contact,7,2024-05-01 09:30:00,127.0.0.1,https://www.ibntech.com/contact/\n");
        file_put_contents($path, "\xEF\xBB\xBF\"Full Name\",\"Message\",Form Name (ID),Submission ID,Created At,User IP,Referrer\n\"Ada\",\"Hello,\\r\\nAP\\/AR\",Contact,7,2024-05-01 09:30:00,127.0.0.1,https://www.ibntech.com/contact/\n");

        $rows = iterator_to_array((new ElementorCsvReader)->rows($path));

        $this->assertSame($before, hash_file('sha256', $path));
        $this->assertCount(1, $rows);
        $this->assertSame('Full Name', $rows[0][0]['label']);
        $this->assertSame("Hello,\nAP/AR", $rows[0][1]['value']);

        unlink($path);
    }

    #[Test]
    public function it_keeps_escaped_quotes_inside_a_message_field(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'old-sub');
        $this->assertNotFalse($path);

        $csv = <<<'CSV'
"Full Name","Message",Form Name (ID),Submission ID,Created At,User IP,Referrer
"Bella","\"Hi,\r\nSee https:\/\/example.com\"","Payroll Form (c43baef)",794,"2025-12-08 17:31:00","122.161.110.100","https://www.ibntech.com/payroll-processing/"
CSV;
        file_put_contents($path, $csv);

        $rows = iterator_to_array((new ElementorCsvReader)->rows($path));
        unlink($path);

        $this->assertCount(1, $rows);
        $this->assertSame('Bella', $rows[0][0]['value']);
        $this->assertSame("\"Hi,\nSee https://example.com\"", $rows[0][1]['value']);
        $this->assertSame('794', $rows[0][3]['value']);
        $this->assertSame('2025-12-08 17:31:00', $rows[0][4]['value']);
    }
}
