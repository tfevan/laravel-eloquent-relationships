<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use App\Actions\Concerns\ResolvesTaggableType;
use App\Models\Tag;

class DetachTaggableFromTag
{
    use ResolvesTaggableType;

    /**
     * Detach one post or video from the tag, or all of that type when no id is given.
     */
    public function execute(Tag $tag, string $type, ?int $id = null): int
    {
        return $this->taggableRelation($tag, $type)->detach($id);
    }
}