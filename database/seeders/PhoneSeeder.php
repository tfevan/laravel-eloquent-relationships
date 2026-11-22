<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    /**
     * Seed one phone for the first six users (One To One), the last two users have none.
     */
    public function run(): void
    {
        User::orderBy('id')->take(6)->get()->each(function (User $user, int $index): void {
            $user->phone()->create(['number' => '+88017000000'.sprintf('%02d', $index + 1)]);
        });
    }
}
