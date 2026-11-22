<?php

declare(strict_types=1);

namespace App\Actions\Country;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class ShowCountryPosts
{
    /**
     * Get all posts written by the users of the country through the dynamic property.
     */
    public function execute(Country $country): Collection
    {
        return $country->posts;
    }
}