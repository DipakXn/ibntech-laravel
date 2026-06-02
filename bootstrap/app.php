<?php

use App\Http\Middleware\EnsureTrailingSlash;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withSchedule(function (Schedule $schedule): void {
        if (env('QUEUE_CONNECTION', 'database') === 'database') {
            $schedule
                ->command(sprintf(
                    'queue:monitor %s:%s --max=%d',
                    env('QUEUE_CONNECTION', 'database'),
                    env('DB_QUEUE', 'default'),
                    (int) env('QUEUE_MONITOR_MAX', 100),
                ))
                ->everyMinute();
        }
    })
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(EnsureTrailingSlash::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
