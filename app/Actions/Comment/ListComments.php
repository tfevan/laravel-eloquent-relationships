<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Actions\Concerns\ResolvesCommentableType;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListComments
{
    use ResolvesCommentableType;

    /**
     * List comments with the parent eager loaded, optionally for one type and one approval state.
     */
    public function execute(?string $type = null, ?bool $approved = null): Collection
    {
        if ($type !== null) {
            $this->commentableClass($type);
        }

        return Comment::query()
            ->when($type !== null, fn (Builder $query) => $query->where('commentable_type', $type))
            ->when($approved !== null, fn (Builder $query) => $query->where('approved', $approved))
            ->with('commentable')
            ->orderBy('id')
            ->get();
    }
}