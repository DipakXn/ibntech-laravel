<?php

namespace App\Support\Mail;

class SmtpExceptionSanitizer
{
    /**
     * @param  list<string|null>  $secrets
     */
    public function sanitize(?string $message, array $secrets = []): string
    {
        if ($message === null || $message === '') {
            return '';
        }

        $sanitized = preg_replace('~([a-z][a-z0-9+.-]*://)([^:/?#\s]+):([^@/\s]+)@~i', '$1***:***@', $message) ?? $message;

        foreach ($secrets as $secret) {
            if (! is_string($secret) || $secret === '') {
                continue;
            }

            $sanitized = str_replace($secret, '***', $sanitized);
        }

        return $sanitized;
    }
}
