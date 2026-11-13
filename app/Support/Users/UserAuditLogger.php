<?php

namespace App\Support\Users;

use App\Models\User;
use App\Models\UserAdminEvent;

class UserAuditLogger
{
    /**
     * @param  array<string, mixed>  $changes
     */
    public function record(?User $actor, ?User $target, string $action, array $changes = []): void
    {
        UserAdminEvent::query()->create([
            'actor_user_id' => $actor?->getKey(),
            'actor_email' => $actor?->email,
            'target_user_id' => $target?->getKey(),
            'target_email' => $target?->email,
            'action' => $action,
            'changes' => $changes === [] ? null : $changes,
        ]);
    }
}
