<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use Illuminate\Database\Eloquent\Model;

class ToggleTaggableTags
{
    /**
     * Attach the missing tags and detach the attached ones.
     */
    public function execute(Model $taggable, array $tagIds): array
    {
        return $taggable->tags()->toggle($tagIds);
    }
}