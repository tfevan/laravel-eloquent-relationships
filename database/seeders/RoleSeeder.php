<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed roles and the role_user pivot rows (Many To Many) with an optional expires_at.
     */
    public function run(): void
    {
        $roles = collect(['admin', 'editor', 'author', 'subscriber'])
            ->mapWithKeys(fn (string $name): array => [$name => Role::create(['name' => $name])->id]);

        // role name => days until the role expires, null means it never expires, a negative number means it already expired
        $assignments = [
            'talha@example.com' => ['admin' => null, 'author' => null],
            'rafi@example.com' => ['editor' => null, 'author' => 30],
            'nusrat@example.com' => ['author' => null],
            'sami@example.com' => ['subscriber' => -10],
            'john@example.com' => ['subscriber' => null],
            'anna@example.com' => ['editor' => null],
            'yuki@example.com' => ['subscriber' => 7],
        ];

        foreach ($assignments as $email => $grants) {
            $user = User::where('email', $email)->firstOrFail();
            $attach = [];

            foreach ($grants as $role => $days) {
                $attach[$roles[$role]] = ['expires_at' => $days === null ? null : now()->addDays($days)];
            }

            $user->roles()->attach($attach);
        }
    }
}
