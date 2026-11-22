<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Seed orders with different totals and dates (One Of Many: latest, oldest, largest).
     */
    public function run(): void
    {
        // each row is [total, days ago]
        $orders = [
            'talha@example.com' => [[120.50, 17], [980.00, 8], [45.00, 1]],
            'rafi@example.com' => [[300.00, 12], [75.25, 3]],
            'nusrat@example.com' => [[19.99, 5]],
        ];

        foreach ($orders as $email => $rows) {
            $user = User::where('email', $email)->firstOrFail();

            foreach ($rows as [$total, $daysAgo]) {
                Order::factory()->for($user)->create([
                    'total' => $total,
                    'created_at' => now()->subDays($daysAgo),
                ]);
            }
        }
    }
}
