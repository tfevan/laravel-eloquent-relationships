<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;

class DetachRoleFromUser
{
    /**
     * Remove one role from the user with detach(), or every role when no id is given.
     */
    public function execute(User $user, ?int $roleId = null): int
    {
        return $user->roles()->detach($roleId);
    }
}