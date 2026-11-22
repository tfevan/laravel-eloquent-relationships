<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Post;
use App\Models\User;

class AdoptPost
{
    /**
     * Move an existing post to the user with save().
     */
    public function execute(User $user, Post $post): Post
    {
        $user->posts()->save($post);

        return $post;
    }
}