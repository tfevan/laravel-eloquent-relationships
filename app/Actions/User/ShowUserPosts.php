<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ShowUserPosts
{
    /**
     * Get all posts of a user through the dynamic property.
     */
    public function execute(User $user): Collection
    {
        return $user->posts;
    }
}