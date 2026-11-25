<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use Illuminate\Database\Eloquent\Model;

class DetachTaggableTags
{
    /**
     * Detach one tag, or every tag when no id is given, and return how many rows were removed.
     */
    public function execute(Model $taggable, ?int $tagId = null): int
    {
        return $taggable->tags()->detach($tagId);
    }
}