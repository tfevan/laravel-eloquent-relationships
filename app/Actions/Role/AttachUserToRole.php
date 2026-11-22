<?php

declare(strict_types=1);

namespace App\Actions\Role;

use App\Exceptions\ResourceConflictException;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class AttachUserToRole
{
    /**
     * Add a user to the role from the role side with attach().
     */
    public function execute(Role $role, int $userId, ?string $expiresAt = null): Collection
    {
        if ($role->users()->wherePivot('user_id', $userId)->exists()) {
            throw new ResourceConflictException('The role already has this user.');
        }

        $role->users()->attach($userId, ['expires_at' => $expiresAt]);

        return $role->users()->get();
    }
}