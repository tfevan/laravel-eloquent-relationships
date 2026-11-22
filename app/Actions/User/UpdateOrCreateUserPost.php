<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Post;
use App\Models\User;

class UpdateOrCreateUserPost
{
    /**
     * Update the post with the given title or create it with updateOrCreate().
     */
    public function execute(User $user, string $title, string $body): Post
    {
        return $user->posts()->updateOrCreate(['title' => $title], ['body' => $body]);
    }
}