<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use Illuminate\Database\Eloquent\Model;

class DeleteCommentableComments
{
    /**
     * Delete every comment of the parent in one query and keep the parent.
     */
    public function execute(Model $commentable): int
    {
        return $commentable->comments()->delete();
    }
}