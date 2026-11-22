<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;

class CountUserPosts
{
    /**
     * Count the posts of a user and check their existence without loading them.
     */
    public function execute(User $user): array
    {
        return [
            'posts_count' => $user->posts()->count(),
            'has_posts' => $user->posts()->exists(),
        ];
    }
}