<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class GetUserPostSummary
{
    /**
     * Load the post count and the three latest posts onto an already fetched user.
     */
    public function execute(User $user): User
    {
        $user->loadCount('posts');
        $user->load(['posts' => fn (Builder|Relation $query) => $query->latest('id')->limit(3)]);

        return $user;
    }
}