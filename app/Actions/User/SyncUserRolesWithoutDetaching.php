<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Actions\Concerns\BuildsPivotPayload;
use App\Models\User;

class SyncUserRolesWithoutDetaching
{
    use BuildsPivotPayload;

    /**
     * Add the missing roles and update existing ones, never remove a role, with syncWithoutDetaching().
     */
    public function execute(User $user, array $roles): array
    {
        return $user->roles()->syncWithoutDetaching($this->pivotPayload($roles, 'role_id'));
    }
}