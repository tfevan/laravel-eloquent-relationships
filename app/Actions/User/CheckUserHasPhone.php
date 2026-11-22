<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;

class CheckUserHasPhone
{
    /**
     * Check if the user has a phone without loading it.
     */
    public function execute(User $user): bool
    {
        return $user->phone()->exists();
    }
}