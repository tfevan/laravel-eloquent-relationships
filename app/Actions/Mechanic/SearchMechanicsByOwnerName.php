<?php

declare(strict_types=1);

namespace App\Actions\Mechanic;

use App\Models\Mechanic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

class SearchMechanicsByOwnerName
{
    /**
     * Find mechanics by the name of the car owner and eager load only the matching owner.
     */
    public function execute(string $name): Collection
    {
        return Mechanic::withWhereHas('owner', fn (Builder|Relation $query) => $query->where('owners.name', 'like', "%{$name}%"))
            ->orderBy('id')
            ->get();
    }
}