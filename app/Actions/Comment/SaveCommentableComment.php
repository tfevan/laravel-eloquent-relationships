<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class SaveCommentableComment
{
    /**
     * Save a new comment model with save() on the relation.
     */
    public function execute(Model $commentable, array $data): Comment
    {
        $comment = new Comment($data);

        $commentable->comments()->save($comment);

        return $comment;
    }
}