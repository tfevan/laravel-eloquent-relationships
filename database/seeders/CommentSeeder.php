<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Video;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Seed comments on posts and videos (Polymorphic One To Many), some are not approved.
     */
    public function run(): void
    {
        Post::orderBy('id')->take(4)->get()->each(function (Post $post): void {
            $post->comments()->createMany([
                ['body' => fake()->sentence(), 'approved' => true],
                ['body' => fake()->sentence(), 'approved' => false],
            ]);
        });

        Video::orderBy('id')->get()->each(function (Video $video): void {
            $video->comments()->create(['body' => fake()->sentence(), 'approved' => true]);
        });
    }
}
