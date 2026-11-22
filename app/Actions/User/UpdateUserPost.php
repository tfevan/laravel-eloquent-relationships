<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Post;
use App\Models\User;

class UpdateUserPost
{
    /**
     * Update one post of the user.
     */
    public function execute(User $user, int $postId, array $data): Post
    {
        $post = $user->posts()->findOrFail($postId);
        $post->update($data);

        return $post;
    }
}