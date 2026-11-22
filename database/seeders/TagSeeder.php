<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Seed tags and attach them to posts and videos (Polymorphic Many To Many).
     */
    public function run(): void
    {
        $ids = collect(['php', 'laravel', 'vue', 'tips', 'tutorial'])
            ->map(fn (string $name): int => Tag::create(['name' => $name])->id)
            ->all();

        $count = count($ids);

        Post::orderBy('id')->get()->each(function (Post $post, int $index) use ($ids, $count): void {
            $post->tags()->attach([$ids[$index % $count], $ids[($index + 1) % $count]]);
        });

        Video::orderBy('id')->get()->each(function (Video $video, int $index) use ($ids, $count): void {
            $video->tags()->attach($ids[$index % $count]);
        });
    }
}
