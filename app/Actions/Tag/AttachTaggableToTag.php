<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use App\Actions\Concerns\ResolvesTaggableType;
use App\Exceptions\ResourceConflictException;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class AttachTaggableToTag
{
    use ResolvesTaggableType;

    /**
     * Attach a post or a video to the tag from the tag side.
     */
    public function execute(Tag $tag, string $type, int $id): Collection
    {
        $taggable = (new ResolveTaggable)->execute($type, $id);
        $relation = $this->taggableRelation($tag, $type);

        if ($relation->whereKey($taggable->getKey())->exists()) {
            throw new ResourceConflictException('The tag is already attached.');
        }

        $relation->attach($taggable->getKey());

        return $this->taggableRelation($tag, $type)->get();
    }
}