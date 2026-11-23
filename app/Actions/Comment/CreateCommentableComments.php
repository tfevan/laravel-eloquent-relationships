<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CreateCommentableComments
{
    /**
     * Create many comments at once with createMany().
     */
    public function execute(Model $commentable, array $comments): Collection
    {
        return $commentable->comments()->createMany($comments);
    }
}