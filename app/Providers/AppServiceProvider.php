<?php

namespace App\Providers;

use App\Services\SeoService;
use App\Services\WebsiteSettingService;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\QueueBusy;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SeoService::class, fn () => new SeoService());
        $this->app->singleton(WebsiteSettingService::class, fn () => new WebsiteSettingService());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layouts.app', 'layouts.landing', 'layouts.header', 'layouts.footer'], function ($view): void {
            try {
                $websiteSettings = app(WebsiteSettingService::class)->get();
            } catch (\Throwable) {
                $websiteSettings = null;
            }

            $view->with('websiteSettings', $websiteSettings);
        });

        View::composer(['layouts.app', 'layouts.landing'], function ($view): void {
            $view->with('seo', app(SeoService::class)->current());
        });

        Event::listen(JobFailed::class, function (JobFailed $event): void {
            Log::error('Queue job failed.', [
                'connection' => $event->connectionName,
                'queue' => $event->job->getQueue(),
                'job' => $event->job->resolveName(),
                'job_id' => $event->job->getJobId(),
                'exception' => $event->exception::class,
                'message' => $event->exception->getMessage(),
            ]);
        });

        Event::listen(QueueBusy::class, function (QueueBusy $event): void {
            Log::warning('Database queue backlog threshold exceeded.', [
                'connection' => $event->connection,
                'queue' => $event->queue,
                'size' => $event->size,
                'threshold' => (int) env('QUEUE_MONITOR_MAX', 100),
            ]);
        });
    }
}
