<?php

declare(strict_types=1);

namespace App\Actions\Mechanic;

use App\Models\Mechanic;

class CheckMechanicHasOwner
{
    /**
     * Check if the mechanic reaches an owner through the car without loading it.
     */
    public function execute(Mechanic $mechanic): bool
    {
        return $mechanic->owner()->exists();
    }
}