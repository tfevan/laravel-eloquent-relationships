<?php

declare(strict_types=1);

namespace App\Actions\Owner;

use App\Models\Mechanic;
use App\Models\Owner;

class ShowOwnerMechanic
{
    /**
     * Walk back from the owner to the mechanic through the car, there is no inverse through method.
     */
    public function execute(Owner $owner): ?Mechanic
    {
        return $owner->car?->mechanic;
    }
}