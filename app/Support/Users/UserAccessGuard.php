<?php

namespace App\Support\Users;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class UserAccessGuard
{
    public function lockAdministratorRows(): void
    {
        $emails = config('cms.legacy_super_admin_emails', []);

        User::query()
            ->where(function ($query) use ($emails): void {
                $query->where('role', User::ROLE_ADMINISTRATOR);

                foreach ($emails as $email) {
                    $query->orWhereRaw('lower(email) = ?', [$email]);
                }
            })
            ->lockForUpdate()
            ->get();
    }

    public function assertUpdate(?User $actor, User $user): void
    {
        if (! $user->isDirty(['role', 'email', 'is_active'])) {
            return;
        }

        $wasAdministrator = $this->administratorFrom(
            (string) $user->getOriginal('role'),
            (string) $user->getOriginal('email'),
            $this->originalActive($user),
        );
        $willBeAdministrator = $user->isAdministrator();

        if ($actor instanceof User && $actor->is($user) && $user->isDirty('role') && $user->role !== User::ROLE_ADMINISTRATOR && $user->getOriginal('role') === User::ROLE_ADMINISTRATOR) {
            $this->fail('You cannot change your own administrator role.');
        }

        if ($actor instanceof User && $actor->is($user) && $user->isDirty('is_active') && ! $user->isActiveAccount()) {
            $this->fail('You cannot deactivate your own account.');
        }

        if ($wasAdministrator && ! $willBeAdministrator && $this->otherActiveAdministrators($user) === 0) {
            $this->fail('This is the last active administrator. Demotion and deactivation are blocked.');
        }
    }

    public function assertDelete(?User $actor, User $user): void
    {
        if ($actor instanceof User && $actor->is($user)) {
            $this->fail('You cannot delete the account you are signed in with.');
        }

        if ($user->isAdministrator() && $this->otherActiveAdministrators($user) === 0) {
            $this->fail('You cannot delete the last active administrator.');
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function auditableChanges(User $user): array
    {
        $changes = [];

        foreach (['name', 'email', 'role', 'is_active'] as $field) {
            if (! $user->isDirty($field)) {
                continue;
            }

            $changes[$field] = [
                'from' => $user->getOriginal($field),
                'to' => $user->getAttribute($field),
            ];
        }

        if ($user->isDirty('password')) {
            $changes['password'] = 'changed';
        }

        return $changes;
    }

    public function otherActiveAdministrators(User $except): int
    {
        return User::query()
            ->whereKeyNot($except->getKey())
            ->get()
            ->filter(fn (User $user): bool => $user->isAdministrator())
            ->count();
    }

    private function originalActive(User $user): bool
    {
        if (! array_key_exists('is_active', $user->getOriginal())) {
            return true;
        }

        return (bool) $user->getOriginal('is_active');
    }

    private function administratorFrom(string $role, string $email, bool $active): bool
    {
        $candidate = new User;
        $candidate->forceFill([
            'role' => $role,
            'email' => $email,
            'is_active' => $active,
        ]);

        return $candidate->isAdministrator();
    }

    private function fail(string $message): void
    {
        throw ValidationException::withMessages([
            'role' => $message,
            'is_active' => $message,
            'data.role' => $message,
            'data.is_active' => $message,
        ]);
    }
}
