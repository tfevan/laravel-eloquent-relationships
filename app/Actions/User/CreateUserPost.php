<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Post;
use App\Models\User;

class CreateUserPost
{
    /**
     * Create a post for the user with create().
     */
    public function execute(User $user, array $data): Post
    {
        return $user->posts()->create($data);
    }
}