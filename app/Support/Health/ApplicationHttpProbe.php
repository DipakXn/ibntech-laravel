<?php

namespace App\Support\Health;

interface ApplicationHttpProbe
{
    public function probe(): ApplicationHttpResult;
}
