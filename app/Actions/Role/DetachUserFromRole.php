<?php

declare(strict_types=1);

namespace App\Actions\Role;

use App\Models\Role;

class DetachUserFromRole
{
    /**
     * Remove one user from the role with detach(), or every user when no id is given.
     */
    public function execute(Role $role, ?int $userId = null): int
    {
        return $role->users()->detach($userId);
    }
}