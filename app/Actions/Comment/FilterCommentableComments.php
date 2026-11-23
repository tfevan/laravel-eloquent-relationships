<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FilterCommentableComments
{
    /**
     * Filter the comments of the parent by approval state and a word in the body.
     */
    public function execute(Model $commentable, ?bool $approved = null, ?string $term = null): Collection
    {
        return $commentable->comments()
            ->when($approved !== null, fn (Builder $query) => $query->where('approved', $approved))
            ->when($term !== null && $term !== '', fn (Builder $query) => $query->where('body', 'like', "%{$term}%"))
            ->orderBy('id')
            ->get();
    }
}