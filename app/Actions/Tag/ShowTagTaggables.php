<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use App\Actions\Concerns\ResolvesTaggableType;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class ShowTagTaggables
{
    use ResolvesTaggableType;

    /**
     * Get the posts or the videos that have this tag with morphedByMany.
     */
    public function execute(Tag $tag, string $type): Collection
    {
        return $this->taggableRelation($tag, $type)->orderBy($type === 'post' ? 'posts.id' : 'videos.id')->get();
    }
}