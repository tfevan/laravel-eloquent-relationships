<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Car;
use App\Models\Mechanic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'mechanic_id' => Mechanic::factory(),
            'model' => fake()->randomElement(['Toyota Corolla', 'Honda Civic', 'Nissan X-Trail', 'Suzuki Swift']),
        ];
    }
}
