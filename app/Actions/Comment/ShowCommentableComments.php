<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ShowCommentableComments
{
    /**
     * Get all comments of a post or a video through the dynamic property.
     */
    public function execute(Model $commentable): Collection
    {
        return $commentable->comments;
    }
}