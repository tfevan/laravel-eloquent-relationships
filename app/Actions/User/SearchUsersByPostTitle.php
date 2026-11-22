<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

class SearchUsersByPostTitle
{
    /**
     * Find users by a post title fragment and eager load only the matching posts.
     */
    public function execute(string $title): Collection
    {
        return User::withWhereHas('posts', fn (Builder|Relation $query) => $query->where('title', 'like', "%{$title}%"))
            ->orderBy('id')
            ->get();
    }
}