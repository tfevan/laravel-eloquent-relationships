<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;

class CheckUserHasRole
{
    /**
     * Check if the user has a role by name without loading the roles.
     */
    public function execute(User $user, string $roleName): bool
    {
        return $user->roles()->where('name', $roleName)->exists();
    }
}