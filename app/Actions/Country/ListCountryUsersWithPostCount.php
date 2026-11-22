<?php

declare(strict_types=1);

namespace App\Actions\Country;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class ListCountryUsersWithPostCount
{
    /**
     * List the users of the country, the intermediate model, with their post count.
     */
    public function execute(Country $country): Collection
    {
        return $country->users()->withCount('posts')->orderBy('users.id')->get();
    }
}