<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListUsersWithPosts
{
    /**
     * List users with posts eager loaded, optionally only users with at least N posts or without posts.
     */
    public function execute(?bool $hasPosts = null, int $min = 1): Collection
    {
        return User::query()
            ->when($hasPosts === true, fn (Builder $query) => $query->has('posts', '>=', $min))
            ->when($hasPosts === false, fn (Builder $query) => $query->doesntHave('posts'))
            ->with('posts')
            ->orderBy('id')
            ->get();
    }
}