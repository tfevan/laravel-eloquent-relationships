<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;

class UpdateUserPosts
{
    /**
     * Update every post of the user in one query and return the updated row count.
     */
    public function execute(User $user, array $data): int
    {
        return $user->posts()->update($data);
    }
}