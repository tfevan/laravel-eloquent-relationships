<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Mechanic;
use Illuminate\Database\Seeder;

class MechanicSeeder extends Seeder
{
    /**
     * Seed mechanics, cars and owners (Has One Through), with gaps to test missing links.
     */
    public function run(): void
    {
        $mechanics = [
            ['name' => 'Karim', 'car' => 'Toyota Corolla', 'owner' => 'Abdul Hamid'],
            ['name' => 'Rahim', 'car' => 'Honda Civic', 'owner' => 'Selina Akter'],
            ['name' => 'Jamal', 'car' => 'Nissan X-Trail', 'owner' => null],
            ['name' => 'Salam', 'car' => null, 'owner' => null],
        ];

        foreach ($mechanics as $row) {
            $mechanic = Mechanic::create(['name' => $row['name']]);

            if ($row['car'] === null) {
                continue;
            }

            $car = $mechanic->car()->create(['model' => $row['car']]);

            if ($row['owner'] !== null) {
                $car->owner()->create(['name' => $row['owner']]);
            }
        }
    }
}
