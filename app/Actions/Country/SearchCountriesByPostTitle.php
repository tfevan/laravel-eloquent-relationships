<?php

declare(strict_types=1);

namespace App\Actions\Country;

use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

class SearchCountriesByPostTitle
{
    /**
     * Find countries by the title of a post and eager load only the matching posts.
     */
    public function execute(string $title): Collection
    {
        return Country::withWhereHas('posts', fn (Builder|Relation $query) => $query->where('posts.title', 'like', "%{$title}%"))
            ->orderBy('id')
            ->get();
    }
}