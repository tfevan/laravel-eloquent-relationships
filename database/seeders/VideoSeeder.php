<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Seed videos, the second model type used by the polymorphic relations.
     */
    public function run(): void
    {
        $videos = [
            'eloquent-in-10-minutes' => 'Eloquent in 10 Minutes',
            'vue-3-crash-course' => 'Vue 3 Crash Course',
            'laravel-queues-explained' => 'Laravel Queues Explained',
            'inertia-tips' => 'Inertia Tips',
        ];

        foreach ($videos as $slug => $title) {
            Video::create(['title' => $title, 'url' => "https://videos.example.com/{$slug}"]);
        }
    }
}
