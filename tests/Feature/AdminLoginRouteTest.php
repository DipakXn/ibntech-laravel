<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminLoginRouteTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function the_named_login_route_is_the_obscured_root_path(): void
    {
        $this->assertSame(
            'http://localhost/'.Login::ROUTE_PATH,
            route('filament.admin.auth.login'),
        );
        $this->assertSame(
            'http://localhost/'.Login::ROUTE_PATH,
            Filament::getLoginUrl(),
        );
    }

    #[Test]
    public function the_dashboard_url_remains_admin(): void
    {
        $this->assertSame('http://localhost/admin', Filament::getUrl());
        $this->assertSame('http://localhost/admin/logout', Filament::getLogoutUrl());
        $this->assertSame('http://localhost/admin/profile', Filament::getProfileUrl());
    }

    #[Test]
    public function the_new_login_url_renders_the_admin_login_page(): void
    {
        $this->withoutVite();

        $this->get('/'.Login::ROUTE_PATH)
            ->assertOk()
            ->assertSee('Control Center', false)
            ->assertSee('IBNTECH', false);
    }

    #[Test]
    public function guests_visiting_admin_are_redirected_to_the_new_login_url(): void
    {
        $this->get('/admin')
            ->assertRedirect('http://localhost/'.Login::ROUTE_PATH);
    }

    #[Test]
    public function the_old_login_url_does_not_expose_the_login_page_or_redirect(): void
    {
        $this->withoutVite();

        $legacy = $this->get('/admin/login');
        $legacy->assertNotFound();
        $this->assertNull($legacy->headers->get('Location'));

        $prefixed = $this->get('/admin/'.Login::ROUTE_PATH);
        $prefixed->assertNotFound();
        $this->assertNull($prefixed->headers->get('Location'));
    }

    #[Test]
    public function authenticated_users_can_access_the_admin_dashboard(): void
    {
        $this->withoutVite();

        $user = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($user)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Control center', false);
    }

    #[Test]
    public function login_authenticates_and_sends_the_user_to_the_dashboard(): void
    {
        $user = User::factory()->create([
            'email' => 'cms-login@example.com',
            'password' => 'password',
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        Livewire::test(Login::class)
            ->fillForm([
                'email' => $user->email,
                'password' => 'password',
            ])
            ->call('authenticate')
            ->assertHasNoFormErrors()
            ->assertRedirect('http://localhost/admin');

        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function logout_returns_the_user_to_the_new_login_url(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);

        $this->actingAs($user)
            ->post(Filament::getLogoutUrl())
            ->assertRedirect('http://localhost/'.Login::ROUTE_PATH);

        $this->assertGuest();
    }
}
