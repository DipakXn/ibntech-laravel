<?php

namespace Tests\Feature;

use App\Rules\ReCaptcha;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ReCaptchaRuleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['services.recaptcha.secret_key' => 'test-secret-key']);
    }

    public function test_it_passes_when_recaptcha_is_valid(): void
    {
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response(['success' => true]),
        ]);

        $rule = new ReCaptcha();
        $passed = true;

        $rule->validate('recaptchaToken', 'valid-token', function (string $message) use (&$passed) {
            $passed = false;
        });

        $this->assertTrue($passed);
    }

    public function test_it_fails_when_recaptcha_token_is_missing(): void
    {
        $rule = new ReCaptcha();
        $passed = true;
        $errorMessage = '';

        $rule->validate('recaptchaToken', '', function (string $message) use (&$passed, &$errorMessage) {
            $passed = false;
            $errorMessage = $message;
        });

        $this->assertFalse($passed);
        $this->assertSame('The reCAPTCHA verification is required.', $errorMessage);
    }

    public function test_it_fails_when_api_returns_success_false(): void
    {
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response(['success' => false]),
        ]);

        $rule = new ReCaptcha();
        $passed = true;
        $errorMessage = '';

        $rule->validate('recaptchaToken', 'invalid-token', function (string $message) use (&$passed, &$errorMessage) {
            $passed = false;
            $errorMessage = $message;
        });

        $this->assertFalse($passed);
        $this->assertSame('The reCAPTCHA verification failed. Please try again.', $errorMessage);
    }

    public function test_it_fails_when_api_request_fails(): void
    {
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response(null, 500),
        ]);

        $rule = new ReCaptcha();
        $passed = true;
        $errorMessage = '';

        $rule->validate('recaptchaToken', 'some-token', function (string $message) use (&$passed, &$errorMessage) {
            $passed = false;
            $errorMessage = $message;
        });

        $this->assertFalse($passed);
        $this->assertSame('The reCAPTCHA verification failed. Please try again.', $errorMessage);
    }
}
