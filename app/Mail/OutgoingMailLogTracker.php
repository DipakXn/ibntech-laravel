<?php

namespace App\Mail;

use App\Models\EmailLog;
use Symfony\Component\Mime\Email;

class OutgoingMailLogTracker
{
    /**
     * @var array<int, int>
     */
    private array $logIds = [];

    /**
     * @var array<string, int>
     */
    private array $fingerprints = [];

    public function remember(object $message, EmailLog $log): void
    {
        $this->logIds[spl_object_id($message)] = $log->getKey();
        $this->fingerprints[$this->fingerprint($message)] = $log->getKey();
    }

    public function pull(object $message): ?EmailLog
    {
        $id = $this->logIds[spl_object_id($message)] ?? $this->fingerprints[$this->fingerprint($message)] ?? null;
        unset($this->logIds[spl_object_id($message)], $this->fingerprints[$this->fingerprint($message)]);

        if ($id === null) {
            return $this->latestPending($message);
        }

        return EmailLog::query()->find($id);
    }

    public function peek(object $message): ?EmailLog
    {
        $id = $this->logIds[spl_object_id($message)] ?? $this->fingerprints[$this->fingerprint($message)] ?? null;

        if ($id === null) {
            return $this->latestPending($message);
        }

        return EmailLog::query()->find($id);
    }

    private function fingerprint(object $message): string
    {
        if (! $message instanceof Email) {
            return 'object:'.spl_object_id($message);
        }

        $recipients = implode(',', array_map(
            fn ($address): string => $address->getAddress(),
            $message->getTo(),
        ));

        return strtolower(trim((string) $message->getSubject()).'|'.$recipients);
    }

    private function latestPending(object $message): ?EmailLog
    {
        if (! $message instanceof Email) {
            return null;
        }

        $recipients = implode(', ', array_map(
            fn ($address): string => $address->getAddress(),
            $message->getTo(),
        ));

        return EmailLog::query()
            ->where('status', EmailLog::STATUS_PENDING)
            ->where('subject', (string) $message->getSubject())
            ->where('recipient', $recipients)
            ->latest('id')
            ->first();
    }
}
