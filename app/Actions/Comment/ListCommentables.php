<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Actions\Concerns\ResolvesCommentableType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListCommentables
{
    use ResolvesCommentableType;

    /**
     * List posts or videos with a comment count, optionally only those with at least $min comments or none.
     */
    public function execute(string $type, ?bool $hasComments = null, int $min = 1): Collection
    {
        return $this->commentableClass($type)::query()
            ->when($hasComments === true, fn (Builder $query) => $query->has('comments', '>=', $min))
            ->when($hasComments === false, fn (Builder $query) => $query->doesntHave('comments'))
            ->withCount([
                'comments',
                'comments as approved_comments_count' => fn (Builder $query) => $query->where('approved', true),
            ])
            ->orderBy('id')
            ->get();
    }
}