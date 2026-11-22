<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Seed the countries used by users (Has Many Through).
     */
    public function run(): void
    {
        $countries = [
            'BD' => 'Bangladesh',
            'US' => 'United States',
            'DE' => 'Germany',
            'JP' => 'Japan',
        ];

        foreach ($countries as $code => $name) {
            Country::create(['code' => $code, 'name' => $name]);
        }
    }
}
