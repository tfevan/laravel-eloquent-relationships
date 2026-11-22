<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ShowUserRoles
{
    /**
     * Get the roles of a user, every role carries its pivot columns in the pivot key.
     */
    public function execute(User $user): Collection
    {
        return $user->roles;
    }
}