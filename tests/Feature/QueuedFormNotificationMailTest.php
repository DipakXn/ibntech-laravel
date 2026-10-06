<?php

namespace Tests\Feature;

use App\Filament\Clusters\SmtpSettings\Pages\TestSmtp;
use App\Jobs\SendCaseStudyThankYouMail;
use App\Jobs\SendEbookThankYouMail;
use App\Jobs\SendLeadSubmissionNotification;
use App\Mail\CaseStudyThankYouMail;
use App\Mail\EbookThankYouMail;
use App\Mail\LeadReceivedMail;
use App\Mail\SmtpTransportBuilder;
use App\Models\EmailLog;
use App\Models\FormNotificationSetting;
use App\Models\Lead;
use App\Models\SmtpSetting;
use App\Models\User;
use App\Models\WebsiteSetting;
use App\Services\EmailLogService;
use App\Services\LeadService;
use App\Services\SmtpSettingService;
use App\Services\WebsiteSettingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Mockery;
use RuntimeException;
use Symfony\Component\Mailer\Envelope as MailerEnvelope;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mime\RawMessage;
use Tests\TestCase;

class QueuedFormNotificationMailTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        Queue::fake();
    }

    public function test_job_processing_listener_is_registered(): void
    {
        $this->assertTrue(Event::hasListeners(JobProcessing::class));
        $this->assertTrue(Event::hasListeners(MessageSending::class));
        $this->assertTrue(Event::hasListeners(MessageSent::class));
        $this->assertCount(1, Event::getRawListeners()[MessageSending::class] ?? []);
        $this->assertCount(1, Event::getRawListeners()[MessageSent::class] ?? []);
    }

    public function test_queued_form_notification_uses_database_smtp_and_from_address(): void
    {
        $this->seedWebsiteDefault('form-admin@example.test');
        $this->bindFakeSmtpTransport(function (SmtpSetting $settings): void {
            $this->assertSame('smtp.db.test', $settings->host);
            $this->assertSame(587, $settings->port);
            $this->assertSame(SmtpSetting::ENCRYPTION_TLS, $settings->encryption);
            $this->assertSame(SmtpSetting::AUTH_LOGIN, $settings->auth_mode);
            $this->assertSame('db-smtp-user', $settings->username);
            $this->assertSame('db-smtp-secret', $settings->password);
        });

        SmtpSetting::factory()->enabled()->create([
            'host' => 'smtp.db.test',
            'port' => 587,
            'encryption' => SmtpSetting::ENCRYPTION_TLS,
            'auth_mode' => SmtpSetting::AUTH_LOGIN,
            'username' => 'db-smtp-user',
            'password' => 'db-smtp-secret',
            'from_email' => 'db-from@example.test',
            'from_name' => 'Database From',
        ]);

        config([
            'mail.default' => 'smtp',
            'mail.from.address' => 'env-from@gmail.com',
            'mail.from.name' => 'Env Gmail',
            'mail.mailers.smtp.host' => 'smtp.gmail.com',
            'mail.mailers.smtp.port' => 587,
        ]);

        $lead = $this->createLead('contact');

        (new SendLeadSubmissionNotification($lead->id))->handle();

        $this->assertSame(SmtpSettingService::MAILER, config('mail.default'));
        $this->assertSame('db-from@example.test', config('mail.from.address'));
        $this->assertSame('Database From', config('mail.from.name'));

        $this->assertSame(1, EmailLog::query()->count());
        $log = EmailLog::query()->first();
        $this->assertNotNull($log);
        $this->assertSame('form-admin@example.test', $log->recipient);
        $this->assertSame('db-from@example.test', $log->from_email);
        $this->assertSame('Database From', $log->from_name);
        $this->assertSame(SmtpSettingService::MAILER, $log->mailer);
        $this->assertSame(EmailLog::STATUS_SENT, $log->status);
        $this->assertStringContainsString('smtp.db.test', (string) $log->connection_summary);
        $this->assertStringContainsString('587', (string) $log->connection_summary);
        $this->assertStringContainsString('tls', (string) $log->connection_summary);
        $this->assertStringContainsString('login', (string) $log->connection_summary);
        $this->assertStringNotContainsString('db-smtp-secret', (string) json_encode($log->toArray()));
        $this->assertStringNotContainsString('password', (string) $log->connection_summary);
    }

    public function test_form_override_controls_the_to_address_for_queued_notifications(): void
    {
        $this->seedWebsiteDefault('form-admin@example.test');
        $this->bindFakeSmtpTransport();
        SmtpSetting::factory()->enabled()->create([
            'from_email' => 'db-from@example.test',
            'from_name' => 'Database From',
        ]);
        FormNotificationSetting::factory()->create([
            'form_name' => 'contact',
            'admin_to' => 'contact-override@example.test',
        ]);

        $lead = $this->createLead('contact');
        (new SendLeadSubmissionNotification($lead->id))->handle();

        $this->assertSame(1, EmailLog::query()->count());
        $this->assertDatabaseHas('email_logs', [
            'recipient' => 'contact-override@example.test',
            'from_email' => 'db-from@example.test',
        ]);
    }

    public function test_disabled_database_smtp_falls_back_to_env_mailer(): void
    {
        $this->seedWebsiteDefault('form-admin@example.test');
        SmtpSetting::factory()->create([
            'is_enabled' => false,
            'from_email' => 'db-from@example.test',
            'from_name' => 'Database From',
        ]);

        config([
            'mail.default' => 'array',
            'mail.from.address' => 'env-from@gmail.com',
            'mail.from.name' => 'Env Gmail',
        ]);

        Mail::fake();

        $lead = $this->createLead('contact');
        (new SendLeadSubmissionNotification($lead->id))->handle();

        $this->assertSame('array', config('mail.default'));
        $this->assertSame('env-from@gmail.com', config('mail.from.address'));

        Mail::assertSent(LeadReceivedMail::class, function (LeadReceivedMail $mail): bool {
            return $mail->hasTo('form-admin@example.test');
        });
    }

    public function test_ebook_and_case_study_user_emails_still_go_to_the_submitter(): void
    {
        Mail::fake();

        $ebookLead = Lead::query()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'form_name' => 'ebook_download',
            'payload' => ['asset_title' => 'Cloud Playbook'],
        ]);
        $caseStudyLead = Lead::query()->create([
            'name' => 'Jane Doe',
            'email' => 'case@example.com',
            'form_name' => 'case_study_download',
            'payload' => ['asset_title' => 'Case Study'],
        ]);

        (new SendEbookThankYouMail($ebookLead->id))->handle();
        (new SendCaseStudyThankYouMail($caseStudyLead->id))->handle();

        Mail::assertSent(EbookThankYouMail::class, fn (EbookThankYouMail $mail): bool => $mail->hasTo('jane@example.com'));
        Mail::assertSent(CaseStudyThankYouMail::class, fn (CaseStudyThankYouMail $mail): bool => $mail->hasTo('case@example.com'));
        Mail::assertNotSent(LeadReceivedMail::class);
    }

    public function test_one_queued_form_notification_creates_exactly_one_email_log(): void
    {
        $this->seedWebsiteDefault('form-admin@example.test');
        $this->bindFakeSmtpTransport();
        SmtpSetting::factory()->enabled()->create([
            'from_email' => 'db-from@example.test',
            'from_name' => 'Database From',
        ]);

        $lead = $this->createLead('contact');
        (new SendLeadSubmissionNotification($lead->id))->handle();

        $this->assertSame(1, EmailLog::query()->count());
        $this->assertSame(EmailLog::STATUS_SENT, EmailLog::query()->value('status'));
    }

    public function test_one_test_smtp_send_creates_exactly_one_email_log(): void
    {
        $this->bindFakeSmtpTransport();
        SmtpSetting::factory()->enabled()->create([
            'from_email' => 'db-from@example.test',
            'from_name' => 'Database From',
        ]);
        app(SmtpSettingService::class)->applyToRuntimeConfig();

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        Livewire::test(TestSmtp::class)
            ->fillForm([
                'recipient' => 'qa@example.test',
                'subject' => 'SMTP uniqueness probe',
                'body' => 'One log only.',
            ])
            ->call('sendTest')
            ->assertHasNoFormErrors();

        $this->assertSame(1, EmailLog::query()->count());
        $this->assertDatabaseHas('email_logs', [
            'subject' => 'SMTP uniqueness probe',
            'recipient' => 'qa@example.test',
            'status' => EmailLog::STATUS_SENT,
            'mailer' => SmtpSettingService::MAILER,
            'from_email' => 'db-from@example.test',
        ]);
    }

    public function test_a_failed_send_creates_exactly_one_failed_email_log(): void
    {
        $this->seedWebsiteDefault('form-admin@example.test');
        $this->bindThrowingSmtpTransport();
        SmtpSetting::factory()->enabled()->create([
            'from_email' => 'db-from@example.test',
            'password' => 'db-smtp-secret',
        ]);

        $lead = $this->createLead('contact');

        try {
            (new SendLeadSubmissionNotification($lead->id))->handle();
            $this->fail('The SMTP send should have failed.');
        } catch (RuntimeException $exception) {
            $this->assertSame('smtp connection refused', $exception->getMessage());
        }

        $this->assertSame(1, EmailLog::query()->count());
        $log = EmailLog::query()->first();
        $this->assertSame(EmailLog::STATUS_FAILED, $log->status);
        $this->assertStringNotContainsString('db-smtp-secret', (string) $log->error_message);
    }

    public function test_resend_creates_exactly_one_additional_email_log(): void
    {
        $this->bindFakeSmtpTransport();
        SmtpSetting::factory()->enabled()->create([
            'from_email' => 'db-from@example.test',
            'from_name' => 'Database From',
        ]);
        app(SmtpSettingService::class)->applyToRuntimeConfig();

        $original = EmailLog::factory()->create([
            'subject' => 'Please resend',
            'html_body' => '<p>Stored body</p>',
        ]);

        $this->assertSame(1, EmailLog::query()->count());

        app(EmailLogService::class)->resend($original);

        $this->assertSame(2, EmailLog::query()->count());
        $this->assertSame(1, EmailLog::query()->where('subject', 'Please resend')->where('id', '!=', $original->id)->count());
    }

    private function bindFakeSmtpTransport(?callable $assertSettings = null): void
    {
        $builder = Mockery::mock(SmtpTransportBuilder::class);
        $builder->shouldReceive('buildFromSettings')
            ->andReturnUsing(function (SmtpSetting $settings) use ($assertSettings) {
                if ($assertSettings !== null) {
                    $assertSettings($settings);
                }

                return $this->fakeEsmtpTransport();
            });

        $this->app->instance(SmtpTransportBuilder::class, $builder);
        $this->app->instance(SmtpSettingService::class, new SmtpSettingService($builder));
        Mail::forgetMailers();
    }

    private function bindThrowingSmtpTransport(): void
    {
        $builder = Mockery::mock(SmtpTransportBuilder::class);
        $builder->shouldReceive('buildFromSettings')
            ->andReturnUsing(function (): EsmtpTransport {
                $transport = Mockery::mock(EsmtpTransport::class);
                $transport->shouldReceive('send')->andThrow(new RuntimeException('smtp connection refused'));
                $transport->shouldReceive('__toString')->andReturn('smtp://mock');

                return $transport;
            });

        $this->app->instance(SmtpTransportBuilder::class, $builder);
        $this->app->instance(SmtpSettingService::class, new SmtpSettingService($builder));
        Mail::forgetMailers();
    }

    private function fakeEsmtpTransport(): EsmtpTransport
    {
        $transport = Mockery::mock(EsmtpTransport::class);
        $transport->shouldReceive('send')
            ->andReturnUsing(function (RawMessage $message, ?MailerEnvelope $envelope = null): SentMessage {
                return new SentMessage($message, $envelope ?? MailerEnvelope::create($message));
            });
        $transport->shouldReceive('__toString')->andReturn('smtp://mock');

        return $transport;
    }

    private function seedWebsiteDefault(string $email): void
    {
        $attributes = app(WebsiteSettingService::class)->defaultAttributes();
        $attributes['form_notification_to'] = $email;

        WebsiteSetting::query()->create($attributes);
        app(WebsiteSettingService::class)->forget();
    }

    private function createLead(string $formName): Lead
    {
        $request = Request::create('https://example.com/contact', 'POST');
        app()->instance('request', $request);

        return app(LeadService::class)->createLead([
            'name' => 'Jane Doe',
            'email' => 'jane@example.test',
            'form_name' => $formName,
        ]);
    }
}
