<?php

declare(strict_types=1);

namespace App\Actions\Country;

use App\Models\Country;

class CountCountryPosts
{
    /**
     * Count the posts of the country without loading them.
     */
    public function execute(Country $country): int
    {
        return $country->posts()->count();
    }
}