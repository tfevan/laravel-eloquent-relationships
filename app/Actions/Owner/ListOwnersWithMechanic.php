<?php

declare(strict_types=1);

namespace App\Actions\Owner;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Collection;

class ListOwnersWithMechanic
{
    /**
     * List owners with the car and the mechanic eager loaded with a nested relation.
     */
    public function execute(): Collection
    {
        return Owner::with('car.mechanic')->orderBy('id')->get();
    }
}