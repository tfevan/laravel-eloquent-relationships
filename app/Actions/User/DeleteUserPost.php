<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;

class DeleteUserPost
{
    /**
     * Delete one post of the user.
     */
    public function execute(User $user, int $postId): void
    {
        $user->posts()->findOrFail($postId)->delete();
    }
}