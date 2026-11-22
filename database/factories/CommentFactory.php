<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'commentable_id' => Post::factory(),
            'commentable_type' => (new Post)->getMorphClass(),
            'body' => fake()->sentence(),
            'approved' => true,
        ];
    }

    /**
     * Indicate that the comment is waiting for approval.
     */
    public function unapproved(): static
    {
        return $this->state(fn (array $attributes): array => [
            'approved' => false,
        ]);
    }
}
