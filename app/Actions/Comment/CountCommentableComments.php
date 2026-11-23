<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use Illuminate\Database\Eloquent\Model;

class CountCommentableComments
{
    /**
     * Count the comments of the parent without loading them.
     */
    public function execute(Model $commentable): int
    {
        return $commentable->comments()->count();
    }
}