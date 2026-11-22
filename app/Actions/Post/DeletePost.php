<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;

class DeletePost
{
    /**
     * Delete the post itself and keep its author.
     */
    public function execute(Post $post): bool
    {
        return (bool) $post->delete();
    }
}