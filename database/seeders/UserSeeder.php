<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed users, each belonging to a country except the guest user.
     */
    public function run(): void
    {
        $countries = Country::pluck('id', 'code');

        $users = [
            ['Talha Faisal', 'talha@example.com', 'BD'],
            ['Rafi Ahmed', 'rafi@example.com', 'BD'],
            ['Nusrat Jahan', 'nusrat@example.com', 'BD'],
            ['Sami Hasan', 'sami@example.com', 'US'],
            ['John Miller', 'john@example.com', 'US'],
            ['Anna Schmidt', 'anna@example.com', 'DE'],
            ['Yuki Tanaka', 'yuki@example.com', 'JP'],
            ['Guest User', 'guest@example.com', null],
        ];

        foreach ($users as [$name, $email, $code]) {
            User::factory()->create([
                'name' => $name,
                'email' => $email,
                'country_id' => $code === null ? null : $countries[$code],
            ]);
        }
    }
}
