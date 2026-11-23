<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ListCommentsWithCommentableDetails
{
    /**
     * Eager load the parent with a different relation for each type and count its comments.
     */
    public function execute(): Collection
    {
        return Comment::query()
            ->with(['commentable' => fn (MorphTo $morphTo) => $morphTo
                ->morphWith([Post::class => ['user']])
                ->morphWithCount([
                    Post::class => ['comments'],
                    Video::class => ['comments'],
                ])])
            ->orderBy('id')
            ->get();
    }
}