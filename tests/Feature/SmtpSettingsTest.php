<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Clusters\SmtpSettings\Pages\SmtpConfiguration;
use App\Filament\Clusters\SmtpSettings\Pages\TestSmtp;
use App\Filament\Clusters\SmtpSettings\Resources\EmailLogs\Pages\ListEmailLogs;
use App\Filament\Widgets\AdminQuickActionsWidget;
use App\Jobs\SendLeadSubmissionNotification;
use App\Mail\LeadReceivedMail;
use App\Mail\SmtpTestMail;
use App\Mail\StoredEmailResendMail;
use App\Models\EmailLog;
use App\Models\SmtpSetting;
use App\Models\User;
use App\Services\EmailLogService;
use App\Services\LeadService;
use App\Services\SmtpSettingService;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mockery;
use RuntimeException;
use Symfony\Component\Mime\Email;
use Tests\TestCase;

class SmtpSettingsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_smtp_configuration_route_is_registered_and_dashboard_can_link_to_it(): void
    {
        $this->assertTrue(Route::has(SmtpConfiguration::getRouteName()));
        $this->assertSame(
            'http://localhost/admin/smtp-settings/configuration',
            SmtpConfiguration::getUrl(),
        );

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        Livewire::actingAs($admin)
            ->test(AdminQuickActionsWidget::class)
            ->assertSee('SMTP settings')
            ->assertSee('/admin/smtp-settings/configuration', false);
    }

    public function test_guests_cannot_access_smtp_settings(): void
    {
        $this->get('/admin/smtp-settings/configuration')
            ->assertRedirect('/'.Login::ROUTE_PATH);
        $this->get('/admin/smtp-settings/test')
            ->assertRedirect('/'.Login::ROUTE_PATH);
        $this->get('/admin/smtp-settings/email-logs')
            ->assertRedirect('/'.Login::ROUTE_PATH);
    }

    public function test_authors_cannot_access_smtp_settings(): void
    {
        $author = User::factory()->create([
            'role' => User::ROLE_AUTHOR,
        ]);

        $this->actingAs($author)
            ->get('/admin/smtp-settings/configuration')
            ->assertForbidden();
        $this->actingAs($author)
            ->get('/admin/smtp-settings/test')
            ->assertForbidden();
        $this->actingAs($author)
            ->get('/admin/smtp-settings/email-logs')
            ->assertForbidden();
    }

    public function test_administrator_can_save_encrypted_smtp_settings(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        Livewire::test(SmtpConfiguration::class)
            ->fillForm([
                'is_enabled' => true,
                'host' => 'smtp.custom.test',
                'port' => 2525,
                'encryption' => SmtpSetting::ENCRYPTION_NONE,
                'auth_mode' => SmtpSetting::AUTH_CRAM_MD5,
                'username' => 'smtp-user',
                'password' => 'plain-smtp-password',
                'from_email' => 'noreply@example.test',
                'from_name' => 'IBNTECH',
                'lead_notification_to' => 'leads@example.test',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $settings = SmtpSetting::query()->first();

        $this->assertTrue($settings->is_enabled);
        $this->assertSame('smtp.custom.test', $settings->host);
        $this->assertSame(2525, $settings->port);
        $this->assertSame('plain-smtp-password', $settings->password);
        $this->assertNotSame('plain-smtp-password', $settings->getAttributes()['password']);
        $this->assertSame(SmtpSettingService::MAILER, config('mail.default'));
        $this->assertSame('leads@example.test', config('mail.lead_notification_to'));

        $html = Livewire::test(SmtpConfiguration::class)
            ->assertSet('data.username', 'smtp-user')
            ->assertSet('data.password', 'plain-smtp-password')
            ->html();
        $this->assertStringContainsString('smtp-user', $html);
    }

    public function test_disabled_settings_keep_the_environment_mail_fallback(): void
    {
        config([
            'mail.default' => 'array',
            'mail.lead_notification_to' => 'env-leads@example.test',
        ]);

        SmtpSetting::factory()->create([
            'is_enabled' => false,
            'lead_notification_to' => 'db-leads@example.test',
        ]);

        $service = app(SmtpSettingService::class);
        $service->applyToRuntimeConfig();

        $this->assertSame('array', config('mail.default'));
        $this->assertSame('env-leads@example.test', config('mail.lead_notification_to'));

        SmtpSetting::query()->first()->update(['is_enabled' => true]);
        $service->applyToRuntimeConfig();

        $this->assertSame(SmtpSettingService::MAILER, config('mail.default'));
        $this->assertSame('db-leads@example.test', config('mail.lead_notification_to'));

        SmtpSetting::query()->first()->update(['is_enabled' => false]);
        $service->applyToRuntimeConfig();

        $this->assertSame('array', config('mail.default'));
        $this->assertSame('env-leads@example.test', config('mail.lead_notification_to'));
    }

    public function test_queue_workers_reapply_enabled_smtp_settings(): void
    {
        SmtpSetting::factory()->enabled()->create([
            'lead_notification_to' => 'worker-leads@example.test',
        ]);

        config([
            'mail.default' => 'array',
            'mail.lead_notification_to' => 'env-leads@example.test',
        ]);

        $job = Mockery::mock(Job::class);
        $job->shouldReceive('payload')->andReturn([]);

        Event::dispatch(new JobProcessing('sync', $job));

        $this->assertSame(SmtpSettingService::MAILER, config('mail.default'));
        $this->assertSame('worker-leads@example.test', config('mail.lead_notification_to'));
    }

    public function test_lead_notifications_use_database_recipient_when_smtp_is_enabled(): void
    {
        SmtpSetting::factory()->enabled()->create([
            'lead_notification_to' => 'db-leads@example.test',
        ]);
        app(SmtpSettingService::class)->applyToRuntimeConfig();

        Mail::fake();
        Queue::fake();

        $request = Request::create('https://example.com/contact', 'POST');
        app()->instance('request', $request);

        $lead = app(LeadService::class)->createLead([
            'name' => 'Jane Doe',
            'email' => 'jane@example.test',
            'form_name' => 'contact',
        ]);

        Queue::assertPushed(
            SendLeadSubmissionNotification::class,
            fn (SendLeadSubmissionNotification $job): bool => $job->submissionId === $lead->id && $job->recipient === null,
        );
        Mail::assertNothingSent();

        (new SendLeadSubmissionNotification($lead->id))->handle();

        Mail::assertQueued(LeadReceivedMail::class, function (LeadReceivedMail $mail): bool {
            return $mail->hasTo('db-leads@example.test');
        });
    }

    public function test_administrator_can_send_a_test_email_without_exposing_the_password(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        SmtpSetting::factory()->enabled()->create([
            'password' => 'must-not-appear',
        ]);

        Mail::fake();

        $this->actingAs($admin);

        Livewire::test(TestSmtp::class)
            ->fillForm([
                'recipient' => 'qa@example.test',
                'subject' => 'SMTP probe',
                'body' => 'Hello from the test tool.',
            ])
            ->call('sendTest')
            ->assertHasNoFormErrors()
            ->assertNotified();

        Mail::assertSent(SmtpTestMail::class, function (SmtpTestMail $mail): bool {
            return $mail->testSubject === 'SMTP probe'
                && $mail->hasTo('qa@example.test');
        });

        $html = Livewire::test(TestSmtp::class)->html();
        $this->assertStringNotContainsString('must-not-appear', $html);
    }

    public function test_outgoing_mail_is_written_to_email_logs(): void
    {
        Mail::to('logged@example.test')->send(new SmtpTestMail('Logged subject', 'Logged body'));

        $this->assertDatabaseHas('email_logs', [
            'subject' => 'Logged subject',
            'recipient' => 'logged@example.test',
            'status' => EmailLog::STATUS_SENT,
        ]);

        $log = EmailLog::query()->first();
        $this->assertNotNull($log->html_body);
        $this->assertStringNotContainsString('password', (string) $log->connection_summary);
        $this->assertNull($log->error_message);
    }

    public function test_email_logs_are_marked_sent_when_the_symfony_message_is_cloned(): void
    {
        $original = (new Email)
            ->to('clone@example.test')
            ->subject('Clone subject')
            ->text('Body');

        app(EmailLogService::class)->recordSending($original);
        app(EmailLogService::class)->markSent(clone $original);

        $this->assertDatabaseHas('email_logs', [
            'subject' => 'Clone subject',
            'recipient' => 'clone@example.test',
            'status' => EmailLog::STATUS_SENT,
        ]);
    }

    public function test_failed_mail_errors_are_sanitized_in_email_logs(): void
    {
        $settings = SmtpSetting::factory()->enabled()->create([
            'password' => 'leaked-secret',
        ]);

        $message = new Email;
        $message->to('fail@example.test')->subject('Fail')->text('Body');

        $exception = new RuntimeException('smtp://user:leaked-secret@smtp.custom.test:2525 failed');

        app(EmailLogService::class)->markFailedFromMessage($message, $exception);

        $log = EmailLog::query()->latest('id')->first();
        $this->assertSame(EmailLog::STATUS_FAILED, $log->status);
        $this->assertStringNotContainsString('leaked-secret', (string) $log->error_message);
        $this->assertStringNotContainsString($settings->password, (string) $log->error_message);
    }

    public function test_resend_reconstructs_stored_content_and_skips_emails_without_bodies(): void
    {
        Mail::fake();

        $log = EmailLog::factory()->create([
            'subject' => 'Please resend',
            'html_body' => '<p>Stored body</p>',
        ]);

        app(EmailLogService::class)->resend($log);

        Mail::assertSent(StoredEmailResendMail::class, function (StoredEmailResendMail $mail) use ($log): bool {
            return $mail->log->is($log) && $mail->hasTo('recipient@example.test');
        });

        $this->expectException(RuntimeException::class);
        app(EmailLogService::class)->resend(EmailLog::factory()->withoutBody()->create());
    }

    public function test_administrator_can_view_email_logs(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);
        EmailLog::factory()->create(['subject' => 'Visible log subject']);

        $this->actingAs($admin)
            ->get('/admin/smtp-settings/email-logs')
            ->assertOk();

        Livewire::actingAs($admin)
            ->test(ListEmailLogs::class)
            ->assertCanSeeTableRecords(EmailLog::all());
    }

    public function test_password_is_never_stored_on_email_logs(): void
    {
        SmtpSetting::factory()->enabled()->create([
            'password' => 'db-smtp-password',
        ]);

        $columns = DB::getSchemaBuilder()->getColumnListing('email_logs');
        $this->assertNotContains('password', $columns);

        Mail::to('logged@example.test')->send(new SmtpTestMail('No secrets', 'Body'));

        $payload = json_encode(EmailLog::query()->first()->toArray());
        $this->assertStringNotContainsString('db-smtp-password', (string) $payload);
    }
}
