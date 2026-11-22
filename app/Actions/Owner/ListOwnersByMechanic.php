<?php

declare(strict_types=1);

namespace App\Actions\Owner;

use App\Models\Mechanic;
use App\Models\Owner;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListOwnersByMechanic
{
    /**
     * List the owners of the cars a mechanic works on with whereHas() and whereBelongsTo().
     */
    public function execute(Mechanic $mechanic): Collection
    {
        return Owner::whereHas('car', fn (Builder $query) => $query->whereBelongsTo($mechanic))
            ->with('car')
            ->orderBy('id')
            ->get();
    }
}