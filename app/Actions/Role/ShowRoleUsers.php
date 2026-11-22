<?php

declare(strict_types=1);

namespace App\Actions\Role;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class ShowRoleUsers
{
    /**
     * Get the users of a role, every user carries its pivot columns in the pivot key.
     */
    public function execute(Role $role): Collection
    {
        return $role->users;
    }
}