<?php

declare(strict_types=1);

namespace App\Actions\Role;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListRolesWithUsers
{
    /**
     * List roles with users and users_count, optionally only roles that have or have no users.
     */
    public function execute(?bool $hasUsers = null): Collection
    {
        return Role::query()
            ->when($hasUsers === true, fn (Builder $query) => $query->has('users'))
            ->when($hasUsers === false, fn (Builder $query) => $query->doesntHave('users'))
            ->with('users')
            ->withCount('users')
            ->orderBy('id')
            ->get();
    }
}