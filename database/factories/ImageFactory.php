<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'url' => 'https://images.example.com/'.fake()->unique()->uuid().'.jpg',
            'imageable_id' => User::factory(),
            'imageable_type' => (new User)->getMorphClass(),
        ];
    }
}
