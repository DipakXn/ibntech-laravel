<?php

namespace App\Services;

use App\Mail\OutgoingMailLogTracker;
use App\Mail\StoredEmailResendMail;
use App\Models\EmailLog;
use App\Support\Mail\SmtpExceptionSanitizer;
use Illuminate\Support\Facades\Mail;
use RuntimeException;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\RawMessage;
use Throwable;

class EmailLogService
{
    public function __construct(
        private OutgoingMailLogTracker $tracker,
        private SmtpExceptionSanitizer $sanitizer,
        private SmtpSettingService $smtpSettings,
    ) {}

    public function recordSending(Email $message, array $context = []): ?EmailLog
    {
        try {
            $recipients = $this->addresses($message->getTo());
            $html = $this->truncate((string) $message->getHtmlBody());
            $text = $this->truncate((string) $message->getTextBody());

            $from = $message->getFrom()[0] ?? null;

            $log = EmailLog::query()->create([
                'subject' => $this->truncate((string) $message->getSubject(), 255),
                'recipient' => implode(', ', $recipients),
                'recipients' => [
                    'to' => $recipients,
                    'cc' => $this->addresses($message->getCc()),
                    'bcc' => $this->addresses($message->getBcc()),
                ],
                'from_email' => $from?->getAddress(),
                'from_name' => $from?->getName() ?: null,
                'status' => EmailLog::STATUS_PENDING,
                'mailer' => config('mail.default'),
                'connection_summary' => $this->smtpSettings->connectionSummary(),
                'html_body' => $html !== '' ? $html : null,
                'text_body' => $text !== '' ? $text : null,
                'context' => $context !== [] ? $context : null,
            ]);

            $this->tracker->remember($message, $log);

            return $log;
        } catch (Throwable) {
            return null;
        }
    }

    public function markSent(object $message): void
    {
        try {
            $log = $this->tracker->pull($message);

            if (! $log) {
                return;
            }

            $log->forceFill([
                'status' => EmailLog::STATUS_SENT,
                'sent_at' => now(),
                'error_message' => null,
            ])->save();
        } catch (Throwable) {
            // Logging must never break sending.
        }
    }

    public function markFailedFromMessage(RawMessage $message, Throwable $exception): void
    {
        try {
            $log = $this->tracker->peek($message) ?? $this->tracker->pull($message);

            if (! $log) {
                $log = EmailLog::query()->create([
                    'subject' => $message instanceof Email ? $this->truncate((string) $message->getSubject(), 255) : null,
                    'recipient' => $message instanceof Email ? implode(', ', $this->addresses($message->getTo())) : null,
                    'status' => EmailLog::STATUS_FAILED,
                    'mailer' => config('mail.default'),
                    'connection_summary' => $this->smtpSettings->connectionSummary(),
                    'error_message' => $this->sanitizeError($exception),
                ]);

                return;
            }

            $log->forceFill([
                'status' => EmailLog::STATUS_FAILED,
                'error_message' => $this->sanitizeError($exception),
            ])->save();
        } catch (Throwable) {
            // Logging must never hide the original mail exception.
        }
    }

    public function resend(EmailLog $log): void
    {
        if (! $log->canResend()) {
            throw new RuntimeException('This email cannot be reconstructed safely for resend.');
        }

        Mail::to($log->recipientList())->send(new StoredEmailResendMail($log));
    }

    public function sanitizeError(Throwable $exception): string
    {
        return $this->truncate(
            $this->sanitizer->sanitize($exception->getMessage(), $this->smtpSettings->secretsToRedact()),
            2000,
        );
    }

    /**
     * @param  list<Address>  $addresses
     * @return list<string>
     */
    private function addresses(array $addresses): array
    {
        return array_values(array_map(
            fn (Address $address): string => $address->getAddress(),
            $addresses,
        ));
    }

    private function truncate(?string $value, int $max = EmailLog::MAX_BODY_LENGTH): string
    {
        $value ??= '';

        if (mb_strlen($value) <= $max) {
            return $value;
        }

        return mb_substr($value, 0, $max);
    }
}
