<?php

declare(strict_types=1);

namespace App\Actions\Mechanic;

use App\Models\Mechanic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListMechanicsWithOwner
{
    /**
     * List mechanics with the owner eager loaded, optionally only those with or without an owner.
     */
    public function execute(?bool $hasOwner = null): Collection
    {
        return Mechanic::query()
            ->when($hasOwner === true, fn (Builder $query) => $query->has('owner'))
            ->when($hasOwner === false, fn (Builder $query) => $query->doesntHave('owner'))
            ->with('owner')
            ->orderBy('id')
            ->get();
    }
}