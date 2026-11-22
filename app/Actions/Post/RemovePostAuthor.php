<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;

class RemovePostAuthor
{
    /**
     * Detach the post from its author with dissociate(), the foreign key is nullable.
     */
    public function execute(Post $post): Post
    {
        $post->user()->dissociate();
        $post->save();

        return $post;
    }
}