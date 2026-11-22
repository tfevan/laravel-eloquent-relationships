<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class ListOrphanPosts
{
    /**
     * List posts that have no author.
     */
    public function execute(): Collection
    {
        return Post::doesntHave('user')->orderBy('id')->get();
    }
}