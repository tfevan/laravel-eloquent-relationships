<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ShowTaggableTags
{
    /**
     * Get all tags of a post or a video, the pivot row is available as $tag->pivot.
     */
    public function execute(Model $taggable): Collection
    {
        return $taggable->tags;
    }
}