<?php

declare(strict_types=1);

namespace App\Actions\Image;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SearchImagesByImageableName
{
    /**
     * Find images by the user name or the post title with whereHasMorph().
     */
    public function execute(string $term): Collection
    {
        return Image::query()
            ->whereHasMorph('imageable', [User::class, Post::class], function (Builder $query, string $type) use ($term): void {
                $column = $type === User::class ? 'name' : 'title';

                $query->where($column, 'like', "%{$term}%");
            })
            ->with('imageable')
            ->orderBy('id')
            ->get();
    }
}