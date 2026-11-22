<?php

declare(strict_types=1);

namespace App\Actions\Country;

use App\Models\Country;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PaginateCountryPosts
{
    /**
     * Paginate the posts of the country.
     */
    public function execute(Country $country, int $perPage = 10): LengthAwarePaginator
    {
        return $country->posts()->orderBy('posts.id')->paginate($perPage);
    }
}