<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Pages\UserGuide;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Livewire\Livewire;
use Tests\TestCase;

class UserGuideTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_guests_are_sent_to_the_panel_login(): void
    {
        $this->get('/admin/user-guide')
            ->assertRedirect('/'.Login::ROUTE_PATH);
    }

    public function test_authors_cannot_open_the_user_guide_or_see_it_in_navigation(): void
    {
        $author = User::factory()->create([
            'role' => User::ROLE_AUTHOR,
        ]);

        $this->actingAs($author);

        $this->get('/admin/user-guide')->assertForbidden();

        Livewire::test(UserGuide::class)->assertForbidden();

        $this->assertFalse(UserGuide::canAccess());
        $this->assertNavigationDoesNotContain('User Guide');
    }

    public function test_administrators_can_search_and_open_topics(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($admin);

        $this->get('/admin/user-guide')
            ->assertOk()
            ->assertSee('User Guide')
            ->assertSee('Control panel')
            ->assertSee('IBNTECH Control');

        $this->assertTrue(UserGuide::canAccess());
        $this->assertSame('Administration', UserGuide::getNavigationGroup());
        $this->assertNavigationContains('User Guide');

        Livewire::test(UserGuide::class)
            ->assertOk()
            ->assertSee('Search the guide')
            ->assertSee('Roles and access')
            ->set('search', 'QUEUE_MONITOR_MAX')
            ->assertSee('Queues, logs, and maintenance')
            ->assertDontSee('Signing in')
            ->call('clearSearch')
            ->assertSee('Signing in')
            ->call('selectTopic', 'gated-downloads')
            ->assertSee('download_pdf')
            ->assertSet('topic', 'gated-downloads')
            ->call('selectTopic', 'not-a-topic')
            ->assertSet('topic', 'gated-downloads');
    }

    private function assertNavigationContains(string $label): void
    {
        $this->assertTrue($this->navigationLabels()->contains($label));
    }

    private function assertNavigationDoesNotContain(string $label): void
    {
        $this->assertFalse($this->navigationLabels()->contains($label));
    }

    /**
     * @return Collection<int, string>
     */
    private function navigationLabels()
    {
        $panel = Filament::getPanel('admin');
        Filament::setCurrentPanel($panel);

        return collect($panel->getNavigation())
            ->flatMap(fn ($group) => $group->getItems())
            ->map(fn ($item): string => (string) $item->getLabel());
    }
}
