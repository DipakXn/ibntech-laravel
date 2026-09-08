<?php

namespace Database\Factories;

use App\Models\EmailLog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<EmailLog>
 */
class EmailLogFactory extends Factory
{
    protected $model = EmailLog::class;

    public function definition(): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'subject' => 'Test subject',
            'recipient' => 'recipient@example.test',
            'recipients' => [
                'to' => ['recipient@example.test'],
                'cc' => [],
                'bcc' => [],
            ],
            'from_email' => 'noreply@example.test',
            'from_name' => 'IBNTECH',
            'status' => EmailLog::STATUS_SENT,
            'mailer' => 'array',
            'connection_summary' => 'array',
            'error_message' => null,
            'html_body' => '<p>Hello</p>',
            'text_body' => 'Hello',
            'context' => null,
            'sent_at' => now(),
        ];
    }

    public function failed(): static
    {
        return $this->state(fn (): array => [
            'status' => EmailLog::STATUS_FAILED,
            'error_message' => 'Connection refused',
            'sent_at' => null,
        ]);
    }

    public function withoutBody(): static
    {
        return $this->state(fn (): array => [
            'html_body' => null,
            'text_body' => null,
        ]);
    }
}
