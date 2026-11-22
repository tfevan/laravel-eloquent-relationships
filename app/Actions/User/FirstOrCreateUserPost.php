<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Post;
use App\Models\User;

class FirstOrCreateUserPost
{
    /**
     * Get the post with the given title or create it with firstOrCreate().
     */
    public function execute(User $user, string $title, string $body): Post
    {
        return $user->posts()->firstOrCreate(['title' => $title], ['body' => $body]);
    }
}