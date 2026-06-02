<?php

declare(strict_types=1);

$config = require base_path('vendor/barryvdh/laravel-debugbar/config/debugbar.php');

$config['enabled'] = env('APP_ENV') === 'local'
    && env('APP_DEBUG', false)
    && env('DEBUGBAR_ENABLED', true);

return $config;
