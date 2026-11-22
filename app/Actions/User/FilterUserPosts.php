<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class FilterUserPosts
{
    /**
     * Filter the posts of a user by a title fragment.
     */
    public function execute(User $user, string $title): Collection
    {
        return $user->posts()->where('title', 'like', "%{$title}%")->orderBy('id')->get();
    }
}