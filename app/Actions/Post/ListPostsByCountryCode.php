<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListPostsByCountryCode
{
    /**
     * List posts written by users of a country with a nested whereHas().
     */
    public function execute(string $code): Collection
    {
        return Post::whereHas('user.country', fn (Builder $query) => $query->where('code', strtoupper($code)))
            ->with('user')
            ->orderBy('id')
            ->get();
    }
}