<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class SearchPostsByAuthorName
{
    /**
     * Find posts by the name of their author with whereRelation().
     */
    public function execute(string $name): Collection
    {
        return Post::whereRelation('user', 'name', 'like', "%{$name}%")
            ->with('user')
            ->orderBy('id')
            ->get();
    }
}