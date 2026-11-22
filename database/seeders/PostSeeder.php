<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Seed posts per user (One To Many), one user without posts and one post without an author.
     */
    public function run(): void
    {
        $postCounts = [
            'talha@example.com' => 4,
            'rafi@example.com' => 3,
            'nusrat@example.com' => 2,
            'sami@example.com' => 2,
            'john@example.com' => 1,
            'anna@example.com' => 2,
            'yuki@example.com' => 1,
        ];

        foreach ($postCounts as $email => $count) {
            $user = User::where('email', $email)->firstOrFail();

            Post::factory()->count($count)->for($user)->create();
        }

        Post::factory()->create([
            'user_id' => null,
            'title' => 'Anonymous Announcement',
        ]);
    }
}
