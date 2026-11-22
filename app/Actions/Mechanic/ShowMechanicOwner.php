<?php

declare(strict_types=1);

namespace App\Actions\Mechanic;

use App\Models\Mechanic;
use App\Models\Owner;

class ShowMechanicOwner
{
    /**
     * Get the owner of the mechanic's car through the dynamic property.
     */
    public function execute(Mechanic $mechanic): ?Owner
    {
        return $mechanic->owner;
    }
}