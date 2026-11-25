<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use App\Actions\Concerns\ResolvesTaggableType;
use App\Models\Tag;

class SyncTagTaggables
{
    use ResolvesTaggableType;

    /**
     * Make the tag belong to exactly the given posts or videos.
     */
    public function execute(Tag $tag, string $type, array $ids): array
    {
        return $this->taggableRelation($tag, $type)->sync($ids);
    }
}