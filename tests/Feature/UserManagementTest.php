<?php

namespace Tests\Feature;

use App\Filament\Auth\EditProfile;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use App\Notifications\UserInvitation;
use App\Support\Users\UserInvitationSender;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    private const STRONG_PASSWORD = 'ValidPassw0rd!';

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        config(['cms.legacy_super_admin_emails' => []]);
    }

    public function test_authors_cannot_manage_users_or_export_them(): void
    {
        $author = $this->author();

        $this->actingAs($author);

        $this->assertFalse(UserResource::canViewAny());
        $this->get(UserResource::getUrl('index'))->assertForbidden();
        $this->get(route('filament.admin.users.export'))->assertForbidden();
        Livewire::test(ListUsers::class)->assertForbidden();
    }

    public function test_an_administrator_can_create_a_user_with_a_strong_password(): void
    {
        $admin = $this->administrator();
        $this->actingAs($admin);

        Livewire::test(CreateUser::class)
            ->fillForm([
                'name' => 'New Author',
                'email' => 'new-author@example.com',
                'role' => User::ROLE_AUTHOR,
                'is_active' => true,
                'send_invitation' => false,
                'password' => self::STRONG_PASSWORD,
                'password_confirmation' => self::STRONG_PASSWORD,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $user = User::query()->where('email', 'new-author@example.com')->first();

        $this->assertNotNull($user);
        $this->assertTrue(Hash::check(self::STRONG_PASSWORD, $user->password));
        $this->assertTrue($user->isAuthor());
        $this->assertDatabaseHas('user_admin_events', [
            'target_user_id' => $user->getKey(),
            'action' => 'created',
            'actor_user_id' => $admin->getKey(),
        ]);
    }

    public function test_weak_passwords_are_rejected_for_new_users_and_profile_changes(): void
    {
        $admin = $this->administrator();
        $this->actingAs($admin);

        Livewire::test(CreateUser::class)
            ->fillForm([
                'name' => 'Weak User',
                'email' => 'weak@example.com',
                'role' => User::ROLE_AUTHOR,
                'is_active' => true,
                'send_invitation' => false,
                'password' => 'short',
                'password_confirmation' => 'short',
            ])
            ->call('create')
            ->assertHasFormErrors(['password']);

        $this->assertDatabaseMissing('users', ['email' => 'weak@example.com']);

        Livewire::test(EditProfile::class)
            ->fillForm([
                'name' => $admin->name,
                'email' => $admin->email,
                'password' => 'short',
                'passwordConfirmation' => 'short',
                'currentPassword' => 'password',
            ])
            ->call('save')
            ->assertHasFormErrors(['password']);
    }

    public function test_a_blank_password_on_edit_keeps_the_current_hash(): void
    {
        $admin = $this->administrator();
        $author = $this->author();
        $hash = $author->password;
        $this->actingAs($admin);

        Livewire::test(EditUser::class, ['record' => $author->getRouteKey()])
            ->fillForm([
                'name' => 'Renamed Author',
                'email' => $author->email,
                'role' => User::ROLE_AUTHOR,
                'is_active' => true,
                'password' => null,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $author->refresh();
        $this->assertSame('Renamed Author', $author->name);
        $this->assertSame($hash, $author->password);
        $this->assertDatabaseHas('user_admin_events', [
            'target_user_id' => $author->getKey(),
            'action' => 'updated',
        ]);
    }

    public function test_the_last_administrator_cannot_be_deleted_demoted_or_deactivated(): void
    {
        $admin = $this->administrator();
        $this->actingAs($admin);

        try {
            $admin->update(['role' => User::ROLE_AUTHOR]);
            $this->fail('Demotion of the last administrator was saved.');
        } catch (ValidationException $exception) {
            $this->assertArrayHasKey('role', $exception->errors());
        }

        $admin->refresh();
        $this->assertTrue($admin->isAdministrator());

        try {
            $admin->update(['is_active' => false]);
            $this->fail('Deactivation of the last administrator was saved.');
        } catch (ValidationException $exception) {
            $this->assertArrayHasKey('is_active', $exception->errors());
        }

        $admin->refresh();
        $this->assertTrue($admin->isActiveAccount());

        $author = $this->author();
        $this->actingAs($author);

        try {
            $admin->delete();
            $this->fail('The last administrator was deleted.');
        } catch (ValidationException) {
            $this->assertModelExists($admin);
        }

        $this->actingAs($admin);

        try {
            $admin->delete();
            $this->fail('The signed-in administrator was deleted.');
        } catch (ValidationException) {
            $this->assertModelExists($admin);
        }
    }

    public function test_another_administrator_can_be_removed_when_one_remains(): void
    {
        $keeper = $this->administrator();
        $other = User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
            'is_active' => true,
        ]);

        $this->actingAs($keeper);
        $this->assertTrue($other->delete());
        $this->assertModelMissing($other);
        $this->assertTrue($keeper->fresh()->isAdministrator());
        $this->assertDatabaseHas('user_admin_events', [
            'target_email' => $other->email,
            'action' => 'deleted',
        ]);
    }

    public function test_an_administrator_cannot_demote_or_deactivate_themselves_when_another_administrator_exists(): void
    {
        $admin = $this->administrator();
        User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
            'is_active' => true,
        ]);
        $this->actingAs($admin);

        try {
            $admin->update(['role' => User::ROLE_AUTHOR]);
            $this->fail('Self-demotion was saved.');
        } catch (ValidationException $exception) {
            $this->assertStringContainsString('own administrator role', implode(' ', $exception->errors()['role']));
        }

        $admin->refresh();

        try {
            $admin->update(['is_active' => false]);
            $this->fail('Self-deactivation was saved.');
        } catch (ValidationException $exception) {
            $this->assertStringContainsString('deactivate your own account', implode(' ', $exception->errors()['is_active']));
        }

        $admin->refresh();
        $this->assertSame(User::ROLE_ADMINISTRATOR, $admin->role);
        $this->assertTrue($admin->isActiveAccount());
    }

    public function test_legacy_administrator_emails_are_configuration_driven(): void
    {
        $user = User::factory()->create([
            'email' => 'break-glass@example.com',
            'role' => User::ROLE_AUTHOR,
            'is_active' => true,
        ]);

        $this->assertFalse($user->isAdministrator());

        config(['cms.legacy_super_admin_emails' => ['break-glass@example.com']]);

        $this->assertTrue($user->fresh()->isAdministrator());
        $this->assertFalse($user->fresh()->isAuthor());
    }

    public function test_inactive_accounts_cannot_access_the_panel(): void
    {
        $admin = $this->administrator();
        $author = $this->author();
        $this->actingAs($admin);

        $author->update(['is_active' => false]);
        $author->refresh();

        $this->assertFalse($author->canAccessPanel(Filament::getPanel('admin')));
        $this->actingAs($author)->get('/admin')->assertForbidden();
    }

    public function test_the_user_list_shows_roles_the_current_user_and_session_activity(): void
    {
        $admin = $this->administrator('Current Admin');
        $author = $this->author('Content Author');
        $this->actingAs($admin);

        DB::table('sessions')->insert([
            'id' => 'session-current-admin',
            'user_id' => $admin->getKey(),
            'payload' => 'test',
            'last_activity' => now()->timestamp,
        ]);

        Livewire::test(ListUsers::class)
            ->assertOk()
            ->assertSee('Total users')
            ->assertSee('Administrators')
            ->assertSee('Authors')
            ->assertSee('Administrator')
            ->assertSee('Author')
            ->assertSee('Signed in as this user')
            ->assertSee('CA')
            ->assertSee('Last session activity')
            ->assertSee('No active session')
            ->filterTable('role', User::ROLE_AUTHOR)
            ->assertSee($author->email)
            ->assertDontSee($admin->email);
    }

    public function test_invitation_and_password_reset_emails_do_not_include_a_password(): void
    {
        Notification::fake();

        $admin = $this->administrator();
        $this->actingAs($admin);

        Livewire::test(CreateUser::class)
            ->fillForm([
                'name' => 'Invited Author',
                'email' => 'invited@example.com',
                'role' => User::ROLE_AUTHOR,
                'is_active' => true,
                'send_invitation' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $invited = User::query()->where('email', 'invited@example.com')->firstOrFail();

        Notification::assertSentTo($invited, UserInvitation::class, function (UserInvitation $notification) use ($invited): bool {
            $mail = $notification->toMail($invited);

            $body = $mail->render();

            return $notification->invitation
                && str_contains($body, 'Set password')
                && str_contains($body, 'not included');
        });

        $this->assertDatabaseHas('user_admin_events', [
            'target_user_id' => $invited->getKey(),
            'action' => 'invitation_sent',
        ]);

        $author = $this->author();
        app(UserInvitationSender::class)->send($author, invitation: false);

        Notification::assertSentTo($author, UserInvitation::class, fn (UserInvitation $notification): bool => ! $notification->invitation);

        auth()->logout();
        $this->get(route('filament.admin.auth.password-reset.request'))->assertOk();
    }

    public function test_administrators_can_export_users_without_password_hashes(): void
    {
        $admin = $this->administrator();
        $author = $this->author();
        $this->actingAs($admin);

        $response = $this->get(route('filament.admin.users.export'));

        $response->assertOk();
        $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
        $content = $response->streamedContent();
        $this->assertStringContainsString($admin->email, $content);
        $this->assertStringContainsString($author->email, $content);
        $this->assertStringContainsString('Administrator', $content);
        $this->assertStringNotContainsString($admin->password, $content);
    }

    public function test_existing_login_urls_remain_available(): void
    {
        $admin = $this->administrator();

        $this->assertTrue($admin->canAccessPanel(Filament::getPanel('admin')));
        $this->actingAs($admin)->get('/admin')->assertOk();
        $this->get('/admin/login')->assertNotFound();
    }

    private function administrator(string $name = 'Admin User'): User
    {
        return User::factory()->create([
            'name' => $name,
            'role' => User::ROLE_ADMINISTRATOR,
            'is_active' => true,
        ]);
    }

    private function author(string $name = 'Author User'): User
    {
        return User::factory()->create([
            'name' => $name,
            'role' => User::ROLE_AUTHOR,
            'is_active' => true,
        ]);
    }
}
