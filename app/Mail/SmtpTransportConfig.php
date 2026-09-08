<?php

namespace App\Mail;

final class SmtpTransportConfig
{
    public function __construct(
        public string $host,
        public int $port,
        public string $encryption,
        public string $authMode,
        public ?string $username = null,
        public ?string $password = null,
    ) {}
}
