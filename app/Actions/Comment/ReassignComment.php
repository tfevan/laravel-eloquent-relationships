<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class ReassignComment
{
    /**
     * Move the comment to another post or video with associate().
     */
    public function execute(Comment $comment, Model $commentable): Comment
    {
        $comment->commentable()->associate($commentable);
        $comment->save();

        return $comment;
    }
}