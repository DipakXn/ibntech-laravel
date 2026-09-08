<?php

namespace App\Providers;

use App\Listeners\MarkOutgoingEmailSent;
use App\Listeners\RecordOutgoingEmail;
use App\Mail\OutgoingMailLogTracker;
use App\Routing\UrlGenerator;
use App\Services\EmailLogService;
use App\Services\SeoService;
use App\Services\SmtpSettingService;
use App\Services\WebsiteSettingService;
use App\Support\Mail\SmtpExceptionSanitizer;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Queue\Events\QueueBusy;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('url', function ($app) {
            $routes = $app['router']->getRoutes();
            $app->instance('routes', $routes);

            return new UrlGenerator(
                $routes,
                $app->rebinding('request', function ($app, $request) {
                    $app['url']->setRequest($request);
                }),
                $app['config']['app.asset_url']
            );
        });

        $this->app->singleton(SeoService::class, fn () => new SeoService);
        $this->app->singleton(WebsiteSettingService::class, fn () => new WebsiteSettingService);
        $this->app->singleton(OutgoingMailLogTracker::class);
        $this->app->singleton(SmtpSettingService::class);
        $this->app->singleton(EmailLogService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Mail::extend(SmtpSettingService::TRANSPORT, function () {
            return app(SmtpSettingService::class)->createConfiguredTransport();
        });

        try {
            app(SmtpSettingService::class)->applyToRuntimeConfig();
        } catch (\Throwable) {
            // SMTP settings table may not exist yet during early setup.
        }

        Event::listen(MessageSending::class, RecordOutgoingEmail::class);
        Event::listen(MessageSent::class, MarkOutgoingEmailSent::class);
        Event::listen(JobProcessing::class, function (): void {
            try {
                app(SmtpSettingService::class)->applyToRuntimeConfig();
            } catch (\Throwable) {
                // Keep queue workers running even if SMTP settings cannot be loaded.
            }
        });

        // Filament Content Builder RichEditor state is TipTap JSON. Nested lists
        // produce Livewire paths deeper than the default payload.max_nesting_depth.
        config(['livewire.payload.max_nesting_depth' => 50]);

        View::composer(['layouts.app', 'layouts.landing', 'layouts.header', 'layouts.footer', 'newsletters.partials.footer'], function ($view): void {
            try {
                $websiteSettings = app(WebsiteSettingService::class)->get();
            } catch (\Throwable) {
                $websiteSettings = null;
            }

            $view->with('websiteSettings', $websiteSettings);
        });

        View::composer(['layouts.app', 'layouts.landing'], function ($view): void {
            $view->with('seo', app(SeoService::class)->current());
            $view->with('cmsPreview', (bool) request()->attributes->get('cmsPreview', false));
        });

        Event::listen(JobFailed::class, function (JobFailed $event): void {
            Log::error('Queue job failed.', [
                'connection' => $event->connectionName,
                'queue' => $event->job->getQueue(),
                'job' => $event->job->resolveName(),
                'job_id' => $event->job->getJobId(),
                'exception' => $event->exception::class,
                'message' => app(SmtpExceptionSanitizer::class)->sanitize($event->exception->getMessage()),
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
