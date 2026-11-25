<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use Illuminate\Database\Eloquent\Model;

class SyncTaggableTags
{
    /**
     * Replace the tags of the parent with exactly the given ids.
     */
    public function execute(Model $taggable, array $tagIds): array
    {
        return $taggable->tags()->sync($tagIds);
    }
}