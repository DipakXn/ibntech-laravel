<?php

namespace Tests\Feature;

use App\Filament\Pages\WebsiteSettings;
use App\Jobs\SendEbookThankYouMail;
use App\Jobs\SendLeadSubmissionNotification;
use App\Mail\EbookThankYouMail;
use App\Mail\LeadReceivedMail;
use App\Models\FormNotificationSetting;
use App\Models\Lead;
use App\Models\SmtpSetting;
use App\Models\User;
use App\Models\WebsiteSetting;
use App\Services\FormNotificationSettingService;
use App\Services\FormRecipientResolver;
use App\Services\LeadService;
use App\Services\SmtpSettingService;
use App\Services\WebsiteSettingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class FormNotificationRecipientTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        Mail::fake();
        Queue::fake();
    }

    public function test_website_settings_default_is_used_when_there_is_no_override(): void
    {
        $this->seedWebsiteDefault('default-admin@example.test');
        config(['mail.lead_notification_to' => 'legacy@example.test']);

        $this->sendQueuedAdminNotification('contact');

        Mail::assertSent(LeadReceivedMail::class, fn (LeadReceivedMail $mail): bool => $mail->hasTo('default-admin@example.test'));
        Mail::assertNotSent(LeadReceivedMail::class, fn (LeadReceivedMail $mail): bool => $mail->hasTo('legacy@example.test'));
    }

    public function test_form_override_wins_over_website_settings_default(): void
    {
        $this->seedWebsiteDefault('default-admin@example.test');
        FormNotificationSetting::factory()->create([
            'form_name' => 'contact',
            'admin_to' => 'contact-override@example.test',
        ]);

        $this->sendQueuedAdminNotification('contact');
        $this->sendQueuedAdminNotification('newsletter_inquiry');

        Mail::assertSent(LeadReceivedMail::class, fn (LeadReceivedMail $mail): bool => $mail->hasTo('contact-override@example.test'));
        Mail::assertSent(LeadReceivedMail::class, fn (LeadReceivedMail $mail): bool => $mail->hasTo('default-admin@example.test'));
    }

    public function test_blank_override_falls_back_to_website_settings_default(): void
    {
        $this->seedWebsiteDefault('default-admin@example.test');
        app(FormNotificationSettingService::class)->sync([
            [
                'form_name' => 'contact',
                'admin_to' => '',
            ],
        ]);

        $this->assertDatabaseMissing('form_notification_settings', [
            'form_name' => 'contact',
        ]);

        $this->assertSame(
            'default-admin@example.test',
            app(FormRecipientResolver::class)->adminTo('contact'),
        );
    }

    public function test_legacy_env_recipient_is_used_when_website_default_is_empty(): void
    {
        $this->seedWebsiteDefault(null);
        config([
            'mail.lead_notification_to' => 'legacy@example.test',
            'mail.from.address' => 'from@example.test',
        ]);

        $this->assertSame('legacy@example.test', app(FormRecipientResolver::class)->adminTo('contact'));
    }

    public function test_from_address_is_used_when_no_other_recipient_is_configured(): void
    {
        $this->seedWebsiteDefault(null);
        config([
            'mail.lead_notification_to' => null,
            'mail.from.address' => 'from@example.test',
        ]);

        $this->assertSame('from@example.test', app(FormRecipientResolver::class)->adminTo('contact'));
    }

    public function test_queued_job_resolves_the_recipient_at_execution_time(): void
    {
        $this->seedWebsiteDefault('queued-old@example.test');

        Queue::fake();

        $lead = $this->createLead('contact');

        Queue::assertPushed(
            SendLeadSubmissionNotification::class,
            fn (SendLeadSubmissionNotification $job): bool => $job->submissionId === $lead->id && $job->recipient === null,
        );
        Mail::assertNothingSent();

        WebsiteSetting::query()->first()->update([
            'form_notification_to' => 'queued-new@example.test',
        ]);
        app(WebsiteSettingService::class)->forget();

        (new SendLeadSubmissionNotification($lead->id))->handle();

        Mail::assertSent(LeadReceivedMail::class, fn (LeadReceivedMail $mail): bool => $mail->hasTo('queued-new@example.test'));
        Mail::assertNotSent(LeadReceivedMail::class, fn (LeadReceivedMail $mail): bool => $mail->hasTo('queued-old@example.test'));
    }

    public function test_website_default_beats_smtp_legacy_lead_notification_to(): void
    {
        $this->seedWebsiteDefault('website-admin@example.test');
        SmtpSetting::factory()->enabled()->create([
            'lead_notification_to' => 'smtp-legacy@example.test',
        ]);
        app(SmtpSettingService::class)->applyToRuntimeConfig();

        $this->assertSame('website-admin@example.test', app(FormRecipientResolver::class)->adminTo('contact'));
    }

    public function test_ebook_thank_you_still_goes_to_the_submitter(): void
    {
        $this->seedWebsiteDefault('default-admin@example.test');

        $lead = Lead::query()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'form_name' => 'ebook_download',
            'page_url' => 'https://example.com/ebook/cloud-playbook',
            'payload' => [
                'asset_type' => 'ebook',
                'asset_title' => 'Cloud Playbook',
            ],
        ]);

        (new SendEbookThankYouMail($lead->id))->handle();

        Mail::assertSent(EbookThankYouMail::class, fn (EbookThankYouMail $mail): bool => $mail->hasTo('jane@example.com'));
        Mail::assertNotQueued(LeadReceivedMail::class);
    }

    public function test_administrator_can_save_default_and_form_overrides(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        $defaults = app(WebsiteSettingService::class)->defaultAttributes();

        Livewire::test(WebsiteSettings::class)
            ->fillForm([
                ...$defaults,
                'form_notification_to' => 'settings-admin@example.test',
                'form_notification_overrides' => [
                    [
                        'form_name' => 'contact',
                        'admin_to' => 'contact-desk@example.test',
                    ],
                    [
                        'form_name' => 'ebook_download',
                        'admin_to' => '',
                    ],
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame(
            'settings-admin@example.test',
            WebsiteSetting::query()->value('form_notification_to'),
        );
        $this->assertDatabaseHas('form_notification_settings', [
            'form_name' => 'contact',
            'admin_to' => 'contact-desk@example.test',
        ]);
        $this->assertDatabaseMissing('form_notification_settings', [
            'form_name' => 'ebook_download',
        ]);
    }

    private function seedWebsiteDefault(?string $email): void
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

    private function sendQueuedAdminNotification(string $formName): void
    {
        $lead = $this->createLead($formName);

        (new SendLeadSubmissionNotification($lead->id))->handle();
    }
}
