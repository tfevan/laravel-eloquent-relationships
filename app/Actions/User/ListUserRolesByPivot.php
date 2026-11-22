<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ListUserRolesByPivot
{
    /**
     * Filter the roles of a user by the expires_at pivot column: permanent, expiring or expired.
     */
    public function execute(User $user, string $status): Collection
    {
        $roles = $user->roles();

        return match ($status) {
            'permanent' => $roles->wherePivotNull('expires_at')->get(),
            'expiring' => $roles->wherePivotNotNull('expires_at')->get(),
            'expired' => $roles->wherePivot('expires_at', '<', now())->get(),
            default => $roles->get(),
        };
    }
}