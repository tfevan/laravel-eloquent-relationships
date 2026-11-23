<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use Illuminate\Database\Eloquent\Model;

class ApproveCommentableComments
{
    /**
     * Approve only the pending comments of the parent and return how many changed.
     */
    public function execute(Model $commentable): int
    {
        return $commentable->comments()->where('approved', false)->update(['approved' => true]);
    }
}