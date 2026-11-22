<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class ListPostsWithAuthor
{
    /**
     * List posts with the author eager loaded, optionally with the Guest Author default model.
     */
    public function execute(bool $withDefault = false): Collection
    {
        return Post::with($withDefault ? 'author' : 'user')->orderBy('id')->get();
    }
}