<?php

declare(strict_types=1);

namespace App\Actions\Image;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ListImagesWithImageableDetails
{
    /**
     * Eager load the parent and a different nested relation for each parent type with morphWith().
     */
    public function execute(): Collection
    {
        return Image::query()
            ->with(['imageable' => fn (MorphTo $morphTo) => $morphTo->morphWith([
                User::class => ['country'],
                Post::class => ['user'],
            ])])
            ->orderBy('id')
            ->get();
    }
}