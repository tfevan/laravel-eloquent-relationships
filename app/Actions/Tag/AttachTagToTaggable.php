<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use App\Exceptions\ResourceConflictException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AttachTagToTaggable
{
    /**
     * Attach one existing tag to a post or a video with attach().
     */
    public function execute(Model $taggable, int $tagId): Collection
    {
        if ($taggable->tags()->whereKey($tagId)->exists()) {
            throw new ResourceConflictException('The tag is already attached.');
        }

        $taggable->tags()->attach($tagId);

        return $taggable->tags()->get();
    }
}