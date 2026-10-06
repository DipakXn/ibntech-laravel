<?php

namespace Tests\Unit;

use App\Mail\SmtpTransportBuilder;
use App\Mail\SmtpTransportConfig;
use App\Models\SmtpSetting;
use ReflectionProperty;
use Symfony\Component\Mailer\Transport\Smtp\Auth\CramMd5Authenticator;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Tests\TestCase;

class SmtpTransportBuilderTest extends TestCase
{
    public function test_it_builds_plain_smtp_on_port_2525_with_cram_md5_and_auto_tls_disabled(): void
    {
        $builder = new SmtpTransportBuilder;
        $config = new SmtpTransportConfig(
            host: 'smtp.custom.test',
            port: 2525,
            encryption: SmtpSetting::ENCRYPTION_NONE,
            authMode: SmtpSetting::AUTH_CRAM_MD5,
            username: 'smtp-user',
            password: 'smtp-secret',
        );

        $transport = $builder->build($config);

        $this->assertInstanceOf(EsmtpTransport::class, $transport);
        $this->assertSame('smtp', $builder->scheme($config->encryption));
        $this->assertSame(2525, $transport->getStream()->getPort());
        $this->assertSame('smtp.custom.test', $transport->getStream()->getHost());
        $this->assertFalse($transport->isAutoTls());
        $this->assertFalse($transport->getStream()->isTLS());
        $this->assertSame('smtp-user', $transport->getUsername());

        $authenticators = $this->authenticators($transport);

        $this->assertCount(1, $authenticators);
        $this->assertInstanceOf(CramMd5Authenticator::class, $authenticators[0]);
        $this->assertSame('CRAM-MD5', $authenticators[0]->getAuthKeyword());
    }

    public function test_tls_enables_auto_tls_without_implicit_ssl(): void
    {
        $builder = new SmtpTransportBuilder;
        $transport = $builder->build(new SmtpTransportConfig(
            host: 'smtp.example.test',
            port: 587,
            encryption: SmtpSetting::ENCRYPTION_TLS,
            authMode: SmtpSetting::AUTH_AUTO,
        ));

        $this->assertSame('smtp', $builder->scheme(SmtpSetting::ENCRYPTION_TLS));
        $this->assertTrue($transport->isAutoTls());
        $this->assertFalse($transport->getStream()->isTLS());
    }

    public function test_ssl_uses_smtps_implicit_tls(): void
    {
        $builder = new SmtpTransportBuilder;
        $transport = $builder->build(new SmtpTransportConfig(
            host: 'smtp.example.test',
            port: 465,
            encryption: SmtpSetting::ENCRYPTION_SSL,
            authMode: SmtpSetting::AUTH_NONE,
        ));

        $this->assertSame('smtps', $builder->scheme(SmtpSetting::ENCRYPTION_SSL));
        $this->assertFalse($transport->isAutoTls());
        $this->assertTrue($transport->getStream()->isTLS());
        $this->assertSame([], $this->authenticators($transport));
        $this->assertSame('', $transport->getUsername());
    }

    /**
     * @return list<object>
     */
    private function authenticators(EsmtpTransport $transport): array
    {
        $property = new ReflectionProperty(EsmtpTransport::class, 'authenticators');

        return $property->getValue($transport);
    }
}
