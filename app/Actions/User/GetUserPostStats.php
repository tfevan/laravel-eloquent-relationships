<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GetUserPostStats
{
    /**
     * List users with posts_count, posts_exists and posts_max_created_at.
     */
    public function execute(): Collection
    {
        return User::withCount('posts')
            ->withExists('posts')
            ->withMax('posts', 'created_at')
            ->orderBy('id')
            ->get();
    }
}