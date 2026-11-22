<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Actions\Concerns\BuildsPivotPayload;
use App\Models\User;

class SyncUserRoles
{
    use BuildsPivotPayload;

    /**
     * Make the roles of the user match exactly the given list with sync().
     */
    public function execute(User $user, array $roles): array
    {
        return $user->roles()->sync($this->pivotPayload($roles, 'role_id'));
    }
}