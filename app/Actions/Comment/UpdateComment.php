<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Models\Comment;

class UpdateComment
{
    /**
     * Update a comment directly from the child side.
     */
    public function execute(Comment $comment, array $data): Comment
    {
        $comment->update($data);

        return $comment;
    }
}