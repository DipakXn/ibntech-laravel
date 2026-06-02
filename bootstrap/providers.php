<?php

$appEnv = $_ENV['APP_ENV'] ?? $_SERVER['APP_ENV'] ?? 'production';

return array_values(array_filter([
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    in_array($appEnv, ['local', 'staging'], true) ? App\Providers\TelescopeServiceProvider::class : null,
]));
