<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Exceptions\ResourceConflictException;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AttachRoleToUser
{
    /**
     * Add a role to the user with attach() and an optional expires_at pivot value.
     */
    public function execute(User $user, int $roleId, ?string $expiresAt = null): Collection
    {
        if ($user->roles()->wherePivot('role_id', $roleId)->exists()) {
            throw new ResourceConflictException('The user already has this role.');
        }

        $user->roles()->attach($roleId, ['expires_at' => $expiresAt]);

        return $user->roles()->get();
    }
}