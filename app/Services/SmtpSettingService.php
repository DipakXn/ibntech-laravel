<?php

namespace App\Services;

use App\Mail\SmtpTransportBuilder;
use App\Mail\Transport\LoggingTransport;
use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Throwable;

class SmtpSettingService
{
    public const MAILER = 'database_smtp';

    public const TRANSPORT = 'ibntech_smtp';

    /**
     * @var array<string, mixed>|null
     */
    private ?array $fallbackMailConfig = null;

    private bool $databaseMailerActive = false;

    public function __construct(
        private SmtpTransportBuilder $transportBuilder,
    ) {}

    public function get(): ?SmtpSetting
    {
        if (! $this->tableExists()) {
            return null;
        }

        return SmtpSetting::query()->first();
    }

    public function enabledSettings(): ?SmtpSetting
    {
        $settings = $this->get();

        if (! $settings?->is_enabled) {
            return null;
        }

        return $settings;
    }

    public function isEnabled(): bool
    {
        return $this->enabledSettings() !== null;
    }

    /**
     * @return array<string, mixed>
     */
    public function defaultAttributes(): array
    {
        return [
            'is_enabled' => false,
            'host' => config('mail.mailers.smtp.host'),
            'port' => (int) config('mail.mailers.smtp.port', 2525),
            'encryption' => SmtpSetting::ENCRYPTION_NONE,
            'auth_mode' => SmtpSetting::AUTH_AUTO,
            'username' => config('mail.mailers.smtp.username'),
            'from_email' => config('mail.from.address'),
            'from_name' => config('mail.from.name'),
            'lead_notification_to' => config('mail.lead_notification_to'),
        ];
    }

    public function applyToRuntimeConfig(): void
    {
        $settings = $this->enabledSettings();

        if (! $settings) {
            $this->restoreFallback();
            $this->purgeMailers();

            return;
        }

        $this->rememberFallback();
        $this->databaseMailerActive = true;

        config([
            'mail.mailers.'.self::MAILER => [
                'transport' => self::TRANSPORT,
            ],
            'mail.default' => self::MAILER,
            'mail.from.address' => $settings->from_email ?: $this->fallbackMailConfig['from.address'] ?? config('mail.from.address'),
            'mail.from.name' => $settings->from_name ?: $this->fallbackMailConfig['from.name'] ?? config('mail.from.name'),
        ]);

        if (filled($settings->lead_notification_to)) {
            config(['mail.lead_notification_to' => $settings->lead_notification_to]);
        } else {
            config(['mail.lead_notification_to' => $this->fallbackMailConfig['lead_notification_to'] ?? config('mail.lead_notification_to')]);
        }

        $this->purgeMailers();
    }

    public function createConfiguredTransport(): LoggingTransport
    {
        $settings = $this->enabledSettings();

        if (! $settings) {
            throw new \RuntimeException('Database SMTP settings are not enabled.');
        }

        return new LoggingTransport(
            $this->transportBuilder->buildFromSettings($settings),
            app(EmailLogService::class),
        );
    }

    public function connectionSummary(): string
    {
        $settings = $this->enabledSettings();

        if ($settings) {
            return sprintf(
                'smtp://%s:%d (%s, %s)',
                $settings->host,
                $settings->port,
                $settings->encryption,
                $settings->auth_mode,
            );
        }

        $default = (string) config('mail.default');
        $host = config('mail.mailers.smtp.host');
        $port = config('mail.mailers.smtp.port');

        if ($default === 'smtp' && filled($host)) {
            return sprintf('smtp://%s:%s (env)', $host, $port);
        }

        return $default !== '' ? $default : 'default';
    }

    /**
     * @return list<string|null>
     */
    public function secretsToRedact(): array
    {
        $settings = $this->get();

        return array_values(array_filter([
            $settings?->password,
            config('mail.mailers.smtp.password'),
        ], fn (mixed $secret): bool => is_string($secret) && $secret !== ''));
    }

    private function rememberFallback(): void
    {
        if ($this->fallbackMailConfig !== null) {
            return;
        }

        $this->fallbackMailConfig = [
            'default' => config('mail.default'),
            'from.address' => config('mail.from.address'),
            'from.name' => config('mail.from.name'),
            'lead_notification_to' => config('mail.lead_notification_to'),
        ];
    }

    private function restoreFallback(): void
    {
        if (! $this->databaseMailerActive || $this->fallbackMailConfig === null) {
            $this->databaseMailerActive = false;

            return;
        }

        config([
            'mail.default' => $this->fallbackMailConfig['default'],
            'mail.from.address' => $this->fallbackMailConfig['from.address'],
            'mail.from.name' => $this->fallbackMailConfig['from.name'],
            'mail.lead_notification_to' => $this->fallbackMailConfig['lead_notification_to'],
        ]);

        $this->databaseMailerActive = false;
    }

    private function purgeMailers(): void
    {
        if (! app()->resolved('mail.manager')) {
            return;
        }

        try {
            Mail::purge(self::MAILER);
            Mail::purge();
            Mail::forgetMailers();
        } catch (Throwable) {
            // Mail manager may not be ready during early boot.
        }
    }

    private function tableExists(): bool
    {
        try {
            return Schema::hasTable('smtp_settings');
        } catch (Throwable) {
            return false;
        }
    }
}
