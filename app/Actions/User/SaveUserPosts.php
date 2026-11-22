<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Post;
use App\Models\User;

class SaveUserPosts
{
    /**
     * Create several posts for the user with saveMany().
     */
    public function execute(User $user, array $rows): array
    {
        $posts = array_map(fn (array $row): Post => new Post($row), $rows);
        $user->posts()->saveMany($posts);

        return $posts;
    }
}