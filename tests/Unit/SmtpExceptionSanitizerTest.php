<?php

namespace Tests\Unit;

use App\Support\Mail\SmtpExceptionSanitizer;
use Tests\TestCase;

class SmtpExceptionSanitizerTest extends TestCase
{
    public function test_it_redacts_credentials_in_smtp_uris_and_explicit_secrets(): void
    {
        $sanitizer = new SmtpExceptionSanitizer;

        $message = $sanitizer->sanitize(
            'Connection to smtp://user:super-secret@mail.example.test:2525 failed with super-secret',
            ['super-secret'],
        );

        $this->assertStringNotContainsString('super-secret', $message);
        $this->assertStringNotContainsString('user:super-secret@', $message);
        $this->assertStringContainsString('smtp://***:***@mail.example.test:2525', $message);
    }
}
