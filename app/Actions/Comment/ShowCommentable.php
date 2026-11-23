<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class ShowCommentable
{
    /**
     * Get the parent of the comment, it can be a post or a video.
     */
    public function execute(Comment $comment): ?Model
    {
        return $comment->commentable;
    }
}