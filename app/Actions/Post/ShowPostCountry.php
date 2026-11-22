<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Country;
use App\Models\Post;

class ShowPostCountry
{
    /**
     * Walk back from the post to the country through the author, there is no inverse through method.
     */
    public function execute(Post $post): ?Country
    {
        return $post->user?->country;
    }
}