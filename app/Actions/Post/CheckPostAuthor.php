<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;
use App\Models\User;

class CheckPostAuthor
{
    /**
     * Check if the user wrote the post with is().
     */
    public function execute(Post $post, User $user): bool
    {
        return $post->user()->is($user);
    }
}