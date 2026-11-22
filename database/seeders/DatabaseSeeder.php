<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database, the order follows the foreign keys.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            UserSeeder::class,
            PhoneSeeder::class,
            PostSeeder::class,
            RoleSeeder::class,
            MechanicSeeder::class,
            OrderSeeder::class,
            VideoSeeder::class,
            ImageSeeder::class,
            CommentSeeder::class,
            TagSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
