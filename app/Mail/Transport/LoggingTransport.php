<?php

namespace App\Mail\Transport;

use App\Services\EmailLogService;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\RawMessage;
use Throwable;

class LoggingTransport implements TransportInterface
{
    public function __construct(
        private TransportInterface $inner,
        private EmailLogService $emailLogs,
    ) {}

    public function send(RawMessage $message, ?Envelope $envelope = null): ?SentMessage
    {
        try {
            $sent = $this->inner->send($message, $envelope);

            if ($sent) {
                $this->emailLogs->markSent($message instanceof Email ? $message : $sent->getOriginalMessage());
            }

            return $sent;
        } catch (Throwable $exception) {
            $this->emailLogs->markFailedFromMessage($message, $exception);

            throw $exception;
        }
    }

    public function __toString(): string
    {
        return (string) $this->inner;
    }
}
