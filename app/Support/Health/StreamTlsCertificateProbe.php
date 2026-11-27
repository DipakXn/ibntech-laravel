<?php

namespace App\Support\Health;

class StreamTlsCertificateProbe implements TlsCertificateProbe
{
    public const TIMEOUT_SECONDS = 3;

    /**
     * @return array{ssl: array<string, bool|string>}
     */
    public function contextOptions(string $host): array
    {
        return [
            'ssl' => [
                'capture_peer_cert' => true,
                'verify_peer' => true,
                'verify_peer_name' => true,
                'allow_self_signed' => false,
                'peer_name' => $host,
                'SNI_enabled' => true,
                'SNI_server_name' => $host,
            ],
        ];
    }

    public function probe(string $host, int $port): TlsCertificateResult
    {
        $host = strtolower(trim($host));

        if (str_starts_with($host, '[') && str_ends_with($host, ']')) {
            $host = substr($host, 1, -1);
        }

        if (filter_var($host, FILTER_VALIDATE_IP) || ! preg_match('/^[a-z0-9.-]+$/', $host)) {
            return new TlsCertificateResult('skipped');
        }

        return $this->inspect($host, $port);
    }

    protected function inspect(string $host, int $port): TlsCertificateResult
    {
        $started = hrtime(true);
        $errno = 0;
        $error = '';
        $socket = @stream_socket_client(
            'ssl://'.$host.':'.$port,
            $errno,
            $error,
            self::TIMEOUT_SECONDS,
            STREAM_CLIENT_CONNECT,
            stream_context_create($this->contextOptions($host)),
        );
        $milliseconds = (int) ((hrtime(true) - $started) / 1_000_000);

        if (! is_resource($socket)) {
            return new TlsCertificateResult('failed', null, $milliseconds);
        }

        $params = stream_context_get_params($socket);
        fclose($socket);

        $certificate = $params['options']['ssl']['peer_certificate'] ?? null;
        $parsed = (is_object($certificate) || is_resource($certificate))
            ? openssl_x509_parse($certificate)
            : false;

        if (! is_array($parsed) || ! isset($parsed['validTo_time_t'])) {
            return new TlsCertificateResult('failed', null, $milliseconds);
        }

        return new TlsCertificateResult('verified', (int) $parsed['validTo_time_t'], $milliseconds);
    }
}
