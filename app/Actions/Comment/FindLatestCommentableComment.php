<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class FindLatestCommentableComment
{
    /**
     * Find the newest comment of the parent.
     */
    public function execute(Model $commentable): ?Comment
    {
        return $commentable->comments()->latest('id')->first();
    }
}