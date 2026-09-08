<?php

namespace App\Models;

use Database\Factories\EmailLogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EmailLog extends Model
{
    /** @use HasFactory<EmailLogFactory> */
    use HasFactory;

    public const STATUS_PENDING = 'pending';

    public const STATUS_SENT = 'sent';

    public const STATUS_FAILED = 'failed';

    public const MAX_BODY_LENGTH = 200000;

    protected $fillable = [
        'uuid',
        'subject',
        'recipient',
        'recipients',
        'from_email',
        'from_name',
        'status',
        'mailer',
        'connection_summary',
        'error_message',
        'html_body',
        'text_body',
        'context',
        'sent_at',
    ];

    protected function casts(): array
    {
        return [
            'recipients' => 'array',
            'context' => 'array',
            'sent_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (EmailLog $log): void {
            $log->uuid ??= (string) Str::uuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function canResend(): bool
    {
        if (! filled($this->recipient)) {
            return false;
        }

        if (! in_array($this->status, [self::STATUS_SENT, self::STATUS_FAILED], true)) {
            return false;
        }

        return filled($this->html_body) || filled($this->text_body);
    }

    /**
     * @return list<string>
     */
    public function recipientList(): array
    {
        $stored = data_get($this->recipients, 'to', []);

        if (is_array($stored) && $stored !== []) {
            return array_values(array_filter($stored, fn (mixed $address): bool => is_string($address) && $address !== ''));
        }

        return array_values(array_filter(array_map('trim', explode(',', (string) $this->recipient))));
    }
}
