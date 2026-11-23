<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use Illuminate\Database\Eloquent\Model;

class UpdateCommentableComments
{
    /**
     * Bulk update every comment of the parent in one query.
     */
    public function execute(Model $commentable, array $data): int
    {
        return $commentable->comments()->update($data);
    }
}