<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Support\Users\UserAccessGuard;
use App\Support\Users\UserAuditLogger;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_ADMINISTRATOR = 'administrator';

    public const ROLE_AUTHOR = 'author';

    public bool $skipAccessGuard = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (User $user): void {
            unset($user->attributes['last_session_activity']);
        });

        static::created(function (User $user): void {
            app(UserAuditLogger::class)->record(
                auth()->user() instanceof self ? auth()->user() : null,
                $user,
                'created',
                [
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'is_active' => $user->isActiveAccount(),
                ],
            );
        });
    }

    public function adminEvents(): HasMany
    {
        return $this->hasMany(UserAdminEvent::class, 'target_user_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isActiveAccount() && ($this->isAdministrator() || $this->isAuthor());
    }

    public function isAdministrator(): bool
    {
        if (! $this->isActiveAccount()) {
            return false;
        }

        return $this->role === self::ROLE_ADMINISTRATOR || $this->hasLegacyAdministratorEmail();
    }

    public function isAuthor(): bool
    {
        return $this->isActiveAccount()
            && $this->role === self::ROLE_AUTHOR
            && ! $this->hasLegacyAdministratorEmail();
    }

    public function isActiveAccount(): bool
    {
        if (! array_key_exists('is_active', $this->attributes)) {
            return true;
        }

        return (bool) $this->is_active;
    }

    public function scopeWithLastSessionActivity(Builder $query): Builder
    {
        if ($query->getQuery()->columns === null) {
            $query->select($query->qualifyColumn('*'));
        }

        return $query->addSelect([
            'last_session_activity' => DB::table('sessions')
                ->select('last_activity')
                ->whereColumn('sessions.user_id', 'users.id')
                ->orderByDesc('sessions.last_activity')
                ->limit(1),
        ]);
    }

    public function save(array $options = []): bool
    {
        if ($this->skipAccessGuard || ! $this->exists) {
            return parent::save($options);
        }

        $dirty = $this->getDirty();

        return DB::transaction(function () use ($options, $dirty): bool {
            $guard = app(UserAccessGuard::class);
            $guard->lockAdministratorRows();

            $fresh = static::query()->whereKey($this->getKey())->lockForUpdate()->first();

            if (! $fresh) {
                return false;
            }

            $this->setRawAttributes($fresh->getAttributes(), true);
            $this->syncOriginal();

            foreach ($dirty as $key => $value) {
                $this->setAttribute($key, $value);
            }

            $actor = auth()->user() instanceof self ? auth()->user() : null;

            try {
                $guard->assertUpdate($actor, $this);
            } catch (ValidationException $exception) {
                $this->setRawAttributes($fresh->getAttributes(), true);
                $this->syncOriginal();

                throw $exception;
            }

            $changes = $guard->auditableChanges($this);

            $this->skipAccessGuard = true;

            try {
                $saved = parent::save($options);
            } finally {
                $this->skipAccessGuard = false;
            }

            if ($saved && $changes !== []) {
                $action = array_keys($changes) === ['password'] ? 'password_changed' : 'updated';
                app(UserAuditLogger::class)->record($actor, $this->fresh() ?? $this, $action, $changes);
            }

            return $saved;
        });
    }

    public function delete(): ?bool
    {
        if ($this->skipAccessGuard) {
            return parent::delete();
        }

        return DB::transaction(function (): ?bool {
            $guard = app(UserAccessGuard::class);
            $guard->lockAdministratorRows();

            $fresh = static::query()->whereKey($this->getKey())->lockForUpdate()->first();

            if (! $fresh) {
                return false;
            }

            $actor = auth()->user() instanceof self ? auth()->user() : null;
            $guard->assertDelete($actor, $fresh);

            app(UserAuditLogger::class)->record($actor, $fresh, 'deleted', [
                'email' => $fresh->email,
                'role' => $fresh->role,
            ]);

            $this->skipAccessGuard = true;

            try {
                return parent::delete();
            } finally {
                $this->skipAccessGuard = false;
            }
        });
    }

    private function hasLegacyAdministratorEmail(): bool
    {
        $emails = config('cms.legacy_super_admin_emails', []);

        return in_array(strtolower((string) $this->email), $emails, true);
    }
}
