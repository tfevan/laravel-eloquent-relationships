<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;

class ToggleUserRoles
{
    /**
     * Attach the missing roles and detach the existing ones with toggle().
     */
    public function execute(User $user, array $roleIds): array
    {
        return $user->roles()->toggle($roleIds);
    }
}