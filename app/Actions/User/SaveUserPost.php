<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Post;
use App\Models\User;

class SaveUserPost
{
    /**
     * Create a post for the user with save().
     */
    public function execute(User $user, array $data): Post
    {
        $post = new Post($data);
        $user->posts()->save($post);

        return $post;
    }
}