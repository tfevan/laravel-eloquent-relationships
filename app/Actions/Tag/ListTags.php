<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListTags
{
    /**
     * List tags with the number of posts and videos, optionally only unused tags.
     */
    public function execute(?bool $used = null): Collection
    {
        return Tag::query()
            ->when($used === true, fn (Builder $query) => $query->has('posts')->orHas('videos'))
            ->when($used === false, fn (Builder $query) => $query->doesntHave('posts')->doesntHave('videos'))
            ->withCount(['posts', 'videos'])
            ->orderBy('id')
            ->get();
    }
}