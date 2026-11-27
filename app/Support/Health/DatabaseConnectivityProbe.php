<?php

namespace App\Support\Health;

interface DatabaseConnectivityProbe
{
    public function ping(): DatabasePing;
}
