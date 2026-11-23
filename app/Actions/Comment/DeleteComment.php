<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Models\Comment;

class DeleteComment
{
    /**
     * Delete the comment itself and keep its parent.
     */
    public function execute(Comment $comment): bool
    {
        return (bool) $comment->delete();
    }
}