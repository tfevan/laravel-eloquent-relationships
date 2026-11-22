<?php

declare(strict_types=1);

namespace App\Actions\Phone;

use App\Models\Phone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListPhonesWithUser
{
    /**
     * List phones with the owner eager loaded, optionally filtered by owner name with whereRelation().
     */
    public function execute(?string $ownerName = null): Collection
    {
        return Phone::query()
            ->when($ownerName !== null, fn (Builder $query) => $query->whereRelation('user', 'name', 'like', "%{$ownerName}%"))
            ->with('user')
            ->orderBy('id')
            ->get();
    }
}