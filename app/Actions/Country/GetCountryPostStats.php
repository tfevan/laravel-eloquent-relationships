<?php

declare(strict_types=1);

namespace App\Actions\Country;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class GetCountryPostStats
{
    /**
     * Get the user count and the post count of every country, the busiest country first.
     */
    public function execute(): Collection
    {
        return Country::query()
            ->withCount(['users', 'posts'])
            ->orderByDesc('posts_count')
            ->orderBy('id')
            ->get();
    }
}