<?php

declare(strict_types=1);

namespace App\Actions\Country;

use App\Models\Country;
use App\Models\Post;

class DeleteCountryPosts
{
    /**
     * Bulk delete the posts of the country by model keys and keep the users.
     */
    public function execute(Country $country): int
    {
        $ids = $country->posts()->pluck('posts.id');

        return Post::whereKey($ids)->delete();
    }
}