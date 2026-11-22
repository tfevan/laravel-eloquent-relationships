<?php

declare(strict_types=1);

namespace App\Actions\Country;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class FilterCountryPosts
{
    /**
     * Filter the posts of the country by title with extra constraints on the relation query.
     */
    public function execute(Country $country, string $title): Collection
    {
        return $country->posts()
            ->where('posts.title', 'like', "%{$title}%")
            ->orderBy('posts.id')
            ->get();
    }
}