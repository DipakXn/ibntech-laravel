<?php

namespace Tests\Feature;

use App\Filament\Resources\Leads\Pages\ListLeads;
use App\Filament\Resources\Leads\Pages\ViewLead;
use App\Models\Lead;
use App\Models\User;
use App\Services\Leads\SubmissionCsvExporter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Livewire\Livewire;
use Tests\TestCase;

class SubmissionAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_list_hides_spam_submissions(): void
    {
        $this->withoutVite();

        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $inbox = Lead::query()->create($this->leadAttributes(['email' => 'inbox@example.com']));
        $spam = Lead::query()->create($this->leadAttributes([
            'email' => 'spam@example.com',
            'status' => Lead::STATUS_SPAM,
        ]));

        $this->actingAs($admin);

        Livewire::test(ListLeads::class)
            ->assertOk()
            ->assertCanSeeTableRecords([$inbox])
            ->assertCanNotSeeTableRecords([$spam]);

        Livewire::test(ListLeads::class)
            ->filterTable('status', ['value' => Lead::STATUS_SPAM])
            ->assertCanSeeTableRecords([$spam])
            ->assertCanNotSeeTableRecords([$inbox]);
    }

    public function test_spam_can_be_marked_from_the_detail_view(): void
    {
        $this->withoutVite();

        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $lead = Lead::query()->create($this->leadAttributes());

        $this->actingAs($admin);

        Livewire::test(ViewLead::class, ['record' => $lead->getRouteKey()])
            ->assertOk()
            ->assertSee($lead->page_url)
            ->assertSee('Submitted')
            ->callAction('markSpam')
            ->assertNotified();

        $lead->refresh();
        $this->assertSame(Lead::STATUS_SPAM, $lead->status);
    }

    public function test_csv_export_respects_table_filters(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-06-15 12:00:00'));

        $match = Lead::query()->create($this->leadAttributes([
            'form_name' => 'contact',
            'created_at' => '2026-06-10 09:00:00',
        ]));

        Lead::query()->create($this->leadAttributes([
            'form_name' => 'lead',
            'email' => 'other@example.com',
            'created_at' => '2026-06-10 09:00:00',
        ]));

        Lead::query()->create($this->leadAttributes([
            'form_name' => 'contact',
            'email' => 'spam@example.com',
            'status' => Lead::STATUS_SPAM,
            'created_at' => '2026-06-10 09:00:00',
        ]));

        $query = Lead::query()
            ->where('form_name', 'contact')
            ->where('status', '!=', Lead::STATUS_SPAM);

        $response = app(SubmissionCsvExporter::class)->download($query);
        $contents = $this->readStreamedResponse($response);

        $this->assertStringContainsString('contact', $contents);
        $this->assertStringContainsString($match->email, $contents);
        $this->assertStringNotContainsString('other@example.com', $contents);
        $this->assertStringNotContainsString('spam@example.com', $contents);
    }

    public function test_date_and_search_filters_work_on_the_submissions_table(): void
    {
        $this->withoutVite();

        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);

        $match = Lead::query()->create($this->leadAttributes([
            'company' => 'Unique Widget Co',
        ]));
        $match->forceFill(['created_at' => '2026-06-12 15:00:00'])->save();

        $other = Lead::query()->create($this->leadAttributes([
            'email' => 'older@example.com',
            'company' => 'Older Corp',
        ]));
        $other->forceFill(['created_at' => '2026-06-01 10:00:00'])->save();

        $this->actingAs($admin);

        Livewire::test(ListLeads::class)
            ->filterTable('created_at', [
                'from' => '2026-06-10',
                'until' => '2026-06-15',
            ])
            ->assertCanSeeTableRecords([$match])
            ->assertCanNotSeeTableRecords([$other]);

        Livewire::test(ListLeads::class)
            ->searchTable('Unique Widget')
            ->assertCanSeeTableRecords([$match])
            ->assertCanNotSeeTableRecords([$other]);
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private function leadAttributes(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'form_name' => 'contact',
            'message' => 'Hello there',
            'page_url' => 'https://www.example.test/contact/',
            'status' => Lead::STATUS_NEW,
            'payload' => [],
        ], $overrides);
    }

    private function readStreamedResponse(\Symfony\Component\HttpFoundation\StreamedResponse $response): string
    {
        ob_start();
        $response->sendContent();

        return (string) ob_get_clean();
    }
}