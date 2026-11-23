<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use Illuminate\Database\Eloquent\Model;

class DeleteCommentableComment
{
    /**
     * Delete one comment inside the parent scope.
     */
    public function execute(Model $commentable, int $commentId): bool
    {
        $comment = (new FindCommentableComment)->execute($commentable, $commentId);

        return (bool) $comment->delete();
    }
}