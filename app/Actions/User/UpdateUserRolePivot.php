<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Role;
use App\Models\User;

class UpdateUserRolePivot
{
    /**
     * Change the expires_at pivot value of a role the user already has with updateExistingPivot().
     */
    public function execute(User $user, int $roleId, ?string $expiresAt): Role
    {
        if (! $user->roles()->wherePivot('role_id', $roleId)->exists()) {
            throw new ResourceNotFoundException('The user does not have this role.');
        }

        $user->roles()->updateExistingPivot($roleId, ['expires_at' => $expiresAt]);

        return $user->roles()->wherePivot('role_id', $roleId)->firstOrFail();
    }
}