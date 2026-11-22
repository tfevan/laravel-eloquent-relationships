<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;
use App\Models\User;

class ShowPostAuthor
{
    /**
     * Get the author of a post, or an unsaved Guest Author when the default model is requested.
     */
    public function execute(Post $post, bool $withDefault = false): ?User
    {
        return $withDefault ? $post->author : $post->user;
    }
}