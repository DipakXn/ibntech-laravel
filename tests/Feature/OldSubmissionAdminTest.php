<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Resources\OldSubmissions\OldSubmissionResource;
use App\Filament\Resources\OldSubmissions\Pages\ListOldSubmissions;
use App\Filament\Resources\OldSubmissions\Pages\ViewOldSubmission;
use App\Models\OldSubmission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class OldSubmissionAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_administrators_can_view_old_submissions_and_cannot_change_them(): void
    {
        $this->withoutVite();

        $record = $this->submission([
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'form_name' => 'Contact Form (abc)',
            'message' => "Hello,\nAP/AR",
            'service' => 'Bookkeeping',
            'lead_source' => 'Organic / SEO',
            'submitted_at' => '2024-05-01 09:30:00',
            'fields' => [
                ['label' => 'Full Name', 'value' => 'Ada Lovelace'],
                ['label' => 'Tell us about your procurement challenges', 'value' => 'Need AP support'],
                ['label' => 'field_f5f1e1b', 'value' => '+19493552088'],
                ['label' => 'Form Name (ID)', 'value' => 'Contact Form (abc)'],
                ['label' => 'User Agent', 'value' => 'Mozilla'],
            ],
        ]);

        $other = $this->submission([
            'external_submission_id' => '99',
            'name' => 'Other Person',
            'email' => 'other@example.com',
            'form_name' => 'Newsletter Form',
            'submitted_at' => '2023-01-15 12:00:00',
            'fields' => [
                ['label' => 'email', 'value' => 'other@example.com'],
            ],
        ]);

        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $this->actingAs($admin);

        $this->assertTrue(OldSubmissionResource::canViewAny());
        $this->assertTrue(OldSubmissionResource::canView($record));
        $this->assertFalse(OldSubmissionResource::canCreate());
        $this->assertFalse(OldSubmissionResource::canEdit($record));
        $this->assertFalse(OldSubmissionResource::canDelete($record));
        $this->assertFalse(OldSubmissionResource::canDeleteAny());
        $this->assertSame('Sales', OldSubmissionResource::getNavigationGroup());
        $this->assertSame('Old Submissions', OldSubmissionResource::getNavigationLabel());

        $this->get('/admin/old-submissions')->assertOk();
        $this->get('/admin/old-submissions/create')->assertNotFound();
        $this->get('/admin/old-submissions/'.$record->getKey().'/edit')->assertNotFound();
        $this->get('/admin/old-submissions/'.$record->getKey())
            ->assertOk()
            ->assertSee('Ada Lovelace')
            ->assertSee('Tell us about your procurement challenges')
            ->assertSee('Need AP support')
            ->assertSee('19493552088')
            ->assertSee('AP/AR');

        Livewire::test(ListOldSubmissions::class)
            ->assertOk()
            ->assertCanSeeTableRecords([$record, $other])
            ->assertTableActionExists('view')
            ->assertTableActionDoesNotExist('edit')
            ->assertTableActionDoesNotExist('delete');

        Livewire::test(ListOldSubmissions::class)
            ->searchTable('+19493552088')
            ->assertCanSeeTableRecords([$record])
            ->assertCanNotSeeTableRecords([$other]);

        Livewire::test(ListOldSubmissions::class)
            ->filterTable('form_name', 'Newsletter Form')
            ->assertCanSeeTableRecords([$other])
            ->assertCanNotSeeTableRecords([$record]);

        Livewire::test(ListOldSubmissions::class)
            ->filterTable('submitted_at', [
                'from' => '2024-05-01',
                'until' => '2024-05-31',
            ])
            ->assertCanSeeTableRecords([$record])
            ->assertCanNotSeeTableRecords([$other]);

        Livewire::test(ViewOldSubmission::class, ['record' => $record->getRouteKey()])
            ->assertOk()
            ->assertActionDoesNotExist('delete')
            ->assertActionDoesNotExist('edit')
            ->assertSee('Contact Form (abc)');
    }

    public function test_guests_authors_and_other_roles_cannot_open_old_submissions(): void
    {
        $record = $this->submission();

        $this->get('/admin/old-submissions')
            ->assertRedirect('/'.Login::ROUTE_PATH);

        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $this->actingAs($author);
        $this->assertFalse(OldSubmissionResource::canViewAny());
        $this->assertFalse(OldSubmissionResource::canView($record));
        $this->get('/admin/old-submissions')->assertForbidden();
        $this->get('/admin/old-submissions/'.$record->getKey())->assertForbidden();

        $subscriber = User::factory()->create(['role' => 'subscriber']);
        $this->actingAs($subscriber);
        $this->assertFalse(OldSubmissionResource::canViewAny());
        $this->get('/admin/old-submissions')->assertForbidden();
        $this->get('/admin/old-submissions/'.$record->getKey())->assertForbidden();
    }

    /**
     * @param  array<string, mixed>  $overrides
     */
    private function submission(array $overrides = []): OldSubmission
    {
        return OldSubmission::query()->create(array_merge([
            'external_submission_id' => '42',
            'form_name' => 'Contact Form (abc)',
            'source_file' => 'contact.csv',
            'submitted_at' => '2024-05-01 09:30:00',
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'phone' => null,
            'company' => null,
            'service' => null,
            'job_title' => null,
            'city' => null,
            'country' => null,
            'message' => 'Hello',
            'page_name' => null,
            'page_id' => null,
            'page_url' => 'https://www.ibntech.com/contact/',
            'lead_source' => null,
            'utm_source' => null,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla',
            'external_user_id' => '0',
            'fields' => [
                ['label' => 'Full Name', 'value' => 'Ada Lovelace'],
            ],
        ], $overrides));
    }
}
