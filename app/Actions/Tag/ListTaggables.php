<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use App\Actions\Concerns\ResolvesTaggableType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListTaggables
{
    use ResolvesTaggableType;

    /**
     * List posts or videos with their tags, optionally with or without tags, or by tag name.
     */
    public function execute(string $type, ?bool $hasTags = null, ?string $tag = null): Collection
    {
        return $this->taggableClass($type)::query()
            ->when($hasTags === true, fn (Builder $query) => $query->has('tags'))
            ->when($hasTags === false, fn (Builder $query) => $query->doesntHave('tags'))
            ->when($tag !== null && $tag !== '', fn (Builder $query) => $query->whereHas('tags', fn (Builder $query) => $query->where('tags.name', $tag)))
            ->with('tags')
            ->withCount('tags')
            ->orderBy('id')
            ->get();
    }
}