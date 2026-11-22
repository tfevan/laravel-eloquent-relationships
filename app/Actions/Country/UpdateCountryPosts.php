<?php

declare(strict_types=1);

namespace App\Actions\Country;

use App\Models\Country;
use App\Models\Post;

class UpdateCountryPosts
{
    /**
     * Bulk update the posts of the country by model keys, an update on a joined query is not portable.
     */
    public function execute(Country $country, array $data): int
    {
        $ids = $country->posts()->pluck('posts.id');

        return Post::whereKey($ids)->update($data);
    }
}