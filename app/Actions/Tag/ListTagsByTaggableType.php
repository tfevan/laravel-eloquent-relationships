<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use App\Actions\Concerns\ResolvesTaggableType;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class ListTagsByTaggableType
{
    use ResolvesTaggableType;

    /**
     * List only the tags that are used by posts, or only by videos.
     */
    public function execute(string $type): Collection
    {
        $this->taggableClass($type);

        return Tag::query()
            ->has($type === 'post' ? 'posts' : 'videos')
            ->withCount(['posts', 'videos'])
            ->orderBy('id')
            ->get();
    }
}