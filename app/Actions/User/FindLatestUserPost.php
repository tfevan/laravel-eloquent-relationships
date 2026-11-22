<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Post;
use App\Models\User;

class FindLatestUserPost
{
    /**
     * Get the most recent post of a user.
     */
    public function execute(User $user): ?Post
    {
        return $user->posts()->latest('id')->first();
    }
}