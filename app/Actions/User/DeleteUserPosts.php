<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;

class DeleteUserPosts
{
    /**
     * Delete every post of the user in one query and return the deleted row count.
     */
    public function execute(User $user): int
    {
        return $user->posts()->delete();
    }
}