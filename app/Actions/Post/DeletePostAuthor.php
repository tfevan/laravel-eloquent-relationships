<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;

class DeletePostAuthor
{
    /**
     * Delete the author of the post, the foreign key sets user_id to null on all their posts.
     */
    public function execute(Post $post): int
    {
        return $post->user()->delete();
    }
}