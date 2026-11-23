<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class FindCommentableComment
{
    /**
     * Find one comment inside the parent scope, a comment of another parent is not found.
     */
    public function execute(Model $commentable, int $commentId): Comment
    {
        $comment = $commentable->comments()->find($commentId);

        if ($comment === null) {
            throw new ResourceNotFoundException('The model has no such comment.');
        }

        return $comment;
    }
}