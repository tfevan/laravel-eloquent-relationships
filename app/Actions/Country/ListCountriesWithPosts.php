<?php

declare(strict_types=1);

namespace App\Actions\Country;

use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListCountriesWithPosts
{
    /**
     * List countries with a post count, optionally only those with at least $min posts or with none.
     */
    public function execute(?bool $hasPosts = null, int $min = 1): Collection
    {
        return Country::query()
            ->when($hasPosts === true, fn (Builder $query) => $query->has('posts', '>=', $min))
            ->when($hasPosts === false, fn (Builder $query) => $query->doesntHave('posts'))
            ->withCount('posts')
            ->orderBy('id')
            ->get();
    }
}