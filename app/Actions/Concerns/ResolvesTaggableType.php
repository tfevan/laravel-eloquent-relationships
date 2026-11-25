<?php

declare(strict_types=1);

namespace App\Actions\Concerns;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;

trait ResolvesTaggableType
{
    /**
     * Resolve a morph map alias such as "post" to a model class that can have tags.
     */
    protected function taggableClass(string $type): string
    {
        $class = in_array($type, ['post', 'video'], true) ? Relation::getMorphedModel($type) : null;

        if ($class === null) {
            throw new ResourceNotFoundException("Unknown taggable type [{$type}].");
        }

        return $class;
    }

    /**
     * Get the inverse relation of a tag for the given type, posts() or videos().
     */
    protected function taggableRelation(Tag $tag, string $type): MorphToMany
    {
        $this->taggableClass($type);

        return $type === 'post' ? $tag->posts() : $tag->videos();
    }
}