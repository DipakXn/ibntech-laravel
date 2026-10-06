<?php

namespace App\Mail;

use App\Models\SmtpSetting;
use InvalidArgumentException;
use Symfony\Component\Mailer\Transport\Smtp\Auth\AuthenticatorInterface;
use Symfony\Component\Mailer\Transport\Smtp\Auth\CramMd5Authenticator;
use Symfony\Component\Mailer\Transport\Smtp\Auth\LoginAuthenticator;
use Symfony\Component\Mailer\Transport\Smtp\Auth\PlainAuthenticator;
use Symfony\Component\Mailer\Transport\Smtp\Auth\XOAuth2Authenticator;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class SmtpTransportBuilder
{
    public function buildFromSettings(SmtpSetting $settings): EsmtpTransport
    {
        return $this->build($settings->toTransportConfig());
    }

    public function build(SmtpTransportConfig $config): EsmtpTransport
    {
        $host = trim($config->host);

        if ($host === '') {
            throw new InvalidArgumentException('SMTP host is required.');
        }

        if ($config->port < 1 || $config->port > 65535) {
            throw new InvalidArgumentException('SMTP port must be between 1 and 65535.');
        }

        $scheme = $this->scheme($config->encryption);
        $autoTls = $this->autoTls($config->encryption);
        $tls = $scheme === 'smtps' ? true : ($autoTls ? null : false);

        $transport = new EsmtpTransport($host, $config->port, $tls);
        $transport->setAutoTls($autoTls);

        $authenticators = $this->authenticatorsFor($config->authMode);

        if ($authenticators !== null) {
            $transport->setAuthenticators($authenticators);
        }

        if ($config->authMode !== SmtpSetting::AUTH_NONE && filled($config->username)) {
            $transport->setUsername($config->username);
            $transport->setPassword((string) $config->password);
        }

        return $transport;
    }

    public function scheme(string $encryption): string
    {
        return $encryption === SmtpSetting::ENCRYPTION_SSL ? 'smtps' : 'smtp';
    }

    public function autoTls(string $encryption): bool
    {
        return $encryption === SmtpSetting::ENCRYPTION_TLS;
    }

    /**
     * @return list<AuthenticatorInterface>|null Null means Auto: keep Symfony's default authenticators.
     */
    public function authenticatorsFor(string $authMode): ?array
    {
        return match ($authMode) {
            SmtpSetting::AUTH_AUTO => null,
            SmtpSetting::AUTH_NONE => [],
            SmtpSetting::AUTH_LOGIN => [new LoginAuthenticator],
            SmtpSetting::AUTH_PLAIN => [new PlainAuthenticator],
            SmtpSetting::AUTH_CRAM_MD5 => [new CramMd5Authenticator],
            SmtpSetting::AUTH_XOAUTH2 => [new XOAuth2Authenticator],
            default => throw new InvalidArgumentException('Unsupported SMTP authentication mode.'),
        };
    }
}
