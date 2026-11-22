<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;

class ReassignPostAuthor
{
    /**
     * Move the post to another user with associate().
     */
    public function execute(Post $post, int $userId): Post
    {
        $post->user()->associate($userId);
        $post->save();

        return $post->load('user');
    }
}