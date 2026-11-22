<?php

declare(strict_types=1);

namespace App\Actions\Country;

use App\Models\Country;
use App\Models\Post;

class FindLatestCountryPost
{
    /**
     * Find the newest post of the country, the column is qualified because the query joins users.
     */
    public function execute(Country $country): ?Post
    {
        return $country->posts()->latest('posts.created_at')->first();
    }
}