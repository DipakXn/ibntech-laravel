<?php

namespace App\Support\Health;

interface TlsCertificateProbe
{
    public function probe(string $host, int $port): TlsCertificateResult;
}
