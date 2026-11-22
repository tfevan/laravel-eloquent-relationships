<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class ListPostsWithCountry
{
    /**
     * List posts with the author and the country eager loaded with a nested relation.
     */
    public function execute(): Collection
    {
        return Post::with('user.country')->orderBy('id')->get();
    }
}