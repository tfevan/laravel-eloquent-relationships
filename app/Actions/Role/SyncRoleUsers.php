<?php

declare(strict_types=1);

namespace App\Actions\Role;

use App\Actions\Concerns\BuildsPivotPayload;
use App\Models\Role;

class SyncRoleUsers
{
    use BuildsPivotPayload;

    /**
     * Make the users of the role match exactly the given list with sync().
     */
    public function execute(Role $role, array $users): array
    {
        return $role->users()->sync($this->pivotPayload($users, 'user_id'));
    }
}