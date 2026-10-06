<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Resources\AnalyticsExcludedIps\AnalyticsExcludedIpResource;
use App\Filament\Resources\AnalyticsExcludedIps\Pages\CreateAnalyticsExcludedIp;
use App\Filament\Resources\AnalyticsExcludedIps\Pages\EditAnalyticsExcludedIp;
use App\Filament\Resources\AnalyticsExcludedIps\Pages\ListAnalyticsExcludedIps;
use App\Models\AnalyticsExcludedIp;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ExcludedIpAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_guests_and_authors_cannot_manage_excluded_ips(): void
    {
        $record = AnalyticsExcludedIp::query()->create([
            'ip_address' => '127.0.0.1',
            'description' => 'Localhost',
            'is_enabled' => true,
        ]);

        $this->get('/admin/excluded-ips')->assertRedirect('/'.Login::ROUTE_PATH);

        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);
        $this->actingAs($author);

        $this->assertFalse(AnalyticsExcludedIpResource::canViewAny());
        $this->assertFalse(AnalyticsExcludedIpResource::canCreate());
        $this->assertFalse(AnalyticsExcludedIpResource::canEdit($record));
        $this->assertFalse(AnalyticsExcludedIpResource::canDelete($record));

        $this->get('/admin/excluded-ips')->assertForbidden();
        $this->get('/admin/excluded-ips/create')->assertForbidden();
        $this->get('/admin/excluded-ips/'.$record->getKey().'/edit')->assertForbidden();
    }

    public function test_administrators_can_add_edit_disable_and_delete_exclusions(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $this->actingAs($admin);

        $this->assertTrue(AnalyticsExcludedIpResource::canViewAny());
        $this->assertSame('Administration', AnalyticsExcludedIpResource::getNavigationGroup());

        Livewire::test(CreateAnalyticsExcludedIp::class)
            ->fillForm([
                'ip_address' => '203.0.113.10/24',
                'description' => 'Example range',
                'is_enabled' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $record = AnalyticsExcludedIp::query()->first();
        $this->assertNotNull($record);
        $this->assertSame('203.0.113.0/24', $record->ip_address);
        $this->assertSame('Example range', $record->description);
        $this->assertTrue($record->is_enabled);

        Livewire::test(CreateAnalyticsExcludedIp::class)
            ->fillForm([
                'ip_address' => '999.1.1.1',
                'description' => 'Invalid',
                'is_enabled' => true,
            ])
            ->call('create')
            ->assertHasFormErrors(['ip_address']);

        $this->assertSame(1, AnalyticsExcludedIp::query()->count());

        Livewire::test(ListAnalyticsExcludedIps::class)
            ->assertOk()
            ->assertCanSeeTableRecords([$record])
            ->assertSee('203.0.113.0/24')
            ->assertSee('Example range');

        Livewire::test(EditAnalyticsExcludedIp::class, ['record' => $record->getKey()])
            ->fillForm([
                'ip_address' => '114.143.174.98',
                'description' => 'Current office',
                'is_enabled' => false,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $record->refresh();
        $this->assertSame('114.143.174.98', $record->ip_address);
        $this->assertSame('Current office', $record->description);
        $this->assertFalse($record->is_enabled);

        Livewire::test(EditAnalyticsExcludedIp::class, ['record' => $record->getKey()])
            ->callAction('delete');

        $this->assertSame(0, AnalyticsExcludedIp::query()->count());
    }
}
