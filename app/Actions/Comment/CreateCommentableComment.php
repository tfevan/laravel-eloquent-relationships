<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class CreateCommentableComment
{
    /**
     * Create a comment with create(), the commentable_id and commentable_type columns are filled for you.
     */
    public function execute(Model $commentable, array $data): Comment
    {
        return $commentable->comments()->create($data);
    }
}