<?php

declare(strict_types=1);

namespace App\Actions\Country;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Country;
use App\Models\Post;

class FindCountryPost
{
    /**
     * Find one post inside the country scope, a post of another country is not found.
     */
    public function execute(Country $country, int $postId): Post
    {
        $post = $country->posts()->where('posts.id', $postId)->first();

        if ($post === null) {
            throw new ResourceNotFoundException('The country has no such post.');
        }

        return $post;
    }
}