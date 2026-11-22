<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListUsersWithRoles
{
    /**
     * List users with roles and roles_count, optionally filtered by role name or users without roles.
     */
    public function execute(?string $role = null, ?bool $hasRoles = null): Collection
    {
        return User::query()
            ->when($role !== null, fn (Builder $query) => $query->whereHas('roles', fn (Builder $roles) => $roles->where('name', $role)))
            ->when($hasRoles === false, fn (Builder $query) => $query->doesntHave('roles'))
            ->with('roles')
            ->withCount('roles')
            ->orderBy('id')
            ->get();
    }
}