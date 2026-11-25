<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use Illuminate\Database\Eloquent\Model;

class SyncTaggableTagsWithoutDetaching
{
    /**
     * Add the given tags and keep the existing ones, a duplicate is ignored.
     */
    public function execute(Model $taggable, array $tagIds): array
    {
        return $taggable->tags()->syncWithoutDetaching($tagIds);
    }
}