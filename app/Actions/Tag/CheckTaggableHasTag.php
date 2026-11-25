<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use Illuminate\Database\Eloquent\Model;

class CheckTaggableHasTag
{
    /**
     * Check if the parent has a tag with the given name.
     */
    public function execute(Model $taggable, string $name): bool
    {
        return $taggable->tags()->where('tags.name', $name)->exists();
    }
}