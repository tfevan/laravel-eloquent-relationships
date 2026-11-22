<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ListPostsByUser
{
    /**
     * List the posts of a user from the post side with whereBelongsTo().
     */
    public function execute(User $user): Collection
    {
        return Post::whereBelongsTo($user)->orderBy('id')->get();
    }
}