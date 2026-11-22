<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class CreateUserPosts
{
    /**
     * Create several posts for the user with createMany().
     */
    public function execute(User $user, array $posts): Collection
    {
        return $user->posts()->createMany($posts);
    }
}