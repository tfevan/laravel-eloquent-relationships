<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Post;
use App\Models\User;

class FindUserPost
{
    /**
     * Find one post inside the posts of a user, a post of another user is not found.
     */
    public function execute(User $user, int $postId): Post
    {
        return $user->posts()->findOrFail($postId);
    }
}