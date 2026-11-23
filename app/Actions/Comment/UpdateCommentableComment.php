<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class UpdateCommentableComment
{
    /**
     * Update one comment inside the parent scope.
     */
    public function execute(Model $commentable, int $commentId, array $data): Comment
    {
        $comment = (new FindCommentableComment)->execute($commentable, $commentId);

        $comment->update($data);

        return $comment;
    }
}