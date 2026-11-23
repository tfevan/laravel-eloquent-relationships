<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SearchCommentsByCommentableTitle
{
    /**
     * Find comments by the title of the post or the video with whereHasMorph().
     */
    public function execute(string $term): Collection
    {
        return Comment::query()
            ->whereHasMorph('commentable', [Post::class, Video::class], fn (Builder $query) => $query->where('title', 'like', "%{$term}%"))
            ->with('commentable')
            ->orderBy('id')
            ->get();
    }
}