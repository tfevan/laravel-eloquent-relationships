<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Seed one image for the first three users and the first three posts (Polymorphic One To One).
     */
    public function run(): void
    {
        User::orderBy('id')->take(3)->get()->each(function (User $user): void {
            $user->image()->create(['url' => "https://images.example.com/users/{$user->id}.jpg"]);
        });

        Post::orderBy('id')->take(3)->get()->each(function (Post $post): void {
            $post->image()->create(['url' => "https://images.example.com/posts/{$post->id}.jpg"]);
        });
    }
}
