<?php

namespace App\Support\Health;

use RuntimeException;

final class OffOriginRedirect extends RuntimeException
{
    public function __construct(public readonly int $httpStatus)
    {
        parent::__construct('The website redirected away from the application URL.');
    }
}
